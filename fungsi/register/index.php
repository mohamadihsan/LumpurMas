<?php
	/*========================= FORM REGISTER PEGAWAI ========================*/
	function FormRegister()
	{
		?>		
		<!-- Main content -->
		<section class="content">
			<!-- SELECT2 EXAMPLE -->
			<div class="box box-default">
			<div class="box-header with-border">
					<h3 class="box-title"><b>Buat Akun Baru</b></h3>
					<div class="box-tools pull-right">
		            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
					</div>
			</div>
			<form action="../../index.html" method="post">
				<div class="box-body">
		      		<div class="row">
    					<div class="col-md-8">
				      		<div class="form-group has-feedback">
				        		<input type="text" name="id_pegawai" class="form-control" placeholder="ID Pegawai">
				        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
				      		</div>
				      	</div>	
				      	<div class="col-md-12"></div>
    					<div class="col-md-8">	
				      		<div class="form-group has-feedback">
				        		<input type="text" name="nama" class="form-control" placeholder="Nama Pegawai">
				        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
				      		</div>
				      	</div>	
				      	<div class="col-md-12"></div>
    					<div class="col-md-8">	
      						<div class="form-group">
        						<select name="jabatan" class="form-control select2" style="width: 100%;">
          							<option selected="selected">Direktur</option>
				                  	<option value="pemasaran">Pemasaran</option>
				                  	<option value="inventori">Inventori</option>
				                  	<option value="administrasi">Administrasi</option>
				                </select>
      						</div>
  						</div>
   						<div class="col-md-12"></div>
    					<div class="col-md-8">	
				      		<div class="form-group has-feedback">
				        		<input type="text" name="username" class="form-control" placeholder="Username">
				        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				      		</div>
				      	</div>
					    <div class="col-md-12"></div>
    					<div class="col-md-8">	  		
				      		<div class="form-group has-feedback">
				        		<input type="password" name="password" class="form-control" placeholder="Password">
				        		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				      		</div>
				      	</div>		
				      	<div class="col-md-12"></div>
		        		<div class="col-md-8">
		          			<button type="submit" name="buat_akun" class="btn btn-primary btn-block btn-flat">Buat Akun</button>
		        		</div>	
		      		</div>
		      	</div>	
	    	</form>
				
			<div class="box-footer">
          		
			</div>
			</div>
		</section>					
		<?php
	}

	/*========================= FORM REGISTER PENGUNJUNG ========================*/
	function FormRegisterPengunjung(){
		?>
		<!-- Main content -->
		<section class="content">
			<!-- SELECT2 EXAMPLE -->
			<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Buat Akun Baru</b></h3>
				<div class="box-tools pull-right">
	            	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            	<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
				</div>
			</div>
			<form action="../../index.html" method="post">
				<div class="box-body">
		      		<div class="row">
    					<div class="col-md-8">
				      		<div class="form-group has-feedback">
				        		<input type="text" name="id_pegawai" class="form-control" placeholder="ID Pegawai">
				        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
				      		</div>
				      	</div>	
				      	<div class="col-md-12"></div>
    					<div class="col-md-8">	
				      		<div class="form-group has-feedback">
				        		<input type="text" name="nama" class="form-control" placeholder="Nama Pegawai">
				        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
				      		</div>
				      	</div>	
				      	<div class="col-md-12"></div>
    					<div class="col-md-8">	
				      		<div class="form-group has-feedback">
				        		<input type="text" name="username" class="form-control" placeholder="Username">
				        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				      		</div>
				      	</div>
					    <div class="col-md-12"></div>
    					<div class="col-md-8">	  		
				      		<div class="form-group has-feedback">
				        		<input type="password" name="password" class="form-control" placeholder="Password">
				        		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				      		</div>
				      	</div>		
				      	<div class="col-md-12"></div>
		        		<div class="col-md-8">
		          			<button type="submit" name="buat_akun" class="btn btn-primary btn-block btn-flat">Buat Akun</button>
		        		</div>	
		      		</div>
		      	</div>	
	    	</form>
				
			<div class="box-footer">
          		
			</div>
			</div>
		</section>	
		<?php
	}
?>