<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    
    // Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->model('rekening_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('konfigurasi_model');
    }

    // Load data transaksi 
    public function index()
    {
         $header_transaksi = $this->header_transaksi_model->listing();
         $data = array(  'title'             => 'Data Transaksi',
                         'header_transaksi'  =>  $header_transaksi,
                         'isi'               => 'admin/transaksi/list'
                          );
         $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    //Detail
    public function detail($kode_transaksi)
    {
        $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi = $this->transaksi_model->kode_transaksi($kode_transaksi);

        $data = array(  'title'              => 'Riwayat belanja',
                        'header_transaksi'   => $header_transaksi,
                        'transaksi'          => $transaksi,
                        'isi'                => 'admin/transaksi/detail'
                    );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    //status
    public function status($kode_transaksi)
    {
        $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);

        $i = $this->input;

        $data = array(  'id_header_transaksi'       => $header_transaksi->id_header_transaksi,
                        'id_user'                   => $this->session->userdata('id_user'),
                        'status_bayar'              => 'Success'
                    );
        $this->header_transaksi_model->edit($data);
        $this->session->set_flashdata('sukses', 'Data telah diedit');
        redirect(base_url('admin/transaksi'),'refresh');
    }

    //Cetak
    public function cetak($kode_transaksi)
    {
        $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi        = $this->transaksi_model->kode_transaksi($kode_transaksi);
        $site             = $this->konfigurasi_model->listing();

        $data = array(  'title'              => 'Riwayat belanja',
                        'header_transaksi'   => $header_transaksi,
                        'transaksi'          => $transaksi,
                        'site'               => $site
                    );
        $this->load->view('admin/transaksi/cetak', $data, FALSE);
    }

     //Cetak PDF
     public function pdf($kode_transaksi)
     {
         $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
         $transaksi        = $this->transaksi_model->kode_transaksi($kode_transaksi);
         $site             = $this->konfigurasi_model->listing();
 
         $data = array(  'title'              => 'Riwayat belanja',
                         'header_transaksi'   => $header_transaksi,
                         'transaksi'          => $transaksi,
                         'site'               => $site
                     );
        // $this->load->view('admin/transaksi/cetak', $data, FALSE);
        $html   = $this->load->view('admin/transaksi/cetak', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        // Write some HTML code:
        $mpdf->WriteHTML($html);
        // Output a PDF file directly to the browser
        $mpdf->Output();

     }

     // Pengiriman
     public function kirim($kode_transaksi)
     {
         $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
         $transaksi        = $this->transaksi_model->kode_transaksi($kode_transaksi);
         $site             = $this->konfigurasi_model->listing();
 
         $data = array(  'title'              => 'Riwayat belanja',
                         'header_transaksi'   => $header_transaksi,
                         'transaksi'          => $transaksi,
                         'site'               => $site
                     );
        // $this->load->view('admin/transaksi/kirim', $data, FALSE);
      $html   = $this->load->view('admin/transaksi/kirim', $data, true);
        // load fungsi mpdf
         $mpdf = new \Mpdf\Mpdf();
         // SETTING HEADER DAN FOOTER
        $mpdf->SetHTMLHeader('
         <div style="text-align: right; font-weight: bold;">
             <img src="'.base_url('assets/uploud/image/'.$site->logo).'" style="height: 50px; width= auto;">
        </div>');
        $mpdf->SetHTMLFooter('
          <div style="padding: 10px 20px; background-color: black; color: white; font-size: 12px;">
             Alamat: '.$site->namaweb.' ('.$site->alamat.')<br>
             Telepon: '.$site->telepon.'
         ');
        // END SETTING HEADER DAN FOOOTER
        // Write some HTML code:
         $mpdf->WriteHTML($html);
        // Output tampil dengan nama baru
         $nama_file_pdf = url_title($site->namaweb, 'dash', 'true').'-'.$kode_transaksi.'.pdf';
         $mpdf->Output($nama_file_pdf,'D'); 

     }
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/admin/Transaksi.php */