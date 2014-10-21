<?php
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));
if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb ('<li>Xuất kho</li>', '/' . $this->request->url, array ('escape' => false));
} else {
	$this->Html->addCrumb ('<li>Phiếu xuất' . $this->request->data['InoutWarehouse']['id'] . '</li>', '/' . $this->request->url, array ('escape' => false));
}
?>
<?php echo $this->Form->create ('InoutWarehouse', array (
														'class' => 'form-horizontal',
												  ));
echo $this->Html->css (
	array (
		  'select2'
	), array ('inline' => false)
);
echo $this->Html->script (
	array (
		  'select2',
		  //		  'jquery.maskMoney.min'
	), array ('block' => 'scriptBottom')
);
?>
<style>
	/*.modal {*/
		/*position: absolute;*/
	/*}*/
</style>
<!-- Row start -->
<div class="row">
	<div class="col-md-10">
		<div class="row">
			<div class="widget">
				<div class="widget-header">
					<div class="title">
						<span class="fs1" aria-hidden="true"
							  data-icon="&#xe039;"></span> <?php echo __ ('Thông tin xuất kho'); ?>
					</div>
				</div>
				<div class="widget-body">
					<?php
					echo $this->Form->input ('id');
					echo $this->Form->hidden ('type', array ('value' => 0));
					$this->Form->inputDefaults (array (
													  'format' => array ('before', 'label', 'between', 'input', 'error', 'after'),
													  'div' => array ('class' => 'form-group'),
													  'label' => array ('class' => 'col-lg-2 control-label'),
													  'between' => '<div class="col-lg-10">',
													  'after' => '</div>',
													  'class' => 'form-control',
													  'error' => array (
														  'attributes' => array (
															  'wrap' => 'span', 'class' => 'help-inline'
														  )
													  ),
												));
					$store_id = CakeSession::read ('Auth.User.store_id');
					echo $this->Form->hidden ('store_id', array ('value' => $store_id));
					?>
					<div class="form-group">
						<label for="InoutWarehouseStoreReceive" class="col-lg-2 control-label">Cửa hàng xuất</label>

						<div class="col-lg-10">
							<span class="form-control"><?php echo $stores[$store_id] ?></span>
						</div>
					</div>
					<?php
					unset($stores[$store_id]);
					echo $this->Form->input ('store_receive', array ('options' => $stores, 'label' => array ('text' => 'Cửa hàng nhận', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input ('customer_id', array ('empty' => true, 'label' => array ('text' => 'Tên khách hàng', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input ('total', array ('readonly' => true, 'label' => array ('text' => 'Tổng tiền', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input ('received', array ('label' => array ('text' => 'Đã nhận', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input ('refund', array ('label' => array ('text' => 'Tiền trả lại', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input ('note', array ('label' => array ('text' => 'Chi chú', 'class' => 'col-lg-2 control-label')));

					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="widget">
				<div class="widget-header">
					<div class="title">
						<span class="fs1" aria-hidden="true"
							  data-icon="&#xe036;"></span> <?php echo __ ('Thông tin hàng hoá'); ?>
					</div>
					<div class="pull-right">
						<button data-original-title="" class="btn btn-sm btn-success" type="button" id="select-button">
							Thêm hàng
						</button>

					</div>
				</div>
				<div class="widget-body">
					<table class="table table-condensed table-bordered table-hover no-margin">
						<thead>
						<th>Sản phẩm</th>
						<th>Ghi chú</th>
						<th>Thuộc tính</th>
						<th>Giá</th>
						<th>Số lượng</th>
						<th>Thành tiền</th>
						<th>Action</th>
						</thead>
						<tbody id="table-pro">
						<?php
						if (isset($this->request->data['InoutWarehouseDetail'])) {
							foreach($this->request->data['InoutWarehouseDetail'] as $key=>$item){
							?>
							<tr data-id="no_<?php echo $item['product_id']?>">
								<td><span><?php echo $item['name']?></span><input type="hidden"
																 name="data[InoutWarehouseDetail][<?php echo $key?>][product_id]"
																 value="<?php echo $item['product_id']?>">
									<input type="hidden"
										   name="data[InoutWarehouseDetail][<?php echo $key?>][name]"
										   value="<?php echo $item['name']?>">
								</td>
								<td><span class="note_<?php echo $item['product_id']?>"></span><input type="hidden" id="note_<?php echo $item['product_id']?>"
																	   name="data[InoutWarehouseDetail][<?php echo $key?>][note]"
																	   value="<?php echo $item['note']?>"></td>
								<td><span><?php echo $item['option_names']?></span><input type="hidden" id="options_<?php echo $item['product_id']?>"
															   name="data[InoutWarehouseDetail][<?php echo $key?>][options]"
															   value="<?php echo $item['options']?>"><input type="hidden" id="option_name_<?php echo $item['product_id']?>"
																				  name="data[InoutWarehouseDetail][<?php echo $key?>][option_names]"
																				  value="<?php echo $item['option_names']?>"></td>
								<td><span><?php echo $item['price']?></span><input type="hidden" id="price_<?php echo $item['product_id']?>"
																name="data[InoutWarehouseDetail][<?php echo $key?>][price]"
																value="<?php echo $item['price']?>"></td>
								<td><input name="data[InoutWarehouseDetail][<?php echo $key?>][qty]" id="qty_<?php echo $item['product_id']?>" class="qty"
										   type="number" value="<?php echo $item['qty']?>"></td>
								<td><span class="total_<?php echo $item['product_id']?>"><?php echo $item['total']?></span><input type="hidden" class="total" id="total_<?php echo $item['product_id']?>"
																				name="data[InoutWarehouseDetail][<?php echo $key?>][total]"
																				value="<?php echo $item['total']?>"></td>
								<td><a href="#" class="rm-btn" title="Xoá"><i class="glyphicon glyphicon-trash"></i></a>
								</td>
							</tr>
						<?php
							}
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="btn-group" style="position: fixed;bottom: 0; right: 0;z-index: 1;">
			<?php echo $this->Form->submit ('Lưu lại', array ('div' => false, 'class' => 'btn btn-success')) ?>
			<a class="btn btn-danger">Huỷ</a>
		</div>
		<?php echo $this->Form->end (); ?>
	</div>
	<div class="col-md-2" id="leftCol">
		<div class="widget">
			<div class="widget-header">
				<div class="title">
					<span class="fs1" aria-hidden="true"
						  data-icon="&#xe039;"></span> <?php echo __ ('Thao tác khác'); ?>
				</div>
			</div>
			<div class="widget-body">
				<ul class="nav nav-stacked" id="sidebar">
					<li><?php echo $this->Html->link (__ ('Danh sách xuất kho'), array ('controller' => 'inout_warehouses', 'action' => 'add')); ?> </li>
					<li><?php echo $this->Html->link (__ ('Chờ nhập kho'), array ('controller' => 'inout_warehouses', 'action' => 'in')); ?> </li>
					<li><?php echo $this->Html->link (__ ('Danh sách cửa hàng'), array ('controller' => 'stores', 'action' => 'index')); ?> </li>
				</ul>
			</div>
		</div>

	</div>
</div>


<!-- Add this html to your page -->
<div class="modal fade" id="product-list" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-original-title="">×
				</button>
				<h4 class="modal-title">Thêm hàng</h4>

				<div class="row well">
					<?php
					$this->Form->inputDefaults (array (
													  'format' => array ('before', 'label', 'between', 'input', 'error', 'after'),
													  'div' => array ('class' => 'row', 'style' => 'margin-bottom:5px'),
													  'between' => '<div class="col-lg-10">',
													  'after' => '</div>',
													  'style' => 'width:100%',

												));

					echo $this->Form->input ('categories', array ('options' => array (), 'label' => array ('text' => 'Danh mục', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input ('products', array ('options' => array (), 'label' => array ('text' => 'Hàng hoá', 'class' => 'col-lg-2 control-label')));
					?>
				</div>
			</div>
			<div class="modal-body">
				<div class="well-sm">
					<div class="row" id="content-pro">


					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="accept-selected" data-dismiss="modal"
						data-original-title="">Chấp nhận
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" data-original-title="">Đóng</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('#select-button').on('click', function () {
			var productContent = $('#content-pro');
			productContent.html('');

			var proDialog = $("#product-list").modal('show');
		});
		$.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'categories','admin'=>true,'action'=>'index'))?>'
		}).done(function (data) {
					$("#categories").html('');
					$("#categories").append(data)
				});
		$("#categories").select2().on("select2-selecting", function (e) {
			console.log("selecting val=" + e.val + " choice=" + e.object.text);
			$.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'products','admin'=>true))?>/index/' + e.val
			}).done(function (data) {
						$("#select2-chosen-2").text('');
						$("#products").html('');
						$("#products").append(data)
					});
		});
		$("#products").select2().on("select2-selecting", function (e) {
			console.log("selecting val=" + e.val + " choice=" + e.object.text);
			$.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'products','admin'=>true,'action'=>'view'))?>/' + e.val
			}).done(function (data) {
						$('#content-pro').html('');
						$('#content-pro').append(data);
					});
		});
		$('#content-pro').on('keyup mouseup change', '#ProductQty', function () {
			var qty = $(this).val();
			if(qty < 1) {
				$(this).val(1);
				$(this).change();
				return false;
			}
			var price = $('#content-pro #ProductPrice').val();
			var total = $(this).val() * price;
			$('#content-pro #ProductTotal').val(total);
		});

		$(document).on('keydown', '#table-pro tr .qty', function (e) {
			// Allow: backspace, delete, tab, escape, enter and .
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				// Allow: Ctrl+A
					(e.keyCode == 65 && e.ctrlKey === true) ||
				// Allow: home, end, left, right
					(e.keyCode >= 35 && e.keyCode <= 39)) {
				// let it happen, don't do anything
				return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
		$(document).on('keyup mouseup change', '#table-pro tr .qty', function (e) {
			var qty = $(this).val();
			if(qty < 1) {
				$(this).val(1);
				$(this).change();
				return false;
			}
			if (!isNaN(qty) && qty != '') {
				var id = $(this).closest('tr').data('id');
				id = id.replace('no_', '');
				var price = $(this).closest('tr').find('#price_' + id).val();
				var total = $(this).val() * price;
				$(this).closest('tr').find('#total_' + id).val(total);
				$(this).closest('tr').find('.total_' + id).text(total);
				updateTotal();
			} else {
				e.preventDefault();
				return false;
			}
		});
//		$(document).on('change', '#table-pro tr .qty', function (e) {
//			var qty = $(this).val();
//			if (!isNaN(qty) && qty != '') {
//				var id = $(this).closest('tr').data('id');
//				id = id.replace('no_', '');
//				var price = $(this).closest('tr').find('#price_' + id).val();
//				var total = $(this).val() * price;
//				$(this).closest('tr').find('#total_' + id).val(total);
//				$(this).closest('tr').find('.total_' + id).text(total);
//				updateTotal();
//			} else {
//				e.preventDefault();
//				return false;
//			}
//		});
		$(document).on('click', '#table-pro tr .rm-btn', function (e) {
			if (confirm("Bạn có muốn xoá sản phẩm này không?")) {
				$(this).closest('tr').remove();
				updateTotal();
			}
			e.preventDefault();
		});

		$('#accept-selected').on('click', function () {
			var form = $('#content-pro form');

			var id = form.find('#ProductId').val();
			var name = form.find('#ProductName').val();
			var note = form.find('#ProductNote').val();
			var optionNames = [];
			form.find('#ProductOptions').each(function () {

				optionNames.push($(this).find('option:selected').text());
			});
			var options = [];
			form.find('#ProductOptions').each(function () {
				options.push($(this).val());
			});
			var price = form.find('#ProductPrice').val();
			var qty = form.find('#ProductQty').val();
			var total = form.find('#ProductTotal').val();

			if (qty == 0 || isNaN(qty)) {
				alert('Vui lòng nhập số lượng.');
				return false;
			}

			var cont = true;
			$('#table-pro tr').each(function () {
				var option_field = $(this).find("#options_" + id).val();
				if ($(this).data('id') == 'no_' + id && option_field == options) {
					cont = false;
					var qty_field = $(this).find("#qty_" + id);
					var new_qty = (parseInt(qty_field.val()) + parseInt(qty));
					qty_field.val(new_qty);
					var total_field = $(this).find("#total_" + id);
					var new_total = (parseInt(total_field.val()) + parseInt(total));
					total_field.val(new_total);
					$(this).find(".total_" + id).text(new_total);
					if (note != '') {
						$(this).find("#note_" + id).val(note);
						$(this).find(".note_" + id).text(note);
					}
					return false;
				}
			});

			if (cont) {
				var idp = $('#table-pro tr').length;
				var template =
						'<tr data-id="no_{{id}}">' +
								'<td><span>{{name}}</span><input type="hidden" name="data[InoutWarehouseDetail][{{idp}}][product_id]" value="{{id}}">' +
								'<input type="hidden" name="data[InoutWarehouseDetail][{{idp}}][name]" value="{{name}}"></td>' +
								'<td><span class="note_{{id}}">{{note}}</span><input type="hidden" id="note_{{id}}" name="data[InoutWarehouseDetail][{{idp}}][note]" value="{{note}}"></td>' +
								'<td><span>{{optionNames}}</span><input type="hidden" id="options_{{id}}" name="data[InoutWarehouseDetail][{{idp}}][options]" value="{{options}}">' +
								'<input type="hidden" id="option_name_{{id}}" name="data[InoutWarehouseDetail][{{idp}}][option_names]" value="{{optionNames}}"></td>' +
								'<td><span>{{price}}</span><input type="hidden" id="price_{{id}}" name="data[InoutWarehouseDetail][{{idp}}][price]" value="{{price}}"></td>' +
								'<td><input name="data[InoutWarehouseDetail][{{idp}}][qty]" id="qty_{{id}}" class="qty" type="number" value="{{qty}}"></td>' +
								'<td><span class="total_{{id}}">{{total}}</span><input type="hidden" class="total" id="total_{{id}}" name="data[InoutWarehouseDetail][{{idp}}][total]" value="{{total}}"></td>' +
								'<td><a href="#" class="rm-btn" title="Xoá"><i class="glyphicon glyphicon-trash"></i></a></td>' +
								'</tr>';
				template = template.replace(/\{\{idp\}\}/g, idp);
				template = template.replace(/\{\{id\}\}/g, id);
				template = template.replace(/\{\{name\}\}/g, name);
				template = template.replace(/\{\{note\}\}/g, note);
				template = template.replace(/\{\{optionNames\}\}/g, optionNames);
				template = template.replace(/\{\{options\}\}/g, options);
				template = template.replace(/\{\{price\}\}/g, price);
				template = template.replace(/\{\{qty\}\}/g, qty);
				template = template.replace(/\{\{total\}\}/g, total);

				$('#table-pro').append(template);
			}
			updateTotal();
		});
	});
	function updateTotal() {
		var total = 0;
		$('#table-pro tr .total').each(function () {
			var subTotal = parseInt($(this).val());
			total += subTotal;
		});
		$('#InoutWarehouseTotal').val(total);
	}
</script>