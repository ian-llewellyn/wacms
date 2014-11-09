<?php
/*
 * Created on Jan 28, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

$cms_root = '../';

// Application startup
require_once($cms_root.'logic/app_start.php');

// Just what is it that you want to do? 
if ( $logged_in != 'admin' ) {
	$mode = 'list';
} else {
	$mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
}

// Set the $id variable and reset $mode if necessary
if ( isset($_GET['id']) || isset($_POST['event_id']) ) {
	$id = isset($_GET['id']) ? $_GET['id'] : $_POST['event_id'];
	$mode = isset($_GET['mode']) ? $mode : 'view';
}

switch ( $mode ) {
	case 'edit':
		// Edit an event
		$event = get_event($id);
		foreach ( $event as $var_name => $var_value ) {
			$jail[$var_name] = $var_value;
		}
		if ( isset($event['event_date']) ) {
			list($date, $time) = explode(' ', $event['event_date']);
			list($jail['event_year'], $jail['event_month'], $jail['event_day']) = explode('-', $date);
			list($jail['event_hour'], $jail['event_minute'], $jail['event_second']) = explode(':', $time);
		}
	case 'new':
		// Add an event
		$jail['page_title'] = 'Add / Edit Event';
		$template_file = 'addeditevent.tpl';
		break;

	case 'save':
		// Save an event
		if ( isset($_POST['event_description']) && ( !isset($_POST['event_lead_in']) || $_POST['event_lead_in'] == '' ) ) {
			if ( strlen(strip_tags($_POST['event_description'])) > 70 ) {
				$lead_in = strip_tags($_POST['event_description']);
				$lead_in = substr($lead_in, 0, 70);
				$lead_in = substr($lead_in, 0, strrpos($lead_in, ' '));
				$_POST['event_lead_in'] = $lead_in.'...';
			} else {
				$_POST['event_lead_in'] = strip_tags($_POST['event_description']);
			}
		}
		$id = save_event();
	case 'view':
		// View an event
		$event = get_event($id);
		if ( !$event ) { return false; }
		foreach ( $event as $var_name => $var_value ) {
			if ( isset($event['allow_html']) && $event['allow_html'] == '1' ) {
				$jail[$var_name] = $var_value;
			} else {
				$jail[$var_name] = htmlspecialchars($var_value);
			}
			if ( $var_name == 'event_date' ) {
				list($date, $time) = explode(' ', $var_value);
				list($jail['event'][0]['year'], $jail['event'][0]['month'], $jail['event'][0]['day']) = explode('-', $date);
				list($jail['event'][0]['hour'], $jail['event'][0]['minute'], $jail['event'][0]['second']) = explode(':', $time);
				$jail['event'][0]['day'] = round($jail['event'][0]['day']);
			}
		}

		// Has this event been modified more recently than the CMS files?
		$modified = isset($event['modified']) && str_replace(array('-', ' ', ':'), '', $event['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $event['modified']) : $modified;

		$jail['page_title'] = isset($event['event_title']) ? $event['event_title'] : 'Event Details';

		$template_file = 'viewevent.tpl';

		// Extra options for the admin navs	
		$jail['extra_admin_navs'][] = array('url' => '?mode=edit&id='.$id, 'title' => 'Edit Event');
		$jail['extra_admin_navs'][] = array('url' => '?mode=delete&id='.$id.'" onClick="return confirm(\'Are you sure you want to delete this event?\')', 'title' => 'Delete Event');

		break;

	case 'delete':
		// Delete an event
		delete_event($id);
	default:
		// View a list of events
		$jail['events'] = list_events();
		// Have any of the events been modified more recently than the CMS files?
		for ( $i = 0 ; $i < count($jail['events']) ; $i++ ) {
			$modified = isset($jail['events'][$i]['modified']) && str_replace(array('-', ' ', ':'), '', $jail['events'][$i]['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $jail['events'][$i]['modified']) : $modified;
			if ( isset($jail['events'][$i]['event_date']) ) {
				list($date, $time) = explode(' ', $jail['events'][$i]['event_date']);
				list($jail['events'][$i]['year'], $jail['events'][$i]['month'], $jail['events'][$i]['day']) = explode('-', $date);
				list($jail['events'][$i]['hour'], $jail['events'][$i]['minute'], $jail['events'][$i]['second']) = explode(':', $time);
				$jail['events'][$i]['day'] = round($jail['events'][$i]['day']);
			}
		}
		$jail['page_title'] = 'Events';

		$template_file = 'eventindex.tpl';
}

// Get Navigation Links
$jail['navigation'] = navigation_links();

// Disconnect our database connection
db_disconnect();

// Application de-brief
require_once($cms_root.'logic/app_end.php');

?>