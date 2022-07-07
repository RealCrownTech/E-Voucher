<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<?= $this->include('layouts/navigation'); ?>
	<?= $this->include('layouts/header'); ?>
	<main class="content">
		<div class="container-fluid p-0">

			<h1 class="h3 mb-3"><?= $page_name ?></h1>

			<div class="row">
				<div class="col-md-12">
					<div class="card">											
						<div class="card-body">
							<h5 class="card-title">Filter</h5>
							<hr class="my-4">
							<?= form_open('/generate_report') ?>
							<div class="row">
								<div class="mb-3 col-md-3">
									<div class="mb-3 mb-xl-0">
										<label class="form-label">Date From</label>
										<input class="form-control" id="date_from" type="text" name="date_from" value="<?= date('m') ?>/1/<?= date('Y') ?>" />
									</div>
								</div>
								<div class="mb-3 col-md-3">
									<div class="mb-3 mb-xl-0">
										<label class="form-label">Date To</label>
										<input class="form-control" id="date_to" type="text" name="date_to" />
									</div>
								</div>
								<div class="mb-3 col-md-3">
									<label class="form-label" for="inputState">Outlet</label>
									<select id="inputState" class="form-control select2" name="outlet">
										<option value=""></option>
				                     	<?php if(in_array('viewAllOutlets', $user_permission)): ?>
											<?php if(!empty($outlet)): ?>
							                    <?php foreach($outlet as $row): ?>
								                    <option value="<?= $row['outlet_id'] ?>" <?php if(set_value('outlet') == $row['outlet_id']) {echo 'selected'; } ?>><?= $row['outlet_name'] ?></option>
								                <?php endforeach ?>
								            <?php endif ?>
								        <?php else: ?>
								        	<?php if(!empty($outlet)): ?>
							                    <?php foreach($outlet as $row): ?>
							                    	<?php if(session()->get('outlet') == $row['outlet_id']): ?>
								                    	<option value="<?= $row['outlet_id'] ?>" <?php if(set_value('outlet') == $row['outlet_id']) {echo 'selected'; } ?>><?= $row['outlet_name'] ?></option>
								                    <?php endif ?>
								                <?php endforeach ?>
								            <?php endif ?>
								        <?php endif ?>
					                </select>
								</div>
								<div class="mb-3 col-md-3">
									<label class="form-label" for="inputState">Business</label>
									<select id="inputCountry" class="form-control select2" name="business">
										<option value=""></option>
										<?php if(in_array('viewAllOutlets', $user_permission)): ?>
											<?php
												if(!empty($businesses)) {
													foreach ($businesses as $rows) { ?>
														<option value="<?= $rows['business_id'] ?>" <?php if(set_value('business') == $rows['business_id']) {echo 'selected'; } ?>><?= $rows['business_name'] ?></option>
													<?php }
												}
											?>
										<?php else: ?>
											<?php if(!empty($outlet)): ?>
							                    <?php foreach($outlet as $row): ?>
							                    	<?php $serialize_business = unserialize($row['outlet_businesses']);
														if(!empty($businesses)) {
															foreach ($businesses as $rows) {
																if($serialize_business && session()->get('outlet') == $row['outlet_id']) { 
																	if(in_array($rows['business_id'], $serialize_business)) { ?>
																		<option value="<?= $rows['business_id'] ?>" <?php if(set_value('business') == $rows['business_id']) {echo 'selected'; } ?>><?= $rows['business_name'] ?></option>
																	<?php } 
																}
															}
														}
													?>
								                <?php endforeach ?>
								            <?php endif ?>
								        <?php endif ?>
					                </select>
								</div>
							</div>
							<div class="row">
								<div class="mb-3 col-md-3">
									<label class="form-label" for="inputState">Voucher ID / PV No</label>
									<input type="text" class="form-control" name="voucher_no">
								</div>
								<div class="mb-3 col-md-3">
									<label class="form-label" for="inputState">Type</label>
									<select id="inputCountry" class="form-control" name="type">
					                    <option value="">--Select--</option>
					                    <option value="petty">Petty</option>
					                    <option value="payment">Payment</option>
					                </select>
								</div>
								<div class="mb-3 col-md-3">
									<label class="form-label" for="inputState">Method</label>
									<select id="inputCountry" class="form-control" name="method">
					                    <option value="">--Select--</option>
					                    <option value="cash">Cash</option>
					                    <option value="transfer">Transfer</option>
					                </select>
								</div>
								<div class="mb-3 col-md-3">
									<label class="form-label" for="inputState">Expense Category</label>
									<select id="" class="form-control select2" name="expense_category[]" multiple>
					                    <option value="">--Select--</option>
					                    <?php foreach($expense_categories as $row): ?>
						                    <option value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
						                <?php endforeach ?>
					                </select>
								</div>
							</div>
							<hr class="my-4">
							<input type="submit" class="btn btn-success float-end" name="submit" value="Generate" />
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?= $this->include('layouts/footer'); ?>
<?= $this->endSection(); ?>