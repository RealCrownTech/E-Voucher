<div class="modal fade" id="addBusiness" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add New Business</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<?= form_open('/addBusiness') ?>
			<div class="modal-body m-3">
				<div class="col-12 col-lg-12">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput1" name="business_name" value="<?= set_value('business_name') ?>">
						<label for="floatingInput1">Business Name</label>
						<span class="text-danger"><?= display_error($validation, 'business_name') ?></span>
					</div>
				</div>
				<div class="col-12 col-lg-12">
					<div class="form-floating">
						
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