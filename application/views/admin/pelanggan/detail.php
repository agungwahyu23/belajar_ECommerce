<p class="pull-right">
	<div class="btn-group pull-right">
		<a href="<?php echo base_url('admin/pelanggan') ?>" title="Kembali" class="btn btn-info btn-sm">
			<i class="fa fa-backward"></i> Kembali
		</a>
	</div>
</p>
<div class="clearfix"></div>
<hr>

<table class="table table-bordered">
	<tbody>
        <tr>
			<th width="20%">Nama Reseller</th>
			<th><?php echo $pelanggan->nama_pelanggan ?></th>
		</tr>
		<tr>
			<th width="20%">Email</th>
			<th><?php echo $pelanggan->email ?></th>
		</tr>
        <tr>
			<th width="20%">Telepon</th>
			<th><?php echo $pelanggan->telepon ?></th>
		</tr>
        <tr>
			<th width="20%">Alamat</th>
			<th><?php echo $pelanggan->alamat ?></th>
		</tr>
		<tr>
			<td>Tanggal Daftar</td>
			<td>: <?php echo date('d-m-Y',strtotime($pelanggan->tanggal_daftar)) ?></td>
		</tr>
        <tr>
			<td>Tanggal Update</td>
			<td>: <?php echo date('d-m-Y',strtotime($pelanggan->tanggal_update)) ?></td>
		</tr>
	</tbody>
</table>
<a href="#" class="btn btn-success btn-ml mt-2">Validasi</a>