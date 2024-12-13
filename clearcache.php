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
 * Clear Cache file
 *
 * @package    local_leeloolxpcontentapi
 * @copyright  2024 Leeloo LXP (https://leeloolxp.com)
 * @author     Leeloo LXP <info@leeloolxp.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once('../../config.php');
require_once($CFG->libdir . '/adminlib.php');

// Basic security check to ensure the request is coming from an allowed source
$allowed_ips = ['51.159.101.252', '51.159.14.97'];  // Add your Laravel server's IP here
if (!in_array($_SERVER['REMOTE_ADDR'], $allowed_ips)) {
	header("HTTP/1.0 403 Forbidden");
	echo "Access denied";
	exit;
}

try {
	$selected = array("other" => 1, "muc" => 1);
	purge_caches($selected);
	echo json_encode(['status' => 'success', 'message' => 'Cache cleared successfully']);
} catch (Exception $e) {
	header("HTTP/1.0 500 Internal Server Error");
	echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
