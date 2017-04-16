<!-- Begin: Container -->
<div class="container container-fluid">
	<!-- Begin: Well -->
	<div class="well">
		<form class="form-horizontal" action="<?=$action_url?>" method="POST">
			<fieldset>
				<legend>Enter student details: </legend>

				<?=form_error('student_id', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group <?php if(form_error('student_id')) echo 'has-error'; ?>">
					<label for="inputStudentID" class="col-sm-4 control-label">Student ID: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputStudentID" placeholder="Student ID" name="student_id" value="<?=$student['student_id']?>" readonly>
					</div>
				</div>

				<?=form_error('student_firstname', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group <?php if(form_error('student_firstname')) echo 'has-error'; ?>">
					<label for="inputFirstName" class="col-sm-4 control-label">First Name: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputFirstName" placeholder="First Name" name="student_firstname" value="<?=$student['student_firstname']?>">
					</div>
				</div>

				<?=form_error('student_middlename', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group <?php if(form_error('student_middlename')) echo 'has-error'; ?>">
					<label for="inputMiddleName" class="col-sm-4 control-label">Middle Name</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputMiddleName" placeholder="Middle Name" name="student_middlename" value="<?=$student['student_middlename']?>">
					</div>
				</div>

				<?=form_error('student_lastname', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group <?php if(form_error('student_lastname')) echo 'has-error'; ?>">
					<label for="inputLastName" class="col-sm-4 control-label">Last Name</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputLastName" placeholder="Last Name" name="student_lastname" value="<?=$student['student_lastname']?>">
					</div>
				</div>
				
				<?=form_error('course_id', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group">
					<label for="inputCourse" class="col-sm-4 control-label">Course: </label>
					<div class="col-sm-5">
						<select id="inputCourse" class="form-control" name="course_id">
							<option value="">Select Course</option>
							<?php foreach($courses as $course): ?>
								<?php if($student['course_id'] == $course['course_id']): ?>
									<option value="<?=$course['course_id']?>" selected><?=$course['course_abbrev']?></option>
								<?php else: ?>
									<option value="<?=$course['course_id']?>"><?=$course['course_abbrev']?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				
				<?=form_error('course_curriculum_id', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group">
					<label for="inputCourseCurriculum" class="col-sm-4 control-label">Curriculum: </label>
					<div class="col-sm-5" id="curriculum">
						<select class="form-control" name="course_id">
							<option value="">Select Course Curriculum</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-5 col-sm-offset-4">
						<input type="submit" class="btn btn-primary" name="btn_submit" value="Save">
						<a href="<?=$back_url?>" class="btn btn-default">Back</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<!-- End: Well -->
</div>
<!-- End: Container -->

<script>
	$(document).ready(function () {
		var c_id = $('#inputCourse').val();
		var url = "<?=site_url('curriculum/get_curriculum')?>";
		$.post(url, {course_id: c_id}, function (d) {
			$('#curriculum').html(d.select);
		});

		$('#inputCourse').change(function () {
			c_id = $(this).val();
			$.post(url, {course_id: c_id}, function (d) {
				$('#curriculum').html(d.select);
			});
		});
	});
</script>