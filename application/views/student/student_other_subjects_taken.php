<div class="container container-fluid">
	<div class="well" style="background-color: #ffffff;">
		<h5>Other subjects taken: </h5>
		<ul class="list-inline">
			<?php foreach($subjects as $subject): ?>
				<li><?=$subject['course_code']?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
