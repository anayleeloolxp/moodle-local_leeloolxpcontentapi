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

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . "/externallib.php");

/**
 * API Class for content plugins
 */
class local_leeloolxpcontentapi_external extends external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function content_plugins_sync_parameters() {
        return new external_function_parameters(
            array(
                'content_plugins_sync' => new external_value(PARAM_RAW, 'Plugin Name', VALUE_DEFAULT, null),
                'baseemail' => new external_value(PARAM_RAW, 'Base Email', VALUE_DEFAULT, null),
            )
        );
    }

    /**
     * Sync course from Leeloo to Moodle
     * @param string $contentplugin contentplugin
     * @param string $baseemail baseemail
     * @return string welcome message
     */
    public static function content_plugins_sync($contentplugin = '', $baseemail = '') {

        global $CFG;
        $params = self::validate_parameters(
            self::content_plugins_sync_parameters(),
            array(
                'content_plugins_sync' => $contentplugin,
                'baseemail' => $baseemail,
            )
        );

        if ($contentplugin == 'thinkblue' || $contentplugin == 'gamisync') {
            $path = $CFG->dirroot . '/theme/thinkblue/locallib.php';
        } else {
            $path = $CFG->dirroot . '/blocks/' . $contentplugin . '/locallib.php';
        }

        if (!file_exists($path)) {
            return '0';
        }

        require_once($CFG->libdir . '/filelib.php');

        require_once($path);

        if ($contentplugin == 'tb_blog') {
            block_tb_blog_updateconf();
        } else if ($contentplugin == 'tb_courses') {
            block_tb_courses_updateconf();
        } else if ($contentplugin == 'tb_clients') {
            block_tb_clients_updateconf();
        } else if ($contentplugin == 'tb_course_nav') {
            block_tb_course_nav_updateconf();
        } else if ($contentplugin == 'tb_faq') {
            block_tb_faq_updateconf();
        } else if ($contentplugin == 'tb_headings') {
            block_tb_headings_updateconf();
        } else if ($contentplugin == 'tb_latestentry') {
            block_tb_latestentry_updateconf();
        } else if ($contentplugin == 'tb_m_slots') {
            block_tb_m_slots_updateconf();
        } else if ($contentplugin == 'tb_slider') {
            block_tb_slider_updateconf();
        } else if ($contentplugin == 'tb_teachers') {
            block_tb_teachers_updateconf();
        } else if ($contentplugin == 'tb_testimonials') {
            block_tb_testimonials_updateconf();
        } else if ($contentplugin == 'tb_top_cats') {
            block_tb_top_cats_updateconf();
        } else if ($contentplugin == 'thinkblue') {
            theme_thinkblue_updateconf();
        } else if ($contentplugin == 'leeloo_paid_courses') {
            block_leeloo_paid_courses_updateconf();
        } else if ($contentplugin == 'leeloo_subscriptions') {
            block_leeloo_subscriptions_updateconf();
        } else if ($contentplugin == 'leeloo_products') {
            block_leeloo_products_updateconf();
        } else if ($contentplugin == 'gamisync') {
            theme_thinkblue_gamisync($baseemail);
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
