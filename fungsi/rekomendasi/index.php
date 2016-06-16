<?php
	// =================== SELECT JUMLAH PEMBELIAN DARI TRANSAKSI ==================
	function HapusDataRekomendasi(){

		include '../../koneksi/koneksi.php';
		
		$status_kirim = "BD";
		$sql = "DELETE FROM rekomendasi WHERE status_kirim = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('s', $status_kirim);
		if($stmt->execute()){
			$_SESSION['status_operasi_rek'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_rek'] = "gagal_menghapus";
		}
		$stmt->close();
	}
?>