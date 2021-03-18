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
	echo form_open_multipart(base_url('admin/berita/tambah'), ' class="form-horizontal"');
?>

<div class="form-group row">
	<label class="col-md-2 col-form-label control-label">Jenis Berita</label>
	<div class="col-md-5">
		<input type="text" name="jenis_berita" class="form-control" placeholder="Jenis Berita"
			value="<?php echo set_value('jenis_berita'); ?>" required>
	</div>
</div>
<div class="form-group row">
	<label class="col-md-2 col-form-label control-label">Judul Berita</label>
	<div class="col-md-5">
		<input type="text" name="judul_berita" class="form-control" placeholder="Judul Berita"
			value="<?php echo set_value('judul_berita'); ?>" required>
	</div>
</div>
<div class="form-group row">
	<label class="col-md-2 col-form-label control-label">Keterangan / Isi Berita</label>
	<div class="col-md-10">
		<textarea name="keterangan" class="form-control" placeholder="Keterangan / Isi Berita" id="editor"
			value="<?php echo set_value('keterangan'); ?>" required></textarea>
	</div>
</div>
<div class="form-group row">
	<label class="col-md-2 control-label">Keyword</label>
	<div class="col-md-10">
		<textarea name="keywords" class="form-control" placeholder="Keyword"
			value="<?php echo set_value('keywords'); ?>" required></textarea>
	</div>
</div>
<div class="form-group row">
	<label class="col-md-2 col-form-label control-label">Upload gambar berita</label>
	<div class="col-md-10">
		<input type="file" name="gambar" class="form-control" required="required">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-2 col-form-label control-label">Status berita</label>
	<div class="col-md-5">
		<select name="status_berita" class="form-control">
				<option value="Publish">Publikasikan</option>
				<option value="Draft">Simpan sebagai draft</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label"></label>
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