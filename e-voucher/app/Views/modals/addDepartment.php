<div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add New Department</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<?= form_open('/addDepartment') ?>
			<div class="modal-body m-3">
				<div class="col-12 col-lg-12">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput1" name="department_name" value="<?= set_value('department_name') ?>">
						<label for="floatingInput1">Department Name</label>
						<span class="text-danger"><?= display_error($validation, 'department_name') ?></span>
					</div>
				</div>
				<div class="col-12 col-lg-12">
					<label for="floatingInput1">Head of Department</label>
					<div class="form-floating mb-3">
						<select id="inputCountry" class="form-control select2" name="hod">
		                    <option value="">--Select--</option>
		                    <?php foreach($users as $row): ?>
			                    <option value="<?= $row['user_id'] ?>"><?= $row['first_name'] ?> <?= $row['last_name'] ?></option>
			                <?php endforeach ?>
		                </select>
		                <span class="text-danger"><?= display_error($validation, 'hod') ?></span>
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