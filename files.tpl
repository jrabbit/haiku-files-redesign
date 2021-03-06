<!DOCTYPE html>
<html lang="en">
	<head>
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<meta charset="utf-8" />
		<title>Directory Listing of {{!location}}</title>
		<link rel="stylesheet" type="text/css" href="http://haiku-files.org/css/style.css" />
		<link rel="alternate" type="application/rss+xml" title="Raw RSS feed" href="rss/" />
		<link rel="stylesheet" type="text/css" href="css/original.css" />
	</head>
	<body>
		<div id='banner'>
		<header>
			<h1 class='title'>FILES ARCHIVE</h1>
			<div id="tete">
			</div>
		</header>
		</div>		
		<section id='instructions'>
			{{!instructions}}
			<p>As with all other nightly images, they extract to 450M and contain a minimum of 3rdparty software as per the "nightly-*" <a href="http://dev.haiku-os.org/browser/haiku/trunk/build/jam/ReleaseBuildProfiles">ReleaseBuildProfiles</a>'s rule. Additional software, such as a web browser can be installed with the `installoptionalpackage` command. </p>
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
		% if location is 'raw':	
			<h2 class="icon-hdd-medium"><a href="/anyboot">Anyboot Images</a> | Raw Images | <a href="/vmware">VMware Images</a> | <a href="/cd">CD Images</a> </h2>
		% elif location is 'vmware':
			<h2 class="icon-hdd-medium"><a href="/anyboot">Anyboot Images</a> | <a href="/raw">Raw Images </a> | VMware Images | <a href="/cd">CD Images</a> </h2>
		% elif location is 'anyboot':
			<h2 class="icon-hdd-medium">Anyboot Images| <a href="/raw">Raw Images </a> | <a href="/vmware">VMware Images</a> | <a href="/cd">CD Images</a> </h2>
		% elif location is 'cd':
			<h2 class="icon-hdd-medium"><a href="/anyboot">Anyboot Images</a> | <a href="/raw">Raw Images </a> | <a href="/vmware">VMware Images</a> | CD Images </h2>
		%end
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
				{{!htmls}}
<tr class="row" onmouseover="this.className='highlight'" onmouseout="this.className='no'">
							<td colspan="4">
								<br/>
								<div>
									<a id='show-all' href="/{{location}}/all" class="link">
										Show All Files - Only Current Month Showing
									</a>
								</div>
								<br/>
							</td>
						</tr>
			</table>
					</article>
					<div class="dotline">
						<br/>
					</div>
					<br/>
   					<div id="copy"> Copyright 2001 - 2011 Haiku, Inc. &mdash; Haiku&trade;, haiku-files.org and the HAIKU logo&reg; are (registered) trademarks of <a href="http://www.haiku-inc.org" target="_blank">Haiku, Inc.</a>| Proudly Hosted by <a href="http://dreamhost.com" target="_blank">DreamHost</a>.
   					</div>
					<br/>
	</body>
</html>