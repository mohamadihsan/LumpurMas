<?php

	/*========================= HAPUS DATA KELUHAN SARAN ========================*/
	function HapusDataKritikSaran()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id_kritiksaran = $_GET['id_kritiksaran'];

		//hapus dari tabel produk
		$sql = "DELETE FROM kritiksaran WHERE id_kritiksaran = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id_kritiksaran);
		if($stmt->execute()){
			$_SESSION['status_operasi_ks'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_ks'] = "gagal_menghapus";
		}
		$stmt->close();
	}
?>
