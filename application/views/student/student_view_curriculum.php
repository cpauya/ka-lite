<?php $year = null; ?>
<?php $semester = null; ?>
<?php $colspan = (is_admin()) ? 10 : 9; ?>

<div class="container container-fluid">
	<?php if($message = $this->session->flashdata('message')): ?>
		<div class='alert alert-dismissible alert-success'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			<span class='glyphicon glyphicon-exclamation-sign'></span>&nbsp;
			<?=$message?>
		</div>
	<?php endif; ?>

	<div class="row">
		<div class="col-xs-6 text-left">
			<?php if(is_admin()): ?>
				With Selected: <button id="btn-enroll" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-education"></span>&nbsp;Enroll</button>
			<?php else: ?>
				<u><b>My Standing: </b><?=$student_year?></u>
			<?php endif; ?>
		</div>

		<div class="col-xs-6 text-right">
			<div class="btn-group">
				<a href="<?=site_url('student/view/enrolled/') . $student['student_id']?>" class="btn btn-primary pull-right btn-xs"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;View Currently Enrolled Subjects</a>

			</div>

			<div class="btn-group">
				<a href="<?=site_url('student/print_pos/') . $student['student_id']?>" class="btn btn-success btn-xs pull-right"><span class="glyphicon glyphicon-print"></span>&nbsp;Print Program of Study</a>

			</div>
		</div>
	</div>
	<table class="table table-hover table-striped table-bordered">
		<tbody id="data-inputs">
			<?php foreach($subjects as $subject): ?>
				<?php if(is_null($year) || is_null($semester)): ?>
					<?php $year 	= 1; ?>
					<?php $semester = 1; ?>
					<?=display_table_header($year, $semester, $user_type)?>
				<?php endif; ?>

				<?php if(!is_null($subject['prerequisite'])): ?>
					<?php if($year == $subject['subject_year'] && $semester == $subject['semester_offered']): ?>
						<?=display_subjects_data($subject, $year, $semester, $user_type, $update_url)?>
					<?php else: ?>
						<?php $year 	= $subject['subject_year']; ?>
						<?php $semester = $subject['semester_offered']; ?>
						<?=display_table_header($year, $semester, $user_type)?>
						<?=display_subjects_data($subject, $year, $semester, $user_type, $update_url)?>
					<?php endif; ?>
				<?php else: ?>
					<tr>
						<td colspan="<?=$colspan?>" style="text-align: center"><b>Curriculum has no subjects yet.</b></td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
			<tr>
				<td colspan="<?=$colspan?>" style="text-align: right;"><b>Total Units Earned: <?=$total_units_earned?> out of <?=$total_units?>&nbsp;(<?=$percentage?>%)</b></td>
				<input type="hidden" name="student_id" id="student-id" value="<?=$subjects[0]['student_id']?>">
			</tr>
		</tbody>
	</table>

	<!-- Modal View Remarks -->
	<div class="modal fade" id="view-remarks" role="dialog">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">View Remarks</h4>
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

	<!-- Modal -->
	<div class="modal fade" id="enroll-student" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Enroll Student</h4>
				</div>
				<div class="modal-body">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
</div>

<script>
	$(document).ready(function() {

		var subjects;
		$('.check-all').on('change', function() {
			var selected_class = this.id.split('-');
			var year = selected_class[2];
			var semester = selected_class[3];

			if($('#' + this.id).is(':checked')) {
				$('.to-check-' + year + '-' + semester).prop('checked', true);
			} else {
				$('.to-check-' + year + '-' + semester).prop('checked', false);
			}
		});

		$('#btn-enroll').click(function () {
			subjects = '<p>Enroll student to the following subjects: </p><ul>';
			var checked = 0;
			$('input[type=checkbox]').each(function () {
				var id = this.id;

				var course_code = $('#' + id).data('course-code');

				if(this.checked) {
					//if it does not have a to-check in its id name, then it's a course-code
					if(id.indexOf('to-check') == -1) {
						console.log(this.id);
						subjects = subjects + "<li>" + course_code + "</li>";
					}
					checked++;
				}
			});

			subjects += "</ul>";

			if(checked > 0) {
				$('#enroll-student .modal-dialog .modal-content .modal-body').html(subjects);
				$('#enroll-student').modal('show');
			} else {
				$('#other-message .modal-dialog .modal-content .modal-body').html("No subjects selected.");
				$('#other-message').modal('show');
			}
			
		});

		$('#btn-confirm').click(function () {
			var data = $('#data-inputs :checkbox, #data-inputs :input').serialize();
			var url = '<?=site_url('student/student_enroll')?>'

			$.post(url, data, function (d) {
				if(d.success)
					location.reload(true);
				$('#success-modal').modal('show');
			}, 'json');
		});

		$('.remarks').click(function (e) {
			var course_code = $('#' + this.id).data('course-code');
			var id = this.id.split('-');
			var stud_id = id[0];
			var subj_id = id[1];
			var url = "<?=site_url('student/view_remarks')?>";

			$.post(url, {student_id: stud_id, subject_id: subj_id}, function (d) {
				$('#view-remarks .modal-dialog .modal-content .modal-header .modal-title').html("View Remarks - " + course_code);
				$('#view-remarks .modal-dialog .modal-content .modal-body').html(d.data);
				$('#view-remarks').modal('show');
			});
		});
	});
</script>