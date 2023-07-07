<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('alink'))
{
    function alink($n, $link)
    {
        $ci =& get_instance(); 
		$current = $ci->uri->segment($n);
		if($current == $link)
		{
			$active = TRUE;
		}
		else
		{
			$active = FALSE;
		}
        return $active;
    }
}

//Backup
if (!function_exists('count_backup'))
{
	function count_backup()
	{
		$ci =& get_instance();
		$ci->db->from('backups');
		return $ci->db->count_all_results();
	}
}

//Get Setting parameters
if (!function_exists('get_setting'))
{
	function get_setting($setting)
	{
		$ci =& get_instance();
		$data = array();
		$ci->db->from('settings');
		$ci->db->where('setting_name', $setting);
		$query = $ci->db->get();
		if ($query->num_rows() > 0)
		{
			$data = $query->row();
		}
		$query->free_result();  
		return $data->setting_value;
	}
}

// Ion Auth
if (!function_exists('get_user'))
{
	function get_user()
    {
		$ci =& get_instance(); 
		$ci->load->library('ion_auth');
		$user = $ci->ion_auth->user()->row();
		return $user;
	}
}

if (!function_exists('get_user_group')) // get first user group
{
	function get_user_group()
    {
		$ci =& get_instance(); 
		$ci->load->library('ion_auth');
		$user_groups = $ci->ion_auth->get_users_groups()->result();
		return $user_groups[0];
	}
}

if (!function_exists('get_job_position'))
{
	function get_job_position()
    {
		$ci =& get_instance(); 
		$ci->load->library('ion_auth');
		$ci->load->model('Hr_model');
		$user = $ci->ion_auth->user()->row();
		$hr = $ci->Hr_model->get_hr_by_auth_id($user->id);
		return $hr;
	}
}

//Get Setting parameters
// if (!function_exists('hook_to_log'))
// {
// 	function hook_to_log($project_id, $description, $user_id, $task_id = null)
// 	{
// 		$ci =& get_instance();
// 		$ci->load->model('Log_model');
// 		return $ci->Log_model->hook_to_log($project_id, $description, $user_id, $task_id = null);		
// 	}
// }

if (!function_exists('nice_number'))
{
	function nice_number($n) {
        // first strip any formatting;
        $n = (0+str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n > 1000000000000 || $n < -1000000000000) return round(($n/1000000000000), 2); // trillion
        elseif ($n > 1000000000 || $n < -1000000000) return round(($n/1000000000), 2); // billion
        elseif ($n > 1000000 || $n < -1000000) return round(($n/1000000), 2); // million
        elseif ($n > 1000 || $n < -1000) return round(($n/1000), 2); // thousand

        return number_format($n);
    }
}

if (!function_exists('number_format_short'))
{
	function number_format_short( $n, $precision = 1 ) 
	{
		if ($n < 900) {
			// 0 - 900
			$n_format = number_format($n, $precision);
			$suffix = '';
		} else if ($n < 900000) {
			// 0.9k-850k
			$n_format = number_format($n / 1000, $precision);
			$suffix = 'K';
		} else if ($n < 900000000) {
			// 0.9m-850m
			$n_format = number_format($n / 1000000, $precision);
			$suffix = 'M';
		} else if ($n < 900000000000) {
			// 0.9b-850b
			$n_format = number_format($n / 1000000000, $precision);
			$suffix = 'B';
		} else {
			// 0.9t+
			$n_format = number_format($n / 1000000000000, $precision);
			$suffix = 'T';
		}
		// Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
		// Intentionally does not affect partials, eg "1.50" -> "1.50"
		if ( $precision > 0 ) {
			$dotzero = '.' . str_repeat( '0', $precision );
			$n_format = str_replace( $dotzero, '', $n_format );
		}
		return $n_format . $suffix;
	}
}

if (!function_exists('roundfun'))
{
	function roundfun($n) 
	{ 
		// Smaller multiple 
		$a = (int)($n / 5) * 5; 
		
		// Larger multiple 
		$b = ($a + 5); 
	
		// Return of closest of two 
		return ($n - $a > $b - $n) ? $b : $a; 
	} 
}

if (!function_exists('project_task_warning'))
{
	function project_task_warning($project_id)
	{
		$ci =& get_instance();
		$ci->load->model('Tasks_tree_model');
		$exists = $ci->Tasks_tree_model->isPlanDateAndWeightSet($project_id);
		if($exists == FALSE)
		{
			return '<div class="alert alert-danger text-center mb-2" role="alert">Warning, it is recommended for you to complete plan date and weight in Project Task</div>';
		}
	}
}

if (!function_exists('is_project_task_completed'))
{
	function is_project_task_completed($project_id)
	{
		$ci =& get_instance();
		$ci->load->model('Tasks_tree_model');
		$exists = $ci->Tasks_tree_model->isPlanDateAndWeightSet($project_id);
		return $exists;
	}
}