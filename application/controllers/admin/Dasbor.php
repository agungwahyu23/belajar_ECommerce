<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller{

    //load model
    public function __construct()
    {
        parent::__construct();
        //proteksi
        $this->simple_login->cek_login();
    }
    
    
    //Halaman login
    public function index()
    {
        $data = array('title'   => 'Login Administrator',
                      'isi'     => 'admin/dasbor/list'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        
    }
}

?>