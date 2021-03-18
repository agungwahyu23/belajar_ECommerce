<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller
{
    //load model
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('transaksi_model');
        $this->load->model('rekening_model');
        
        //proteksi login
        $this->simple_pelanggan->cek_login();
    }
    
    //halaman dasbornya
    public function index()
    {
        $this->transaksiExpired();
        //ambil data login id_pelanggan
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->header_transaksi_model->pelanggan($id_pelanggan);

        $data = array(  'title'              => 'Halaman Dasbor Pelanggan',
                        'header_transaksi'   => $header_transaksi,
                        'isi'                => 'dasbor/list'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    public function belanja()
    {
        //ambil data login id_pelanggan
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->header_transaksi_model->pelanggan($id_pelanggan);

        $data = array(  'title'              => 'Riwayat belanja',
                        'header_transaksi'   => $header_transaksi,
                        'isi'                => 'dasbor/belanja'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    //hapus trans ex
    public function transaksiExpired()
    {
        
        // $this->db->select('transaksi.*, header_transaksi.*');
        // $this->db->from('transaksi');
        // $this->db->join('header_transaksi', 'header_transaksi.kode_transaksi = transaksi.kode_transaksi', 'left');
        // $this->db->where('kode_transaksi', $kode_transaksi);
        
        $this->db->query("DELETE FROM header_transaksi WHERE batas_bayar < NOW()");
        // $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        
        // if ($header_transaksi->batas_bayar <= $header_transaksi->tanggal_transaksi) {
        //     $data = array(  'id_header_transaksi'       => $header_transaksi->id_header_transaksi,
        //                     'status_bayar'              => 'Konfirmasi',
        //                                     );
        //     $this->header_transaksi_model->edit($data);
            //$this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil');
            //redirect(base_url('dasbor'),'refresh');
        //}
            // $data = array ( 'kode_transaksi'  => $kode_transaksi);
            // $this->transaksi_model->deleteTransaksiExpired($data);
    }

    //Detail
    public function detail($kode_transaksi)
    {
        //ambil data login id_pelanggan
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi = $this->transaksi_model->kode_transaksi($kode_transaksi);

        //pastikan pelanggan hanya mengakses data transaksinya
        if ($header_transaksi->id_pelanggan != $id_pelanggan) {
            $this->session->set_flashdata('warning', 'Anda mencoba mengakses data transaksi orang lain');
            redirect(base_url('masuk'));
        }

        $data = array(  'title'              => 'Riwayat belanja',
                        'header_transaksi'   => $header_transaksi,
                        'transaksi'          => $transaksi,
                        'isi'                => 'dasbor/detail'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    //profil
    public function profil()
    {
        //ambil data dari session login
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $pelanggan = $this->pelanggan_model->detail($id_pelanggan);

        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_pelanggan','Nama lengkap','required', 
                array( 'required'    =>'%s harus diisi'));
        
        $valid->set_rules('alamat','Alamat','required', 
                array( 'required'    =>'%s harus diisi'));
        
        $valid->set_rules('telepon','Telepon','required', 
                array( 'required'    =>'%s harus diisi'));
                
        if($valid->run()===FALSE){
        //end validasi
        
        $data = array(  'title'         => 'Profil Saya',
                        'pelanggan'     => $pelanggan,
                        'isi'           => 'dasbor/profil'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);

        //masuk databese
        }else{
        $i = $this->input;
        //kalau pass lebih dari 6 maka pass diganti
        if (strlen($i->post('password')) >= 6) {
            $data = array(  'id_pelanggan'      =>  $id_pelanggan,
                            'nama_pelanggan'    =>  $i->post('nama_pelanggan'),
                            'password'          =>  SHA1($i->post('password')),
                            'telepon'           =>  $i->post('telepon'),
                            'alamat'            =>  $i->post('alamat')
                        );
        }else {
            //kalo pass kurang dr 6 gajadi diganti
            $data = array(  'id_pelanggan'      =>  $id_pelanggan,
                            'nama_pelanggan'    =>  $i->post('nama_pelanggan'),
                            'telepon'           =>  $i->post('telepon'),
                            'alamat'            =>  $i->post('alamat')
                        );
        }
        //end data update
        $this->pelanggan_model->edit($data);
        $this->session->set_flashdata('sukses', 'Update Profil berhasil');
        redirect(base_url('dasbor/profil'),'refresh');
    }
    //end masuk database
    }

    //konfirmasi pembayaran
    public function konfirmasi($kode_transaksi)
    {
        $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $rekening = $this->rekening_model->listing();
        $tgl_trans = date('Y-m-d H:i:s');
        $tgl_bayar = $this->header_transaksi_model->listing('batas_bayar');

        //if ($header_transaksi->batas_bayar > $header_transaksi->tanggal_transaksi) {
        if ($header_transaksi->batas_bayar > date('Y-m-d H:i:s')) {

            //validasi input
            $valid = $this->form_validation;
            $valid->set_rules('nama_bank','Nama Bank','required', 
                    array( 'required'    =>'%s harus diisi'));
            $valid->set_rules('rekening_pembayaran','Rekening Pembayaran','required', 
                    array( 'required'    =>'%s harus diisi'));
            $valid->set_rules('rekening_pelanggan','Nama Pemilik Rekening','required', 
                    array( 'required'    =>'%s harus diisi'));
            $valid->set_rules('tanggal_bayar','Tanggal Pembayaran','required', 
                    array( 'required'    =>'%s harus diisi'));
            $valid->set_rules('jumlah_bayar','Jumlah Pembayaran','required', 
                    array( 'required'    =>'%s harus diisi'));

                if($valid->run()){
                    //cek jika gambar diganti
                    if(!empty($_FILES['bukti_bayar']['name'])){
            
                        $config['upload_path']    = './assets/upload/image/';
                        $config['allowed_types']  = 'gif|jpg|png|jpeg';
                        $config['max_size']       = '2400'; //dalam kb
                        $config['max_width']      = '2024';
                        $config['max_height']     = '2024';
                        
                        $this->load->library('upload', $config);
                    
                            if ( ! $this->upload->do_upload('bukti_bayar')){
                                //end validasi
                                $data = array(  'title'             => 'Konfirmasi Pembayaran',
                                                'header_transaksi'  => $header_transaksi,
                                                'rekening'          => $rekening,
                                                'error'             => $this->upload->display_errors(),
                                                'isi'               => 'dasbor/konfirmasi'
                                            );
                                $this->load->view('layout/wrapper', $data, FALSE);
                                //masuk databese
                            }else{
                                $upload_gambar = array('upload_data' => $this->upload->data());
                        
                                //create thumb
                                $config['image_library']    = 'gd2';
                                $config['source_image']     = './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
                                //lokasi folder gbr thumb
                                $config['new_image']    = './assets/upload/image/thumbs/';
                                $config['create_thumb']     = TRUE;
                                $config['maintain_ratio']   = TRUE;
                                $config['width']            = 250;
                                $config['height']           = 250;
                                $config['thumb_marker']     = '';
                                
                                $this->load->library('image_lib', $config);
                                $this->image_lib->resize();
                                //end thumb
                        
                                $i = $this->input;
                        
                                $data = array(  'id_header_transaksi'       => $header_transaksi->id_header_transaksi,
                                                'status_bayar'              => 'Konfirmasi',
                                                'jumlah_bayar'              => $i->post('jumlah_bayar'),
                                                'rekening_pembayaran'       => $i->post('rekening_pembayaran'),
                                                'rekening_pelanggan'        => $i->post('rekening_pelanggan'),
                                                'bukti_bayar'               => $upload_gambar['upload_data']['file_name'],
                                                'id_rekening'               => $i->post('id_rekening'),
                                                'tanggal_bayar'             => $i->post('tanggal_bayar'),
                                                'nama_bank'                 => $i->post('nama_bank')
                                            );
                                $this->header_transaksi_model->edit($data);
                                $this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil');
                                redirect(base_url('dasbor'),'refresh');
                            }
                    }else{
                            //edit tanpa ganti gambar
                            $i = $this->input;
                    
                            $data = array(  'id_header_transaksi'       => $header_transaksi->id_header_transaksi,
                                            'status_bayar'              => 'Konfirmasi',
                                            'jumlah_bayar'              => $i->post('jumlah_bayar'),
                                            'rekening_pembayaran'       => $i->post('rekening_pembayaran'),
                                            'rekening_pelanggan'        => $i->post('rekening_pelanggan'),
                                            //'bukti_bayar'               => $upload_gambar['upload_data']['file_name'],
                                            'id_rekening'               => $i->post('id_rekening'),
                                            'tanggal_bayar'             => $i->post('tanggal_bayar'),
                                            'nama_bank'                 => $i->post('nama_bank')
                                        );
                            $this->header_transaksi_model->edit($data);
                            $this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil');
                            redirect(base_url('dasbor'),'refresh');
                    }
                }
                        //end masuk database
                        $data = array(      'title'             => 'Konfirmasi Pembayaran',
                                            'header_transaksi'  => $header_transaksi,
                                            'rekening'          => $rekening,
                                            'isi'               => 'dasbor/konfirmasi'
                                        );
                            $this->load->view('layout/wrapper', $data, FALSE);

        }else{
            $data = array(  'title'             => 'Konfirmasi Pembayaran',
                            'header_transaksi'  => $header_transaksi,
                            'isi'               => '404/notfound'
                        );
                     $this->load->view('layout/wrapper', $data, FALSE);
        }
        

    //     //validasi input
    //     $valid = $this->form_validation;

    //     $valid->set_rules('nama_bank','Nama Bank','required', 
    //             array( 'required'    =>'%s harus diisi'));
    //     $valid->set_rules('rekening_pembayaran','Rekening Pembayaran','required', 
    //             array( 'required'    =>'%s harus diisi'));
    //     $valid->set_rules('rekening_pelanggan','Nama Pemilik Rekening','required', 
    //             array( 'required'    =>'%s harus diisi'));
    //     $valid->set_rules('tanggal_bayar','Tanggal Pembayaran','required', 
    //             array( 'required'    =>'%s harus diisi'));
    //     $valid->set_rules('jumlah_bayar','Jumlah Pembayaran','required', 
    //             array( 'required'    =>'%s harus diisi'));
        
                        
    //     if($valid->run()){
    //         //cek jika gambar diganti
    //         if(!empty($_FILES['bukti_bayar']['name'])){
            
    //         $config['upload_path']    = './assets/upload/image/';
    //         $config['allowed_types']  = 'gif|jpg|png|jpeg';
    //         $config['max_size']       = '2400'; //dalam kb
    //         $config['max_width']      = '2024';
    //         $config['max_height']     = '2024';
            
    //         $this->load->library('upload', $config);
            
    //         if ( ! $this->upload->do_upload('bukti_bayar')){
    //     //end validasi
        
    //     $data = array(  'title'             => 'Konfirmasi Pembayaran',
    //                     'header_transaksi'  => $header_transaksi,
    //                     'rekening'          => $rekening,
    //                     'error'             => $this->upload->display_errors(),
    //                     'isi'               => 'dasbor/konfirmasi'
    //                 );
    //     $this->load->view('layout/wrapper', $data, FALSE);

    //     //masuk databese
    // }else{
    //     $upload_gambar = array('upload_data' => $this->upload->data());

    //     //create thumb
    //     $config['image_library']    = 'gd2';
    //     $config['source_image']     = './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
    //     //lokasi folder gbr thumb
    //     $config['new_image']    = './assets/upload/image/thumbs/';
    //     $config['create_thumb']     = TRUE;
    //     $config['maintain_ratio']   = TRUE;
    //     $config['width']            = 250;
    //     $config['height']           = 250;
    //     $config['thumb_marker']     = '';
        
    //     $this->load->library('image_lib', $config);
    //     $this->image_lib->resize();
    //     //end thumb

    //     $i = $this->input;

    //     $data = array(  'id_header_transaksi'       => $header_transaksi->id_header_transaksi,
    //                     'status_bayar'              => 'Konfirmasi',
    //                     'jumlah_bayar'              => $i->post('jumlah_bayar'),
    //                     'rekening_pembayaran'       => $i->post('rekening_pembayaran'),
    //                     'rekening_pelanggan'        => $i->post('rekening_pelanggan'),
    //                     'bukti_bayar'               => $upload_gambar['upload_data']['file_name'],
    //                     'id_rekening'               => $i->post('id_rekening'),
    //                     'tanggal_bayar'             => $i->post('tanggal_bayar'),
    //                     'nama_bank'                 => $i->post('nama_bank')
    //                 );
    //     $this->header_transaksi_model->edit($data);
    //     $this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil');
    //     redirect(base_url('dasbor'),'refresh');
    // }}else{
    //     //edit tanpa ganti gambar
    //     $i = $this->input;

    //     $data = array(  'id_header_transaksi'       => $header_transaksi->id_header_transaksi,
    //                     'status_bayar'              => 'Konfirmasi',
    //                     'jumlah_bayar'              => $i->post('jumlah_bayar'),
    //                     'rekening_pembayaran'       => $i->post('rekening_pembayaran'),
    //                     'rekening_pelanggan'        => $i->post('rekening_pelanggan'),
    //                     //'bukti_bayar'               => $upload_gambar['upload_data']['file_name'],
    //                     'id_rekening'               => $i->post('id_rekening'),
    //                     'tanggal_bayar'             => $i->post('tanggal_bayar'),
    //                     'nama_bank'                 => $i->post('nama_bank')
    //                 );
    //     $this->header_transaksi_model->edit($data);
    //     $this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil');
    //     redirect(base_url('dasbor'),'refresh');
    // }}
    // //end masuk database
    // $data = array(  'title'             => 'Konfirmasi Pembayaran',
    //                     'header_transaksi'  => $header_transaksi,
    //                     'rekening'          => $rekening,
    //                     'isi'               => 'dasbor/konfirmasi'
    //                 );
    //     $this->load->view('layout/wrapper', $data, FALSE);                    
    }
}

?>