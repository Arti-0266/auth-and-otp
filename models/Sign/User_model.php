<?php

class User_model extends CI_Model {

// Create user in database
public function create_user($data, $otp_code) {
    $data['otp_code'] = $otp_code;
    $this->db->insert('users', $data);
    return $this->db->insert_id();
  }

// Get user by email
public function get_user_by_email($email) {
  $this->db->where('email', $email);
  $query = $this->db->get('users');
  return $query->row_array();
}


}
?>



<!-- CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp_code` int(6) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci -->