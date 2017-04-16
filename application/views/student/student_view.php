<div class="container container-fluid" style="margin-top: -2.5%;">
	<div class="row">
		<form method="POST" action="<?=site_url('student/search')?>">
			<div class="form-group has-feedback">
				<div class="col-sm-3 pull-right">
					<input type="search" name="search" placeholder="Search..." class="form-control input-sm">
				</div>
			</div>
		</form>
	</div>
</div>

<div class="container container-fluid">
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr class="success">
				<th>Student ID</th>
				<th>Student Name</th>
				<th>Course</th>
				<th>Action</th>
			</tr>
		</thead>

		<?php if(!empty($students)): ?>
			<?php foreach($students as $student): ?>
				<tr>
					<td><?=$student['student_id']?></td>
					<td><?=$student['student_lastname'] . ", " . $student['student_firstname'] . " " . $student['student_middlename']?></td>
					<?php foreach($courses as $course): ?>
						<?php if($course['course_id'] == $student['course_id']): ?>
							<td><?=$course['course_abbrev']?></td>
						<?php endif; ?>
					<?php endforeach; ?>

					<td><a href="<?=$update_url . $student['student_id']?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span>&nbsp;Update</a>&nbsp;<a href="<?=site_url('student/view/curriculum/') . $student['student_id']?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;View Curriculum</a></td>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="4" style="text-align: center;">No results found!</td>
			</tr>
		<?php endif; ?>
	</table>

	<div class="row pull-right">
		<?=$this->pagination->create_links()?>
	</div>
	<a href="<?=$add_url?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Student</a>
</div>

