<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getRole()
    {
        $query = "SELECT `user`.*, `user_role`.`role`, `user_activated`.`status`
                  FROM `user` JOIN `user_role`
                  ON `user`.`role_id` = `user_role`.`id`
                  LEFT JOIN `user_activated`
                  ON `user`.`is_active` = `user_activated`.`id`
                ";
        return $this->db->query($query)->result_array();
    }

    public function getUser($user_id)
    {
        $query = "SELECT `pengaduan`.*, `user`.`name`, `staff`.`staff`
                  FROM `pengaduan` JOIN `user`
                  ON `pengaduan`.`user_id` = `user`.`id`
                  LEFT JOIN `staff`
                  ON `pengaduan`.`kategori_id` = `staff`.`id`
                  WHERE `pengaduan`.`user_id` = $user_id
                ";
        return $this->db->query($query)->result_array();
    }

    public function getDetail($id)
    {
        $query = "SELECT `tanggapan`.*, `pengaduan`.`body`,`created_at`,`bukti`,`status`, `staff`.`staff`
                  FROM `tanggapan` JOIN `pengaduan`
                  ON `tanggapan`.`pengaduan_id` = `pengaduan`.`id`
                  LEFT JOIN `staff`
                  ON `tanggapan`.`kategori_id` = `staff`.`id`
                  WHERE `pengaduan`.`id` = $id
                ";
        return $this->db->query($query)->row_array();
    }
}
