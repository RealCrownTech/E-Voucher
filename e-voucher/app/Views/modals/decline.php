<div class="modal fade" id="declineModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirmation</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<?php $attributes = ['id' => 'declineForm']; echo form_open('', $attributes) ?>
			<div class="modal-body m-3">
				<div class="col-12 col-lg-12">
					<input type="hidden" class="delete_id" name="delete_id">
					<div class="col-xl-12 col-sm-12 mb-3">
						<label for="inputPasswordCurrent" class="form-label">Reason for decline<span class="text-danger">*</span></label>
						<textarea class="form-control" name="reason" required></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<input type="submit" class="btn btn-success" name="delete" value="Proceed To Decline">
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>