<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Backup_model extends CI_Model 
{	
	public function insert_backup($file_name)
	{
		$user = $this->ion_auth->user()->row();
		$date = date('Y-m-d');
		$time = date('H:i:s');
		$data = array(
			'backup_file_name' => $file_name,
			'backup_notes' => $this->input->post('backup_notes'),
			'backup_date' => $date,
			'backup_time' => $time,
			'user_id' => $user->id
		);
		$this->db->insert('backups', $data);
		return;
	}
	
	public function get_latest_backup($limit, $offset)
	{
		$data = array();
		$this->db->from('backups');
		$this->db->order_by('backup_date', 'desc');
		$this->db->order_by('backup_time', 'desc');
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
	
	public function get_backup_by_id($backup_id)
	{
		$data = array();
		$this->db->from('backups');
		$this->db->where('backup_id', $backup_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$data = $query->row();
		}
		$query->free_result();  
		return $data;
	}
	
	public function delete_backup($backup_id)
	{
		$this->db->where('backup_id', $backup_id);
		$this->db->delete('backups');
		return;
	}

}