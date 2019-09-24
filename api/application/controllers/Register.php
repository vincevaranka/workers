<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Register extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('M_users','users');
    }
    public function index_post(){ //insert data (method post)
        $data = [
            'username' => strip_tags($this->input->post('username')),
            'fullname' => strip_tags($this->input->post('fullname')),
            'email' => strip_tags($this->input->post('email')),
            'password' => $this->input->post('password')
        ];
        if($this->users->_insert($data)>0){
            $this->response([
                'status' => true,
                'data' => $this->input->post('name'),
                'message' => "Has been created"
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => "Failed to create new data!"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
