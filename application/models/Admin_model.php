<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function getPengaduanMasuk()
    {
        $query = "SELECT `pengaduan`.*, `user`.`name`,`npm`
                  FROM `pengaduan` JOIN `user`
                  ON `pengaduan`.`user_id` = `user`.`id`
                  WHERE `pengaduan`.`status` = '0'
                ";
        return $this->db->query($query)->result_array();
    }

    public function laporan_pengaduan()
    {
        $query = "SELECT `tanggapan`.*, `pengaduan`.*, `user`.*, `staff`.`staff`
                  FROM `tanggapan` JOIN `pengaduan`
                  ON `tanggapan`.`pengaduan_id` = `pengaduan`.`id`
                  LEFT JOIN `user`
                  ON `pengaduan`.`user_id` = `user`.`id`
                  LEFT JOIN `staff`
                  ON `tanggapan`.`kategori_id` = `staff`.`id`
                ";
        return $this->db->query($query)->result_array();
    }
}