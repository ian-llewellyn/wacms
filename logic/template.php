<?php
/*
 * Created on Jan 3, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function da_biz($template, $alpha = null) {
	echo '<div style="border: solid red 1px"><pre>'.htmlspecialchars($template).'</pre></div>';

	$alpha = is_null($alpha) ? $GLOBALS : $alpha;

	echo '<div style="border: solid yellow 1px"><pre>';
	print_r($alpha);
	echo "</pre></div>\n";
}

$cms_single_start = '<wacms:';
$cms_single_end = ' />';
$cms_open_start = '<wacms:';
$cms_open_end = '>';
$cms_close_start = '</wacms:';
$cms_close_end = '>';
$cms_command_delim = ' ';
$cms_param_delim = ' ';
$cms_string_start = '{';
$cms_string_end = '}';

// Discard failed blocks (0 = no, 1 = yes)
$crush = 1;

// QC PASS - 2010.01.04
function find_open_tag($template, $command, $params = null) {
	global $cms_open_start, $cms_open_end, $cms_command_delim;

	if ( !is_null($params) ) {
		// $params was provided
		$return['position'] = strpos($template, $cms_open_start.$command.$cms_command_delim.$params.$cms_open_end);
		$return['length'] = strlen($cms_open_start.$command.$cms_command_delim.$params.$cms_open_end);
		$return['params'] = $params;
	} else {
		// $params was not provided
		$return['position'] = strpos($template, $cms_open_start.$command);
		$end_pos = strpos($template, $cms_open_end, $return['position']);
		$return['length'] = $end_pos + strlen($cms_open_end) - $return['position'];
		$params_start_pos = $return['position'] + strlen($cms_open_start.$command.$cms_command_delim);
		$return['params'] = $end_pos < $params_start_pos ? false : substr($template, $return['position'] + strlen($cms_open_start.$command.$cms_command_delim), $end_pos - ($return['position'] + strlen($cms_open_start.$command.$cms_command_delim)));
	}

	// Catch the couple of failure scenarios
	$return = ($return['position'] === false) ? false : $return;
	$return = ($return['length'] == 0) ? false : $return;

	return $return;
}

// QC PASS - 2010.01.04
function find_close_tag($template, $command, $params = null) {
	global $cms_close_start, $cms_close_end, $cms_command_delim;

	if ( !is_null($params) ) {
		// $params was provided and not blank
		$return['position'] = strpos($template, $cms_close_start.$command.$cms_command_delim.$params.$cms_close_end);
		$return['length'] = strlen($cms_close_start.$command.$cms_command_delim.$params.$cms_close_end);
		$return['params'] = $params;
	} else {
		// $params was blank or not provided
		$return['position'] = strpos($template, $cms_close_start.$command);	
		$end_pos = strpos($template, $cms_close_end, $return['position']);
		$return['length'] = $end_pos + strlen($cms_close_end) - $return['position'];
		$params_start_pos = $return['position'] + strlen($cms_close_start.$command.$cms_command_delim);
		$return['params'] = $end_pos < $params_start_pos ? null : substr($template, $return['position'] + strlen($cms_close_start.$command.$cms_command_delim), $end_pos - ($return['position'] + strlen($cms_close_start.$command.$cms_command_delim)));
	}

	// Catch the couple of failure scenarios
	$return = ($return['position'] === false) ? false : $return;
	$return = ($return['length'] == 0) ? false : $return;

	return $return;
}

// QC PASS - 2010.01.04
function find_single_tag($template, $command, $params = null) {
	// Tag of the form "<wacms:include navigation.tpl />"
	global $cms_single_start, $cms_single_end, $cms_command_delim;

	if ( !is_null($params) ) {
		// $params was provided
		$return['position'] = strpos($template, $cms_single_start.$command.$cms_command_delim.$params.$cms_single_end);
		$return['length'] = strlen($cms_single_start.$command.$cms_command_delim.$params.$cms_single_end);
		$return['params'] = $params;
	} else {
		// $params was not provided
		$return['position'] = strpos($template, $cms_single_start.$command);
		$end_pos = strpos($template, $cms_single_end, $return['position']);
		$return['length'] = $end_pos + strlen($cms_single_end) - $return['position'];
		$params_start_pos = $return['position'] + strlen($cms_single_start.$command.$cms_command_delim);
		$return['params'] = $end_pos < $params_start_pos ? null : substr($template, $return['position'] + strlen($cms_single_start.$command.$cms_command_delim), $end_pos - ($return['position'] + strlen($cms_single_start.$command.$cms_command_delim)));
	}

	// Catch the couple of failure scenarios
	$return = ($return['position'] === false) ? false : $return;
	$return = ($return['length'] == 0) ? false : $return;

	return $return;
}

// QC PASS - 2010.01.07
function resolve_strings(&$template, $alpha = null) {
	global $cms_string_start, $cms_string_end, $crush;

	// Pull in the context
	is_null($alpha) ? $alpha = &$GLOBALS : 0;

	$offset = 0;
	while ( ($string_start_pos = strpos($template, $cms_string_start, $offset)) !== false ) {
		$offset = $string_start_pos + 1;
		$string_end_pos = strpos($template, $cms_string_end, $offset);

		// Strip the variable name from the template
		$var_name = substr($template, $string_start_pos + strlen($cms_string_start), $string_end_pos - ($string_start_pos + strlen($cms_string_start)));

		// Check that it's a valid varioable name
		$illegal_chars = array("'", "\t", "\n", " ", "!", "{", '"');
		foreach ( $illegal_chars as $char ) {
			if ( strpos($var_name, $char) !== false ) {
				continue 2;
			}

		}

		// Make the substitution
		if ( is_array($alpha) && array_key_exists($var_name, $alpha) && !is_null($alpha[$var_name]) && !is_array($alpha[$var_name]) ) {
			// The variable exists in the context provided.
			$template = substr_replace($template, $alpha[$var_name], $string_start_pos, $string_end_pos + strlen($cms_string_end) - $string_start_pos);
		} elseif ( $crush == 1 ) {
			// The variable doesn't exist or is an array in the context provided,
			// and we've been requested to crush the template in the case of failure
			$template = substr_replace($template, '', $string_start_pos, $string_end_pos + strlen($cms_string_end) - $string_start_pos);
		}
	}
}

// QC PASS - 2010.01.10
function test_ifs(&$template, $alpha = null) {
	global $cms_param_delim, $crush;

	// Pull in the context
	is_null($alpha) ? $alpha = &$GLOBALS : 0;

	// Set up the offset
	$offset = 0;
	while ( ($if_start = find_open_tag(substr($template, $offset), 'if')) !== false ) {
		// Catch the failure scenario
		if ( $if_start === false ) {
			// There are no if statements in the template that was passed in
			return false;
		}
		// Adjust offset and correct $if_start['position'] as a result of substr()
		$offset = $if_start['position'] += $offset;

		// Get the end position
		$if_end = find_close_tag(substr($template, $offset), 'if', $if_start['params']);
		// Catch the other failure scenario
		if ( $if_end === false ) {
			// There is no closing tag corresponding to the open tag that was found
			$offset++;
			continue;
		}

		// Correct the $if_end['position'] to account for the substr() on the input string
		$if_end['position'] += $offset;

		// Get the list of parameters
		$params = explode($cms_param_delim, $if_start['params']);

		// Required for the strpos in the while loop below
		$quote_offset = 0;

		// This toggle will maintain wheither or not the next $params[]
		// needs to be concatenated
		$concat_toggle = 0;

		for ( $param_index = 0; $param_index < count($params); $param_index++ ) {
			// THIS MAY NOT BE REQUIRED AS resolve_strings() IS CALLED
			// ON AN ENTIRE BLOCK BEFORE test_ifs() IS CALLED ON IT
			// Furthermore, if it's called here, the elements of $if_start
			// and $if_end may no longer be relevant...
			// Resolve any template strings that are in the if statement
			//resolve_strings($params[$param_index], $alpha);

			while ( false !== $quote_pos = strpos($params[$param_index], '"', $quote_offset) ) {
				// Test for back slash escaping
				// if there is an even number of \s, continue as normal
				// if there is an odd number, $offset++ and break back to
				//  quote finding while...


				// Remove the quote
				$params[$param_index] = substr_replace($params[$param_index], '', $quote_pos, 1);

				// Toggle the requirement to pull in the next $params[]
				$concat_toggle = $concat_toggle == 0 ? 1 : 0;
			}
			if ( $concat_toggle == 1 ) {
				// Concatenate the next $params[]
				$params[$param_index] .= ' '.$params[$param_index+1];
				// ... and remove that param from the array
				unset($params[$param_index+1]);

				// Re-index the array
				$params = array_values($params);

				// Decrement $param_index to counter the automatic ++ in the for loop
				// This is needed to reprocess the original param post concatenation
				$param_index--;
			} else {
				$quote_offset = 0;
			}
		}

		// LOGICAL IF PROCESSING
		if ( ($param_count = count($params)) == 1 || $param_count == 2 ) {
			$test = ( isset($alpha[$params[$param_count-1]]) &&
				!is_null($alpha[$params[$param_count-1]]) &&
				$alpha[$params[$param_count-1]] !== false &&
				count($alpha[$params[$param_count-1]]) != 0 &&
				$alpha[$params[$param_count-1]] !== '' );
		} elseif ( $param_count == 3 || $param_count == 4 ) {
			switch ( $params[$param_count-2] ) {
				case 'IS':
					$test = $params[$param_count-3] == $params[$param_count-1] ? true : false;
					break;
				case 'GT':

					break;
				case 'LT':

					break;
				case 'GTE':

					break;
				case 'LTE':

					break;
				case 'HAS':

					break;
			}
		} else {
			$test = false;
		}
		$test = ($param_count == 2 || $param_count == 4) && $params[0] == 'NOT' ? !$test : $test;

		// RESULT HANDLING
		if ( $test ) {
			// Strip the if tags leaving the rest of the template intact - start from
			// the end so the ['position'] values don't have to change post removal
			$template = substr_replace($template, '', $if_end['position'], $if_end['length']);
			$template = substr_replace($template, '', $if_start['position'], $if_start['length']);
		} elseif ( $crush == 1 ) {
			// Crush entire block
			$template = substr_replace($template, '', $if_start['position'], $if_end['position'] + $if_end['length'] - $if_start['position']);
		} else {
			// If nothing matches, $template will be untouched
			// Move to offset on
			$offset++;
		}
	}
}

// QC PASS - 2010.01.13
function do_includes(&$template) {
	global $cms_config;

	while ( false !== $include = find_single_tag($template, 'include') ) {
		// Inherent Error handling
		$include_file = (strstr($include['params'], '../') === false && file_exists($cms_config['template_dir'].$include['params'])) ? file_get_contents($cms_config['template_dir'].$include['params']) : '';
		// Include the file if it exists, crush otherwise
		$template = substr_replace($template, $include_file, $include['position'], $include['length']);
	}
}

// QC PASS - 2010.01.09
function process_block(&$template, $alpha = null) {
	global $crush;
// A bit of a hack until further thinking can go into it!
$old_crush = $crush;
	// If no master scope is supplied, use the $GLOBALS scope -
	// this should never happen because this function is called
	// from another function which checks the very same thing.
	$alpha = is_null($alpha) ? $GLOBALS : $alpha;

	while ( ($block_start = find_open_tag($template, 'start')) !== FALSE ) {
		$block_end = find_close_tag($template, 'end', $block_start['params']);

		if ( isset($alpha[$block_start['params']]) &&
			is_array($alpha[$block_start['params']]) &&
			count($alpha[$block_start['params']]) != 0	) {

			$block_expanded = '';
			foreach ( $alpha[$block_start['params']] as $beta ) {
				if ( !is_array($beta) ) continue;
// A bit of a hack until further thinking can go into it!
$crush = 0;
				$block_code = substr($template, $block_start['position']+$block_start['length'], $block_end['position'] - ($block_start['position']+$block_start['length']));
				// Beta arrays become the alpha array so...
				process_block($block_code, $beta);
				// ...we resolve the beta variables separately
				resolve_strings($block_code, $alpha[$block_start['params']]);
				// Build up the repetitive block
				$block_expanded .= $block_code;
// A bit of a hack until further thinking can go into it!
$crush = $old_crush;
			}

			$template = substr_replace($template, $block_expanded, $block_start['position'], $block_end['position']+$block_end['length']-$block_start['position']);
		} elseif ( $crush == 1 ) {
			$template = substr_replace($template, '', $block_start['position'], $block_end['position']+$block_end['length']-$block_start['position']);
		}
	}

	// Replace the strings if they exist in the current "alpha" context
	resolve_strings($template, $alpha);
// A bit of a hack until further thinking can go into it!
$crush = 1;
	// Strips the if statements if true, leaves them if false, removes the blocks if crush is set
	test_ifs($template, $alpha);
// A bit of a hack until further thinking can go into it!
$crush = $old_crush;
}

// 2010.01.09
function process_template(&$template, $alpha = null) {
	// If no master variable scope is provided, use the $GLOBALS scope
	$alpha = is_null($alpha) ? $GLOBALS : $alpha;

	// Include the includes
	do_includes($template);

	// Send for further processing
	process_block($template, $alpha);
}

?>
