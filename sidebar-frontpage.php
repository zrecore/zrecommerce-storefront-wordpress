<?php

$featuredBullets = get_pages(array(
	'sort_order' => 'ASC',
	'sort_column' => 'menu_order',
	'meta_key' => 'is_featured',
	'meta_value' => '1'
));

if (!empty($featuredBullets)):
?>
<ul class="bullets">
<?php
	  $index = 1;
	  
	  foreach($featuredBullets as $page):
	  	$pageMeta = get_post_meta($page->ID);
?>
  <li class="bullet three-col-bullet">
    <div class="bullet-icon bullet-icon-<?php echo $index ?>">
      <img src="<?php echo preg_match('/^http/', $pageMeta['bullet_icon_url']) ? 
                        esc_url(array_shift($pageMeta['bullet_icon_url'])) : 
                        get_template_directory_uri() . '/assets/icons/' . array_shift($pageMeta['bullet_icon_url']) ?>" alt="">
    </div>
    <div class="bullet-content">
      <h2><?php echo apply_filters('the_title', $page->post_title); ?></h2>
      <p><?php echo apply_filters('the_content', $page->post_content); ?></p>
    </div>
  </li>
<?php
		++$index; 
	endforeach; 
	?>
</ul>
<?php else: ?>

<ul class="bullets">
  <li class="bullet three-col-bullet">
    <div class="bullet-icon bullet-icon-1">
      <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_2.png" alt="">
    </div>
    <div class="bullet-content">
      <h2>This Bullet Title</h2>
      <p>Please give three Pages the following custom fields: "is_featured", "bullet_icon_url". They are sorted by the "Order" page attribute.</p>
    </div>
  </li>
  <li class="bullet three-col-bullet">
    <div class="bullet-icon bullet-icon-2">
      <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_3.png" alt="">
    </div>
    <div class="bullet-content">
      <h2>Another Bullet Title</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, minus, blanditiis, voluptatibus nulla quia ipsam sequi quos iusto aliquam iste magnam accusamus molestias quo illum.</p>
    </div>
  </li>
  <li class="bullet three-col-bullet">
    <div class="bullet-icon bullet-icon-3">
      <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_4.png" alt="">
    </div>
    <div class="bullet-content">
      <h2>Last Bullet Title</h2>
      <p>Lorem ipsum sit amet consectetur adipisicing elit. Doloremque, minus, blanditiis, voluptatibus nulla quia ipsam sequi quos iusto aliquam iste magnam accusamus molestias quo illum impedit. Odit officia autem.</p>
    </div>
  </li> 
</ul>
<?php endif; ?>