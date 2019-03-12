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
/*!40000 ALTER TABLE `exp_round` DISABLE KEYS */;



$expRoundQuery = "
CREATE TABLE IF NOT EXISTS`exp_round` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_rate` float DEFAULT NULL,
  `audit_probability` float DEFAULT NULL,
  `fine_rate` float DEFAULT NULL,
  `prediction` varchar(45) DEFAULT 'evade',
  PRIMARY KEY (`id`)
)";


$feedbackQuery = "
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
";

$orderQuery = "
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);";

$participantQuery = "
CREATE TABLE IF NOT EXISTS `participant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
)
";

$presentationQuery = "
CREATE TABLE IF NOT EXISTS `presentation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
)";

$expConditionQuery = "
CREATE TABLE IF NOT EXISTS `exp_condition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `feedback` int(11) DEFAULT NULL,
  `presentation` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `feedback_idx` (`feedback`),
  KEY `order_idx` (`order`),
  KEY `presentation_idx` (`presentation`),
  CONSTRAINT `feedback` FOREIGN KEY (`feedback`) REFERENCES `feedback` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order` FOREIGN KEY (`order`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `presentation` FOREIGN KEY (`presentation`) REFERENCES `presentation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
)";

$experimentQuery = "
CREATE TABLE IF NOT EXISTS `experiment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participant` int(11) DEFAULT NULL,
  `exp_condition` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `participant_idx` (`participant`),
  KEY `exp_condition_idx` (`exp_condition`),
  CONSTRAINT `exp_condition` FOREIGN KEY (`exp_condition`) REFERENCES `exp_condition` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `participant` FOREIGN KEY (`participant`) REFERENCES `participant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ";

$insertRoundsQuery = "INSERT INTO `exp_round` (`id`, `tax_rate`, `audit_probability`, `fine_rate`, `prediction`)
VALUES
(1,0.4,0.1,1,'evade'),
	(2,0.2,0.2,2,'evade'),
	(3,0.4,0.1,2,'evade'),
	(4,0.2,0.1,1,'evade'),
	(5,0.2,0.2,1,'evade'),
	(6,0.4,0.2,3,'evade'),
	(7,0.2,0.3,1,'evade'),
	(8,0.2,0.3,1,'evade'),
	(9,0.2,0.3,2,'evade'),
	(10,0.2,0.2,3,'evade'),
	(11,0.4,0.3,1,'evade'),
	(12,0.2,9,2,'evade'),
	(13,0.2,0.3,3,'comply'),
	(14,0.4,0.2,1,'evade'),
	(15,0.2,0.1,3,'evade'),
	(16,0.4,0.3,2,'evade'),
	(17,0.4,0.3,3,'comply'),
	(18,0.4,0.1,3,'evade')";

$insertConditionQuery = "
INSERT INTO `exp_condition` (`id`, `order`, `feedback`, `presentation`)
VALUES
(1,0,0,0),
	(2,0,0,1),
	(3,0,1,0),
	(4,0,1,1),
	(5,1,0,0),
	(6,1,0,1),
	(7,1,1,0),
	(8,1,1,1);
";

//NOTE: Please don't try to run the insert queries - they don't work & will break it.

$mlwebQuery = "
CREATE TABLE IF NOT EXISTS `mlweb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expname` varchar(50) DEFAULT NULL,
  `subject` int(11) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `condnum` int(11) DEFAULT NULL,
  `choice` varchar(50) DEFAULT NULL,
  `submitted` datetime DEFAULT NULL,
  `round` int(11) DEFAULT NULL,
  `procdata` varchar(2000) DEFAULT NULL,
  `addvar` varchar(2000) DEFAULT NULL,
  `adddata` varchar(2000) DEFAULT NULL,
  `experiment_id` int(11) DEFAULT NULL,
  `income` int(11) DEFAULT NULL,
  `reported_income` int(11) DEFAULT NULL,
  `audit` tinyint(4) DEFAULT NULL,
  `honesty` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_idx` (`subject`),
  KEY `experiment_id_idx` (`experiment_id`),
  CONSTRAINT `experiment_id` FOREIGN KEY (`experiment_id`) REFERENCES `experiment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `subject` FOREIGN KEY (`subject`) REFERENCES `participant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
)
";

$memAttnQuery = "
CREATE TABLE IF NOT EXISTS `questionnaire` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `ma1` int(11) DEFAULT NULL,
  `ma2` int(11) DEFAULT NULL,
  `ma3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  CONSTRAINT `q_memattn_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `participant` (`id`)
)";

$auditQuery = "
CREATE TABLE `questionnaire` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `ma1` int(11) DEFAULT NULL,
  `ma2` int(11) DEFAULT NULL,
  `ma3` int(11) DEFAULT NULL,
  `exp1` int(11) DEFAULT NULL,
  `exp2` int(11) DEFAULT NULL,
  `exp3` int(11) DEFAULT NULL,
  `exp4` int(11) DEFAULT NULL,
  `exp5` int(11) DEFAULT NULL,
  `num1` int(11) DEFAULT NULL,
  `num2` int(11) DEFAULT NULL,
  `num3` int(11) DEFAULT NULL,
  `cog1` int(11) DEFAULT NULL,
  `rsk1` int(11) DEFAULT NULL,
  `rsk2` int(11) DEFAULT NULL,
  `rsk3` int(11) DEFAULT NULL,
  `com1` int(11) DEFAULT NULL,
  `com2` int(11) DEFAULT NULL,
  `com3` int(11) DEFAULT NULL,
  `com4` int(11) DEFAULT NULL,
  `com5` int(11) DEFAULT NULL,
  `com6` int(11) DEFAULT NULL,
  `com7` int(11) DEFAULT NULL,
  `com8` int(11) DEFAULT NULL,
  `dgs1` int(11) DEFAULT NULL,
  `dgs2` int(11) DEFAULT NULL,
  `dgs3` int(11) DEFAULT NULL,
  `dgs4` int(11) DEFAULT NULL,
  `dgs5` int(11) DEFAULT NULL,
  `dgs6` int(11) DEFAULT NULL,
  `dgs7` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `nationality` int(11) DEFAULT NULL COMMENT '0 ... Dutch, 1 ... International',
  `participation_before` int(11) NOT NULL,
  `care` int(11) DEFAULT NULL,
  `understanding` int(11) DEFAULT NULL,
  `english` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  CONSTRAINT `questionnaire_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `participant` (`id`)
)";

$queries = array("Experiment Rounds" => $expRoundQuery, "Feedback" => $feedbackQuery, "Order" => $orderQuery,
    "Participant" => $participantQuery, "Presentation" => $presentationQuery, "Experiment Conditions" => $expConditionQuery,
    "Experiment" => $experimentQuery, "ML Web" => $mlwebQuery, "Questionnaire" => $memAttnQuery, "Audit Data" => $auditQuery);

$count = 0;
$keys = array_keys($queries);


foreach ($queries as $query) {
    if ($connection->query($query) === TRUE) {
        $currentKey = $keys[$count];
        console_log("Query for table " . $currentKey . " successful!");
    } else {
        echo "\n" . " Problem with Query for table " . $currentKey . ": " . $connection->error();
    }
    $count = $count + 1;
}
?>