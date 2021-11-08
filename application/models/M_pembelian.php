<?php

class M_pembelian extends CI_Model
{
    function getLastId()
    {
        $sql = $this->db->select('kode_pembelian');
        $sql = $this->db->from('pembelian');
        $sql = $this->db->order_by('kode_pembelian', 'desc');
        $sql = $this->db->limit(1);
        $sql = $this->db->get();

        return $sql->result_array();
    }

    function get_kodepembelian(){
        $this->db->select('RIGHT(pembelian.kode_pembelian,4) as kode', FALSE);
        $this->db->order_by('kode_pembelian','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('pembelian');     
        if($query->num_rows() <> 0){      
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
        }
        else {      
         //jika kode belum ada      
         $kode = 1;    
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); 
        $kodejadi = "PB".$kodemax;  
        return $kodejadi;
  }

    function listpembelian(){
        $sql = $this->db->select('*');
        $sql = $this->db->from('pembelian');
        $sql = $this->db->join('admin', 'admin.id_admin=pembelian.id_admin');
        $sql = $this->db->order_by('kode_pembelian', 'desc');
        $sql = $this->db->get();

        return $sql->result();
    }
    function pembelian(){
        $sql = $this->db->select('*');
        $sql = $this->db->from('pembelian');
        $sql = $this->db->join('admin', 'admin.id_admin=pembelian.id_admin');
        $sql = $this->db->order_by('kode_pembelian', 'desc');
        $sql = $this->db->get();

        return $sql;
    }
}
