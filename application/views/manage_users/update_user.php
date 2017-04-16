<div class="container container-fluid">
	<!-- Begin: Well -->
	<div class="row">
		<div class="col-sm-12">
			<div class="well">

				<form class="form-horizontal" action="<?=current_url()?>" method="POST">
					<fieldset>
						<legend>Update User</legend>

						<?php if(!isset($error_message)): ?>
							<?php if($success_message = $this->session->flashdata('success_message')): ?>
								<div class='row'>
									<div class='col-sm-5 col-sm-offset-4'>
										<div class='alert alert-dismissible alert-success'>
											<button type='button' class='close' data-dismiss='alert'>&times;</button>
											<span class='glyphicon glyphicon-ok'></span>&nbsp;<?=$success_message?>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<?php endif; ?>

						<?=validation_errors(VALIDATION_PREFIX, VALIDATION_SUFFIX)?>

						<?php if(isset($error_message)): ?>
							<?php foreach($error_message as $message): ?>
								<?=(VALIDATION_PREFIX . $message . VALIDATION_SUFFIX)?>
							<?php endforeach; ?>
						<?php endif; ?>

						<?php if(!$update_self): ?>
							<div class="form-group">
								<label for="inputUserType" class="col-sm-4 control-label">User Type: </label>
								<div class="col-sm-5">
									<select name="user_type" id="inputUserType" class="form-control">
										<?php foreach(USER_LEVELS as $key => $role_user_level): ?>
											<?php if(get_user_info()['user_level'] >= $role_user_level): ?>
												<?php if($key == $user_meta->user_role): ?>
													<option value="<?=$key?>" selected><?=USER_ROLES[$key]?></option>
												<?php else: ?>
													<option value="<?=$key?>"><?=USER_ROLES[$key]?></option>
												<?php endif; ?>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						<?php endif; ?>

						<div class="form-group" id="student-id-form-group">
							<label for="inputUsername" class="col-sm-4 control-label">Username: </label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username" value="<?=$user->username?>" disabled>
							</div>
						</div>

						<div class="form-group" id="student-id-form-group">
							<label for="inputFirstName" class="col-sm-4 control-label">First Name: </label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="inputFirstName" placeholder="First Name" name="first_name" value="<?=$user_meta->first_name?>" <?=is_student() ? 'disabled' : ''?>>
							</div>
						</div>

						<div class="form-group" id="student-id-form-group">
							<label for="inputLastName" class="col-sm-4 control-label">Last Name: </label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="inputLastName" placeholder="Last Name" name="last_name" value="<?=$user_meta->last_name?>" <?=is_student() ? 'disabled' : ''?>>
							</div>
						</div>


						<div class="form-group">
							<label for="inputPassword" class="col-sm-4 control-label">New Password: </label>
							<div class="col-sm-5">
								<input type="password" class="form-control" id="inputPassword" placeholder="New Password (Leave empty if you plan not changing it)" name="new_password">
							</div>
						</div>

						<!-- Current Password -->
						<?php if($update_self): ?>
							<div class="form-group">
								<label for="inputCurrentPassword" class="col-sm-4 control-label">Current Password: </label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="inputCurrentPassword" placeholder="Current Password" name="current_password" disabled="true">
								</div>
							</div>
						<?php endif; ?>

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

<script>
	$(document).ready(function() {
		$('#inputPassword').on('keyup', function() {

			if($('#inputPassword').val().length > 0)
				$('#inputCurrentPassword').prop('disabled', false);
			else
				$('#inputCurrentPassword').prop('disabled', true);
		});
	});
</script>