<?php
/*
 * Created on Jan 26, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

// Load a chroot jail for the content
$jail['cms_root'] = $cms_root;
$jail['cms_dir'] = $cms_dir;

// For the template
$jail['logged_in'] = $logged_in;

if ( $logged_in == 'admin' ) {
	$jail['extra_admin_navs'][] = array('url' => '?log=out', 'title' => 'Logout');
}

// Extract the elements of the modified timestamp
$jail['year'] = $year = substr($modified, 0, 4);
$jail['month'] = $month = substr($modified, 4, 2);
$jail['day'] = $day = round(substr($modified, 6, 2));
$jail['hour'] = $hour = substr($modified, 8, 2);
$jail['minute'] = $minute = substr($modified, 10, 2);
$jail['second'] = $second = substr($modified, 12, 2);

//$jail['modified'] = "$day $month, $year @ $hour:$minute:$second";

// Header
/*header('Last Modified: ');
header('Last-Modified: '.date("D, j M Y H:i:s", $last_modified).' GMT');
header('ETag: "'.md5($last_modified).'"');*/

// Load the template to be used and the template functions
$template = file_get_contents($cms_config['template_dir'].$template_file);
require_once($cms_root.'logic/template.php');

// Process and echo the template
process_template($template, $jail);
echo $template;

?>