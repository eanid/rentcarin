<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Backups extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Backup_model');
		$this->load->helper('download');
		
		$group = array('admin');
		if(!$this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
		}
	}
	
	public function index()
	{
		$data['title'] = 'Backup Database';
		$data['backups'] = $this->Backup_model->get_latest_backup(5,0);
		$this->slice->view('default.backup', $data);	
	}
	
	public function backup()
	{
		$this->load->dbutil();
		$date = date('Y-m-d');
		$time = date('H.i.s');
		$backup = $this->dbutil->backup();
		$this->load->helper('file');
		$this->load->helper('string');
		
		$hash = random_string('md5');
		$file_name = $date.'-'.$time.'.gz';
		write_file('../backup/'.$file_name, $backup);
		$this->Backup_model->insert_backup($file_name);
		
		$data['response'] = array(
			'message' => 'Success',
			'file_name' => $file_name,
		);
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	public function download($backup_id)
	{
		$backup = $this->Backup_model->get_backup_by_id($backup_id);
		force_download('../backup/'.$backup->backup_file_name, NULL);
	}
	
	public function delete($backup_id)
	{
		$backup = $this->Backup_model->get_backup_by_id($backup_id);
		$file_path = '../backup/'.$backup->backup_file_name;
		unlink($file_path);
		$this->Backup_model->delete_backup($backup_id);
		$this->session->set_flashdata('recmsg', 'Backup successfully deleted');
		redirect('backups');
	}
	
}