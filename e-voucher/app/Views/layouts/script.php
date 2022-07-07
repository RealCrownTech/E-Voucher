<script src="<?= base_url() ?>/public/assets/js/app.js"></script>
<script src="<?= base_url() ?>/public/assets/js/dropify.min.js"></script>

<script>
    jquery_3_2_1(document).ready(function(){
        // Basic
        $('.dropify').dropify();               
    });
</script>

<script>
		document.addEventListener("DOMContentLoaded", function() {
			var today = new Date();
			var dd = String(today.getDate()).padStart(2, '0');
			var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
			var yyyy = today.getFullYear();
			today = yyyy + '-' + mm + '-' + dd;
			var calendarEl = document.getElementById('fullcalendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
				themeSystem: 'bootstrap',
				initialView: 'dayGridMonth',
				initialDate: today,
				headerToolbar: {
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay'
				},
				events: [
					 <?php if(!empty($filled_rooms)): ?>
						<?php foreach ($filled_rooms as $row): ?>
							{
								title: '<?php foreach ($rooms as $cl): ?>
											<?php if( $row["room_id"] == $cl["room_id"]): ?>
												Room <?= $cl["room_no"]; ?>
											<?php endif; ?>
										<?php endforeach ?> Occupied',
								start: '<?= date('Y-m-d', strtotime($row['check_in_date'] )) ?>',
								end: '<?= date('Y-m-d', strtotime($row['check_out_date'] )) ?> 12:00:00',
								url: '<?= base_url() ?>/invoice/<?= $row['lodge_no']; ?>',
							},
						<?php endforeach ?>
					<?php endif ?>
					// {
					// 	title: 'Long Event',
					// 	start: '2021-11-07',
					// 	end: '2021-07-10'
					// },
					// {
					// 	groupId: '999',
					// 	title: 'Repeating Event',
					// 	start: '2021-11-09T16:00:00'
					// },
					// {
					// 	groupId: '999',
					// 	title: 'Repeating Event',
					// 	start: '2021-11-16T16:00:00'
					// },
					// {
					// 	title: 'Conference',
					// 	start: '2021-11-11',
					// 	end: '2021-11-13'
					// },
					// {
					// 	title: 'Meeting',
					// 	start: '2021-11-12T10:30:00',
					// 	end: '2021-11-12T12:30:00'
					// },
					<?php if(!empty($reservations)): ?>
						<?php foreach ($reservations as $row): ?>
							{
								title: '<?php foreach ($rooms as $cl): ?>
											<?php if( $row["room_id"] == $cl["room_id"]): ?>
												<?= "Room ".$cl["room_no"]." reserved"; ?>
											<?php endif; ?>
										<?php endforeach ?>',
								start: '<?= date('Y-m-d', strtotime($row['check_in_date'] )) ?>T12:00:00',
								url: '<?= base_url() ?>/reservation_receipt/<?= $row['reservation_no']; ?>',
							},
						<?php endforeach ?>
					<?php endif ?>
					// {
					// 	title: 'Meeting',
					// 	start: '2021-11-12T14:30:00'
					// },
					// {
					// 	title: 'Birthday Party',
					// 	start: '2021-11-13T07:00:00'
					// },
					// {
					// 	title: 'Click for Google',
					// 	url: 'http://google.com/',
					// 	start: '2021-11-28'
					// }
				]
			});
			setTimeout(function() {
				calendar.render();
			}, 20)
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			$("#datatables-dashboard-projects").DataTable({
				responsive: true,
				pageLength: 25,
				lengthChange: true,
				bFilter: true,
				autoWidth: false
			});
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			$("#datatables-dashboard-rooms").DataTable({
				responsive: true,
				pageLength: 2,
				lengthChange: true,
				bFilter: true,
				autoWidth: false
			});
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			$("#datatables-swap").DataTable({
				responsive: true,
				pageLength: 6,
				lengthChange: true,
				bFilter: true,
				autoWidth: true,
				paging: false,
				bInfo: false
			});
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			$("#datatables-permission").DataTable({
				responsive: true,
				pageLength: 25,
				lengthChange: true,
				bFilter: true,
				autoWidth: true,
				paging: false,
				bInfo: false
			});
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			$("#datatables-dashboard-stock").DataTable({
				responsive: true,
				pageLength: 6,
				lengthChange: true,
				bFilter: true,
				autoWidth: false
			});
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Initialize Select2 select box
			$("select[name=\"validation-select2\"]").select2({
				allowClear: true,
				placeholder: "Select gear...",
			}).change(function() {
				$(this).valid();
			});
			// Initialize Select2 multiselect box
			$("select[name=\"validation-select2-multi\"]").select2({
				placeholder: "Select gear...",
			}).change(function() {
				$(this).valid();
			});			

			// Trigger validation on tagsinput change
			$("input[name=\"validation-bs-tagsinput\"]").on("itemAdded itemRemoved", function() {
				$(this).valid();
			});
			// Initialize validation
			$("#validation-form").validate({
				ignore: ".ignore, .select2-input",
				focusInvalid: false,
				rules: {
					"validation-email": {
						required: true,
						email: true
					},
					"validation-password": {
						required: true,
						minlength: 6,
						maxlength: 20
					},
					"validation-password-confirmation": {
						required: true,
						minlength: 6,
						equalTo: "input[name=\"validation-password\"]"
					},
					"validation-required": {
						required: true
					},
					"validation-url": {
						required: true,
						url: true
					},
					"validation-select": {
						required: true
					},
					"validation-multiselect": {
						required: true,
						minlength: 2
					},
					"validation-select2": {
						required: true
					},
					"validation-select2-multi": {
						required: true,
						minlength: 2
					},
					"validation-text": {
						required: true
					},
					"validation-file": {
						required: true
					},
					"validation-radios": {
						required: true
					},
					"validation-checkbox": {
						required: true
					},
					"validation-checkbox-group-1": {
						require_from_group: [1, "input[name=\"validation-checkbox-group-1\"], input[name=\"validation-checkbox-group-2\"]"]
					},
					"validation-checkbox-group-2": {
						require_from_group: [1, "input[name=\"validation-checkbox-group-1\"], input[name=\"validation-checkbox-group-2\"]"]
					},
					"validation-checkbox-group-1": {
						require_from_group: [1, "input[name=\"validation-checkbox-group-1\"], input[name=\"validation-checkbox-group-2\"]"]
					},
					"validation-checkbox-group-2": {
						require_from_group: [1, "input[name=\"validation-checkbox-group-1\"], input[name=\"validation-checkbox-group-2\"]"]
					}
				},
				// Errors
				errorPlacement: function errorPlacement(error, element) {
					var $parent = $(element).parents(".error-placeholder");
					// Do not duplicate errors
					if ($parent.find(".jquery-validation-error").length) {
						return;
					}
					$parent.append(
						error.addClass("jquery-validation-error small form-text invalid-feedback")
					);
				},
				highlight: function(element) {
					var $el = $(element);
					var $parent = $el.parents(".error-placeholder");
					$el.addClass("is-invalid");
					// Select2 and Tagsinput
					if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") === "tagsinput") {
						$el.parent().addClass("is-invalid");
					}
				},
				unhighlight: function(element) {
					$(element).parents(".error-placeholder").find(".is-invalid").removeClass("is-invalid");
				}
			});
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Select2
			$(".select2").each(function() {
				$(this)
					.wrap("<div class=\"position-relative\"></div>")
					.select2({
						placeholder: "Select value",
						dropdownParent: $(this).parent()
					});
			})
			// Daterangepicker
			$("input[name=\"daterange\"]").daterangepicker({
				opens: "left"
			});
			$("input[name=\"datetimes\"]").daterangepicker({
				timePicker: true,
				opens: "left",
				startDate: moment().startOf("hour"),
				endDate: moment().startOf("hour").add(32, "hour"),
				locale: {
					format: "M/DD hh:mm A"
				}
			});
			$("#date_from").daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				locale: {
					format: "M/D/Y"
				}
			});
			$("#date_to").daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				locale: {
					format: "M/D/Y"
				}
			});
			$("#reportrange").daterangepicker({
				startDate: start,
				endDate: end,
				ranges: {
					"Today": [moment(), moment()],
					"Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
					"Last 7 Days": [moment().subtract(6, "days"), moment()],
					"Last 30 Days": [moment().subtract(29, "days"), moment()],
					"This Month": [moment().startOf("month"), moment().endOf("month")],
					"Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
				}
			}, cb);
			cb(start, end);
			// Datetimepicker
			$('#datetimepicker-minimum').datetimepicker();
			$('#datetimepicker-view-mode').datetimepicker({
				viewMode: 'years'
			});
			$('#datetimepicker-time').datetimepicker({
				format: 'LT'
			});
			$('#datetimepicker-date').datetimepicker({
				format: 'L'
			});
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Fixed Header
			$("#datatables-fixed-header").DataTable({
				responsive: true,
				fixedHeader: true,
				pageLength: 10,
				bFilter: true,
			});

			$("#datatables-business").DataTable({
				responsive: true,
				fixedHeader: true,
				pageLength: 10,
				bFilter: true,
			});

			$("#datatables-outlet").DataTable({
				responsive: true,
				fixedHeader: true,
				pageLength: 6,
				bFilter: true,
			});

			$("#datatables-responsive").DataTable({
				responsive: true,
				pageLength: 10,
				lengthChange: true,
				bFilter: true,
				autoWidth: false
			});
		});
	</script>