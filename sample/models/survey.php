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

require_once 'Elemental/model.php';

/**
 * Sample Elemental application model class
 *
 * @author Zed Robinson <dev@zrobinson.com>
 */
class Sample_Model_Survey extends Elemental_Model {
	
	/**
	 * Database link resource
	 *
	 * @var resource
	 */
	private $link;
	
	/**
	 * Stores any user input 
	 *
	 * @var array
	 */
	protected $input = array();
	
	/**
	 * Contructor loads user input
	 * 
	 * @param array $request
	 */
	public function __construct($request = array()) {
		parent::__construct($request);
	}

	/**
	 * Load survey input page content
	 * 
	 * @return array
	 */
	public function add() {
		
		$this->connectToDatabase();

		$query = 'SELECT 
					q.survey_question_id as question_id,
					q.survey_question as question, 
					o.survey_question_answer_option_id as option_id, 
					o.survey_question_answer_option as option_text
			      from survey_questions q, survey_question_answer_options o
				  where 
					o.survey_question_id = q.survey_question_id and
					q.survey_id in (select max(survey_id) from surveys where date_expired is null)';
		
		/* Load current survey question and answer options */
		$result = mysql_query($query, $this->link);
		while ($record = mysql_fetch_assoc($result)) {
			$questionId = $record['question_id'];
			$question = $record['question'];			
			$options[$record['option_id']] = $record['option_text'];						
		}		
		if (is_resource($result)) { mysql_free_result($result); }
		
		$data = array(
			'question_id' => $questionId,
			'question' => $question,
			'options' => $options
		);

		return $data;
	}
	
	/**
	 * Save submitted survey response and display results
	 * 
	 * @return array
	 */
	public function create() {
		
		$this->connectToDatabase();	

		/* validate user input */
		$answerOptionSelected = mysql_real_escape_string($this->input['answer_option']);

		if (is_numeric($answerOptionSelected)) {
								
			/* save survey response */
			$insert = "INSERT INTO survey_results 
						(survey_question_answer_option_id, survey_result_created_date) 
						VALUES ('$answerOptionSelected', NOW())";				
			$status = mysql_query($insert, $this->link);
			if (false === $status) {
				throw new Exception('Database query error: ' . mysql_error());									
			}	
			$surveyResultId = mysql_insert_id($this->link);
			
			/* retrieve user's answer */
			$query = "SELECT 
						q.survey_question as question, 
						o.survey_question_answer_option as option_text
				      from survey_questions q, survey_question_answer_options o
					  where 
						o.survey_question_answer_option_id = $answerOptionSelected";
								
			$result = mysql_query($query, $this->link);
			if (mysql_num_rows($result)==1) {
				$record = mysql_fetch_assoc($result);			
				$question = $record['question'];			
				$answer = $record['option_text'];									
			}		
			if (is_resource($result)) { mysql_free_result($result); }
			
			/* load survey results */
			$query = "SELECT 
						o.survey_question_answer_option as option_text,
						o.survey_question_answer_option_id as option_id, 
						count(r.survey_question_answer_option_id) as option_total,
						(select count(*) from survey_results) as total	
				      FROM 
						survey_question_answer_options o
					  LEFT JOIN
						survey_results r on o.survey_question_answer_option_id = r.survey_question_answer_option_id 
					  GROUP BY o.survey_question_answer_option_id";
			
			$result = mysql_query($query, $this->link);		
			while ($record = mysql_fetch_assoc($result)) {
				$statistics[$record['option_text']] = array(
					'answer' => $record['option_text'],
					'percentage' => number_format($record['option_total'] / $record['total'] * 100, 1),				
				); 
			}
			if (is_resource($result)) { mysql_free_result($result); }
			
			/* collect response data */
			$data = array(
				'question' => $question,
				'answer' => $answer,
				'statistics' => $statistics
			);
			
			return $data;
		}
	}		
	
	/**
	 * Establish a connection to the database
	 */
	private function connectToDatabase() {
		
		/* initiate non-persistent link to database server */
		$this->link = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
		if (!$this->link) {
			throw new Exception('Database connection error: ' . mysql_error());
		}
		
		/* select database for use */
		$dbSelected = mysql_select_db(DB_DATABASE, $this->link);
		if (!$dbSelected) {
			throw new Exception('Unable to select ' . DB_DATABASE . ': ' . mysql_error());
		}
	}
}