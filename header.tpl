<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><wacms:if NOT page_title IS Home>{page_title} - </wacms:if NOT page_title IS Home>Trim Canoe Club<wacms:if page_title IS Home> - Home</wacms:if page_title IS Home></title>
		<link rel="stylesheet" type="text/css" href="{cms_dir}stylish.css" />
	</head>
	<body>
		<div id="site">
			<!-- Start Header -->
			<div id="header">
				<div id="site_info">
					<img src="{cms_dir}images/logo.gif" alt="Trim Canoe Club Logo" />
					<h1>Trim Canoe Club</h1>
					<p>Canoeing and Kayaking in Meath</p>
				</div>
				<div id="header_photos">
					<wacms:start header_images><img src="{cms_dir}assets/thumbnails/{file_name}" class="header_photos" /></wacms:end header_images>
				</div>
			</div><!-- End of Header -->

			<!-- Start Sidebar column below -->
			<div class="column twenty">
<wacms:if navigation>
				<div class="mpBox">
					<h3 class="template">Our Site</h3>
					<div class="mpBox_body">
						<ul class="navs">
<wacms:start navigation>							<li><a href="{url}">{title}</a></li>
</wacms:end navigation>						</ul>
					</div>
				</div>

</wacms:if navigation>
				<div id="administer" class="mpBox">
					<h3 class="template"><wacms:if NOT logged_in>Login</wacms:if NOT logged_in><wacms:if {logged_in} IS admin>Administer Site</wacms:if {logged_in} IS admin></h3>
					<div class="mpBox_body">
<wacms:if NOT logged_in>
						<form action="?log=in" method="post">
						Username: <input type="text" size="18" name="username" /><br />
						Password: <input type="password" size="18" name="password" /><br />
						<input type="submit" value="Login" /></form>
</wacms:if NOT logged_in><wacms:if {logged_in} IS admin>
						<ul class="navs">
<!--							<li><a href="#">Edit Our Site Links</a></li>-->
							<li><a href="{cms_dir}news/?mode=new">Add News Story</a></li>
							<li><a href="{cms_dir}events/?mode=new">Add Event</a></li>
							<li><a href="{cms_dir}gallery/?mode=new">Add a Gallery</a></li>
							<li><a href="{cms_dir}pages/?mode=new">Add a Page</a></li>
							<li><a href="{cms_dir}pages/">View Pages</a></li>
<wacms:if extra_admin_navs><wacms:start extra_admin_navs>							<li><a href="{url}">{title}</a></li>
</wacms:end extra_admin_navs></wacms:if extra_admin_navs>						</ul>
</wacms:if {logged_in} IS admin>					</div>
				</div>
			</div><!-- End Sidebar column -->

			<div class="column eighty">