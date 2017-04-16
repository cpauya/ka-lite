<div class="container container-fluid">
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr class="success">
				<th>Course</th>
				<th>Curriculum Description</th>
				<th>Year</th>
				<th>Action</th>
			</tr>
		</thead>

		<?php if(!empty($curriculums)): ?>
			<?php foreach($curriculums as $curriculum): ?>
				<tr>
					<?php foreach($courses as $course): ?>
						<?php if($course['course_id'] == $curriculum['course_id']): ?>
							<td><?=$course['course_abbrev']?></td>
						<?php endif; ?>
					<?php endforeach; ?>

					<td><?=$curriculum['curriculum_description']?></td>
					<td><?=$curriculum['curriculum_year']?></td>
					<td><a href="<?=$update_url . $curriculum['course_curriculum_id']?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span>&nbsp;Update</a>&nbsp;<a href="<?=$manage_subjects_url . $curriculum['course_curriculum_id']?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Manage Subjects</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>

	</table>
	<a href="<?=$add_url?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>&nbsp;New Curriculum</a>
</div>
