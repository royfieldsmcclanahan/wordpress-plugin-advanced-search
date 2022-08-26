<?php
/**
 * Plugin Name: Mojo Search
 * Plugin URI: https://www.marketing-mojo.com/wp-content/plugins/mojo-search/mojo-search.php
 * Description: A custom search plugin for Marketing Mojo
 * Version: 1.0
 * Author: Roy McClanahan
 * Author URI: https://www.marketing-mojo.com/
 */

add_action ('wp_ajax_mojo_search', 'mojo_search') ;
add_action ('wp_ajax_nopriv_mojo_search', 'mojo_search') ;

define("MAX_EXCERPT_LENGTH", 200);
define("RESULTS_PER_PAGE", '10');
define("PAGINATION_SPREAD", 3);  // how many sequential page numbers to display following the current page number
define("MAX_PARAM_CHARS", 128);

define("DIGITAL_ADVERTISING_CAT_ID", 2544);
define("SEO_CAT_ID", 2542);
define("MARKETING_DATA_ANALYTICS_CAT_ID", 2543);

require( '/opt/bitnami/apps/wordpress/htdocs/wp-content/plugins/mojo-search/check-key.php' );

function mojo_search() {
	// code for all GET requests. parameters include: 'blob', 'type', 'default', 'num' and 'page_changed'
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		header('Content-Type: text/html');
		//header("X-Robots-Tag: noindex, nofollow", true);

		$FILTER_COLOR = "#d46804";
		$MOJO_BLACK = "#35383b";
	?>

	<style>
		a {
			text-decoration:none;
		}
		.pagination {
			display: inline-block;
		}
		.pagination a.active {
			background-color: #ff6c0c;
			color: white;
		}

		.pagination a.page-gap {
			background-color: #ddd;
		}
		.pagination a:hover:not(.active) {
			background-color: #ccc;
		}
		a.pagination-button:hover {
			color:#797878 !important;
			cursor:pointer !important;
		}
		@media (min-width:1600px) {
			.top-text-container {
				width:680px;
				margin-left:auto;
				margin-right:auto;
				padding-top:10px;
				padding-bottom:25px;
			}
			.showing-results-for {
				font-size:22px;
				line-height:1.8;
				color:<?= $MOJO_BLACK ?>;
			}
			.pagination-icon {
				font-size:39px;
				font-weight:bold;
			}
			.pagination-ellipsis {
				font-size:30px;
				color:<?= $MOJO_BLACK ?>;
				font-weight:bold;
				padding-left:3px;
				padding-right:3px;
				position:relative;
				top:5px;
			}
			a.pagination {
				color: black;
				float: left;
				padding: 8px 16px;
				margin: 0px 4px;
				text-decoration: none;
				background-color:#eee;
				transition: background-color .3s;
				border-radius:10px;
				font-size:18px;
			}  
			a.pagination-button {
				color:#b9b9b9 !important;
				cursor:pointer !important;
				padding-left:7px;
				padding-right:7px;
				margin-top:auto;
				margin-bottom:auto;
			}
			.search-result-container {
				background-color:#fff;
				width:680px;
				margin-left:auto;
				margin-right:auto;
				padding-bottom:50px;
			}
			.post-type-blog {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-case-study {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-guide {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-webinar {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-website {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-infographic {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-tool {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-other {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.result-title {
				font-size:20px;
				color:#1a0dab;
				white-space:nowrap;
				max-width:520px;
				overflow:hidden;
				text-overflow:ellipsis;
				padding-top:5px;
				padding-bottom:5px;
			}
			.result-excerpt-container {
				line-height:1.1;
				max-width:550px;
			}
			.result-excerpt {
				font-size:16px;
				-ms-hyphens: auto;
				-moz-hyphens: auto;
				-webkit-hyphens: auto;
				hyphens: auto;
				word-break:break-word;
				color:<?= $MOJO_BLACK ?>;
			}
			.result-title-container {
				display:flex;
				justify-content:space-between;
				align-items:flex-start;
				width:100%;
			} 
			img.result-image {
				object-fit:cover;
				width:120px;
				height:120px;
				border-radius:10px;
			}
			.show-on-mobile {
				display:none;
			}
			.show-on-desktop {
				display:block;
			}
		}

		@media (min-width:1000px) and (max-width:1599px) {
			.top-text-container {
				width:680px;
				margin-left:auto;
				margin-right:auto;
				padding-top:10px;
				padding-bottom:25px;
			}
			.showing-results-for {
				font-size:22px;
				line-height:1.8;
				color:<?= $MOJO_BLACK ?>;
			}
			.pagination-icon {
				font-size:39px;
				font-weight:bold;
			}
			.pagination-ellipsis {
				font-size:30px;
				color:<?= $MOJO_BLACK ?>;
				font-weight:bold;
				padding-left:3px;
				padding-right:3px;
				position:relative;
				top:5px;
			}
			a.pagination {
				color: black;
				float: left;
				padding: 8px 16px;
				margin: 0px 4px;
				text-decoration: none;
				background-color:#eee;
				transition: background-color .3s;
				border-radius:10px;
				font-size:18px;
			}
			a.pagination-button {
				color:#b9b9b9 !important;
				cursor:pointer !important;
				padding-left:7px;
				padding-right:7px;
				margin-top:auto;
				margin-bottom:auto;
			}
			.search-result-container {
				background-color:#fff;
				width:680px;
				margin-left:auto;
				margin-right:auto;
				padding-bottom:50px;
			}
			.post-type-blog {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-case-study {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-guide {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-webinar {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-website {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-infographic {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-tool {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-other {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.result-title {
				font-size:20px;
				color:#1a0dab;
				white-space:nowrap;
				max-width:520px;
				overflow:hidden;
				text-overflow:ellipsis;
				padding-top:5px;
				padding-bottom:5px;
			}
			.result-excerpt-container {
				line-height:1.1;
				max-width:550px;
			}
			.result-excerpt {
				-ms-hyphens: auto;
				-moz-hyphens: auto;
				-webkit-hyphens: auto;
				hyphens: auto;
				word-break:break-word;
				font-size:16px;
				color:<?= $MOJO_BLACK ?>;
			}
			.result-title-container {
				display:flex;
				justify-content:space-between;
				align-items:flex-start;
				width:100%;
			} 
			img.result-image {
				object-fit:cover;
				width:120px;
				height:120px;
				border-radius:10px;
			}
			.show-on-mobile {
				display:none;
			}
			.show-on-desktop {
				display:block;
			}
		}

		@media (min-width:700px) and (max-width:999px) {		
			.top-text-container {
				width:680px;
				margin-left:auto;
				margin-right:auto;
				padding-top:10px;
				padding-bottom:25px;
			}
			.showing-results-for {
				font-size:22px;
				line-height:1.8;
				color:<?= $MOJO_BLACK ?>;
			}
			.pagination-icon {
				font-size:39px;
				font-weight:bold;
			}
			.pagination-ellipsis {
				font-size:30px;
				color:<?= $MOJO_BLACK ?>;
				font-weight:bold;
				padding-left:3px;
				padding-right:3px;
				position:relative;
				top:5px;
			}
			a.pagination {
				color: black;
				float: left;
				padding: 4px 8px;
				margin: 0px 4px;
				text-decoration: none;
				background-color:#eee;
				transition: background-color .3s;
				border-radius:10px;
				font-size:18px;
			}
			a.pagination-button {
				color:#b9b9b9 !important;
				cursor:pointer !important;
				padding-left:5px;
				padding-right:5px;
				margin-top:auto;
				margin-bottom:auto;
			}
			.search-result-container {
				background-color:#fff;
				width:680px;
				margin-left:auto;
				margin-right:auto;
				padding-bottom:50px;
			}
			.post-type-blog {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-case-study {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-guide {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-webinar {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-website {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-infographic {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-tool {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-other {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.result-title {
				font-size:20px;
				color:#1a0dab;
				white-space:nowrap;
				max-width:520px;
				overflow:hidden;
				text-overflow:ellipsis;
				padding-top:5px;
				padding-bottom:5px;
			}
			.result-excerpt-container {
				line-height:1.1;
				max-width:550px;
			}
			.result-excerpt {
				-ms-hyphens: auto;
				-moz-hyphens: auto;
				-webkit-hyphens: auto;
				hyphens: auto;
				word-break:break-word;
				font-size:16px;
				color:<?= $MOJO_BLACK ?>;
			}
			.result-title-container {
				display:flex;
				justify-content:space-between;
				align-items:flex-start;
				width:100%;
			}
			img.result-image {
				object-fit:cover;
				width:120px;
				height:120px;
				border-radius:10px;
			}
			.show-on-mobile {
				display:none;
			}
			.show-on-desktop {
				display:block;
			}
		}

		@media (min-width:0px) and (max-width:699px) {
			.top-text-container {
				width:90%;
				margin-left:auto;
				margin-right:auto;
				padding-top:10px;
				padding-bottom:12px;
			}
			.showing-results-for {
				font-size:20px;
				line-height:1.8;
				color:<?= $MOJO_BLACK ?>;
			}
			.pagination-icon {
				font-size:35px;
				font-weight:bold;
			}
			.pagination-ellipsis {
				font-size:24px;
				color:<?= $MOJO_BLACK ?>;
				font-weight:bold;
				padding-left:0px;
				padding-right:0px;
				position:relative;
				top:5px;
			}
			a.pagination {
				color: black;
				float: left;
				padding: 4px 4px;
				margin: 0px 4px;
				min-width:30px;
				text-align:center;
				text-decoration: none;
				background-color:#eee;
				transition: background-color .3s;
				border-radius:10px;
				font-size:18px;
			}
			a.pagination-button {
				color:#b9b9b9 !important;
				cursor:pointer !important;
				padding-left:5px;
				padding-right:5px;
				margin-top:auto;
				margin-bottom:auto;
			}
			.search-result-container {
				background-color:#fff;
				width:90%;
				margin-left:5%;
				margin-right:5%;
				padding-bottom:25px;
			}
			.post-type-blog {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
				padding-top:8px;
			}
			.post-type-case-study {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
				padding-top:8px;
			}
			.post-type-guide {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
				padding-top:8px;
			}
			.post-type-webinar {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
				padding-top:8px;
			}
			.post-type-website {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
				padding-top:8px;
			}
			.post-type-infographic {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-tool {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
			}
			.post-type-other {
				font-size:16px;
				color:<?= $FILTER_COLOR ?>;
				font-weight:bold;
				padding-top:8px;
			}
			.result-title {
				font-size:18px;
				color:#1a0dab;
				max-width:100%;
				padding-top:5px;
				padding-bottom:5px;
			}
			.result-excerpt-container {
				line-height:1.1;
				max-width:100%;
			}
			.result-excerpt {
				-ms-hyphens: auto;
				-moz-hyphens: auto;
				-webkit-hyphens: auto;
				hyphens: auto;
				word-break:break-word;
				font-size:16px;
				color:<?= $MOJO_BLACK ?>;
			}
			.result-title-container {
				display:flex;
				justify-content:space-between;
				align-items:flex-start;
				width:100%;
			} 
			img.result-image {
				object-fit:cover;
				width:80px;
				height:80px;
				border-radius:10px;
				padding-left:5px;
			}
			.result-separator {
				width:100%;
				height:5px;
				background-color:#eee;
				border-top:1px solid #ddd;
				border-bottom:1px solid #ddd;
			}
			.show-on-mobile {
				display:block;
			}
			.show-on-desktop {
				display:none;
			}
		}
	</style>

	<?php
		foreach ($_GET as $key => $value) {
			$params[$key] = $key != 'type' ? urldecode($value) : $value;
		}

		if (!isset($params['key'])) { exit("Access denied: API key not provided."); }	
		if (!check_api_key($params['key'])) { exit("API key expired. Please reload the page"); }

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
			),
			'infographic' => (object) array(
				'friendly_name' => 'infographic',
				'css_class' => 'post-type-infographic'
			),
			'tool' => (object) array(
				'friendly_name' => 'tool',
				'css_class' => 'post-type-tool'
			)
		];

		$cat_types = [
			'da' => DIGITAL_ADVERTISING_CAT_ID,
			'seo' => SEO_CAT_ID,
			'mda' => MARKETING_DATA_ANALYTICS_CAT_ID
		];

		$SearchResults = '';
		$ResultCount = 0;
		$TotalCount = 0;
		$ResultData = [];
		$blob = isset($params['blob']) ? substr($params['blob'], 0, MAX_PARAM_CHARS) : '';
		$blob_original = urlencode($blob);

		$type_unchecked = isset($params['type']) ? explode("+", substr($params['type'], 0, MAX_PARAM_CHARS)) : '';
		$type = [];
		$cats = [];
		foreach ($type_unchecked as $to_check) {
			if (isset($PostTypes[$to_check])) { $type[] = $to_check; }
			else if (isset($cat_types[$to_check])) { $cats[] = $cat_types[$to_check]; }
		}

		$page_num = isset($params['num']) ? $params['num'] : 1;
		if (!filter_var($page_num, FILTER_VALIDATE_INT) || $page_num < 1) {
			$page_num = 1;
		}	

		if (count($type) > 0) {
			if ($blob !== '') {
				if (count($cats) > 0) {
					$SearchResults = new WP_Query(array(
						'post_type' =>  $type,
						'post_status' => 'publish',
						'posts_per_page' => RESULTS_PER_PAGE,
						's' => $blob,
						'category__in' => $cats,
						//'relation' => 'AND',
						'orderby'   => 'date', 
						'order'     => 'DESC',
						'paged' => $page_num
						//'ignore_sticky_posts' => 1
					));
				}
				else {
					$SearchResults = new WP_Query(array(
						'post_type' =>  $type,
						'post_status' => 'publish',
						'posts_per_page' => RESULTS_PER_PAGE,
						's' => $blob,
						//'relation' => 'AND',
						'orderby'   => 'date', 
						'order'     => 'DESC',
						'paged' => $page_num
						//'ignore_sticky_posts' => 1
					));
				}
			}
			else {
				if (count($cats) > 0) {
					$SearchResults = new WP_Query(array(
						'post_type' =>  $type,
						'post_status' => 'publish',
						'posts_per_page' => RESULTS_PER_PAGE,
						'category__in' => $cats,
						//'relation' => 'AND',
						'orderby'   => 'date', 
						'order'     => 'DESC',
						'paged' => $page_num
						//'ignore_sticky_posts' => 1
					));
				}
				else {
					$SearchResults = new WP_Query(array(
						'post_type' =>  $type,
						'post_status' => 'publish',
						'posts_per_page' => RESULTS_PER_PAGE,
						//'relation' => 'AND',
						'orderby'   => 'date', 
						'order'     => 'DESC',
						'paged' => $page_num
						//'ignore_sticky_posts' => 1
					));
				}
			}

			if ($SearchResults !== '') {
				$ResultCount = $SearchResults->post_count;
				$TotalCount = $SearchResults->found_posts;

				while($SearchResults->have_posts()) {
					$SearchResults->the_post();

					$Excerpt = get_the_excerpt();
					$ShortExcerpt = trim(strlen($Excerpt) > MAX_EXCERPT_LENGTH ? substr($Excerpt, 0, MAX_EXCERPT_LENGTH) : $Excerpt) . "...";

					$ResultData[] = (object) ['id' => get_the_ID(),
											  'date' => get_the_date('F j, Y'),
											  'title' => get_the_title(),
											  'excerpt' => $ShortExcerpt,
											  'image' => has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'full') : "",
											  'permalink' => get_the_permalink(),
											  'post_type' => get_post_type()];
				}
				wp_reset_postdata();
			}

			$BaselineSearchURLNoBlob = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/search/";
			$BaselineSearchURL = $BaselineSearchURLNoBlob . "?blob={$blob_original}";

			echo "<div class=\"top-text-container\">";
			if ($ResultCount > 0) {
					echo "<div class=\"showing-results-for\">Found {$TotalCount} " . ($blob == '' ? "" : " search") . " result" . ($TotalCount > 1 ? "s" : "") . ($blob == '' ? "" : " for '{$blob}'</div>");
				//echo "<div class=\"show-results-alone-padding\"></div>";
				echo "</div></div>";

				$i = 1;
				foreach ($ResultData as $Result) {
					echo "<div class=\"search-result-container\">";

					if (isset($PostTypes[$Result->post_type])) {
						$FriendlyPostType = $PostTypes[$Result->post_type]->friendly_name;
						$PostTypeCSSClass = $PostTypes[$Result->post_type]->css_class;
					}
					else {
						$FriendlyPostType = "other";
						$PostTypeCSSClass = "post-type-other";
					}

					if ($Result->image != "") {
						$TitleClass = "result-title";
						$ExcerptClass = "result-excerpt-container";
					}
					else {
						$TitleClass = "result-title-stretch";
						$ExcerptClass = "result-excerpt-container-stretch";
					}

					$onclick_type = "{$params['type_clicked']}('{$Result->post_type}');";

					echo "<a onclick=\"{$onclick_type}\"><div class=\"{$PostTypeCSSClass}\">{$FriendlyPostType}</div></a>";

					echo "<a href=\"{$Result->permalink}\">";

					echo "<div class=\"result-title-container\">";

					echo "<div><div class=\"{$TitleClass}\">{$Result->title}</div><div style=\"display:flex;width:100%;"
						. "justify-content:space-between;\"><div class=\"{$ExcerptClass}\"><span class=\"result-excerpt\">{$Result->excerpt}</span></div>" 
						. ($TitleClass == "result-title" ? "<div class=\"show-on-mobile\"><img class=\"result-image\" "
						. "src=\"{$Result->image}\"></div></div>" : "</div>") . "</div>";

					echo ($TitleClass == "result-title") ? "<div class=\"show-on-desktop\"><img class=\"result-image\" "
						. "src=\"{$Result->image}\"></div></div></a></div>" : "</div></a></div>";

					if ($i != $ResultCount) {
						echo "<div class=\"show-on-mobile result-separator\"></div>";
					}

					$i++;
				}

				echo "<p></p>";

				$PaginationNumbers = getPaginationNumbers($page_num, $SearchResults->max_num_pages, PAGINATION_SPREAD);

				$PreviousPageNumber = $page_num > 1 ? $page_num - 1 : 1;
				$NextPageNumber = $page_num < $SearchResults->max_num_pages ? $page_num + 1 : $page_num;

				$onclick_previous = "{$params['page_changed']}({$PreviousPageNumber});";
				$onclick_next = "{$params['page_changed']}({$NextPageNumber});";
				$onclick_first = "{$params['page_changed']}(1);";
				$onclick_last = "{$params['page_changed']}({$SearchResults->max_num_pages});";

				/*$PreviousURL = "{$BaselineSearchURL}&num={$PreviousPageNumber}" . ($TypeFilterOriginal != "" ? "&type={$TypeFilterOriginal}" : "");
				$NextURL = "{$BaselineSearchURL}&num={$NextPageNumber}" . ($TypeFilterOriginal != "" ? "&type={$TypeFilterOriginal}" : "");
				$FirstPageURL = "{$BaselineSearchURL}&num=1" . ($TypeFilterOriginal != "" ? "&type={$TypeFilterOriginal}" : "");
				$LastPageURL = "{$BaselineSearchURL}&num={$SearchResults->max_num_pages}" . ($TypeFilterOriginal != "" ? "&type={$TypeFilterOriginal}" : "");*/

				echo "<div style=\"display:flex;align-items:center;justify-content:center;width:100%;\"><div><a class=\"pagination-button\" onclick=\"{$onclick_first}\"><i class=\"fa fa-angle-double-left pagination-icon\"></i></a></div>";
				echo "<div style=\"padding-right:3px;\"><a class=\"pagination-button\" onclick=\"{$onclick_previous}\"><i class=\"fa fa-angle-left pagination-icon\"></i></a></div>";

				$i = 1;
				$PaginationCount = count($PaginationNumbers);
				foreach ($PaginationNumbers as $Number) {
					if ($Number == -1) {
						echo "<div class=\"pagination-ellipsis\">...</div>";
						continue;
					}

					$Class = "pagination";

					if ($Number == $page_num) {
						$Class .= " active";
					}
					else if ($Number < $page_num && $i < $PaginationCount && ($PaginationNumbers[$i] - $Number) > 1) {
						$Class .= " page-gap";
					}
					else if ($Number > $page_num && $i > 1 && ($Number - $PaginationNumbers[$i-2]) > 1) {
						$Class .= " page-gap";
					}

					$onclick_number = "{$params['page_changed']}({$Number});";

					echo "<div class=\"pagination\"><a class=\"{$Class}\" onclick=\"{$onclick_number}\">{$Number}</a></div>";
					$i++;
				}
				echo "<div style=\"padding-left:3px;\"><a class=\"pagination-button\" onclick=\"{$onclick_next}\"><i class=\"fa fa-angle-right pagination-icon\"></i></a></div>";
				echo "<div><a class=\"pagination-button\" onclick=\"{$onclick_last}\"><i class=\"fa fa-angle-double-right pagination-icon\"></i></a></div></div>";

				//echo "<p>&nbsp;</p><p>&nbsp;</p>";
			}
			else
			{
				// show a 'no results' message
				echo "<p>No results! We couldn't find what you were looking for...</p>";
			}
			echo "</div>";
		}
		else {
			echo "<p></p>";
		}
		
		wp_die();

		//$data = array( 'test-key' => 'test-value', 'test-key2' => 'test-value2' );
		//echo json_encode($data);	
	}
}

	function getPaginationNumbers($CurrentPageNumber, $TotalNumberOfPages, $ConsecutiveCount) {
		$LeadingEdgeCases = [];
		$TrailingEdgeCases = [];
		$PaginationNumbers = [];

		$LastPage = $TotalNumberOfPages;
		$ConsecutiveCount = ($ConsecutiveCount > $LastPage ? $LastPage : $ConsecutiveCount);

		for ($i = 1; $i <= $ConsecutiveCount; $i++) {
			$LeadingEdgeCases[] = $i;
			$TrailingEdgeCases[] = $LastPage - $ConsecutiveCount + $i;
		}

		if (in_array($CurrentPageNumber, $LeadingEdgeCases)) {
			foreach ($LeadingEdgeCases as $EdgePageNumber) {
				if ($LastPage > $EdgePageNumber) {
					$PaginationNumbers[] = $EdgePageNumber;
				}
				else {
					break;
				}
			}

			if ($ConsecutiveCount + 1 < $LastPage) {
				$PaginationNumbers[] = $ConsecutiveCount + 1;
				if ($ConsecutiveCount + 2 < $LastPage) {
					$PaginationNumbers[] = -1;
				}
			}

			$PaginationNumbers[] = $LastPage;
		}
		else if (in_array($CurrentPageNumber, $TrailingEdgeCases)) {

			if ($TrailingEdgeCases[0] > 1) {
				$PaginationNumbers[] = ($TrailingEdgeCases[0] - 1);
			}

			foreach ($TrailingEdgeCases as $EdgePageNumber) {
				if ($EdgePageNumber <= 1) {
					continue;
				}
				else {
					$PaginationNumbers[] = $EdgePageNumber;
				}
			}
		}
		else {
			$LastConsecutivePage = $CurrentPageNumber + $ConsecutiveCount;

			if ($LastConsecutivePage >= $LastPage) {
				$LastConsecutivePage = $LastPage - 1;
			}

			$PaginationNumbers[] = $CurrentPageNumber;

			for ($i = $CurrentPageNumber+1; $i <= $LastConsecutivePage; $i++) {
				$PaginationNumbers[] = $i;
			}

			if ($CurrentPageNumber != $LastPage) {
				if ($LastConsecutivePage < ($LastPage - 1)) {
					$PaginationNumbers[] = -1;
				}
				$PaginationNumbers[] = $LastPage;
			}
		}

		return $PaginationNumbers;
	}