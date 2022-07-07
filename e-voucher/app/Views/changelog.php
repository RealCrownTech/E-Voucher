<?= $this->extend('layouts/base'); ?>

<?= $this->section('page_content'); ?>
	<?= $this->include('layouts/navigation'); ?>
	<?= $this->include('layouts/header'); ?>
	<main class="content">
		<div class="container-fluid p-0">

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title"><?= $page_name ?></h5>
							<hr class="my-4">

							<div id="changelog" class="mb-5">

								<h4 class="d-inline-block"><span class="badge bg-primary">v1.1</span></h4>
								<h5 class="d-inline-block">– 6 March, 2022</h5>
								<ul>
									<li>Updated: New User Interface</li>
									<li>Added: Update profile picture</li>
									<li>Added: Submit vouchers with expense category </li>
									<li>Added: Submit vouchers with attachment (optional)</li>
									<li>Added: Finance - Report batch download</li>
									<li>Updated: Finance - generate report by date range and other filter options for all locations</li>
									<li>Updated: Account &amp; Sales Lead - generate voucher report by date range and other filter options for their location only</li>
								</ul>

								<h4 class="d-inline-block"><span class="badge bg-primary">v1.0 (Beta)</span></h4>
								<h5 class="d-inline-block">– 8 January, 2022</h5>
								<ul>
									<li>Initial release</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</main>
	<?= $this->include('layouts/footer'); ?>
<?= $this->endSection(); ?>