<a href="<?php echo esc_url(get_permalink()) ?>" class="flex-box flex-box-big">
	<img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_<?php echo get_post_type(get_the_ID()) == 'page' ? '2' : '1' ?>_dark.png" alt="">
	<h1 class="flex-title"><?php the_title(); ?></h1>
	<p><?php the_excerpt(); ?></p>
</a>