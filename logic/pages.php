<?php
/*
 * Created on Feb 5, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

$cms_root = '../';

// Application Startup
require_once($cms_root.'logic/app_start.php');

// Unauthorisez users cannot do certain things
if ( $logged_in != 'admin' ) {
	$mode = '';
} else {
	$mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
}

if ( isset($_SERVER['REDIRECT_URL']) ) {
	// Is this URL one of the page_urls in our database?
	list($url,) = explode('?', $_SERVER['REDIRECT_URL'], 1);
	// Replace the cms_dir at the start of the URL
	$url = strpos($url, $cms_dir) == 0 ? substr($url, strlen($cms_dir)) : $url;
	// Find the id of the page that matches the url
	$id = get_page_id($url);
	$id = !$id && isset($_GET['id']) ? $_GET['id'] : $id;
	if ( $id && !isset($_GET['mode']) ) {
		$mode = 'view';
	}
}

switch ($mode) {
	case 'edit':
		$page = get_page($id);
		foreach ( $page as $key => $value ) {
			$jail[$key] = htmlspecialchars($value);
		}
	case 'new':
		$template_file = 'addeditpage.tpl';
		break;
	case 'save':
		$id = save_page();
		if ( !$id ) {
echo "There was a problem saving the page!";
		}
	case 'view':
		$page = get_page($id);
		if ( isset($page['allow_html']) && $page['allow_html'] == 1 ) {
			foreach ( $page as $key => $value ) {
				$jail[$key] = $value;
			}
		} else {
			foreach ( $page as $key => $value ) {
				$jail[$key] = htmlspecialchars($value);
			}
		}
		
		$jail['extra_admin_navs'][] = array('url' => '?mode=edit&id='.$id, 'title' => 'Edit page');
		$jail['extra_admin_navs'][] = array('url' => '?mode=delete&id='.$id.'" onClick="return confirm(\'Are you sure you want to delete this page?\')', 'title' => 'Delete page');
		
		$template_file = 'viewpage.tpl';
		break;
	case 'delete':
		if ( !delete_page($id) ) {
echo "There was a problem deleting this page!";
		}
	case 'list': // case 'list':
		$pages = list_pages();
		$jail['pages'] = $pages;
		$template_file = 'pageindex.tpl';
		break;
	default:
		$template_file = 'error404.tpl';
}

// Get Navigation Links
$jail['navigation'] = navigation_links();

// Disconnect our database connection
db_disconnect();

// Application de-brief
require_once($cms_root.'logic/app_end.php');

?>