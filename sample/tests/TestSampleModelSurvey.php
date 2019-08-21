<?php
/*
This file is part of Elemental.

Elemental is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Elemental is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Elemental.  If not, see <http://www.gnu.org/licenses/>.
*/

require_once 'PHPUnit/Framework/TestCase.php';

require_once '../survey_config.php';
require_once 'models/survey.php';

/**
 * Test Elemental Sample Application Model Class
 * 
 * @author Zed Robinson <dev@zrobinson.com>
 */
class TestSampleModelSurvey extends PHPUnit_Framework_TestCase {
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();		
		
		/* initiate non-persistent link to database server */
		$link = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
		if (!$link) {
			throw new Exception('Database connection error: ' . mysql_error());
		}
		
		/* select database for use */
		$dbSelected = mysql_select_db(DB_DATABASE, $link);
		if (!$dbSelected) {
			throw new Exception('Unable to select ' . DB_DATABASE . ': ' . mysql_error());
		}
				
		mysql_query("TRUNCATE survey_results", $link);
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}

	/**
	 * Test the survey form submission processing
	 */
	public function testSurveyPrompt() {

		$survey = new Sample_Model_Survey();		
		$output = $survey->add();
		
		$expected = array(
			'question_id' => 1,
			'question' => "How easy is Elemental to use?",
			'options' => array(
				1 => "Very easy",
				2 => "Somewhat easy",
				3 => "Somewhat difficult",
				4 => "Very difficult"
			)
		);
		
		$this->assertEquals($expected['question_id'], $output['question_id']);
		$this->assertEquals($expected['question'], $output['question']);
		$this->assertTrue(count($output['options'])>0);
		foreach ($expected['options'] as $id => $expectedOption) {
			$this->assertEquals($expectedOption, $output['options'][$id]);
		}		
	}
	
	/**
	 * Test survey submission
	 */
	public function testSurveySubmit() {
		
		$request['answer_option'] = 1;
		$survey = new Sample_Model_Survey($request);		
		$output = $survey->create();

		$expected = array(
			'question' => "",
			'answer' => "",
			'statistics' => array(
				'Very easy' => array(
					'answer' => "Very easy",
					'percentage' => '0.0'
				),
				'Somewhat easy' => array(
					'answer' => "Somewhat easy",
					'percentage' => '0.0'
				),
				'Somewhat difficult' => array(
					'answer' => "Somewhat difficult",
					'percentage' => '0.0'
				),
				'Very difficult' => array(
					'answer' => "Very difficult",
					'percentage' => '0.0'
				),												
			)			
		);
		
		foreach ($expected['statistics'] as $statistic) {
			$this->assertEquals(current($statistic), $output['statistics'][current($statistic)]['answer']);			
		}
	}
	
	/**
	 * Test that the results are calculated and reported correctly. 
	 */
	public function testSurveyResultReporting() {
				
		$options = array(1, 2, 3, 4);
		$percentageSelected = array('100.0', '50.0', '33.3', '25.0');
		foreach ($options as $option) {
			$request['answer_option'] = $option;
			$survey = new Sample_Model_Survey($request);		
			$output = $survey->create();			
			$answer = current($output['statistics']);

			/**
			 * Assert that the percentage of the original selected answer should diminish with each
			 * different answer chosen.
			 */				 
			$this->assertContains($answer['percentage'], $percentageSelected);			
		}
	}
}

