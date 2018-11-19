------------------------------------------------------

Designer package for mouselabWEB 

version 1.00beta Aug 14, 2008

(c) Martijn Willemsen and Eric Johnson, 2003-2008

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

------------------------------------------------------

designer files:

index.html		MouselabWEB designer
mlweb_edit.html		Menu part of designer (top frame)
mlweb_help.html		Help file
mlwebdesign.css		style sheet for editor
mlwebdesign.js		basic script of editor
start.html			page for bottom frame
images				folder with images for help page
download.php		Php file used for download pages (this requires installing on a php enabled webserver)

license file:

gpl.txt			GNU General Public License 


Standard MouselabWEB files needed for testing mode:
mlweb.js		basic script used for MouselabWeb functionality 
mlweb2.js		basic script for questions only pages
mlweb.css		default css style sheet for MouselabWEB pages
transp.gif		Transparent image needed for mlweb.js

The editor files unzip to a subfolder designer. The editor than will be linked to as designer/index.html, or if on the web, just by www.yourpage.xxx/designer/. Note that the whole package has to be put in the folders of a webserver, if you need the download functionality (as it used php). However, for the rest it should work without this, right from windows explorer.

