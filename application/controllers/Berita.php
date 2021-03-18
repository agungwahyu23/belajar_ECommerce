<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller{
    
    //Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('berita_model');
    }

    //Data berita
    public function index()
    {
        // $site				= $this->konfigurasi_model->listing();

        // //Ambil data total
        // $total				= $this->berita_model->total_produk();
        
        // //Paginasi start
    	// $this->load->library('pagination');

    	// $config['base_url']				= base_url().'berita/index/';
    	// $config['total_rows']			= $total->total;
    	// $config['use_page_numbers']		= TRUE;
    	// $config['per_page']				= 6;
    	// $config['uri_segment']			= 3;
    	// $config['num_links']			= 5;
    	// $config['full_tag_open']		= '<ul class="pagination">';
    	// $config['full_tag_close']		= '</ul>';
    	// $config['first_link']			= 'First';
    	// $config['first_tag_open']		= '<li>';
    	// $config['first_tag_close']		= '</li>';
    	// $config['last_link']			= 'Last';
    	// $config['last_tag_open']		= '<li class="disabled"><li class="active">a href="#"';
    	// $config['last_tag_close']		= '<span class="sr-only"></a></li></li>';
    	// $config['next_link']			= '&gt;';
    	// $config['next_tag_open']		= '</div>';
    	// $config['next_tag_close']		= '</div>';
    	// $config['prev_link']			= '&lt;';
    	// $config['prev_tag_open']		= '</div>';
    	// $config['prev_tag_close']		= '</div>';
    	// $config['cur_tag_open']			= '<b>';
    	// $config['cur_tag_close']		= '</b>';
    	// $config['first_url']			= base_url().'/berita/';

    	// $this->pagination->initialize($config);
        // //Ambil data produk
        
        // $page 		= ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) * $config['per_page']:0;
    	// $berita 	= $this->berita_model->berita($config['per_page'],$page);

        // //Paginasi end
        

        $berita = $this->berita_model->listing();

        $data = array('title'   => 'Data Berita',
                      'berita'  => $berita,
                      'isi'     => 'berita/list'
                     );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}