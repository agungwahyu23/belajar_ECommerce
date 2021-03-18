<?php 
  if($this->session->flashdata('sukses')) {
	  echo '<div class="alert alert-warning">';
	  echo $this->session->flashdata('sukses');
	  echo '</div>';
  } 
?>

<body class="hold-transition register-page">
	<div class="register-box">
		<div class="register-logo">
			<a href="../../index2.html"><b>Registrasi Pengguna</b></a>
		</div>

		<div class="card">
			<div class="card-body register-card-body">
				<p class="login-box-msg">Register a new user</p>

				<?php
          //display eror
          echo validation_errors('<div class="alert alert-warning">', '</div>');

          // form open
          echo form_open(base_url('registrasi'), 'class="leave-comment"'); 
        ?>

				<div class="input-group mb-3">
					<input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap"
						value="<?php echo set_value('nama_pelanggan')?>" required>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="email" name="email" class="form-control" placeholder="Email"
						value="<?php echo set_value('email')?>" required>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" name="password" class="form-control" placeholder="Password"
						value="<?php echo set_value('password')?>" required>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="text" name="telepon" class="form-control" placeholder="Telepon"
						value="<?php echo set_value('telepon')?>" required>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-phone"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<textarea name="alamat" class="form-control"
						placeholder="Alamat"> <?php echo set_value('alamat') ?></textarea>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-map"></span>
						</div>
					</div>
				</div>

				<div class="social-auth-links text-center">
					<button class="btn btn-block btn-primary" type="submit">
						<i class="fa fa-save"></i> Register
					</button>
				</div>

				<a href="login.html" class="text-center">I already have an account</a>

        <?php echo form_close(); ?>
			</div>
			<!-- /.form-box -->
		</div><!-- /.card -->
	</div>
	<!-- /.register-box -->