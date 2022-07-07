<div class="offcanvas offcanvas-start" tabindex="-1" id="editRoomCanvas" aria-labelledby="editRoomLabel" aria-hidden="true">	
	<div class="offcanvas-header">
		<h5 id="editRoomLabel"></h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body">
		<?php $attributes = ['id' => 'roomform']; echo form_open('', $attributes) ?>
		<div class="col-12 col-lg-12">
			<div class="form-floating mb-3">
				<input type="text" class="form-control room_no_edit" id="floatingInput1" value="" name="room_no" readonly>
				<label for="floatingInput1">Room Number</label>
				<span class="text-danger"><?= display_error($validation, 'room_no') ?></span>
			</div>
		</div>
		<div class="col-12 col-lg-12">
			<div class="form-floating mb-3">
				<select class="form-select room_type_edit" id="floatingSelect" aria-label="Floating label select example" name="room_type">
					<?php if(!empty($room_types)): ?>
		            <?php foreach ($room_types as $row): ?>
			            <option value="<?= $row['room_type_id']; ?>" <?php if(set_value('room_type') == $row['room_type_id']) { echo 'selected'; } ?>><?= $row['title']; ?></option>
		            <?php endforeach; ?>
		        <?php endif ?>
	            </select>
				<label for="floatingSelect">Room Type</label>
				<span class="text-danger"><?= display_error($validation, 'room_type') ?></span>
			</div>
		</div>
		<div class="col-12 col-lg-12">
			<div class="form-floating">
				<select class="form-select room_status_edit" id="floatingSelect" aria-label="Floating label select example" name="room_status">
		            <option value="Vacant" <?php if(set_value('room_status') == 'Vacant') { echo 'selected'; } ?>>Vacant</option>
		            <option value="Occupied" <?php if(set_value('room_status') == 'Occupied') { echo 'selected'; } ?>>Occupied</option>
		            <option value="Reserved" <?php if(set_value('room_status') == 'Reserved') { echo 'selected'; } ?>>Reserved</option>
	            </select>
				<label for="floatingSelect">Status</label>
				<span class="text-danger"><?= display_error($validation, 'room_status') ?></span>
			</div>
		</div>
		<div class="mt-3 text-center">
			<input class="btn btn-secondary" type="submit" name="save" value="Save Changes">
		</div>
		<?= form_close() ?>
	</div>	
</div>