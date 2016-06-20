<?php

	// =================== KIRIM REKOMENDASI ==================
	function KirimRekomendasi(){

		include '../../koneksi/koneksi.php';

		$status_kirim = "SD";
		//update dari tabel rekomendasi
		$sql = "UPDATE rekomendasi SET status_kirim = ? WHERE id = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('si', $status_kirim, $id[$i]);
		if($stmt->execute()){
			$_SESSION['status_operasi_kirim_rek'] = "berhasil_mengirim";
		}else{
			$_SESSION['status_operasi_kirim_rek'] = "gagal_mengirim";
		}
		$stmt->close();		
	}

	// =================== HAPUS DATA REKOMENDASI ==================
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

	function HapusDataRekomendasiBelumDikirim(){

		include '../../koneksi/koneksi.php';

		$sql = "DELETE FROM rekomendasi WHERE status_kirim='BD'";
		$stmt = $db->prepare($sql);
		if($stmt->execute()){
			$_SESSION['status_operasi_rek'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_rek'] = "gagal_menghapus";
		}
		$stmt->close();
	}

	function HapusDataRekomendasiSudahDikirim(){

		include '../../koneksi/koneksi.php';

		$sql = "DELETE FROM rekomendasi WHERE status_kirim='SD'";
		$stmt = $db->prepare($sql);
		if($stmt->execute()){
			$_SESSION['status_operasi_rek'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_rek'] = "gagal_menghapus";
		}
		$stmt->close();
	}
?>