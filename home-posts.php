<?php 
 /**
  * Home - Post listing.
  */
 $recentPosts = wp_get_recent_posts(array('numberposts' => 5, 'post_status' => 'publish', 'post_type' => 'post'), OBJECT);
?>
<div class="recent-posts-container">
<?php

 foreach($recentPosts as $recentPost):
 	$post = $recentPost;

 	get_template_part('articlepost');
?>
	
	
	<hr>
<?php 
 endforeach; ?>
</div>