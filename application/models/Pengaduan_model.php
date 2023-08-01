<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan_model extends CI_Model
{
    public function getData()
    {

        $query = "SELECT `pengaduan`.*
                FROM `pengaduan`
        ";
        return $this->db->query($query)->num_rows();
    }

    public function getDataTerlayani()
    {

        $query = "SELECT `pengaduan`.*
                FROM `pengaduan`
                WHERE `pengaduan`.`status` = 3
        ";
        return $this->db->query($query)->num_rows();;
    }

    public function getDataHarian()
    {
        $date = date('d-m-Y');

        $query = "SELECT `pengaduan`.*
                FROM `pengaduan`
                WHERE `pengaduan`.`created_at` = '$date'
        ";
        return $this->db->query($query)->num_rows();;
    }
}
