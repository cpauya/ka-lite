<div class="container container-fluid">
	<!-- Begin: Well -->
	<div class="well">
		<form class="form-horizontal" action="<?=$action_url?>" method="POST">
			<fieldset>
				<legend>Update</legend>

				<div class="form-group">
					<label for="inputCollegeName" class="col-sm-4 control-label">College Name: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputCollegeName" placeholder="College Name" name="college_name" value="<?=$college['college_name']?>"> 
					</div>
				</div>


				<div class="form-group">
					<label for="inputCollegeAbbrev" class="col-sm-4 control-label">College Abbreviation: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="inputCollegeAbbrev" placeholder="Abbreviation" name="college_abbrev" value="<?=$college['college_abbrev']?>">
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