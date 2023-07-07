<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Settings_model extends CI_Model 
{
    
    public function set_theme($theme_name)
    {
        $data = array(
			'setting_value' => $theme_name
		);
        $this->db->where('setting_name', 'active_theme');
        $this->db->update('settings', $data);
		return;
    }
	
	public function update_setting($setting_name, $setting_value)
	{
		$data = array(
			'setting_value' => $setting_value
		);
		$this->db->where('setting_name', $setting_name);
		$this->db->update('settings', $data);
		return;
	}
	
	public function get_all_settings($group = NULL)
	{
		$data = array();
		$this->db->from('settings')
				->order_by('setting_group', 'ASC');
		if($group)
			$this->db->where($group);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
		}
		$query->free_result();  
		return $data;
	}		
	
	public function get_setting($setting)
	{
		$data = array();
		$this->db->from('settings');
		$this->db->where('setting_name', $setting);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$data = $query->row();
		}
		$query->free_result();  
		return $data->setting_value;
	}
	
}