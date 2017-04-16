<div class="container container-fluid">
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr class="success">
				<th>College</th>
				<th>Department Name</th>
				<th>Action</th>
			</tr>
		</thead>

		<?php if(!empty($departments)): ?>
			<?php foreach($departments as $department): ?>
				<tr>
					<?php foreach($colleges as $college): ?>
						<?php if($college['college_id'] == $department['college_id']): ?>
							<td><?=$college['college_abbrev']?></td>
						<?php endif; ?>
					<?php endforeach; ?>

					<td><?=$department['department_name']?></td>
					<td><a href="<?=$update_url . $department['department_id']?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span>&nbsp;Update</a>&nbsp;<a href="<?=site_url('course/add/?id=') . $department['department_id']?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Course</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>

	</table>
	<a href="<?=$add_url?>"  class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Deparment</a>
</div>