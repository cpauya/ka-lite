<?php

$student_name = $subjects[0]['student_lastname'] . ', ' . $subjects[0]['student_firstname'] . ' ' . $subjects[0]['student_middlename'];

$course = $subjects[0]['course_name'];
$curriculum = $subjects[0]['curriculum_description'] . " - " . $subjects[0]['curriculum_year'];
$my_subjects = array();


foreach($subjects as $subject)
{

	$subject_data = [
	'code'			=> $subject['course_code'],
	'credit_units'	=> $subject['credit_units'],
	'can_get' 		=> $subject['student_can_get'],
	'prereqs'		=> implode(',', unserialize($subject['prerequisite']))
	];

	if(!isset($my_subjects[$subject['subject_year']][$subject['semester_offered']]['total_units']))
		$my_subjects[$subject['subject_year']][$subject['semester_offered']]['total_units'] = 0;

	if(!$subject['student_passed'])
	{
		$my_subjects[$subject['subject_year']][$subject['semester_offered']][] = $subject_data;
		$my_subjects[$subject['subject_year']][$subject['semester_offered']]['total_units'] += (int) $subject['credit_units'];
	}
}
$status = [
1	=> 'First Year<br>S.Y. ________', 
2	=> 'Second Year<br>S.Y. ________', 
3	=> 'Third Year<br>S.Y. ________', 
4	=> 'Fourth Year<br>S.Y. ________', 
5	=> 'Fifth Year<br>S.Y. ________'
];


?>




<div class="container container-fluid">
	<div class="pull-right hidden-print">
		<button class="btn btn-success btn-xs" id="btn-print"><span class="glyphicon glyphicon-print"></span>&nbsp;Print</button>
	</div>
	<table class="table table-bordered table-condensed">
		<tr>
			<th>Name: </th>
			<th colspan="3"><?=$student_name?></th>
		</tr>
		<tr>
			<th>Course: </th>
			<th colspan="3"><?=$course?></th>
		</tr>
		<tr>
			<th>Curriculum: </th>
			<th colspan="3"><?=$curriculum?></th>
		</tr>

		<tr>
			<td><b>Year</b></td>
			<td><b>1st Semester</b></td>
			<td><b>2nd Semester</b></td>
			<td><b>Summer</b></td>

			<?php foreach($my_subjects as $key => $value): ?>
				<tr>
					<td><?=$status[$key]?></td>

					<?php $tds = 0; ?>
					<?php foreach($value as $key => $course_codes): ?>
						<td>
							<table class="table table-condensed table-borderless">
								<?php foreach($course_codes as $course_code): ?>
									<tr>
										<td>
											<?php if($course_code['code'] != ''): ?>
												<?php if($course_code['can_get']): ?>
													<?=$course_code['code']?>
												<?php else: ?>
													<?=$course_code['code']?>&nbsp;<span class="glyphicon glyphicon-remove" style="color: red; font-size: 9px;"></span>
													<!-- <?=$course_code['code']?>&nbsp;<sup style="font-size: 7px;">{<?=$course_code['prereqs']?>}</sup> -->
												<?php endif; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if($course_code['code'] != ''): ?>
												<?php if($course_code['credit_units'] >= 0): ?>
													(<?=$course_code['credit_units']?>)	
												<?php endif; ?>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>

								<?php if($course_codes['total_units'] > 0): ?>
									<tr style="border-top: 1px solid black">
										<td><b>Total Units: </b></td>
										<td class="text-left">&nbsp;<u><?=$course_codes['total_units']?></u></td>
									</tr>
								<?php endif; ?>
							</table>
						</td>
						<?php $tds++; ?>
					<?php endforeach; ?>

					<!-- fill in missing tds in the table e.g. if there is no summer subjects -->
					<?php for($x = $tds; $x < 3; $x++): ?>
						<td></td>
					<?php endfor; ?>
				</tr>
			<?php endforeach; ?>
		</tr>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function () {

		$('#btn-print').click(function () {
			window.print();
		});
	});
</script>