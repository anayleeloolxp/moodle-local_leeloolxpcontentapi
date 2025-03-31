<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

$functions = array(
	'local_leeloolxpcontentapi_get_sections_course' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'get_sections_course',
		'description' => 'Get sections of the course',
		'type' => 'read',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_get_users' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'get_users',
		'description' => 'Get users list with filter',
		'type' => 'read',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_get_courses_category' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'get_courses_category',
		'description' => 'Get courses hierarchy with categories',
		'type' => 'read',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_get_courses' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'get_courses',
		'description' => 'Get all courses',
		'type' => 'read',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_get_section_ar' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'get_section_ar',
		'description' => 'Get AR of sections',
		'type' => 'read',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_create_ar' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'create_ar',
		'description' => 'Create AR',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_create_questions' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'create_questions',
		'description' => 'Create questions',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_get_questions_by_quiz' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'get_questions_by_quiz',
		'description' => 'Get questions by quizid',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_login_user' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'login_user',
		'description' => 'login user',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_get_comman_data' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'get_comman_data',
		'description' => 'get comman data',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_get_course_image_url' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'get_course_image_url',
		'description' => 'get course image url',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_check_user_enrolled_incourse' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'check_user_enrolled_incourse',
		'description' => 'check user enrolled incourse',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_get_activities_data' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'get_activities_data',
		'description' => 'get activities data',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_enrol_user_incourse' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'enrol_user_incourse',
		'description' => 'enrol user in course',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_get_questions_data_common' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'get_questions_data_common',
		'description' => 'get questions data common',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_save_lesson_quiz_attempt' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'save_lesson_quiz_attempt',
		'description' => 'save lesson quiz attempt',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_update_lesson_quiz_attempt' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'update_lesson_quiz_attempt',
		'description' => 'update lesson quiz attempt',
		'type' => 'write',
		'ajax' => true,
	),
	'local_leeloolxpcontentapi_submit_lesson_quiz_attempt' => array(
		'classname' => 'local_leeloolxpcontentapi_external',
		'methodname' => 'submit_lesson_quiz_attempt',
		'description' => 'submit lesson quiz attempt',
		'type' => 'write',
		'ajax' => true,
	),
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
	'Leeloo LXP Content API Service' => array(
		'functions' => array(
			'local_leeloolxpcontentapi_get_sections_course',
			'local_leeloolxpcontentapi_get_users',
			'local_leeloolxpcontentapi_get_courses_category',
			'local_leeloolxpcontentapi_get_courses',
			'local_leeloolxpcontentapi_get_section_ar',
			'local_leeloolxpcontentapi_create_ar',
			'local_leeloolxpcontentapi_create_questions',
			'local_leeloolxpcontentapi_get_questions_by_quiz',
			'local_leeloolxpcontentapi_login_user',
			'local_leeloolxpcontentapi_get_comman_data',
			'local_leeloolxpcontentapi_get_course_image_url',
			'local_leeloolxpcontentapi_check_user_enrolled_incourse',
			'local_leeloolxpcontentapi_get_activities_data',
			'local_leeloolxpcontentapi_enrol_user_incourse',
			'local_leeloolxpcontentapi_get_questions_data_common',
			'local_leeloolxpcontentapi_save_lesson_quiz_attempt',
			'local_leeloolxpcontentapi_update_lesson_quiz_attempt',
			'local_leeloolxpcontentapi_submit_lesson_quiz_attempt',
		),
		'restrictedusers' => 0,
		'enabled' => 1,
	)
);
