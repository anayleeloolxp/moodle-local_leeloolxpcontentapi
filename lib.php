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
        global $USER;
        if (isloggedin() && !is_siteadmin($USER)) {

            $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

            // Detect Browser
            if (strpos($userAgent, 'firefox') !== false) {
                $browser = 'Firefox';
            } elseif (strpos($userAgent, 'chrome') !== false) {
                $browser = 'Chrome';
            } elseif (strpos($userAgent, 'safari') !== false) {
                $browser = 'Safari';
            } elseif (strpos($userAgent, 'msie') !== false || strpos($userAgent, 'trident') !== false) {
                $browser = 'Internet Explorer';
            } else {
                $browser = 'Other/Unknown';
            }

            // Detect Operating System
            if (strpos($userAgent, 'win') !== false) {
                $os = 'Windows';
            } elseif (strpos($userAgent, 'mac') !== false) {
                $os = 'MacOS';
            } elseif (strpos($userAgent, 'linux') !== false) {
                $os = 'Linux';
            } elseif (strpos($userAgent, 'android') !== false) {
                $os = 'Android';
            } elseif (strpos($userAgent, 'iphone') !== false) {
                $os = 'iOS';
            } else {
                $os = 'Other/Unknown';
            }

            global $PAGE;

            // Get the context of the current page
            $context = $PAGE->context;

            // Check if the context level is of a module (activity/resource)
            if ($context && $context->contextlevel == CONTEXT_MODULE) {

                $cm = get_coursemodule_from_id('', $context->instanceid, 0, false, MUST_EXIST);

                $modname = $cm->modname;
                $courseId = $cm->course;
                $arid = $context->instanceid;
            } else {
                $arid = 0;
                $courseId = 0;
                $modname = '';
            }

            echo '<div id="leeloolxpcontentapi-js-vars" data-mootoolsleeloourl="' . base64_encode($mootoolsleeloourl) . '" data-mootoolstoken="' . $mootoolstoken . '" data-arid="' . $arid . '" data-courseid="' . $courseId . '" data-modname="' . $modname . '" data-os="' . $os . '" data-browser="' . $browser . '" data-mootoolsloginresponse="' . base64_encode($mootoolsloginresponse) . '"></div>';

            $PAGE->requires->js(new moodle_url('/local/leeloolxpcontentapi/js/local_leeloolxpcontentapi.js'));
            echo '<button id="local_leeloolxpcontentapi_button">Open MooTools</button>';
            echo '<div class="local_leeloolxpcontentapi_wrapper"><div id="local_leeloolxpcontentapi_wrapper_close">X</div><div id="local_leeloolxpcontentapi_frame"></div></div>';
        }
    }
}
