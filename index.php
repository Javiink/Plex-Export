<?php
function nvl(&$var, $default = "")
{
    return isset($var) ? $var
                       : $default;
}
function ip_in_range($lower_range_ip_address, $upper_range_ip_address, $needle_ip_address) {
    # Get the numeric representation of the IP Address with IP2long
    $min    = ip2long($lower_range_ip_address);
    $max    = ip2long($upper_range_ip_address);
    $needle = ip2long($needle_ip_address);

    # Then it's as simple as checking whether the needle falls between the lower and upper ranges
    return ($needle >= $min) AND ($needle <= $max);
}
$localIP = $_SERVER['REMOTE_ADDR'];
$is_valid = false;
try {
    $check_result = ip_in_range('10.0.0.1', '10.0.15.255', $localIP);
    $is_valid = nvl($check_result, false);
} catch (exception $e) {
    $is_valid = false;
}
?>
<!DOCTYPE html "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head profile="http://www.w3.org/2005/10/profile">
	<meta charset=utf-8 />
	<title>Plex Export</title>
	<meta name="referrer" content="no-referrer">
	<meta name="viewport" content="initial-scale=1,minimum-scale=1,maximum-scale=1" />
	<link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

	<link rel="stylesheet" href="assets/css/style.css" type="text/css" />
	<link rel="stylesheet" media="all and (max-device-width: 480px)" href="assets/css/iphone.css">
	<link rel="stylesheet" media="all and (-webkit-min-device-pixel-ratio: 2)" href="assets/css/iphone-retina.css" />

    <script>var is_valid = <?php echo($is_valid ? 'true' : 'false'); ?>;</script>
	<script src="assets/js/jquery.1.4.4.min.js"></script>
	<script src="assets/js/utils.js"></script>
	<script src="assets/js/plex.js"></script>
	<script>
	jQuery(document).ready(function($){
		PLEX.run();
	});
	</script>
</head>

<body>
<div id="container">

	<div id="header">
		<h1><span>Plex Export</span></h1>
		<p><span>Library Items</span> <strong id="total_items"></strong></p>
	</div><!-- end #header -->

	<a href="#sidebar" id="toggle_sidebar">toggle sidebar</a>

	<div id="sidebar">

		<div class="sidebar-section">
			<h2>Library</h2>
			<ul class="sections-list" id="plex_section_list"><li>Loading...</li></ul>
		</div><!-- end .sidebar-section -->

		<div class="sidebar-section">
			<h2>Sort</h2>
			<ul class="generic-list" id="plex_sort_list">
				<li class="current" data-sort="title"><em>asc</em>By title</li>
				<li data-sort="rating">By rating</li>
				<li data-sort="release">By release date</li>
				<li data-sort="addedAt">By recently added</li>
			</ul>
		</div><!-- end .sidebar-section -->
	
		<div class="sidebar-section" id="plex_seen_list_section">
			<h2>Seen</h2>
			<ul class="generic-list" id="plex_seen_list">
			</ul>
		</div>

		<div class="sidebar-section" id="plex_genre_list_section">
			<h2>Genres</h2>
			<ul class="generic-list" id="plex_genre_list"></ul>
		</div><!-- end .sidebar-section -->

		<div class="sidebar-section" id="plex_director_list_section">
			<h2>Directors</h2>
			<ul class="generic-list" id="plex_director_list"></ul>
		</div><!-- end .sidebar-section -->

	</div><!-- end #sidebar -->

	<div id="main">

		<div id="section-header">
			<div>
				<input type="text" />
				<h2>Loading</h2>
				<p>Please wait while this section loads...</p>
			</div>
		</div><!-- end .section-header -->

		<div id="item-list-status">
			<p>Loading data from PLEX...</p>
		</div>

		<div id="item-list">
			<ul></ul>
		</div>

	</div><!-- end #main -->

	<div id="footer">
		<p><a href="https://www.plex.tv/">Plex</a> + <a href="http://hybridlogic.co.uk/code/standalone/plex-export/">Plex Export</a><span id="last_updated"></span></p>
	</div><!-- end #footer -->

</div><!-- end #container -->

<div id="popup-overlay"></div>
<div id="popup-container"></div>

</body>
</html>
