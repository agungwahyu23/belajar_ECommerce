
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
			<th>NAMA</th>
			<th>STATUS</th>
			<th>EMAIL</th>
			<th>TELEPON</th>
            <th>ALAMAT</th>
            <th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach ($pelanggan as $pelanggan){ ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $pelanggan->nama_pelanggan ?></td>
			<td><?= $pelanggan->status_pelanggan ?></td>
			<td><?= $pelanggan->email ?></td>
            <td><?= $pelanggan->telepon ?></td>
			<td><?= $pelanggan->alamat ?></td>
			<td>
				<a href="<?= base_url('admin/pelanggan/detail/'.$pelanggan->id_pelanggan) ?>" class="btn btn-success btn-xs"><i class="fa fa-trash-o"></i>Detail</a>
				<?php include('delete.php') ?>

				<?php include('aktif.php')?>

				

			</td>

		</tr>
		<?php } ?>
	</tbody>
</table>
					