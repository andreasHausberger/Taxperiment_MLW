------------------------------------------------------

PHP package for mouselabWEB 

version 1.00beta, August 14, 2008

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

files:

MouselabWEB web files:

mlweb.js		basic script used for MouselabWeb functionality
mlweb2.js		basic script for process tracing functionality in pages without MouselabWEB table
mlweb.css		default css style sheet for MouselabWEB pages
transp.gif		Transparent image needed for mlweb.js
save.php		handler file that saves the data in the database
mlwebdb.inc.php		Include file with connection settings to the database 
			(used by all other phpfiles)


utility files

mlweb_start.html	default start page to set cookie for condition number and subject 
					name and load a the first page in a new window
mlweb_start_php.html	default start page to load php page in new window with condition 
						number and subject name
mlweb_start_random.html	default start page like mlweb_start.html, now with random selection of one of six links (can be adjusted)
thanks.html		default "thanks" end page
create_table.php	Uses mlwebdb.inc.php file to create a mlweb table in the database automatically 
datalyser.php		Web page that allows the user to download data in CSV format, show content of experiments and playback data of a subject
pb_control.html		Part of playback scripts from datalyser.php
playback.html		Part of playback scripts from datalyser.php

license file:

gpl.txt			GNU General Public License 

Installing:

- Unzip files to local folder on computer (e.g. a mlweb subfolder in your my Documents folder)
- edit the file mlwebdb.inc.php with the parameters of your mySQL database
- edit the first line of datalyser.php to change the password (this download page has a password to prevent other people from reading the data)
- Upload files to any website using FTP
- set the read/write access of all users on the tmp directory (for datalyser.php)
- run create_table.php on the server to create a table in the database

