<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('print_data'))
{
	function print_data($data) 
	{ 
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}

if (!function_exists('print_debug'))
{
	function print_debug($data) 
	{ 
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
	}
}

if(!function_exists('display_table_header'))
{
	function display_table_header($year, $semester, $user_type = ADMIN)
	{
		$year_text = array (
			'1' => 'First Year', 
			'2' => 'Second Year', 
			'3' => 'Third Year', 
			'4' => 'Fourth Year', 
			'5' => 'Fifth Year'
		);

		$semester_text = array (
			'1' => 'First Semester',
			'2' => 'Second Semester',
			'3' => 'Summer'
		); 

		$header = "<tr class='info'>";
		$header .= "<th>";

		if(is_admin())
		{
			$header .= "<input type='checkbox' class='check-all' id='to-check-{$year}-{$semester}'>";
		}

		$header .= "</th>";

		$header .= "<th colspan='7'>";
		$header .= $year_text[$year] . ' - ' . $semester_text[$semester];
		$header .= "</th>";
		$header .= "</tr>";

		$header .= "<tr>";

		$header .= "<th></th>";
		$header .= "<th>Course Code</th>";
		$header .= "<th>Descriptive Title</th>";
		$header .= "<th>Credit Units</th>";
		$header .= "<th>Pre-Requisites</th>";
		$header .= "<th>Remarks</th>";
		$header .= "<th>Currently Enrolled</th>";
		$header .= "<th>Action</th>";

		$header .= "</tr>";

		return $header;
	}
}

if(!function_exists('display_subjects_data'))
{
	function display_subjects_data($subject = array(), $year, $semester, $user_type, $update_url)
	{
		$final_remark = null;

		if($remarks = unserialize($subject['subject_remarks']))
		{
			foreach($remarks as $remark)
			{
				$final_remark = $remark['subject_remarks'];
			}
		}

		$subject_id = $subject['subject_id'];
		$student_id = $subject['student_id'];

		$data = $subject['student_can_get'] ? "<tr>" : "<tr class='danger'>";
		
		$data .= "<td>";
		if($subject['student_can_get'] && !($subject['currently_enrolled']) && is_admin() && ($final_remark != "Pass"))
		{
			
			$data .= "<input type='checkbox' class='to-check-{$year}-{$semester}' name='enroll_subjects[]' value='{$subject_id}' data-course-code='{$subject['course_code']}' id='{$subject_id}'";
			
		}
		$data .= "</td>";
		$data .= "<td>{$subject['course_code']}</td>";
		$data .= "<td>{$subject['descriptive_title']}</td>";
		$data .= "<td>{$subject['credit_units']}</td>";
		$data .= "<td>";
		$data .= implode(unserialize($subject['prerequisite']), ',');
		$data .= "</td>";
		$data .= "<td>";
		$data .= ($final_remark) ? $final_remark : '-----';
		$data .= "</td>";
		$data .= "<td>";
		$data .= ($subject['currently_enrolled'] ? 'Yes' : 'No');
		$data .= "</td>";
		$data .= "<td>";

		$data .= "<button type='button' class='btn btn-success btn-xs remarks' data-toggle='modal' id='{$student_id}-{$subject_id}' data-course-code='{$subject['course_code']}'><span class='glyphicon glyphicon-eye-open'></span>&nbsp;Remarks</button>";

		$data .= "</td>";
		$data .= "</tr>";

		return $data;
	}
}

if(!function_exists('display_curriculum_table_header'))
{
	function display_curriculum_table_header($year, $semester)
	{
		$year_text = array (
			'1' => 'First Year', 
			'2' => 'Second Year', 
			'3' => 'Third Year', 
			'4' => 'Fourth Year', 
			'5' => 'Fifth Year'
		);

		$semester_text = array (
			'1' => 'First Semester',
			'2' => 'Second Semester',
			'3' => 'Summer'
		); 

		$header = "<tr class='info'>";
		$header .= "<th colspan='7'>";
		$header .= $year_text[$year] . ' - ' . $semester_text[$semester];
		$header .= "</th>";
		$header .= "</tr>";

		$header .= "<tr>";
		$header .= "<th>Course Code</th>";
		$header .= "<th>Descriptive Title</th>";
		$header .= "<th>Credit Units</th>";
		$header .= "<th>Pre-Requisites</th>";
		$header .= "<th>Action</th>";

		$header .= "</tr>";

		return $header;
	}
}

if(!function_exists('display_curriculum_subjects_data'))
{
	function display_curriculum_subjects_data($subject = array(), $year, $semester, $update_url)
	{
		$subject_id = $subject['subject_id'];

		$data = "<tr>";

		$data .= "<td>{$subject['course_code']}</td>";
		$data .= "<td>{$subject['descriptive_title']}</td>";
		$data .= "<td>{$subject['credit_units']}</td>";
		$data .= "<td>";
		$data .= implode(unserialize($subject['prerequisite']), ',');
		$data .= "</td>";
		$data .= "<td>";


		$update_url = $update_url . $subject['course_curriculum_id'] . '/' . $subject['subject_id'];

		$data .= "<a href='{$update_url}' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-edit'></span>&nbsp;Update</a>";


		$data .= "</td>";
		$data .= "</tr>";

		return $data;
	}
}