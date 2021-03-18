<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_pelanggan 
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        //load data mofdel user
        $this->CI->load->model('pelanggan_model');
    }

    //Fungsi login
    public function login($email, $password)
    {
        $check = $this->CI->pelanggan_model->login($email, $password, $status_pelanggan="Aktif");
        //jika ada data maka buat session
        if ($check) {
            $id_pelanggan        = $check->id_pelanggan;
            $nama_pelanggan      = $check->nama_pelanggan;
            //buat session
            $this->CI->session->set_userdata('id_pelanggan',$id_pelanggan);
            $this->CI->session->set_userdata('nama_pelanggan',$nama_pelanggan);
            $this->CI->session->set_userdata('email',$email);
            //redirect ke halaman admin yang diproteksi
            redirect(base_url('dasbor'),'refresh');
        
        }else{
            //jika salah
            $this->CI->session->set_flashdata('warning', 'Username atau Password salah');
            redirect(base_url('masuk'), 'refresh');
 
        }
    }

    //Fungsi cek login
    public function cek_login()
    {


        //memeriksa session ada atau belum
        if ($this->CI->session->userdata('email')=="") {
            $this->CI->session->set_flashdata('warning', 'Anda belum Login');
            redirect(base_url('masuk'), 'refresh');
 
        }
    }

    //Fungsi logout
    public function logout()
    {


        //buang semua session
 
        $this->CI->session->unset_userdata('id_pelanggan');
        $this->CI->session->unset_userdata('nama_pelanggan');
        $this->CI->session->unset_userdata('email');
        //redirect ke login  
        $this->CI->session->set_flashdata('sukses', 'Anda berhasil logout');
            redirect(base_url('masuk'), 'refresh');       
 
    }
    
}
