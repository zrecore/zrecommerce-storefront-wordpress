<?php

/**
 * Search
 */

global $query_string;
global $wp_query;

// Preserve the search query during pagination
$query_args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

$search = new WP_Query($search_query);


// Get search results
$total_results = $wp_query->found_posts;
$searchResults = get_pages();

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <?php get_header() ?>
    <body>
    	<?php get_template_part('navigation'); ?>

    	<div class="main-container">
			<!-- Search -->
			<div class="hero">
				<div class="hero-inner">
			    <a href="" class="hero-logo"><img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="Logo Image"></a>
					<div class="hero-copy">
						<h1><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>'); ?></h1>
						<p>A quick search through our blog has yielded the following.</p>	
					</div>
				</div>
			</div>
			<div class="body-container">
				<div class="flex-boxes">

				  <?php 
				  	// $searchResults = 
				  ?>
				  <a href="javascript:void(0)" class="flex-box flex-box-big">
				    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_2_dark.png" alt="">
				    <h1 class="flex-title">A Wide Flex Box Item</h1>
				    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad nostrum, libero! Laborum distinctio necessitatibus voluptates eaque officiis, unde illo, earum voluptatum rerum, reiciendis ipsa ex dolorem a dicta, maxime aliquam.</p>
				  </a>
				  <a href="javascript:void(0)" class="flex-box">
				    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1_dark.png" alt="">
				    <h1 class="flex-title">Flex Box Item</h1>
				    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum molestiae fugiat tenetur fugit atque dignissimos, fugiat natus vitae.</p>
				  </a>
				  <a href="javascript:void(0)" class="flex-box">
				    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_3_dark.png" alt="">
				    <h1 class="flex-title">A Flex Box Item</h1>
				    <p>Lorem adipisicing elit. Voluptas consectetur tempora quis nam, officia tenetur blanditiis in illo dolor?</p>
				  </a>
				  <a href="javascript:void(0)" class="flex-box flex-box-big">
				    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_2_dark.png" alt="">
				    <h1 class="flex-title">Another Wide Item</h1>
				    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae quis ipsum, officia, aperiam tenetur dolor molestiae voluptate perferendis dolorem vel ex, unde fugit blanditiis sapiente.</p>
				  </a>
				  <a href="javascript:void(0)" class="flex-box">
				    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_2_dark.png" alt="">
				    <h1 class="flex-title">Flex Box Item</h1>
				    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo obcaecati in provident illo.</p>
				  </a>
				  <a href="javascript:void(0)" class="flex-box">
				    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_3_dark.png" alt="">
				    <h1 class="flex-title">Last Flex Box Item</h1>
				    <p>Lorem ipsum dolor sit amet, elit. Rem, illum.</p>
				  </a>
				</div>
			</div>
		</div>

		<?php get_template_part('footer-navigation'); ?>
        <?php get_footer() ?>
	</body>
</html>
