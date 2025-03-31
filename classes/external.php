<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * External API functions
 *
 * @package    local_leeloolxpcontentapi
 * @copyright  2024 Leeloo LXP (https://leeloolxp.com)
 * @author     Leeloo LXP <info@leeloolxp.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/externallib.php");

class local_leeloolxpcontentapi_external extends external_api {

	/**
	 * Get users list with filter
	 */
	public static function get_users_parameters() {
		return new external_function_parameters(
			array(
				'username' => new external_value(PARAM_TEXT, 'Username to filter by', VALUE_DEFAULT, '')
			)
		);
	}

	/**
	 * Get get courses category list with filter
	 */
	public static function get_courses_category_parameters() {
		return new external_function_parameters(
			array(
				'pageid' => new external_value(PARAM_TEXT, 'pageid to filter by', VALUE_REQUIRED),
				'sectionid' => new external_value(PARAM_TEXT, 'sectionid to filter by', VALUE_REQUIRED)
			)
		);
	}

	/**
	 * Get all courses
	 */
	public static function get_courses_parameters() {
		return new external_function_parameters(
			array()
		);
	}

	/**
	 * Get AR of sections
	 */
	public static function get_section_ar_parameters() {
		return new external_function_parameters(
			array(
				'sectionid' => new external_value(PARAM_INT, 'Section ID', VALUE_REQUIRED)
			)
		);
	}

	/**
	 * Create AR
	 */
	public static function create_ar_parameters() {
		return new external_function_parameters(
			array(
				'sectionid' => new external_value(PARAM_INT, 'Section ID', VALUE_REQUIRED),
				'ardata' => new external_value(PARAM_RAW, 'AR Data', VALUE_REQUIRED),
				'dbtable' => new external_value(PARAM_TEXT, 'Database Table', VALUE_REQUIRED),
				'timelimit' => new external_value(PARAM_TEXT, 'Quiz timelimit', VALUE_REQUIRED),
				'moduleid' => new external_value(PARAM_INT, 'moduleid', VALUE_REQUIRED, 0),
			)
		);
	}

	/**
	 * Create questions
	 */
	public static function create_questions_parameters() {
		return new external_function_parameters(
			array(
				'params' => new external_value(PARAM_RAW, 'Parameters all', VALUE_REQUIRED),
				'questions' => new external_value(PARAM_RAW, 'Questions Data', VALUE_REQUIRED)
			)
		);
	}

	/**
	 * Get questions by quizid
	 */
	public static function get_questions_by_quiz_parameters() {
		return new external_function_parameters(
			array(
				'params' => new external_value(PARAM_RAW, 'Parameters all', VALUE_REQUIRED),
				'qtype' => new external_value(PARAM_RAW, 'qtype Data', VALUE_REQUIRED)
			)
		);
	}

	/**
	 * Get sections of the course
	 */
	public static function get_sections_course_parameters() {
		return new external_function_parameters(
			array(
				'courseid' => new external_value(PARAM_INT, 'Course ID', VALUE_REQUIRED),
				'type' => new external_value(PARAM_TEXT, 'Type filter', VALUE_REQUIRED),
				'sectionid' => new external_value(PARAM_INT, 'Section ID', VALUE_REQUIRED),
			)
		);
	}


	/**
	 * login user
	 */
	public static function login_user_parameters() {
		return new external_function_parameters(
			array(
				'username' => new external_value(PARAM_TEXT, 'username filter', VALUE_REQUIRED),
				'userid' => new external_value(PARAM_INT, 'userid filter', VALUE_REQUIRED, 0),
			)
		);
	}

	/**
	 * get comman data
	 */
	public static function get_comman_data_parameters() {
		return new external_function_parameters(
			array(
				'table' => new external_value(PARAM_TEXT, 'table name', VALUE_REQUIRED),
				'id' => new external_value(PARAM_TEXT, 'column id ', VALUE_REQUIRED),
				'column' => new external_value(PARAM_TEXT, 'column name', VALUE_REQUIRED),
				'condition' => new external_value(PARAM_TEXT, 'column condition', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * get course image url
	 */
	public static function get_course_image_url_parameters() {
		return new external_function_parameters(
			array(
				'defaulturl' => new external_value(PARAM_TEXT, 'deafult url', VALUE_REQUIRED),
				'courseid' => new external_value(PARAM_TEXT, 'course id ', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * check user enrolled incourse
	 */
	public static function check_user_enrolled_incourse_parameters() {
		return new external_function_parameters(
			array(
				'userid' => new external_value(PARAM_INT, 'user id', VALUE_REQUIRED),
				'courseid' => new external_value(PARAM_INT, 'course id ', VALUE_REQUIRED),
				'type' => new external_value(PARAM_TEXT, 'AR type ', VALUE_REQUIRED, 'enrol'),
			)
		);
	}


	/**
	 * get activities data
	 */
	public static function get_activities_data_parameters() {
		return new external_function_parameters(
			array(
				'sequence' => new external_value(PARAM_TEXT, 'sequence id', VALUE_REQUIRED),
				'type' => new external_value(PARAM_TEXT, 'AR type ', VALUE_REQUIRED),
				'quiz_types' => new external_value(PARAM_RAW, 'quiz  types ', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * enrol user in course
	 */
	public static function enrol_user_incourse_parameters() {
		return new external_function_parameters(
			array(
				'userid' => new external_value(PARAM_INT, 'user id', VALUE_REQUIRED),
				'courseid' => new external_value(PARAM_INT, 'course id ', VALUE_REQUIRED),
				'roleid' => new external_value(PARAM_TEXT, 'role id ', VALUE_REQUIRED),
			)
		);
	}


	/**
	 * get questions data common
	 */
	public static function get_questions_data_common_parameters() {
		return new external_function_parameters(
			array(
				'userid' => new external_value(PARAM_INT, 'user id', VALUE_REQUIRED),
				'quizid' => new external_value(PARAM_INT, 'quiz id ', VALUE_REQUIRED),
				'type' => new external_value(PARAM_TEXT, 'type ', VALUE_REQUIRED),
				'lang' => new external_value(PARAM_TEXT, 'lang name ', VALUE_REQUIRED, 'en'),
			)
		);
	}

	/**
	 * save lesson quiz attempt
	 */
	public static function save_lesson_quiz_attempt_parameters() {
		return new external_function_parameters(
			array(
				'userid' => new external_value(PARAM_INT, 'userid', VALUE_REQUIRED),
				'questionid' => new external_value(PARAM_INT, 'questionid', VALUE_REQUIRED),
				'questionid_str' => new external_value(PARAM_TEXT, 'questionid str ', VALUE_REQUIRED),
			)
		);
	}


	/**
	 * update lesson quiz attempt
	 */
	public static function update_lesson_quiz_attempt_parameters() {
		return new external_function_parameters(
			array(
				'userid' => new external_value(PARAM_INT, 'userid', VALUE_REQUIRED),
				'questionid' => new external_value(PARAM_INT, 'questionid', VALUE_REQUIRED),
				'attemptid' => new external_value(PARAM_INT, 'attemptid', VALUE_REQUIRED),
				'selectedoptionid' => new external_value(PARAM_INT, 'selectedoptionid', VALUE_REQUIRED),
				'assessment' => new external_value(PARAM_TEXT, 'assessment', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * submit lesson quiz attempt
	 */
	public static function submit_lesson_quiz_attempt_parameters() {
		return new external_function_parameters(
			array(
				'userid' => new external_value(PARAM_INT, 'userid', VALUE_REQUIRED),
				'attemptid' => new external_value(PARAM_INT, 'attemptid', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * Returns description of submit_lesson_quiz_attempt()
	 * @return external_description
	 */
	public static function submit_lesson_quiz_attempt_returns() {
		return new external_function_parameters(
			array(
				'data' => new external_value(PARAM_RAW, 'return complete data', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * Returns description of update_lesson_quiz_attempt()
	 * @return external_description
	 */
	public static function update_lesson_quiz_attempt_returns() {
		return new external_function_parameters(
			array(
				'data' => new external_value(PARAM_RAW, 'return complete data', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * Returns description of save_lesson_quiz_attempt()
	 * @return external_description
	 */
	public static function save_lesson_quiz_attempt_returns() {
		return new external_function_parameters(
			array(
				'status' => new external_value(PARAM_BOOL, 'status true/false', VALUE_REQUIRED),
				'attemptid' => new external_value(PARAM_INT, 'complete data return', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * Returns description of get_questions_data_common()
	 * @return external_description
	 */
	public static function get_questions_data_common_returns() {
		return new external_function_parameters(
			array(
				'data' => new external_value(PARAM_RAW, 'complete data return', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * Returns description of enrol_user_incourse()
	 * @return external_description
	 */
	public static function enrol_user_incourse_returns() {
		return new external_function_parameters(
			array(
				'status' => new external_value(PARAM_BOOL, 'status true/false', VALUE_REQUIRED),
				'message' => new external_value(PARAM_TEXT, 'usre message', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * Returns description of get_activities_data()
	 * @return external_description
	 */
	public static function get_activities_data_returns() {
		return new external_function_parameters(
			array(
				'data' => new external_value(PARAM_RAW, 'complete data return', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * Returns description of check_user_enrolled_incourse()
	 * @return external_description
	 */
	public static function check_user_enrolled_incourse_returns() {
		return new external_function_parameters(
			array(
				'status' => new external_value(PARAM_BOOL, 'status true/false', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * Returns description of get_course_image_url()
	 * @return external_description
	 */
	public static function get_course_image_url_returns() {
		return new external_function_parameters(
			array(
				'url' => new external_value(PARAM_RAW, 'url return', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * Returns description of get_comman_data()
	 * @return external_description
	 */
	public static function get_comman_data_returns() {
		return new external_function_parameters(
			array(
				'data' => new external_value(PARAM_RAW, 'complete data return', VALUE_REQUIRED),
			)
		);
	}


	/**
	 * Returns description of login_user()
	 * @return external_description
	 */
	public static function login_user_returns() {
		return new external_function_parameters(
			array(
				'id' => new external_value(PARAM_INT, 'user id', VALUE_REQUIRED),
				'confirmed' => new external_value(PARAM_INT, 'confirmed user', VALUE_REQUIRED),
				'deleted' => new external_value(PARAM_INT, 'deleted user', VALUE_REQUIRED),
				'suspended' => new external_value(PARAM_INT, 'suspended ', VALUE_REQUIRED),
				'password' => new external_value(PARAM_TEXT, 'password user', VALUE_REQUIRED),
				'timecreated' => new external_value(PARAM_TEXT, 'timecreated user', VALUE_REQUIRED),
				'firstaccess' => new external_value(PARAM_TEXT, 'firstaccess user', VALUE_REQUIRED),
				'lastaccess' => new external_value(PARAM_TEXT, 'lastaccess user', VALUE_REQUIRED),
				'lastlogin' => new external_value(PARAM_TEXT, 'lastlogin user', VALUE_REQUIRED),
				'lang' => new external_value(PARAM_TEXT, 'lang user', VALUE_REQUIRED),
				'interest' => new external_value(PARAM_TEXT, 'interest user', VALUE_REQUIRED),
				'username' => new external_value(PARAM_TEXT, 'username filter', VALUE_REQUIRED),
				'email' => new external_value(PARAM_TEXT, 'email filter', VALUE_REQUIRED),
				'country' => new external_value(PARAM_TEXT, 'country data', VALUE_REQUIRED),
				'timezone' => new external_value(PARAM_TEXT, 'timezone data', VALUE_REQUIRED),
				'firstname' => new external_value(PARAM_TEXT, 'firstname data', VALUE_REQUIRED),
				'lastname' => new external_value(PARAM_TEXT, 'lastname data', VALUE_REQUIRED),
				'alternatename' => new external_value(PARAM_TEXT, 'alternatename data', VALUE_REQUIRED),
				'institution' => new external_value(PARAM_TEXT, 'institution data', VALUE_REQUIRED),
				'department' => new external_value(PARAM_TEXT, 'department data', VALUE_REQUIRED),
				'description' => new external_value(PARAM_TEXT, 'description data', VALUE_REQUIRED),
				'url' => new external_value(PARAM_TEXT, 'url data', VALUE_REQUIRED),
				'phone1' => new external_value(PARAM_TEXT, 'phone1 data', VALUE_REQUIRED),
				'phone2' => new external_value(PARAM_TEXT, 'phone2 user', VALUE_REQUIRED),
				'city' => new external_value(PARAM_TEXT, 'city filter', VALUE_REQUIRED),
				'address' => new external_value(PARAM_TEXT, 'address filter', VALUE_REQUIRED),
				'skype' => new external_value(PARAM_TEXT, 'skype data', VALUE_REQUIRED),
				'lastip' => new external_value(PARAM_TEXT, 'lastip data', VALUE_REQUIRED),
			)
		);
	}

	/**
	 * Returns description of get_users() result value
	 * @return external_description
	 */
	public static function get_users_returns() {
		return new external_multiple_structure(
			new external_single_structure(
				array(
					'id' => new external_value(PARAM_INT, 'User ID'),
					'username' => new external_value(PARAM_TEXT, 'Username'),
					'firstname' => new external_value(PARAM_TEXT, 'First name'),
					'lastname' => new external_value(PARAM_TEXT, 'Last name'),
					'email' => new external_value(PARAM_TEXT, 'Email address'),
					'idnumber' => new external_value(PARAM_TEXT, 'idnumber', VALUE_OPTIONAL),
				)
			)
		);
	}

	/**
	 * Returns description of get_courses_category()
	 * @return external_description
	 */
	public static function get_courses_category_returns() {
		return new external_function_parameters(
			array(
				'content' => new external_value(PARAM_RAW, 'content string'),
				'arid' => new external_value(PARAM_INT, 'arid depth'),
				'name' => new external_value(PARAM_TEXT, 'name'),
				'course' => new external_value(PARAM_INT, 'course'),
				'section' => new external_value(PARAM_INT, 'section'),
			)
		);
	}

	/**
	 * Returns description of get_courses() result value
	 * @return external_description
	 */
	public static function get_courses_returns() {
		return new external_multiple_structure(
			new external_single_structure(
				array(
					'id' => new external_value(PARAM_INT, 'User ID'),
					'fullname' => new external_value(PARAM_TEXT, 'Username'),
					'shortname' => new external_value(PARAM_TEXT, 'First name'),
					'summary' => new external_value(PARAM_TEXT, 'Last name'),
					'categoryid' => new external_value(PARAM_INT, 'Email address'),
					'visible' => new external_value(PARAM_INT, 'idnumber', VALUE_OPTIONAL),
				)
			)
		);
	}

	/**
	 * Returns description of get_section_ar() result value
	 * @return external_description
	 */
	public static function get_section_ar_returns() {
		return new external_multiple_structure(
			new external_single_structure(
				array(
					'id' => new external_value(PARAM_INT, 'Page ID'),
					'arid' => new external_value(PARAM_INT, 'AR  ID'),
					'name' => new external_value(PARAM_TEXT, 'AR name'),
					'course' => new external_value(PARAM_INT, 'course  ID'),
				)
			)
		);
	}

	/**
	 * Returns description of create_ar() result value
	 * @return external_description
	 */
	public static function create_ar_returns() {
		return new external_single_structure(
			array(
				'status' => new external_value(PARAM_BOOL, 'Success status'),
				'arid' => new external_value(PARAM_INT, 'Created AR ID'),
				'module_id' => new external_value(PARAM_INT, 'module_id  ID'),
				'course' => new external_value(PARAM_INT, 'course  ID'),
				'message' => new external_value(PARAM_TEXT, 'Status message'),
			)
		);
	}

	/**
	 * Returns description of create_questions() result value
	 * @return external_description
	 */
	public static function create_questions_returns() {
		return new external_single_structure(

			array(
				'status' => new external_value(PARAM_BOOL, 'Success status'),
				'questions' => new external_multiple_structure(
					new external_single_structure(
						array(
							'questionid' => new external_value(PARAM_INT, 'questionid'),
							'course' => new external_value(PARAM_INT, 'course'),
							'quiz' => new external_value(PARAM_INT, 'quiz'),
							'conceptid' => new external_value(PARAM_INT, 'conceptid'),
							'is_pronunciation' => new external_value(PARAM_INT, 'is_pronunciation'),
							'difficulty' => new external_value(PARAM_INT, 'difficulty'),
							'ques_sequence_id' => new external_value(PARAM_TEXT, 'ques_sequence_id'),
							'answers' => new external_multiple_structure(
								new external_single_structure(
									array(
										'questionid' => new external_value(PARAM_INT, 'questionid'),
										'answerid' => new external_value(PARAM_INT, 'answerid'),
									)
								),
								'List of answers',
								VALUE_OPTIONAL
							)
						)
					),
				),
				'message' => new external_value(PARAM_TEXT, 'Status message'),
			)


		);
	}
	/**
	 * Returns description of get_questions_by_quiz() result value
	 * @return external_description
	 */
	public static function get_questions_by_quiz_returns() {
		return new external_single_structure(
			//id, answer, fraction
			array(
				'status' => new external_value(PARAM_BOOL, 'Success status'),
				'questions' => new external_multiple_structure(
					new external_single_structure(
						array(
							'id' => new external_value(PARAM_INT, 'questionid'),
							'sectionid' => new external_value(PARAM_INT, 'sectionid'),
							'rightoptionid' => new external_value(PARAM_INT, 'rightoptionid'),
							'qtype' => new external_value(PARAM_TEXT, 'qtype'),
							'category_name' => new external_value(PARAM_TEXT, 'category_name'),
							'unit_name' => new external_value(PARAM_TEXT, 'unit_name'),
							'shuffleanswers' => new external_value(PARAM_INT, 'shuffleanswers'),
							'page' => new external_value(PARAM_TEXT, 'page'),
							'answers' => new external_multiple_structure(
								new external_single_structure(
									array(
										'id' => new external_value(PARAM_INT, 'answerid'),
										'answer' => new external_value(PARAM_TEXT, 'answer_text'),
									)
								),
								'List of answers',
								VALUE_OPTIONAL
							)
						)
					),
				),
				'message' => new external_value(PARAM_TEXT, 'Status message'),
			)


		);
	}

	/**
	 * Returns description of get_sections_course() result value
	 * @return external_description
	 */
	public static function get_sections_course_returns() {
		return new external_multiple_structure(
			new external_single_structure(
				array(
					'id' => new external_value(PARAM_INT, 'Section ID'),
					'name' => new external_value(PARAM_TEXT, 'Section name', VALUE_OPTIONAL),
					'sequence' => new external_value(PARAM_TEXT, 'Comma separated list of activity IDs', VALUE_OPTIONAL),
					'course' => new external_value(PARAM_INT, 'course number'),
					'section' => new external_value(PARAM_INT, 'Section number'),
					'summary' => new external_value(PARAM_TEXT, 'Course summary', VALUE_OPTIONAL),
					'format' => new external_value(PARAM_TEXT, 'Course format', VALUE_OPTIONAL),
				)
			)
		);
	}

	/**
	 * Get users list with filter
	 * @param string $username Username filter
	 * @param string $token Authentication token
	 * @return array Users list
	 */
	public static function get_users($username = '') {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(self::get_users_parameters(), array('username' => $username));

		if (!empty(trim($params['username']))) {
			$sql = "SELECT id, username, firstname, lastname, email, idnumber FROM {user}
                WHERE deleted = 0 AND username != 'guest' AND username LIKE ?";
			$users = $DB->get_records_sql($sql, ['%' . $params['username'] . '%']);
		} else {
			$sql = "SELECT id, username, firstname, lastname, email, idnumber FROM {user}
                WHERE deleted = 0 AND username != 'guest'  ";
			$users = $DB->get_records_sql($sql);
		}

		return array_values($users);
	}

	/**
	 * Get all courses
	 * @param string $category category filter
	 * @param string $token Authentication token
	 * @return array Courses list
	 */
	public static function get_courses_category($pageid, $sectionid) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(
			self::get_courses_category_parameters(),
			array('pageid' => $pageid, 'sectionid' => $sectionid)
		);


		$pageid = $params['pageid'];
		$sectionid = $params['sectionid'];
		if (!empty($sectionid)) {
			$sql = "SELECT cm.id as arid, p.content,p.name , cm.course , cm.section
            FROM {course_modules} cm
            JOIN {modules} m ON cm.module = m.id
            JOIN {page} p ON cm.course = p.course
                AND cm.instance = p.id
            WHERE p.id = :pageid
                AND cm.section = :section
                AND cm.deletioninprogress = '0'
                AND m.name = 'page'";

			$paramsss = [
				'section' => $sectionid,
				'pageid' => $pageid
			];
		} else {
			$sql = "SELECT cm.id as arid, p.content,p.name , cm.course , cm.section
            FROM {course_modules} cm
            JOIN {modules} m ON cm.module = m.id
            JOIN {page} p ON cm.course = p.course
                AND cm.instance = p.id
            WHERE p.id = :pageid
                AND cm.deletioninprogress = '0'
                AND m.name = 'page'";

			$paramsss = [
				'pageid' => $pageid
			];
		}



		$page_data = $DB->get_record_sql($sql, $paramsss);
		$course = $section = $arid = 0;
		$name = $text = '';
		if (!empty($page_data)) {
			$text .= $page_data->content . "\n";
			$arid = $page_data->arid;
			$name = $page_data->name;
			$course = $page_data->course;
			$section = $page_data->section;
		}
		$return_data = ['content' => $text, 'arid' => $arid, 'name' => $name, 'course' => $course, 'section' => $section];
		return $return_data;
	}

	/**
	 * Get all courses
	 * @param string $token Authentication token
	 * @return array Courses list
	 */
	public static function get_courses() {
		global $DB;

		// Get visible courses
		$sql = "SELECT id, fullname, shortname, summary, category as categoryid, visible FROM {course}
                WHERE category != 0 AND  visible = 1 ";
		$courses = $DB->get_records_sql($sql);


		return array_values($courses);
	}

	/**
	 * Get AR of sections
	 * @param int $sectionid Section ID
	 * @param string $token Authentication token
	 * @return array AR data
	 */
	public static function get_section_ar($sectionid) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(
			self::get_section_ar_parameters(),
			array('sectionid' => $sectionid)
		);

		$sectionid = $params['sectionid'];
		if (!empty($sectionid)) {

			$sql = "SELECT id,course FROM {course_sections}  WHERE id = ? ";
			$section_data = $DB->get_record_sql($sql, ['id' => $sectionid]);

			$sql = "SELECT cm.id as arid, p.id, p.name,cm.course
            FROM {course_modules} cm
            JOIN {modules} m ON cm.module = m.id
            JOIN {page} p ON cm.course = p.course
                AND cm.instance = p.id
            WHERE cm.course = :course
                AND cm.section = :section
                AND cm.deletioninprogress = '0'
                AND m.name = 'page'";

			$params = [
				'course' => $section_data->course,
				'section' => $section_data->id
			];

			$records = $DB->get_records_sql($sql, $params);
		} else {

			$sql = "SELECT cm.id as arid, p.id, p.name,cm.course
            FROM {course_modules} cm
            JOIN {modules} m ON cm.module = m.id
            JOIN {page} p ON cm.course = p.course
                AND cm.instance = p.id
            WHERE   cm.deletioninprogress = '0'
                AND m.name = 'page'";

			$records = $DB->get_records_sql($sql);
		}



		return array_values($records);
	}

	/**
	 * Create AR
	 * @param int $sectionid Section ID
	 * @param string $ardata AR Data
	 * @param string $token Authentication token
	 * @return array Status and created AR ID
	 */
	public static function create_ar($sectionid, $ardata, $dbtable, $timelimit, $moduleid = 0) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(
			self::create_ar_parameters(),
			array('sectionid' => $sectionid, 'ardata' => $ardata, 'dbtable' => $dbtable, 'timelimit' => $timelimit, 'moduleid' => $moduleid)
		);


		$sectionid  = $section_id = $params['sectionid'];
		$data = json_decode($params['ardata']);
		$table = $params['dbtable'];
		$timelimit  = $params['timelimit'];
		$moduleid  = $params['moduleid'];

		try {

			if (!empty($moduleid)) {
				// Replace Laravel query with Moodle plugin query
				$DB->update_record($dbtable, (object)array_merge(['id' => $moduleid], (array)$data));

				return array(
					'status' => true,
					'arid' => 1,
					'module_id' => $moduleid,
					'course' => 1,
					'message' => 'AR created successfully'
				);
			}

			$sql = "SELECT id,course,sequence FROM {course_sections}  WHERE id = ? ";
			$section_data = $DB->get_record_sql($sql, ['id' => $sectionid]);

			$course = $section_data->course;
			$data->course = $course;
			$id = $DB->insert_record($table, (object)$data, true);

			// Get module data
			$sql = "SELECT id FROM {modules}  WHERE name = ? ";
			$module_data = $DB->get_record_sql($sql, ['name' => $table]);

			// Prepare course module data
			$course_module_data = (object)[
				'course' => $course,
				'module' => $module_data->id,
				'instance' => $id,
				'section' => $section_id,
				'added' => time(),
			];

			if ($table == 'quiz') {
				$course_module_data->completion = 2;
				$course_module_data->completiongradeitemnumber = 0;
			}

			// Insert course module
			$arid = $DB->insert_record('course_modules', $course_module_data, true);

			// Update section sequence
			$sequence = !empty($section_data->sequence) ? $section_data->sequence . ',' . $arid : $arid;

			$DB->set_field('course_sections', 'sequence', $sequence, ['id' => $section_id]);

			if ($table == 'quiz') {
				if (!empty($timelimit)) {
					$DB->set_field($table, 'timelimit', $timelimit, ['id' => $id]);
				}

				// Insert quiz section
				$quiz_section_data = (object)[
					'quizid' => $id,
					'firstslot' => 1,
					'heading' => '',
					'shufflequestions' => 0
				];
				$DB->insert_record('quiz_sections', $quiz_section_data);

				// Handle grade categories
				$sql = "SELECT id,courseid FROM {grade_categories}  WHERE courseid = ? ";
				$grade_category = $DB->get_record_sql($sql, ['courseid' => $course]);

				if (!empty($grade_category)) {
					$grade_category_id = $grade_category->id;
				} else {
					$grade_cat_data = (object)[
						'courseid' => $course,
						'parent' => null,
						'depth' => '1',
						'path' => '',
						'fullname' => '?',
						'aggregation' => '13',
						'keephigh' => '0',
						'droplow' => '0',
						'aggregateonlygraded' => '1',
						'aggregateoutcomes' => '0',
						'timecreated' => time(),
						'timemodified' => time(),
						'hidden' => '0'
					];

					$grade_category_id = $DB->insert_record('grade_categories', $grade_cat_data, true);
					$DB->set_field('grade_categories', 'path', '/' . $grade_category_id . '/', ['id' => $grade_category_id]);
				}

				// Insert grade items
				$grade_arr = (object)[
					'courseid' => $course,
					'categoryid' => $grade_category_id,
					'itemname' => $data->name,
					'itemtype' => 'mod',
					'itemmodule' => 'quiz',
					'iteminstance' => $id,
					'itemnumber' => '0',
					'gradetype' => 0,
					'grademax' => '40.00000',
					'grademin' => '0.00000',
					'gradepass' => '40.00000',
					'multfactor' => '1.00000',
					'plusfactor' => '0.00000',
					'aggregationcoef' => '0.00000',
					'aggregationcoef2' => '0.01538',
					'sortorder' => 2,
					'display' => 0,
					'hidden' => 0,
					'locked' => 0,
					'locktime' => 0,
					'needsupdate' => 0,
					'weightoverride' => 0,
					'timecreated' => time(),
					'timemodified' => time()
				];

				// Check and create course grade item if needed
				$course_grades = $DB->get_record('grade_items', ['courseid' => $course, 'itemtype' => 'course']);
				if (empty($course_grades)) {
					$grade_course_arr = (object)(array)$grade_arr;
					$grade_course_arr->itemmodule = null;
					$grade_course_arr->itemname = null;
					$grade_course_arr->categoryid = null;
					$grade_course_arr->itemtype = 'course';
					$grade_course_arr->iteminstance = $grade_category_id;
					$grade_course_arr->sortorder = 1;

					$DB->insert_record('grade_items', $grade_course_arr);
				}

				$item_id_last = $DB->insert_record('grade_items', $grade_arr, true);

				// Insert grade grades
				$grade_grade_data = (object)[
					'itemid' => $item_id_last,
					'userid' => '2',
					'rawgrademax' => '40.00000',
					'rawgrademin' => '0.00000',
					'hidden' => 0,
					'locked' => 0,
					'locktime' => 0,
					'exported' => 0,
					'overridden' => 0,
					'excluded' => 0,
					'feedback' => '',
					'feedbackformat' => 0,
					'information' => '',
					'informationformat' => 0,
					'aggregationstatus' => 'novalue',
					'aggregationweight' => '0.00000'
				];

				$DB->insert_record('grade_grades', $grade_grade_data);
			}

			return array(
				'status' => true,
				'arid' => $arid,
				'module_id' => $id,
				'course' => $course,
				'message' => 'AR created successfully'
			);
		} catch (\Exception $e) {
			return array(
				'status' => false,
				'arid' => 0,
				'module_id' => 0,
				'course' => 0,
				'message' => $e->getMessage()
			);
		}
	}

	public static function get_moodle_version() {

		global $DB;
		$moodle_ver = $DB->get_record('config', [
			'name' => 'version'
		]);
		$version = $moodle_ver->value;
		return $version;
	}

	public static function create_module_context($course_id, $activity_id) {
		global $DB;

		// Get course context first
		$course_context = $DB->get_record('context', [
			'instanceid' => $course_id,
			'contextlevel' => '50'
		]);

		if (empty($course_context)) {
			// Create course context if needed
			$course_context = self::create_course_context($course_id);
		}

		// Create module context
		$context_data = [
			'contextlevel' => '70',
			'instanceid' => $activity_id,
			'path' => $course_context->path,
			'locked' => 0,
			'depth' => '4'
		];

		$context_id = $DB->insert_record('context', (object)$context_data, true);

		// Update path
		$DB->set_field(
			'context',
			'path',
			$course_context->path . '/' . $context_id,
			['id' => $context_id]
		);

		return $DB->get_record('context', ['id' => $context_id]);
	}

	public static function create_question_answer($question_id, $answer_text, $correct_answer, $ques_type) {
		global $DB;

		$answer_data = [
			'question' => $question_id,
			'answer' => '',
			'answerformat' => '1',
			'feedback' => ' ',
			'feedbackformat' => '1',
			'fraction' => ($answer_text == $correct_answer || $ques_type == 'shortanswer') ? '1.0' : '0.0'
		];

		$answer_id = $DB->insert_record('question_answers', (object)$answer_data, true);

		// Update with template tags
		$update_data = [
			'id' => $answer_id,
			'answer' => '{{LEELOOLXP_ANSWER_TEXT_' . $answer_id . '}}',
			'feedback' => '{{LEELOOLXP_ANSWER_FEEDBACK_' . $answer_id . '}}'
		];
		$DB->update_record('question_answers', (object)$update_data);

		if ($ques_type == 'truefalse') {
			self::handle_truefalse_answer($question_id, $answer_id, $answer_text);
		}

		return [
			'questionid' => $question_id,
			'answerid' => $answer_id,
		];
	}

	public static function update_quiz_grades($quiz_id) {
		global $DB;

		$sum = $DB->get_field_sql(
			"SELECT SUM(maxmark) FROM {quiz_slots} WHERE quizid = ?",
			[$quiz_id]
		);

		if ($sum) {
			$DB->set_field('quiz', 'sumgrades', $sum, ['id' => $quiz_id]);
		}
	}

	public static function create_course_context($course_id) {
		global $DB;

		// Get course category context first
		$course_data = $DB->get_record('course', ['id' => $course_id]);
		$category_context = $DB->get_record('context', [
			'instanceid' => $course_data->category,
			'depth' => '2',
			'contextlevel' => '40'
		]);

		if (empty($category_context)) {
			$category_context = $DB->get_record('context', [
				'instanceid' => $course_data->category,
				'depth' => '2'
			]);
		}

		// Create course context
		$context_data = [
			'contextlevel' => '50',
			'instanceid' => $course_id,
			'path' => '/1/' . $category_context->id,
			'locked' => 0,
			'depth' => '3'
		];

		$context_id = $DB->insert_record('context', (object)$context_data, true);

		// Update path
		$DB->set_field(
			'context',
			'path',
			'/1/' . $category_context->id . '/' . $context_id,
			['id' => $context_id]
		);

		return $DB->get_record('context', ['id' => $context_id]);
	}

	public static function handle_truefalse_answer($question_id, $answer_id, $answer_text) {
		global $DB;

		$existing_tf = $DB->get_record('question_truefalse', ['question' => $question_id]);

		$tf_data = ['question' => $question_id];
		if (strtolower($answer_text) == "true") {
			$tf_data['trueanswer'] = $answer_id;
		} else {
			$tf_data['falseanswer'] = $answer_id;
		}

		if ($existing_tf) {
			$tf_data['id'] = $existing_tf->id;
			$DB->update_record('question_truefalse', (object)$tf_data);
		} else {
			$DB->insert_record('question_truefalse', (object)$tf_data);
		}
	}

	public static function create_question_category($context_id, $quiz_id) {
		global $DB;

		$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'lms.tblue.io';
		$quiz = $DB->get_record('quiz', ['id' => $quiz_id]);
		$info_text = "The default category for questions shared in context '$quiz->name'.";

		// Create top category
		$top_category = [
			'name' => 'top',
			'contextid' => $context_id,
			'info' => $info_text,
			'infoformat' => 0,
			'stamp' => $host . '+' . rand() . '+' . substr(md5(microtime()), rand(0, 26), 6),
			'parent' => 0,
			'sortorder' => 0,
			'idnumber' => null
		];

		$top_id = $DB->insert_record('question_categories', (object)$top_category, true);

		// Create default category
		$default_category = [
			'name' => 'Default for ' . $quiz->name,
			'contextid' => $context_id,
			'info' => $info_text,
			'infoformat' => 0,
			'stamp' => $host . '+' . rand() . '+' . substr(md5(microtime()), rand(0, 26), 6),
			'parent' => $top_id,
			'sortorder' => 999,
			'idnumber' => null
		];

		$default_id = $DB->insert_record('question_categories', (object)$default_category, true);

		return $DB->get_record('question_categories', ['id' => $default_id]);
	}

	public static function create_quiz_slot($quiz_id, $question_id, $context_id, $category_id, $user_id, $moodle_version) {
		global $DB;

		// Get last slot number
		$last_slot = $DB->get_record_sql(
			"SELECT page FROM {quiz_slots} WHERE quizid = ? ORDER BY id DESC LIMIT 1",
			[$quiz_id]
		);

		$slot_number = 1;
		if ($last_slot) {
			$slot_number = $last_slot->page + 1;
		}

		// Create slot
		$slot_data = [
			'slot' => $slot_number,
			'quizid' => $quiz_id,
			'page' => $slot_number,
			'requireprevious' => 0,
			'maxmark' => '1.0000000'
		];

		if ($moodle_version < 2022020200.01) {
			$slot_data['questionid'] = $question_id;
			$slot_data['questioncategoryid'] = null;
			$slot_data['includingsubcategories'] = null;
		}

		$slot_id = $DB->insert_record('quiz_slots', (object)$slot_data, true);

		// Handle newer Moodle versions
		if ($moodle_version > 2022020200.01) {
			// Create question bank entry
			$bank_data = [
				'questioncategoryid' => $category_id,
				'idnumber' => null,
				'ownerid' => $user_id
			];
			$bank_id = $DB->insert_record('question_bank_entries', (object)$bank_data, true);

			// Create question version
			$version_data = [
				'questionbankentryid' => $bank_id,
				'version' => 1,
				'questionid' => $question_id,
				'status' => 'ready'
			];
			$DB->insert_record('question_versions', (object)$version_data);

			// Create question reference
			$ref_data = [
				'usingcontextid' => $context_id,
				'component' => 'mod_quiz',
				'questionarea' => 'slot',
				'itemid' => $slot_id,
				'questionbankentryid' => $bank_id
			];
			$DB->insert_record('question_references', (object)$ref_data);
		}

		return $slot_id;
	}

	/**
	 * Create questions
	 * @param int $sectionid Section ID
	 * @param string $questions Questions Data
	 * @param string $token Authentication token
	 * @return array Status and created question IDs
	 */
	public static function create_questions($params, $questions) {
		global $DB;

		// Parameters validation
		$parameters = self::validate_parameters(
			self::create_questions_parameters(),
			array('params' => $params, 'questions' => $questions)
		);
		$questions_data = json_decode($parameters['questions'], true);
		$questions_data = json_decode($questions_data, true);
		$params = json_decode($parameters['params'], true);

		try {
			$params = (array)$params;

			$activityid = $params['activityid'];
			$course_id = $params['course_id'];
			$quizid = $params['quizid'];
			$questions_count = (int)$params['questions_count'];
			$conceptid = $params['conceptid'];
			$ques_type = $params['ques_type'];
			$is_pronunciation = $params['is_pronunciation'];
			$ques_sequence_id = $params['ques_sequence_id'];
			$difficulty = $params['difficulty'];

			$moodle_version = self::get_moodle_version();
			$userid = '2';
			$questions_return['questions'] = [];
			$ques_type_count = 0;

			// Normalize questions data
			$questions_data = (array)$questions_data;
			if (!empty($questions_data['questions'])) {
				$questions_data_temp = $questions_data['questions'];
				$questions_data = [];
				$questions_data = $questions_data_temp;
			}
			if (is_array($questions_data) && !empty($questions_data['question'])) {
				$questions_data[0] = $questions_data;
			}


			foreach ($questions_data as $key => $question) {
				$question = (array)$question;
				$question = array_change_key_case($question, CASE_LOWER);
				$question = (object)$question;

				// Handle true/false and shortanswer questions
				if ($ques_type == 'truefalse' || $ques_type == 'shortanswer') {
					$options = ["true", "false"];
					if ($ques_type == 'shortanswer' && isset($question->correctanswer)) {
						$options = [$question->correctanswer];
					}
					$question->options = $options;
				}

				// Handle sequence ID
				if (!empty($ques_sequence_id) && !empty($ques_type_count)) {
					$arr_seq = explode('_', $ques_sequence_id);
					$prev_seq_num = (int)$arr_seq[3];
					$prev_seq_num++;
					$ques_sequence_id = $arr_seq[0] . '_' . $arr_seq[1] . '_' . $arr_seq[2] . '_' . $prev_seq_num;
				}

				// Validate question data
				if (
					$ques_type_count < $questions_count &&
					!empty($question->options) &&
					!empty($question->correctanswer)
				) {

					if (isset($question->conceptid) && !empty($question->conceptid)) {
						$conceptid = $question->conceptid;
					}

					$ques_type_count++;

					// Clean up special characters
					$question->correctanswer = str_replace('≛', '=', $question->correctanswer);

					// Get or create context
					$context_data = $DB->get_record('context', [
						'instanceid' => $activityid,
						'contextlevel' => '70'
					]);

					if (empty($context_data)) {
						// Create module context
						$context_data = self::create_module_context($course_id, $activityid);
					}

					// Get or create question category
					$qc_data = $DB->get_records(
						'question_categories',
						['contextid' => $context_data->id],
						'id DESC',
						'*',
						0,
						1
					);
					$qc_data = reset($qc_data);

					if (empty($qc_data)) {
						$qc_data = self::create_question_category($context_data->id, $quizid);
					}

					// Create question
					$question_data = (object)[
						'penalty' => ($ques_type == 'truefalse') ? '1.0000000' : '0.3333333',
						'defaultmark' => '1',
						'qtype' => $ques_type,
						'name' => '{{LEELOOLXP_QUESTION_TEXT_temp}}',
						'questiontext' => '{{LEELOOLXP_QUESTION_TEXT_temp}}',
						'questiontextformat' => 1,
						'generalfeedback' => '{{LEELOOLXP_QUESTION_FEEDBACK_temp}}',
						'generalfeedbackformat' => 1,
						'length' => '1',
						'stamp' => '1',
						'timecreated' => time(),
						'timemodified' => time(),
						'createdby' => $userid,
						'modifiedby' => $userid
					];

					if ($moodle_version < 2022020200.01) {
						$question_data->category = $qc_data->id;
						$question_data->version = '1';
						$question_data->hidden = '0';
					}

					$mqid = $DB->insert_record('question', $question_data, true);

					// Update question with real IDs
					$update_question = [
						'name' => '{{LEELOOLXP_QUESTION_TEXT_' . $mqid . '}}',
						'questiontext' => '{{LEELOOLXP_QUESTION_TEXT_' . $mqid . '}}',
						'generalfeedback' => '{{LEELOOLXP_QUESTION_FEEDBACK_' . $mqid . '}}'
					];
					$DB->update_record('question', (object)array_merge(['id' => $mqid], $update_question));

					// Handle question type specific options
					if ($ques_type == 'shortanswer') {
						$DB->insert_record('qtype_shortanswer_options', [
							'questionid' => $mqid,
							'usecase' => 1
						]);
					} elseif ($ques_type == 'multichoice') {
						$multichoice_options = [
							'questionid' => $mqid,
							'layout' => 0,
							'single' => 1,
							'shuffleanswers' => 1,
							'correctfeedback' => 'Your answer is correct.',
							'correctfeedbackformat' => 1,
							'partiallycorrectfeedback' => 'Your answer is partially correct.',
							'partiallycorrectfeedbackformat' => 1,
							'incorrectfeedback' => 'Your answer is incorrect.',
							'incorrectfeedbackformat' => 1,
							'answernumbering' => 'abc',
							'shownumcorrect' => 1,
							'showstandardinstruction' => 1
						];
						$DB->insert_record('qtype_multichoice_options', $multichoice_options);
					}

					// Create quiz slot
					$slot = self::create_quiz_slot($quizid, $mqid, $context_data->id, $qc_data->id, $userid, $moodle_version);

					// Store local question data
					$local_question_data = [
						'questionid' => $mqid,
						'course' => $course_id,
						'quiz' => $quizid,
						'conceptid' => $conceptid,
						'is_pronunciation' => $is_pronunciation,
						'difficulty' => $difficulty,
						'ques_sequence_id' => $ques_sequence_id,
					];

					$questions_return['questions'][$mqid] = $local_question_data;

					// Handle answers
					if (!empty($question->options)) {
						foreach ($question->options as $value_answer) {
							if ($value_answer !== '' && $value_answer !== null) {
								$value_answer = str_replace('≛', '=', $value_answer);

								$answer_data = self::create_question_answer(
									$mqid,
									$value_answer,
									$question->correctanswer,
									$ques_type
								);

								$questions_return['questions'][$mqid]['answers'][] = $answer_data;
							}
						}
					}

					// Update quiz grades
					self::update_quiz_grades($quizid);
				}
			}

			return array(
				'status' => true,
				'questions' => $questions_return['questions'],
				'message' => 'Questions created successfully'
			);
		} catch (\Exception $e) {
			return array(
				'status' => false,
				'questions' => [],
				'message' => $e->getMessage()
			);
		}
	}

	/**
	 * Create questions
	 * @param string $params params Data
	 * @param string $questions Questions token
	 * @return array multiple questions
	 */
	public static function get_questions_by_quiz($params, $qtype) {
		global $DB;

		// Parameters validation
		$parameters = self::validate_parameters(
			self::get_questions_by_quiz_parameters(),
			array('params' => $params, 'qtype' => $qtype)
		);
		$qtype = json_decode($parameters['qtype'], true);
		$params_arr = json_decode($parameters['params'], true);

		try {
			$quizid = $params_arr['quizid'];
			$limit = $params_arr['limit'];
			$questionid_arr = [];
			if (isset($params_arr['questionids']))
				$questionid_arr = explode(',', $params_arr['questionids']);


			if (empty($qtype))
				$qtype = ['multichoice', 'shortanswer', 'truefalse'];
			$moodleversion = self::get_moodle_version();
			$qtypesql = $DB->get_in_or_equal($qtype, SQL_PARAMS_NAMED, 'qtype');
			$params = [
				'quizid' => $quizid
			];

			if (!empty($questionid_arr)) {
				$params = array_merge(
					$questionid_arr, // For IN clause of question IDs
					$qtype,          // For IN clause of question types
					[$quizid]     // For quiz ID
				);
				if ($moodleversion < 2022020200.01) {
					$sql = "SELECT q.id, cs.id as sectionid, q.questiontext, q.generalfeedback,
                   	q.qtype, cc.name as category_name, cs.name as unit_name,
                	qz.shuffleanswers, qs.page
					FROM {question} q
					JOIN {quiz_slots} qs ON qs.questionid = q.id
					JOIN {quiz} qz ON qz.id = qs.quizid
					JOIN {course} c ON c.id = qz.course
					JOIN {course_categories} cc ON cc.id = c.category
					JOIN {course_modules} cm ON cm.instance = qz.id AND cm.course = qz.course
					JOIN {course_sections} cs ON cs.id = cm.section
					WHERE q.id IN (" . implode(',', array_fill(0, count($questionid_arr), '?')) . ")
					AND q.qtype IN (" . implode(',', array_fill(0, count($qtype), '?')) . ")
					AND qz.id = ?
					GROUP BY q.id
					ORDER BY FIELD(q.id, " . implode(',', $questionid_arr) . ")
					LIMIT 10";
				} else {
					$sql = "SELECT q.id, cs.id as sectionid, q.questiontext, q.generalfeedback,
                   q.qtype, cc.name as category_name, cs.name as unit_name,
                   qz.shuffleanswers, qs.page
					FROM {quiz_slots} qs
					JOIN {question_references} qr ON qr.itemid = qs.id
					JOIN {question_bank_entries} qbe ON qbe.id = qr.questionbankentryid
					JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
					JOIN {question} q ON q.id = qv.questionid
					JOIN {quiz} qz ON qz.id = qs.quizid
					JOIN {course} c ON c.id = qz.course
					JOIN {course_categories} cc ON cc.id = c.category
					JOIN {course_modules} cm ON cm.instance = qz.id AND cm.course = qz.course
					JOIN {course_sections} cs ON cs.id = cm.section
					WHERE q.id IN (" . implode(',', array_fill(0, count($questionid_arr), '?')) . ")
					AND q.qtype IN (" . implode(',', array_fill(0, count($qtype), '?')) . ")
					AND qz.id = ?
					GROUP BY q.id
					ORDER BY q.id ASC
					LIMIT 10";
				}

				$questions = $DB->get_records_sql($sql, $params);
			} else {

				if ($moodleversion < 2022020200.01) {
					$sql = "SELECT DISTINCT q.id, cs.id as sectionid, q.qtype, cc.name as category_name,
					cs.name as unit_name, qz.shuffleanswers, qs.page
					FROM {question} q
					JOIN {quiz_slots} qs ON qs.questionid = q.id
					JOIN {quiz} qz ON qz.id = qs.quizid
					JOIN {course} c ON c.id = qz.course
					JOIN {course_categories} cc ON cc.id = c.category
					JOIN {course_modules} cm ON cm.instance = qz.id AND cm.course = qz.course
					JOIN {course_sections} cs ON cs.id = cm.section
					WHERE qz.id = :quizid
					AND q.qtype {$qtypesql[0]}
					GROUP BY q.id
					ORDER BY RAND()";
				} else {
					$sql = "SELECT DISTINCT q.id, cs.id as sectionid, q.qtype, cc.name as category_name,
					cs.name as unit_name, qz.shuffleanswers, qs.page
					FROM {quiz_slots} qs
					JOIN {question_references} qr ON qr.itemid = qs.id
					JOIN {question_bank_entries} qbe ON qbe.id = qr.questionbankentryid
					JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
					JOIN {question} q ON q.id = qv.questionid
					JOIN {quiz} qz ON qz.id = qs.quizid
					JOIN {course} c ON c.id = qz.course
					JOIN {course_categories} cc ON cc.id = c.category
					JOIN {course_modules} cm ON cm.instance = qz.id AND cm.course = qz.course
					JOIN {course_sections} cs ON cs.id = cm.section
					WHERE qz.id = :quizid
					AND q.qtype {$qtypesql[0]}
					GROUP BY q.id
					ORDER BY RAND()";
				}
				$params = array_merge($params, $qtypesql[1]);

				// Add LIMIT if specified
				if ($limit)
					$sql .= " LIMIT " . (int)$limit;

				$questions = $DB->get_records_sql($sql, $params);
			}

			$processed_questions = array();
			foreach ($questions as $question) {
				// Get question answers
				$options_sql = "SELECT id, answer, fraction
                       FROM {question_answers}
                       WHERE question = :questionid";
				$options = $DB->get_records_sql($options_sql, ['questionid' => $question->id]);

				$processed_options = array();
				foreach ($options as $option) {
					$option->answer = strip_tags($option->answer);

					if ($option->fraction == 1) {
						$question->rightoptionid = $option->id;
					}

					unset($option->fraction);
					$processed_options[] = (array)$option;
				}
				$question->answers = $processed_options;
				$question->is_pronunciation = 0;
				$question->conceptid = 0;
				$question->example = '';
				$question->questiontext = strip_tags($question->questiontext);
				$question->generalfeedback = strip_tags($question->generalfeedback);

				// Shuffle options
				shuffle($processed_options);
				$question->options = $processed_options;

				// Add liked status
				$question->liked_status = '';

				$processed_questions[] = $question;
			}

			return array(
				'status' => true,
				'questions' => $processed_questions,
				'message' => 'Questions created successfully'
			);
		} catch (\Exception $e) {
			return array(
				'status' => false,
				'questions' => [],
				'message' => $e->getMessage()
			);
		}
	}

	/**
	 * Get sections of the course
	 * @param int $courseid courseid
	 * @param string $type type
	 * @param int $sectionid Section ID
	 * @param string $token Authentication token
	 * @return array Status and created question IDs
	 */
	public static function get_sections_course($courseid, $type, $sectionid) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(
			self::get_sections_course_parameters(),
			array('courseid' => $courseid, 'type' => $type, 'sectionid' => $sectionid)
		);


		$sectionid = $params['sectionid'];
		$type = $params['type'];
		$courseid = $params['courseid'];
		$select_columns = 'cs.id, cs.section, cs.name, cs.sequence,cs.course, cs.summary';
		$sql = "SELECT format FROM {course}  WHERE id = ? ";
		$course_data = $DB->get_record_sql($sql, ['id' => $courseid]);
		$type_data = 'section';
		if ($course_data->format != 'flexsections' && $type !== 'sectionsonly') {
			$type_data = 'ars';
			$sql = "SELECT id,section,name,sequence,course,summary FROM {course_sections}  WHERE course = :course and section != 0 ";
			$records = $DB->get_records_sql($sql, ['course' => $courseid]);
		} elseif ($type === 'section') {

			$sql = "SELECT {$select_columns}
                FROM {course_sections} cs
                LEFT JOIN {course_format_options} cfo
                    ON cfo.sectionid = cs.id
                    AND cfo.name = 'parent'
                    AND cfo.value = '0'
                WHERE cs.course = :courseid
                    AND cfo.value = '0'
                ORDER BY cs.section ASC";

			$params = ['courseid' => $courseid];

			$records = $DB->get_records_sql($sql, $params);
		} elseif ($type === 'sectionsonly') {
			$sql = "SELECT id,section,name,sequence,course,summary FROM {course_sections}  WHERE id = :id ";
			$records = $DB->get_records_sql($sql, ['id' => $sectionid]);
		} else {
			// Assuming GetCommonTableData is available in your plugin
			$sql = "SELECT section FROM {course_sections}  WHERE id = ? ";
			$section_data = $DB->get_record_sql($sql, ['id' => $sectionid]);

			$sql = "SELECT {$select_columns}
                FROM {course_sections} cs
                JOIN {course_format_options} cfo
                    ON cfo.sectionid = cs.id
                    AND cfo.name = 'parent'
                    AND cfo.value = :section
                WHERE cs.course = :courseid
                ORDER BY cs.section ASC";

			$params = [
				'courseid' => $courseid,
				'section' => $section_data->section
			];

			$records = $DB->get_records_sql($sql, $params);
		}

		foreach ($records as $record) {
			$record->format = $course_data->format;
		}
		return array_values($records);
	}

	/**
	 * login user
	 * @param string $username Username filter
	 * @param string $token Authentication token
	 * @return array Users data
	 */
	public static function login_user($username, $userid = 0) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(self::login_user_parameters(), array('username' => $username, 'userid' => $userid));
		$username = $params['username'];
		$userid = $params['userid'];

		if (!empty($userid)) {
			$sql = "SELECT id,confirmed,deleted,suspended,password,timecreated,firstaccess,lang,username,email,country,timezone,
			lastaccess,lastlogin,firstname,lastname,alternatename,institution,department,description,url,phone1,phone2,city,address,skype,lastip
			FROM {user}
			WHERE id = :id";

			$params = ['id' => $userid];
		} else {
			$sql = "SELECT id,confirmed,deleted,suspended,password,timecreated,firstaccess,lang,username,email,country,timezone,
			lastaccess,lastlogin,firstname,lastname,alternatename,institution,department,description,url,phone1,phone2,city,address,skype,lastip
			FROM {user}
			WHERE username = :username
			OR email = :email";

			$params = ['username' => $username, 'email' => $username];
		}



		$user = $DB->get_record_sql($sql, $params);
		$user = (array)$user;

		if (!empty($user) && !empty($user['id'])) {
			$sql = "SELECT GROUP_CONCAT({$DB->get_prefix()}tag.name) as names
			FROM {tag_instance}
			JOIN {tag} ON {tag}.id = {tag_instance}.tagid
			WHERE {tag_instance}.itemid = :itemid
			AND {tag_instance}.itemtype = :itemtype
			AND {tag_instance}.contextid = :contextid";

			$params = [
				'itemid' => $user['id'],
				'itemtype' => 'user',
				'contextid' => 30
			];

			$tag_instance = $DB->get_record_sql($sql, $params);
			if (!empty($tag_instance)) {
				$user['interest'] = $tag_instance->names;
			} else {
				$user['interest'] = '';
			}
		}

		return $user;
	}

	/**
	 * get comman data
	 * @param string $username Username filter
	 * @param string $token Authentication token
	 * @return array Users data
	 */
	public static function get_comman_data($table, $id, $column, $condition) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(self::get_comman_data_parameters(), array('table' => $table, 'id' => $id, 'column' => $column, 'condition' => $condition));

		$table = $params['table'];
		$id = $params['id'];
		$column = $params['column'];
		$condition = $params['condition'];
		$table = '{' . $table . '}';

		if ($condition == 'wherein') {
			//$sql = "SELECT * FROM {$table} WHERE id IN (:id)";
			//$params = ['id' => $id];
			//$user = $DB->get_records_sql($sql, $params);

			$ids = explode(',', $id);
			// Create placeholders for each ID
			list($sqlin, $sqlparams) = $DB->get_in_or_equal($ids, SQL_PARAMS_NAMED, 'id');
			$sql = "SELECT * FROM $table WHERE id $sqlin";
			$user = $DB->get_records_sql($sql, $sqlparams);
		} else {
			$sql = "SELECT * FROM $table WHERE $column = :id ";
			$params = ['id' => $id];
			$user = $DB->get_record_sql($sql, $params);
		}

		$user = (array)$user;

		$data['data'] = json_encode($user);
		return $data;
	}

	/**
	 * get course image url
	 * @param string $username Username filter
	 * @param string $token Authentication token
	 * @return array Users data
	 */
	public static function get_course_image_url($defaulturl, $courseid) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(self::get_course_image_url_parameters(), array('defaulturl' => $defaulturl, 'courseid' => $courseid));

		$defaulturl = $params['defaulturl'];
		$courseid = $params['courseid'];


		$sql = "SELECT id FROM {context} WHERE instanceid = :instanceid AND contextlevel = '50' ";
		$params = ['instanceid' => $courseid];
		$context = $DB->get_record_sql($sql, $params);
		if (!$context) {
			return ['url' => $defaulturl];
		}
		$sql = "SELECT id FROM {files} WHERE contextid = :contextid AND component = 'course' AND filearea = 'overviewfiles' and filename != '.' ";
		$params = ['contextid' => $context->id];
		$file = $DB->get_record_sql($sql, $params);

		if (!$file) {
			return ['url' => $defaulturl];
		}
		$url = "/pluginfile.php/{$context->id}/course/overviewfiles/{$file->filename}";
		return ['url' => $url];
	}


	/**
	 * check user enrolled incourse
	 * @param string $username Username filter
	 * @param string $token Authentication token
	 * @return array Users data
	 */
	public static function check_user_enrolled_incourse($userid, $courseid, $type = 'enrol') {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(self::check_user_enrolled_incourse_parameters(), array('userid' => $userid, 'courseid' => $courseid, 'type' => $type));

		$userid = $params['userid'];
		$courseid = $params['courseid'];
		$type = $params['type'];
		if ($type == 'enrol') {

			$sql = "SELECT id FROM {enrol} WHERE courseid = :courseid AND enrol = 'manual' ";
			$params = ['courseid' => $courseid];
			$enrol_data = $DB->get_record_sql($sql, $params);


			$sql = "SELECT id FROM {user_enrolments} WHERE enrolid = :enrolid AND userid = :userid ";
			$params = ['enrolid' => $enrol_data->id, 'userid' => $userid];
			$isEnrolled = $DB->record_exists_sql($sql, $params);
		} else {

			$sql = "SELECT id FROM {course_modules_completion} WHERE coursemoduleid = :coursemoduleid AND userid = :userid AND completionstate = '1' ";
			$params = ['coursemoduleid' => $courseid, 'userid' => $userid];
			$isEnrolled = $DB->record_exists_sql($sql, $params);
		}

		if ($isEnrolled)
			return ['status' => true];

		return ['status' => false];
	}

	/**
	 * get activities data
	 * @param string $username Username filter
	 * @param string $token Authentication token
	 * @return array Users data
	 */
	public static function get_activities_data($sequence, $type, $quiz_types) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(self::get_activities_data_parameters(), array('sequence' => $sequence, 'type' => $type, 'quiz_types' => $quiz_types));

		$sequence = $params['sequence'];
		$type = $params['type'];
		$sort_order_data = json_decode($params['quiz_types'], true);

		$sequence_arr = explode(',', $sequence);

		$return_ars = [];
		$last_quiz_type = '';
		$final_activities = [];

		foreach ($sequence_arr as $key => $arid) {
			$sql = "SELECT m.name, cm.instance, cm.visible
			FROM {course_modules} cm
			JOIN {modules} m ON m.id = cm.module
			WHERE cm.id = :arid
			AND cm.deletioninprogress = :deletion";

			$params = [
				'arid' => $arid,
				'deletion' => '0'
			];

			$course_module = $DB->get_record_sql($sql, $params);

			if (!empty($course_module) && !empty($module_name) && $module_name != $course_module->name) {
				$course_module = [];
			}
			if (!empty($course_module) && !empty($course_module->name) && !empty($course_module->instance)) {

				$table = '{' . $course_module->name . '}';
				$sql = "SELECT * FROM $table WHERE id = :id  ";
				$params = ['id' => $course_module->instance];
				$activity = $DB->get_record_sql($sql, $params);


				$activity->originalid = $activity->id;
				$activity->id = $arid;
				$activity->sectionid = '';
				$activity->module_name = $course_module->name;
				$activity->visible = $course_module->visible;
				$activity->vive_exist = false;

				$data_added = 0;

				if ($data_added == 0) {
					$sort_order_data['remianing_data'][] = $activity;
				}
			}
		}

		foreach ($sort_order_data as $key_quiz => $value_quiz) {
			if (!empty($value_quiz)) {

				foreach ($value_quiz as $key_quiz_child => $value_quiz_child) {

					if (!empty($value_quiz)) {

						if (!empty($value_quiz_child->quiztype)) {
							$value_quiz_child->skip_quiz = 0;
							if ($last_quiz_type == $value_quiz_child->quiztype) {
								$value_quiz_child->skip_quiz = 1;
							}
							$last_quiz_type = $value_quiz_child->quiztype;
						}

						$return_ars[] = $value_quiz_child;
					}
				}
			}
		}
		$data['data'] = json_encode($return_ars);
		return $data;
	}


	/**
	 * enrol user in course
	 * @param string $username Username filter
	 * @param string $token Authentication token
	 * @return array Users data
	 */
	public static function enrol_user_incourse($userid, $courseid, $roleid) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(self::enrol_user_incourse_parameters(), array('userid' => $userid, 'courseid' => $courseid, 'roleid' => $roleid));

		$userid = $params['userid'];
		$courseid = $params['courseid'];
		$roleid = $params['roleid'];

		$sql = "SELECT id FROM {enrol} WHERE courseid = :courseid AND enrol = 'manual' ";
		$params = ['courseid' => $courseid];
		$enrol_data = $DB->get_record_sql($sql, $params);

		if (empty($enrol_data)) {
			return ['status' => false, 'message' => 'Enrollment method not found for the course.'];
		}

		$sql = "SELECT id FROM {user_enrolments} WHERE enrolid = :enrolid AND userid = :userid ";
		$params = ['enrolid' => $enrol_data->id, 'userid' => $userid];
		$isEnrolled = $DB->record_exists_sql($sql, $params);

		if ($isEnrolled) {
			return ['status' => false, 'message' => 'User is already enrolled in the course.'];
		}


		$data['enrolid'] = $enrol_data->id;
		$data['userid'] = $userid;
		$id = $DB->insert_record('user_enrolments', (object)$data, true);

		$contextid = $DB->get_field('context', 'id', [
			'instanceid' => $courseid,
			'contextlevel' => CONTEXT_COURSE
		]);

		$record = new stdClass();
		$record->roleid = $roleid;
		$record->contextid = $contextid;
		$record->userid = $userid;
		$record->timemodified = time();

		$DB->insert_record('role_assignments', $record);

		return ['status' => true, 'message' => 'User enrolled successfully.'];
	}

	/**
	 * get questions data common
	 * @param string $username Username filter
	 * @param string $token Authentication token
	 * @return array Users data
	 */
	public static function get_questions_data_common($userid, $quizid, $type, $lang = 'en') {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(self::get_questions_data_common_parameters(), array('userid' => $userid, 'quizid' => $quizid, 'type' => $type, 'lang' => $lang));

		$userid = $params['userid'];
		$quizid = $params['quizid'];
		$type = $params['type'];
		$lang = $params['lang'];
		$uniqueidData = [];
		$question_attempts = [];
		$return = [];
		if ($type == 'uniqueidData') {
			$sql = "SELECT uniqueid,attempt FROM {quiz_attempts} WHERE quiz = :quizid AND userid = :userid ";
			$params = ['quizid' => $quizid, 'userid' => $userid];
			$uniqueidData = $DB->get_record_sql($sql, $params);

			if (!empty($uniqueidData)) {
				$sql = "SELECT GROUP_CONCAT(uniqueid) as uniqueids FROM {quiz_attempts} WHERE quiz = :quizid AND userid = :userid ";
				$params = ['quizid' => $quizid, 'userid' => $userid];
				$uniqueidData2 = $DB->get_record_sql($sql, $params);
				$uniqueids_arr = explode(',', $uniqueidData2->uniqueids);

				list($uniqueids_sql, $params) = $DB->get_in_or_equal($uniqueids_arr, SQL_PARAMS_NAMED, 'uniqueid');

				$sql = "SELECT qa.id, qa.slot, qa.questionsummary, qa.questionid, q.qtype
				FROM {question_attempts} qa
				JOIN {question} q ON q.id = qa.questionid
				JOIN {quiz_attempts} qza ON qza.uniqueid = qa.questionusageid
				WHERE qa.questionusageid $uniqueids_sql
				ORDER BY qa.id ASC";

				$question_attempts = $DB->get_records_sql($sql, $params);
			}
			$return = [
				'uniqueidData' => $uniqueidData,
				'question_attempts' => $question_attempts,
			];
		} elseif ($type == 'step_data') {


			// Query for 'todo' state
			$sql_todo = "SELECT qsd.value
             FROM {question_attempt_steps} qas
             JOIN {question_attempt_step_data} qsd ON qas.id = qsd.attemptstepid
             WHERE qas.questionattemptid = :questionattemptid_todo
             AND qas.state = :state_todo";

			$params_todo = [
				'questionattemptid_todo' => $quizid,
				'state_todo' => 'todo'
			];

			$question_attempt_step_data_todo = $DB->get_record_sql($sql_todo, $params_todo);

			// Query for 'complete' state
			$sql_complete = "SELECT qsd.value
                 FROM {question_attempt_steps} qas
                 JOIN {question_attempt_step_data} qsd ON qas.id = qsd.attemptstepid
                 WHERE qas.questionattemptid = :questionattemptid_complete
                 AND qas.state = :state_complete";

			$params_complete = [
				'questionattemptid_complete' => $quizid,
				'state_complete' => 'complete'
			];

			$question_attempt_step_data_complete = $DB->get_record_sql($sql_complete, $params_complete);

			$return = [
				'step_data_todo' => $question_attempt_step_data_todo,
				'step_data_complete' => $question_attempt_step_data_complete,
			];
		} elseif ($type == 'lang') {
			$DB->set_field(
				'user',
				'lang',
				$lang,
				['id' => $userid]
			);
		} else {


			$params = [
				'quiz' => 'quiz',    // For modules.name = 'quiz'
				'quizid' => $quizid, // For quiz.id = $quizid
				'userid' => $userid  // For course_modules_completion.userid
			];

			$sql = "SELECT cm.id as course_module_id,
                q.id as quiz_id,
                q.name as quiz_name,
                FIND_IN_SET(cm.id, cs.sequence) as module_order
				FROM {course_sections} cs
				JOIN {course_modules} cm ON FIND_IN_SET(cm.id, cs.sequence) > 0
				JOIN {quiz} q ON q.id = cm.instance
				LEFT JOIN {course_modules_completion} cmc ON cmc.coursemoduleid = cm.id
					AND cmc.userid = :userid
				JOIN {modules} m ON m.id = cm.module AND m.name = :quiz
				WHERE q.id = :quizid
				AND (cmc.completionstate IS NULL OR cmc.completionstate = 0)
				ORDER BY cs.section,
                 FIND_IN_SET(cm.id, cs.sequence)";

			$result = $DB->get_record_sql($sql, $params);

			$return = $result;
		}



		return ['data' => json_encode($return)];
	}

	/**
	 * save lesson quiz attempt
	 * @param string $username Username filter
	 * @param string $token Authentication token
	 * @return array Users data
	 */
	public static function save_lesson_quiz_attempt($userid, $questionid, $questionid_str) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(self::save_lesson_quiz_attempt_parameters(), array('userid' => $userid, 'questionid' => $questionid, 'questionid_str' => $questionid_str));

		$userid = $params['userid'];
		$questionid = $params['questionid'];
		$questionid_str = $params['questionid_str'];

		$questionid_arr = explode(',', $questionid_str);
		$moodleversion = self::get_moodle_version();

		// Get quiz data based on Moodle version
		if ($moodleversion < 2022020200.01) {
			$sql = "SELECT q.id as quizid, cm.id as arid, ctx.id as contextid, q.preferredbehaviour
                FROM {question} que
                JOIN {question_categories} qc ON qc.id = que.category
                JOIN {context} ctx ON ctx.id = qc.contextid
                JOIN {course_modules} cm ON cm.id = ctx.instanceid
                JOIN {modules} m ON m.id = cm.module
                JOIN {quiz} q ON q.id = cm.instance
                JOIN {quiz_slots} qs ON qs.quizid = q.id
                JOIN {course} c ON c.id = q.course
                WHERE que.id = ?
                AND qs.questionid = ?
                AND m.name = ?";
			$params = [$questionid, $questionid, 'quiz'];
		} else {
			$sql = "SELECT q.id as quizid, cm.id as arid, ctx.id as contextid, q.preferredbehaviour
                FROM {question} que
                JOIN {question_versions} qv ON que.id = qv.questionid
                JOIN {question_bank_entries} qbe ON qv.questionbankentryid = qbe.id
                JOIN {question_references} qr ON qbe.id = qr.questionbankentryid
                JOIN {quiz_slots} qs ON qr.itemid = qs.id
                JOIN {question_categories} qc ON qc.id = qbe.questioncategoryid
                JOIN {context} ctx ON ctx.id = qc.contextid
                JOIN {course_modules} cm ON cm.id = ctx.instanceid
                JOIN {modules} m ON m.id = cm.module
                JOIN {quiz} q ON q.id = cm.instance
                JOIN {course} c ON c.id = q.course
                WHERE que.id = ?
                AND m.name = ?";
			$params = [$questionid, 'quiz'];
		}

		$quizData = $DB->get_record_sql($sql, $params);
		if (empty($quizData)) {
			return [
				'status' => false,
				'attemptid' => 0
			];
		}

		// Get context data
		$contextData = $DB->get_record('context', [
			'instanceid' => $quizData->arid,
			'contextlevel' => 70
		], 'id');
		$quizData->contextid = $contextData->id;

		// Get slot data based on Moodle version
		if ($moodleversion < 2022020200.01) {
			$sql = "SELECT page, questionid
                FROM {quiz_slots}
                WHERE quizid = ?
                AND questionid IN (" . implode(',', array_fill(0, count($questionid_arr), '?')) . ")
                ORDER BY id ASC";
		} else {
			$sql = "SELECT qs.page, qv.questionid
                FROM {quiz_slots} qs
                JOIN {question_references} qr ON qr.itemid = qs.id
                JOIN {question_bank_entries} qbe ON qbe.id = qr.questionbankentryid
                JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
                WHERE qs.quizid = ?
                AND qv.questionid IN (" . implode(',', array_fill(0, count($questionid_arr), '?')) . ")
                ORDER BY qs.id ASC";
		}

		$params = array_merge([$quizData->quizid], $questionid_arr);
		$slotData = $DB->get_records_sql($sql, $params);

		// Build layout string
		$layout = '';
		foreach ($slotData as $slot) {
			$layout = empty($layout) ? $slot->page . ',0' : $layout . ',' . $slot->page . ',0';
		}

		// Get attempt number
		$attempt = $DB->get_field_sql(
			"SELECT attempt
         FROM {quiz_attempts}
         WHERE quiz = ? AND userid = ?
         ORDER BY uniqueid DESC
         LIMIT 1",
			[$quizData->quizid, $userid]
		);
		$attempt = empty($attempt) ? 1 : $attempt + 1;

		// Insert question usage
		$questionusage = new stdClass();
		$questionusage->contextid = $quizData->contextid;
		$questionusage->component = 'mod_quiz';
		$questionusage->preferredbehaviour = $quizData->preferredbehaviour;
		$questionusagesid = $DB->insert_record('question_usages', $questionusage);

		// Insert quiz attempt
		$quizattempt = new stdClass();
		$quizattempt->quiz = $quizData->quizid;
		$quizattempt->userid = $userid;
		$quizattempt->attempt = $attempt;
		$quizattempt->uniqueid = $questionusagesid;
		$quizattempt->layout = $layout;
		$quizattempt->currentpage = 0;
		$quizattempt->preview = 0;
		$quizattempt->state = 'inprogress';
		$quizattempt->timestart = time();
		$quizattempt->timefinish = 0;
		$quizattempt->timemodified = time();
		$quizattempt->timemodifiedoffline = 0;
		$quizattempt->timecheckstate = null;
		$quizattempt->sumgrades = null;
		$quiz_attempts_id = $DB->insert_record('quiz_attempts', $quizattempt);

		// Insert question attempts and steps
		foreach ($slotData as $slot) {
			// Insert question attempt
			$questionattempt = new stdClass();
			$questionattempt->questionusageid = $questionusagesid;
			$questionattempt->slot = $slot->page;
			$questionattempt->behaviour = $quizData->preferredbehaviour;
			$questionattempt->questionid = $slot->questionid;
			$questionattempt->variant = 1;
			$questionattempt->maxmark = 1.0000000;
			$questionattempt->minfraction = 0.0000000;
			$questionattempt->maxfraction = 1.0000000;
			$questionattempt->flagged = 0;
			$questionattempt->questionsummary = ' : ; ; ; ';
			$questionattempt->rightanswer = '1';
			$questionattempt->responsesummary = null;
			$questionattempt->timemodified = time();
			$questionattemptid = $DB->insert_record('question_attempts', $questionattempt);

			// Insert attempt step
			$attemptstep = new stdClass();
			$attemptstep->questionattemptid = $questionattemptid;
			$attemptstep->sequencenumber = 0;
			$attemptstep->state = 'todo';
			$attemptstep->fraction = null;
			$attemptstep->timecreated = time();
			$attemptstep->userid = $userid;
			$attemptstepid = $DB->insert_record('question_attempt_steps', $attemptstep);

			// Get answer IDs
			$answers = $DB->get_records('question_answers', ['question' => $slot->questionid], '', 'id');
			$value = !empty($answers) ? implode(',', array_keys($answers)) : '1';

			// Insert step data
			$stepdata = new stdClass();
			$stepdata->attemptstepid = $attemptstepid;
			$stepdata->name = '_order';
			$stepdata->value = $value;
			$DB->insert_record('question_attempt_step_data', $stepdata);
		}

		return [
			'status' => true,
			'attemptid' => $quiz_attempts_id
		];
	}

	/**
	 * update lesson quiz attempt
	 * @param string $username Username filter
	 * @param string $token Authentication token
	 * @return array Users data
	 */
	public static function update_lesson_quiz_attempt($userid, $questionid, $attemptid, $selectedoptionid, $assessment) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(self::update_lesson_quiz_attempt_parameters(), array('userid' => $userid, 'questionid' => $questionid, 'attemptid' => $attemptid, 'selectedoptionid' => $selectedoptionid, 'assessment' => $assessment));

		$userid = $params['userid'];
		$questionid = $params['questionid'];
		$attemptid = $params['attemptid'];
		$selectedoptionid = $params['selectedoptionid'];
		$assessment = $params['assessment'];

		$sql = "SELECT id, name, questiontext , qtype FROM {question} WHERE id = :questionid ";
		$params = ['questionid' => $questionid];
		$question = $DB->get_record_sql($sql, $params);

		$questionsorder = '';
		$sql = "SELECT id, answer, fraction FROM {question_answers} WHERE question = :questionid ";
		$params = ['questionid' => $questionid];
		$options = $DB->get_records_sql($sql, $params);
		$question->questionsummary = $question->questiontext . '
                ';
		if (!empty($options)) {
			foreach ($options as $key_opt => $value_opt) {
				if (empty($key_opt)) {
					$question->questionsummary .= ': ' . strip_tags($value_opt->answer) . '
                            ';
				} else {
					$question->questionsummary .= '; ' . strip_tags($value_opt->answer) . '
                            ';
				}
				if ($questionsorder == '') {
					$questionsorder = $value_opt->id;
				} else {
					$questionsorder .= ',' . $value_opt->id;
				}
			}
		}

		$selectedoption = 0;
		$questionsummary = $question->questionsummary;
		$questionsorder_arr = explode(',', $questionsorder);
		foreach ($questionsorder_arr as $key => $valueidd) {
			if ($valueidd == $selectedoptionid) {
				$selectedoption = $key;
			}
		}

		$moodleversion = self::get_moodle_version();


		if ($moodleversion < 2022020200.01) {
			$sql = "SELECT q.id as quizid, cm.id as arid, ctx.id as contextid, q.preferredbehaviour
            FROM {question} que
            JOIN {question_categories} qc ON qc.id = que.category
            JOIN {context} ctx ON ctx.id = qc.contextid
            JOIN {course_modules} cm ON cm.id = ctx.instanceid
            JOIN {modules} m ON m.id = cm.module
            JOIN {quiz} q ON q.id = cm.instance
            JOIN {quiz_slots} qs ON qs.quizid = q.id
            JOIN {course} c ON c.id = q.course
            WHERE que.id = ?
            AND qs.questionid = ?
            AND m.name = ?";

			$quizData = $DB->get_record_sql($sql, [$questionid, $questionid, 'quiz']);
		} else {
			$sql = "SELECT q.id as quizid, cm.id as arid, ctx.id as contextid, q.preferredbehaviour
            FROM {question} que
            JOIN {question_versions} qv ON que.id = qv.questionid
            JOIN {question_bank_entries} qbe ON qv.questionbankentryid = qbe.id
            JOIN {question_references} qr ON qbe.id = qr.questionbankentryid
            JOIN {quiz_slots} qs ON qr.itemid = qs.id
            JOIN {question_categories} qc ON qc.id = qbe.questioncategoryid
            JOIN {context} ctx ON ctx.id = qc.contextid
            JOIN {course_modules} cm ON cm.id = ctx.instanceid
            JOIN {modules} m ON m.id = cm.module
            JOIN {quiz} q ON q.id = cm.instance
            JOIN {course} c ON c.id = q.course
            WHERE que.id = ?
            AND m.name = ?";

			$quizData = $DB->get_record_sql($sql, [$questionid, 'quiz']);
		}

		// Get question usages
		$sql = "SELECT id
        FROM {question_usages}
        WHERE contextid = ?
        AND component = ?
        AND preferredbehaviour = ?
        ORDER BY id DESC";

		$question_usages = $DB->get_record_sql($sql, [$quizData->contextid, 'mod_quiz', $quizData->preferredbehaviour]);
		$questionusagesid = $question_usages->id;

		// Get quiz attempts
		$quiz_attempts = $DB->get_record('quiz_attempts', ['id' => $attemptid], 'currentpage, uniqueid');
		$currentpage = $quiz_attempts->currentpage;

		// Update question attempts
		$DB->update_record('question_attempts', (object)[
			'id' => $questionusagesid,
			'questionsummary' => $questionsummary
		], ['questionid' => $questionid]);


		// Get question attempts id
		$sql = "SELECT qas.id as stepid, qasd.id as stepdataid
        FROM {question_attempts} qa
        JOIN {question_attempt_steps} qas ON qa.id = qas.questionattemptid
        JOIN {question_attempt_step_data} qasd ON qas.id = qasd.attemptstepid
        WHERE qa.questionusageid = ?
        AND qa.questionid = ?
        AND qas.state = ?";

		$question_attempts_data = $DB->get_record_sql($sql, [$questionusagesid, $questionid, 'todo']);

		// Update question attempt step data using its id
		if (!empty($question_attempts_data)) {
			$DB->update_record('question_attempt_step_data', (object)[
				'id' => $question_attempts_data->stepdataid,
				'value' => $questionsorder
			]);
		}

		// Get question attempts
		$question_attempts = $DB->get_record(
			'question_attempts',
			['questionusageid' => $questionusagesid, 'questionid' => $questionid],
			'id, slot'
		);
		$questionattemptid = $question_attempts->id;

		// Update current page if needed
		if ($question_attempts->slot > $currentpage) {
			$currentpage++;
			$DB->update_record('quiz_attempts', (object)[
				'id' => $attemptid,
				'currentpage' => $currentpage,
				'timemodified' => time()
			]);
		}


		// Get question attempt steps
		$question_attempt_steps = $DB->get_record(
			'question_attempt_steps',
			['questionattemptid' => $questionattemptid, 'state' => 'complete'],
			'id'
		);

		$attemptstepid = 0;
		if (!empty($question_attempt_steps)) {
			$attemptstepid = $question_attempt_steps->id;
		} elseif ($assessment == "right") {
			$record = new stdClass();
			$record->questionattemptid = $questionattemptid;
			$record->sequencenumber = 1;
			$record->state = 'complete';
			$record->fraction = null;
			$record->timecreated = time();
			$record->userid = $userid;

			$attemptstepid = $DB->insert_record('question_attempt_steps', $record);
		}

		// Get question attempt step data
		$question_attempt_step_data = $DB->get_record(
			'question_attempt_step_data',
			['attemptstepid' => $attemptstepid, 'name' => 'answer'],
			'id'
		);

		if (empty($question_attempt_step_data) && ($assessment == "right")) {
			$record = new stdClass();
			$record->attemptstepid = $attemptstepid;
			$record->name = 'answer';
			$record->value = $selectedoption;

			$DB->insert_record('question_attempt_step_data', $record);
		}

		$return = ['status' => 'success'];


		return ['data' => json_encode($return)];
	}

	/**
	 * submit lesson quiz attempt
	 * @param string $username Username filter
	 * @param string $token Authentication token
	 * @return array Users data
	 */
	public static function submit_lesson_quiz_attempt($userid, $attemptid) {
		global $DB;

		// Parameters validation
		$params = self::validate_parameters(self::submit_lesson_quiz_attempt_parameters(), array('userid' => $userid, 'attemptid' => $attemptid));

		$userid = $params['userid'];
		$attemptid = $params['attemptid'];

		$result = [
			'total_questions' => '0',
			'attempted_questions' => '0',
			'right_questions' => '0',
			'score' => '0',
			'total_time' => '0',
		];
		// Get quiz attempts
		$quiz_attempts = $DB->get_record(
			'quiz_attempts',
			['id' => $attemptid],
			'currentpage, uniqueid, quiz, timestart, timefinish, attempt'
		);
		$currentpage = $quiz_attempts->currentpage;
		$currentpage++;

		$attempt_last = (int)$quiz_attempts->attempt;

		// Get total questions count
		$result['total_questions'] = $DB->count_records('quiz_slots', ['quizid' => $quiz_attempts->quiz]);

		// Get question attempts
		$question_attempts = $DB->get_records(
			'question_attempts',
			['questionusageid' => $quiz_attempts->uniqueid],
			'id ASC',
			'id, slot, questionsummary, questionid'
		);

		// Get grade items
		$grade_items = $DB->get_record(
			'grade_items',
			[
				'itemtype' => 'mod',
				'itemmodule' => 'quiz',
				'iteminstance' => $quiz_attempts->quiz
			],
			'id, gradepass,courseid'
		);

		$sumgrades = '0.0000000';
		$garde_percentage = $totalgrades = '0.0000000';

		$attempted_questions_count = 0;
		$right_questions_count = 0;

		if (!empty($question_attempts)) {
			foreach ($question_attempts as $key_slot => $quesatt) {
				$questionattemptid = $quesatt->id;

				// Get todo step data
				$sql = "SELECT qad.value
                FROM {question_attempt_steps} qas
                JOIN {question_attempt_step_data} qad ON qas.id = qad.attemptstepid
                WHERE qas.questionattemptid = ? AND qas.state = ?";
				$question_attempt_step_data_todo = $DB->get_record_sql($sql, [$questionattemptid, 'todo']);

				// Get complete step data
				$question_attempt_step_data_complete = $DB->get_record_sql($sql, [$questionattemptid, 'complete']);

				if (!empty($question_attempt_step_data_complete) && !empty($question_attempt_step_data_todo)) {
					$asnwer_ids_arr = explode(',', $question_attempt_step_data_todo->value);
					$attempted_questions_count++;

					$asnwer_id = $asnwer_ids_arr[$question_attempt_step_data_complete->value];
					$question_answers_fraction = $DB->get_record(
						'question_answers',
						['id' => $asnwer_id],
						'fraction'
					);

					$fraction = '0.0000000';
					if (!empty($question_answers_fraction)) {
						$fraction = $question_answers_fraction->fraction;
					}

					$add_grade_one = '1.0000000';
					$totalgrades = bcadd($add_grade_one, $totalgrades, 7);
					$sumgrades = bcadd($fraction, $sumgrades, 7);

					$grade_state = 'gradedpartial';
					if ($fraction == '0.0000000') {
						$grade_state = 'gradedwrong';
					} elseif ($fraction == '1.0000000') {
						$grade_state = 'gradedright';
						$right_questions_count++;
					}
				} else {
					$add_grade_one = '1.0000000';
					$fraction = '0.0000000';
					$totalgrades = bcadd($add_grade_one, $totalgrades, 7);
					$sumgrades = bcadd($fraction, $sumgrades, 7);

					$grade_state = 'gradedwrong';
				}

				$question_attempt_steps = $DB->get_record(
					'question_attempt_steps',
					[
						'questionattemptid' => $questionattemptid,
						'sequencenumber' => 2
					],
					'id'
				);

				if (!empty($question_attempt_steps)) {
					$attemptstepid = $question_attempt_steps->id;
				} else {
					$record = new stdClass();
					$record->questionattemptid = $questionattemptid;
					$record->sequencenumber = 2;
					$record->state = $grade_state;
					$record->fraction = $fraction;
					$record->timecreated = time();
					$record->userid = $userid;

					$attemptstepid = $DB->insert_record('question_attempt_steps', $record);
				}

				$step_data = new stdClass();
				$step_data->attemptstepid = $attemptstepid;
				$step_data->name = '-finish';
				$step_data->value = '1';
				$DB->insert_record('question_attempt_step_data', $step_data);
			}
		}

		$result['attempted_questions'] = (int)$attempted_questions_count;
		$result['right_questions'] = (int)$right_questions_count;
		$result['score'] = ($result['right_questions'] / $result['total_questions']) * 100;

		// Get all attempts
		$all_attmpts = range(1, $attempt_last);
		$placeholders = str_repeat('?,', count($all_attmpts) - 1) . '?';
		$params = array_merge([$quiz_attempts->quiz, $userid], $all_attmpts);

		$sql = "SELECT GROUP_CONCAT(uniqueid) as uniqueids
        FROM {quiz_attempts}
        WHERE quiz = ? AND userid = ? AND attempt IN ($placeholders)";
		$quiz_attempts_total = $DB->get_record_sql($sql, $params);
		$uniqueid_arr = explode(',', $quiz_attempts_total->uniqueids);

		// Get question attempts for all attempts
		list($insql, $inparams) = $DB->get_in_or_equal($uniqueid_arr);
		$sql = "SELECT id, slot, questionsummary, questionid
        FROM {question_attempts}
        WHERE questionusageid $insql
        ORDER BY id ASC";
		$question_attempts = $DB->get_records_sql($sql, $inparams);

		$right_questions_total = 0;

		if (!empty($question_attempts)) {
			foreach ($question_attempts as $key_slot => $quesatt) {
				$questionattemptid = $quesatt->id;

				// Get todo and complete step data
				$sql = "SELECT qad.value
                FROM {question_attempt_steps} qas
                JOIN {question_attempt_step_data} qad ON qas.id = qad.attemptstepid
                WHERE qas.questionattemptid = ? AND qas.state = ?";

				$question_attempt_step_data_todo = $DB->get_record_sql($sql, [$questionattemptid, 'todo']);
				$question_attempt_step_data_complete = $DB->get_record_sql($sql, [$questionattemptid, 'complete']);

				if (!empty($question_attempt_step_data_todo) && !empty($question_attempt_step_data_complete)) {
					$asnwer_ids_arr = explode(',', $question_attempt_step_data_todo->value);
					$asnwer_id = $asnwer_ids_arr[$question_attempt_step_data_complete->value];

					$question_answers_fraction = $DB->get_record(
						'question_answers',
						['id' => $asnwer_id],
						'fraction'
					);

					if (!empty($question_answers_fraction) && $question_answers_fraction->fraction == '1.0000000') {
						$right_questions_total++;
					}
				}
			}
		}

		$result['right_questions_total'] = (int)$right_questions_total;

		if ($right_questions_total == $result['total_questions']) {
			// Mark quiz completed
			$quizModule = $DB->get_record('modules', ['name' => 'quiz'], 'id');

			$courseSection = $DB->get_record('course_modules', [
				'module' => $quizModule->id,
				'instance' => $quiz_attempts->quiz,
				'course' => $grade_items->courseid
			], 'section, id');

			$course_modules_completion = $DB->get_record('course_modules_completion', [
				'coursemoduleid' => $courseSection->id,
				'userid' => $userid
			], 'id');

			$data = new stdClass();
			$data->coursemoduleid = $courseSection->id;
			$data->userid = $userid;
			$data->completionstate = '1';
			$data->timemodified = time();

			if (empty($course_modules_completion)) {
				$DB->insert_record('course_modules_completion', $data);
			} else {
				$data->id = $course_modules_completion->id;
				$DB->update_record('course_modules_completion', $data);
			}
		}

		// Calculate total time
		$timestamp1 = (int)$quiz_attempts->timestart;
		$timestamp2 = time();
		$timeDifference = $timestamp2 - $timestamp1;
		$formattedTime = gmdate("i:s", $timeDifference);
		$formattedTimeArr = explode(':', $formattedTime);
		$result['total_time'] = $formattedTimeArr[0] . 'm' . $formattedTimeArr[1] . 's';

		// Update attempt data
		$attempt_data = new stdClass();
		$attempt_data->id = $attemptid;
		$attempt_data->state = 'finished';
		$attempt_data->timefinish = time();
		$attempt_data->sumgrades = $sumgrades;
		$attempt_data->timemodified = time();
		$DB->update_record('quiz_attempts', $attempt_data);

		if ($totalgrades != '0.0000000') {
			$garde_percentage = ($sumgrades / $totalgrades) * 100;
		}

		// Handle grades
		$gradeExist = $DB->get_record(
			'grade_grades',
			[
				'userid' => $userid,
				'itemid' => $grade_items->id
			],
			'id'
		);

		$gradeData = new stdClass();
		$gradeData->rawgrade = $garde_percentage;
		$gradeData->rawgrademax = '10.00000';
		$gradeData->rawgrademin = '0.00000';
		$gradeData->usermodified = $userid;
		$gradeData->finalgrade = $garde_percentage;
		$gradeData->timemodified = time();
		$gradeData->aggregationstatus = 'used';
		$gradeData->aggregationweight = '1.00000';

		if (!empty($gradeExist)) {
			$gradeData->id = $gradeExist->id;
			$DB->update_record('grade_grades', $gradeData);
		} else {
			$gradeData->itemid = $grade_items->id;
			$gradeData->userid = $userid;
			$gradeData->rawscaleid = null;
			$gradeData->hidden = '0';
			$gradeData->locked = '0';
			$gradeData->locktime = '0';
			$gradeData->exported = '0';
			$gradeData->overridden = '0';
			$gradeData->excluded = '0';
			$gradeData->feedback = null;
			$gradeData->feedbackformat = '0';
			$gradeData->information = null;
			$gradeData->informationformat = '0';
			$gradeData->timecreated = time();
			$DB->insert_record('grade_grades', $gradeData);
		}

		// Insert quiz grade
		$quiz_grade = new stdClass();
		$quiz_grade->quiz = $quiz_attempts->quiz;
		$quiz_grade->userid = $userid;
		$quiz_grade->grade = $garde_percentage;
		$quiz_grade->timemodified = time();
		$DB->insert_record('quiz_grades', $quiz_grade);

		$return = ['quiz_attempts' => $quiz_attempts, 'result' => $result];


		return ['data' => json_encode($return)];
	}
}
