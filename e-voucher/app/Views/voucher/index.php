<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<?= $this->include('layouts/navigation'); ?>
	<?= $this->include('layouts/header'); ?>
	<main class="content">
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3"><?= $page_name ?></h1>
			<div class="row my-4">
				<div class="btn-group float-end">
					<?php if(in_array('addVoucher', $user_permission)): ?>
						<button type="button" class="btn btn-md btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                	<i data-feather="plus"></i> Submit New Voucher
		              	</button>
					<?php endif ?>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?= base_url() ?>/ibc">Petty Voucher By Cash (<= ₦5000)</a>
							<a class="dropdown-item" href="<?= base_url() ?>/ibt">Petty Voucher By Transfer (<= ₦5000)</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url() ?>/pbc">Payment Voucher By Cash (> ₦5,000)</a>
						<a class="dropdown-item" href="<?= base_url() ?>/pbt">Payment Voucher By Transfer (> ₦5,000)</a>
					</div>
					<?php if(in_array('viewVoucher', $user_permission)): ?>
						<a href="<?= base_url() ?>/search" class="btn btn-md btn-secondary">Search/Generate Report</a>
					<?php endif ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-sm-3 col-xxl-3 d-flex">
					<div class="card flex-fill">
						<div class="card-body py-4">
							<div class="d-flex align-items-start">
								<div class="flex-grow-1">
									<?php if(in_array('viewAllVouchers', $user_permission)): ?>
										<h3 class="mb-2"><?= $submitted ?></h3>
									<?php else: ?>
										<h3 class="mb-2"><?= $submitted_by_outlet ?></h3>
									<?php endif ?>
									<p class="mb-2">Submitted Request</p>
									<!-- <div class="mb-0">
										<span class="badge badge-soft-success me-2"> +5.35% </span>
										<span class="text-muted">Since last week</span>
									</div> -->
								</div>
								<div class="d-inline-block ms-3">
									<div class="stat">
										<i class="align-middle text-success" data-feather="dollar-sign"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-3 col-xxl-3 d-flex">
					<div class="card flex-fill">
						<div class="card-body py-4">
							<div class="d-flex align-items-start">
								<div class="flex-grow-1">
									<?php if(in_array('viewAllVouchers', $user_permission)): ?>
										<h3 class="mb-2"><?= $processed ?></h3>
									<?php else: ?>
										<h3 class="mb-2"><?= $processed_by_outlet ?></h3>
									<?php endif ?>
									<p class="mb-2">Processed Vouchers</p>
									<!-- <div class="mb-0">
										<span class="badge badge-soft-danger me-2"> -4.25% </span>
										<span class="text-muted">Since last week</span>
									</div> -->
								</div>
								<div class="d-inline-block ms-3">
									<div class="stat">
										<i class="align-middle text-danger" data-feather="dollar-sign"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-3 col-xxl-3 d-flex">
					<div class="card flex-fill">
						<div class="card-body py-4">
							<div class="d-flex align-items-start">
								<div class="flex-grow-1">
									<?php if(in_array('viewAllVouchers', $user_permission)): ?>
										<h3 class="mb-2"><?= $approved ?></h3>
									<?php else: ?>
										<h3 class="mb-2"><?= $approved_by_outlet ?></h3>
									<?php endif ?>
									<p class="mb-2">Approved Vouchers</p>
									<!-- <div class="mb-0">
										<span class="badge badge-soft-success me-2"> +8.65% </span>
										<span class="text-muted">Since last week</span>
									</div> -->
								</div>
								<div class="d-inline-block ms-3">
									<div class="stat">
										<i class="align-middle text-info" data-feather="dollar-sign"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-3 col-xxl-3 d-flex">
					<div class="card flex-fill">
						<div class="card-body py-4">
							<div class="d-flex align-items-start">
								<div class="flex-grow-1">
									<?php if(in_array('viewAllVouchers', $user_permission)): ?>
										<h3 class="mb-2"><?= $declined ?></h3>
									<?php else: ?>
										<h3 class="mb-2"><?= $declined_by_outlet ?></h3>
									<?php endif ?>
									<p class="mb-2">Declined Vouchers</p>
									<!-- <div class="mb-0">
										<span class="badge badge-soft-success me-2"> +8.65% </span>
										<span class="text-muted">Since last week</span>
									</div> -->
								</div>
								<div class="d-inline-block ms-3">
									<div class="stat">
										<i class="align-middle text-info" data-feather="dollar-sign"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-sm-3 col-xxl-3 d-flex">
					<div class="card flex-fill">
						<div class="card-body py-4">
							<div class="d-flex align-items-start">
								<div class="flex-grow-1">
									<?php if(in_array('viewAllVouchers', $user_permission)): ?>
										<h3 class="mb-2"><?= '₦'.number_format($sum_daily_all_outlet['amount']) ?></h3>
									<?php else: ?>
										<h3 class="mb-2"><?= '₦'.number_format($sum_daily_by_outlet['amount']) ?></h3>
									<?php endif ?>
									<p class="mb-2">Total Expense Today</p>
								</div>
								<div class="d-inline-block ms-3">
									<div class="stat">
										<i class="align-middle text-success" data-feather="dollar-sign"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-3 col-xxl-3 d-flex">
					<div class="card flex-fill">
						<div class="card-body py-4">
							<div class="d-flex align-items-start">
								<div class="flex-grow-1">
									<?php if(in_array('viewAllVouchers', $user_permission)): ?>
										<h3 class="mb-2"><?= '₦'.number_format($sum_monthly_all_outlet['amount']) ?></h3>
									<?php else: ?>
										<h3 class="mb-2"><?= '₦'.number_format($sum_monthly_by_outlet['amount']) ?></h3>
									<?php endif ?>
									<p class="mb-2">This Month Expense</p>
								</div>
								<div class="d-inline-block ms-3">
									<div class="stat">
										<i class="align-middle text-danger" data-feather="dollar-sign"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--<div class="col-12 col-sm-3 col-xxl-3 d-flex">-->
				<!--	<div class="card flex-fill">-->
				<!--		<div class="card-body py-4">-->
				<!--			<div class="d-flex align-items-start">-->
				<!--				<div class="flex-grow-1">-->
				<!--					<?php if(in_array('viewAllVouchers', $user_permission)): ?>-->
				<!--						<h3 class="mb-2"><?= $approved ?></h3>-->
				<!--					<?php else: ?>-->
				<!--						<h3 class="mb-2"><?= $approved_by_outlet ?></h3>-->
				<!--					<?php endif ?>-->
				<!--					<p class="mb-2">Approved Vouchers</p>-->
				<!--				</div>-->
				<!--				<div class="d-inline-block ms-3">-->
				<!--					<div class="stat">-->
				<!--						<i class="align-middle text-info" data-feather="dollar-sign"></i>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
				<!--<div class="col-12 col-sm-3 col-xxl-3 d-flex">-->
				<!--	<div class="card flex-fill">-->
				<!--		<div class="card-body py-4">-->
				<!--			<div class="d-flex align-items-start">-->
				<!--				<div class="flex-grow-1">-->
				<!--					<?php if(in_array('viewAllVouchers', $user_permission)): ?>-->
				<!--						<h3 class="mb-2"><?= $declined ?></h3>-->
				<!--					<?php else: ?>-->
				<!--						<h3 class="mb-2"><?= $declined_by_outlet ?></h3>-->
				<!--					<?php endif ?>-->
				<!--					<p class="mb-2">Declined Vouchers</p>-->
				<!--				</div>-->
				<!--				<div class="d-inline-block ms-3">-->
				<!--					<div class="stat">-->
				<!--						<i class="align-middle text-info" data-feather="dollar-sign"></i>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">							
							<h5 class="card-title">Vouchers By You</h5>
							<hr class="my-4">
							<table id="datatables-responsive" class="table table-striped table-responsive">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Date</th>
										<th>Voucher ID</th>
										<th>Presented By</th>
										<th>Amount</th>
										<th>Type - Payment Method</th>
										<th>Status</th>
										<?php if(in_array('editVoucher', $user_permission) || in_array('viewVoucher', $user_permission) || in_array('deleteVoucher', $user_permission)): ?>
											<th class="text-center">Action</th>
										<?php endif ?>
									</tr>
								</thead>
								<?php if(in_array('viewAllVouchers', $user_permission)): ?>
								<tbody>
									<?php if(!empty($vouchers)): ?>
										<?php $i=1; foreach($vouchers as $row): ?>
											<tr>
												<input type="hidden" class="voucher_id" name="" value="<?= $row['voucher_id']; ?>">
												<td><?= $i; ?></td>
												<td>
													<?= date('d-M-Y', strtotime($row['date'])) ?>													
												</td>
												<td>
													<?= $row['voucher_no'] ?>											
												</td>
												<td>
													<?php if(!empty($users)): ?>
														<?php foreach($users as $user): ?>
															<?php if($user['user_id'] == $row['presented_by']): ?>
																<?= $user['first_name'] ?> <?= $user['last_name'] ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>	
												</td>
												<td>
													<?= '₦'.number_format($row['amount']) ?>
												</td>
												<td>
													<?= ucfirst($row['type']) .' By '. ucfirst($row['method']) ?>
												</td>
												<?php if($row['status'] == '1'): ?>
													<td><div class="badge bg-primary my-2">Submitted</div></td>
												<?php elseif($row['status'] == '2'): ?>
													<td><div class="badge bg-warning my-2">In Process</div></td>
												<?php elseif($row['status'] == '3'): ?>
													<td><div class="badge bg-success my-2">Approved</div></td>
												<?php elseif($row['status'] == '4'): ?>
													<td><div class="badge bg-danger my-2">Declined</div></td>
												<?php endif ?>
												<?php if(in_array('editVoucher', $user_permission) || in_array('viewVoucher', $user_permission) || in_array('deleteVoucher', $user_permission)): ?>
													<td class="text-center">
														<?php if(in_array('viewVoucher', $user_permission)): ?>
															<?php if($row['type'] == 'petty' && $row['method'] == 'cash'): ?>
																<a href="<?= base_url() ?>/pettybycash/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-warning"><i data-feather="eye"></i></a>
															<?php elseif($row['type'] == 'petty' && $row['method'] == 'transfer'): ?>
																<a href="<?= base_url() ?>/pettybytransfer/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-warning"><i data-feather="eye"></i></a>
															<?php elseif($row['type'] == 'payment' && $row['method'] == 'cash'): ?>
																<a href="<?= base_url() ?>/paymentbycash/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-warning"><i data-feather="eye"></i></a>
															<?php elseif($row['type'] == 'payment' && $row['method'] == 'transfer'): ?>
																<a href="<?= base_url() ?>/paymentbytransfer/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-warning"><i data-feather="eye"></i></a>
															<?php endif ?>
														<?php endif ?>
														<?php if(in_array('editVoucher', $user_permission) && $row['status'] == '1' && $row['presented_by'] == session()->get('logged_user') || session()->get('logged_user') == '1'): ?>
															<?php if($row['type'] == 'petty' && $row['method'] == 'cash'): ?>
																<a href="<?= base_url() ?>/editibc/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-info"><i data-feather="edit"></i></a>
															<?php elseif($row['type'] == 'petty' && $row['method'] == 'transfer'): ?>
																<a href="<?= base_url() ?>/editibt/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-info"><i data-feather="edit"></i></a>
															<?php elseif($row['type'] == 'payment' && $row['method'] == 'cash'): ?>
																<a href="<?= base_url() ?>/editpbc/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-info"><i data-feather="edit"></i></a>
															<?php elseif($row['type'] == 'payment' && $row['method'] == 'transfer'): ?>
																<a href="<?= base_url() ?>/editpbt/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-info"><i data-feather="edit"></i></a>
															<?php endif ?>
														<?php endif ?>
														<?php if($row['attachments'] != ''): ?>
															<a href="<?= base_url() ?>/public/assets/img/vouchers/<?= $row['attachments'] ?>" class="btn btn-sm btn-primary" download><i data-feather="download"></i></a>
														<?php endif ?>
														<?php if(in_array('deleteVoucher', $user_permission)): ?>
															<a href="javascript:void(0)" class="btn btn-sm btn-danger delete"><i data-feather="trash-2"></i></a>
														<?php endif ?>
													</td>
												<?php endif ?>
											</tr>
										<?php $i++; endforeach ?>
									<?php endif ?>
								</tbody>
								<?php else: ?>
									<tbody>
										<?php if(!empty($vouchers_by_outlet)): ?>
											<?php $i=1; foreach($vouchers_by_outlet as $row): ?>
											<tr>
												<input type="hidden" class="voucher_id" name="" value="<?= $row['voucher_id']; ?>">
												<td><?= $i; ?></td>
												<td>
													<?= date('d-M-Y', strtotime($row['date'])) ?>													
												</td>
												<td>
													<?= $row['voucher_no'] ?>											
												</td>
												<td>
													<?php if(!empty($users)): ?>
														<?php foreach($users as $user): ?>
															<?php if($user['user_id'] == $row['presented_by']): ?>
																<?= $user['first_name'] ?> <?= $user['last_name'] ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>	
												</td>
												<td>
													<?= '₦'.number_format($row['amount']) ?>
												</td>
												<td>
													<?= ucfirst($row['type']) .' By '. ucfirst($row['method']) ?>
												</td>
												<?php if($row['status'] == '1'): ?>
													<td><div class="badge bg-primary my-2">Submitted</div></td>
												<?php elseif($row['status'] == '2'): ?>
													<td><div class="badge bg-warning my-2">In Process</div></td>
												<?php elseif($row['status'] == '3'): ?>
													<td><div class="badge bg-success my-2">Approved</div></td>
												<?php elseif($row['status'] == '4'): ?>
													<td><div class="badge bg-danger my-2">Declined</div></td>
												<?php endif ?>
												<?php if(in_array('editVoucher', $user_permission) || in_array('viewVoucher', $user_permission) || in_array('deleteVoucher', $user_permission)): ?>
													<td class="text-center">
														<?php if(in_array('viewVoucher', $user_permission)): ?>
															<?php if($row['type'] == 'petty' && $row['method'] == 'cash'): ?>
																<a href="<?= base_url() ?>/pettybycash/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-warning"><i data-feather="eye"></i></a>
															<?php elseif($row['type'] == 'petty' && $row['method'] == 'transfer'): ?>
																<a href="<?= base_url() ?>/pettybytransfer/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-warning"><i data-feather="eye"></i></a>
															<?php elseif($row['type'] == 'payment' && $row['method'] == 'cash'): ?>
																<a href="<?= base_url() ?>/paymentbycash/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-warning"><i data-feather="eye"></i></a>
															<?php elseif($row['type'] == 'payment' && $row['method'] == 'transfer'): ?>
																<a href="<?= base_url() ?>/paymentbytransfer/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-warning"><i data-feather="eye"></i></a>
															<?php endif ?>
														<?php endif ?>
														<?php if(in_array('editVoucher', $user_permission) && $row['status'] == '1' && $row['presented_by'] == session()->get('logged_user')): ?>
															<?php if($row['type'] == 'petty' && $row['method'] == 'cash'): ?>
																<a href="<?= base_url() ?>/editibc/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-info"><i data-feather="edit"></i></a>
															<?php elseif($row['type'] == 'petty' && $row['method'] == 'transfer'): ?>
																<a href="<?= base_url() ?>/editibt/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-info"><i data-feather="edit"></i></a>
															<?php elseif($row['type'] == 'payment' && $row['method'] == 'cash'): ?>
																<a href="<?= base_url() ?>/editpbc/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-info"><i data-feather="edit"></i></a>
															<?php elseif($row['type'] == 'payment' && $row['method'] == 'transfer'): ?>
																<a href="<?= base_url() ?>/editpbt/<?= $row['voucher_id'] ?>" class="btn btn-sm btn-info"><i data-feather="edit"></i></a>
															<?php endif ?>
														<?php endif ?>
														<?php if($row['attachments'] != ''): ?>
															<a href="<?= base_url() ?>/public/assets/img/vouchers/<?= $row['attachments'] ?>" class="btn btn-sm btn-primary" download><i data-feather="download"></i></a>
														<?php endif ?>
														<?php if(in_array('deleteVoucher', $user_permission)): ?>
															<a href="javascript:void(0)" class="btn btn-sm btn-danger delete"><i data-feather="trash-2"></i></a>
														<?php endif ?>
													</td>
												<?php endif ?>
											</tr>
											<?php $i++; endforeach ?>
										<?php endif ?>
									</tbody>
								<?php endif ?>
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
				var delete_id = $(this).closest('tr').find('.voucher_id').val();
				$('#deleteModal').modal('show');
				$('#deleteForm').attr('action', '<?= base_url() ?>/deletevoucher/'+delete_id);
			});
		});
	</script>
	<?= $this->include('layouts/footer'); ?>
<?= $this->endSection(); ?>