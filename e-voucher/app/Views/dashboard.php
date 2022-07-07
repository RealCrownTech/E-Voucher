<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<?= $this->include('layouts/navigation'); ?>
	<?= $this->include('layouts/header'); ?>
	<main class="content">
		<div class="container-fluid p-0">

			<div class="row mb-2 mb-xl-3">
				<div class="col-auto d-none d-sm-block">
					<h3><?= $page_name ?></h3>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-sm-6 col-xxl-6 d-flex">
					<div class="card illustration flex-fill">
						<div class="card-body p-0 d-flex flex-fill">
							<div class="row g-0 w-100">
								<div class="col-6">
									<div class="illustration-text p-3 m-1">
										<h4 class="illustration-text">Welcome Back, <?= ucfirst(session()->get('name')); ?>!</h4>
										<p class="mb-0"><?= $company_data['site_title'] ?> Dashboard</p>
									</div>
								</div>
								<div class="col-6 align-self-end text-end">
									<img src="<?= base_url() ?>/public/assets/img/illustrations/customer-support.png" alt="Customer Support" class="img-fluid illustration-img">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-xxl-6 d-flex">
					<div class="card flex-fill">
						<div class="card-body py-4">
							<div class="d-flex align-items-start">
								<div class="flex-grow-1">
									<h3 class="mb-2"><?= $businesses ?></h3>
									<p class="mb-2">Businesses</p>
									<div class="mb-0">
										<span class="badge badge-soft-success me-2"> +5.35% </span>
										<span class="text-muted">Since last week</span>
									</div>
								</div>
								<div class="d-inline-block ms-3">
									<div class="stat">
										<i class="align-middle text-success" data-feather="dollar-sign"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-xxl-6 d-flex">
					<div class="card flex-fill">
						<div class="card-body py-4">
							<div class="d-flex align-items-start">
								<div class="flex-grow-1">
									<h3 class="mb-2"><?= $outlets ?></h3>
									<p class="mb-2">Outlets</p>
									<div class="mb-0">
										<span class="badge badge-soft-danger me-2"> -4.25% </span>
										<span class="text-muted">Since last week</span>
									</div>
								</div>
								<div class="d-inline-block ms-3">
									<div class="stat">
										<i class="align-middle text-danger" data-feather="shopping-bag"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--<div class="col-12 col-sm-6 col-xxl-6 d-flex">-->
				<!--	<div class="card flex-fill">-->
				<!--		<div class="card-body py-4">-->
				<!--			<div class="d-flex align-items-start">-->
				<!--				<div class="flex-grow-1">-->
				<!--					<h3 class="mb-2">₦18,700</h3>-->
				<!--					<p class="mb-2">Total Approved Vouchers Today</p>-->
				<!--					<div class="mb-0">-->
				<!--						<span class="badge badge-soft-success me-2"> +8.65% </span>-->
				<!--						<span class="text-muted">Since last week</span>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--				<div class="d-inline-block ms-3">-->
				<!--					<div class="stat">-->
				<!--						<i class="align-middle text-info" data-feather="dollar-sign"></i>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>				-->
			</div>

			<!-- <div class="card">
				<div class="card-body">
					<div id="fullcalendar"></div>
				</div>
			</div> -->			

		</div>
	</main>
	<?= $this->include('layouts/footer'); ?>
<?= $this->endSection(); ?>