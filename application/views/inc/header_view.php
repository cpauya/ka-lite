<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?=isset($title) ? $title : 'NDU Curriculum Monitoring'?></title>
	<link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet" media="all">
	<link href="<?=base_url()?>assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/css/custom.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/css/bootstrap-select.min.css" rel="stylesheet">

	<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/js/bootstrap-select.min.js"></script>

</head>

<div class="container hidden-print">
	<nav class="navbar navbar-inverse">	
		<div class="container-fluid">
			<div class="navbar-header">
				<?php if(is_logged_in()): ?>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php endif; ?>
				<a class="navbar-brand" href="<?=base_url()?>">NDU Curriculum Monitoring</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
				<?php if(is_admin()): ?>
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Quick Links <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?=site_url('college')?>">Colleges</a></li>
								<li><a href="<?=site_url('department')?>">Department</a></li>
								<li><a href="<?=site_url('course')?>">Course</a></li>
								<li><a href="<?=site_url('curriculum')?>">Curriculum</a></li>
								<li><a href="<?=site_url('student')?>">Students</a></li>
								<li><a href="<?=site_url('subject')?>">Subjects</a></li>
							</ul>
						</li>
					</ul>
				<?php elseif(is_student()): ?>
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Quick Links <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?=site_url('student/view/mycurriculum')?>">My Curriculum</a></li>
							</ul>
						</li>
					</ul>
				<?php endif; ?>

				<?php if(is_logged_in()): ?>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<?php if(is_super_admin() || is_dean()): ?>
									<li><a href="<?=site_url('dashboard/manage_users')?>">Manage Users</a></li>
								<?php endif; ?>
								<li class="divider"></li>
								<li><a href="<?=site_url('settings')?>">Settings</a></li>
								<li class="divider"></li>
								<li><a href="<?=site_url('dashboard/logout')?>">Logout</a></li>
							</ul>
						</li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li class="nav-item"><span class="navbar-text">Hi, <?=get_user_info()['first_name']?>!</span></li>
					</ul>

				<?php endif; ?>
			</div>
		</div>
	</nav>
</div>
<!-- Begin: Body -->
<body>
