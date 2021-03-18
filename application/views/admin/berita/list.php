
<p>
	<a href="<?= base_url('admin/berita/tambah') ?>" class="btn btn-success btn-lg">
		<i class="fa fa-plus"></i> Tambah Baru
	</a>
</p>


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
			<th>JENIS BERITA</th>
			<th>JUDUL BERITA</th>
			<th>STATUS BERITA</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($berita as $berita){ ?>
		<tr>
			<td><?= $no++ ?></td>
			<td>
				<img src="<?php echo base_url('assets/upload/image/thumbs/'.$berita->gambar) ?>" class="img img responsive img thumbnail" width="60">
			</td>
			<td><?= $berita->jenis_berita ?></td>
			<td><?= $berita->judul_berita ?></td>
			<td><?= $berita->status_berita ?></td>
			<td>
				<a href="<?= base_url('admin/berita/edit/'.$berita->id_berita) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>Edit</a>

				<a href="<?= base_url('admin/berita/delete/'.$berita->id_berita) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i>Hapus</a>
			</td>

		</tr>
		<?php } ?>
	</tbody>
</table>
					