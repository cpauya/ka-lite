<div class="container container-fluid">
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr class="success">
				<th>College Name</th>
				<th>College Abbreviation</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($colleges)): ?>
				<?php foreach($colleges as $college): ?>
					<tr>
						<td><?=$college['college_name']?></td>
						<td><?=$college['college_abbrev']?></td>
						<td><a href="<?=$update_url . $college['college_id']?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span>&nbsp;Update</a>&nbsp;<a href="<?=site_url('department/add/?id=') . $college['college_id']?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Department</a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<a href="<?=$add_url?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add College</a>
</div>