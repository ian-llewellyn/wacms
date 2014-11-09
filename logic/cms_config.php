<?php
/*
 * Created on Dec 30, 2009
 */

// For handiness - just so that if global is required within a function, it needs one var only
$cms_config['cms_root'] = $cms_root;

// The public directory where the CMS in installed - this could be found automatically
$cms_config['cms_dir'] = '/';
$cms_dir = $cms_config['cms_dir'];

// Template Directory
$cms_config['template_dir'] = $cms_root;

// Database Type
$cms_config['db_type'] = 'mysql';

// Establish Exit Hooks array
$cms_config['exit_hooks'] = array();

// The timestamp of changes to CMS files
$modified = '20100124090909';

?>