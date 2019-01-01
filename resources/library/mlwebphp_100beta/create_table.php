<?php 
// 		create_table.php create a mouselabWEB table 
//
//       v 1.00b, Aug 2008
//
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

// include('mlwebdb.inc.php');

$sqlquery =
    "CREATE TABLE IF NOT EXISTS mlweb 
    (id INTEGER PRIMARY KEY, expname VARCHAR(50), subject VARCHAR(50), ip varchar(20), condnum INTEGER, choice VARCHAR(50), submitted DATETIME, procdata VARCHAR(2000), addvar VARCHAR(2000), adddata VARCHAR(2000))";

if ($connection->query($sqlquery) === TRUE) {
    console_log( "Table mlweb created successfully!");
}
?>