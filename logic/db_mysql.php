<?php
/*
 * MySQL Functions for WebApps CMS Website
 * Developed by Ian Llewellyn: 2009 - 2010
 */

// DB Configuration
$db_config['hostname'] = 'localhost';
$db_config['username'] = 'db_user';
$db_config['password'] = 'db_password';
$db_config['database'] = 'db_name';
$db_config['table_prefix'] = 'wacms_';

// Start MySQL Persistent Connection

// If successful, register exit hook function
$cms_config['exit_hooks'][] = 'db_disconnect()';

function db_connect() {
	global $db_config, $db;
	$db = mysql_connect($db_config['hostname'], $db_config['username'], $db_config['password']);

	if (!$db) {
echo "There was an error connecting to MySQL database: ".mysql_error();
		return false;
	}

	if ( !mysql_select_db($db_config['database']) ) {
echo "There was a problem selecting database (${db_config['database']}): ".mysql_error();
		return false;
	}

	return true;
}

function db_disconnect() {
	global $db;

	mysql_close($db);
}

function navigation_links() {
    global $db_config;
	$query = "SELECT title, url FROM " . $db_config['table_prefix'] . "navigation WHERE active = 'Y' ORDER BY 'order'";

	$result = mysql_query($query);

	if ( !$result ) {
echo "There was an error getting the navigation links: " . mysql_error();
		return false;
	}

	while ( $row = mysql_fetch_assoc($result) ) {
		$link['title'] = $row['title'];
		$link['url'] = $row['url'];
		$links[] = $link;
	}

	return $links;
}

function latest_news($number = 4, $offset_start = 0) {
    global $db_config;
	// $number - The number of top stories to get (default to 10)
	// $offset_start - How far down the list to start (default to 0)
	$query = "SELECT * FROM " . $db_config['table_prefix'] . "news WHERE published = '1' ORDER BY publish_date DESC LIMIT $offset_start,$number";

	$result = mysql_query($query);

	if ( !$result ) {
echo "There was an error getting the news: " . mysql_error();
		return false;
	}

	while ( $row = mysql_fetch_assoc($result) ) {
		$news[] = $row;
	}

	if ( isset($news) ) {
		return $news;
	} else {
		return false;
	}
}

function get_full_news_story($news_id) {
    global $db_config;
	$query = "SELECT news_id, news_headline, news_lead_in, news_story, published, publish_date, modified FROM " . $db_config['table_prefix'] . "news WHERE news_id = '$news_id'";

	$result = mysql_query($query);

	if ( !$result ) {
echo "There was a problem fetching the news story from the database.";
		return false;
	}

	$row = mysql_fetch_assoc($result);

	return $row;
}

function save_news() {
    global $db_config;
	$news_id = isset($_POST['news_id']) ? mysql_real_escape_string($_POST['news_id']) : '';
	if ( isset($_POST['news_headline']) ) { $news_headline = mysql_real_escape_string($_POST['news_headline']); } else { return false; }
	$published = isset($_POST['published']) ? 1 : 0;
	$allow_html = isset($_POST['allow_html']) ? 1 : 0;
	if ( isset($_POST['news_lead_in']) ) { $news_lead_in = mysql_real_escape_string($_POST['news_lead_in']); } else { return false; }
	if ( isset($_POST['news_story']) ) { $news_story = mysql_real_escape_string($_POST['news_story']); } else { return false; }

	if ( $news_id == '' ) {
		$query = "SELECT MAX(news_id) AS news_id FROM " . $db_config['table_prefix'] . "news";
		$result = mysql_query($query);
		$max = mysql_fetch_assoc($result);
		$news_id = $max['news_id'] + 1;
		$query = "INSERT INTO " . $db_config['table_prefix'] . "news (news_id, news_headline, published, allow_html, news_lead_in, news_story, publish_date, modified) VALUES ($news_id, '$news_headline', $published, $allow_html, '$news_lead_in', '$news_story', NOW(), NOW())";
		// Return news_id
		if ( mysql_query($query) ) return $news_id;
	} else {
		$query = "UPDATE " . $db_config['table_prefix'] . "news SET news_id = '$news_id', news_headline = '$news_headline', published = $published, allow_html = $allow_html, news_lead_in = '$news_lead_in', news_story = '$news_story', modified = NOW() WHERE news_id = '$news_id'";
		// Return news_id
		if ( mysql_query($query) ) return $news_id;
	}
	return false;
}

function delete_news_story($id) {
    global $db_config;
	$query = "DELETE FROM " . $db_config['table_prefix'] . "news WHERE news_id = '$id'";
	$result = mysql_query($query);

	if ( !$result ) {
echo "There was a problem deleting the news story from the database.";
		return false;
	}
	return true;
}

function upcoming_events() {
    global $db_config;
	// No arguments
	$query = "SELECT * FROM " . $db_config['table_prefix'] . "events WHERE event_date >= CONCAT(CURDATE(), ' 00:00:00') AND published = '1' ORDER BY event_date ASC";

	$result = mysql_query($query);

	if ( !$result ) {
echo "There was an error getting the upcoming events: " . mysql_error();
		return false;
	}

	while ( $row = mysql_fetch_assoc($result) ) {
		$events[] = $row;
	}

	return $events;
}

function get_event($id) {
    global $db_config;
	$query = "SELECT * FROM " . $db_config['table_prefix'] . "events WHERE event_id = $id";
	$result = mysql_query($query);
	if ( !$result ) { return false; }
	$event = mysql_fetch_assoc($result);
	// Some extra date processing
/*	if ( isset($event['event_date']) ) {
		list($event_date, $event_time) = explode(' ', $event['event_date']);
		list($event['event_year'], $event['month'], $event['event_day']) = explode('-', $event_date);
		list($event['hour'], $event['minute'], ) = explode(':', $event_time);
	}*/
	// Return event array
	return $event;
}

function save_event() {
    global $db_config;
	$event_id = isset($_POST['event_id']) ? mysql_real_escape_string($_POST['event_id']) : '';
	if ( isset($_POST['event_title']) ) { $event_title = mysql_real_escape_string($_POST['event_title']); } else { return false; }
	if ( isset($_POST['event_year']) && isset($_POST['event_month']) && isset($_POST['event_day']) && isset($_POST['event_hour']) && isset($_POST['event_minute']) ) { $event_date = mysql_real_escape_string("${_POST['event_year']}'-${_POST['event_month']}-${_POST['event_day']} ${_POST['event_hour']}:${_POST['event_minute']}:00"); } else { return false; }
	$published = isset($_POST['published']) ? 1 : 0;
	$allow_html = isset($_POST['allow_html']) ? 1 : 0;
	if ( isset($_POST['event_lead_in']) ) { $event_lead_in = mysql_real_escape_string($_POST['event_lead_in']); } else { return false; }
	if ( isset($_POST['event_description']) ) { $event_description = mysql_real_escape_string($_POST['event_description']); } else { return false; }

	if ( $event_id == '' ) {
		$query = "SELECT MAX(event_id) AS event_id FROM " . $db_config['table_prefix'] . "events";
		$result = mysql_query($query);
		$max = mysql_fetch_assoc($result);
		$event_id = $max['event_id'] + 1;
		$query = "INSERT INTO " . $db_config['table_prefix'] . "events (event_id, event_title, event_date, published, allow_html, event_lead_in, event_description, modified) VALUES ($event_id, '$event_title', '$event_date', $published, $allow_html, '$event_lead_in', '$event_description', NOW())";
		// Return event_id
		if ( mysql_query($query) ) return $event_id;
	} else {
		$query = "UPDATE " . $db_config['table_prefix'] . "events SET event_id = '$event_id', event_title = '$event_title', event_date = '$event_date', published = $published, allow_html = $allow_html, event_lead_in = '$event_lead_in', event_description = '$event_description', modified = NOW() WHERE event_id = '$event_id'";
		// Return event_id
		if ( mysql_query($query) ) return $event_id;
	}
	return false;
}

function delete_event($id) {
    global $db_config;
	$query = "DELETE FROM " . $db_config['table_prefix'] . "events WHERE event_id = $id";
	// Return TRUE or FALSE
	return mysql_query($query);
}

function list_events() {
    global $db_config;
	$query = "SELECT * FROM " . $db_config['table_prefix'] . "events ORDER BY event_date DESC, modified DESC";
	$result = mysql_query($query);
	while ( $event = mysql_fetch_assoc($result) ) {
		if ( isset($event['allow_html']) && $event['allow_html'] == '0' ) {
			foreach ( $event as $key => $value ) {
				$safe[$key] = htmlspecialchars($value);
			}
			$events[] = $safe;
		} else {
			$events[] = $event;
		}
	}
	// Return events array
	return $events;
}

function save_gallery_image() {
    global $db_config;
	if ( !isset($_POST['gallery_id']) || !isset($_POST['file_name']) || !isset($_POST['title']) || !isset($_POST['caption']) ) {
		return false;
	}
	$gallery_id = mysql_real_escape_string($_POST['gallery_id']);
	$file_name = mysql_real_escape_string($_POST['file_name']);
	$title = mysql_real_escape_string($_POST['title']);
	$caption = mysql_real_escape_string($_POST['caption']);

	if ( isset($_POST['image_order']) && $_POST['image_order'] != '' ) {
		$image_order = mysql_real_escape_string($_POST['image_order']);

		$query = "UPDATE " . $db_config['table_prefix'] . "gallery_images SET title = '$title', caption = '$caption' WHERE gallery_id = $gallery_id AND image_order = $image_order AND file_name = '$file_name'";

		$result = mysql_query($query);

		if ( !$result ) { return false; }

		return $image_order;
	} else {
		$query = "SELECT MAX(image_order) AS image_order FROM " . $db_config['table_prefix'] . "gallery_images WHERE gallery_id = $gallery_id";

		$result = mysql_query($query);

		if ( !$result ) { return false; }

		$row = mysql_fetch_assoc($result);

		$image_order = isset($row['image_order']) ? $row['image_order']+1 : 0;

		$query = "INSERT INTO " . $db_config['table_prefix'] . "gallery_images (gallery_id, image_order, modified, file_name, title, caption) VALUES ($gallery_id, $image_order, NOW(), '$file_name', '$title', '$caption' )";

		if ( !mysql_query($query) ) {
			echo mysql_error();
			return false;
		}
		return $image_order;
	}
}

function get_gallery($gallery_id) {
    global $db_config;
	if ( $gallery_id == '' ) {
		return false;
	}
	$query = "SELECT * FROM " . $db_config['table_prefix'] . "galleries WHERE gallery_id = $gallery_id";
	$result = mysql_query($query);
	if ( !$result ) { return false; }
	return mysql_fetch_assoc($result);
}

function save_gallery() {
    global $db_config;
	if ( !isset($_POST['gallery_name']) || $_POST['gallery_name'] == '' ) {
		return false;
	}
	$gallery_name = mysql_real_escape_string($_POST['gallery_name']);

	if ( isset($_POST['gallery_id']) && $_POST['gallery_id'] != '' ) {
		$gallery_id = $_POST['gallery_id'];
		$query = "UPDATE " . $db_config['table_prefix'] . "galleries SET gallery_name = '$gallery_name' WHERE gallery_id = $gallery_id";
		$result = mysql_query($query);
	} else {

		$query = "SELECT MAX(gallery_id) AS gallery_id FROM " . $db_config['table_prefix'] . "galleries";

		$result = mysql_query($query);

		if ( !$result ) {
			return false;
		}

		$row = mysql_fetch_assoc($result);

		$gallery_id = is_null($row['gallery_id']) ? 1 : $row['gallery_id']+1;

		$query = "INSERT INTO " . $db_config['table_prefix'] . "galleries (gallery_id, created, gallery_name) VALUES ($gallery_id, NOW(), '$gallery_name')";

		$result = mysql_query($query);
	}

	if ( !$result ) {
		echo "There was an error: ".mysql_error();
		return false;
	}

	return $gallery_id;
}

function list_gallery_images($gallery_id) {
    global $db_config;
	$query = "SELECT * FROM " . $db_config['table_prefix'] . "gallery_images WHERE gallery_id = $gallery_id ORDER BY image_order ASC";
	$result = mysql_query($query);
	if ( !$result ) { return false; }
	while ( $row = mysql_fetch_assoc($result) ) {
		$gallery_images[] = $row;
	}
	if ( isset($gallery_images) ) {
		return $gallery_images;
	}
	return false;
}

function list_galleries() {
    global $db_config;
	$query = "SELECT * FROM " . $db_config['table_prefix'] . "galleries ORDER BY created DESC, gallery_name ASC";
	$result = mysql_query($query);
	if ( !$result ) { return false; }
	while ( $row = mysql_fetch_assoc($result) ) {
		$galleries[] = $row;
	}
	if ( isset($galleries) ) {
		return $galleries;
	}
	return false;
}

function get_latest_images() {
    global $db_config;
	$query = "SELECT * FROM " . $db_config['table_prefix'] . "gallery_images ORDER BY gallery_id DESC, image_order DESC LIMIT 16";
	$result = mysql_query($query);
	if ( !$result ) { return false; }
	while ( $row = mysql_fetch_assoc($result) ) {
		$images[] = $row;
	}
	if ( isset($images) ) {
		return $images;
	}
	return false;
}

function delete_gallery($id) {
    global $db_config;
	$query = "DELETE FROM " . $db_config['table_prefix'] . "galleries WHERE gallery_id = $id";
	// Return TRUE or FALSE
	return mysql_query($query);
}

function delete_gallery_images($id) {
    global $db_config;
	$query = "DELETE FROM " . $db_config['table_prefix'] . "gallery_images WHERE gallery_id = $id";
	// Return TRUE or FALSE
	return mysql_query($query);
}

function delete_gallery_image() {
    global $db_config;
	if ( !isset($_POST['gallery_id']) || !isset($_POST['file_name']) || !isset($_POST['title']) || !isset($_POST['caption']) ) {
		return false;
	}
	$gallery_id = mysql_real_escape_string($_POST['gallery_id']);
	$image_order = mysql_real_escape_string($_POST['image_order']);
	$file_name = mysql_real_escape_string($_POST['file_name']);
	$title = mysql_real_escape_string($_POST['title']);
	$caption = mysql_real_escape_string($_POST['caption']);

	$query = "DELETE FROM " . $db_config['table_prefix'] . "gallery_images WHERE gallery_id = $gallery_id AND image_order = $image_order AND file_name = '$file_name' AND title = '$title' AND caption = '$caption'";

	// Return TRUE or FALSE
	if ( !mysql_query($query) ) {
		return false;
	}

	$query = "UPDATE " . $db_config['table_prefix'] . "gallery_images SET image_order = image_order-1 WHERE image_order > $image_order AND gallery_id = $gallery_id";

	mysql_query($query);

	return true;
}

function get_page($id) {
    global $db_config;
	$query = "SELECT * FROM " . $db_config['table_prefix'] . "pages WHERE page_id = $id";
	$result = mysql_query($query);
	if ( !$result ) { return false; }
	return mysql_fetch_assoc($result);
}

function save_page() {
    global $db_config;
	$allow_html = isset($_POST['allow_html']) ? mysql_real_escape_string($_POST['allow_html']) : 0;
	if ( isset($_POST['page_title']) && $_POST['page_title'] != '' ) { $page_title = mysql_real_escape_string($_POST['page_title']); } else { return false; }
	$page_url = isset($_POST['page_url']) ? mysql_real_escape_string($_POST['page_url']) : '';
	$page_lead_in = isset($_POST['page_lead_in']) ? mysql_real_escape_string($_POST['page_lead_in']) : '';
	$page_text = isset($_POST['page_text']) ? mysql_real_escape_string($_POST['page_text']) : '';

	if ( isset($_POST['page_id']) && $_POST['page_id'] != '' ) {
		$page_id = mysql_real_escape_string($_POST['page_id']);
		$query = "UPDATE " . $db_config['table_prefix'] . "pages SET allow_html = $allow_html, page_title = '$page_title', page_url = '$page_url', page_lead_in = '$page_lead_in', page_text = '$page_text', modified = NOW() WHERE page_id = $page_id";
		$result = mysql_query($query);
		if ( !$result ) { return false; }
		return $page_id;
	} else {
		$query = "SELECT MAX(page_id) AS page_id FROM " . $db_config['table_prefix'] . "pages";
		$result = mysql_query($query);
		if ( !$result ) { return false; }
		$row = mysql_fetch_assoc($result);
		$page_id = isset($row['page_id']) ? $row['page_id']+1 : 1;

		$query = "INSERT INTO " . $db_config['table_prefix'] . "pages (page_id, allow_html, page_title, page_url, page_lead_in, page_text, modified) VALUES ($page_id, $allow_html, '$page_title', '$page_url', '$page_lead_in', '$page_text', NOW())";
		$result = mysql_query($query);
		if ( !$result ) { return false; }
		return $page_id;
	}
}

function delete_page($id) {
    global $db_config;
	$query = "DELETE FROM " . $db_config['table_prefix'] . "pages WHERE page_id = $id";
	// Return TRUE or FALSE
	return mysql_query($query);
}

function list_pages() {
    global $db_config;
	$query = "SELECT * FROM " . $db_config['table_prefix'] . "pages";
	$result = mysql_query($query);
	if ( !$result ) { return false; }
	while ( $row = mysql_fetch_assoc($result) ) {
		$pages[] = $row;
	}
	if ( isset($pages) ) {
		return $pages;
	} else {
		return false;
	}
}

function get_page_id($url) {
    global $db_config;
	$query = "SELECT page_id FROM " . $db_config['table_prefix'] . "pages WHERE page_url = '$url'";
	$result = mysql_query($query);
	if ( !$result ) { return false; }
	$row = mysql_fetch_assoc($result);
	if ( !isset($row['page_id']) ) { return false; }
	return $row['page_id'];
}


db_connect();

?>
