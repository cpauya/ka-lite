<div class="container container-fluid">
	<?php if($message = $this->session->flashdata('message')): ?>
		<div class="row">
			<div class="col-xs-12">
				<div class='alert alert-dismissible alert-success'>
					<button type='button' class='close' data-dismiss='alert'>&times;</button>
					<span class='glyphicon glyphicon-exclamation-sign'></span>&nbsp;
					<?=$message?>
				</div>
			</div>
		</div>

	<?php endif; ?>

	<?php if(is_admin()): ?>
		<div class="row">
			<div class="col-xs-12">
				<form class="form-inline" method="POST" action="#" id="remarks-form">
					<div class="form-group">
						<label for="set-remarks">With selected:</label>
						<select class="selectpicker" id="set-remarks" name="set_remarks">
							<option value="" selected disabled>Set Remarks: </option>
							<option value="Pass">Pass</option>
							<option value="Fail">Fail</option>
							<option value="INC">Incomplete</option>
							<option value="DRP">Dropped</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary" id="btn_submit">Submit</button>
				</form>
			</div>
		</div>
	<?php endif; ?>
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr class="success">
				<th><input type="checkbox" id="check-all"></th>
				<th>Course Code</th>
				<th>Descriptive Title</th>
				<th>Credit Units</th>
				<th>Year</th>
				<th>Semester Offered</th>
				<th>Pre-Requisites</th>
			</tr>
		</thead>

		<tbody id="data-inputs">
			<?php if(!empty($subjects)): ?>
				<?php foreach($subjects as $subject): ?>
					<tr>
						<td><input type="checkbox" class="to-check" name="enrolled_subjects[]" data-course-code="<?=$subject['course_code']?>" value="<?=$subject['subject_id']?>" id="<?=$subject['subject_id']?>"></td>
						<td><?=$subject['course_code']?></td>
						<td><?=$subject['descriptive_title']?></td>
						<td><?=$subject['credit_units']?></td>
						<td><?=$subject['subject_year']?></td>
						<td><?=$subject['semester_offered']?></td>
						<td><?=implode(',' , unserialize($subject['prerequisite']))?></td>
					</tr>
				<?php endforeach; ?>
				<input type="hidden" name="student_id" value="<?=$subjects[0]['student_id']?>">
			<?php else: ?>
				<tr>
					<td colspan="8" style="text-align: center">There are no currently enrolled subjects.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<!-- Modal -->
<div class="modal fade" id="confirm-message" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Error</h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btn-confirm">Confirm</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div class="modal fade" id="other-message" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Error</h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<script>
	$(document).ready(function() {

		var subjects;

		$('#check-all').click(function () {
			if($('#check-all').is(':checked')) {
				$('.to-check').prop('checked', true);
			} else {
				$('.to-check').prop('checked', false);
			}
		});

		$('table tbody tr').click(function(e) {
			if(e.target.type == 'checkbox') {
				e.stopPropagation();
			} else {
				var $checkbox = $(this).find(':checkbox');
				if($checkbox.prop('checked'))
					$checkbox.prop('checked', false)
				else
					$checkbox.prop('checked', true);
			}
		});

		$('#btn_submit').click(function(e) {
			e.preventDefault();

			var remarks = $('#set-remarks').val();
			var number_of_checks = $('input[name="enrolled_subjects[]"]:checked').length;
			if(!remarks) {
				$('#other-message .modal-dialog .modal-content .modal-body').html("No remarks selected.");
				$('#other-message').modal('show');
			} else {
				if(number_of_checks > 0) {
					subjects = "<b>" + remarks + "</b> the following subjects";
					$('input[type=checkbox]').each(function () {
						var id = this.id;
						var course_code = $('#' + id).data('course-code');
						if(this.checked) {
							if(id.indexOf('check-all') == -1) {
								subjects = subjects + "<li>" + course_code + "</li>";
							}
						}
					});

					subjects = subjects + "</ul>";

					$('#confirm-message .modal-dialog .modal-content .modal-body').html(subjects);
					$('#confirm-message').modal('show');
				} else {
					$('#other-message .modal-dialog .modal-content .modal-body').html("No subjects selected.");
					$('#other-message').modal('show');
				}
			}
		});

		$('#btn-confirm').click(function (e) {
			var data = $('#data-inputs :checkbox, #data-inputs :input, #remarks-form').serialize();
			var url = "<?=site_url('student/set_remarks')?>";
			$.post(url, data, function() {
				location.reload();
			});
		});
	});
</script>