<div class="modal fade" id="change_profile_pic" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Change Profile Picture</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<?= form_open_multipart('/profile_upload/'.$user_info['user_id']); ?>
			<div class="modal-body m-3">
				<div class="col-12 col-lg-12">
					<div class="form-floating mb-3">
						Profile Picture: <span style="color: red">(800px by 800px preferably)</span>
						<input class="dropify" type="file" name="file_name" data-default-file="<?= base_url() ?>/public/assets/img/avatars/<?= $user_info['profile_pic'] ?>">
						
						<input type="submit" class="btn btn-primary col-12" name="save" value="Upload">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-success" name="save" value="Upload">
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>