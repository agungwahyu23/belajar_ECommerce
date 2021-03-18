<?php
	//notif eror
	echo validation_errors('<div class="alert alert-warning">','</div>');

	//form open
	echo form_open(base_url('admin/kategori/tambah'), ' class="form-horizontal"');
?>

<div class="form-group row">
	<label class="col-md-2 col-form-label control-label">Nama Kategori</label>
	<div class="col-md-5">
		<input type="text" name="nama_kategori" class="form-control" placeholder="Nama kategori"
			value="<?php echo set_value('nama'); ?>" required>
	</div>
</div>
<div class="form-group row">
	<label class="col-md-2 col-form-label control-label">Urutan</label>
	<div class="col-md-5">
		<input type="number" name="urutan" class="form-control" placeholder="Urutan"
			value="<?php echo set_value('urutan'); ?>" required>
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