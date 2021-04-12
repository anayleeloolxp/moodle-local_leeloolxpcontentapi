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
 * External functions and service definitions.
 *
 * @package local_leeloolxpcontentapi
 * @copyright  2020 Leeloo LXP (https://leeloolxp.com)
 * @author Leeloo LXP <info@leeloolxp.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// We defined the web service functions to install.
$functions = array(
    'local_leeloolxpcontentapi_content_plugins_sync' => array(
        'classname' => 'local_leeloolxpcontentapi_external',
        'methodname' => 'content_plugins_sync',
        'classpath' => 'local/leeloolxpcontentapi/externallib.php',
        'description' => 'Sync Content Plugins Data.',
        'type' => 'write',
    ),
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
    'Leeloo LXP Content API' => array(
        'functions' => array(
            'local_leeloolxpcontentapi_content_plugins_sync',
        ),
        'restrictedusers' => 0,
        'enabled' => 1,
    ),
);
