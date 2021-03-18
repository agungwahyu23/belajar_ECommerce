<?php
	//eror upload
	if(isset($error)){
		echo '<p class="alert laert-warning">';
		echo $error;
		echo '</p>';
	}
	
	//notif eror
	echo validation_errors('<div class="alert alert-warning">','</div>');

	//form open
	echo form_open(base_url('admin/produk/variasi/'.$produk->id_produk),' class="form-horizontal"');
?>

<div class="form-group row">
	<label class="col-md-2 col-form-label control-label">Nama variasi</label>
	<div class="col-md-5">
		<input type="text" name="nama_variasi" class="form-control" placeholder="Nama Produk"
			value="<?php echo set_value('nama_variasi'); ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label control-label">Stok</label>
	<div class="col-md-5">
		<input type="number" name="stok" class="form-control" placeholder="Stok"
			value="<?php echo set_value('stok'); ?>" required>
	</div>
</div>

<div class="form-group row">
	<div class="col-md-2"></div>
	<div class="col-md-5">
		<button class="btn btn-success btn-lg" name="submit" type="submit">
			<i class="fa fa-save"></i> Simpan
		</button>
		<button class="btn btn-info btn-lg" name="reset" type="reset">
			<i class="fa fa-times"></i> Reset
		</button>
	</div>
</div>
<?php echo form_close(); ?>

<?php
//notifikasi
	if ($this->session->flashdata('sukses')) {
		echo '<div class="alert alert-success alert-dismissible">';
		echo '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>';
		echo $this->session->flashdata('sukses');
		echo'</div>';
	}
?>

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th>NO</th>
			<th>VARIASI</th>
			<th>STOK</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($variasi as $variasi){ ?>
		<tr>
			<td><?= $no++ ?></td>
			<td>
				<?php echo $variasi->nama_variasi ?>
			</td>
			<td>
				<?php echo $variasi->stok ?></td>
			<td>
				<a href="<?= base_url('admin/produk/delete_variasi/'.$produk->id_produk.'/'.$variasi->id_var) ?>" class="btn btn-danger btn-xs" onclick="return confirm(' Yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i>Hapus</a>
			</td>

		</tr>
		<?php } ?>
	</tbody>
</table>
					