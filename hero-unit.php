<?php 
$mainArticle = get_pages(array(
	'sort_order' => 'ASC',
	'sort_column' => 'menu_order',
	'meta_key' => 'is_main_article',
	'meta_value' => '1'
));

if (!empty($mainArticle)):
	foreach($mainArticle as $post): ?>
<div class="hero">
    <div class="hero-inner">
        <img src="<?php echo get_template_directory_uri() . '/assets/icons/logo-smartphone.png'; ?>" alt="Responsive Design">
        <img src="<?php echo get_template_directory_uri() . '/assets/icons/logo-node.png'; ?>" alt="Node JS">
        <img src="<?php echo get_template_directory_uri() . '/assets/icons/logo-arm.png'; ?>" alt="ARM Hardware">
        <img src="<?php echo get_template_directory_uri() . '/assets/icons/logo-php.png'; ?>" alt="PHP">
        <img src="<?php echo get_template_directory_uri() . '/assets/icons/logo-android.png'; ?>" alt="Android Development">
        <div class="hero-copy">
            <h1><?php echo apply_filters('the_title', $post->post_title); ?></h1>
      		<p><?php echo apply_filters('the_content', $post->post_content); ?></p>   
        </div>
    </div>
</div>
<?php 
	endforeach; 
else: ?>
<div class="hero">
    <div class="hero-inner">
        <a href="" class="hero-logo"><img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="Logo Image"></a>
        <div class="hero-copy">
            <h1>Short description of Product</h1>
            <p>Please give a page the following custom field, and set to "1": is_main_article</p>    
        </div>
        <button>Learn More</button>
    </div>
</div>
<?php 
endif; ?>