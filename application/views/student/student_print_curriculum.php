<?php $year = null; ?>
<?php $semester = null; ?>
<?php $year_text = array(
		'1' => 'First Year', 
		'2' => 'Second Year', 
		'3' => 'Third Year', 
		'4' => 'Fourth Year', 
		'5' => 'Fifth Year'); 
?>
<?php $semester_text = array(
	'1' => 'First Semester',
	'2' => 'Second Semester',
	'3' => 'Summer'); 
?>

<style type="text/css">
	body {
		font-size: 9.5px;
	}
</style>

<div class="container container-fluid">
	<table class="table table-bordered table-condensed" border="1">
		<tbody>
			<?php foreach($subjects as $subject): ?>

				<?php if(is_null($year) || is_null($semester)): ?>
					<?php $year 	= $subject['subject_year']; ?>
					<?php $semester = $subject['semester_offered']; ?>
					<tr class="info">
						<th colspan="7"><?=$year_text[$year]?> - <?=$semester_text[$semester]?></th>
					</tr>
					<tr>
						<th>Course Code</th>
						<th>Descriptive Title</th>
						<th>Credit Units</th>
						<th>Pre-Requisites</th>
						<th>Remarks</th>
						<th>Currently Enrolled</th>
					</tr>
				<?php endif; ?>


				<?php if($year == $subject['subject_year'] && $semester == $subject['semester_offered']): ?>
					<?php $final_remark = null; ?>
					<?php if(unserialize($subject['subject_remarks'])): ?>
						<?php $remarks = unserialize($subject['subject_remarks']); ?>

						<?php foreach($remarks as $remark): ?>
							<?php if($remark['subject_remarks'] == 'Pass'): ?>
								<?php $final_remark = $remark['subject_remarks']; ?>
								<?php break; ?>
							<?php else: ?>
								<?php $final_remark = $remark['subject_remarks']; ?>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<tr>
						<td><?=$subject['course_code']?></td>
						<td><?=$subject['descriptive_title']?></td>
						<td><?=$subject['credit_units']?></td>
						<td>
							<?=implode(unserialize($subject['prerequisite']), ',')?>
							<?php if(!$subject['student_can_get']): ?>
								<span class="glyphicon glyphicon-remove"></span>
							<?php endif; ?>
						</td>
						<td><?=($final_remark ? $final_remark : '-----')?></td>

						<td><?=($subject['currently_enrolled'] ? 'Yes' : 'No')?></td>
					</tr>
				<?php else: ?>
					<?php $year 	= $subject['subject_year']; ?>
					<?php $semester = $subject['semester_offered']; ?>
					<tr class="info">
						<th colspan="7"><?=$year_text[$year]?> - <?=$semester_text[$semester]?></th>
					</tr>
					<tr>
						<th>Course Code</th>
						<th>Descriptive Title</th>
						<th>Credit Units</th>
						<th>Pre-Requisites</th>
						<th>Remarks</th>
						<th>Currently Enrolled</th>
					</tr>

					<tr>
						<?php $final_remark = null; ?>
						<?php if(unserialize($subject['subject_remarks'])): ?>
							<?php $remarks = unserialize($subject['subject_remarks']); ?>

							<?php foreach($remarks as $remark): ?>
								<?php if($remark['subject_remarks'] == 'Pass'): ?>
									<?php $final_remark = $remark['subject_remarks']; ?>
									<?php break; ?>
								<?php else: ?>
									<?php $final_remark = $remark['subject_remarks']; ?>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>

						<td><?=$subject['course_code']?></td>
						<td><?=$subject['descriptive_title']?></td>
						<td><?=$subject['credit_units']?></td>
						<td>
							<?=implode(unserialize($subject['prerequisite']), ',')?>
							<?php if(!$subject['student_can_get']): ?>
								<span class="glyphicon glyphicon-remove"></span>
							<?php endif; ?>
						</td>
						<td><?=($final_remark ? $final_remark : '-----')?></td>

						<td><?=($subject['currently_enrolled'] ? 'Yes' : 'No')?></td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
			<tr>
				<td colspan="10" style="text-align: right;"><b>Total Units Earned: <?=$total_units_earned?></b></td>
			</tr>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		//window.print();
	});
</script>