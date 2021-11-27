<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->icon = "fa-cubes";
		$this->load->model('M_pembelian');
		$this->load->model('M_penjualan');
		$this->load->model('M_kas');
		$this->load->model('M_bukubesar');
		$this->load->model('common');
		if ($this->session->userdata('status') != "login") {
			echo "<script>
                alert('Anda harus login terlebih dahulu');
                window.location.href = '" . base_url('Login') . "';
            </script>"; //Url Logi
		}
	}
	public function home()
	{
		$this->load->view("pages/home");
	}
	public function dashboard()
	{
		$param['pageInfo'] = "Dashboard";
	}
	public function form_tambahbarang()
	{
		$param['pageInfo'] = "Example Form";
		$this->template->load("pages/v_tambahbarang", $param);
	}
	public function table_barang()
	{
		$param['pageInfo'] = "Example Table";
		$param['barang'] = $this->M_transaksi->get_transaksi();
		$this->template->load("pages/v_transaksi", $param);
	}

	public function login()
	{
		$this->load->view("auth/login");
	}
	public function pembelian()
	{
		$param['pageInfo'] = "Pembelian Barang";
		$this->template->load("pembelian/v_pembelian", $param);
	}
	public function editpembelian()
	{
		$id = $this->uri->segment(3);
		$param['pageInfo'] = "Edit Pembelian Barang";
		$param['beli'] = $this->db->query("SELECT * FROM pembelian  WHERE kode_pembelian='$id'")->result();
		$param['detail'] = $this->db->get_where('detail_pembelian', ['kode_pembelian' => $id])->result_array();
		$this->template->load("pembelian/v_editpembelian", $param);
	}
	public function editpenjualan()
	{
		$id = $this->uri->segment(3);
		$param['pageInfo'] = "Edit Penjualan Barang";
		$param['jual'] = $this->db->query("SELECT * FROM penjualan  WHERE kode_penjualan='$id'")->result();
		$param['detail'] = $this->db->get_where('detail_penjualan', ['kode_penjualan' => $id])->result_array();
		$this->template->load("penjualan/v_editpenjualan", $param);
	}
	public function penjualan()
	{
		$param['pageInfo'] = "Penjualan Barang";
		$this->template->load("penjualan/v_penjualan", $param);
	}
	public function kas()
	{
		$param['pageInfo'] = "Kas";
		$this->template->load("kas/v_kas", $param);
	}
	public function vkas()
	{
		$kode_kas = $this->uri->segment(3);
		$param['edit'] = $this->db->query("SELECT * FROM kas WHERE kode_kas='$kode_kas'")->result();
		$param['pageInfo'] = "Edit Kas";
		$this->template->load("kas/v_editkas", $param);
	}

	public function tambah_kas()
	{
		$kode_kas = $this->M_kas->get_idkas();
		$this->M_kas->addKas($kode_kas);
		$this->M_bukubesar->addkasbukubesar($kode_kas);
		$this->session->set_flashdata('tambahkas', '<div class="alert alert-success" role="alert">kas Berhasil Disimpan :)</div>');
		redirect('Transaksi/listkas');
	}
	public function editkas()
	{
		$kode_kas = $this->input->post('kode_kas');
		$this->M_kas->updateKas($kode_kas);
		$bukuBesar = array(
			'tanggal' => $_POST['tanggal_kas'],
			'nominal' => $_POST['nominal'],
			'keterangan' => $_POST['keterangan']
		);
		$this->common->update('buku_besar', $bukuBesar, ['kode_transaksi' => $kode_kas]); //update buku besar

		$this->session->set_flashdata('editkas', '<div class="alert alert-warning" role="alert">kas Berhasil Di edit :)</div>');
		redirect('Transaksi/listkas');
	}
	public function hapuskas()
	{
		$kode_kas = $this->uri->segment(3);
		$this->M_kas->deleteKas($kode_kas);
		$this->db->delete('buku_besar', array('kode_transaksi' => $kode_kas));
		$this->session->set_flashdata('hapuskas', '<div class="alert alert-danger" role="alert">Kas Berhasil dihapus :)</div>');
		redirect('Transaksi/listkas');
	}
	public function listkas()
	{
		$param['pageInfo'] = "List Kas";
		$param['kas'] = $this->M_kas->listkas();
		$this->template->load("kas/v_listkas", $param);
	}
	public function addDetailPembelian()
	{
		$this->load->view("pembelian/loop-detail", ['now' => $_GET['counting'], 'start' => 0]);
	}
	public function addDetailPenjualan()
	{
		$this->load->view("penjualan/loop-detail", ['now' => $_GET['counting'], 'start' => 0]);
	}

	public function listpembelian()
	{
		$param['pageInfo'] = "List Pembelian Barang";
		$param['pembelian'] = $this->M_pembelian->listpembelian();
		$this->template->load("pembelian/v_listpembelian", $param);
	}



	public function listpenjualan()
	{

		$param['pageInfo'] = "List Penjualan Barang";
		$param['penjualan'] = $this->M_penjualan->listpenjualan();
		$this->template->load("penjualan/v_listpenjualan", $param);
	}

	public function aksipenjualan()
	{
		$total = 0;
		foreach ($_POST['subtotal'] as $value) {
			$total += $value;
		}
		$total_qty = 0;
		foreach ($_POST['qty'] as $value) {
			$total_qty += $value;
		}
		$total_bayar = $this->input->post('total_bayar');
		
		$potongan = $this->input->post('potongan');
		$kode_penjualan = $this->M_penjualan->get_kodepenjualan();
		$penjualan = array(
			'kode_penjualan' => $kode_penjualan,
			'tanggal_penjualan' => date('Y/m/d'),
			'total_qty' => $total_qty,
			'total_penjualan' => $total,
			'total_bayar' => $total_bayar,
			'potongan' => $potongan,
			'id_admin' => $this->session->userdata("id_admin"),
			'keterangan' => $_POST['keterangan2'],
		);
		$penjualanbukubesar = array(
			'kode_transaksi' => $kode_penjualan,
			'tipe' => 'penjualan',
			'tanggal' => date('Y/m/d'),
			'nominal' =>  $total,
			'jenis' => 'debit',
			'keterangan' => $_POST['keterangan2'],
		);
		$this->db->insert('penjualan', $penjualan); //insert ke tabel penjualan
		$this->db->insert('buku_besar', $penjualanbukubesar); //insert ke tabel buku besar
		$lasId = $this->M_penjualan->getLastId();

		//insert ke tabel detail_penjualan
		foreach ($_POST['kode_barang'] as $key => $value) {
			$data = [
				'kode_penjualan' => $lasId[0]['kode_penjualan'],
				'kode_barang' => $this->input->post('kode_barang')[$key],
				'qty' => $this->input->post('qty')[$key],
				'harga_satuan' => $this->input->post('harga_satuan')[$key],
				'keterangan' => $this->input->post('keterangan')[$key],
			];
			$this->db->insert('detail_penjualan', $data);
		}
		//update stok di tabel barang
		foreach ($_POST['kode_barang'] as $key => $value) {

			$kode_barang = $this->input->post('kode_barang')[$key];
			$qty = $this->input->post('qty')[$key];
			$this->db->query("UPDATE `barang` SET `stok`=stok-'$qty' WHERE kode_barang='$kode_barang'");
		}

		$this->cetak_struk(); //cetak struk
		$this->session->set_flashdata('tambahpenjualan', '<div class="alert alert-success" role="alert">Penjualan Berhasil Disimpan</div>');
		redirect('transaksi/penjualan');
	}


	public function deletepembelian()
	{
		$id = $this->uri->segment(3);
		$this->db->delete('pembelian', array('kode_pembelian' => $id));
		$this->db->delete('detail_pembelian', array('kode_pembelian' => $id));
		$this->db->delete('buku_besar', array('kode_transaksi' => $id));
		$this->session->set_flashdata('deletepembelian', '<div class="alert alert-success" role="alert">Pembelian Berhasil Di Hapus</div>');
		redirect('transaksi/pembelian');
	}
	public function deletepenjualan()
	{
		$id = $this->uri->segment(3);
		$this->db->delete('penjualan', array('kode_penjualan' => $id));
		$this->db->delete('detail_penjualan', array('kode_penjualan' => $id));
		$this->db->delete('buku_besar', array('kode_transaksi' => $id));
		$this->session->set_flashdata('deletepenjualan', '<div class="alert alert-success" role="alert">Penjualan Berhasil Di Hapus</div>');
		redirect('transaksi/penjualan');
	}

	public function aksipembelian()
	{
		$total = 0;
		foreach ($_POST['subtotal'] as $value) {
			$total += $value;
		}
		$kode_pembelian = $this->M_pembelian->get_kodepembelian();
		$pembelian = array(
			'kode_pembelian' => $kode_pembelian,
			'tanggal_pembelian' => $_POST['tanggal_beli'],
			'total' => $total,
			'id_admin' => $this->session->userdata("id_admin"),
			'keterangan' => $_POST['keterangan2'],
		);
		$pembelianbukubesar = array(
			'kode_transaksi' => $kode_pembelian,
			'tipe' => 'pembelian',
			'tanggal' => $_POST['tanggal_beli'],
			'nominal' =>  $total,
			'jenis' => 'kredit',
			'keterangan' => $_POST['keterangan2'],
		);
		$this->db->insert('pembelian', $pembelian);
		$this->db->insert('buku_besar', $pembelianbukubesar);
		$lasId = $this->M_pembelian->getLastId();
		foreach ($_POST['kode_barang'] as $key => $value) {
			$data = [
				'kode_pembelian' => $lasId[0]['kode_pembelian'],
				'kode_barang' => $this->input->post('kode_barang')[$key],
				'qty' => $this->input->post('qty')[$key],
				'harga_satuan' => $this->input->post('harga_satuan')[$key],
				'keterangan' => $this->input->post('keterangan')[$key],
			];
			$this->db->insert('detail_pembelian', $data);
		}
		foreach ($_POST['kode_barang'] as $key => $value) {

			$kode_barang = $this->input->post('kode_barang')[$key];
			$qty = $this->input->post('qty')[$key];
			$this->db->query("UPDATE `barang` SET `stok`=stok+'$qty' WHERE kode_barang='$kode_barang'");
		}
		$this->session->set_flashdata('tambahpembelian', '<div class="alert alert-success" role="alert">Pembelian Berhasil Disimpan</div>');
		redirect('transaksi/pembelian');
	}
	public function aksieditpembelian()
	{
		$total = 0;
		foreach ($_POST['subtotal'] as $value) {
			$total += $value;
		}
		$kode_pembelian = $_POST['kode_pembelian'];
		$pembelian = array(
			'kode_pembelian' => $kode_pembelian,
			'tanggal_pembelian' => $_POST['tanggal_beli'],
			'total' => $total,
			'id_admin' => $_SESSION['id_admin'],
			'keterangan' => $_POST['keterangan2'],
		);
		$this->common->update('pembelian', $pembelian, ['kode_pembelian' => $kode_pembelian]); //update pembelian
		$bukuBesar = array(
			'tanggal' => $_POST['tanggal_beli'],
			'nominal' => $total,
			'keterangan' => $_POST['keterangan2']
		);
		$this->common->update('buku_besar', $bukuBesar, ['kode_transaksi' => $kode_pembelian]); //update buku besar


		if (isset($_POST['id_delete'])) {
			foreach ($_POST['id_delete'] as $key => $value) {
				$barangDelete = $this->common->getData('qty,kode_barang', 'detail_pembelian', '', ['id_detail' => $value], '', '')[0];
				$stokValue = $barangDelete['qty'];
				$this->db->query("UPDATE barang SET stok=stok-$stokValue WHERE kode_barang='$barangDelete[kode_barang]'");
				$this->common->delete('detail_pembelian', ['id_detail' => $value]);
			}
		}
		foreach ($_POST['kode_barang'] as $key => $value) {
			$data = [
				'kode_pembelian' => $kode_pembelian,
				'kode_barang' => $this->input->post('kode_barang')[$key],
				'qty' => $this->input->post('qty')[$key],
				'harga_satuan' => $this->input->post('harga_satuan')[$key],
				'keterangan' => $this->input->post('keterangan')[$key],
			];
			if (isset($_POST['id_detail'][$key])) {
				$data['id_detail'] = $this->input->post('id_detail')[$key];
				$getDetail = $this->common->getData('qty', 'detail_pembelian', '', ['id_detail' => $data['id_detail']], '', '')[0];
				if ($getDetail['qty'] != $data['qty']) {
					$kode_barang = $data['kode_barang'];
					if ($getDetail['qty'] > $data['qty']) {
						$selisih = $getDetail['qty'] - $data['qty'];
						$this->db->query("UPDATE barang SET stok=stok-$selisih WHERE kode_barang='$kode_barang'");
					} else {
						$selisih = $data['qty'] - $getDetail['qty'];
						$this->db->query("UPDATE barang SET stok=stok+$selisih WHERE kode_barang='$kode_barang'");
					} //update stok
				}
				$this->common->update('detail_pembelian', $data, ['id_detail' => $data['id_detail']]); //update detail pembelian
			} else {
				$qty = $data['qty'];
				$kode_barang = $data['kode_barang'];
				$this->db->query("UPDATE barang SET stok=stok+$qty WHERE kode_barang='$kode_barang'"); //update stok
				$this->common->insert('detail_pembelian', $data); //insert new detail pembelian
			}
		}

		$this->session->set_flashdata('msg', 'Pembelian Berhasil Diupdate');
		redirect('pembelian/edit/' . $kode_pembelian);
	}
	public function aksieditpenjualan()
	{
		$total = 0;
		foreach ($_POST['subtotal'] as $value) {
			$total += $value;
		}
		$kode_penjualan = $_POST['kode_penjualan'];
		$total_qty = 0;
		foreach ($_POST['qty'] as $value) {
			$total_qty += $value;
		}

		$total_bayar = $this->input->post('total_bayar');
		$nama_pembeli = $this->input->post('nama_pembeli');
		$potongan = $this->input->post('potongan');
		$penjualan = array(
			'kode_penjualan' => $kode_penjualan,
			'tanggal_penjualan' => date('Y/m/d'),
			'nama_pembeli' => $_POST['nama_pembeli'],
			'total_qty' => $total_qty,
			'total_penjualan' => $total,
			'total_bayar' => $_POST['total_bayar'],
			'potongan' => $_POST['potongan'],
			'id_admin' => $_POST['id_admin'],
			'keterangan' => $_POST['keterangan2'],
		);
		$this->common->update('penjualan', $penjualan, ['kode_penjualan' => $kode_penjualan]); //update penjualan
		$bukuBesar = array(
			'tanggal' => date('Y/m/d'),
			'nominal' => $total,
			'keterangan' => $_POST['keterangan2']
		);
		$this->common->update('buku_besar', $bukuBesar, ['kode_transaksi' => $kode_penjualan]); //update buku besar

		if (isset($_POST['id_delete'])) {
			foreach ($_POST['id_delete'] as $key => $value) {
				$barangDelete = $this->common->getData('qty,kode_barang', 'detail_penjualan', '', ['id_detail' => $value], '', '')[0];
				$stokValue = $barangDelete['qty'];
				$this->db->query("UPDATE barang SET stok=stok+$stokValue WHERE kode_barang='$barangDelete[kode_barang]'");
				$this->common->delete('detail_penjualan', ['id_detail' => $value]);
			}
		}
		foreach ($_POST['kode_barang'] as $key => $value) {
			$data = [
				'kode_penjualan' => $kode_penjualan,
				'kode_barang' => $this->input->post('kode_barang')[$key],
				'qty' => $this->input->post('qty')[$key],
				'harga_satuan' => $this->input->post('harga_satuan')[$key],
				'keterangan' => $this->input->post('keterangan')[$key],
			];
			if (isset($_POST['id_detail'][$key])) {
				$data['id_detail'] = $this->input->post('id_detail')[$key];
				$getDetail = $this->common->getData('qty', 'detail_penjualan', '', ['id_detail' => $data['id_detail']], '', '')[0];
				if ($getDetail['qty'] != $data['qty']) {
					$kode_barang = $data['kode_barang'];
					if ($getDetail['qty'] > $data['qty']) {
						$selisih = $getDetail['qty'] - $data['qty'];
						$this->db->query("UPDATE barang SET stok=stok+$selisih WHERE kode_barang='$kode_barang'");
					} else {
						$selisih = $data['qty'] - $getDetail['qty'];
						$this->db->query("UPDATE barang SET stok=stok-$selisih WHERE kode_barang='$kode_barang'");
					} //update stok
				}
				$this->common->update('detail_penjualan', $data, ['id_detail' => $data['id_detail']]); //update detail pembelian
			} else {
				$qty = $data['qty'];
				$kode_barang = $data['kode_barang'];
				$this->db->query("UPDATE barang SET stok=stok-$qty WHERE kode_barang='$kode_barang'"); //update stok
				$this->common->insert('detail_penjualan', $data); //insert new detail pembelian
			}
		}

		$this->session->set_flashdata('msg', 'Pembelian Berhasil Diupdate');
		redirect('penjualan/edit/' . $kode_penjualan);
	}


    public function cetak_struk() {
        // me-load library escpos
        $this->load->library('escpos');

        // membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("EPSON TM-U220");

        // membuat objek $printer agar dapat di lakukan fungsinya
        $printer = new Escpos\Printer($connector);

        // membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
        function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 18;
            $lebar_kolom_2 = 2;
            $lebar_kolom_3 = 8;
            $lebar_kolom_4 = 9;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
            $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
            $kolom4Array = explode("\n", $kolom4);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));

            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();

            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
            }

            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris) . "\n";
        }   
		
		$lasId = $this->M_penjualan->getLastId(); //ambil data penjualan terakhir

		$kode_penjualan = $lasId[0]['kode_penjualan']; //kode transaksi
		$id_admin = $this->session->userdata('id_admin');
		$karyawan = $this->db->query("SELECT username from admin WHERE id_admin = $id_admin"); //nama karyawan

        // Data transaksi
        $printer->initialize();
        $printer->text(date('d-m-Y H:i:s')); // nampil waktu otomatis seng ndek transaksi cup
		$printer->text(buatBaris4Kolom($kode_penjualan, '', "kasir :", $karyawan));

        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
		$printer->text("----------------------------------------\n");
		foreach ($_POST['kode_barang'] as $key => $value) {
			$kode_barang = $this->input->post('kode_barang')[$key];
			$data = [
				'kode_penjualan'=> $lasId[0]['kode_penjualan'],
				'kode_barang'	=> $this->input->post('kode_barang')[$key],
				'qty'			=> $this->input->post('qty')[$key],
				'harga_satuan'	=> $this->input->post('harga_satuan')[$key],
				'keterangan'	=> $this->input->post('keterangan')[$key],
				'nama_barang'	=> $this->db->query("SELECT nama_barang FROM barang WHERE kode_barang = '$kode_barang'")
			];
			// $this->db->insert('detail_penjualan', $data);
			$printer->text($data['nama_barang']);
			$printer->text("\n");
			$printer->text(buatBaris4Kolom('', $data['qty'], $data['harga_satuan'], $data['harga_satuan'] * $data['qty']));
		}
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom('', '', "Total", $lasId[0]['total_penjualan']));
		$printer->text(buatBaris4Kolom('', '', "Potongan", $lasId[0]['potongan']));
		$printer->text(buatBaris4Kolom('', '', "Bayar", $lasId[0]['total_bayar']));
        $printer->text("\n");

         // Pesan penutup
        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text("Terima kasih telah berbelanja\n");
        // $printer->text("http://badar-blog.blogspot.com\n");
        $printer->feed(5); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
        

        // Membuat judul
        $printer->initialize();
        $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
        $printer->text("Toko Kurnia\n");
        $printer->text("\n");
        $printer->close();
    }

}
/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
?>