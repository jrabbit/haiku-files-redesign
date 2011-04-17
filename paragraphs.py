instructions = {'raw': """<h1>Below are Raw Images</h1> 
<p>They can be used with Qemu, written directly to a USB flash device, or mounted within Haiku.</p>""",
'vmware' : """<h1>Below are VMWare Images</h1>
<p>These images can be used with either VMWare and VirtualBox. When using either the <a href="http://svn.haiku-os.org/haiku/haiku/trunk/3rdparty/vmware/haiku-nightly.vmx">haiku-nightly.vmx</a>. Additionally, the haiku-nightly.vmx includes support for a <a href="http://haiku-files.org/files/blank-bfs/blank-bfs-2048mb.vmdk">2048M expanding disk image</a>.</p>""",
'anyboot': """<h1>Below are Anyboot Images</h1> 
<p>They can be burned to a compact disc, written directly to a USB flash device, or used with Qemu. To note, some disc burning software may try to be "clever" and won't burn the image properly. K3b, CDRecord and Burn 2.4.1u are reported to burn the anyboot image properly, without even needing to rename the file to *.iso. </p>""",
'cd' :"""<h1>Below are ISO CD Images</h1>
<p>They are designed for installing Haiku from a compact disc.</p>"""}