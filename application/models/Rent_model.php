<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rent_model extends CI_Model
{
    public function GetCars()
    {
        $this->db->from('cars');
        $data = $this->db->get();
        return $data->result_array();
    }
}
