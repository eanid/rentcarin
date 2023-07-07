<?php defined('BASEPATH') or exit('not allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'CI 3 Boiler Plate';
        $this->slice->view('default.dashboard', $data);
    }


}