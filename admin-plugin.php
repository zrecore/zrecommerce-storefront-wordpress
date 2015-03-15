<?php 
 /**
  * ZRECommerce - Admin plugin page
  */
  $zrecore_api_url = get_option('zrecore_api_url');

?>
<!-- ZRECommerce Storefront Admin plugin -->
<h1 style="margin-bottom: 28px;">
	<img style="text-align: right; margin-bottom: -28px;" 
		 src="<?php echo get_template_directory_uri() . '/assets/icons/logo.png' ?>" 
		 alt="<?php echo __('Logo'); ?>"> ZRECommerce Storefront
</h1>
<?php if (!empty($zrecore_api_url)): ?>
<div class="wrap">
	<p>Current API end-point is <a href="<?php echo $zrecore_api_url ?>"><?php echo $zrecore_api_url; ?></a></p>
</div>

<?php else: ?>
<div class="">
	It seems the API URL setting is missing! Please go to the <a href="<?php echo admin_url('admin.php?page=zrecommerce-api-settings') ?>">API Settings</a> tab and update the API URL. If you don't have the 'zrecore-js' API running yet, why not <a href="http://github.com/zrecommerce/zrecore-js" target="_blank">set it up</a>?
</div>
<?php endif; ?>