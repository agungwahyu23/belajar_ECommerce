<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-2 p-b-50">
                <div class="leftbar p-r-0-sm">
                <!--  -->
                <?php include('menu.php') ?>
                </div>
            </div>

                <div class="col-sm-6 col-md-8 col-lg-10">

               
                    <div class="alert alert-success">
                        <h1>Selamat Datang <i><strong><?php echo $this->session->userdata('nama_pelanggan'); ?></strong></i></h1>
                    </div>
                
                    <?php
                    //kalau ada transaksi tampilkan tabel
                    if($header_transaksi) { 
                    ?>

                    <div class="table-responsive">
                        <table class="table table-bordered t-cart">
                            <thead>
                                <tr class="bg-success">
                                    <th width="5%">NO</th>
                                    <th width="15%">KODE</th>
                                    <th width="15%">TANGGAL</th>
                                    <th width="15%">BATAS BAYAR</th>
                                    <th width="17%">JUMLAH TOTAL</th>
                                    <th width="10%">JUMLAH ITEM</th>
                                    <th width="10%">STATUS</th>
                                    <th width="13%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($header_transaksi as $header_transaksi){ ?>
                                <tr>
                                    <td width="5%"><?php echo $i ?></td>
                                    <td width="15%"><?php echo $header_transaksi->kode_transaksi ?></td>
                                    <td width="15%"><?php echo date('d-m-Y H:i:s',strtotime($header_transaksi->tanggal_transaksi)) ?></td>
                                    <td width="15%" class="table-danger"><?php echo date('d-m-Y H:i:s',strtotime($header_transaksi->batas_bayar)) ?></td>
                                    <td width="17%"><?php echo number_format($header_transaksi->jumlah_transaksi) ?></td>
                                    <td width="10%"><?php echo $header_transaksi->total_item ?></td>
                                    <td width="10%"><?php echo $header_transaksi->status_bayar ?></td>
                                    <td width="13%">
                                       

                                                <div class="btn pt-0 pb-0">
                                                    <a href="<?php echo base_url('dasbor/detail/'.$header_transaksi->kode_transaksi) ?>"
                                                        class="btn btn-success btn-sm"><i class="fa fa-eye"></i>Detail</a>
                                                </div>
                                                <div class="btn pt-0 pb-0">
                                                    <a href="<?php echo base_url('dasbor/konfirmasi/'.$header_transaksi->kode_transaksi) ?>"
                                                        class="btn btn-info btn-sm"><i class="fa fa-upload"></i>Konfirmasi Bayar</a>
                                                </div>
                                    </td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>

                    <?php
                    //kalo gaada tampil notif
                    }else{ ?>
                        <p class="alert alert-success">
                            <i class="fa fa-warning"></i> Belum ada data transaksi
                        </p>
                    <?php } ?>
                    
        </div>
    </div>
</div>
</section>