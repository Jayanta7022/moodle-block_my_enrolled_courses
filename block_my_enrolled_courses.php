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
 * main block page for creating the block in frontend
 *
 * @package    block_my_enrolled_courses
 * @copyright  DualCube (https://dualcube.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// require_once('locallib.php');

/**
 * main block page for creating the block in frontend
 *
 * @package    block_my_enrolled_courses
 * @copyright  DualCube (https://dualcube.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_my_enrolled_courses extends block_base {
    
    // public $createblock = new createblock/block_my_enrolled_courses_show_courses();
    // public $createblock = null;
    /**
     * init function from block element
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_my_enrolled_courses');
    }

    /**
     * load the content for block
     */
    public function get_content() {
        global $CFG;
        $this->page->requires->js_call_amd('block_my_enrolled_courses/myenrolledcourses', 'sorting');

        if ($this->content !== null) {
            return $this->content;
        }
       $this->content = new stdClass();
       $createblock = new \block_my_enrolled_courses\block_my_enrolled_courses_create_block();
       $html = $createblock->block_my_enrolled_courses_visible_in_block();
        $this->content->text = $html;
        $url = new moodle_url($CFG->wwwroot . '/blocks/my_enrolled_courses/showhide.php', ['contextid' => $this->context->id]);
        $showhidetext = get_string('showhide', 'block_my_enrolled_courses');
        $link = html_writer::link($url, $showhidetext);
        $this->content->footer = $link;

        return $this->content;
    }
}
