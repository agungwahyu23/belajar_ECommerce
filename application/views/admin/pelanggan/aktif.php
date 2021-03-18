    <?php if($pelanggan->status_pelanggan=="Pending") { ?>
        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#aktif-<?php echo $pelanggan->id_pelanggan ?>"><i class="fa fa-trash-o"></i> Aktifkan
        </button>

        <div class="modal fade" id="aktif-<?php echo $pelanggan->id_pelanggan ?>">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h4 class="modal-title text-center">AKTIFKAN DATA RESELLER</h4>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        					<span aria-hidden="true">&times;</span>
        				</button>
        			</div>
        			<div class="modal-body">
        				<div class="callout callout-warning">
        					<h4>Peringatann!</h4>
        					Yakin ingin mengaktifkan data ini? 
        				</div>
        			</div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
        				<a href="<?php echo base_url('admin/pelanggan/aktif/'.$pelanggan->id_pelanggan) ?>">Ya,
        					Aktifkan</a>
        			</div>
        		</div>
        		<!-- /.modal-content -->
        	</div>
        	<!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    <?php }else{ ?>
        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#nonaktif-<?php echo $pelanggan->id_pelanggan ?>"><i class="fa fa-trash-o"></i> Non Aktifkan
        </button>

        <div class="modal fade" id="nonaktif-<?php echo $pelanggan->id_pelanggan ?>">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h4 class="modal-title text-center">NONAKTIFKAN DATA RESELLER</h4>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        					<span aria-hidden="true">&times;</span>
        				</button>
        			</div>
        			<div class="modal-body">
        				<div class="callout callout-warning">
        					<h4>Peringatann!</h4>
        					Yakin ingin menonaktifkan data ini? 
        				</div>
        			</div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
        				<a href="<?php echo base_url('admin/pelanggan/aktif/'.$pelanggan->id_pelanggan) ?>">Ya,
        					NonAktifkan</a>
        			</div>
        		</div>
        		<!-- /.modal-content -->
        	</div>
        	<!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
    <?php } ?>


