<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-<?php echo $pelanggan->id_pelanggan ?>">
	<i class="fa fa-trash-o"></i> Hapus
</button>

<div class="modal fade" id="modal-<?php echo $pelanggan->id_pelanggan ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">HAPUS DATA RESELLER</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="callout callout-warning">
                    <h4>Peringatann!</h4>
                    Yakin ingin menghapus data ini? Data yang telah dihapus tidak dapat dikembalikan
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
				<a href="<?php echo base_url('admin/pelanggan/delete/'.$pelanggan->id_pelanggan) ?>">Ya, Hapus</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
