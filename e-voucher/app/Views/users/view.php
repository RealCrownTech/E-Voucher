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
							<table id="datatables-responsive" class="table table-striped table-responsive">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Name</th>
										<th>Location</th>
										<th>Role</th>
										<th>Email</th>
										<th>Mobile No</th>
										<!-- <th>Gender</th> -->
										<th class="text-center">Status</th>
										<?php if(in_array('editUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
											<th class="text-center">Action</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($users)): ?>
										<?php $i = 1; foreach ($users as $row): ?>
											<tr>
												<input type="hidden" class="user_id" name="" value="<?= $row['user_id']; ?>">
												<td><?= $i ?></td>
												<td><?= $row['first_name'] ?>  <?= $row['last_name'] ?></td>
												<td>
													<?php if(!empty($outlets)): ?>
														<?php foreach($outlets as $outlet): ?>
															<?php if($outlet['outlet_id'] == $row['outlet']): ?>
																<?= $outlet['outlet_name'] ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>													
												</td>
												<td>
													<?php $serialize_user_role = unserialize($row['user_role']);
														foreach($roles_data as $roles) {
															if($serialize_user_role) { 
																if(in_array($roles['role_id'], $serialize_user_role)) { 
																	echo $roles['role_name'].', '; 
																} 
												            }
										                }
									                ?>
									            </td>
												<td><?= $row['email'] ?></td>
												<td><?= $row['mobile'] ?></td>
												<!-- <td><?= ucfirst($row['gender']) ?></td> -->
												<?php if($row['user_status'] == 1): ?>
													<td class="text-center"><span class="badge bg-success">Active</span></td>
												<?php endif; ?>
												<?php if($row['user_status'] == 2): ?>
													<td class="text-center"><span class="badge bg-warning">Probation</span></td>
												<?php endif; ?>
												<?php if($row['user_status'] == 3): ?>
													<td class="text-center"><span class="badge bg-info">Leave</span></td>
												<?php endif; ?>
												<?php if($row['user_status'] == 4): ?>
													<td class="text-center"><span class="badge bg-danger">Inative</span></td>
												<?php endif; ?>
												<?php if(in_array('editUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
													<td class="text-center">
														<?php if(in_array('viewUser', $user_permission)): ?>
															<a href="<?= base_url() ?>/viewUser/<?= $row['user_id'] ?>" class="btn btn-sm btn-warning"><i data-feather="eye"></i></a>
														<?php endif ?>
														<?php if(in_array('editUser', $user_permission)): ?>
															<a href="<?= base_url() ?>/editUser/<?= $row['user_id'] ?>" class="btn btn-sm btn-info"><i data-feather="edit"></i></a>
														<?php endif ?>
														<?php if(in_array('deleteUser', $user_permission)): ?>
															<a href="javascript:void(0)" class="btn btn-sm btn-danger delete"><i data-feather="trash-2"></i></a>
														<?php endif ?>
													</td>
												<?php endif ?>
											</tr>
										<?php $i++; endforeach; ?>
									<?php endif ?>
								</tbody>
							</table>
							<!-- Start Delete Modal-->
							<?= $this->include('modals/delete'); ?>
							<!-- Delete Modal-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript">
		jquery_3_2_1(document).ready(function () {
			$(document).on('click', '.delete', function(){
				var delete_id = $(this).closest('tr').find('.user_id').val();
				$('#deleteModal').modal('show');
				$('#deleteForm').attr('action', '<?= base_url() ?>/deleteuser/'+delete_id);
			});
		});
	</script>
	<?= $this->include('layouts/footer'); ?>
<?= $this->endSection(); ?>