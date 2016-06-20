<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include '../login/check_login_pegawai.php';
	include '../../fungsi/sidebar/index.php';
	include '../../fungsi/rekomendasi/index.php';

	if (empty($_SESSION['username']) OR empty($_SESSION['jabatan'])) {
		header('location:../login/');
	}

	Sidebar();
	
	?>

	<title>Analisa Rekomendasi</title>

	<section class="content-header">
      	<h1>
        	Analisa Rekomendasi
        	<small></small>
      	</h1>
      	<ol class="breadcrumb">
      		<li><a href="../rekomendasi/"><i class="fa fa-trophy"></i> Rekomendasi</a></li>
        	<li class="active"><i class="fa fa-trophy"></i> Analisa Rekomendasi</li>
      	</ol>
	</section>

	<?php
		//jika pegawai pemasaran yang masuk
		if (!empty($user_check) AND $jabatan == "pemasaran" OR $jabatan == "manager" OR $jabatan == "direktur") {
			?>
			<!-- Main content -->
		    <section class="content">
		      	<div class="row">
		        	<div class="col-xs-12">
						<div class="box">
		            		<div class="box-header with-border">
		              			<h3 class="box-title"></h3>
		            		</div>
				            <!-- /.box-header -->
				            <div class="box-body">
				            	<form method="post" action="">
					            	<div class="form-group">
					            		<div class="col-md-12"><label>Lihat Rekomendasi untuk :</label></div>
					            		<div class="col-md-5">
						            		<select class="form-control select2" style="width: 100%;" name="pelanggan_rekomendasi" required>
		                                        <option selected="selected">Pilih Nama Pelanggan</option>
		                                        <?php
		                                        	//Tampilkan Pelanggan Transaksi 
													$sql = "SELECT DISTINCT nama_garansi FROM transaksi";
													$stmt = $db->prepare($sql);
	                                                $stmt->execute();

	                                                $stmt->bind_result($nama_rek);
		                                        	while ($stmt->fetch()) {
														?>
		                                                    <option value="<?php echo $nama_rek;?>">
		                                                    	<?php echo $nama_rek;?>
		                                                    </option>
		                                                <?php
													}
													$stmt->close();
		                                        ?>
		                                    </select>  
		                                </div>  
		                                <div class="col-md-2">
		                                	<input type="submit" name="lihat_rekomendasi" value="Lihat Rekomendasi" class="btn btn-primary">
		                                </div>    
					            	</div>	
					            </form>	
					            <div class="col-md-1">
					            	<p style="color: grey; vertical-align: middle;">atau</p>
                                </div>
					            <form method="post" action="">
					            	<div class="col-md-4">
						            	<div class="form-group">
						            		<input type="submit" name="analisa" value="Analisa Rekomendasi Seluruh Pelanggan" class="btn btn-success">
						            	</div>
						            </div>	
					            </form>
					            <br><br><br><br><br><br>
					            
					            <?php  
					            if(isset($_POST['lihat_rekomendasi'])OR isset($_POST['analisa'])){
					            	 
				            		if (isset($_POST['analisa'])) {
				            			$sql_seluruh_nama = "SELECT DISTINCT nama_garansi FROM transaksi";
										$result_seluruh_nama = mysqli_query($db, $sql_seluruh_nama);
										$s=0;
										while ($row_seluruh_nama = mysqli_fetch_array($result_seluruh_nama, MYSQLI_ASSOC)) {
											$seluruh_nama[$s] = $row_seluruh_nama['nama_garansi'];
											$s++;
										}
									}
									if(isset($_POST['analisa'])) {
									for($k=0;$k<$s;$k++){
										$nama_rekomendasi = $seluruh_nama[$k];

										$sql_nama = "SELECT DISTINCT nama_garansi FROM transaksi WHERE nama_garansi!='$nama_rekomendasi'";
										$result_nama = mysqli_query($db, $sql_nama);
										$i=0;
										while ($row_nama = mysqli_fetch_array($result_nama, MYSQLI_ASSOC)) {
											$nama[$i] = $row_nama['nama_garansi'];
											$i++;
										}
					            		?>
							            <div class="col-md-12">
								            <fieldset>
								            	<legend><h2>Analisa</h2></legend>
								            </fieldset>
							            </div>
				            			<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>Nama Pelanggan</th>
													<th>Dibandingkan dengan</th>
													<th>Nilai Sim</th>
													<?php
														//Tampilkan Data Kategori 
														$sql_kategori = "SELECT nama_kategori FROM kategori_produk WHERE status_hapus='1' ORDER BY nama_kategori ASC";
														$result_kategori = mysqli_query($db, $sql_kategori);
														$jml_kategori = mysqli_num_rows($result_kategori);
														$j=0;
														while ($row_kategori = mysqli_fetch_array($result_kategori, MYSQLI_ASSOC)) {
															$nama_kate[$j] = $row_kategori['nama_kategori'];
															?>
															<th><?php echo $nama_kate[$j]; ?></th>
															<?php
															$j++;
														}
													?>
												</tr>
											</thead>
											<tbody>
												<?php
												$z=0;
												$c=0;
												$y=0;
												//pembanding
												while ($y <= $i-1) {
													if ($nama_rekomendasi==$nama[$y]) {
														$y++;
													}
													if ($nama[$y]!=null) {
														$sql1 = "CREATE OR REPLACE VIEW v_produk_dibeli AS SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama_rekomendasi."' OR produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$y]."' AND kategori_produk.nama_kategori NOT IN (SELECT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama_rekomendasi."' AND kategori_produk.nama_kategori NOT IN (SELECT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$y]."')) ORDER BY nama_kategori ASC";

														$result1 = mysqli_query($db, $sql1);

														$sql2 = "SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama_rekomendasi."' AND kategori_produk.nama_kategori IN (SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$y]."') ORDER BY nama_kategori ASC";

														$result2 = mysqli_query($db, $sql2);
														$jml_produk = mysqli_num_rows($result2);

														if ($jml_produk<=0) {
															$sql = "SELECT * FROM v_produk_dibeli ORDER BY nama_kategori ASC";
														}else{
															//select/mencari barang yang tidak sama dibeli 
															$sql = "SELECT * FROM v_produk_dibeli WHERE nama_kategori NOT IN (SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama_rekomendasi."' AND kategori_produk.nama_kategori IN (SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$y]."')) ORDER BY nama_kategori ASC";
														}

														$result = mysqli_query($db, $sql);
														
														$sim[$z] = mysqli_num_rows($result);
														//hitung similarity
														$nilai_sim[$z] = 1/(1+$sim[$z]);
														
														?>
														<tr>
															<td><?php echo $nama_rekomendasi; ?></td>
															<td><?php echo $nama[$y]; ?></td>
															<td><?php echo round($nilai_sim[$z],2); ?></td>
															<?php
															
															$n=0;
															while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
																$nama_kate_pro[$c][$n] = $row['nama_kategori'];
																$n++;
															}
															$f=0;
															$g=0;
															for($j=0;$j<$sim[$z];$j++){

																if ($f==0) {
																	if ($nama_kate_pro[$c][$j]==$nama_kate[0]) {
																		?>
																			<td>
																				<?php 
																					$temp_sim[$c][$j] = $nilai_sim[$z]*1;
																					$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																					$AO[$c] = $temp_sim[$c][$j]; 
																					echo round($temp_sim[$c][$j], 2);$g++;
																				?>
																			</td>
																		<?php
																	}else{
																		?>
																			<td>
																				<?php  
																					$temp_sim[$c][$j] = $nilai_sim[$z]*0;
																					$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																					$AO[$c] = $temp_sim[$c][$j];
																					echo round($temp_sim[$c][$j], 2);$f++;$g++;
																				?>
																			</td>
																		<?php
																	}
																}
																
																if ($f==1) {
																	if ($nama_kate_pro[$c][$j]==$nama_kate[1]) {
																		?>
																			<td>
																				<?php 
																					$temp_sim[$c][$j] = $nilai_sim[$z]*1;
																					$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																					$AP[$c] = $temp_sim[$c][$j]; 
																					echo round($temp_sim[$c][$j], 2);$g++; 
																				?>
																			</td>
																		<?php
																	}else{
																		?>
																			<td>
																				<?php 
																					$temp_sim[$c][$j] = $nilai_sim[$z]*0;
																					$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																					$AP[$c] = $temp_sim[$c][$j]; 
																					echo round($temp_sim[$c][$j], 2);$f++;$g++;	 
																				?>
																			</td>
																		<?php
																	}
																}

																if ($f==2) {
																	if ($nama_kate_pro[$c][$j]==$nama_kate[2]) {
																		?>
																			<td>
																				<?php
																					$temp_sim[$c][$j] = $nilai_sim[$z]*1;
																					$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																					$ATK[$c] = $temp_sim[$c][$j]; 
																					echo round($temp_sim[$c][$j], 2);$g++; 
																				?>
																			</td>
																		<?php
																	}else{
																		?>
																			<td>
																				<?php 
																					$temp_sim[$c][$j] = $nilai_sim[$z]*0;
																					$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																					$ATK[$c] = $temp_sim[$c][$j]; 
																					echo round($temp_sim[$c][$j], 2);$f++;$g++;
																				?>
																			</td>
																		<?php
																	}
																}

																if ($f==3) {
																	if ($nama_kate_pro[$c][$j]==$nama_kate[3]) {
																		?>
																			<td>
																				<?php
																					$temp_sim[$c][$j] = $nilai_sim[$z]*1;
																					$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																					$BS[$c] = $temp_sim[$c][$j];  
																					echo round($temp_sim[$c][$j], 2);$g++; 
																				?>
																			</td>
																		<?php
																	}else{
																		?>
																			<td>
																				<?php 
																					$temp_sim[$c][$j] = $nilai_sim[$z]*0;
																					$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																					$BS[$c] = $temp_sim[$c][$j]; 
																					echo round($temp_sim[$c][$j], 2);$f++;$g++; 
																				?>
																			</td>
																		<?php
																	}
																}

																if ($f==4) {
																	if ($nama_kate_pro[$c][$j]==$nama_kate[4]) {
																		?>
																			<td>
																				<?php 
																					$temp_sim[$c][$j] = $nilai_sim[$z]*1;
																					$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																					$NOV[$c] = $temp_sim[$c][$j]; 
																					echo round($temp_sim[$c][$j], 2);$g++;
																				?>
																			</td>
																		<?php
																	}else{
																		?>
																			<td>
																				<?php 
																					$temp_sim[$c][$j] = $nilai_sim[$z]*0;
																					$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																					$NOV[$c] = $temp_sim[$c][$j]; 
																					echo round($temp_sim[$c][$j], 2);$f++;$g++; 
																				?>
																			</td>
																		<?php
																	}
																}	
																$f++;
															}

															while ($g<$jml_kategori) {
																$NOV[$c] = $temp_sim[$c][$g];
																?>
																	<td><?php echo $nilai_sim[$z]*0;$g++; ?></td>
																<?php
															} ?>
														</tr>	
														<?php
														$c++;
														$y++;	
														$z++;
													}	
												} ?>
											</tbody>
											<thead>
												<tr>
													<td colspan="2" align="right"><b>JML SIM</b></td>
													<td colspan="<?php echo $jml_kategori+1; ?>">
														<?php 
															$i=0;
															while ($i < $c-1) {
																$nilai_sim[$i+1] = $nilai_sim[$i] + $nilai_sim[$i+1];	
																$i++;
															}
															 echo round($nilai_sim[$i],2);
														?>
													</td>
												</tr>
												<tr>
													<td colspan="3" align="right"><b>TOTAL</b></td>
													<td>
														<?php 
															for($i=0;$i<$c-1;$i++){
																$AO[$i+1] = $AO[$i]+$AO[$i+1];
															}
															$hasil_AO = $AO[$i]/$nilai_sim[$i];
															echo round($AO[$i],2); 
														?>
													</td>
													<td>
														<?php 
															for($i=0;$i<$c-1;$i++){
																$AP[$i+1] = $AP[$i]+$AP[$i+1];
															}
															$hasil_AP = $AP[$i]/$nilai_sim[$i];
															echo round($AP[$i],2); 
														?>
													</td>
													<td>
														<?php 
															for($i=0;$i<$c-1;$i++){
																$ATK[$i+1] = $ATK[$i]+$ATK[$i+1];
															}
															$hasil_ATK = $ATK[$i]/$nilai_sim[$i];
															echo round($ATK[$i],2); 
														?>
													</td>
													<td>
														<?php 
															for($i=0;$i<$c-1;$i++){
																$BS[$i+1] = $BS[$i]+$BS[$i+1];
															}
															$hasil_BS = $BS[$i]/$nilai_sim[$i];
															echo round($BS[$i],2); 
														?>
													</td>
													<td>
														<?php 
															for($i=0;$i<$c-1;$i++){
																if ($i>=0) {
																	$NOV[$i+1] = $NOV[$i]+$NOV[$i+1];
																}else{
																	$NOV[$i+1] = $NOV[$i]+$NOV[$i+2];
																}
															}
															$hasil_NOV = $NOV[$i]/$nilai_sim[$i];
															echo round($NOV[$i],2); 
														?>
													</td>
												</tr>
												<tr>
													<td colspan="3" align="right"><b>TOTAL / JML SIM</b></td>
													<td><?php echo round($hasil_AO,2); ?></td>
													<td><?php echo round($hasil_AP,2); ?></td>
													<td><?php echo round($hasil_ATK,2); ?></td>
													<td><?php echo round($hasil_BS,2); ?></td>
													<td><?php echo round($hasil_NOV,2); ?></td>
												</tr>
											</thead>
										</table>
										<div class="col-md-12">
								            <fieldset>
								            	<?php
								            		if (($hasil_AO >= $hasil_AP)AND($hasil_AO >= $hasil_ATK)AND($hasil_AO >= $hasil_BS)AND($hasil_AO >= $hasil_NOV)) {
								            			$hasil = "Alat Olahraga";
								            		}else if (($hasil_AP >= $hasil_AO)AND($hasil_AP >= $hasil_ATK)AND($hasil_AP >= $hasil_BS)AND($hasil_AP >= $hasil_NOV)) {
								            			$hasil = "Alat Peraga";
								            		}else if (($hasil_ATK >= $hasil_AO)AND($hasil_ATK >= $hasil_AP)AND($hasil_ATK >= $hasil_BS)AND($hasil_ATK >= $hasil_NOV)) {
								            			$hasil = "ATK";
								            		}else if (($hasil_BS >= $hasil_AO)AND($hasil_BS >= $hasil_AP)AND($hasil_BS >= $hasil_ATK)AND($hasil_BS >= $hasil_NOV)) {
								            			$hasil = "Buku Sekolah";
								            		}else if (($hasil_NOV >= $hasil_AO)AND($hasil_NOV >= $hasil_AP)AND($hasil_NOV >= $hasil_ATK)AND($hasil_NOV >= $hasil_BS)) {
								            			$hasil = "Novel";
								            		}
								            	?>
								            	<legend><h2><font color="green">Hasil Analisa</font></h2></legend>
								            	<p>Kategori Produk yang direkomendasi untuk <b><font color="green"><?php echo strtoupper($nama_rekomendasi); ?></font></b> adalah <b><?php echo strtoupper($hasil); ?></b></p><br><br><br>
								            </fieldset>
							            </div>
					            		<?php
					            		if (isset($_POST['analisa'])) {
					            			$sql = "SELECT DISTINCT telp_garansi FROM transaksi WHERE nama_garansi='$nama_rekomendasi' ORDER BY telp_garansi LIMIT 1";							
											$stmt = $db->prepare($sql);
											$stmt->execute();

											$stmt->bind_result($no_telp);
											$stmt->fetch();
											$stmt->close();

											if($k==0){
												$sts_krm = "BD";
												$sql = "DELETE FROM rekomendasi WHERE status_kirim = ?";
												$stmt = $db->prepare($sql);
												$stmt->bind_param('s', $sts_krm);
												$stmt->execute();
												$stmt->close();
											}

											$sql = "INSERT INTO rekomendasi (nama, no_telp, kategori_produk) VALUES(?, ?, ?)";
											$stmt = $db->prepare($sql);
											$stmt->bind_param('sss', $nama_rekomendasi, $no_telp, $hasil);
											if($stmt->execute()){
												$stmt->insert_id;
												?><body onload="BerhasilMengalisa()"><?php
											}else{
												?> <body onload="GagalMenganalisa()"></body><?php
											}
											$stmt->close();
					            		}
					            	}
					            	}else if (isset($_POST['lihat_rekomendasi'])) {

				            			$nama_rekomendasi = $_POST['pelanggan_rekomendasi'];

				            			$sql_nama = "SELECT DISTINCT nama_garansi FROM transaksi WHERE nama_garansi!='$nama_rekomendasi'";
										$result_nama = mysqli_query($db, $sql_nama);
										$i=0;
										while ($row_nama = mysqli_fetch_array($result_nama, MYSQLI_ASSOC)) {
											$nama[$i] = $row_nama['nama_garansi'];
											$i++;
										}
					            		?>
					            		<div class="col-md-12">
								            <fieldset>
								            	<legend><h2>Analisa</h2></legend>
								            </fieldset>
							            </div>
				            			<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>Nama Pelanggan</th>
													<th>Dibandingkan dengan</th>
													<th>Nilai Sim</th>
													<?php
														//Tampilkan Data Kategori 
														$sql_kategori = "SELECT nama_kategori FROM kategori_produk WHERE status_hapus='1' ORDER BY nama_kategori ASC";
														$result_kategori = mysqli_query($db, $sql_kategori);
														$jml_kategori = mysqli_num_rows($result_kategori);
														$j=0;
														while ($row_kategori = mysqli_fetch_array($result_kategori, MYSQLI_ASSOC)) {
															$nama_kate[$j] = $row_kategori['nama_kategori'];
															?>
															<th><?php echo $nama_kate[$j]; ?></th>
															<?php
															$j++;
														}
													?>
												</tr>
											</thead>
											<tbody>
												<?php
												$z=0;
												$c=0;
												$y=0;
												//pembanding
												while ($y <= $i-1) {
													if ($nama_rekomendasi==$nama[$y]) {
														$y++;
													}
													if ($nama[$y]!=null) {
														$sql1 = "CREATE OR REPLACE VIEW v_produk_dibeli AS SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama_rekomendasi."' OR produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$y]."' AND kategori_produk.nama_kategori NOT IN (SELECT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama_rekomendasi."' AND kategori_produk.nama_kategori NOT IN (SELECT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$y]."'))";

														$result1 = mysqli_query($db, $sql1);

														$sql2 = "SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama_rekomendasi."' AND kategori_produk.nama_kategori IN (SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$y]."')";

														$result2 = mysqli_query($db, $sql2);
														$jml_produk = mysqli_num_rows($result2);

														if ($jml_produk<=0) {
															$sql = "SELECT nama_kategori FROM v_produk_dibeli ORDER BY nama_kategori ASC";
														}else{
															//select/mencari barang yang tidak sama dibeli 
															$sql = "SELECT * FROM v_produk_dibeli WHERE nama_kategori NOT IN (SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama_rekomendasi."' AND kategori_produk.nama_kategori IN (SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$y]."')) ORDER BY nama_kategori ASC";
														}

														$result = mysqli_query($db, $sql);
														
														$sim[$z] = mysqli_num_rows($result);
														//hitung similarity
														$nilai_sim[$z] = 1/(1+$sim[$z]);
														
															?>
															<tr>
																<td><?php echo $nama_rekomendasi; ?></td>
																<td><?php echo $nama[$y]; ?></td>
																<td><?php echo round($nilai_sim[$z],2); ?></td>
																<?php
																
																$n=0;
																while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
																	$nama_kate_pro[$c][$n] = $row['nama_kategori'];
																	$n++;
																}
																$f=0;
																$g=0;
																for($j=0;$j<$sim[$z];$j++){

																	if ($f==0) {
																		if ($nama_kate_pro[$c][$j]==$nama_kate[0]) {
																			?>
																				<td>
																					<?php 
																						$temp_sim[$c][$j] = $nilai_sim[$z]*1;
																						$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																						$AO[$c] = $temp_sim[$c][$j]; 
																						echo round($temp_sim[$c][$j], 2);$g++;
																					?>
																				</td>
																			<?php
																		}else{
																			?>
																				<td>
																					<?php  
																						$temp_sim[$c][$j] = $nilai_sim[$z]*0;
																						$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																						$AO[$c] = $temp_sim[$c][$j];
																						echo round($temp_sim[$c][$j], 2);$f++;$g++;
																					?>
																				</td>
																			<?php
																		}
																	}
																	
																	if ($f==1) {
																		if ($nama_kate_pro[$c][$j]==$nama_kate[1]) {
																			?>
																				<td>
																					<?php 
																						$temp_sim[$c][$j] = $nilai_sim[$z]*1;
																						$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																						$AP[$c] = $temp_sim[$c][$j]; 
																						echo round($temp_sim[$c][$j], 2);$g++; 
																					?>
																				</td>
																			<?php
																		}else{
																			?>
																				<td>
																					<?php 
																						$temp_sim[$c][$j] = $nilai_sim[$z]*0;
																						$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																						$AP[$c] = $temp_sim[$c][$j]; 
																						echo round($temp_sim[$c][$j], 2);$f++;$g++;	 
																					?>
																				</td>
																			<?php
																		}
																	}

																	if ($f==2) {
																		if ($nama_kate_pro[$c][$j]==$nama_kate[2]) {
																			?>
																				<td>
																					<?php
																						$temp_sim[$c][$j] = $nilai_sim[$z]*1;
																						$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																						$ATK[$c] = $temp_sim[$c][$j]; 
																						echo round($temp_sim[$c][$j], 2);$g++; 
																					?>
																				</td>
																			<?php
																		}else{
																			?>
																				<td>
																					<?php 
																						$temp_sim[$c][$j] = $nilai_sim[$z]*0;
																						$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																						$ATK[$c] = $temp_sim[$c][$j]; 
																						echo round($temp_sim[$c][$j], 2);$f++;$g++;
																					?>
																				</td>
																			<?php
																		}
																	}

																	if ($f==3) {
																		if ($nama_kate_pro[$c][$j]==$nama_kate[3]) {
																			?>
																				<td>
																					<?php
																						$temp_sim[$c][$j] = $nilai_sim[$z]*1;
																						$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																						$BS[$c] = $temp_sim[$c][$j];  
																						echo round($temp_sim[$c][$j], 2);$g++; 
																					?>
																				</td>
																			<?php
																		}else{
																			?>
																				<td>
																					<?php 
																						$temp_sim[$c][$j] = $nilai_sim[$z]*0;
																						$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																						$BS[$c] = $temp_sim[$c][$j]; 
																						echo round($temp_sim[$c][$j], 2);$f++;$g++;$g++;$g++; 
																					?>
																				</td>
																			<?php
																		}
																	}

																	if ($f==4) {
																		if ($nama_kate_pro[$c][$j]==$nama_kate[4]) {
																			?>
																				<td>
																					<?php 
																						$temp_sim[$c][$j] = $nilai_sim[$z]*1;
																						$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																						$NOV[$c] = $temp_sim[$c][$j]; 
																						echo round($temp_sim[$c][$j], 2);$g++;$g++; 
																					?>
																				</td>
																			<?php
																		}else{
																			?>
																				<td>
																					<?php 
																						$temp_sim[$c][$j] = $nilai_sim[$z]*0;
																						$jml_sim[$c][$j] = $jml_sim[$c][$j]+$temp_sim[$c][$j];
																						$NOV[$c] = $temp_sim[$c][$j]; 
																						echo round($temp_sim[$c][$j], 2);$f++;$g++; 
																					?>
																				</td>
																			<?php
																		}
																	}	
																	$f++;
																}

																while ($g<$jml_kategori) {
																	?>
																		<td><?php echo $nilai_sim[$z]*0;$g++; ?></td>
																	<?php
																} ?>

															</tr>	
															<?php
														$c++;
														$y++;	
														$z++;
													}	
												} ?>
											</tbody>
											<thead>
												<tr>
													<td colspan="2" align="right"><b>JML SIM</b></td>
													<td colspan="<?php echo $jml_kategori+1; ?>">
														<?php 
															$i=0;
															while ($i < $c-1) {
																$nilai_sim[$i+1] = $nilai_sim[$i] + $nilai_sim[$i+1];	
																$i++;
															}
															 echo round($nilai_sim[$i],2);
														?>
													</td>
												</tr>
												<tr>
													<td colspan="3" align="right"><b>TOTAL</b></td>
													<td>
														<?php 
															for($i=0;$i<$c;$i++){
																$AO[$i+1] = $AO[$i]+$AO[$i+1];
															}
															$hasil_AO = $AO[$i-1]/$nilai_sim[$i-1];
															echo round($AO[$i],2); 
														?>
													</td>
													<td>
														<?php 
															for($i=0;$i<$c;$i++){
																$AP[$i+1] = $AP[$i]+$AP[$i+1];
															}
															$hasil_AP = $AP[$i-1]/$nilai_sim[$i-1];
															echo round($AP[$i],2); 
														?>
													</td>
													<td>
														<?php 
															for($i=0;$i<$c;$i++){
																$ATK[$i+1] = $ATK[$i]+$ATK[$i+1];
															}
															$hasil_ATK = $ATK[$i-1]/$nilai_sim[$i-1];
															echo round($ATK[$i],2); 
														?>
													</td>
													<td>
														<?php 
															for($i=0;$i<$c;$i++){
																$BS[$i+1] = $BS[$i]+$BS[$i+1];
															}
															$hasil_BS = $BS[$i-1]/$nilai_sim[$i-1];
															echo round($BS[$i],2); 
														?>
													</td>
													<td>
														<?php 
															for($i=0;$i<$c;$i++){
																$NOV[$i+1] = $NOV[$i]+$NOV[$i+1];
															}
															$hasil_NOV = $NOV[$i-1]/$nilai_sim[$i-1];
															echo round($NOV[$i],2); 
														?>
													</td>
												</tr>
												<tr>
													<td colspan="3" align="right"><b>TOTAL / JML SIM</b></td>
													<td><?php echo round($hasil_AO,2); ?></td>
													<td><?php echo round($hasil_AP,2); ?></td>
													<td><?php echo round($hasil_ATK,2); ?></td>
													<td><?php echo round($hasil_BS,2); ?></td>
													<td><?php echo round($hasil_NOV,2); ?></td>
												</tr>
											</thead>
										</table>
										<div class="col-md-12">
								            <fieldset>
								            	<?php
								            		if (($hasil_AO >= $hasil_AP)AND($hasil_AO >= $hasil_ATK)AND($hasil_AO >= $hasil_BS)AND($hasil_AO >= $hasil_NOV)) {
								            			$hasil = "Alat Olahraga";
								            		}else if (($hasil_AP >= $hasil_AO)AND($hasil_AP >= $hasil_ATK)AND($hasil_AP >= $hasil_BS)AND($hasil_AP >= $hasil_NOV)) {
								            			$hasil = "Alat Peraga";
								            		}else if (($hasil_ATK >= $hasil_AO)AND($hasil_ATK >= $hasil_AP)AND($hasil_ATK >= $hasil_BS)AND($hasil_ATK >= $hasil_NOV)) {
								            			$hasil = "ATK";
								            		}else if (($hasil_BS >= $hasil_AO)AND($hasil_BS >= $hasil_AP)AND($hasil_BS >= $hasil_ATK)AND($hasil_BS >= $hasil_NOV)) {
								            			$hasil = "Buku Sekolah";
								            		}else if (($hasil_NOV >= $hasil_AO)AND($hasil_NOV >= $hasil_AP)AND($hasil_NOV >= $hasil_ATK)AND($hasil_NOV >= $hasil_BS)) {
								            			$hasil = "Novel";
								            		}
								            	?>
								            	<legend><h2><font color="green">Hasil Analisa</font></h2></legend>
								            	<p>Kategori Produk yang direkomendasi untuk <b><font color="green"><?php echo strtoupper($nama_rekomendasi); ?></font></b> adalah <b><?php echo strtoupper($hasil); ?></b></p>
								            </fieldset>
							            </div>
					            		<?php
					            	}
					            }	
					            ?>
							</div>	
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->	
			</section>
		<?php
		}else{
			//alihkan url jika bukan pegawai pemasaran
			?><meta http-equiv="refresh" content="0;url=../login/"><?php
		}

		CloseSidebar();
	?>