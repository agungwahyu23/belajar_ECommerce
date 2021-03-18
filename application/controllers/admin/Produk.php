<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller{
    
    //Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('kategori_model');
        
        //proteksi
        $this->simple_login->cek_login();
    }

    //Data produk
    public function index()
    {
        $produk = $this->produk_model->listing();
        $data = array('title'   => 'Data Produk',
                      'produk'    => $produk,
                      'isi'     => 'admin/produk/list'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        
    }

    //Variasi
    public function variasi($id_produk)
    {
        $produk      = $this->produk_model->detail($id_produk);
        $variasi     = $this->produk_model->variasi($id_produk);
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_variasi','Nama variasi','required', 
                array( 'required'    =>'%s harus diisi'));
          
        if($valid->run()===FALSE){

            $data = array('title'    => 'Tambah Variasi Produk: '.$produk->nama_produk,
                        'produk'     => $produk,
                        'variasi'    => $variasi,
                        'isi'        => 'admin/produk/variasi'
                        );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        }else{
            $i = $this->input;
            
            $data_var = array(  
                'id_produk'         =>  $id_produk,
                'nama_variasi'      =>  $i->post('nama_variasi'),
                'stok'              =>  $i->post('stok'),
                'tanggal_update'    =>  date('Y-m-d H:i:S')
                );
            $this->produk_model->tambah_variasi($data_var);

            $data = array(
                'id_produk'         => $id_produk,
                'stok'              => $produk->stok + $i->post('stok')
                );
            $this->produk_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data Variasi telah ditambahkan');
            redirect(base_url('admin/produk/variasi/'.$id_produk),'refresh');
        }
    }

    // Gambar
    public function gambar($id_produk)
    {
        $produk     = $this->produk_model->detail($id_produk);
        $gambar     = $this->produk_model->gambar($id_produk);
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('judul_gambar','Judul/Nama Gambar','required', 
                array( 'required'    =>'%s harus diisi'));
        
                        
        if($valid->run()){
            $config['upload_path']    = './assets/upload/image/';
            $config['allowed_types']  = 'gif|jpg|png|jpeg|jfif';
            $config['max_size']       = '2400'; //dalam kb
            $config['max_width']      = '2024';
            $config['max_height']     = '2024';
            
            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload('gambar')){
        //end validasi

        $data = array('title'    => 'Tambah Gambar Produk: '.$produk->nama_produk,
                      'produk' => $produk,
                      'gambar' => $gambar,
                      'error'    => $this->upload->display_errors(),
                      'isi'      => 'admin/produk/gambar'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        //masuk databese
        }else{
            $upload_gambar = array('upload_data' => $this->upload->data());

            //create thumb
            $config['image_library']    = 'gd2';
            $config['source_image']     = './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
            //lokasi folder gbr
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
            
            $data = array(  
                'id_produk'     =>$id_produk,
                'judul_gambar'  =>  $i->post('judul_gambar'),
                'gambar'        =>  $upload_gambar['upload_data']['file_name'],
                );
            $this->produk_model->tambah_gambar($data);
            $this->session->set_flashdata('sukses', 'Data Gambar telah ditambahkan');
            redirect(base_url('admin/produk/gambar/'.$id_produk),'refresh');
        }}
        //end masuk database
        $data = array('title'    => 'Tambah Gambar Produk: ' .$produk->nama_produk,
                      'produk'  => $produk,
                      'gambar' =>   $gambar,
                      'isi'      => 'admin/produk/gambar'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);

    }

    //Tambah produk
    public function tambah()
    {
        //ambil data kategori
        $kategori = $this->kategori_model->listing();
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_produk','Nama produk','required', 
                array( 'required'    =>'%s harus diisi'));
        $valid->set_rules('kode_produk','Kode produk','required|is_unique[produk.kode_produk]', 
                array( 'required'    =>'%s harus diisi',
                       'is_unique'   =>'%s sudah ada. Buat kode baru'));
        
                        
        if($valid->run()){
            
            $config['upload_path']    = './assets/upload/image/';
            $config['allowed_types']  = 'gif|jpg|png|jpeg|jfif';
            $config['max_size']       = '2400'; //dalam kb
            $config['max_width']      = '2024';
            $config['max_height']     = '2024';
            
            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload('gambar')){
        //end validasi

        $data = array('title'    => 'Tambah Produk',
                      'kategori' => $kategori,
                      'error'    => $this->upload->display_errors(),
                      'isi'      => 'admin/produk/tambah'
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
            $slug_produk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kode_produk'),'dash',TRUE);
            $data = array(  
                'id_user'       =>  $this->session->userdata('id_user'),
                'id_kategori'   =>  $i->post('id_kategori'),
                'kode_produk'   =>  $i->post('kode_produk'),
                'url'           =>  $i->post('url'),
                'nama_produk'   =>  $i->post('nama_produk'),
                'slug_produk'   =>  $slug_produk,
                'keterangan'    =>  $i->post('keterangan'),
                'keywords'      =>  $i->post('keywords'),
                'harga_beli'         =>  $i->post('harga_beli'),
                'harga'         =>  $i->post('harga'),
                'stok'          =>  $i->post('stok'),
                'gambar'        =>  $upload_gambar['upload_data']['file_name'],
                'berat'         =>  $i->post('berat'),
                'ukuran'        =>  $i->post('ukuran'),
                'status_produk' =>  $i->post('status_produk'),
                'tanggal_post'  =>  date('Y-m-d H:i:S')
                );
            $this->produk_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data telah ditambahkan');
            redirect(base_url('admin/produk'),'refresh');
        }}
        //end masuk database
        $data = array('title'    => 'Tambah Produk',
                      'kategori' => $kategori,
                      'isi'      => 'admin/produk/tambah'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    //====================================================================================//
    //Edit produk
    public function edit($id_produk)
    {
        //ambil data yang akan diedit
        $produk = $this->produk_model->detail($id_produk);
        //ambil data kategori
        $kategori = $this->kategori_model->listing();

        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_produk','Nama produk','required', 
                array( 'required'    =>'%s harus diisi'));
        $valid->set_rules('kode_produk','Kode produk','required', 
                array( 'required'    =>'%s harus diisi'));
        
                        
        if($valid->run()){
            //cek jika ganti gambar
            if(!empty($_FILES['gambar']['name'])){

            $config['upload_path']    = './assets/upload/image/';
            $config['allowed_types']  = 'gif|jpg|png|jpeg|jfif';
            $config['max_size']       = '2400'; //dalam kb
            $config['max_width']      = '2024';
            $config['max_height']     = '2024';
            
            $this->load->library('upload', $config);
            
            if ( !$this->upload->do_upload('gambar')){
        //end validasi

        $data = array('title'    => 'Edit Produk: '.$produk->nama_produk,
                      'kategori' => $kategori,
                      'produk'   => $produk,
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
            $slug_produk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kode_produk'),'dash',TRUE);
            $data = array(  'id_produk'     => $id_produk,
                            'id_user'       =>  $this->session->userdata('id_user'),
                            'id_kategori'   =>  $i->post('id_kategori'),
                            'kode_produk'   =>  $i->post('kode_produk'),
                            'url'           =>  $i->post('url'),
                            'nama_produk'   =>  $i->post('nama_produk'),
                            'slug_produk'   =>  $slug_produk,
                            'keterangan'    =>  $i->post('keterangan'),
                            'keywords'      =>  $i->post('keywords'),
                            'harga_beli'         =>  $i->post('harga_beli'),
                            'harga'         =>  $i->post('harga'),
                            'stok'          =>  $i->post('stok'),
                            'gambar'        =>  $upload_gambar['upload_data']['file_name'],
                            'berat'         =>  $i->post('berat'),
                            'ukuran'        =>  $i->post('ukuran'),
                            'status_produk' =>  $i->post('status_produk')
                        );
            $this->produk_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diedit dengan gambar');
            redirect(base_url('admin/produk'),'refresh');
        }}else{
            //edit produk tanpa edit gambar
            $i = $this->input;
            //slug
            $slug_produk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kode_produk'),'dash',TRUE);
            $data = array(  'id_produk'     => $id_produk,
                            'id_user'       =>  $this->session->userdata('id_user'),
                            'id_kategori'   =>  $i->post('id_kategori'),
                            'kode_produk'   =>  $i->post('kode_produk'),
                            'url'           =>  $i->post('url'),
                            'nama_produk'   =>  $i->post('nama_produk'),
                            'slug_produk'   =>  $slug_produk,
                            'keterangan'    =>  $i->post('keterangan'),
                            'keywords'      =>  $i->post('keywords'),
                            'harga_beli'         =>  $i->post('harga_beli'),
                            'harga'         =>  $i->post('harga'),
                            'stok'          =>  $i->post('stok'),
                            //'gambar'        =>  $upload_gambar['upload_data']['file_name'],
                            'berat'         =>  $i->post('berat'),
                            'ukuran'        =>  $i->post('ukuran'),
                            'status_produk' =>  $i->post('status_produk')
                        );
            $this->produk_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diedit tanpa gambar');
            redirect(base_url('admin/produk'),'refresh');
        }}
        //end masuk database
        $data = array('title'    => 'Edit Produk: '.$produk->nama_produk,
                      'kategori' => $kategori,
                      'produk'   => $produk,
                      'isi'      => 'admin/produk/edit'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    //Delete produk
    public function delete($id_produk)
    {
        $produk = $this->produk_model->detail($id_produk);
        unlink('./assets/upload/image/' .$produk->gambar);
        unlink('./assets/upload/image/thumbs/' .$produk->gambar);
        $data = array('id_produk' => $id_produk);
        $this->produk_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
        redirect(base_url('admin/produk'),'refresh');
    }

    //Delete variasi
    public function delete_variasi($id_produk,$id_var)
    {
        $produk = $this->produk_model->detail_variasi($id_var);
        
        $data = array('id_var' => $id_var);
        $this->produk_model->delete_variasi($data);

        $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
        redirect(base_url('admin/produk/variasi/'.$id_produk),'refresh');
    }

    //Delete gambar produk
    public function delete_gambar($id_produk,$id_gambar)
    {
        $gambar = $this->produk_model->detail_gambar($id_gambar);
        unlink('./assets/upload/image/' .$gambar->gambar);
        unlink('./assets/upload/image/thumbs/' .$gambar->gambar);
        $data = array('id_gambar' => $id_gambar);
        $this->produk_model->delete_gambar($data);
        $this->session->set_flashdata('sukses', 'Data telah dihapus');
        redirect(base_url('admin/produk/gambar/'.$id_produk),'refresh');
    }
}

?>