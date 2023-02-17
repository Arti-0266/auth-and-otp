<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends CI_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(['form_validation','session']);
		$this->load->database();
        $this->load->model('UserModel');
	}

	public function index()
	{   $this->load->view('template/header.php');
		$this->load->view('auth/register.php');
        $this->load->view('template/footer.php');
	}

    public function register(){
        $this->form_validation->set_rules('first_name','First Name','trim|requried|alpha');
        $this->form_validation->set_rules('last_name','Last Name','trim|requried|alpha');
        $this->form_validation->set_rules('email','Email','trim|requried|vaild_email|is_unique[users.email]');
        $this->form_validation->set_rules('password','Password','trim|requried');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|requried|match[password]');
    
     if($this->form_validation->run()== FALSE)
     {
        $this->index();
     }
     else{
        $data = array(
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('password')
        );
        $register_user = new UserModel;
        $check = $register_user->registerUser($data);
        if($check){
            $this->session->set_flashdata('status','Registered Successfully Go to Login');
            redirect(base_url('login'));
        }
         else{
            $this->session->set_flashdata('status','Something went wrong!..');
            redirect(base_url(register));
         } 
    }

    }

}
?>