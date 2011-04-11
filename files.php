<?php
	$targetDir = 'raw';
	$showAll = $_GET['show'] == 'all';

	function dirList($directory, $showAll) {
		$result = array();
		$handle = opendir($directory);
		$fileCount = 0;

		if (!$showAll) {
			$date = getdate();
			$cutOff = mktime(0, 0, 0, $date['mon'], 1, $date['year']);
		}

		// keep going until all files in directory have been read
		while (($file = readdir($handle)) !== false) {
			if (is_dir($file) || $file == 'index.php'
				|| $file == 'index_blank.php' || $file == 'index_old.php' || $file[0] == '.')
				continue;

			$modifyTime = filemtime($file);
			if (!$showAll && $modifyTime < $cutOff)
				continue;

			$result[$modifyTime] = $file;
		}

		krsort($result);

		// find archive dirs for the years
		if ($showAll) {
			rewinddir($handle);

			$archives = array();
			while (($dir = readdir($handle)) !== false) {
				if ($dir == '.' || $dir == '..' || !is_dir($dir)
					|| $dir == 'rss' || $dir == 'dlf')
					continue;

				$archives[$dir] = $dir;
			}

			krsort($archives);
			$result = array_merge($result, $archives);
		}

		closedir($handle);

		return $result;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Directory Listing of <?php echo($targetDir); ?></title>
		<link rel="stylesheet" type="text/css" href="http://haiku-files.org/css/style.css" />
		<link rel="alternate" type="application/rss+xml" title="Raw RSS feed" href="rss/" />
		<link rel="stylesheet" type="text/css" href="css/original.css" />
	</head>
	<body>
		<!--// HEADER //-->
		<header>
			<img id='hiaku-logo' src="http://haiku-files.org/images/haiku-logo.png" border="0" alt="Haiku" />
			<div id="header" class="header">
				<img src="http://haiku-files.org/css/icons/folder_home_16.png" alt="Home" />
				<a href="http://haiku-files.org/">Home</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="http://haiku-files.org/css/icons/folder_haiku_16.png" alt="Haiku" />
				<a href="http://haiku-os.org" title="Go to the Haiku homepage">haiku-os.org</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="http://haiku-files.org/css/icons/person_16.png" alt="Contact" />
				<a href="http://haiku-os.org/contact" title="Contact us with your feedback or suggestions">Contact Us</a>
			</div>
		</header>
		<!--// END HEADER //-->
		
		<section id='instructions'>
			<h1>Below are Raw Images</h1> 
			<p>They can be used with Qemu, written directly to a USB flash device, or mounted within Haiku. As with all other nightly images, they extract to 450M and contain a minimum of 3rdparty software as per the "nightly-*" <a href="http://dev.haiku-os.org/browser/haiku/trunk/build/jam/ReleaseBuildProfiles">ReleaseBuildProfiles</a>'s rule. Additional software, such as a web browser can be installed with the `installoptionalpackage` command. </p>
			<h2>Explanation of tar.xz</h2>
			<p>In addition to providing nightly images as the common compression format ZIP, a newer <a href="http://en.wikipedia.org/wiki/XZ_Utils">XZ format</a> is being utilized for distribution. As you can see, the tar.xz files are roughly half the size of the respective zip file. However, as the <a href="http://en.wikipedia.org/wiki/XZ_Utils">XZ format</a> is a newer compression format, it is less common and usually requires 3rd party software for extracting it.</p>
		</section>
		<section id='extract'>
			<h2>How to extract tar.xz</h2>
			<ul>
				<li>
					<b>Windows:</b> Install <a href="http://www.7-zip.org/download.html">7-Zip</a>
				</li>
				<li>
					<b>Mac OS X:</b> Install <a href="http://wakaba.c3.cx/s/apps/unarchiver.html">The Unarchiver v2.4</a>
				</li>
				<li>
					<b>Haiku/linux/bsd:</b> 
						<i>`tar -xvf FILENAME`</i>
				</li>
			</ul>
		</section>
		<section id='switch-kind'>
					<h2 class="icon-hdd-medium"><a href="http://haiku-files.org/anyboot">Anyboot Images</a> | Raw Images | <a
href="http://haiku-files.org/vmware">VMware Images</a> | <a href="http://haiku-files.org/cd">CD Images</a> <?php
?></h2>
		</section>
		<article id='nightlylist'>
			<table>
				<tr class="head">
					<td colspan="2" class="fileNamePad">
						<b>File Name</b>
					</td>
					<td class="fileSizePad">
						<b>File Size</b>
					</td>
					<td class="fileDatePad">
						<b>File Date</b>
					</td>
				</tr>
<?php
	$files = dirList(getcwd(), $showAll);
	$baseDir = "http://haiku-files.org/" . $targetDir;
	$index = 0;

	foreach ($files as $file) {
		$row = $index % 2 == 0 ? 'A' : 'B';

		$isDir = is_dir($file);
		$fileIcon = 'http://haiku-files.org/images/' . ($isDir ? 'folder' : 'bz2') . '.png';
		$fileSize = $isDir ? '&nbsp;' : number_format(filesize($file) / 1024 / 1024, 2, '.', ',') . 'MB';
		$fileDate = $isDir ? '&nbsp;' : date("g:iA jS F, Y", filemtime($file));
		$fileURL = $baseDir . '/' . $file;
?>
						<tr class="row<?php echo($row); ?>" onmouseover="this.className='highlight'" onmouseout="this.className='row<?php echo($row); ?>'">
							<td>
								<img class="icon" align="middle" src="<?php echo($fileIcon) ?>" alt="Archive" border="0" />
							</td>
							<td class="item">
								<a href="<?php echo($fileURL); ?>" class="link" target="_blank">
									<?php echo($file); ?>
								</a>
							</td>
							<td class="item">
								<a href="<?php echo($fileURL); ?>" class="link" target="_blank">
									<?php echo($fileSize) ?>
								</a>
							</td>
							<td class="item">
								<a href="<?php echo($fileURL); ?>" class="link" target="_blank">
									<?php echo($fileDate); ?>
								</a>
							</td>
						</tr>
<?php
		$index++;
	}

	if (!$showAll) {
		$row = $index % 2 == 0 ? 'A' : 'B';
?>
						<tr class="row<?php echo($row); ?>" onmouseover="this.className='highlight'" onmouseout="this.className='row<?php echo($row); ?>'">
							<td colspan="4">
								<br/>
								<div>
									<a id='show-all' href="<?php echo($_SERVER['PHP_SELF'] . '?show=all'); ?>" class="link">
										Show All Files - Only Current Month Showing
									</a>
								</div>
								<br/>
							</td>
						</tr>
<?php
	}
?>
					</table>
					</article>
					<div class="dotline">
						<br/>
					</div>
					<br/>
   					<div id="copy"> Copyright 2001 - <?php echo(date("Y")); ?> Haiku, Inc. &#151; 
Haiku&trade;, haiku-files.org and the HAIKU logo&reg; are (registered) trademarks of <a href="http://www.haiku-inc.org" target="_blank">Haiku, Inc.</a>| Proudly Hosted by <a href="http://dreamhost.com" target="_blank">DreamHost</a>.
   					</div>
					<br/>
	</body>
</html>