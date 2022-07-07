<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<?= $this->include('layouts/navigation'); ?>
	<?= $this->include('layouts/header'); ?>
	<main class="content">
		<div class="container-fluid p-0">

			<h1 class="h3 mb-3">Customer Profile</h1>

			<div class="row">
				<div class="col-md-4 col-xl-4">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-0">Profile Details</h5>
							<hr class="my-4">
							<?php if($user_info['profile_pic'] == ''): ?>
								<img src="<?= base_url() ?>/public/assets/img/avatars/me.png" alt="<?= $user_info['first_name'] ?> <?= $user_info['last_name'] ?>" class="img-fluid rounded-circle mb-2" width="128" height="128" />
							<?php else: ?>
								<img src="<?= base_url() ?>/public/assets/img/avatars/<?= $user_info['profile_pic'] ?>" alt="<?= $user_info['first_name'] ?> <?= $user_info['last_name'] ?>" class="img-fluid rounded-circle mb-2" width="128" height="128" />
							<?php endif ?>
							<h5 class="card-title mb-0"><?= $user_info['first_name'] ?> <?php if($user_info['middle_name'] != '') { echo $user_info['middle_name']; } ?> <?= $user_info['last_name'] ?></h5>
							<div class="text-muted mb-2">
								<?php $serialize_user_role = unserialize($user_info['user_role']);
									foreach($roles_data as $roles) {
										if($serialize_user_role) { 
											if(in_array($roles['role_id'], $serialize_user_role)) { 
												echo $roles['role_name'].', '; 
											} 
							            }
					                }
				                ?>
							</div>

							<div>
								<?php if(in_array('editUser', $user_permission)): ?>
									<a class="btn btn-primary btn-sm" href="<?= base_url()?>/editUser/<?= $user_info['user_id'] ?>">Edit Profile</a>
								<?php endif ?>
								<?php if(in_array('editUser', $user_permission) || $user_info['user_id'] == session()->get('logged_user')): ?>
									<a class="btn btn-warning btn-sm" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#change_profile_pic">Change Picture</a>
								<?php endif ?>

								<!-- Start Profile Pic Modal-->
								<?= $this->include('modals/change_profile_pic'); ?>
								<!-- End Profile Pic Modal-->
							</div>
						</div>
						<hr class="my-0" />
						<div class="card-body">
							<h5 class="h6 card-title">About</h5>
							<ul class="list-unstyled mb-0">
								<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Address <a href="javascript:void(0)"><?= $user_info['address'] ?></a></li>
							</ul>
						</div>
						<hr class="my-0" />
						<div class="card-body">
							<h5 class="h6 card-title">Contact</h5>
							<ul class="list-unstyled mb-0">
								<li class="mb-1"><span data-feather="at-sign" class="feather-sm me-1"></span> <a href="mailto:<?= $user_info['email'] ?>"><?= $user_info['email'] ?></a></li>
								<li class="mb-1"><span data-feather="phone" class="feather-sm me-1"></span> <a href="tel:<?= $user_info['mobile'] ?>"><?= $user_info['mobile'] ?></a></li>	
							</ul>
						</div>
						<hr class="my-0" />
						
					</div>
				</div>

				<div class="col-md-8 col-xl-8">
					<div class="card">
						<div class="card-body h-100">
							<h5 class="card-title mb-0">More About <?= $user_info['first_name'] ?></h5>
							<hr class="my-4">
							
						</div>
					</div>
				</div>
			</div>

		</div>
	</main>
	<?= $this->include('layouts/footer'); ?>
<?= $this->endSection(); ?>