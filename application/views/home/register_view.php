<div class="container container-fluid">
	<!-- Begin: Well -->
	<div class="row">
		<div class="col-sm-12">
			<div class="well">
				<form class="form-horizontal" action="<?=current_url()?>" method="POST">
					<fieldset>
						<legend>Register</legend>

						<?php if(isset($success_message)): ?>
							<div class='row'>
								<div class='col-sm-12'>
									<div class='alert alert-dismissible alert-success'>
										<button type='button' class='close' data-dismiss='alert'>&times;</button>
										<span class='glyphicon glyphicon-ok'></span>&nbsp;<?=$success_message?> Login <a href="<?=site_url('home/login')?>">here.</a>
									</div>
								</div>
							</div>
						<?php else: ?>

							<?=validation_errors(VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
							<?php if(isset($error_message)): ?>
								<?php foreach($error_message as $message): ?>
									<?=(VALIDATION_PREFIX . $message . VALIDATION_SUFFIX)?>
								<?php endforeach; ?>
							<?php endif; ?>

							<div class="form-group" id="student-id-form-group">
								<label for="inputStudentID" class="col-sm-4 control-label">Student ID: </label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="inputStudentID" placeholder="Student ID" name="student_id" value="<?=set_value('student_id')?>">
								</div>
							</div>


							<div class="form-group" id="password-id-form-group">
								<label for="inputPassword" class="col-sm-4 control-label">Password: </label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" value="<?=set_value('password')?>">
								</div>
							</div>

							<div class="form-group" id="cpassword-id-form-group">
								<label for="inputConfirmPassword" class="col-sm-4 control-label">Confirm Password: </label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password" name="confirm_password" value="<?=set_value('confirm_password')?>">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-5 col-sm-offset-4">
									<button type="submit" name="btn_submit" id="btn-submit" class="btn btn-success">Register</button>
									<a href="<?=$back_url?>" class="btn btn-primary">Back</a>
								</div>
							</div>
						<?php endif; ?>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>