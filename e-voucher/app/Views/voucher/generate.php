<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<main class="content">
		<div class="container-fluid p-0">

			<h1 class="h3 mb-3"><?= $page_name ?></h1>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<a href="<?= base_url() ?>/search" class="btn btn-sm btn-secondary float-end"><i data-feather="arrow-left"></i> Back To Filter</a>
							<h5 class="card-title test-center"><?= $search_title ?></h5>
							<hr class="my-4">
							<table id="datatables-buttons" class="table table-striped" style="width:100%">
								<thead>
									<tr>
										<th>Date</th>
										<th>Voucher ID</th>
										<th>Location</th>
										<th>Business</th>
										<th>Category</th>
										<th>Presented By</th>
										<th>Amount</th>
										<th>Paid To</th>
										<th>Type - Payment Method</th>
										<th>Being</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($search_result)): ?>
										<?php foreach($search_result as $row): ?>
											<tr>
												<td><?= date('d-M-Y', strtotime($row['date'])) ?></td>
												<td><?= $row['voucher_no'] ?></td>
												<td>
													<?php if(!empty($outlet)): ?>
														<?php foreach($outlet as $rows): ?>
															<?php if($row['outlet_id'] == $rows['outlet_id']): ?>
									            				<?= $rows['outlet_name'] ?>							            				
										            		<?php endif ?>
										        		<?php endforeach ?>
										        	<?php endif ?>
										        </td>
										        <td>
						            				<?php if(!empty($businesses)): ?>
														<?php foreach($businesses as $rowss): ?>
															<?php if($row['business_id'] == $rowss['business_id']): ?>
																<?= $rowss['business_name'] ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>
										        </td>
										        <td>
										        	<?php $serialize_category = unserialize($row['expense_category']);
														if(!empty($expense_categories)) {
															foreach($expense_categories as $rows) {
																if($serialize_category) { 
																	if(in_array($rows['category_id'], $serialize_category)) { 
																		echo $rows['category_name'].', '; 
																	} 
													            }
											                }
											            }
									                ?>
										        </td>
												<td><?php if(!empty($users)): ?>
														<?php foreach($users as $user): ?>
															<?php if($user['user_id'] == $row['presented_by']): ?>
																<?= $user['first_name'] ?> <?= $user['last_name'] ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>	</td>
												<td><?= '₦'.number_format($row['amount']) ?></td>
												<td><?= $row['paid_to'] ?> <?php if(!empty($row['account_number'])): ?> <?= '('. $row['bank_name'] .' - '. $row['account_number'] .')' ?> <?php endif ?></td>
												<td><?= ucfirst($row['type']) .' By '. ucfirst($row['method']) ?></td>
												<td>
													<?= $row['being'] ?>
												</td>
											</tr>
										<?php endforeach ?>
									<?php endif ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables with Buttons
			var datatablesButtons = $("#datatables-buttons").DataTable({
				responsive: true,
				lengthChange: !1,
				buttons: ["csv", "copy", "print"]
			});
			datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
		});
	</script>
	<script src="<?= base_url() ?>/public/assets/js/app.js"></script>
<?= $this->endSection(); ?>