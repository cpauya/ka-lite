<div class="container container-fluid">
	<!-- Begin: Well -->
	<div class="row">
		<div class="col-sm-12">
			<div class="well">
				<form class="form-horizontal" action="<?=current_url()?>" method="POST">
					<fieldset>
						<legend>Add User</legend>

						<?php if(isset($success_message)): ?>
							<div class='row'>
								<div class='col-sm-12'>
									<div class='alert alert-dismissible alert-success'>
										<button type='button' class='close' data-dismiss='alert'>&times;</button>
										<span class='glyphicon glyphicon-ok'></span>&nbsp;<?=$success_message?>
									</div>
								</div>
							</div>
						<?php endif; ?>

						<?=validation_errors(VALIDATION_PREFIX, VALIDATION_SUFFIX)?>
						<?php if(isset($error_message)): ?>
							<?php foreach($error_message as $message): ?>
								<?=(VALIDATION_PREFIX . $message . VALIDATION_SUFFIX)?>
							<?php endforeach; ?>
						<?php endif; ?>

						<div class="form-group">
							<label for="inputUserType" class="col-sm-4 control-label">User Type: </label>
							<div class="col-sm-5">
								<select name="user_type" id="inputUserType" class="form-control">
									<?php foreach(USER_LEVELS as $key => $value): ?>
										<?php if($user_level > $value): ?>
											<option value="<?=$key?>"><?=USER_ROLES[$key]?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group" id="student-id-form-group">
							<label for="inputUsername" class="col-sm-4 control-label">Username: </label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username" value="<?=set_value('username')?>">
							</div>
						</div>

						<div class="form-group" id="student-id-form-group">
							<label for="inputFirstName" class="col-sm-4 control-label">First Name: </label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="inputFirstName" placeholder="First Name" name="first_name" value="<?=set_value('first_name')?>">
							</div>
						</div>

						<div class="form-group" id="student-id-form-group">
							<label for="inputLastName" class="col-sm-4 control-label">Last Name: </label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="inputLastName" placeholder="Last Name" name="last_name" value="<?=set_value('last_name')?>">
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
								<button type="submit" name="btn_submit" id="btn-submit" class="btn btn-success">Save</button>
								<a href="<?=$back_url?>" class="btn btn-primary">Back</a>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>