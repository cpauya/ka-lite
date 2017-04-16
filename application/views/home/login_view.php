<!-- Begin: Container -->
<div class="container container-fluid">
	<!-- Begin: Well -->
	<div class="row">
		<!-- <div class="col-sm-8 col-sm-offset-2"> -->
		<div class="container">
			<div class="well">
				<form class="form-horizontal" action="<?=current_url()?>" method="POST">
					<fieldset>
						<legend>Enter login credentials: </legend>

						<?php if(isset($error_message)):?>
							<?=VALIDATION_PREFIX . $error_message . VALIDATION_SUFFIX?>
						<?php endif; ?>

						<?=validation_errors(VALIDATION_PREFIX, VALIDATION_SUFFIX)?>

						<div class="form-group <?php if(form_error('username') || isset($error_message)) echo 'has-error';?>">
							<label for="inputUsername" class="control-label col-sm-2 col-sm-offset-2">Username</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username" value="<?php if(isset($username)) echo $username;?>">
							</div>
						</div>

						<div class="form-group <?php if(form_error('password') || isset($error_message)) echo 'has-error';?>">
							<label for="inputPassword" class="col-sm-2 col-sm-offset-2 control-label">Password</label>
							<div class="col-sm-5">
								<input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-4">
								<button type="submit" class="btn btn-primary" name="btn_submit">Login</button>
								<a href="<?=base_url()?>" class="btn btn-default">Back</a>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<!-- End: Well -->
	</div>
	<!-- End: Row -->
</div>
<!-- End: Container -->