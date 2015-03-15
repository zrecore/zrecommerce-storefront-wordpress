<?php 
 /**
  * ZRECommerce - Admin plugin - Orders
  */

 $query 	= getParam('query', null);
 $sort_by 	= getParam('sort_by', 'timestamp_added');
 $sort_order = getParam('sort_order', '-');
 $skip 		= getParam('skip', null);
 $limit 	= getParam('limit', 10);

 

 $zrecore_api_url 	= get_option('zrecore_api_url');
 $zrecore_api_user 	= get_option('zrecore_api_user');
 $zrecore_api_key 	= get_option('zrecore_api_key');
 $zrecore_api_version = get_option('zrecore_api_version');

 $modelOrder = new \Model\Order();
 $modelOrderItem = new \Model\OrderItem();

 $modelOrder->option('sort', $sort_order . $sort_by);
 $modelOrder->option('skip', $skip);
 $modelOrder->option('limit', $limit);

 $orders = $modelOrder->Get();

?>
<!-- ZRECommerce Storefront - Orders -->
<h1>ZRECommerce Storefront - Orders</h1>
<?php if (!empty($zrecore_api_url)): ?>

<div class="wrap">
	<form id="orders-filter" method="post">
	<!-- List orders -->
	<div class="tablenav top">
		<div class="alignleft actions bulkactions">
			<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
			<select name="action" id="bulk-action-selector-top">
				<option value="-1" selected="selected">Bulk Actions</option>
				<option value="shipped">Mark as shipped</option>
			</select>
			<input type="submit" name id="doaction" class="button action" value="Apply">
		</div>
	</div>
	<table class="wp-list-table widefat fixed striped">
		<tr>
			<th id="id" class="manage-column" style="width: 20%; min-width: 200px;">ID</th>
			<th id="order_details" class="manage-column">Order Details</th>
		</tr>

		<!-- If we have data, let's display it! -->
		<?php if (!empty($orders->result)): ?>
			<?php if (count($orders->data)): ?>
				<?php foreach($orders->data as $record): ?>
					<tr>
						<td><?php echo $record->_id ?></td>
						<td>
							<h3><?php echo $record->email; ?></h3>
							<div><?php echo $record->ip; ?></div>
							<div>
								<p><?php echo $record->address1 ?></p>
								<?php echo $record->address2 ? '<p>' . $record->address2 . '</p>' : '' ?>
								<p><?php echo $record->city ?>, <?php echo $record->state ?> <?php echo $record->postal_code ?> (<?php echo $record->country ?>)</p>
							</div>
							<?php if ($record->notes): ?>
							<div>
								Notes: <?php echo $record->notes ?>
							</div>
							<?php endif; ?>
							<div><?php echo $record->timestamp_added ?></div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else:?>
			<!-- No data. -->
			<tr>
				<td colspan="2">(No records found.)</td>
			</tr>
			<?php endif; ?>
		<?php else: ?>
		<!-- It seems our REST service isn't available for some reason -->
		<tr>
			<td colspan="2">(Something went wrong!)</td>
		</tr>
		<?php endif; ?>
	</table>
	</form>
</div>


<?php else: ?>
<div class="">
	It seems the API settings are missing! Please check your <a href="<?php echo admin_url('admin.php?page=zrecommerce-api-settings') ?>">API Settings</a> tab. If you don't have the 'zrecore-js' API running yet, why not <a href="http://github.com/zrecommerce/zrecore-js" target="_blank">set it up</a>?
</div>
<?php endif; ?>