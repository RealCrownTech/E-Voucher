<?php $page_session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?= $company_data['company_name'] ?>">
	<meta name="author" content="<?= $company_data['site_title'] ?>">

	<title>User Login</title>

	<link rel="canonical" href="" />
	<link rel="shortcut icon" href="public/assets/img/<?= base_url() ?>/public/assets/img/photos/<?= $company_data['favicon'] ?>">

	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
	<link href="public/assets/css/light.css" rel="stylesheet">

	<?php 
		if ($page_session->getTempdata('success')): ?>
			<script>
				// Notyf
				document.addEventListener("DOMContentLoaded", function() {
					var message = '<?= $page_session->getTempdata('success'); ?>';
					var type = 'success';
					var duration = '5000';
					var positionX = 'center';
					var positionY = 'top';
					window.notyf.open({
						type,
						message,
						duration,
						position: {
							x: positionX,
							y: positionY
						}
					});
				});
			</script>
		<?php endif;

		if ($page_session->getTempdata('error')): ?>
			<script>
				// Notyf
				document.addEventListener("DOMContentLoaded", function() {
					var message = '<?= $page_session->getTempdata('error'); ?>';
					var type = 'error';
					var duration = '5000';
					var positionX = 'center';
					var positionY = 'top';
					window.notyf.open({
						type,
						message,
						duration,
						position: {
							x: positionX,
							y: positionY
						}
					});
				});
			</script>
		<?php endif; ?>
</head>
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky" style="background-image: url(public/assets/img/photos/<?= $company_data['loginbg'] ?>); background-size: cover;">
	<div class="main d-flex justify-content-center w-100">
		<main class="content d-flex p-0">
			<div class="container d-flex flex-column">
				<div class="row h-100">
					<div class="col-sm-4 col-md-4 col-lg-4 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">
							<div class="text-center mt-4">
								<h1 class="h2" style="color: #ffffff;">Welcome back</h1>
								<p class="lead" style="color: #ffffff;">
									Sign in to your account to continue
								</p>
							</div>
							<div class="card" style="background: rgba(40, 57, 101, 0.65);">
								<div class="card-body">
									<div class="m-sm-4">
										<div class="text-center">
											<img src="public/assets/img/photos/<?= $company_data['logo'] ?>" alt="<?= $company_data['company_name'] ?>" class="img-fluid rounded-circle" width="264" height="264" />
										</div>
										<?= form_open('/login') ?>
											<div class="mb-3">
												<label style="color: #ffffff;" class="form-label">Username</label>
												<input class="form-control form-control-lg" type="text" name="email" value="<?= set_value('email'); ?>" placeholder="Enter your username" autocomplete="off" />
												<span class="text-danger"><?= display_error($validation, 'email') ?></span>
											</div>
											<div class="mb-3">
												<label style="color: #ffffff;" class="form-label">Password</label>
												<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
												<span class="text-danger"><?= display_error($validation, 'password') ?></span>
											</div>
											<div>												
												<small><a href="pages-reset-password.html">Forgot password?</a></small>
												<div class="form-check align-items-center">
													<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
													<label style="color: #ffffff;" class="form-check-label text-small" for="customControlInline">Remember me next time</label>
												</div>
											</div>
											<div class="text-center mt-3">
												<!-- <a href="home" class="btn btn-lg btn-primary">Sign in</a> -->
												<input type="submit" name="sign_in" class="btn btn-lg btn-primary" value="Sign In">
											</div>
										<?= form_close() ?>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
	<script src="public/assets/js/app.js"></script>
</body>
</html>