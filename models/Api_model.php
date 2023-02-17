<?php

class Api_model extends CI_Model
{
    function registerUser($data)
    {
        $this->db->insert('user',$data);
        // print_r($this->db->last_query()); die;
    }

    function checkLogin($data)
    {
        $this->db->where($data);
        $query = $this->db->get('user');

        if($query->num_rows()==1)
        {
            return $query->row();
        }
        else
        {

            return false;
        }
    }
    function getProfile($userId)
    {
        $this->db->select('name,email');
        $this->db->where(['id'=>$userId]); // $this->db->where(['id'=>$userId]);
        $query = $this->db->get('user');
        return $query->row();
    }
}






?>

<!-- CREATE TABLE `auth_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiry_date` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci -->



<!-- CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci -->