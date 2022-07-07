<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirmation</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<?php $attributes = ['id' => 'deleteForm']; echo form_open('', $attributes) ?>
			<div class="modal-body m-3">
				<div class="col-12 col-lg-12">
					<input type="hidden" class="delete_id" name="delete_id">
					<div class="form-floating mb-3">
						Are you sure to proceed?
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
				<input type="submit" class="btn btn-success" name="delete" value="Yes">
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>