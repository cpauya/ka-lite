<div class="container container-fluid">
	<!-- Begin: Well -->
	<div class="well">
		<form class="form-horizontal" action="<?=$action_url?>" method="POST">
			<fieldset>
				<legend>New Curriculum</legend>

				<?=validation_errors(VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				<?php if(isset($error_message)): ?>
					<?php foreach($error_message as $message): ?>
						<?=(VALIDATION_PREFIX . $message . VALIDATION_SUFFIX)?>
					<?php endforeach; ?>
				<?php endif; ?>
				
				<div class="form-group">
					<label for="inputCollegeCourse" class="col-sm-4 control-label">Course: </label>
					<div class="col-sm-5">

						<select name="course_id" class="form-control selectpicker" data-live-search="true">
							<option value="">Select Course</option>
							<?php foreach($courses as $course): ?>
								<?php if($this->input->get('id', true) == $course['course_id']): ?>
									<option value="<?=$course['course_id']?>" selected><?=$course['course_abbrev']?></option>
							<?php else: ?>
								<option value="<?=$course['course_id']?>"><?=$course['course_abbrev']?></option>
							<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="inputCurriculumDescription" class="col-sm-4 control-label">Curriculum Description: </label>
					<div class="col-sm-5">
						<textarea name="curriculum_description" class="form-control" placeholder="Curriculum Description"><?=set_value('curriculum_description')?></textarea>
					</div>
				</div>

				<div class="form-group">
					<label for="inputCurriculumYear" class="col-sm-4 control-label">Curriculum Year: </label>

					<div class="col-sm-5">
						<input type="text" id="inputCurriculumYear" class="form-control" name="curriculum_year" value="<?=set_value('curriculum_year')?>" placeholder="Year">
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