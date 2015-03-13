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
$searchPosts = get_posts();

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
						<p>A quick search through our blog has yielded <?php echo $total_results ?> result(s).</p>	
					</div>
				</div>
			</div>
			<div class="body-container">
				<div class="flex-boxes">

				  <?php 
				  	
				    if (have_posts()):
				    	 /* Start the Loop */ 
		                 while ( have_posts() ) : the_post(); ?>

		                    <?php get_template_part( 'search', 'content' ); ?>

		                <?php 
		                endwhile;
				    else:
				  ?>
				  <?php get_template_part( 'no-results', 'search' ); ?>
				<?php endif; ?>
				</div>
			</div>
		</div>

		<?php get_template_part('footer-navigation'); ?>
        <?php get_footer() ?>
	</body>
</html>
