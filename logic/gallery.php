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
	// Simple! mode was provided
	$mode = 'list';
} else {
	// $mode has to be set to something or the switch below will fail
	// We set it to 'list' whichw will be caught by default
	// If the id is set, mode will be set to 'view' below
	$mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
}

// Set the $id variable and reset $mode if necessary
if ( isset($_GET['id']) || isset($_POST['gallery_id']) ) {
	$id = isset($_GET['id']) ? $_GET['id'] : $_POST['gallery_id'];
	$mode = isset($_GET['mode']) ? $mode : 'view';
}

// Carry out image specific actions
// Then set the correct gallery mode
if ( isset($_POST['gallery_id']) && isset($_POST['image_order']) && isset($_POST['file_name']) && isset($_POST['title']) && isset($_POST['caption']) ) {
//echo "<h3>Image specific action!</h3>";
	switch ( $mode ) {
		case 'save':
			if ( isset($_POST['move']) && $_POST['move'] == 'up' ) {
			// * Moving a picture up
//echo "<h3>Moving Picture towards 0</h3>";
	
			} else if ( isset($_POST['move']) && $_POST['move'] == 'down' ) {
			// * Moving a picture down
//echo "<h3>Moving picture down and away from 0</h3>";
				
			} else {
			// * Updating the details of a picture
//echo "<h3>Last ELSE of IF</h3>";
				if ( save_gallery_image() === false ) { echo "There was a problem updating the image details: ".mysql_error(); }
			}
			$mode = 'view';
			break;

		case 'delete':
//echo "<h3>Deleting</h3>";
			if ( isset($_POST['file_name']) ) {
				if ( !delete_gallery_image() ) { echo "There was a problem deleting this image."; }
				unlink($cms_root.'assets/'.$_POST['file_name']);
				unlink($cms_root.'assets/thumbnails/'.$_POST['file_name']);
			}
			$mode = 'view';
			break;
	}
}

switch ( $mode ) {
	case 'edit':
		// Edit a gallery
		$gallery = get_gallery($id);
		foreach ( $gallery as $var_name => $var_value ) {
			$jail[$var_name] = htmlspecialchars($var_value);
		}
	case 'new':
		// Add a gallery
		$jail['page_title'] = 'Add / Edit Gallery';
		$template_file = 'addeditgallery.tpl';
		break;

	case 'save':
		// Wec ould be doing one of many things:
		// * Updating the name of a gallery
		// Save a gallery
//echo "<h3>Saving new gallery / Updating Gallery name</h3>";
		$id = save_gallery();

	case 'view':
		// View a gallery
		$gallery = list_gallery_images($id);
		if ( $gallery !== false ) {
			for ( $i = 0; $i < count($gallery); $i++ ) {
				$gallery[$i]['title'] = isset($gallery[$i]['title']) ? htmlspecialchars($gallery[$i]['title']) : '';
				$gallery[$i]['caption'] = isset($gallery[$i]['caption']) ? htmlspecialchars($gallery[$i]['caption']) : '';
			}
			$jail['gallery_images'] = $gallery;
		} else {
			// There were no images or a problem getting them
			$jail['error_message'] = "There are no images in this gallery yet!";
		}

		$jail['gallery_id'] = $id;

		$image_order = isset($_GET['image_id']) ? $_GET['image_id'] : 0;
		$image_order = isset($_POST['image_order']) ? $_POST['image_order'] : $image_order;
		if ( isset($gallery[$image_order]) ) {
			$starting_image = $gallery[$image_order];
			foreach ( $starting_image as $key => $value ) {
				$jail[$key] = $value;
			}
		} else if ( isset($gallery[0]) ) {
			$starting_image = $gallery[0];
			foreach ( $starting_image as $key => $value ) {
				$jail[$key] = $value;
			}
		}

		$gallery = get_gallery($id);
		$jail['gallery_name'] = isset($gallery['gallery_name']) ? $gallery['gallery_name'] : '';
		$jail['page_title'] = $jail['gallery_name'] . ' : ' . $jail['title'];

		$template_file = 'viewgallery.tpl';

		// Extra options for the admin navs	
		$jail['extra_admin_navs'][] = array('url' => '?mode=edit&id='.$id, 'title' => 'Edit gallery');
		$jail['extra_admin_navs'][] = array('url' => '?mode=delete&id='.$id.'" onClick="return confirm(\'Are you sure you want to delete this gallery?\nThis will delete all pictures within the gallery from the site.\')', 'title' => 'Delete gallery');

		break;

	case 'delete':
	// We could be trying to:
		// Delete an image, or
		// Delete a gallery
		if ( delete_gallery($id) ) {
			// Remove files from the server
			$gallery = list_gallery_images($id);
			foreach ( $gallery as $image ) {
				unlink($cms_root.'assets/thumbnails/'.$image['file_name']);
				unlink($cms_root.'assets/'.$image['file_name']);
			}
			unset($gallery);

			// Remove records from the database
			if ( !delete_gallery_images($id) ) {
echo "There was a problem removing images that were in this gallery. There may have been no images in the gallery!";
			}
		}
	default:
		// View a list of galleries
		$galleries = list_galleries();
		$i = 0;
		while ( $i < count($galleries) ) {
			if ( !isset($galleries[$i]['gallery_id']) ) {
$jail['admin_errors'][] = "There are no galleries to display";
				break;
			}
			$gallery_images = list_gallery_images($galleries[$i]['gallery_id']);

			if ( count($gallery_images) != 0 && isset($gallery_images[0]['file_name']) ) {
				$galleries[$i]['poster_image'] = $gallery_images[0]['file_name'];
			}
			$i++;
		}

		$jail['galleries'] = $galleries;
		$jail['page_title'] = 'Photo Galleries';
		$template_file = 'galleryindex.tpl';
}

// Get Navigation Links
$jail['navigation'] = navigation_links();

// Disconnect our database connection
db_disconnect();

// Application de-brief
require_once($cms_root.'logic/app_end.php');

?>