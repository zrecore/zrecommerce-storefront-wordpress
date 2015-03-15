<?php 
 /**
  * Home - Post listing.
  */
 $recentPosts = wp_get_recent_posts(array('numberposts' => 5, 'post_status' => 'publish', 'post_type' => 'post'), OBJECT);
?>
<div class="recent-posts-container">
<?php

 foreach($recentPosts as $recentPost):
?>
	
	<article class="type-system-sans recent-post">
		
		<h2 id="<?php echo $recentPost->post_type ?>-<?php echo $recentPost->ID ?>">
			<a href="<?php echo get_permalink($recentPost->ID); ?>">
			<?php echo apply_filters('the_title', $recentPost->post_title); ?>
			</a>
		</h2>
		<p class="date"><?php echo get_the_date( null, $recentPost->ID) ?></p>
      	<p>
	      	<?php echo $recentPost->post_content; ?>
      	</p>
      	<hr>
      	<p class="author"><?php the_author_meta('user_nicename', $recentPost->post_author); ?></p>
      	
	</article>
	<hr>
<?php 
 endforeach; ?>
</div>