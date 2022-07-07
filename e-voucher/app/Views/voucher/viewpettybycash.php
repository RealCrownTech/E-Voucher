<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<?= $this->include('layouts/navigation'); ?>
	<?= $this->include('layouts/header'); ?>
	<main class="content">
		<div class="container-fluid p-0">

			<h1 class="h3 mb-3"><?= $page_name ?></h1>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header float-end mt-2">
							<?php if($voucher_data['status'] == '1'): ?>
								<h3 class="card-title text-primary float-end"><?= $voucher_data['voucher_no'] ?> Submitted</h3>
							<?php elseif($voucher_data['status'] == '2'): ?>
								<h3 class="card-title text-warning float-end"><?= $voucher_data['voucher_no'] ?> In Process</h3>
							<?php elseif($voucher_data['status'] == '3'): ?>
								<h3 class="card-title text-success float-end"><?= $voucher_data['voucher_no'] ?> Approved</h3>
							<?php elseif($voucher_data['status'] == '4'): ?>
								<h3 class="card-title text-danger float-end"><?= $voucher_data['voucher_no'] ?> Declined</h3>
							<?php endif ?>
							<a href="<?= base_url() ?>/vouchers" class="btn btn-sm btn-secondary float-start"><i data-feather="arrow-left"></i> Back</a>
						</div>
						<hr class="my-0">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6 text-center">
									<img class="img-fluid" height="150px" src="<?= base_url() ?>/public/assets/img/photos/<?= $company_data['logo'] ?>">
								</div>
								<div class="col-md-6 text-center my-5">
									<div class="text-muted"><i data-feather="map-pin"></i> <?= $company_data['company_address'] ?></div>
									<div class="text-muted"><i data-feather="phone"></i> <?= $company_data['company_phone'] ?><?php if($company_data['company_mobile'] != ''): ?>, <?= $company_data['company_phone'] ?><?php endif ?></div>
								</div>
							</div>
							<div class="row my-4">
								<div class="col-md-12 text-center">
									<h3 class="text-muted">PAYMENT VOUCHER</h3>
									<h4 class="text-muted">IMPREST</h4>
								</div>
							</div>
							<?php if($voucher_data['attachments'] != ''): ?>
    							<div class="row my-2">
    								<div class="col-md-12 text-center">
    							        <a href="<?= base_url() ?>/public/assets/img/vouchers/<?= $voucher_data['attachments'] ?>" class="btn btn-sm btn-primary" download><i data-feather="download"></i> Download</a>
    							    </div>
    							</div>
    						<?php endif ?>
							<?php if($voucher_data['status'] == '1'): ?>
								<?php if(!empty($hod) && $voucher_data['outlet_id'] == '1' && session()->get('logged_user') == $hod['department_head']): ?>			
								    <div class="row my-2">
										<div class="col-md-12 text-center">
											<a href="javascript:void(0)" class="btn btn-sm btn-warning process">Process</a>
											<a href="javascript:void(0)" class="btn btn-sm btn-danger decline">Decline</a>
										</div>
									</div>
								<?php else: ?>				
									<?php if(in_array('addProcessPayment', $user_permission) && $voucher_data['outlet_id'] == session()->get('outlet') || in_array('addProcessPayment', $user_permission) && session()->get('logged_user') == '1'): ?>
										<div class="row my-2">
											<div class="col-md-12 text-center">
												<a href="javascript:void(0)" class="btn btn-sm btn-success approve">Approve</a>
												<a href="javascript:void(0)" class="btn btn-sm btn-danger decline">Decline</a>
											</div>
										</div>
									<?php endif ?>
								<?php endif ?>
							<?php elseif($voucher_data['status'] == '2'): ?>
								<?php if(in_array('addApprovePayment', $user_permission)): ?>
									<div class="row my-2">
										<div class="col-md-12 text-center">
											<a href="javascript:void(0)" class="btn btn-sm btn-success approve">Approve</a>
											<a href="javascript:void(0)" class="btn btn-sm btn-danger decline">Decline</a>
										</div>
									</div>
								<?php endif ?>
							<?php endif ?>
							<div class="row mx-4">
								<div class="col-md-3 text-left">
									<p class="text-muted"><strong>Pv NO:</strong> <span class="text-decoration-underline"><?= $voucher_data['voucher_no'] ?></span></p>
								</div>
								<div class="col-md-2 text-left">
									<p class="text-muted"><strong>Outlet:</strong>
										<?php if(!empty($outlets)): ?>
											<?php foreach($outlets as $outlet): ?>
												<?php if($outlet['outlet_id'] == $voucher_data['outlet_id']): ?>
													<?= $outlet['outlet_name'] ?>
												<?php endif ?>
											<?php endforeach ?>
										<?php endif ?>
									</p>
								</div>
								<div class="col-md-2 text-left">
									<p class="text-muted"><strong>Business:</strong>
										<?php if(!empty($businesses)): ?>
											<?php foreach($businesses as $business): ?>
												<?php if($business['business_id'] == $voucher_data['business_id']): ?>
													<?= $business['business_name'] ?>
												<?php endif ?>
											<?php endforeach ?>
										<?php endif ?>
									</p>
								</div>
								<div class="col-md-5 text-left">
									<p class="text-muted"><strong>Expense Category: </strong> 
										<?php $serialize_category = unserialize($voucher_data['expense_category']);
											if(!empty($expense_categories)) {
												foreach($expense_categories as $row) {
													if($serialize_category) { 
														if(in_array($row['category_id'], $serialize_category)) { 
															echo $row['category_name'].', '; 
														} 
										            }
								                }
								            }
						                ?>
									</p>
								</div>
							</div>
							<div class="row mx-4">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td><strong>Amount: </strong><?= '₦'.number_format($voucher_data['amount']) ?></td>
											<td><strong>Date: </strong><?= date('d-M-Y', strtotime($voucher_data['date'])) ?></td>
										</tr>
										<tr>
											<td><strong>Cash: </strong>
												<?php if($voucher_data['method'] == 'cash'): ?>
													<i data-feather="check"></i>
													<i data-feather="check"></i>
													<i data-feather="check"></i>
												<?php endif ?>
											</td>
											<td><strong>Transfer: </strong>
												<?php if($voucher_data['method'] == 'transfer'): ?>
													<i data-feather="check"></i>
													<i data-feather="check"></i>
													<i data-feather="check"></i>
												<?php endif ?>
											</td>
										</tr>
										<tr>
											<?php if($voucher_data['outlet_id'] == '1'): ?>
												<td><strong>Presented By: </strong> <br>
													<?php if(!empty($users)): ?>
														<?php foreach($users as $user): ?>
															<?php if($user['user_id'] == $voucher_data['presented_by']): ?>
																<?= $user['first_name'] ?> <?= $user['last_name'] ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>
												</td>
												<td><strong>To: </strong> <br>
													<?= $voucher_data['paid_to'] ?>
												</td>
											<?php else: ?>
												<td colspan="2"><strong>To: </strong> <br>
													<?= $voucher_data['paid_to'] ?>
												</td>
											<?php endif ?>
										</tr>
										<tr>
											<td colspan="2"><strong>The Sum Of: </strong> <br>
												<?php 
													$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
													$f->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-numbering-verbose"); 
													echo ucfirst($f->format($voucher_data['amount']).' naira only.');  
												?>
											</td>
										</tr>
										<tr>
											<td colspan="2"><strong>Being: </strong> <br>
												<?= $voucher_data['being']; ?>
											</td>
										</tr>
										<tr>
											<?php if($voucher_data['outlet_id'] == '1'): ?>
												<td><strong>Processed By: </strong> <br>
													<?php if(!empty($users)): ?>
														<?php foreach($users as $user): ?>
															<?php if($user['user_id'] == $voucher_data['processed_by']): ?>
																<?= $user['first_name'] ?> <?= $user['last_name'] ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>
												</td>
											<?php else: ?>
												<td><strong>Presented By: </strong> <br>
													<?php if(!empty($users)): ?>
														<?php foreach($users as $user): ?>
															<?php if($user['user_id'] == $voucher_data['presented_by']): ?>
																<?= $user['first_name'] ?> <?= $user['last_name'] ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>
												</td>
											<?php endif ?>
											<td>
												<?php if ($voucher_data['status'] == '4'): ?>
													<strong>Declined By: </strong> <br>
													<?php if(!empty($users)): ?>
														<?php foreach($users as $user): ?>
															<?php if($user['user_id'] == $voucher_data['declined_by']): ?>
																<?= $user['first_name'] ?> <?= $user['last_name'] ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>
												<?php else: ?>
													<strong>Approved By: </strong> <br>
													<?php if(!empty($users)): ?>
														<?php foreach($users as $user): ?>
															<?php if($user['user_id'] == $voucher_data['approved_by']): ?>
																<?= $user['first_name'] ?> <?= $user['last_name'] ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>
												<?php endif ?>
											</td>
										</tr>										
										<?php if(!empty($voucher_data['reason'])): ?>
											<tr>
												<td colspan="2"><strong>Reason: </strong> <br><?= $voucher_data['reason'] ?></td>
											</tr>
										<?php endif ?>
									</tbody>
								</table>
								<div class="row mt-6">
									<div class="col-md-12 text-center">
										<img class="img-fluid" width="350px" src="<?= base_url() ?>/public/assets/img/photos/<?= $company_data['subsidiary'] ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="text-center">
						    <a href="<?= base_url() ?>/print_ibc/<?= $voucher_data['voucher_id'] ?>" class="btn btn-primary">Print Voucher</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Start Modal-->
			<?= $this->include('modals/delete'); ?>
			<?= $this->include('modals/decline'); ?>
			<!-- End Modal-->
		</div>
	</main>
	<script type="text/javascript">
		jquery_3_2_1(document).ready(function () {
			$(document).on('click', '.process', function(){
				$('#deleteModal').modal('show');
				$('#deleteForm').attr('action', '<?= base_url() ?>/processpayment/'+<?= $voucher_data['voucher_id'] ?>);
			});

			$(document).on('click', '.approve', function(){
				$('#deleteModal').modal('show');
				$('#deleteForm').attr('action', '<?= base_url() ?>/approvepetty/'+<?= $voucher_data['voucher_id'] ?>);
			});

			$(document).on('click', '.decline', function(){
				$('#declineModal').modal('show');
				$('#declineForm').attr('action', '<?= base_url() ?>/declinepetty/'+<?= $voucher_data['voucher_id'] ?>);
			});
		});
	</script>
	<?= $this->include('layouts/footer'); ?>
<?= $this->endSection(); ?>