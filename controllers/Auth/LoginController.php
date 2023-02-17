<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->helper('form', 'url');
		$this->load->library('form_validation','session');
		$this->load->database();
        $this->load->model('UserModel');
	}

    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('auth/login');
        $this->load->view('template/footer');
    }


	public function login() {

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		}
         else {

            $data =array(
                $email=>$this->input->post('email'),
                $password=>$this->input->post('password')
            );
            $user = new UserModel;
            $result = $user->loginUser($data);
            if($result!= FALSE){

                $auth_userdetails = [
                    'first_name' => $result->first_name,
                    'last_name' => $result->last_name,
                    'email' => $result->email,
                    'password' =>$result->password
                ];

                $this->session->set_userdata('authenticated','1');
                $this->session->set_userdata('auth_user', $auth_userdetails);
                $this->session->set_flashdata('status','Your are logged in successfully');
                redirect(base_url('userpage'));

            }
            else{

                $this->session->set_flashdata('status','Invalid Email Id or Password');
                redirect(base_url('login'));
            }
        }
    
}
}

?> 