<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<?= $this->include('layouts/navigation'); ?>
	<?= $this->include('layouts/header'); ?>
	<main class="content">
		<div class="container-fluid p-0">

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title"><?= $page_name ?></h5>
							<hr class="my-4">
							<?php $serialize_permission = unserialize($user_role['permissions']); ?>
							<?= form_open('/privileges/'.$user_role['role_id']) ?>
								<table id="datatables-permission" class="table table-striped table-responsive">
									<thead>
										<tr>
											<th>Permission</th>
											<th class="text-center">Add</th>
											<th class="text-center">Edit</th>
											<th class="text-center">View</th>
											<th class="text-center">Delete</th>
										</tr>
									</thead>
									<tbody>
										
										<tr>
											<td><strong>Voucher System</strong></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="addVoucher" id="permission" <?php if($serialize_permission) { if(in_array('addVoucher', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="editVoucher" id="permission" <?php if($serialize_permission) { if(in_array('editVoucher', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="viewVoucher" id="permission" <?php if($serialize_permission) { if(in_array('viewVoucher', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="deleteVoucher" id="permission" <?php if($serialize_permission) { if(in_array('deleteVoucher', $serialize_permission)) { echo "checked"; } } ?>></td>
										</tr>

										<tr>
											<td><strong>Users</strong></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="addUser" id="permission" <?php if($serialize_permission) { if(in_array('addUser', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="editUser" id="permission" <?php if($serialize_permission) { if(in_array('editUser', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="viewUser" id="permission" <?php if($serialize_permission) { if(in_array('viewUser', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="deleteUser" id="permission" <?php if($serialize_permission) { if(in_array('deleteUser', $serialize_permission)) { echo "checked"; } } ?>></td>
										</tr>
										
										<tr>
											<td><strong>Permissions</strong></td>
											<td class="text-center">-</td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="editPermission" id="permission" <?php if($serialize_permission) { if(in_array('editPermission', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center">-</td>
											<td class="text-center">-</td>
										</tr>
										<tr>
											<td><strong>Process Payment</strong></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="addProcessPayment" id="permission" <?php if($serialize_permission) { if(in_array('addProcessPayment', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center">-</td>
											<td class="text-center">-</td>
											<td class="text-center">-</td>
										</tr>
										<tr>
											<td><strong>Approve Payment</strong></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="addApprovePayment" id="permission" <?php if($serialize_permission) { if(in_array('addApprovePayment', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center">-</td>
											<td class="text-center">-</td>
											<td class="text-center">-</td>
										</tr>
										<tr>
											<td><strong>Administration</strong></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="addSetting" id="permission" <?php if($serialize_permission) { if(in_array('addSetting', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="editSetting" id="permission" <?php if($serialize_permission) { if(in_array('editSetting', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="viewSetting" id="permission" <?php if($serialize_permission) { if(in_array('viewSetting', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="deleteSetting" id="permission" <?php if($serialize_permission) { if(in_array('deleteSetting', $serialize_permission)) { echo "checked"; } } ?>></td>
										</tr>
										<tr>
											<td><strong>All Vouchers</strong></td>
											<td class="text-center">-</td>
											<td class="text-center">-</td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="viewAllVouchers" id="permission" <?php if($serialize_permission) { if(in_array('viewAllVouchers', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center">-</td>
										</tr>
										<tr>
											<td><strong>All Outlets</strong></td>
											<td class="text-center">-</td>
											<td class="text-center">-</td>
											<td class="text-center"><input type="checkbox" name="permission[]" value="viewAllOutlets" id="permission" <?php if($serialize_permission) { if(in_array('viewAllOutlets', $serialize_permission)) { echo "checked"; } } ?>></td>
											<td class="text-center">-</td>
										</tr>
									</tbody>
								</table>
								<input class="btn btn-primary float-end" type="submit" name="save" value="Update">
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>

		</div>
	</main>
	<?= $this->include('layouts/footer'); ?>
<?= $this->endSection(); ?>