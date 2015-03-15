<?php 
 /**
  * Home - Post listing.
  */
 $recentPosts = wp_get_recent_posts(null, OBJECT);
?>
<div class="recent-posts-container">
<?php

 foreach($recentPosts as $recentPost):
?>
	
	<article class="type-system-sans recent-post">
		
		<p class="type"><?php echo get_the_date( null, $post_id) ?></p>
		<h2><?php echo apply_filters('the_title', $recentPost->post_title); ?></h2>
		<p class="date"><?php echo get_the_date( null, $post_id) ?></p>
      	<p>
	      	<?php echo $recentPost->post_excerpt; ?>

	      	<a class="read-more" href="<?php echo get_permalink( 'post_author', $recentPost->ID ); ?>">Read</a>
      	</p>
      	<hr>
      	<p class="author"><?php the_author_meta('user_nicename', $recentPost->post_author); ?></p>
      	
	</article>
	<hr>
<?php 
 endforeach; ?>
</div>