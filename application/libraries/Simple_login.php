<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_login 
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        //load data mofdel user
        $this->CI->load->model('user_model');
    }

    //Fungsi login
    public function login($username, $password)
    {
        $check = $this->CI->user_model->login($username, $password);
        //jika ada data maka buat session
        if ($check) {
            $id_user        = $check->id_user;
            $nama           = $check->nama;
            $akses_level    = $check->akses_level;
            //buat session

            $this->CI->session->set_userdata('id_user',$id_user);
            $this->CI->session->set_userdata('nama',$nama);
            $this->CI->session->set_userdata('username',$username);
            $this->CI->session->set_userdata('akses_level',$akses_level);
            //redirect ke halaman admin yang diproteksi
            redirect(base_url('admin/dasbor'),'refresh');
        
        }else{
            //jika salah
            $this->CI->session->set_flashdata('warning', 'Username atau Password salah');
            redirect(base_url('login'), 'refresh');
 
        }
    }

    //Fungsi cek login
    public function cek_login()
    {


        //memeriksa session ada atau belum
        if ($this->CI->session->userdata('username')=="") {
            $this->CI->session->set_flashdata('warning', 'Anda belum Login');
            redirect(base_url('login'), 'refresh');
 
        }
    }

    //Fungsi logout
    public function logout()
    {


        //buang semua session
 
        $this->CI->session->unset_userdata('id_user');
        $this->CI->session->unset_userdata('nama');
        $this->CI->session->unset_userdata('username');
        $this->CI->session->unset_userdata('akses_level');

        //redirect ke login  
        $this->CI->session->set_flashdata('sukses', 'Anda berhasil logout');
            redirect(base_url('login'), 'refresh');       
 
    }
    
}
