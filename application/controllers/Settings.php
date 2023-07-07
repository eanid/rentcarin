<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','cart'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->load->model('Settings_model');
		$this->lang->load('auth');
		
		if(!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		
	}
	
	public function index()
	{		        
		$all_group = array('admin');
		if(!$this->ion_auth->in_group($all_group))
		{
			redirect('auth/login', 'refresh');
		}
		else
		{
			$data['title'] = 'Settings';
			$data['posts'] = $this->Settings_model->get_all_settings();
            $data['cache_type'] = array (
						''	=> 'Caching Type',
						'memcached'  => 'Memcached',
						'file'   => 'File',
                        //'redis' => 'Redis',
                        //'wincache' => 'Wincache'
					);
			$data['ramadhan_season'] = array(
						'' => 'Ramadhan Season',
						'1' => 'Yes',
						'0' => 'No',
				);
			$this->slice->view('default.settings', $data);			
		}
	}
	
	public function update()
	{		       
		$all_group = array('admin');
		if(!$this->ion_auth->in_group($all_group))
		{
			redirect('auth/login', 'refresh');
		}
		else
		{
			$post_indices = $this->Settings_model->get_all_settings();
			foreach($post_indices as $row)
			{
				$setting_value = $this->input->post($row->setting_name);
				$this->Settings_model->update_setting($row->setting_name, $setting_value);
			}
			$this->session->set_flashdata('recmsg','Setting Updated');
			redirect('settings');
		}
	}
	
}