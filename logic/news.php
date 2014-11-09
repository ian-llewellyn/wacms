<?php
/*
 * Created on Jan 16, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

$cms_root = '../';

// Application Startup
require_once($cms_root.'logic/app_start.php');

// Unauthorisez users cannot do certain things
if ( $logged_in != 'admin' ) {
	$mode = 'list';
} else {
	$mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
}

if ( isset($_GET['id']) && $_GET['id'] != '' ) {
	$id = $_GET['id'];
	$mode = isset($_GET['mode']) ? $mode : 'view';
}

// LOGIC
switch ($mode) {
	case 'edit':
		// We're editing an existing news story
	
		// Get the story to edit (for field population)
		$news = get_full_news_story($id);
	
		// Copy the details into the template jail
		foreach ( $news as $key => $value ) {
			// We want to escape anything that could break the template
			$jail[$key] = htmlspecialchars($value);
		}
	case 'new':
		// We are adding a new news story
		$jail['page_title'] = 'Add / Edit News';
		$template_file = 'addeditnews.tpl';
		break;

	case 'save':
		// We're saving a new / modified news story
		if ( isset($_POST['news_story']) && ( !isset($_POST['news_lead_in']) || $_POST['news_lead_in'] == '' ) ) {
			if ( strlen(strip_tags($_POST['news_story'])) > 70 ) {
				$lead_in = strip_tags($_POST['news_story']);
				$lead_in = substr($lead_in, 0, 70);
				$lead_in = substr($lead_in, 0, strrpos($lead_in, ' '));
				$_POST['news_lead_in'] = $lead_in.'...';
			} else {
				$_POST['news_lead_in'] = strip_tags($_POST['news_story']);
			}
		}
		$id = save_news();

		if ( $id === false ) {
echo "There was a problem saving the news story.";
		}

	case 'view':	
		// Now we want to view the story
		$news = get_full_news_story($id);
		if ( !$news ) { return false; }
		// Copy the details into the template jail
		foreach ( $news as $key => $value ) {
			// We want to escape anything that could break the template
			$jail[$key] = $value;
		}

		$modified = isset($news['modified']) && str_replace(array('-', ' ', ':'), '', $news['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $news['modified']) : $modified;
	
		$jail['extra_admin_navs'][] = array('url' => '?mode=edit&id='.$id, 'title' => 'Edit News Story');
		$jail['extra_admin_navs'][] = array('url' => '?mode=delete&id='.$id.'" onClick="return confirm(\'Are you sure you want to delete this news story?\')', 'title' => 'Delete News Story');

		$jail['page_title'] = isset($news['news_headline']) ? $news['news_headline'] : 'News Story';

		$template_file = "viewnewsstory.tpl";
		break;
	case 'delete':
		// Delete the news record
		if ( !delete_news_story($id) ) {
echo "There was a problem deleting the news story from the database.";
		}
	
	default:
		// Display the news index
		
		$jail['news'] = latest_news(1000);

		// Have any of the stories been modified more recently than the CMS files?
		for ( $i = 0 ; $i < count($jail['news']) ; $i++ ) {
			$modified = isset($jail['news'][$i]['modified']) && str_replace(array('-', ' ', ':'), '', $jail['news'][$i]['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $jail['news'][$i]['modified']) : $modified;
			if ( isset($jail['news'][$i]['modified']) ) {
				list($date, $time) = explode(' ', $jail['news'][$i]['publish_date']);
				list($jail['news'][$i]['year'], $jail['news'][$i]['month'], $jail['news'][$i]['day']) = explode('-', $date);
				list($jail['news'][$i]['hour'], $jail['news'][$i]['minute'], $jail['news'][$i]['second']) = explode(':', $time);
			}
		}

		$jail['page_title'] = 'News';

		$template_file = 'newsindex.tpl';
}

// Get Navigation Links
$jail['navigation'] = navigation_links();

// Disconnect our database connection
db_disconnect();

// Application de-brief
require_once($cms_root.'logic/app_end.php');

?>