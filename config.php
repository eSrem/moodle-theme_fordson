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
 * Theme config file.
 *
 * @package    theme_fordson
 * @copyright  2016 Chris Kenniburg
 * @credits    theme_boost - MoodleHQ
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Check the file is being called internally from within Moodle.
defined('MOODLE_INTERNAL') || die();

// Call the theme lib file.
require_once(__DIR__ . '/lib.php');

// Theme name.
$THEME->name = 'fordson';

// Inherit from parent theme - Boost.
$THEME->parents = ['boost'];

/* There are currently no css sheets in the theme as scss is used.
 * No TinyMCE editor stylesheet is provided - this would be impossible
 * to generate dynamically from the scss presets and settings and is not
 * used by Moodle's default editor (Atto).
 */
$THEME->sheets = [''];
$THEME->editor_sheets = [''];

// Toggle display of blocks
$THEME->layouts = [
    // The site home page.
    'frontpage' => [
        'file' => 'frontpage.php',
        'regions' => ['side-pre', 'fp-a', 'fp-b', 'fp-c'],
        'defaultregion' => 'fp-c',
        'options' => ['nonavbar' => true, 'langmenu' => true],
    ],
    // Main course page.
    'course' => [
        'file' => 'course.php',
        'regions' => ['side-pre', 'fp-a', 'fp-b', 'fp-c'],
        'defaultregion' => 'fp-c',
    ],
    'incourse' => [
        'file' => 'course.php',
        'regions' => ['side-pre'],
        'defaultregion' => 'side-pre',
    ],
    'coursecategory' => [
        'file' => 'columns2.php',
        'regions' => ['side-pre'],
        'defaultregion' => 'side-pre',
    ],
    // Server administration scripts.
    'admin' => [
        'file' => 'columns2.php',
        'regions' => ['side-pre', 'fp-c'],
        'defaultregion' => 'fp-c',
    ],
];
if ($THEME->settings->blockdisplay == 2) {
    $THEME->layouts['course'] = [
        'file' => 'course.php',
        'regions' => ['side-pre'],
        'defaultregion' => 'side-pre',
    ];
    $THEME->layouts['frontpage'] = [
        'file' => 'frontpage.php',
        'regions' => ['side-pre'],
        'defaultregion' => 'side-pre',
    ];
}


// Call main theme scss - including the selected preset.
$THEME->scss = function($theme) {
    return theme_fordson_get_main_scss_content($theme);
};

// Additional theme options.
$THEME->supportscssoptimisation = false;

// Call css/scss processing functions and renderers.
$THEME->csstreepostprocessor = 'theme_fordson_css_tree_post_processor';
$THEME->prescsscallback = 'theme_fordson_get_pre_scss';
$THEME->extrascsscallback = 'theme_fordson_get_extra_scss';
$THEME->rendererfactory = 'theme_overridden_renderer_factory';

// Toggle display of blocks
if ($THEME->settings->blockdisplay == 1) {
    $THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_DEFAULT;
}
if (page_location_incourse_themeconfig()) {
    $THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
}
if ($THEME->settings->blockdisplay == 2) {
    $THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
}

$THEME->iconsystem = \core\output\icon_system::FONTAWESOME;

$THEME->enable_dock = false;
$THEME->yuicssmodules = array();
$THEME->requiredblocks = '';