<?php

/* 
 Template Name: search
 */

require( '/opt/bitnami/apps/wordpress/htdocs/wp-content/plugins/mojo-search/get-key.php' );

get_header();

$LATEST_RESOURCES_ORANGE_TEXT_COLOR = "#eb5b00";
$FILTER_COLOR = "#d46804";
$APPLY_HOVER_COLOR = "#555";
$APPLY_HOVER_BG_COLOR = "#eee";
$APPLY_CONTROL_COLOR = "#888";
$FILTER_CONTROL_COLOR = "#888";
$MOJO_BLACK = "#35383b";

// list of allowed post types with friendly display-name provided
$PostTypes = [
    'post' => (object) array(
        'friendly_name' => 'blog',
        'css_class' => 'post-type-blog'
    ),
    'case-studies' => (object) array(
        'friendly_name' => 'case study',
        'css_class' => 'post-type-case-study'
    ),
    'guides' => (object) array(
        'friendly_name' => 'guide/checklist',
        'css_class' => 'post-type-guide'
    ),
    'webinars' => (object) array(
        'friendly_name' => 'webinar',
        'css_class' => 'post-type-webinar'
    ),
    'page' => (object) array(
        'friendly_name' => 'site page',
        'css_class' => 'post-type-website'
    )
];

?>

<style>
	.filter-label {
		color:<?= $FILTER_COLOR ?>;
		font-size:18px;
	}
	#resources-search-input-container {
		display:inline-block;
		padding-right:0;
		margin-right:0;
	}
	#resources-search-bar-container {
		display:flex;
		justify-content:flex-start;
		flex-wrap:nowrap;
		align-items:center;
		width:100%;
		margin-bottom:10px;
	}
	#resources-magnifying-glass-container {
		padding-left:0;
		margin-left:0;
		min-height:40px;
		height:40px;
		width:40px;
		border:1px solid <?= $LATEST_RESOURCES_ORANGE_TEXT_COLOR ?>;
		border-left:0;
		cursor:pointer;
	}
	#resource-magnifying-glass-img {
		width:30px;
		height:29px;
		margin-left:auto;
		margin-right:auto;
		margin-top:calc( calc(100% - 29px) / 2);
		margin-bottom:auto;
		padding:0;
	}
	.resources-search-input {
		font-size:18px;
		width:607px;
		height:40px;
		border:1px solid <?= $LATEST_RESOURCES_ORANGE_TEXT_COLOR ?>;
		border-right:0;
		outline:none;
	}
	a.pagination-disabled {
		color:#f1f1f1 !important;
		cursor:default !important;
	}
	a.pagination-disabled:hover {
		color:#f1f1f1 !important;
		cursor:default !important;
	}
	@media (min-width:1600px) {
		.apply-cancel-buttons {
			border: 1px solid <?= $APPLY_CONTROL_COLOR ?>;
			border-radius: 15px;
			font-size:13px;
			font-weight:bold;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			background-color:#fff;
			padding:5px;
			margin:3px;
			text-align:center;
			text-rendering:optimizeLegibility;
			cursor:pointer;
			transition: all 0.2s ease-in-out;
		}
		.apply-cancel-buttons:hover {
			border-color:<?= $APPLY_HOVER_COLOR ?>;
			color:<?= $APPLY_HOVER_COLOR ?>;
			background-color:<?= $APPLY_HOVER_BG_COLOR ?>;
		}
		.btn-orange {
			background-color:#ffffff;
			border: 1px solid #35383b;
			font-size:16px;
			font-weight:500;
			color:#35383b;
		}
		.btn-orange:hover {
			background-color:#d1d1d1;
			border-color:#35383b;
			font-size:16px;
			font-weight:500;
		}
		.div-active {
			display:block;
		}
		.div-inactive {
			display:none;
		}
		#slide-down-text {
			line-height:.9;
			color:<?= $FILTER_CONTROL_COLOR ?>;
			font-size:16px;
		}
		#slide-down-filter-button {
			line-height:.9;
			font-size:16px;
			color:<?= $FILTER_CONTROL_COLOR ?>;
			padding-right:10px;
		}
		#filter-check-mark {
			line-height:.9;
			font-size:16px;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			padding-left:5px;
		}
		#filter-check-mark:hover {
			color:<?= $APPLY_HOVER_COLOR ?>;
		}
		#filter-x-box {
			line-height:.9;
			font-size:16px;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			padding-left:5px;
		}
		#filter-x-box:hover {
			color:<?= $APPLY_HOVER_COLOR ?>;
		}
		.filter-container {
			width:680px;
			margin-left:auto;
			margin-right:auto;
		}
		.type-filter-container {
			display:flex;
			justify-content:start;
			flex-wrap:wrap;
			overflow-y: hidden;
			align-items:center;
			-webkit-transition: max-height 0.2s ease-in-out;
			-moz-transition: max-height 0.2s ease-in-out;
			-o-transition: max-height 0.2s ease-in-out;
			transition: max-height 0.2s ease-in-out;
		}
		.slide-up {
		  max-height: 0;
		}
		.slide-down {
		  max-height: 60px;
		}
		.filter-button {
			margin:7px;
			padding: 5px 15px 5px 15px;
			border-radius:20px;
			font-size:16px;
			color:<?= $FILTER_COLOR ?>;
			border:2px solid <?= $FILTER_COLOR ?>;
			cursor:pointer;
			text-align:center;
		}        
		.filter-button-clicked {
			background-color:<?= $FILTER_COLOR ?>;
			color:#fff;
		}
		.result-title-stretch {
			font-size:20px;
			color:#1a0dab;
			white-space:nowrap;
			max-width:650px;
			overflow:hidden;
			text-overflow:ellipsis;
			padding-top:5px;
			padding-bottom:5px;
		}
		.result-excerpt-container-stretch {
			line-height:1.1;
			max-width:680px;
		}
		.result-date {
			font-size:16px;
			color:#787878;
		}
	}

	@media (min-width:1000px) and (max-width:1599px) {
		.apply-cancel-buttons {
			border: 1px solid <?= $APPLY_CONTROL_COLOR ?>;
			border-radius: 15px;
			font-size:13px;
			font-weight:bold;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			background-color:#fff;
			padding:5px;
			margin:3px;
			text-align:center;
			text-rendering:optimizeLegibility;
			cursor:pointer;
			transition: all 0.2s ease-in-out;
		}
		.apply-cancel-buttons:hover {
			border-color:<?= $APPLY_HOVER_COLOR ?>;
			color:<?= $APPLY_HOVER_COLOR ?>;
			background-color:<?= $APPLY_HOVER_BG_COLOR ?>;
		}
		.btn-orange {
			background-color:#ffffff;
			border: 1px solid #35383b;
			font-size:16px;
			font-weight:500;
			color:#35383b;
		}
		.btn-orange:hover {
			background-color:#d1d1d1;
			border-color:#35383b;
			font-size:16px;
			font-weight:500;
		}
		.div-active {
			display:block;
		}
		.div-inactive {
			display:none;
		}
		#slide-down-text {
			line-height:.9;
			color:<?= $FILTER_CONTROL_COLOR ?>;
			font-size:16px;
		}
		#slide-down-filter-button {
			line-height:.9;
			font-size:16px;
			color:<?= $FILTER_CONTROL_COLOR ?>;
			padding-right:10px;
		}
		#filter-check-mark {
			line-height:.9;
			font-size:16px;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			padding-left:5px;
		}
		#filter-check-mark:hover {
			color:<?= $APPLY_HOVER_COLOR ?>;
		}
		#filter-x-box {
			line-height:.9;
			font-size:16px;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			padding-left:5px;
		}
		#filter-x-box:hover {
			color:<?= $APPLY_HOVER_COLOR ?>;
		}
		.filter-container {
			width:680px;
			margin-left:auto;
			margin-right:auto;
		}
		.type-filter-container {
			display:flex;
			justify-content:start;
			flex-wrap:wrap;
			overflow-y: hidden;
			align-items:center;
			-webkit-transition: max-height 0.2s ease-in-out;
			-moz-transition: max-height 0.2s ease-in-out;
			-o-transition: max-height 0.2s ease-in-out;
			transition: max-height 0.2s ease-in-out;
		}
		.slide-up {
		  max-height: 0;
		}
		.slide-down {
		  max-height: 60px;
		}
		.filter-button {
			margin:7px;
			padding: 5px 15px 5px 15px;
			border-radius:20px;
			font-size:16px;
			color:<?= $FILTER_COLOR ?>;
			border:2px solid <?= $FILTER_COLOR ?>;
			cursor:pointer;
			text-align:center;
		}        
		.filter-button-clicked {
			background-color:<?= $FILTER_COLOR ?>;
			color:#fff;
		}
		.result-title-stretch {
			font-size:20px;
			color:#1a0dab;
			white-space:nowrap;
			max-width:650px;
			overflow:hidden;
			text-overflow:ellipsis;
			padding-top:5px;
			padding-bottom:5px;
		}
		.result-excerpt-container-stretch {
			line-height:1.1;
			max-width:680px;
		}
		.result-date {
			font-size:16px;
			color:#787878;
		}
	}

	@media (min-width:700px) and (max-width:999px) {		
		.apply-cancel-buttons {
			border: 1px solid <?= $APPLY_CONTROL_COLOR ?>;
			border-radius: 15px;
			font-size:13px;
			font-weight:bold;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			background-color:#fff;
			padding:5px;
			margin:3px;
			text-align:center;
			text-rendering:optimizeLegibility;
			cursor:pointer;
			transition: all 0.2s ease-in-out;
		}
		.apply-cancel-buttons:hover {
			border-color:<?= $APPLY_HOVER_COLOR ?>;
			color:<?= $APPLY_HOVER_COLOR ?>;
			background-color:<?= $APPLY_HOVER_BG_COLOR ?>;
		}
		.btn-orange {
			background-color:#ffffff;
			border: 1px solid #35383b;
			font-size:16px;
			font-weight:500;
			color:#35383b;
		}
		.btn-orange:hover {
			background-color:#d1d1d1;
			border-color:#35383b;
			font-size:16px;
			font-weight:500;
		}
		.div-active {
			display:block;
		}
		.div-inactive {
			display:none;
		}
		#slide-down-text {
			line-height:.9;
			color:<?= $FILTER_CONTROL_COLOR ?>;
			font-size:16px;
		}
		#slide-down-filter-button {
			line-height:.9;
			font-size:16px;
			color:<?= $FILTER_CONTROL_COLOR ?>;
			padding-right:10px;
		}
		#filter-check-mark {
			line-height:.9;
			font-size:16px;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			padding-left:5px;
		}
		#filter-check-mark:hover {
			color:<?= $APPLY_HOVER_COLOR ?>;
		}
		#filter-x-box {
			line-height:.9;
			font-size:16px;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			padding-left:5px;
		}
		#filter-x-box:hover {
			color:<?= $APPLY_HOVER_COLOR ?>;
		}
		.filter-container {
			width:680px;
			margin-left:auto;
			margin-right:auto;
		}
		.type-filter-container {
			display:flex;
			justify-content:start;
			flex-wrap:wrap;
			overflow-y: hidden;
			align-items:center;
			-webkit-transition: max-height 0.2s ease-in-out;
			-moz-transition: max-height 0.2s ease-in-out;
			-o-transition: max-height 0.2s ease-in-out;
			transition: max-height 0.2s ease-in-out;
		}
		.slide-up {
		  max-height: 0;
		}
		.slide-down {
		  max-height: 60px;
		}
		.filter-button {
			margin:7px;
			padding: 5px 15px 5px 15px;
			border-radius:20px;
			font-size:16px;
			color:<?= $FILTER_COLOR ?>;
			border:2px solid <?= $FILTER_COLOR ?>;
			cursor:pointer;
			text-align:center;
		}        
		.filter-button-clicked {
			background-color:<?= $FILTER_COLOR ?>;
			color:#fff;
		}
		.result-title-stretch {
			font-size:20px;
			color:#1a0dab;
			white-space:nowrap;
			max-width:650px;
			overflow:hidden;
			text-overflow:ellipsis;
			padding-top:5px;
			padding-bottom:5px;
		}
		.result-excerpt-container-stretch {
			line-height:1.1;
			max-width:680px;
		}
		.result-date {
			font-size:16px;
			color:#787878;
		}
	}

	@media (min-width:0px) and (max-width:699px) {
		#resources-search-bar-container {
			justify-content:center;
		}
		#resources-search-input-container {
			padding-right:0;
		}
		.resources-search-input {
			padding-top:10px;
			font-size:22px;
			width:290px;
			padding-bottom:10px;
		}
		.apply-cancel-buttons {
			border: 1px solid <?= $APPLY_CONTROL_COLOR ?>;
			border-radius: 15px;
			font-size:13px;
			font-weight:bold;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			background-color:#fff;
			padding:5px;
			margin:3px;
			text-align:center;
			text-rendering:optimizeLegibility;
			cursor:pointer;
			transition: all 0.2s ease-in-out;
		}
		.apply-cancel-buttons:hover {
			border-color:<?= $APPLY_HOVER_COLOR ?>;
			color:<?= $APPLY_HOVER_COLOR ?>;
			background-color:<?= $APPLY_HOVER_BG_COLOR ?>;
		}
		.btn-orange {
			background-color:#ffffff;
			border: 1px solid #35383b;
			font-size:16px;
			font-weight:500;
			color:#35383b;
		}
		.btn-orange:hover {
			background-color:#1d1d1d1;
			border-color:#35383b;
			font-size:16px;
			font-weight:500;
		}
		.div-active {
			display:block;
		}
		.div-inactive {
			display:none;
		}
		#slide-down-text {
			line-height:.9;
			color:<?= $FILTER_CONTROL_COLOR ?>;
			font-size:16px;
		}
		#slide-down-filter-button {
			line-height:.9;
			font-size:16px;
			color:<?= $FILTER_CONTROL_COLOR ?>;
			padding-right:10px;
		}
		#filter-check-mark {
			line-height:.9;
			font-size:16px;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			padding-left:5px;
		}
		#filter-check-mark:hover {
			color:<?= $APPLY_HOVER_COLOR ?>;
		}
		#filter-x-box {
			line-height:.9;
			font-size:16px;
			color:<?= $APPLY_CONTROL_COLOR ?>;
			padding-left:5px;
		}
		#filter-x-box:hover {
			color:<?= $APPLY_HOVER_COLOR ?>;
		}
		.filter-container {
			width:90%;
			margin-left:auto;
			margin-right:auto;
		}
		.type-filter-container {
			display:flex;
			justify-content:center;
			flex-wrap:wrap;
			overflow-y: hidden;
			align-items:center;
			-webkit-transition: max-height 0.2s ease-in-out;
			-moz-transition: max-height 0.2s ease-in-out;
			-o-transition: max-height 0.2s ease-in-out;
			transition: max-height 0.2s ease-in-out;
		}
		.slide-up {
		  max-height: 0;
		}
		.slide-down {
		  max-height: 169px;
		}
		.filter-button {
			margin:7px;
			padding: 5px 15px 5px 15px;
			border-radius:20px;
			font-size:16px;
			color:<?= $FILTER_COLOR ?>;
			border:2px solid <?= $FILTER_COLOR ?>;
			cursor:pointer;
			text-align:center;
		}        
		.filter-button-clicked {
			background-color:<?= $FILTER_COLOR ?>;
			color:#fff;
		}
		.result-title-stretch {
			font-size:20px;
			color:#1a0dab;
			max-width:100%;
			padding-top:5px;
			padding-bottom:5px;
		}
		.result-excerpt-container-stretch {
			line-height:1.1;
			max-width:100%;
		}
		.result-date {
			font-size:16px;
			color:#787878;
		}
	}

	@media(min-width: 1025px)
	{
		.search-padding-top {
			padding-top:50px;
		}
		.show-results-alone-padding {
			padding-bottom:10px;
		}
	}

	@media(max-width: 1024px)
	{
		.search-padding-top {
			padding-top:22px;
		}
		.show-results-alone-padding {
			padding-bottom:10px;
		}
	}
</style>
<div class="search-padding-top"></div>
<?php
$types_cookie_ar = isset($_COOKIE['search_type']) ? explode(" ", strtolower($_COOKIE['search_type'])) : [];
$CaseStudiesClicked = in_array("case-studies", $types_cookie_ar) ? " filter-button-clicked" : "";
$WebinarsClicked = in_array("webinars", $types_cookie_ar) ? " filter-button-clicked" : "";
$GuidesClicked = in_array("guides", $types_cookie_ar) ? " filter-button-clicked" : "";
$SitePagesClicked = in_array("page", $types_cookie_ar) ? " filter-button-clicked" : "";
$BlogPostsClicked = in_array("post", $types_cookie_ar) ? " filter-button-clicked" : "";
echo "<div class=\"filter-container\">";
?>
<div id="resources-search-bar-container">
	<div id="resources-search-input-container">
		<input id="blob" class="form-input resources-search-input" tabindex="1" name="blob" type="text" onkeypress="handleSearchKeyPress(event);">
	</div>
	<div id="resources-magnifying-glass-container" onclick="updateBlobCookie();updateResults();">
		<img src="/wp-content/uploads/2021/06/orange-search-icon.png" id="resource-magnifying-glass-img">
	</div>
</div>
<?php
echo "<div id=\"type-filter-whole\" class=\"type-filter-container slide-down\">";
echo "<div class=\"filter-label\">Filter: </div>";
echo "<div data-name=\"page\" id=\"filter-site-pages\" class=\"filter-button{$SitePagesClicked}\" onclick=\"flipflopFilterButton(this);updateTypeCookie();updateResults();\">site pages</div>";
echo "<div data-name=\"case-studies\" id=\"filter-case-studies\" class=\"filter-button{$CaseStudiesClicked}\" onclick=\"flipflopFilterButton(this);updateTypeCookie();updateResults();\">case studies</div>";
echo "<div data-name=\"webinars\" id=\"filter-webinars\" class=\"filter-button{$WebinarsClicked}\" onclick=\"flipflopFilterButton(this);updateTypeCookie();updateResults();\">webinars</div>";
echo "<div data-name=\"guides\" id=\"filter-guides-checklists\" class=\"filter-button{$GuidesClicked}\" onclick=\"flipflopFilterButton(this);updateTypeCookie();updateResults();\">guides/checklists</div>";
echo "<div data-name=\"post\" id=\"filter-blog-posts\" class=\"filter-button{$BlogPostsClicked}\" onclick=\"flipflopFilterButton(this);updateTypeCookie();updateResults();\">blog</div>";
echo "</div>";
echo "</div>";
echo "<div id=\"results-and-pagination-container\"></div>";
echo "<p>&nbsp;</p><p>&nbsp;</p>";
get_footer();
?>
<script>
function flipflopFilterButton(element) {
    if (!element.classList.contains('filter-button-clicked')) {
        element.classList.add('filter-button-clicked');
    } else {
        element.classList.remove('filter-button-clicked');
    }
}

function handleSearchKeyPress(e){
	if(e.keyCode === 13){
		e.preventDefault(); // Ensure it is only this code that runs
		updateBlobCookie();
		updateResults();
	}
}

function updateBlobCookie() {
	let blob = document.getElementById('blob').value;
	
	// may need to clean blob before adding it to the cookie, or perhaps URL encode it if it doesn't happen automatically (we'll see)
	document.cookie = "search_blob=" + blob + "; path=/";
	
	// also reset the page number to 1 when the user enters a new search phrase
	document.cookie = "search_num=1; path=/";
}

function updateTypeCookie() {
	let clickedFilters = document.getElementsByClassName('filter-button-clicked'), type = '';

	for (var i = 0; i < clickedFilters.length; i++) {
		type += clickedFilters[i].getAttribute('data-name') + (i >= clickedFilters.length-1 ? '' : '+');
	}
	
	document.cookie = "search_type=" + type + "; path=/";
	
	// also reset page number cookie to 1 so user can start at beginning of filtered results
	document.cookie = "search_num=1; path=/";
}

function updatePageNumber(num = 1) {
	document.cookie = "search_num=" + num + "; path=/";
	updateResults();
}

function resetFilterAppearance() {
	var filterCaseStudies = document.getElementById('filter-case-studies');
    var filterWebinars = document.getElementById('filter-webinars');
    var filterGuides = document.getElementById('filter-guides-checklists');
    var filterPages = document.getElementById('filter-site-pages');
    var filterPosts = document.getElementById('filter-blog-posts');
    
    filterCaseStudies.className = 'filter-button';
    filterWebinars.className = 'filter-button';
    filterGuides.className = 'filter-button';
    filterPages.className = 'filter-button';
    filterPosts.className = 'filter-button';
}

function overrideType(type = '') {
	resetFilterAppearance();
	
	type = type.toLowerCase();
	
	switch (type) {
		case 'post':
			document.getElementById('filter-blog-posts').className = 'filter-button filter-button-clicked';
			break;
		case 'case-studies':
			document.getElementById('filter-case-studies').className = 'filter-button filter-button-clicked';
			break;
		case 'guides':
			document.getElementById('filter-guides-checklists').className = 'filter-button filter-button-clicked';
			break;
		case 'webinars':
			document.getElementById('filter-webinars').className = 'filter-button filter-button-clicked';
			break;
		case 'page':
			document.getElementById('filter-site-pages').className = 'filter-button filter-button-clicked';
			break;
		default:
	}
	
	updateTypeCookie();
	updateResults();
}

function updateResults() {
	let blob = '', type = '', num = 1;
	
	// read the cookie data if it exists
	const cookieString = decodeURIComponent(document.cookie);
	const cookies = cookieString.split('; ');

	cookies.forEach(val => {
		let keyval = val.split('=');

		if (keyval.length > 1) {
			if (keyval[0] === 'search_blob') {
				blob = keyval[1];
			}
			else if (keyval[0] === 'search_type') {
				type = keyval[1];
			}
			else if (keyval[0] === 'search_num') {
				num = keyval[1];
			}
		}
	});
	
	// sync all search fields to value of blob
	document.getElementById('blob').value = blob;
	document.getElementById('search-blob-textbox').value = blob;
	document.getElementById('mobile-nav-search').value = blob;
	
	if (!type) {
		document.cookie = "search_type=; path=/";
		type = 'post+case-studies+guides+webinars+page';
	}
	
	/*jQuery.ajax({
		method: 'GET',
        url: '/api/search/',
		data: {
			blob: blob,
			type: type,
			num: num,
			page_changed: 'updatePageNumber',
			type_clicked: 'overrideType',
			key:  '<?php echo get_api_key(); ?>'
		},
        dataType: 'html',
        success: function(data) {
            document.getElementById('results-and-pagination-container').innerHTML = data;
        }
    });*/
	jQuery.ajax({
		method: 'GET',
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
		data: {
			action: 'mojo_search',
			blob: blob,
			type: type,
			num: num,
			page_changed: 'updatePageNumber',
			type_clicked: 'overrideType',
			key:  '<?php echo get_api_key(); ?>'
		},
        dataType: 'html',
        success: function(data) {
            document.getElementById('results-and-pagination-container').innerHTML = data;
        }
    });
}

updateResults();
</script>