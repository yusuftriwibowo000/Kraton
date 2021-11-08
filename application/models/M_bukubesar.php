<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_bukubesar   extends CI_Model
{
    private $_table = 'buku_besar';

    public $kode_transaksi;
    public $tipe;
    public $tanggal;
    public $nominal;
    public $jenis;
    public $keterangan;

    function __construct()
    {
        parent::__construct();
    }

    public function rules()
    {
        return [

            [
                'field' => 'no_transaksi',
                'label' => 'No Transaksi',
                'rules' => 'required'
            ],

        ];
    }

    function listkas(){
        $sql = $this->db->select('*');
        $sql = $this->db->from('kas');
        $sql = $this->db->order_by('kode_kas', 'desc');
        $sql = $this->db->get();

        return $sql->result();
    }

    public function get_by_id($no_transaksi)
    {
        return $this->db->get_where($this->_table, ['no_transaksi' => $no_transaksi])->row();
    }

    
    function get_idkas(){
        $this->db->select('RIGHT(kas.kode_kas,4) as kode', FALSE);
        $this->db->order_by('kode_kas','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('kas');     
        if($query->num_rows() <> 0){      
      
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
        }
        else {      
         //jika kode belum ada      
         $kode = 1;    
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); 
        $kodejadi = "KS".$kodemax;  
        return $kodejadi;
  }
    public function addkasbukubesar($kode_kas)
    {
        $post = $this->input->post();
        $this->kode_transaksi = $kode_kas;
        $this->tipe = 'kas';
        $this->tanggal = $post['tanggal_kas'];
        $this->nominal = $post['nominal'];
        $this->jenis = $post['jenis'];
        $this->keterangan = $post['keterangan'];
        $this->db->insert($this->_table, $this);
    }
    public function addpenjualanbukubesar($kode_penjualan)
    {
        $post = $this->input->post();
        $this->kode_transaksi = $kode_penjualan;
        $this->tipe = 'penjualan';
        $this->tanggal = $post['tanggal_penjualan'];
        $this->nominal = $post['total_penjualan'];
        $this->jenis = 'debit';
        $this->keterangan = $post['keterangan'];
        $this->db->insert($this->_table, $this);
    }
    public function addpembelianbukubesar($kode_pembelian)
    {
        $post = $this->input->post();
        $this->kode_transaksi = $kode_pembelian;
        $this->tipe = 'pembelian';
        $this->tanggal = $post['tanggal_pembelian'];
        $this->nominal = $post['total'];
        $this->jenis = 'kredit';
        $this->keterangan = $post['keterangan'];
        $this->db->insert($this->_table, $this);
    }

    public function updateKas($kode_kas)
    {
        $post = $this->input->post();
		$this->kode_kas = $kode_kas;
        $this->tanggal_kas = $post['tanggal_kas'];
        $this->nominal = $post['nominal'];
        $this->jenis = $post['jenis'];
        $this->keterangan = $post['keterangan'];
        $this->db->update($this->_table, $this, array("kode_kas" => $kode_kas));
    }

    public function deleteKas($kode_kas)
    {
        return $this->db->delete($this->_table, array("kode_kas" => $kode_kas));
    }

    public function hapus_sementara($status, $no_transaksi)
    {
        $this->db->query("UPDATE `cek_kelengkapan` SET `status_2`='$status' WHERE cek_kelengkapan.no_transaksi='$no_transaksi'");
    }

    function restore($status, $no_transaksi)
    {
        $query = $this->db->query("UPDATE `cek_kelengkapan` SET `status_2`='$status' WHERE no_transaksi='$no_transaksi'");
    }

   	
	
}
