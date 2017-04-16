<?php $year = null; ?>
<?php $semester = null; ?>

<div class="container container-fluid">
	<table class="table table-striped table-hover table-bordered">
		<?php foreach($subjects as $subject): ?>

			<?php if(is_null($subject['course_code'])): ?>
				<?=display_curriculum_table_header(1, 1)?>
				<tr>
					<td colspan='7'><center>Unavailable</center></td>
				</tr>
			<?php else: ?>

				<?php if(is_null($year) || is_null($semester)): ?>
					<?php $year 	= $subject['subject_year']; ?>
					<?php $semester = $subject['semester_offered']; ?>
					<?=display_curriculum_table_header($year, $semester)?>
				<?php endif; ?>

				<?php if($year == $subject['subject_year'] && $semester == $subject['semester_offered']): ?>
					<?=display_curriculum_subjects_data($subject, $year, $semester, $update_url)?>
				<?php else: ?>
					<?php $year 	= $subject['subject_year']; ?>
					<?php $semester = $subject['semester_offered']; ?>
					<?=display_curriculum_table_header($year, $semester, $user_type)?>
					<?=display_curriculum_subjects_data($subject, $year, $semester, $update_url)?>
				<?php endif; ?>

			<?php endif; ?>
		<?php endforeach; ?>
	</table>
	<a href="<?=$add_subject_url . $subject['course_curriculum_id']?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Subject</a>
</div>