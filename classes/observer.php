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
 * Admin settings and defaults
 *
 * @package tool_leeloolxp_sync
 * @copyright  2024 Leeloo LXP (https://leeloolxp.com)
 * @author Leeloo LXP <info@leeloolxp.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_leeloolxpcontentapi;

use curl;

/**
 * Observer to login/logout user to Leeloo as they login/logout on moodle.
 */
class observer {
    /**
     * Triggered when user_loggedin.
     *
     * @param \core\event\user_loggedin $events
     */
    public static function user_loggedin(\core\event\user_loggedin $event) {

        $mootoolsenable = get_config('local_leeloolxpcontentapi')->enable;
        $mootoolsleeloourl = get_config('local_leeloolxpcontentapi')->leeloourl;

        if ($mootoolsenable && $mootoolsleeloourl) {
            global $USER;
            if (isloggedin() && !is_siteadmin($USER)) {
                global $DB, $CFG;

                $user = $DB->get_record('user', ['id' => $event->objectid]);

                $userid = $user->id;
                $username = $user->username;
                $password = $user->password;

                require_once($CFG->libdir . '/filelib.php');

                $curl = new curl;

                $url = $mootoolsleeloourl . '/api/login';

                $payload = array(
                    'mootools' => $userid,
                    'username' => $username,
                    'password' => $password,
                );

                $jsonPayload = json_encode($payload);

                $headers = array('Content-Type: application/json');

                $result = $curl->post($url, $jsonPayload, array('CURLOPT_HTTPHEADER' => $headers));

                $res_arr = json_decode($result);
                if ($res_arr->status == 'success') {
                    $mootools_token = $res_arr->token;
                    setcookie('mootools_token', $mootools_token, time() + (86400 * 30), '/');
                    setcookie('mootools_login_response', $result, time() + (86400 * 30), '/');
                } else {
                    setcookie('mootools_token', '', time() - 3600, '/');
                    setcookie('mootools_login_response', '', time() - 3600, '/');
                }
            } else {
                setcookie('mootools_token', '', time() - 3600, '/');
                setcookie('mootools_login_response', '', time() - 3600, '/');
            }
        } else {
            setcookie('mootools_token', '', time() - 3600, '/');
            setcookie('mootools_login_response', '', time() - 3600, '/');
        }
    }

    /**
     * Triggered when user_loggedout.
     *
     * @param \core\event\user_loggedout $events
     */
    public static function user_loggedout(\core\event\user_loggedout $event) {
        $mootoolsenable = get_config('local_leeloolxpcontentapi')->enable;
        $mootoolsleeloourl = get_config('local_leeloolxpcontentapi')->leeloourl;

        if ($mootoolsenable && $mootoolsleeloourl) {
            if (isset($_COOKIE['mootools_token'])) {
                $mootools_token = $_COOKIE['mootools_token'];

                global $CFG;

                require_once($CFG->libdir . '/filelib.php');

                $curl = new curl;

                $url = $mootoolsleeloourl . '/api/logout';

                $payload = array();

                $jsonPayload = json_encode($payload);

                $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $mootools_token);

                $curl->post($url, $jsonPayload, array('CURLOPT_HTTPHEADER' => $headers));

                setcookie('mootools_token', '', time() - 3600, '/');
                setcookie('mootools_login_response', '', time() - 3600, '/');
            }
        }
    }
}
