<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth extends CI_Controller {

		public function __construct(){

			parent::__construct();
			$this->load->library('form_validation'); 
			

		}

		public function index(){

			if ($this->session->userdata('email')) {
				 redirect('user');
			}

			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('password','Password','trim|required');

			if ($this->form_validation->run() == false) {

				$data['title'] = 'Login Page';
				$this->load->view('templates/auth_header'); 
				$this->load->view('auth/login');
				$this->load->view('templates/auth_footer');
			} else {
				// validation avec sucess
				$this->_login();
			}

		}


		private function _login()  {

				$email = $this->input->post('email');
				$password = $this->input->post('password');

				$user = $this->db->get_where('user',['email' => $email])->row_array();

				 if ($user) {
				 	
				 	if ($user['is_active'] == 1) {
				 		
				 		if (password_verify($password,$user['password'])) {

				 			$data = [
				 				'email' => $user['email'],
				 				'role_id' => $user['role_id']

				 			];

				 			$this->session->set_userdata($data);
				 			if ($user['role_id'] == 1) {
				 				redirect('admin');
				 			} else {

				 				redirect ('user');
				 			}
				 			

				 		} else {
				 	$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Wrong password !</div>'); 	
					redirect('auth');

						}

				 	} else  {
				 	$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> this email had not activeted !</div>'); 	
					redirect('auth');

						}  

				 	} else {
				 	$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> email is not register ! </div>');  	
					redirect('auth');
				 }
			
			}


			



		public function registration (){

			if ($this->session->userdata('email')) {
				 redirect('user');
			}

			$this->form_validation->set_rules('name','Name','required|trim');
			$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user.email]',[
				'is_unique' => 'This email is already registed'
			]);
			$this->form_validation->set_rules('password1','Password','required|trim|min_length[3]|matches[password2]',
				['matches'=>'Password dont match!',                        
				 'min_length'=>'Password too short!' 
			]);
			$this->form_validation->set_rules('password2','Password','required|trim|min_length[3]|matches[password1]');

			if ($this->form_validation->run() == false ) {
				$data['title'] = 'WPU User Registration';
				$this->load->view('templates/auth_header', $data);
				$this->load->view('auth/registration');
				$this->load->view('templates/auth_footer');
			
			} else {
				$email = $this->input->post('email',true);
				$data = [

					'name' 			=> htmlspecialchars($this->input->post('name',true)),
					'email' 		=> htmlspecialchars($email),
					'image' 		=> 'default.jpg',
					'password' 	    => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
					'role_id'		=> 2,
					'is_active' 	=> 0,
					'date_created'  => time()

					];	

					// token

					$token = base64_encode(random_bytes(32));
					$user_token = [
						'email' => $email,
						'token' => $token,
						'date_create' => time()

					]; 


					$this->db->insert('user',$data);
					$this->db->insert('user_token',$user_token);


					$this->_sendEmail($token,'verify'); 

					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Congratulation! you account has been created .Please Login </div>');  	
					redirect('auth');	
			}

			

		}

		private function _sendEmail($token,$type)
		{
			$config = [
				'protocol' => 'smtp',
				'smtp_host'=> 'ssl://smtp.googlemail.com',
				'smtp_user'=> 'wpunpas1@gmail.com',
				'smtp_pass'=> '1234567890',
				'smtp_port'=>  465,
				'mailtype' => 'html',
				'charset'  => 'utf-8',
				'newline'  => "\r\n"
			];

			$this->email->initialize($config);

			$this->email->from('wpunpas1@gmail.com','Web Programming UNPAS');
			$this->email->to($this->input->post('email'));

			if ($type == 'verify') {
				$this->email->subject('Account Verification');
				$this->email->message('Click this link to verify you account : <a href="'. base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' .$token.  ' ">Activate</a> ');
			}
			

			if($this->email->send())
			{
				return true;
			} else {
				echo $this->email->print_debugger();
				die;
			}
		}


		public function logout()
		{
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('role_id');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> You have been logged out ! </div>');  	
			redirect('auth');

		}

		public function blocked()
		{
			$this->load->view('auth/blocked');
		}

	}

