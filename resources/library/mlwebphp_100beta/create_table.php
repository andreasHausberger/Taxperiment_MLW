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
    "CREATE TABLE IF NOT EXISTS `mlweb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expname` varchar(50) DEFAULT NULL,
  `subject` int(11) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `condnum` int(11) DEFAULT NULL,
  `choice` varchar(50) DEFAULT NULL,
  `submitted` datetime DEFAULT NULL,
  `procdata` varchar(2000) DEFAULT NULL,
  `addvar` varchar(2000) DEFAULT NULL,
  `adddata` varchar(2000) DEFAULT NULL,
  `experiment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_idx` (`subject`),
  KEY `experiment_id_idx` (`experiment_id`),
  CONSTRAINT `experiment_id` FOREIGN KEY (`experiment_id`) REFERENCES `experiment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `subject` FOREIGN KEY (`subject`) REFERENCES `participant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8";

if ($connection->query($sqlquery) === TRUE) {
    console_log( "Table mlweb created successfully!");
}
?>