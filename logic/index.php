<?php
$cms_root = '../';

// Application Startup
require_once($cms_root.'logic/app_start.php');

// Get Navigation Links
$navigation = navigation_links();

// Get News Headlines
$news = latest_news();
// Have any of the stories been modified more recently than the CMS files?
for ( $i = 0 ; $i < count($news) ; $i++ ) {
	$modified = isset($news[$i]['modified']) && str_replace(array('-', ' ', ':'), '', $news[$i]['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $news[$i]['modified']) : $modified;
	if ( isset($news[$i]['modified']) ) {
		list($date, $time) = explode(' ', $news[$i]['publish_date']);
		list($news[$i]['year'], $news[$i]['month'], $news[$i]['day']) = explode('-', $date);
		list($news[$i]['hour'], $news[$i]['minute'], $news[$i]['second']) = explode(':', $time);
	}
}

// Get Recent Photos
$recent_photos = get_latest_images();
// Have any of the photos been modified more recently than the CMS files?
foreach ( $recent_photos as $photo ) {
	$modified = isset($photo['modified']) && str_replace(array('-', ' ', ':'), '', $photo['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $photo['modified']) : $modified;
}

// Get Event List
$events = upcoming_events(); 
// Have any of the events been modified more recently than the CMS files?
for ( $i = 0 ; $i < count($events) ; $i++ ) {
	$modified = isset($events[$i]['modified']) && str_replace(array('-', ' ', ':'), '', $events[$i]['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $events[$i]['modified']) : $modified;
	if ( isset($events[$i]['modified']) ) {
		list($date, $time) = explode(' ', $events[$i]['event_date']);
		list($events[$i]['year'], $events[$i]['month'], $events[$i]['day']) = explode('-', $date);
		list($events[$i]['hour'], $events[$i]['minute'], $events[$i]['second']) = explode(':', $time);
	}
}

// Get pages and their lead_ins (welcome, connect, activities, merchandise)
$jail['welcome'][] = get_page(1);
// Have any of the events been modified more recently than the CMS files?
$modified = isset($jail['welcome'][0]['modified']) && str_replace(array('-', ' ', ':'), '', $jail['welcome'][0]['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $jail['welcome'][0]['modified']) : $modified;

$jail['connect'][] = get_page(2);
// Have any of the events been modified more recently than the CMS files?
$modified = isset($jail['connect'][0]['modified']) && str_replace(array('-', ' ', ':'), '', $jail['connect'][0]['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $jail['connect'][0]['modified']) : $modified;

$jail['related'][] = get_page(3);
// Have any of the events been modified more recently than the CMS files?
$modified = isset($jail['related'][0]['modified']) && str_replace(array('-', ' ', ':'), '', $jail['related'][0]['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $jail['related'][0]['modified']) : $modified;

$jail['merchandise'][] = get_page(4);
// Have any of the events been modified more recently than the CMS files?
$modified = isset($jail['merchandise'][0]['modified']) && str_replace(array('-', ' ', ':'), '', $jail['merchandise'][0]['modified']) > $modified ? str_replace(array('-', ' ', ':'), '', $jail['merchandise'][0]['modified']) : $modified;

// Disconnect our database connection
db_disconnect();

// Load a chroot jail for the content
$jail['cms_root'] =& $cms_root;
$jail['navigation'] =& $navigation;
$jail['news'] =& $news;
$jail['recent_photos'] =& $recent_photos;
$jail['events'] =& $events;

// Load the template to be used and the template functions
$template_file = 'index.tpl';

// Application de-brief
require_once($cms_root.'logic/app_end.php');

?>