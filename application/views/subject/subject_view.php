<div class="container container-fluid">
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr class="success">
				<th>Course Code</th>
				<th>Descriptive Title</th>
				<th>Credit Units</th>
				<th>Semesters Offered</th>
			</tr>
		</thead>

		<?php if(!empty($subjects)): ?>
			<?php foreach($subjects as $subject): ?>
				<tr>
					<td><?=$subject['course_code']?></td>
					<td><?=$subject['descriptive_title']?></td>
					<td><?=$subject['credit_units']?></td>
					<td><?=$subject['semester_offered']?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>

	</table>
</div>