<?php
/*
 * Created on Jan 26, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

$admin_password = 'abcd1234';

// Session Shit!
session_start();

// For debugging
error_reporting(E_ALL);

if ( !isset($_SESSION['logged_in']) ) {
	$_SESSION['logged_in'] = '';
}

function log_me($where) {
	switch ($where) {
		case 'in':
			// Check credentials
			if ( isset($_POST['username']) && isset($_POST['password']) ) {
				if ( $_POST['username'] == 'update' && $_POST['password'] == $admin_password ) {
					$_SESSION['logged_in'] = 'admin';
				} else {
					$_SESSION['logged_in'] = '';
				}
			} else {
				$_SESSION['logged_in'] = '';
			}
			break;
		case 'out':
			$_SESSION['logged_in'] = '';
	}
	return $_SESSION['logged_in'];
}

// Is the user trying to log in or out?
if ( isset($_GET['log']) && $_GET['log'] != '' ) {
	// Yes, attempt log in/out...
	$logged_in = log_me($_GET['log']);
} else {
	// No, keep them logged whereever they are
	$logged_in = $_SESSION['logged_in'];
}

// These are all from the world view
//var_dump($_SERVER);
/*
$cms_dir = '/cms/'; // or in this case '/';
- publicly visible path to cms installation directory relative to site root
$cms_root = '../../';
- reference to cms installation directory relative to currently running script's directory
$path_to_here = 'gallery/16/';
- reference to currently running script's directory relative to cms installation root
*/

// POSY and GET
if ( get_magic_quotes_gpc() ) {
	foreach ( $_POST as &$val ) {
		$val = stripslashes($val);
		unset($val);
	}
}

// Load the CMS configuration
require_once($cms_root.'logic/cms_config.php');

// Load DB Functions
require_once($cms_root.'logic/db_'.$cms_config['db_type'].'.php');

// Pull in the header images
$jail['header_images'] = array_slice(list_gallery_images(1), 0, 10);
// Have any of the events been modified more recently than the CMS files?
foreach ( $jail['header_images'] as $header_image ) {
	$modified = isset($header_image['modified']) && str_replace(array('-', ' ', ':'), '', $header_image['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $header_image['modified']) : $modified;
}

?>
