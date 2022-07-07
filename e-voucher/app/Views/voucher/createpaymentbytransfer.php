<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<?= $this->include('layouts/navigation'); ?>
	<?= $this->include('layouts/header'); ?>
	<main class="content">
		<div class="container-fluid p-0">

			<h1 class="h3 mb-3"><?= $page_name ?></h1>

			<div class="row">
				<div class="col-xl-6 col-sm-12">
					<div class="card">
						<div class="card-header">
							<a href="<?= base_url() ?>/vouchers" class="btn btn-sm btn-secondary float-start"><i data-feather="arrow-left"></i> Back</a>
							<h5 class="card-title float-end">Date: <?= date('d-M-Y'); ?></h5>
						</div>
						<hr class="my-0">
						<div class="card-body">
							<div class="row">
								<?= form_open_multipart('/pbt') ?>									
									<div class="col-md-12 col-sm-12 mb-3">
										<label for="inputPasswordCurrent" class="form-label">Outlet</label>
										<select id="inputCountry" class="form-control select2" name="outlet">
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
						                <span class="text-danger"><?= display_error($validation, 'outlet') ?></span>
									</div>
									<div class="col-md-12 col-sm-12 mb-3">
										<label for="inputPasswordCurrent" class="form-label">Business</label>
										<select id="inputCountry" class="form-control select2" name="business">
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
						                <span class="text-danger"><?= display_error($validation, 'business') ?></span>
									</div>
									<div class="col-xl-12 col-sm-12 mb-3">
										<label class="form-label" for="inputState">Expense Category<span class="font-13 text-danger">*</span></label>
										<select id="inputCountry" class="form-control select2" name="expense_category[]" multiple>
						                    <option value="">--Select--</option>
						                    <?php if(!empty($expense_categories)): ?>
							                    <?php foreach($expense_categories as $row): ?>
								                    <option value="<?= $row['category_id'] ?>" <?php if(set_value('expense_category') == $row['category_id']) {echo 'selected'; } ?>><?= $row['category_name'] ?></option>
								                <?php endforeach ?>
								            <?php endif ?>
						                </select>
						                <span class="text-danger"><?= display_error($validation, 'expense_category') ?></span>
									</div>
									<div class="col-xl-12 col-sm-12 mb-3">
										<label for="inputPasswordCurrent" class="form-label">Bank Name</label>
										<input type="text" class="form-control" name="bank_name" value="<?= set_value('bank_name') ?>">
										<span class="text-danger"><?= display_error($validation, 'bank_name') ?></span>
									</div>
									<div class="col-xl-12 col-sm-12 mb-3">
										<label for="inputPasswordCurrent" class="form-label">Account Name</label>
										<input type="text" class="form-control" name="paid_to" value="<?= set_value('paid_to') ?>">
										<span class="text-danger"><?= display_error($validation, 'paid_to') ?></span>
									</div>
									<div class="col-xl-12 col-sm-12 mb-3">
										<label for="inputPasswordCurrent" class="form-label">Account Number</label>
										<input type="text" class="form-control" name="account_number" data-mask="0000000000" data-reverse="true" value="<?= set_value('account_number') ?>">
										<span class="text-danger"><?= display_error($validation, 'account_number') ?></span>
									</div>
									<div class="col-xl-12 col-sm-12 mb-3">
										<label for="inputPasswordCurrent" class="form-label">Amount</label>
										<input type="text" class="form-control" name="amount"  data-mask="00000000000000" data-reverse="true" value="<?= set_value('amount') ?>">
										<span class="text-danger"><?= display_error($validation, 'amount') ?></span>
									</div>
									<div class="col-xl-12 col-sm-12 mb-3">
										<label for="inputPasswordCurrent" class="form-label">Being Payment For</label>
										<textarea class="form-control" name="being" style="white-space: pre-wrap;" placeholder="Being payment for"><?= set_value('being') ?></textarea>
										<span class="text-danger"><?= display_error($validation, 'being') ?></span>
									</div>									
									<hr class="my-4">
									<div class="col-xl-12 col-sm-12 mb-3">
										<label for="inputPasswordCurrent" class="form-label">Attachment:</label><br>
										<input type="file" name="attachment"><br>
										<span class="text-primary">You can only add 1 attachment</span><br>
										<span class="text-danger"><?= display_error($validation, 'attachment') ?></span>
									</div>
									<hr class="my-4">
									<input type="submit" class="btn btn-primary float-end" name="save" value="Submit">
								<?= form_close() ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?= $this->include('layouts/footer'); ?>
<?= $this->endSection(); ?>