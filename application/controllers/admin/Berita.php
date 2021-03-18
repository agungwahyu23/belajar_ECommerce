<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller{
    
    //Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('berita_model');
        //proteksi
        $this->simple_login->cek_login();
    }

    //Data berita
    public function index()
    {
        $berita = $this->berita_model->listing();
        $data = array('title'   => 'Data Berita',
                      'berita'    => $berita,
                      'isi'     => 'admin/berita/list'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    //Tambah berita
    public function tambah()
    {
        //ambil data berita
        $berita = $this->berita_model->listing();
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('jenis_berita','Jenis berita','required', 
                array( 'required'    =>'%s harus diisi'));
        $valid->set_rules('judul_berita','Judul berita','required', 
                array( 'required'    =>'%s harus diisi',
                       'is_unique'   =>'%s harus diisi'));
        
                        
        if($valid->run()){
            
            $config['upload_path']    = './assets/upload/image/';
            $config['allowed_types']  = 'gif|jpg|png|jpeg';
            $config['max_size']       = '2400'; //dalam kb
            $config['max_width']      = '2024';
            $config['max_height']     = '2024';
            
            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload('gambar')){
        //end validasi

        $data = array('title'    => 'Tambah Produk',
                      'berita' => $berita,
                      'error'    => $this->upload->display_errors(),
                      'isi'      => 'admin/berita/tambah'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
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
            //slug
            $slug_berita = url_title($this->input->post('jenis_berita').'-'.$this->input->post('id_berita'),'dash',TRUE);
            $data = array(  
                'id_user'       =>  $this->session->userdata('id_user'),
                'id_berita'     =>  $i->post('id_berita'),
                'jenis_berita'  =>  $i->post('jenis_berita'),
                'judul_berita'  =>  $i->post('judul_berita'),
                'slug_berita'   =>  $slug_berita,
                'keywords'      =>  $i->post('keywords'),
                'keterangan'    =>  $i->post('keterangan'),
                'gambar'        =>  $upload_gambar['upload_data']['file_name'],
                'status_berita' =>  $i->post('status_berita'),
                'tanggal_post'  =>  date('Y-m-d H:i:S')
                );
            $this->berita_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data telah ditambahkan');
            redirect(base_url('admin/berita'),'refresh');
        }}
        //end masuk database
        $data = array('title'    => 'Tambah Produk',
                      'berita'      => $berita,
                      'isi'      => 'admin/berita/tambah'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function edit($id_berita)
    {
        //ambil data yang akan diedit
        $berita = $this->berita_model->detail($id_berita);

        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('jenis_berita','Jenis Berita','required', 
                array( 'required'    =>'%s harus diisi'));
        $valid->set_rules('judul_berita','Judul Berita','required', 
                array( 'required'    =>'%s harus diisi'));

        if($valid->run()){
            //cek jika ganti gambar
            if(!empty($_FILES['gambar']['name'])){

            $config['upload_path']    = './assets/upload/image/';
            $config['allowed_types']  = 'gif|jpg|png|jpeg';
            $config['max_size']       = '2400'; //dalam kb
            $config['max_width']      = '2024';
            $config['max_height']     = '2024';
            
            $this->load->library('upload', $config);
            
            if ( !$this->upload->do_upload('gambar')){
        //end validasi

        $data = array('title'    => 'Edit Berita',
                      'berita'   => $berita,
                      'error'    => $this->upload->display_errors(),
                      'isi'      => 'admin/produk/edit'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
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
            //slug
            $slug_berita = url_title($this->input->post('jenis_berita').'-'.$this->input->post('judul_berita'),'dash',TRUE);
            $data = array(  'id_berita'     => $id_berita,
                            'id_user'       =>  $this->session->userdata('id_user'),
                            'jenis_berita'  =>  $i->post('jenis_berita'),
                            'judul_berita'  =>  $i->post('judul_berita'),
                            'slug_berita'   =>  $slug_berita,
                            'keywords'      =>  $i->post('keywords'),
                            'keterangan'    =>  $i->post('keterangan'),
                            'gambar'        =>  $upload_gambar['upload_data']['file_name'],
                            'status_berita' =>  $i->post('status_berita')
                        );
            $this->berita_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diedit dengan gambar');
            redirect(base_url('admin/berita'),'refresh');
        }}else{
            //edit produk tanpa edit gambar
            $i = $this->input;
            //slug
            $slug_berita = url_title($this->input->post('jenis_berita').'-'.$this->input->post('judul_berita'),'dash',TRUE);
            $data = array(  'id_berita'     => $id_berita,
                            'id_user'       =>  $this->session->userdata('id_user'),
                            'jenis_berita'  =>  $i->post('jenis_berita'),
                            'judul_berita'  =>  $i->post('judul_berita'),
                            'slug_berita'   =>  $slug_berita,
                            'keywords'      =>  $i->post('keywords'),
                            'keterangan'    =>  $i->post('keterangan'),
                            //'gambar'        =>  $upload_gambar['upload_data']['file_name'],
                            'status_berita' =>  $i->post('status_berita')
                        );
            $this->berita_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diedit tanpa gambar');
            redirect(base_url('admin/berita'),'refresh');
        }}
        //end masuk database
        $data = array('title'    => 'Edit Berita',
                      'berita'   => $berita,
                      'isi'      => 'admin/berita/edit'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    //Delete produk
    public function delete($id_berita)
    {
        $berita = $this->berita_model->detail($id_berita);
        unlink('./assets/upload/image/' .$berita->gambar);
        unlink('./assets/upload/image/thumbs/' .$berita->gambar);
        $data = array('id_berita' => $id_berita);
        $this->berita_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
        redirect(base_url('admin/berita'),'refresh');
    }
}