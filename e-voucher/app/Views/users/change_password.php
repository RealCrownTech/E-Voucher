<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<?= $this->include('layouts/navigation'); ?>
	<?= $this->include('layouts/header'); ?>
	<main class="content">
		<div class="container-fluid p-0">

			<h1 class="h3 mb-3"><?= $page_name ?></h1>

			<div class="row">
				<div class="col-4">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Password</h5>
							<?= form_open('/change_password') ?>
								<div class="mb-3">
									<label for="inputPasswordCurrent" class="form-label">Current password</label>
									<input type="password" class="form-control" id="inputPasswordCurrent" name="old_password">
									<span class="text-danger"><?= display_error($validation, 'old_password') ?></span>
									<!-- <small><a href="pages-settings.html#">Forgot your password?</a></small> -->
								</div>
								<div class="mb-3">
									<label for="inputPasswordNew" class="form-label">New password</label>
									<input type="password" class="form-control" id="inputPasswordNew" name="password">
									<span class="text-danger"><?= display_error($validation, 'password') ?></span>
								</div>
								<div class="mb-3">
									<label for="inputPasswordNew2" class="form-label">Verify password</label>
									<input type="password" class="form-control" id="inputPasswordNew2" name="passconf">
									<span class="text-danger"><?= display_error($validation, 'passconf') ?></span>
								</div>
								<input type="submit" class="btn btn-primary" value="submit">
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>

		</div>
	</main>
	<?= $this->include('layouts/footer'); ?>
<?= $this->endSection(); ?>