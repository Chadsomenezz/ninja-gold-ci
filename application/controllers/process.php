<?php

class Process extends CI_Controller{

    public function index(){

        $this->load->library("session");
        $this->load->view("process");
    }
}