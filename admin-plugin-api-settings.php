<?php 
 /**
  * ZRECommerce - Admin plugin - API Settings
  */
?>
<!-- ZRECommerce Storefront API Settings -->
<h1>ZRECommerce Storefront - API Settings</h1>
<div class="wrap">
	<form method="post" action="options.php">
		<?php settings_fields('zrecommerce_api'); ?>
		<?php do_settings_sections('zrecommerce_api'); ?>
		
		<table class="form-table">
	        <tr>
		        <th><?php echo __('API URL'); ?></th>
		        <td><input type="text" name="zrecore_api_url" value="<?php echo esc_attr( get_option('zrecore_api_url') ); ?>" /></td>
	        </tr>
	         
	        <tr>
		        <th><?php echo __('API User'); ?></th>
		        <td><input type="text" name="zrecore_api_user" value="<?php echo esc_attr( get_option('zrecore_api_user') ); ?>" /></td>
	        </tr>
	        
	        <tr>
		        <th><?php echo __('API Key'); ?></th>
		        <td><input type="text" name="zrecore_api_key" value="<?php echo esc_attr( get_option('zrecore_api_key') ); ?>" /></td>
	        </tr>
	        <tr>
		        <th><?php echo __('API Version'); ?></th>
		        <td><input type="text" name="zrecore_api_version" value="<?php echo esc_attr( get_option('zrecore_api_version') ); ?>" /></td>
	        </tr>
	    </table>
		<?php submit_button(); ?>
	</form>
</div>