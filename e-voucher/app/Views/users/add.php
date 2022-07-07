<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<?= $this->include('layouts/navigation'); ?>
	<?= $this->include('layouts/header'); ?>
	<main class="content">
		<div class="container-fluid p-0">

			<div class="row">

				<div class="col-md-12">
					<div class="card">											
						<div class="card-body">					
							<h5 class="card-title"><?= $page_name ?></h5>

							<hr class="my-4">
							<div>
								<?= form_open('/addUser') ?>
									<div class="row">							
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputState">User Role<span class="font-13 text-danger">*</span></label>
											<select id="inputCountry" class="form-control select2" name="user_role[]" multiple>
							                    <option value="">--Select--</option>
							                    <?php foreach($other_roles_data as $roles): ?>
								                    <option value="<?= $roles['role_id'] ?>"><?= $roles['role_name'] ?></option>
								                <?php endforeach ?>
							                </select>
							                <span class="text-danger"><?= display_error($validation, 'user_role') ?></span>
										</div>
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputEmail4">First Name<span class="font-13 text-danger">*</span></label>
											<input type="text" class="form-control" id="inputEmail4" name="first_name" value="<?= set_value('first_name') ?>" placeholder="Enter your first name">
											<span class="text-danger"><?= display_error($validation, 'first_name') ?></span>
										</div>
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputEmail4">Middle Name</label>
											<input type="text" class="form-control" id="inputEmail4" name="middle_name" placeholder="Enter your middle name" value="<?= set_value('middle_name') ?>">
											<span class="text-danger"><?= display_error($validation, 'middle_name') ?></span>
										</div>
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputEmail4">Last Name<span class="font-13 text-danger">*</span></label>
											<input type="text" class="form-control" id="inputEmail4" name="last_name" placeholder="Enter your last name" value="<?= set_value('last_name') ?>">
											<span class="text-danger"><?= display_error($validation, 'last_name') ?></span>
										</div>
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputEmail4">Email<span class="font-13 text-danger">*</span></label>
											<input type="text" class="form-control" id="inputEmail4" name="user_email" placeholder="Enter Username" value="<?= set_value('user_email') ?>">
											<span class="text-danger"><?= display_error($validation, 'user_email') ?></span>
										</div>
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputEmail4">Password<span class="font-13 text-danger">*</span></label>
											<input type="password" class="form-control" id="inputEmail4" name="user_password" placeholder="Enter Password">
											<span class="text-danger"><?= display_error($validation, 'user_password') ?></span>
										</div>
									</div>
									<div class="row">									
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputPassword4">CUG/Mobile No</label>
											<input type="text" class="form-control" id="inputPassword4" name="user_mobile" data-mask="00000000000" data-reverse="true"  placeholder="00000000000" value="<?= set_value('user_mobile') ?>">
											<span class="text-danger"><?= display_error($validation, 'user_mobile') ?></span>
										</div>
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputState">Gender</label>
											<select id="inputCountry" class="form-control" name="gender">
							                     <option value="">--Select--</option>
							                     <option value="male">Male</option>
							                     <option value="female">Female</option>
							                </select>
							                <span class="text-danger"><?= display_error($validation, 'gender') ?></span>
										</div>
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputState">Status<span class="font-13 text-danger">*</span></label>
											<select id="inputState" class="form-control" name="user_status">
							                     <option value="">--Select--</option>
							                     <option value="1">Active</option>
							                     <option value="2">Probation</option>
							                     <option value="3">Leave</option>
							                     <option value="0">Inactive</option>
							                </select>
							                <span class="text-danger"><?= display_error($validation, 'user_status') ?></span>
										</div>										
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputAddress2">Location<span class="font-13 text-danger">*</span></label>
											<select class="form-control select2" data-toggle="select2" id="" name="outlet">
												<option value="">--Choose--</option>
												<?php if(!empty($outlets)): ?>
													<?php foreach($outlets as $row): ?>
									            		<option value="<?= $row['outlet_id'] ?>"><?= $row['outlet_name'] ?></option>
									        		<?php endforeach ?>
									        	<?php endif ?>
									        </select>
											<span class="text-danger"><?= display_error($validation, 'outlet') ?></span>
										</div>
										<!-- <div class="mb-3 col-md-4">
											<label class="form-label" for="inputAddress2">Departments<span class="font-13 text-danger">*</span></label>
											<select class="form-control select2" data-toggle="select2" id="" name="department">
												<option value="">--Choose--</option>
												<?php if(!empty($departments)): ?>
													<?php foreach($departments as $row): ?>
									            		<option value="<?= $row['department_id'] ?>"><?= $row['department_name'] ?></option>
									        		<?php endforeach ?>
									        	<?php endif ?>
									        </select>
											<span class="text-danger"><?= display_error($validation, 'department') ?></span>
										</div> -->
										<div class="mb-3 col-md-8">
											<label class="form-label" for="inputAddress2">Address</label>
											<textarea class="form-control" name="address" id="inputAddress2" placeholder="Apartment, studio, or floor"><?= set_value('address') ?></textarea>
											<span class="text-danger"><?= display_error($validation, 'address') ?></span>
										</div>
									</div>
									<hr class="my-4">
									<div class="row">
										<div class="col-12 col-xl-12">
											<div class="mb-3 mb-xl-0 float-end">
												<input type="submit" name="save" class="btn btn-success" value="Submit">
											</div>
										</div>
									</div>
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