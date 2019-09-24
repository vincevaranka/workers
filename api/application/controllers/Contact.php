<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Contact extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('M_contact','contact');
    }

    public function index_get() { //get single or all data contact
        $id = (int)$this->get('id');
        if ($id <= 0) {
            $contact = $this->contact->get();
        } else {
            $contact = $this->contact->get($id);
        }
        if($contact){
            $this->response([
                'status' => true,
                'data' => $contact
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => "NOT FOUND"
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete() { //delete data by id (method delete x-www-form-urlencoded) 
        $id = (int)$this->delete('id');
        if ($id === null){
            $this->response([
                'status' => false,
                'message' => "Provide an ID !"
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $this->contact->_delete($id);
            $this->response([
                'status' => true,
                'message' => "Delete ".$id." Success"
            ], REST_Controller::HTTP_NO_CONTENT);
            
        }
    }

    public function index_post(){ //insert data (method post)
        $data = [
            'name' => strip_tags($this->input->post('name')),
            'number' => strip_tags($this->input->post('number'))
        ];
        if($this->contact->_insert($data)>0){
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

    public function index_put(){ //update date (method put)
        $id = (int)$this->put('id');
        $data = [
            'name' => strip_tags($this->put('name')),
            'number' => strip_tags($this->put('number'))
        ];
        if($this->contact->_update($data,$id)>0){
            $this->response([
                'status' => true,
                'data' => $this->input->post('name'),
                'message' => "Has been updated"
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => "Failed to update data!"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function other_post(){ //http://localhost/learn/ci_restapi/contact/other
        $var = $this->post("var");
        $this->response([
            'status' => true,
            'data' => $var,
            'message' => "Berhasil test"
        ], REST_Controller::HTTP_CREATED);
    }



}
