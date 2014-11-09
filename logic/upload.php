<?php
/*
 * Created on Jan 30, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

$cms_root = '../';

// Application startup
require_once($cms_root.'logic/app_start.php');

// STAGE 1
$stage = isset($_GET['stage']) ? $_GET['stage'] : '1';
// Pick the file you want to upload

switch ($stage) {
	case '1':
		// /gallery/gallery_id/img_id OR
		// /gallery/?gallery=gallery_id&img=img_id
		if ( isset($_SERVER['HTTP_REFERER']) ) {
			parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $jail);
		}
		if ( isset($_GET['gallery_id']) && $_GET['gallery_id'] != '' ) {
			$jail['gallery_id'] = $_GET['gallery_id'];
		}
		break;
	case '2':
		$jail['gallery_id'] = isset($_POST['gallery_id']) ? $_POST['gallery_id'] : '0';

		// Was a file uploaded?
		if ( isset($_FILES['upload']['error']) ) {
			switch ($_FILES['upload']['error']) {
				case 8:
					$jail['error'] = "There was a problem on the server! Trying again may solve it";
					$admin_errors[] = "File upload stopped by extension. Introduced in PHP 5.2.0.";
					break;
				case 7:
					$jail['error'] = "There was a problem on the server! Trying again may solve it.";
					$admin_errors[] = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
					break;
				case 6:
					$jail['error'] = "There was a problem on the server! Trying again may solve it.";
					$admin_errors[] = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
					break;
				case 4:
					$jail['error'] = "You must select a file to upload!";
					$admin_errors[] = 'No file was uploaded.';
					break;
				case 3:
					$jail['error'] = "The uploaded file was only partially uploaded. Try again!";
					$admin_errors[] = 'The uploaded file was only partially uploaded.';
					break;
				case 2:
					$jail['error'] = "The file selected is too large! Resize it and try again!";
					$admin_errors[] = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
					break;
				case 1:
					$jail['error'] = "The file selected is too large! Resize it and try again!";
					$admin_errors[] = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
					break;
			}
		}

		// Was it a jpeg image?
		if ( isset($_FILES['upload']['type']) && $_FILES['upload']['type'] != 'image/jpeg' && $_FILES['upload']['type'] != 'image/pjpeg' ) {
			$jail['error'] = "You must upload a jpeg image!";
			echo $jail['error'];
			return false;
		}

		// Get the filename and make it something we'll use
		$file_name = str_replace('.jpg', '.jpeg', str_replace(' ', '-', strtolower($_FILES['upload']['name'])));

		// Create a thumbnail
		$thumbnail_square_size = 120;
		// Are required image extensions available? IMPLEMENT LATER
		if ( !isset($_FILES['upload']['tmp_name']) ) { return false; }
		$originalInfo = getimagesize($_FILES['upload']['tmp_name']);
		list($img_width, $img_height) = array($originalInfo[0], $originalInfo[1]);
		if ( $img_width >= $img_height ) {
			$thumb_width = $thumbnail_square_size;
			// The following line makes an aspect ratio locked thumbnail
			// $thumb_height = round($img_height * $thumbnail_square_size / $img_width);
			// or we can have a square cropped job
			$thumb_height = $thumbnail_square_size;
		} else {
			// The following line makes an aspect ratio locked thumbnail
			// $thumb_width = round($img_width * $thumbnail_square_size / $img_height);
			// but we're going for a square cropped job
			$thumb_width = $thumbnail_square_size;
			$thumb_height = $thumbnail_square_size;
		}
		$thumb = imagecreatetruecolor($thumb_width, $thumb_height);

		$memoryNeeded = round(($originalInfo[0] * $originalInfo[1] * $originalInfo['bits'] * $originalInfo['channels'] / 8 + pow(2, 16)) * 1.8);
		if ( $memoryNeeded > 30000000 ) {
			ini_set('memory_limit', round((memory_get_usage() + $memoryNeeded)*1.3/(1024*1024)).'M');
		}
		$original = imagecreatefromjpeg($_FILES['upload']['tmp_name']);

		// Again, this would do a nice full image resize
		// imagecopyresized($thumb, $original, 0, 0, 0, 0, $thumb_width, $thumb_height, $img_width, $img_height);
		// ...but we want a cropped job, so we'll use the following 7 lines
		if ( $img_width >= $img_height ) {
			$offset = round( ($img_width-$img_height)/2 );
			imagecopyresized($thumb, $original, 0, 0, $offset, 0, $thumb_width, $thumb_height, $img_height, $img_height);
		} else {
			$offset = round( ($img_height-$img_width)/2 );
			imagecopyresized($thumb, $original, 0, 0, 0, $offset, $thumb_width, $thumb_height, $img_width, $img_width);
		}

		// Does the file already exist?
		$i = 1;
		$test_file_name = $file_name;
		while ( file_exists($cms_root.'assets/thumbnails/'.$test_file_name) ) {
			$test_file_name = str_replace('.jpeg', "-$i.jpeg", $file_name);
			$i++;
		}
		unset($i);
		$file_name = $test_file_name;

		// Move the thumbnail to the thumbnails folder
		imagejpeg($thumb, $cms_root.'assets/thumbnails/'.$file_name);

		// Free up memory
		imagedestroy($thumb);

		// Resize the original if necessary
		$max_image_width = 576;
		$max_image_height = 768;

		$width_reduction = $max_image_width / $img_width;
		$height_reduction = $max_image_height / $img_height;

		if ( $width_reduction <= $height_reduction && $width_reduction < 1 ) {
			$main_img_width = $max_image_width;
			$main_img_height = $width_reduction * $img_height;
			$main_img = imagecreatetruecolor($main_img_width, $main_img_height);
			imagecopyresized($main_img, $original, 0, 0, 0, 0, $main_img_width, $main_img_height, $img_width, $img_height);
			imagejpeg($main_img, $cms_root.'assets/'.$file_name);
			imagedestroy($main_img);
			unlink($_FILES['upload']['tmp_name']);
		} elseif ( $height_reduction < $width_reduction && $height_reduction < 1 ) {
			$main_img_width = $height_reduction * $img_width;
			$main_img_height = $max_image_height;
			$main_img = imagecreatetruecolor($main_img_width, $main_img_height);
			imagecopyresized($main_img, $original, 0, 0, 0, 0, $main_img_width, $main_img_height, $img_width, $img_height);
			imagejpeg($main_img, $cms_root.'assets/'.$file_name);
			imagedestroy($main_img);
			unlink($_FILES['upload']['tmp_name']);
		} else {
			rename($_FILES['upload']['tmp_name'], $cms_root.'assets/'.$file_name);
		}

		// Free up memory
		imagedestroy($original);

		$jail['file_name'] = $file_name;
		break;
	case '3':
		// Insert a new record into the database
		$jail['image_id'] = save_gallery_image();

		$jail['gallery_id'] = isset($_POST['gallery_id']) ? $_POST['gallery_id'] : '0';

		break;
}

db_disconnect();

$jail['stage'] = $stage;

$template_file = 'upload.tpl';

// Application de-brief
require_once($cms_root.'logic/app_end.php');

?>