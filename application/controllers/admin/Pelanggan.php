<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller{
    
    //Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
        //proteksi
        $this->simple_login->cek_login();
    }

    //Data pelanggan
    public function index()
    {
        $pelanggan = $this->pelanggan_model->listing();
        $data = array('title'   => 'Data Pelanggan',
                      'pelanggan'    => $pelanggan,
                      'isi'     => 'admin/pelanggan/list'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function detail($id_pelanggan)
    {
        $pelanggan = $this->pelanggan_model->detail($id_pelanggan);
        $data = array('title'   => 'Data Pelanggan',
                      'pelanggan'    => $pelanggan,
                      'isi'     => 'admin/pelanggan/detail'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    //aktif
    public function aktif($id_pelanggan)
    {
        $pelanggan = $this->pelanggan_model->detail($id_pelanggan);
        
        if ($pelanggan->status_pelanggan=="Aktif") 
        {
            $i = $this->input;

            $data = array(  'id_pelanggan'       => $id_pelanggan,
                            'id_user'            => $this->session->userdata('id_user'),
                            'status_pelanggan'   => 'Pending'
                        );
            $this->pelanggan_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data Reseller telah di Non Aktifkan');
            redirect(base_url('admin/pelanggan'),'refresh');
        }
        elseif ($pelanggan->status_pelanggan=="Pending") {
            $i = $this->input;

            $data = array(  'id_pelanggan'       => $id_pelanggan,
                            'id_user'            => $this->session->userdata('id_user'),
                            'status_pelanggan'   => 'Aktif'
                        );
            $this->pelanggan_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data Reseller telah di Aktifkan');
            redirect(base_url('admin/pelanggan'),'refresh');
        }

        
    }

    //Delete pelanggan
    public function delete($id_pelanggan)
    {
        $pelanggan = $this->pelanggan_model->detail($id_pelanggan);
        $data = array('id_pelanggan' => $id_pelanggan);
        $this->pelanggan_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
        redirect(base_url('admin/pelanggan'),'refresh');
    }
}
?>
