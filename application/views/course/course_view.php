<div class="container container-fluid">
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr class="success">
				<th>Department</th>
				<th>Course</th>
				<th>Course Abbreviation</th>
				<th>Action</th>
			</tr>
		</thead>

		<?php if(!empty($courses)): ?>
			<?php foreach($courses as $course): ?>
				<tr>
					<?php $update_url = site_url("course/update/{$course['course_id']}"); ?>
					<?php foreach($departments as $department): ?>
						<?php if($department['department_id'] == $course['department_id']): ?>
							<td><?=$department['department_name']?></td>
						<?php endif; ?>
					<?php endforeach; ?>
					<td><?=$course['course_name']?></td>
					<td><?=$course['course_abbrev']?></td>
					<td><a href="<?=$update_url?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span>&nbsp;Update</a>&nbsp;<a href="<?=site_url('curriculum/add/?id=') . $course['course_id']?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Curriculum</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>

	</table>
	<a href="<?=site_url('course/add')?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Course</a>
</div>