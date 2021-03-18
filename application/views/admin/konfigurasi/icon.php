<?php
if ($this->session->flashdata('sukses')) {
	echo '<div class="alert alert-success alert-dismissible">';
	echo '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>';
	echo $this->session->flashdata('sukses');
	echo'</div>';
}
?>

<?php
	//notif eror
	echo validation_errors('<div class="alert alert-warning">','</div>');

	//form open
	echo form_open_multipart(base_url('admin/konfigurasi/icon'), ' class="form-horizontal"');
?>

<div class="form-group row">
	<label class="col-md-3 col-form-label control-label">Nama Website</label>
	<div class="col-md-5">
		<input type="text" name="namaweb" class="form-control" placeholder="Nama Website"
			value="<?php echo $konfigurasi->namaweb ?>" required>
	</div>
</div>
<div class="form-group row">
	<label class="col-md-3 col-form-label control-label">Upload icon Baru</label>
	<div class="col-md-8">
		<input type="file" name="icon" class="form-control" placeholder="Upload icon Baru"
			value="<?php echo $konfigurasi->icon ?>" required>
			icon lama: <br>
			<img src="<?php echo base_url('assets/upload/image/'.$konfigurasi->icon) ?>" class="img img-responsive img-thumbnail" width="200">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-3 col-form-label"></label>
	<div class="col-md-9">
		<button class="btn btn-success btn-lg" name="submit" type="submit">
			<i class="fa fa-save"></i> Simpan
		</button>
		<button class="btn btn-info btn-lg" name="reset" type="reset">
			<i class="fa fa-times"></i> Reset
		</button>
	</div>
</div>
					
<?php echo form_close(); ?>