<?php
class User extends CI_Controller {

public function signup() {
  $this->load->model('sign/user_model');

  // Get user input data
  $data = array(
    'username' => $this->input->post('username'),
    'email' => $this->input->post('email'),
    'password' => $this->input->post('password')
  );

  // Validate user input data
  $this->form_validation->set_data($data);
  $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[4]|max_length[20]');
  $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
  $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[20]');

  if ($this->form_validation->run() == FALSE) {
    $response = array(
      'status' => 'error',
      'message' => validation_errors()
    );
    $this->output->set_status_header(400)->set_content_type('application/json')->set_output(json_encode($response));
    return;
  }

  // Generate OTP code
  $otp_code = rand(100000, 999999);

  // Hash the password
  $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

  // Save user data to the database
  $user_id = $this->user_model->create_user($data, $otp_code);

  // Send OTP code to user email
  $this->load->library('email');

  $this->email->from('arti.kumari@invictusdigisoft.com', 'Arti');
  $this->email->to($data['email']);
  $this->email->subject('Please Verify Your Email Address');
  $this->email->message('Your OTP code is: ' . $otp_code);

  if (!$this->email->send()) {
    $response = array(
      'status' => 'error',
      'message' => 'Failed to send OTP code to user email'
    );
    $this->output->set_status_header(500)->set_content_type('application/json')->set_output(json_encode($response));
    return;
  }

  // Create JWT token
  $this->load->library('jwt');
  $token_data = array(
    'user_id' => $user_id
  );
  $jwt_token = $this->jwt->encode($token_data);

  // Return JWT token in response
  $response = array(
    'status' => 'success',
    'message' => 'User created successfully. Please verify your email address.',
    'token' => $jwt_token
  );
  $this->output->set_status_header(201)->set_content_type('application/json')->set_output(json_encode($response));
}
}
?>