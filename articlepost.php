<article class="type-system-sans recent-post">
		
	<h2 id="<?php echo $post->post_type ?>-<?php echo $post->ID ?>">
		<a href="<?php echo get_permalink($post->ID); ?>">
		<?php echo apply_filters('the_title', $post->post_title); ?>
		</a>
	</h2>
	<p class="date"><?php echo get_the_date( null, $post->ID) ?></p>
  	<p>
      	<?php echo $post->post_content; ?>
  	</p>
  	<hr>
  	<p class="author"><?php the_author_meta('user_nicename', $post->post_author); ?></p>
  	
</article>