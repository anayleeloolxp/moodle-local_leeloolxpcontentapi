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
 * Local Library file for additional Functions
 *
 * @package    local_leeloolxpcontentapi
 * @copyright  2024 Leeloo LXP (https://leeloolxp.com)
 * @author     Leeloo LXP <info@leeloolxp.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Add Leeloo Icon by js
 */
function local_leeloolxpcontentapi_before_footer() {
    $mootoolsenable = get_config('local_leeloolxpcontentapi')->enable;
    $mootoolsleeloourl = get_config('local_leeloolxpcontentapi')->leeloourl;

    if (isset($_COOKIE['mootools_login_response'])) {
        $mootoolsloginresponse = $_COOKIE['mootools_login_response'];
        $mootoolsloginresponsearr = json_decode($mootoolsloginresponse);
        $mootoolstoken = $mootoolsloginresponsearr->token;
    }

    if ($mootoolsenable && $mootoolsleeloourl && $mootoolstoken) {
        global $USER, $DB;
        if (isloggedin() && !is_siteadmin($USER)) {

            global $PAGE, $CFG;

            $context = $PAGE->context;

            if ($context && $context->contextlevel == CONTEXT_MODULE) {

                $cmid = $context->instanceid;

                $module = get_coursemodule_from_id('', $cmid, 0, false, MUST_EXIST);

                $sectionid = $module->section;
                $courseid = $module->course;

                require_once($CFG->libdir . '/filelib.php');
                $curl = new curl;
                $url = $mootoolsleeloourl . '/api/check_vive_exists';
                $payload = array(
                    'cmid' => $cmid,
                    'sectionid' => $sectionid,
                    'courseid' => $courseid,
                );
                $jsonPayload = json_encode($payload);
                $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $mootoolstoken);
                $result = $curl->post($url, $jsonPayload, array('CURLOPT_HTTPHEADER' => $headers));
                $res_arr = json_decode($result);

                if (isset($res_arr->status) && isset($res_arr->status) != '') {
                    if ($res_arr->status == 'success') {

                        $user_lang = $DB->get_record_sql(
                            'SELECT u.lang AS preferred_language
                             FROM {user} u
                             WHERE u.id = :userid',
                            ['userid' => $USER->id]
                        );

                        if ($user_lang) {
                            $preferred_language = $user_lang->preferred_language;
                        } else {
                            $preferred_language = "";
                        }

                        echo '<div id="leeloolxpcontentapi-js-vars" data-mootoolsleeloourl="' . base64_encode($mootoolsleeloourl) . '" data-mootoolstoken="' . $mootoolstoken . '" data-lang="' . $preferred_language . '" data-cmid="' . $cmid . '" data-sectionid="' . $sectionid . '" data-courseid="' . $courseid . '" data-mootoolsloginresponse="' . base64_encode($mootoolsloginresponse) . '"></div>';

                        $PAGE->requires->js(new moodle_url('/local/leeloolxpcontentapi/js/local_leeloolxpcontentapi.js'));
                        echo '<button id="local_leeloolxpcontentapi_button"><i class="icon fa fa-phone fa-fw"></i></button>';
                        echo '<div class="local_leeloolxpcontentapi_wrapper"><div id="local_leeloolxpcontentapi_wrapper_close">X</div><div id="local_leeloolxpcontentapi_frame"></div></div>';
                    }
                }
            }
        }
    }
}
