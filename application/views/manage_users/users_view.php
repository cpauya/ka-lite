<div class="container container-fluid">
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr class="success">
				<th>Username</th>
				<th>Description</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($users as $user): ?>
				<tr>
					<td><?=$user['username']?></td>
					<td><?=$user['user_role_description']?></td>
					<td><a href="<?=site_url('dashboard/update_user/') . $user['user_id']?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span>&nbsp;Update</a>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<a href="<?=site_url('dashboard/add_user')?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add User</a>
</div>