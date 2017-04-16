<div class="container container-fluid">
	<!-- Begin: Well -->
	<div class="well">
		<form class="form-horizontal" action="<?=$action_url?>" method="POST">
			<fieldset>
				<legend><?=$curriculum['curriculum_description']?> - <?=$curriculum['curriculum_year']?></legend>

				<div class="form-group">
					<label for="selectCourseCode" class="col-sm-4 control-label">Existing Course Code: </label>
					<div class="col-sm-5">
						<select id="selectCourseCode" class="selectpicker form-control" name="course_code" data-live-search="true" data-size="5">
							<option value="0">Not listed?</option>
							
							<?php foreach($all_subjects as $subject): ?>
								<option value="<?=$subject['course_code'] . '*' . $subject['descriptive_title'] . '*' . $subject['credit_units']?>"><?=$subject['course_code']?> - <?=$subject['descriptive_title']?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<?=form_error('course_code', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group">
					<label for="inputCourseCode" class="col-sm-4 control-label">Course Code: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputCourseCode" placeholder="Course Code" name="course_code" value="<?=set_value('course_code')?>"> 
					</div>
				</div>

				<?=form_error('descriptive_title', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group">
					<label for="inputDescriptiveTitle" class="col-sm-4 control-label">Descriptive Title: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputDescriptiveTitle" placeholder="Descriptive Title" name="descriptive_title" value="<?=set_value('descriptive_title')?>">
					</div>
				</div>

				<?=form_error('credit_units', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group">
					<label for="inputCreditUnits" class="col-sm-4 control-label">Credit Units: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputCreditUnits" placeholder="Credit Units" name="credit_units" value="<?=set_value('credit_units')?>">
					</div>
				</div>

				<?php $years = [1 => 'First Year', 2 => 'Second Year', 3 => 'Third Year', 4 => 'Fourth Year', 5 => 'Fifth Year']; ?>

				<?=form_error('subject_year', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group">
					<label for="inputSubjectYear" class="col-sm-4 control-label">Subject Year: </label>
					<div class="col-sm-5">
						<select class="form-control" name="subject_year" id="inputSubjectYear">
							<option value="">Select Subject Year</option>
							<?php foreach($years as $key => $value): ?>
								<?php if($key == set_value('subject_year')): ?>
									<option value="<?=$key?>" selected><?=$value?></option>
								<?php else: ?>
									<option value="<?=$key?>"><?=$value?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<?php $semesters = [1 => '1st Semester', 2 => '2nd Semester', 3 => 'Summer']; ?>

				<?=form_error('semester_offered', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group">
					<label for="inputSemesterOffered" class="col-sm-4 control-label">Semester Offered: </label>
					<div class="col-sm-5">
						<select class="form-control" name="semester_offered" id="inputSemesterOffered">
							<option value="">Select Semester Offered</option>
							<?php foreach($semesters as $key => $value): ?>
								<?php if($key == set_value('semester_offered')): ?>
									<option value="<?=$key?>" selected><?=$value?></option>
								<?php else: ?>
									<option value="<?=$key?>"><?=$value?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<?=form_error('prerequisite[]', VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<div class="form-group">
					<label for="inputPrerequisite" class="col-sm-4 control-label">Pre-requisite: </label>
					<div class="col-sm-5">

						<select class="selectpicker form-control" name="prerequisite[]" id="inputPrerequisite" data-live-search="true" data-size="5" multiple>

							<option value="None">None</option>
							<?php foreach(STANDINGS as $key => $value): ?>
								<option value="<?=$key?>"><?=$value?></option>
							<?php endforeach; ?>
							
							<?php foreach($curriculum_subjects as $subject): ?>
								<?php if($subject['course_code'] != ""): ?>
									<option value="<?=$subject['subject_id']?>"><?=$subject['course_code']?></option>
								<?php endif; ?>
							<?php endforeach; ?>
							
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-5 col-sm-offset-4">
						<input type="submit" name="btn_submit" class="btn btn-success" value="Save">
						<a href="<?=$back_url?>" class="btn btn-primary">Back</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<script>
	$('#selectCourseCode').change(function() {
		if($('#selectCourseCode').val() != "0") {
			$('#inputCourseCode').prop('readonly', true);
			$('#inputDescriptiveTitle').prop('readonly', true);
			$('#inputCreditUnits').prop('readonly', true);

			var values = $('#selectCourseCode').val().split('*');

			$('#inputCourseCode').val(values[0]);
			$('#inputDescriptiveTitle').val(values[1]);
			$('#inputCreditUnits').val(values[2]);
		} else {
			$('#inputCourseCode').prop('readonly', false);
			$('#inputDescriptiveTitle').prop('readonly', false);
			$('#inputCreditUnits').prop('readonly', false);
		}
	});
</script>