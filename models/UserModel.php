<?php

class UserModel extends CI_Model{

    public function loginUser($data)
    {
        $this->db->select('*');
        $this->db->where('email',$data['email']);
        $this->db->where('password',$data['password']);
        $this->db->from('users');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            return $query->row();
        }else{
            return false;
        }
       
    }

    public function registerUser($data)
    {
        return $this->db->insert('users',$data);
    }
}






?>



<!-- CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci -->
