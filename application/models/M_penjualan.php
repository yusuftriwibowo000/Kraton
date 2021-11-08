<?php

class M_penjualan extends CI_Model
{
    function getLastId()
    {
        $sql = $this->db->select('kode_penjualan');
        $sql = $this->db->from('penjualan');
        $sql = $this->db->order_by('kode_penjualan', 'desc');
        $sql = $this->db->limit(1);
        $sql = $this->db->get();

        return $sql->result_array();
    }

    function get_kodepenjualan(){
        $this->db->select('RIGHT(penjualan.kode_penjualan,4) as kode', FALSE);
        $this->db->order_by('kode_penjualan','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('penjualan');     
        if($query->num_rows() <> 0){      
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
        }
        else {      
         //jika kode belum ada      
         $kode = 1;    
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); 
        $kodejadi = "PJ".$kodemax;  
        return $kodejadi;
  }

    function listpenjualan(){
        $sql = $this->db->select('*');
        $sql = $this->db->from('penjualan');
        $sql = $this->db->join('admin', 'admin.id_admin=penjualan.id_admin');
        $sql = $this->db->order_by('kode_penjualan', 'desc');
        $sql = $this->db->get();

        return $sql->result();
    }
}
