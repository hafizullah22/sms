<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	  public function __construct()
    {
        parent::__construct();
    }
	 
	public function index()
	{
		
		
		$this->load->view('login');
	
		
	}

	public function login()
{
    // Get form data
    $email    = $this->input->post('email', true);
    $password = $this->input->post('password', true);

    // Find user by email
    $user = $this->db
        ->where('email', $email)
        ->get('users')
        ->row_array();

    // Check user exists
    if ($user) {

        // Verify hashed password
        if (password_verify($password, $user['password'])) {

            // Session data
            $session_data = [
                'username'  => $user['username'],
                'email'     => $user['email'],
                'role'      => $user['role'],
                'logged_in' => true
            ];

            // Set session
            $this->session->set_userdata($session_data);

            // Success message
            $this->session->set_flashdata([
                'msg_type'  => 'success',
                'msg_title' => 'Login Success',
                'msg_text'  => 'Welcome back ' . $user['username']
            ]);

            redirect('welcome/dashboard');

        } else {

            // Wrong password
            $this->session->set_flashdata([
                'msg_type'  => 'error',
                'msg_title' => 'Login Failed',
                'msg_text'  => 'Incorrect password'
            ]);

            redirect('login');
        }

    } else {

        // User not found
        $this->session->set_flashdata([
            'msg_type'  => 'error',
            'msg_title' => 'Login Failed',
            'msg_text'  => 'Email not found'
        ]);

        redirect('login');
    }
}


public function dashboard()
{
    // Check login
    if (!$this->session->userdata('logged_in')) {

        redirect('login');
    }


    $this->load->view('dashboard');
}

public function logout()
{
	// Destroy session
	$this->session->sess_destroy();

	// Logout message
	$this->session->set_flashdata([
		'msg_type'  => 'success',
		'msg_title' => 'Logged Out',
		'msg_text'  => 'You have been logged out successfully'
	]);

$this->load->view('login');
}

}
