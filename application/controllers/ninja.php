<?php

class Ninja extends CI_Controller{

    public function index(){
        $this->load->library("session");
        $this->load->view("ninja");
    }
}