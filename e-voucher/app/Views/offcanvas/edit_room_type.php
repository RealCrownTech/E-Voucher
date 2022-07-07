<div class="offcanvas offcanvas-end" tabindex="-1" id="editRoomTypeCanvas" aria-labelledby="editRoomTypeLabel" aria-hidden="true">
	<div class="offcanvas-header">
		<h5 id="editRoomTypeLabel"></h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body">
		<?php $attributes = ['id' => 'roomtypeform']; echo form_open('', $attributes) ?>
		<input type="hidden" name="room_type_id" class="id_edit" value="">
		<div class="col-12 col-lg-12">
			<div class="form-floating mb-3">
				<input type="text" class="form-control title_edit" id="floatingInput1" name="title" value="<?= set_value('title') ?>">
				<label for="floatingInput1">Title</label>
				<span class="text-danger"><?= display_error($validation, 'title') ?></span>
			</div>
		</div>
		<div class="col-12 col-lg-12">
			<div class="form-floating mb-3">
				<input type="number" class="form-control price_edit" id="floatingInput1" name="price"  value="<?= set_value('price') ?>">
				<label for="floatingInput1">Price</label>
				<span class="text-danger"><?= display_error($validation, 'price') ?></span>
			</div>
		</div>
		<div class="row g-2">
			<div class="col-md">
				<div class="form-floating mb-3">
					<input type="number" class="form-control adult_edit" id="floatingInput1" name="adult" value="<?= set_value('adult') ?>">
					<label for="floatingInput1">Adult Capacity</label>
					<span class="text-danger"><?= display_error($validation, 'adult') ?></span>
				</div>
			</div>
			<div class="col-md">
				<div class="form-floating mb-3">
					<input type="number" class="form-control kid_edit" id="floatingInput1" name="kid" value="<?= set_value('kid') ?>">
					<label for="floatingInput1">Kid Capacity</label>
					<span class="text-danger"><?= display_error($validation, 'kid') ?></span>
				</div>
			</div>
		</div>
		<!-- <hr class="my-1">
		<h5>Amenities</h5>
		<div class="row">
			<div class="col-md">
				<div class="mb-2">
					<div class="input-group">
						<div class="input-group-text">
							<input  type="checkbox" name="air_condition" value="1" class="ac_edit">
						</div>
						<input type="text" class="form-control" value="Air Conditioner" placeholder="Checkbox" readonly>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="mb-2">
					<div class="input-group">
						<div class="input-group-text">
							<input type="checkbox" name="free_wifi" value="1" class="fw_edit">
						</div>
						<input type="text" class="form-control" value="Free Wifi" placeholder="Checkbox" readonly>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<div class="mb-2">
					<div class="input-group">
						<div class="input-group-text">
							<input type="checkbox" name="breakfast" value="1" class="bf_edit">
						</div>
						<input type="text" class="form-control" value="Breakfast" placeholder="Checkbox" readonly>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="mb-2">
					<div class="input-group">
						<div class="input-group-text">
							<input type="checkbox" name="newspaper" value="1" class="np_edit">
						</div>
						<input type="text" class="form-control" value="Free Newspaper" placeholder="Checkbox" readonly>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<div class="mb-2">
					<div class="input-group">
						<div class="input-group-text">
							<input type="checkbox" name="double_bed" value="1" class="db_edit">
						</div>
						<input type="text" class="form-control" value="Double Bed" placeholder="Checkbox" readonly>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="mb-2">
					<div class="input-group">
						<div class="input-group-text">
							<input type="checkbox" name="coffee_maker" value="1" class="cm_edit">
						</div>
						<input type="text" class="form-control" value="Coffee Maker" placeholder="Checkbox" readonly>
					</div>
				</div>
			</div>
		</div> -->
		<div class="mt-3 text-center">
			<input class="btn btn-secondary" type="submit" name="save" value="Save Changes">
		</div>
		<?= form_close() ?>
	</div>
</div>