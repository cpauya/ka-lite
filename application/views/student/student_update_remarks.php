<!-- Begin: Container -->
<div class="container container-fluid">
	<div class="well">
		<form class="form-horizontal" action="<?=$action_url?>" method="POST">
			<fieldset>
				<legend>Updating remarks of <?=$student['student_id'] . ": " . $student['student_lastname'] . ", " . $student['student_firstname']?></legend>

				<?php echo validation_errors(VALIDATION_PREFIX, VALIDATION_SUFFIX); ?>

				<div class="form-group">
					<label for="course_code" class="col-sm-4 control-label">Course Code: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="course_code" value="<?=$subject['course_code']?>" readonly>
					</div>
				</div>

				<div class="form-group">
					<label for="previous_remarks" class="col-sm-4 control-label">Previous Remarks: </label>
					<div class="col-sm-5">
						<table class="table table-hover table-striped">
							<tr class="success">
								<td>Date Added</td>
								<td>Remarks</td>
							</tr>

							<?php if(!unserialize($subject_remarks)): ?>
								<tr>
									<td colspan="2">Unavailable</td>
								</tr>
								
							<?php else: ?>
								<?php foreach(unserialize($subject_remarks) as $remark): ?>
									<tr class="<?php if($remark['subject_remarks'] !== "Pass") echo 'danger'; ?>">
										<td><?=$remark['date_added']?></td>
										<td><?=$remark['subject_remarks']?></td>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
						</table>
					</div>
				</div>

				<div class="form-group">
					<label for="new_remarks" class="col-sm-4 control-label">New Remarks: </label>
					<div class="col-sm-5">
						<select class="form-control" id="new_remarks" name="remarks">
							<option value="Pass">Pass</option>
							<option value="Fail">Fail</option>
							<option value="INC">Incomplete</option>
							<option value="DRP">Dropped</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-5 col-sm-offset-4">
						<input type="submit" class="btn btn-primary" name="btn_submit" value="Save" onclick="return confirm('Are you sure? Remarks will be final.');">
						<a href="<?=$redirect_url?>" class="btn btn-default">Back</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<!-- End: Well -->
</div>
<!-- End: Container -->