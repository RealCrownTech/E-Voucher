<?php $page_session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?= $company_data['company_name'] ?>">
	<meta name="author" content="<?= $company_data['site_title'] ?>">

	<title><?= $page_title ?> | <?= $company_data['site_title'] ?></title>

	<link rel="shortcut icon" href="<?= base_url() ?>/public/assets/img/photos/<?= $company_data['favicon'] ?>">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	<!-- Choose your prefered color scheme -->
	<link href="<?= base_url() ?>/public/assets/css/light.css" rel="stylesheet">
	<link href="<?= base_url() ?>/public/assets/css/dropify.min.css" rel="stylesheet">

	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
		var jquery_3_2_1 = $.noConflict(true);
	</script>

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
		<?php endif;
		
		if ($page_name == 'Print Expense Voucher'): ?>
			<script>
				window.onload = function() { window.print(); }
			</script>
		<?php endif;
	?>

	<script>
		jquery_3_2_1(document).ready(function() {
	      $('#new_guest').hide();
	      $('#existing_guest').hide();
	      $('#choose_room').prop('disabled', true);
	      $('#guest_name').prop('readonly', true);
	      $('#post_to_room').prop('disabled', true);
		  $('input[type="radio"]').change(function() {
		    if ($('input[value="new_guest"]').is(':checked')) {
		      $('#new_guest').show();
		      $('#existing_guest').hide();
		    }
		    if($('input[value="existing_guest"]').is(':checked')) {
		      $('#new_guest').hide();
		      $('#existing_guest').show();
		    }
		    if ($('input[value="walk_in_guest"]').is(':checked')) {
		      $('#choose_room').prop('disabled', true);
		      $('#choose_room').val('');
		      $('#post_to_room').prop('disabled', true);
		      $('#post_to_room').prop('');
	      	  $('#guest_name').prop('readonly', true);
	      	  $('#guest_name').val('Walk-In');
		    }
		    if($('input[value="checked_in_guest"]').is(':checked')) {
		      $('#choose_room').prop('disabled', false);
		      $('#post_to_room').prop('disabled', false);
	      	  $('#guest_name').prop('readonly', true);
	      	  $('#guest_name').val('');
		    }
		  });
		});
	</script>

</head>
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="wrapper">
		
		<?= $this->renderSection('page_content'); ?>
		
	</div>

	<?= $this->include('layouts/script'); ?>
</body>
</html>