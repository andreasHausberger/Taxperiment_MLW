<?php
// 	mlwebdb.inc.php: db settings for MouselabWEB 
//
//       v 1.00beta, Aug 2008
//		(identical to version 0.97.1/0.98/0.99, from 2004)
//     (c) 2003-2008 Martijn C. Willemsen and Eric J. Johnson 
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation; either version 2 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

$DBhost = "localhost"; 		// hostname of the mySQL database 
$DBuser = "username"; 		// username of user on this database
$DBpass = "password";		// user password
$DBName = "dbname";			// name of the database
$table = "mlweb";			// name of the table containing MLWEB Data (can be left to mlweb)

mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable toconnect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName"); 
?>