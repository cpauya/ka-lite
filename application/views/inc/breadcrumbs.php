<div class="container">
	<?php if(!empty($crumbs)): ?>
		<ul class="breadcrumb">
			<?php foreach($crumbs as $crumb): ?>
				<?php if($crumb['is_active']): ?>
					<li class="active"><?=$crumb['name']?></a></li>
				<?php else: ?>
					<li><a href="<?=$crumb['url']?>"><?=$crumb['name']?></a></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>
