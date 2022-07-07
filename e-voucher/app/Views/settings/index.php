<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<?= $this->include('layouts/navigation'); ?>
	<?= $this->include('layouts/header'); ?>
	<main class="content">
		<div class="container-fluid p-0">

			<h1 class="h3 mb-3"><?= $page_name ?></h1>

			<div class="row">
						<div class="col-md-3 col-xl-2">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">System Settings</h5>
								</div>

								<div class="list-group list-group-flush" role="tablist">
									<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#company" role="tab">Company</a>
									<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#user_role" role="tab">User Roles</a>
									<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#images" role="tab">Images</a>
									<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#outlets" role="tab">Businesses &amp; Outlets</a>
									<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#exp_cat" role="tab">Expense Category</a>
									<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#department" role="tab">Departments</a>
								</div>
							</div>
						</div>

						<div class="col-md-9 col-xl-10">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="company" role="tabpanel">

									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Company Info</h5>
										</div>
										<div class="card-body">
											<?= form_open('/company_settings') ?>
												<div class="row">
													<div class="mb-3 col-md-6">
														<label for="" class="form-label">Site Title</label>
														<input type="text" class="form-control" name="site_title" value="<?= $company_data['site_title'] ?>">
														<span class="text-danger"><?= display_error($validation, 'site_title') ?></span>
													</div>
													<div class="mb-3 col-md-6">
														<label for="" class="form-label">Company Name</label>
														<input type="text" class="form-control" name="company_name" value="<?= $company_data['company_name'] ?>">
														<span class="text-danger"><?= display_error($validation, 'company_name') ?></span>
													</div>
												</div>
												<div class="row">
													<div class="mb-3 col-md-6">
														<label for="" class="form-label">Tagline</label>
														<input type="text" class="form-control" name="tagline" value="<?= $company_data['tagline'] ?>">
														<span class="text-danger"><?= display_error($validation, 'tagline') ?></span>
													</div>
													<div class="mb-3 col-md-6">
														<label for="" class="form-label">Company Email</label>
														<input type="email" class="form-control" name="company_email" value="<?= $company_data['company_email'] ?>">
														<span class="text-danger"><?= display_error($validation, 'company_email') ?></span>
													</div>
												</div>
												<div class="row">
													<div class="mb-3 col-md-6">
														<label for="" class="form-label">Company Phone</label>
														<input type="text" class="form-control" name="company_phone" value="<?= $company_data['company_phone'] ?>">
														<span class="text-danger"><?= display_error($validation, 'company_phone') ?></span>
													</div>
													<div class="mb-3 col-md-6">
														<label for="" class="form-label">Alternative Phone</label>
														<input type="text" class="form-control" name="company_mobile" value="<?= $company_data['company_mobile'] ?>">
														<span class="text-danger"><?= display_error($validation, 'company_mobile') ?></span>
													</div>
												</div>
												<div class="row">
													<div class="mb-3 col-md-6">
														<label for="" class="form-label">Company Website</label>
														<input type="text" class="form-control" name="company_website" value="<?= $company_data['company_website'] ?>">
														<span class="text-danger"><?= display_error($validation, 'company_website') ?></span>
													</div>
													<div class="mb-3 col-md-6">
														<label for="" class="form-label">Company Address</label>
														<input type="text" class="form-control" name="company_address" value="<?= $company_data['company_address'] ?>">
														<span class="text-danger"><?= display_error($validation, 'company_address') ?></span>
													</div>
												</div>
												<input type="submit" class="btn btn-primary float-end" name="save" value="Save Changes">
											<?= form_close() ?>
										</div>
									</div>

									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Bank Details</h5>
										</div>
										<div class="card-body">
											<?= form_open('/bank_settings') ?>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<label for="" class="form-label">Bank Name</label>
															<input type="text" class="form-control" name="bank_name" value="<?= $company_data['bank_name'] ?>">
															<span class="text-danger"><?= display_error($validation, 'bank_name') ?></span>
														</div>
														<div class="mb-3">
															<label for="" class="form-label">Account Name</label>
															<input type="text" class="form-control" name="account_name" value="<?= $company_data['account_name'] ?>">
															<span class="text-danger"><?= display_error($validation, 'account_name') ?></span>
														</div>
														<div class="mb-3">
															<label for="" class="form-label">Account Number</label>
															<input type="text" class="form-control" name="account_number" value="<?= $company_data['account_number'] ?>">
															<span class="text-danger"><?= display_error($validation, 'account_number') ?></span>
														</div>
														<div class="mb-3">
															<input type="checkbox" name="show_on_invoice" value="1" <?php if($company_data['show_on_invoice'] == 1){ echo 'checked'; } ?>>
															<label for="" class="form-label">Show On Invoice</label>
														</div>
													</div>
												</div>
												<input type="submit" class="btn btn-primary float-end" name="save" value="Save Changes">
											<?= form_close() ?>
										</div>
									</div>

								</div>
								<div class="tab-pane fade" id="user_role" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">User Roles</h5>
											<hr class="mb-4">

											<div class="row">
												<div class="col-xl-6 col-sm-12">
													<div class="card flex-fill">
														<table id="datatables-responsive" class="table table-striped table-responsive my-0">
															<thead>
																<tr>
																	<th>S/N</th>
																	<th>Roles</th>
																	<?php if(in_array('editSetting', $user_permission) || in_array('deleteSetting', $user_permission)): ?>
																	<th>Action</th>
																	<?php endif ?>
																</tr>
															</thead>
															<tbody>
																<?php if(!empty($other_roles_data)): ?>
																	<?php $i = 1; foreach($other_roles_data as $roles): ?>
																		<tr>
																			<input type="hidden" class="role_id" name="" value="<?= $roles['role_id']; ?>">
																			<td><?= $i ?></td>
																			<td><?= $roles['role_name'] ?></td>
																			<?php if(in_array('editSetting', $user_permission) || in_array('deleteSetting', $user_permission)): ?>
																				<td class="text-center">
																					<?php if(in_array('deleteSetting', $user_permission)): ?>
																						<a href="javascript:void(0)" class="btn btn-sm btn-danger delete"><i data-feather="trash-2"></i></a>
																					<?php endif ?>
																				</td>
																			<?php endif ?>
																		</tr>
																	<?php $i++; endforeach ?>
																<?php endif ?>
															</tbody>
														</table>
													</div>
												</div>

												<div class="col-xl-6 col-sm-12">
													<?= form_open('/add_role') ?>
														<div class="mb-3">
															<label for="inputPasswordCurrent" class="form-label">New Role Name</label>
															<input type="text" class="form-control" name="role">
														</div>
														<input type="submit" class="btn btn-primary float-end" name="save" value="Add New">
													<?= form_close() ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="images" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Images</h5>
											<hr class="mb-4">

											<div class="row">
												<div class="col-xl-6 col-sm-12">
													<div class="mb-3">
														<?= form_open_multipart('/img_upload/logo'); ?>
															Company Logo:  <span style="color: red">(500px by 200px preferably)</span>
															<input class="dropify" type="file" name="file_name" data-default-file="<?= base_url() ?>/public/assets/img/photos/<?= $company_data['logo'] ?>">
															<?= display_error($validation, 'file_name') ?>
															<input type="submit" class="btn btn-primary col-12" name="save" value="Upload">
														<?= form_close() ?>
													</div>
												</div>
												<div class="col-xl-6 col-sm-12">
													<div class="mb-3">
														<?= form_open_multipart('/img_upload/favicon'); ?>
															Fav Icon:  <span style="color: red">(16px by 16px preferably)</span>
															<input class="dropify" type="file" name="file_name" data-default-file="<?= base_url() ?>/public/assets/img/photos/<?= $company_data['favicon'] ?>">
															<?= display_error($validation, 'file_name') ?>
															<input type="submit" class="btn btn-primary col-12" name="save" value="Upload">
														<?= form_close() ?>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-6 col-sm-12">
													<div class="mb-3">
														<?= form_open_multipart('/img_upload/loginbg'); ?>
															Login Backrgound:  <span style="color: red">(1920px by 1080px preferably)</span>
															<input class="dropify" type="file" name="file_name" data-default-file="<?= base_url() ?>/public/assets/img/photos/<?= $company_data['loginbg'] ?>">
															<?= display_error($validation, 'file_name') ?>
															<input type="submit" class="btn btn-primary col-12" name="save" value="Upload">
														<?= form_close() ?>
													</div>
												</div>
												<div class="col-xl-6 col-sm-12">
													<div class="mb-3">
														<?= form_open_multipart('/img_upload/subsidiary'); ?>
															Subsidiary Logo:  <span style="color: red">(300px by 70px preferably)</span>
															<input class="dropify" type="file" name="file_name" data-default-file="<?= base_url() ?>/public/assets/img/photos/<?= $company_data['subsidiary'] ?>">
															<?= display_error($validation, 'file_name') ?>
															<input type="submit" class="btn btn-primary col-12" name="save" value="Upload">
														<?= form_close() ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade" id="outlets" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Outlets &amp; Businesses</h5>
											<hr class="mb-4">

											<div class="row">
												<div class="col-xl-5 col-sm-12">
													<div class="card">
														<div class="card-header">
															<h5 class="card-title float-start">Businesses</h5>
															<a class="btn btn-secondary btn-sm float-end" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addBusiness"><i data-feather="plus"></i></a>

															<!-- Start Add Business Modal-->
															<?= $this->include('modals/addBusiness'); ?>
															<!-- End Add Business Modal-->
														</div>
														<div class="card-body">
															<table id="datatables-responsive" class="table table-striped table-responsive">
																<thead>
																	<tr>
																		<th>ID</th>
																		<th>Name</th>
																		<?php if(in_array('editSetting', $user_permission) || in_array('deleteSetting', $user_permission)): ?>
																			<th>Action</th>
																		<?php endif ?>
																	</tr>
																</thead>
																<tbody>
																	<?php if(!empty($businesses)): ?>
																		<?php foreach ($businesses as $row): ?>
																			<tr>
																				<input type="hidden" value="<?= $row['business_id'] ?>" class="business_id">
																				<input type="hidden" value="<?= $row['business_name'] ?>" class="business_name">
																				<td><?= $row['business_id'] ?></td>
																				<td><?= $row['business_name'] ?></td>
																				<?php if(in_array('editSetting', $user_permission) || in_array('deleteSetting', $user_permission)): ?>
																					<td>
																						<?php if(in_array('editSetting', $user_permission)): ?>
																							<a href="javascript:void(0)" class="btn btn-sm btn-info editbusiness"><i data-feather="edit"></i></a>
																						<?php endif ?>
																						<?php if(in_array('deleteSetting', $user_permission)): ?>
																							<a href="javascript:void(0)" class="btn btn-sm btn-danger deletebusiness"><i data-feather="trash-2"></i></a>
																						<?php endif ?>
																					</td>
																				<?php endif ?>
																			</tr>
																		<?php endforeach ?>
																	<?php endif ?>
																</tbody>
															</table>
															<!-- Start Add Business Modal-->
															<?= $this->include('modals/editBusiness'); ?>
															<!-- End Add Business Modal-->
														</div>
													</div>
												</div>

												<div class="col-xl-7 col-sm-12">
													<div class="card">
														<div class="card-header">
															<h5 class="card-title float-start">Outlets</h5>
															<a class="btn btn-secondary btn-sm float-end" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addOutlet"><i data-feather="plus"></i></a>

															<!-- Start Add Outlet Modal-->
															<?= $this->include('modals/addOutlet'); ?>
															<!-- End Add Outlet Modal-->
														</div>
														<div class="card-body">
															<table id="datatables-outlet" class="table table-striped table-responsive" style="width:100%">
																<thead>
																	<tr>
																		<th>S/N</th>
																		<th>Name</th>
																		<th>Biz ID</th>
																		<?php if(in_array('editSetting', $user_permission) || in_array('deleteSetting', $user_permission)): ?>
																			<th>Action</th>
																		<?php endif ?>
																	</tr>
																</thead>
																<tbody>
																	<?php if(!empty($outlets)): ?>
																		<?php foreach ($outlets as $row): ?>
																			<tr>
																				<input type="hidden" value="<?= $row['outlet_id'] ?>" class="outlet_id">
																				<input type="hidden" value="<?= $row['outlet_name'] ?>" class="outlet_name">
																				<td><?= $row['outlet_id'] ?></td>
																				<td><?= $row['outlet_name'] ?></td>
																				<td>
																					<?php 
																						$serialize_business = unserialize($row['outlet_businesses']);
																						if(!empty($businesses)) {
																							foreach ($businesses as $rows) {
																								if($serialize_business) { 
																									if(in_array($rows['business_id'], $serialize_business)) { 
																										echo $rows['business_name'].', '; 
																									} 
																								}
																							}
																						}
																					?>			
																				</td>
																				<?php if(in_array('editSetting', $user_permission) || in_array('deleteSetting', $user_permission)): ?>
																					<td>
																						<?php if(in_array('editSetting', $user_permission)): ?>
																							<a href="javascript:void(0)" class="btn btn-sm btn-info editoutlet"><i data-feather="edit"></i></a>
																						<?php endif ?>
																						<?php if(in_array('deleteSetting', $user_permission)): ?>
																							<a href="javascript:void(0)" class="btn btn-sm btn-danger deleteoutlet"><i data-feather="trash-2"></i></a>
																						<?php endif ?>
																					</td>
																				<?php endif ?>
																			</tr>
																		<?php endforeach ?>
																	<?php endif ?>
																</tbody>
															</table>
															<!-- Start Edit Outlet Modal-->
															<?= $this->include('modals/editOutlet'); ?>
															<!-- End Edit Outlet Modal-->
														</div>
													</div>
												</div>												
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="exp_cat" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Expense Category</h5>
											<hr class="mb-4">
											<div class="row">
												<div class="col-xl-6 col-sm-12">
													<div class="card flex-fill">
														<table id="datatables-responsive" class="table table-striped my-0">
															<thead>
																<tr>
																	<th>S/N</th>
																	<th>Category</th>
																	<?php if(in_array('editSetting', $user_permission) || in_array('deleteSetting', $user_permission)): ?>
																	<th>Action</th>
																	<?php endif ?>
																</tr>
															</thead>
															<tbody>
																<?php if(!empty($expense_categories)): ?>
																	<?php $i = 1; foreach($expense_categories as $row): ?>
																		<tr>
																			<input type="hidden" class="expense_category" name="" value="<?= $row['category_id']; ?>">
																			<td><?= $i ?></td>
																			<td><?= $row['category_name'] ?></td>
																			<?php if(in_array('editSetting', $user_permission) || in_array('deleteSetting', $user_permission)): ?>
																				<td class="text-center">
																					<?php if(in_array('deleteSetting', $user_permission)): ?>
																						<a href="javascript:void(0)" class="btn btn-sm btn-danger deleteexpcat"><i data-feather="trash-2"></i></a>
																					<?php endif ?>
																				</td>
																			<?php endif ?>
																		</tr>
																	<?php $i++; endforeach ?>
																<?php endif ?>
															</tbody>
														</table>
													</div>
												</div>

												<div class="col-xl-6 col-sm-12">
													<?= form_open('/add_exp_cat') ?>
														<div class="mb-3">
															<label for="inputPasswordCurrent" class="form-label">New Expense Category</label>
															<input type="text" class="form-control" name="exp_cat">
														</div>
														<input type="submit" class="btn btn-primary float-end" name="save" value="Add New">
													<?= form_close() ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="department" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Departments</h5>
											<hr class="mb-4">
											<div class="row">
												<div class="col-xl-8 col-sm-12">
													<div class="card">
														<div class="card-header">
															<h5 class="card-title float-start">Departments</h5>
															<a class="btn btn-secondary btn-sm float-end" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addDepartment"><i data-feather="plus"></i></a>

															<!-- Start Add Department Modal-->
															<?= $this->include('modals/addDepartment'); ?>
															<!-- End Add Department Modal-->
														</div>
														<div class="card-body">
															<table id="datatables-responsive" class="table table-striped table-responsive my-0">
																<thead>
																	<tr>
																		<th>ID</th>
																		<th>Dept</th>
																		<th>H.O.D</th>
																		<?php if(in_array('editSetting', $user_permission) || in_array('deleteSetting', $user_permission)): ?>
																			<th>Action</th>
																		<?php endif ?>
																	</tr>
																</thead>
																<tbody>
																	<?php if(!empty($departments)): ?>
																		<?php foreach ($departments as $row): ?>
																			<tr>
																				<input type="hidden" value="<?= $row['department_id'] ?>" class="department_id">
																				<input type="hidden" value="<?= $row['department_name'] ?>" class="department_name">
																				<td><?= $row['department_id'] ?></td>
																				<td><?= $row['department_name'] ?></td>
																				<td>
																					<?php if(!empty($users)): ?>
																						<?php foreach($users as $user): ?>
																							<?php if($user['user_id'] == $row['department_head']): ?>
																								<?= $user['first_name'] ?> <?= $user['last_name'] ?>
																							<?php endif ?>
																						<?php endforeach ?>
																					<?php endif ?>
																				</td>
																				<?php if(in_array('editSetting', $user_permission) || in_array('deleteSetting', $user_permission)): ?>
																					<td>
																						<?php if(in_array('editSetting', $user_permission)): ?>
																							<a href="javascript:void(0)" class="btn btn-sm btn-info editdepartment"><i data-feather="edit"></i></a>
																						<?php endif ?>
																						<?php if(in_array('deleteSetting', $user_permission)): ?>
																							<a href="javascript:void(0)" class="btn btn-sm btn-danger deletedepartment"><i data-feather="trash-2"></i></a>
																						<?php endif ?>
																					</td>
																				<?php endif ?>
																			</tr>
																		<?php endforeach ?>
																	<?php endif ?>
																</tbody>
															</table>
															<!-- Start Edit Department Modal-->
															<?= $this->include('modals/editDepartment'); ?>
															<!-- End Edit Department Modal-->
														</div>
													</div>
												</div>							
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Start Delete Modal-->
					<?= $this->include('modals/delete'); ?>
					<!-- Delete Modal-->
		</div>
	</main>
	<script type="text/javascript">
		jquery_3_2_1(document).ready(function () {
			$(document).on('click', '.delete', function(){
				var delete_id = $(this).closest('tr').find('.role_id').val();
				$('#deleteModal').modal('show');
				$('#deleteForm').attr('action', '<?= base_url() ?>/deleterole/'+delete_id);
			});
		});

		jquery_3_2_1(document).ready(function () {
			$(document).on('click', '.deletebusiness', function(){
				var delete_id = $(this).closest('tr').find('.business_id').val();
				$('#deleteModal').modal('show');
				$('#deleteForm').attr('action', '<?= base_url() ?>/deletebusiness/'+delete_id);
			});
		});

		jquery_3_2_1(document).ready(function () {
			$(document).on('click', '.editbusiness', function(){
				var edit_id = $(this).closest('tr').find('.business_id').val();
				var edit_name = $(this).closest('tr').find('.business_name').val();
				$('#editBusinessModal').modal('show');
				$('.biz_name').val(edit_name);
				$('#editForm').attr('action', '<?= base_url() ?>/editbusiness/'+edit_id);
			});
		});

		jquery_3_2_1(document).ready(function () {
			$(document).on('click', '.deleteoutlet', function(){
				var delete_id = $(this).closest('tr').find('.outlet_id').val();
				$('#deleteModal').modal('show');
				$('#deleteForm').attr('action', '<?= base_url() ?>/deleteoutlet/'+delete_id);
			});
		});

		jquery_3_2_1(document).ready(function () {
			$(document).on('click', '.editoutlet', function(){
				var edit_id = $(this).closest('tr').find('.outlet_id').val();
				var edit_name = $(this).closest('tr').find('.outlet_name').val();
				$('#editOutletModal').modal('show');
				$('.out_name').val(edit_name);
				$('#editFormm').attr('action', '<?= base_url() ?>/editoutlet/'+edit_id);
			});
		});

		jquery_3_2_1(document).ready(function () {
			$(document).on('click', '.deletedepartment', function(){
				var delete_id = $(this).closest('tr').find('.department_id').val();
				$('#deleteModal').modal('show');
				$('#deleteForm').attr('action', '<?= base_url() ?>/deletedepartment/'+delete_id);
			});
		});

		jquery_3_2_1(document).ready(function () {
			$(document).on('click', '.editdepartment', function(){
				var edit_id = $(this).closest('tr').find('.department_id').val();
				var edit_name = $(this).closest('tr').find('.department_name').val();
				$('#editDepartmentModal').modal('show');
				$('.dept_name').val(edit_name);
				$('#editForrm').attr('action', '<?= base_url() ?>/editdepartment/'+edit_id);
			});
		});

		jquery_3_2_1(document).ready(function () {
			$(document).on('click', '.deleteexpcat', function(){
				var delete_id = $(this).closest('tr').find('.expense_category').val();
				$('#deleteModal').modal('show');
				$('#deleteForm').attr('action', '<?= base_url() ?>/deleteexpcat/'+delete_id);
			});
		});
	</script>
	<?= $this->include('layouts/footer'); ?>
<?= $this->endSection(); ?>