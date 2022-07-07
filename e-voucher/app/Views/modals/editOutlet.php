<div class="modal fade" id="editOutletModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Outlets</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<?php $attributes = ['id' => 'editFormm']; echo form_open('', $attributes) ?>
			<div class="modal-body m-3">
				<div class="col-12 col-lg-12">
					<div class="form-floating mb-3">
						<input type="text" class="form-control out_name" id="floatingInput1" name="outlet_name" value="<?= set_value('outlet_name') ?>">
						<label for="floatingInput1">Outlet Name</label>
						<span class="text-danger"><?= display_error($validation, 'outlet_name') ?></span>
					</div>
				</div>
				<div class="col-12 col-lg-12">
					<div class="form-floating">
						<h5 class="modal-title">Choose Businesses</h5>
						<table id="datatables-permission" class="table table-striped table-responsive">
							<thead>
								<tr>
									<th>Check</th>
									<th class="text-center">Business Name</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($businesses)): ?>
									<?php foreach($businesses as $row): ?>								
										<tr>
											<td class="text-center"><input type="checkbox" name="business[]" value="<?= $row['business_id'] ?>" id="business"></td>
											<td class="text-center"><?= $row['business_name'] ?></td>
										</tr>
									<?php endforeach ?>
								<?php endif ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-success" name="save">
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>