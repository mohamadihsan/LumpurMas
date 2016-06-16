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

	<title>Rekomendasi</title>

	<section class="content-header">
      	<h1>
        	Rekomendasi
        	<small></small>
      	</h1>
      	<ol class="breadcrumb">
        	<li><a href=""><i class="fa fa-trophy"></i> Rekomendasi</a></li>
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
					            		<div class="col-md-6">
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
		                                <div class="col-md-6">
		                                	<input type="submit" name="lihat_rekomendasi" value="Lihat Rekomendasi" class="btn btn-primary">
		                                </div>    
					            	</div>	
					            </form>	<br><br><br><br><br><br>
					            
					            <?php  
					            	if(isset($_POST['lihat_rekomendasi'])){
					            		$nama_rekomendasi = $_POST['pelanggan_rekomendasi'];

					            		//Tampilkan Pelanggan Transaksi 
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
												//orang yang dibanding
												
													$y=0;
													//pembanding
													while ($y <= $i-1) {
														if ($nama_rekomendasi==$nama[$y]) {
															$y++;
														}
														if ($nama[$y]!=null) {
															//select/mencari barang yang tidak sama dibeli 
															$sql = "SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama_rekomendasi."' OR produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$y]."' AND kategori_produk.nama_kategori NOT IN (SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama_rekomendasi."' AND kategori_produk.nama_kategori NOT IN (SELECT DISTINCT kategori_produk.nama_kategori FROM kategori_produk, produk, detail_transaksi, transaksi WHERE produk.id_kategori=kategori_produk.id_kategori AND detail_transaksi.id_produk=produk.id_produk AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND transaksi.nama_garansi='".$nama[$y]."')) ORDER BY kategori_produk.nama_kategori ASC";

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
																		
																		/*for($k=0;$k<$sim[$z];$k++){

																			if ($nama_kate[$j]==$nama_kate_pro[$k]) {
																				$perkalian_sim[$j] = $nilai_sim[$z]*1;
																			}else{
																				
																			}	
																		}
																		?>
																			<td><?php echo $perkalian_sim[$j]; ?></td>
																		<?php*/

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
																/*$jml_sim[$i+1][0]=$jml_sim[$i][0]+ $jml_sim[$i+1][0];*/
																$nilai_sim[$i+1] = $nilai_sim[$i] + $nilai_sim[$i+1];	
																$i++;
															}
															 /*echo round($jml_sim[$i][0],2);*/
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
										<br><br><br>
										<div class="col-md-12">
								            <fieldset>
								            	<legend><h2>Hasil Analisa</h2></legend>
								            	<?php
								            		//cek nilai tertinggi dari kategori produk untuk direkomendasikan
								            		/*if ($hasil_AO < $hasil_AP) {
								            			$rekomendasi = "Alat Peraga";
								            		}*/
								            	?>
								            	<p>Kategori Produk yang direkomendasi untuk <b><?php echo $nama_rekomendasi; ?></b> adalah <b></b></p>
								            </fieldset>
							            </div>
					            		<?php
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