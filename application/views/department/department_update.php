<div class="container container-fluid">
	<!-- Begin: Well -->
	<div class="well">
		<form class="form-horizontal" action="<?=$action_url?>" method="POST">
			<fieldset>
				<legend>Update</legend>

				<?=validation_errors(VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
				
				<div class="form-group">
					<label for="inputCollege" class="col-sm-4 control-label">College: </label>
					<div class="col-sm-5">
						<select name="college_id" class="form-control" id="inputCollege">
							<option value="">Select College</option>
							<?php foreach($colleges as $college): ?>
								<?php if($department['college_id'] == $college['college_id']): ?>
									<option value="<?=$college['college_id']?>" selected><?=$college['college_abbrev']?></option>
								<?php else: ?>
									<option value="<?=$college['college_id']?>"><?=$college['college_abbrev']?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				
				<div class="form-group">
					<label for="inputDepartmentName" class="col-sm-4 control-label">Department Name: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputDepartmentName" placeholder="Department Name" name="department_name" value="<?=$department['department_name']?>">
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