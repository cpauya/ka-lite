<!-- Begin: Container -->
<div class="container container-fluid">
	<div class="well">

		<form class="form-horizontal" action="<?=$action_url?>" method="POST">
			<fieldset>
				<legend><?=$subject['curriculum_description']?></legend>

				<?=validation_errors(VALIDATION_PREFIX, VALIDATION_SUFFIX)?>

				<div class="form-group">
					<label for="inputCourseCode" class="col-sm-4 control-label">Course Code: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputCourseCode" placeholder="Course Code" name="course_code" value="<?=$subject['course_code']?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputDescriptiveTitle" class="col-sm-4 control-label">Descriptive Title: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputDescriptiveTitle" placeholder="Descriptive Title" name="descriptive_title" value="<?=$subject['descriptive_title']?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputCreditUnits" class="col-sm-4 control-label">Credit Units: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputCreditUnits" placeholder="Credit Units" name="credit_units" value="<?=$subject['credit_units']?>">
					</div>
				</div>

				<?php $years = [1 => 'First Year', 2 => 'Second Year', 3 => 'Third Year', 4 => 'Fourth Year', 5 => 'Fifth Year']; ?>
				<div class="form-group">
					<label for="inputSubjectYear" class="col-sm-4 control-label">Subject Year: </label>
					<div class="col-sm-5">
						<select class="form-control" name="subject_year" id="inputSubjectYear">
							<option value="">Select Subject Year</option>
							<?php foreach($years as $key => $value): ?>
								<?php if($key == $subject['subject_year']): ?>
									<option value="<?=$key?>" selected><?=$value?></option>
								<?php else: ?>
									<option value="<?=$key?>"><?=$value?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<?php $semesters = [1 => '1st Semester', 2 => '2nd Semester', 3 => 'Summer']; ?>

				<div class="form-group">
					<label for="inputSemesterOffered" class="col-sm-4 control-label">Semester Offered: </label>
					<div class="col-sm-5">
						<select class="form-control" name="semester_offered" id="inputSemesterOffered">
							<option value="">Select Semester Offered</option>
							<?php foreach($semesters as $key => $value): ?>
								<?php if($key == $subject['semester_offered']): ?>
									<option value="<?=$key?>" selected><?=$value?></option>
								<?php else: ?>
									<option value="<?=$key?>"><?=$value?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="inputPrerequisite" class="col-sm-4 control-label">Pre-requisite: </label>
					<div class="col-sm-5">
						<select multiple class="selectpicker form-control" name="prerequisite[]" id="inputPrerequisite" data-live-search="true" data-size="5">
							<?php $other_prereqs = [
							'None' 					=> 'None',
							'first_year_standing' 	=> '1st Year Standing',
							'second_year_standing' 	=> '2nd Year Standing',
							'third_year_standing' 	=> '3rd Year Standing',
							'fourth_year_standing' 	=> '4th Year Standing',
							'fifth_year_standing'	=> '5th Year Standing'
							]; 
							$prereq = unserialize($subject['prerequisite']);
							$prereq = count($prereq == 1) ? $prereq[0] : '';
							?>

							<?php foreach($other_prereqs as $key => $value): ?>
								<?php if($prereq == $value || $prereq == $key): ?>
									<option value="<?=$key?>" selected><?=$value?></option>
								<?php else: ?>
									<option value="<?=$key?>"><?=$value?></option>
								<?php endif; ?>
							<?php endforeach; ?>

							<?php foreach($curriculum_subjects as $curriculum_subject): ?>
								
								<?php if(in_array($curriculum_subject['course_code'], unserialize($subject['prerequisite']))): ?>
									<option value="<?=$curriculum_subject['subject_id']?>" selected><?=$curriculum_subject['course_code']?></option>
								<?php else: ?>
									<option value="<?=$curriculum_subject['subject_id']?>"><?=$curriculum_subject['course_code']?></option>
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
