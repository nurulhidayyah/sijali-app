<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_model extends CI_Model
{
    public function getRole()
    {
        $query = "SELECT `staff`.*, `user_role`.`role`
                  FROM `staff` JOIN `user_role`
                  ON `staff`.`role_id` = `user_role`.`id`
                ";
        return $this->db->query($query)->result_array();
    }

    public function getPengaduanMasukStaff($id_staff)
    {
        $query = "SELECT `pengaduan`.*, `user`.`name`,`npm`
                  FROM `pengaduan` JOIN `user`
                  ON `pengaduan`.`user_id` = `user`.`id`
                  WHERE `pengaduan`.`status` = '1' AND `pengaduan`.`kategori_id` = $id_staff
                ";
        return $this->db->query($query)->result_array();
    }
    
    // public function getPengaduanTolakStaff($id_staff)
    // {
    //     $query = "SELECT `pengaduan`.*, `user`.`name`,`npm`
    //               FROM `pengaduan` JOIN `user`
    //               ON `pengaduan`.`user_id` = `user`.`id`
    //               WHERE `pengaduan`.`status` = '2' AND `pengaduan`.`kategori_id` = $id_staff
    //             ";
    //     return $this->db->query($query)->result_array();
    // }

    public function getPengaduanSelesaiStaff($id_staff)
    {
        $query = "SELECT `pengaduan`.*, `user`.`name`,`npm`
                  FROM `pengaduan` JOIN `user`
                  ON `pengaduan`.`user_id` = `user`.`id`
                  WHERE `pengaduan`.`status` = '3' AND `pengaduan`.`kategori_id` = $id_staff
                ";
        return $this->db->query($query)->result_array();
    }

    public function laporan_pengaduan($id)
    {
        $query = "SELECT `tanggapan`.*, `pengaduan`.*, `user`.*, `staff`.`staff`
                  FROM `tanggapan` JOIN `pengaduan`
                  ON `tanggapan`.`pengaduan_id` = `pengaduan`.`id`
                  LEFT JOIN `user`
                  ON `pengaduan`.`user_id` = `user`.`id`
                  LEFT JOIN `staff`
                  ON `tanggapan`.`kategori_id` = `staff`.`id`
                  WHERE `pengaduan`.`kategori_id` = $id
                ";
        return $this->db->query($query)->result_array();
    }
}