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
 * External Web Service Template
 *
 * @package local_leeloolxpcontentapi
 * @copyright  2020 Leeloo LXP (https://leeloolxp.com)
 * @author Leeloo LXP <info@leeloolxp.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->libdir . "/externallib.php");

class local_leeloolxpcontentapi_external extends external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function content_plugins_sync_parameters() {
        return new external_function_parameters(
            array(
                'content_plugins_sync' => new external_value(PARAM_RAW, 'Plugin Name', VALUE_DEFAULT, null),
            )
        );
    }

    /**
     * Sync course from Leeloo to Moodle
     * @return string welcome message
     */
    public static function content_plugins_sync($contentplugin = '') {

        global $CFG;
        //Parameter validation
        //REQUIRED
        $params = self::validate_parameters(
            self::content_plugins_sync_parameters(),
            array(
                'content_plugins_sync' => $contentplugin,
            )
        );

        if( $contentplugin == 'thinkblue' ){
            $path = $CFG->dirroot . '/theme/thinkblue/locallib.php';
        }else{
            $path = $CFG->dirroot . '/blocks/' . $contentplugin . '/locallib.php';
        }

        if (!file_exists($path)) {
            return '0';
        }

        require_once($CFG->libdir . '/filelib.php');

        require_once($path);

        if ($contentplugin == 'tb_a_courses') {
            updateconfa_courses();
        } else if ($contentplugin == 'tb_blog') {
            updateconfblog();
        } else if ($contentplugin == 'tb_c_courses') {
            updateconfc_courses();
        } else if ($contentplugin == 'tb_clients') {
            updateconfclients();
        } else if ($contentplugin == 'tb_course_nav') {
            updateconfcourse_nav();
        } else if ($contentplugin == 'tb_f_courses') {
            updateconff_courses();
        } else if ($contentplugin == 'tb_faq') {
            updateconffaq();
        } else if ($contentplugin == 'tb_headings') {
            updateconfheadings();
        } else if ($contentplugin == 'tb_in_courses') {
            updateconfin_courses();
        } else if ($contentplugin == 'tb_latestentry') {
            updateconflatestentry();
        } else if ($contentplugin == 'tb_m_slots') {
            updateconfm_slots();
        } else if ($contentplugin == 'tb_my_courses') {
            updateconfmy_courses();
        } else if ($contentplugin == 'tb_slider') {
            updateconfslider();
        } else if ($contentplugin == 'tb_teachers') {
            updateconfteachers();
        } else if ($contentplugin == 'tb_testimonials') {
            updateconftestimonials();
        } else if ($contentplugin == 'tb_top_cats') {
            updateconftop_cats();
        } else if ($contentplugin == 'tb_up_courses') {
            updateconfup_courses();
        } else if ($contentplugin == 'thinkblue'){
            updateconfthinkblue();
        } else if ($contentplugin == 'leeloo_paid_courses'){
            updateconfpaid_courses();
        } else if ($contentplugin == 'leeloo_subscriptions'){
            updateconfleeloo_subscriptions();
        } else if ($contentplugin == 'leeloo_products'){
            updateconfleeloo_products();
        } else {
            return '0';
        }

        return '1';
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function content_plugins_sync_returns() {
        return new external_value(PARAM_TEXT, 'Returns String');
    }
}
