<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');

class User_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }

	public function getGroupData($count = null)
	{
		$data = [];

		$page = $this->input->get('page')-1;
		$per_page = $this->input->get('per_page');
		$sort_init = $this->input->get('sort');
		$sort = str_replace('|',' ',$sort_init);
		$filter = $this->input->get('filter');

		$offset = $per_page * $page;

		$this->db->select('*')
				->from('groups')
				->order_by($sort);

		$this->db->group_start()
				->like('description', $filter)
				->or_like('name', $filter)
				->group_end();

		if($count)
		{
			return $this->db->count_all_results(); 			
		}
		else
		{
			$this->db->limit($per_page, $offset);
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

	}

    public function get_user_data($count = null, $groups = null)
    {
        $data = [];

		$page = $this->input->get('page')-1;
		$per_page = $this->input->get('per_page');
		$sort_init = $this->input->get('sort');
		$sort = str_replace('|',' ',$sort_init);
		$filter = $this->input->get('filter');		
		
		$offset = $per_page * $page;
		
		$this->db->select('users_groups.id as users_groups_id, users.id as user_id, username, email, first_name, last_name, created_on, last_login, company, active, name') // we have to specity the 'goddamn' columns --anggit
        		->from('users')
				->join('users_groups','users.id = users_groups.user_id')
				->join('groups','groups.id = users_groups.group_id')
				->group_by('users.id')
				->order_by($sort);	
		if($groups)
			$this->db->where_in('name', $groups);
		
		$this->db->group_start()
				->like('first_name', $filter)
				->or_like('last_name', $filter)
				->or_like('username', $filter)				
				->or_like('email', $filter)				
				->group_end();	
		
		if($count)
		{
			return $this->db->count_all_results(); 			
		}
		else
		{
			$this->db->limit($per_page, $offset);
			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{				
				foreach ($query->result() as $row)
				{
					$active_badge = $row->active == 1 ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-secondary">Inactive</span>';

					$last_login = date('Y-m-d', $row->last_login) == '1970-01-01' ? '<div class="small">Never logged in</div>' : '<div class="small">'.date('j M Y H:i', $row->last_login).'</div><div class="text-muted small lh-base">'.timespan($row->last_login, '', 1).' ago</div>';

					$groups = $this->ion_auth->get_users_groups($row->user_id)->result();					
					
					$data[] = [
						'id' => $row->user_id,
						'username' => $row->username,						
						'email' => '<div class="fs-12px">'.$row->email.'</div>',
						'first_name' => $row->first_name,
						'last_name' => $row->last_name,												
						'created_on' => date('j M Y', $row->created_on),
						'last_login' => $last_login,
						'company' => $row->company,
						'active' => $active_badge,
						'groups' => $groups
					];
				}
			}
			$query->free_result();    
			return $data; 
		}
    }

}