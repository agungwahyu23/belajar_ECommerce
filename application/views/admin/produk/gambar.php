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
	echo form_open_multipart(base_url('admin/produk/gambar/'.$produk->id_produk),' class="form-horizontal"');
?>

<div class="form-group row">
	<label class="col-md-2 col-form-label control-label">Judul Gambar</label>
	<div class="col-md-4">
		<input type="text" name="judul_gambar" class="form-control" placeholder="Judul Gambar Produk"
			value="<?php echo set_value('judul_gambar'); ?>" required>
	</div>

<div class="form-group row">
	<label class="col-md-4 col-form-label control-label">Unggah Gambar</label>
	<div class="col-md-8">
		<input type="file" name="gambar" class="form-control" placeholder="Gambar Produk"
			value="<?php echo set_value('gambar'); ?>" required>
		</div>
			<button class="btn btn-success btn-lg" name="submit" type="submit">
				<i class="fa fa-save"></i> Simpan dan unggah Gambar
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
			<th>GAMBAR</th>
			<th>JUDUL</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td>1</td>
			<td>
				<img src="<?php echo base_url('assets/upload/image/thumbs/'.$produk->gambar) ?>" class="img img responsive img thumbnail" width="60">
			</td>
			<td><?php echo $produk->nama_produk ?></td>
			<td>
			</td>
		</tr>

		<?php $no=2; foreach($gambar as $gambar){ ?>
		<tr>
			<td><?= $no++ ?></td>
			<td>
				<img src="<?php echo base_url('assets/upload/image/thumbs/'.$gambar->gambar) ?>" class="img img responsive img thumbnail" width="60">
			</td>
			<td><?php echo $gambar->judul_gambar ?></td>
			<td>

				<a href="<?= base_url('admin/produk/delete_gambar/'.$produk->id_produk.'/'.$gambar->id_gambar) ?>" class="btn btn-danger btn-xs" onclick="return confirm(' Yakin ingin menghapus gambar ini?')"><i class="fa fa-trash-o"></i>Hapus</a>
			</td>

		</tr>
		<?php } ?>
	</tbody>
</table>
					