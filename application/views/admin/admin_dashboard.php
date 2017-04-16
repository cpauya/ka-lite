<!-- Begin: Container -->
<div class="container">
	<!-- Begin: Well -->
	<div class="well">
		<div class="row">
			<ul>
				<?php if(!empty($colleges)): ?>
					<?php foreach($colleges as $college): ?>
						<li>
							<?=$college['college_name']?>
							<ul>
								<?php foreach($departments as $department): ?>
									<?php if($department['college_id'] == $college['college_id']): ?>
										<li>
											<?=$department['department_name']?>
											<ul>
												<?php foreach($courses as $course): ?>
													<?php if($course['department_id'] == $department['department_id']): ?>
														<?php foreach($curriculums as $curriculum): ?>
															<?php if($curriculum['course_id'] == $course['course_id']): ?>
																<li><a href="<?=site_url('curriculum/view/subjects/') . $curriculum['course_curriculum_id']?>"><?=$course['course_abbrev']?> Curriculum (<?=$curriculum['curriculum_year']?>)</a></li>
															<?php endif; ?>
														<?php endforeach; ?>

													<?php endif; ?>
												<?php endforeach; ?>
											</ul>	
										</li>
									<?php endif; ?>
								<?php endforeach;?>
							</ul>
						</li>
					<?php endforeach; ?>
				<?php else: ?>
					<a href="<?=site_url('college/add/')?>">Add College</a>
				<?php endif; ?>
			</ul>
		</div>
		<!-- End: Row -->
	</div>
	<!--End: Well -->
</div>
<!-- End: Container -->