<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rent extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rent_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['rent'] = $this->rent_model->GetCars();
        $this->slice->view('home', $data);
    }
}