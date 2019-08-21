
-- ----------------------------
-- Create sample application database
-- ----------------------------
DROP DATABASE IF EXISTS `Sample_Elemental_App`;
CREATE DATABASE `Sample_Elemental_App`
  DEFAULT CHARACTER SET latin1
  DEFAULT COLLATE latin1_general_ci;
USE `Sample_Elemental_App`;


SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `survey_question_answer_options`
-- ----------------------------
DROP TABLE IF EXISTS `survey_question_answer_options`;
CREATE TABLE `survey_question_answer_options` (
  `survey_question_answer_option_id` int(11) unsigned NOT NULL auto_increment,
  `survey_question_id` int(11) unsigned NOT NULL,
  `survey_question_answer_option` text NOT NULL,
  PRIMARY KEY  (`survey_question_answer_option_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of survey_question_answer_options
-- ----------------------------
INSERT INTO `survey_question_answer_options` VALUES ('1', '1', 'Very easy');
INSERT INTO `survey_question_answer_options` VALUES ('2', '1', 'Somewhat easy');
INSERT INTO `survey_question_answer_options` VALUES ('3', '1', 'Somewhat difficult');
INSERT INTO `survey_question_answer_options` VALUES ('4', '1', 'Very difficult');

-- ----------------------------
-- Table structure for `survey_questions`
-- ----------------------------
DROP TABLE IF EXISTS `survey_questions`;
CREATE TABLE `survey_questions` (
  `survey_question_id` int(11) unsigned NOT NULL auto_increment,
  `survey_id` int(11) unsigned NOT NULL,
  `survey_question` text NOT NULL,
  PRIMARY KEY  (`survey_question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of survey_questions
-- ----------------------------
INSERT INTO `survey_questions` VALUES ('1', '1', 'How easy is Elemental to use?');

-- ----------------------------
-- Table structure for `survey_results`
-- ----------------------------
DROP TABLE IF EXISTS `survey_results`;
CREATE TABLE `survey_results` (
  `survey_result_id` int(10) unsigned NOT NULL auto_increment,
  `survey_question_answer_option_id` int(10) unsigned NOT NULL,
  `survey_result_created_date` datetime NOT NULL,
  PRIMARY KEY  (`survey_result_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;


-- ----------------------------
-- Table structure for `surveys`
-- ----------------------------
DROP TABLE IF EXISTS `surveys`;
CREATE TABLE `surveys` (
  `survey_id` int(11) unsigned NOT NULL auto_increment,
  `survey_name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_expired` datetime default NULL,
  PRIMARY KEY  (`survey_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of surveys
-- ----------------------------
INSERT INTO `surveys` VALUES ('1', 'Sample Elemental Application', '2010-03-13 15:43:10', null);
