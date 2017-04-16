<div class="container container-fluid">
	<!-- Begin: Well -->
	<div class="well">
		<form class="form-horizontal" action="<?=$action_url?>" method="POST">
			<fieldset>
				<legend>Add</legend>

				<?=validation_errors(VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				
				<div class="form-group">
					<label for="inputCollege" class="col-sm-4 control-label">Department: </label>
					<div class="col-sm-5">
						<select name="department_id" class="form-control" id="inputCollege">
							<option value="">Select Department</option>
							<?php foreach($departments as $department): ?>
								<?php if($this->input->get('id', true) == $department['department_id']): ?>
								<option value="<?=$department['department_id']?>" selected><?=$department['department_name']?></option>
							<?php else: ?>
								<option value="<?=$department['department_id']?>"><?=$department['department_name']?></option>
							<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				
				<div class="form-group">
					<label for="inputCourseName" class="col-sm-4 control-label">Course: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputCourseName" placeholder="Course Name" name="course_name" value="<?=set_value('course_name')?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputCourseAbbrev" class="col-sm-4 control-label">Course Abbreviation: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputCourseAbbrev" placeholder="Course Abbreviation" name="course_abbrev" value="<?=set_value('course_abbrev')?>">
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