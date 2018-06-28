<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->helper('html');
		$this->load->helper('file');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div role="alert">', '</div>');
		$this->load->model('Home_model');

		$config['upload_path']          = './img/user/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;
		$config['overwrite']			= TRUE;
		$config['file_name']			= $this->input->post('user_name');

		$this->load->library('upload', $config);
  }

  public function index() {
		$data['result'] = $this->Home_model->laptop();
		$data['result1'] = $this->Home_model->mobile();
		$data['result2'] = $this->Home_model->pcgames();
    $this->load->view('common/header');
    $this->load->view('home/home',$data);
    $this->load->view('common/footer');
  }

  public function register() {
		// set validation rule
		$this->form_validation->set_rules('full_name', 'Full_Name', 'required|min_length[1]|max_length[100]');
  	$this->form_validation->set_rules('user_name', 'User_Name', 'required|min_length[1]|max_length[50]');
  	$this->form_validation->set_rules('email', 'Email', 'required|min_length[1]|max_length[100]|valid_email');
  	$this->form_validation->set_rules('password', 'Password', 'required|min_length[1]|max_length[30]');
  	$this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[1]|max_length[10]');
		$this->form_validation->set_rules('kebele', 'Kebele', 'required|min_length[1]|max_length[10]');
		$this->form_validation->set_rules('houseno', 'House number', 'required|min_length[1]|max_length[10]');
  	if($this->form_validation->run()==FALSE) {
	    $this->load->view('common/header');
	    $this->load->view('home/register');
	    $this->load->view('common/footer');
		}else{
			if (!$this->upload->do_upload('userfile')) {
				if($this->Home_model->uname_email_check($this->input->post('email'),$this->input->post('user_name'))) {
					$user_type = 0;
					$hash = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
								$users = array(
															'uname' => $this->input->post('user_name'),
															'fname' => $this->input->post('full_name'),
															'email' => $this->input->post('email'),
															'password' => $hash,
															'kebele' => $this->input->post('kebele'),
															'housenumber' => $this->input->post('houseno'),
															'mobile' => $this->input->post('mobile'),
															'user_type' => $user_type,
														);
					$this->Home_model->insert($users);
					redirect('Home/login');
				}else{
					$this->load->view('common/header');
					$this->load->view('home/register');
					$this->load->view('common/footer');
				}
			}else{
				if($this->Home_model->uname_email_check($this->input->post('email'),$this->input->post('user_name'))) {
					$user_type = 0;
					$hash = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
								$users = array(
															'uname' => $this->input->post('user_name'),
															'fname' => $this->input->post('full_name'),
															'email' => $this->input->post('email'),
															'password' => $hash,
															'kebele' => $this->input->post('kebele'),
															'housenumber' => $this->input->post('houseno'),
															'mobile' => $this->input->post('mobile'),
															'user_type' => $user_type,
															'img' => $data['upload_data']['file_name']
														);
					$this->Home_model->insert($users);
					redirect('Users');
				}else{
					$this->load->view('common/header');
					$this->load->view('home/register');
					$this->load->view('common/footer');
				}
			}
		}
  }

  public function login() {
    //set validation rule
		$this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|max_length[100]|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[30]');
    if($this->form_validation->run()==FALSE) {
      $this->load->view('common/header');
      $this->load->view('home/login');
      $this->load->view('common/footer');
    }else{
      $email = $this->input->post('email');
		  $pass = $this->input->post('password');
      $data['result1'] = $this->Home_model->e_check($this->input->post('email'));
      if($data['result1']) {
        foreach ($data['result1'] as $row) {
          if(password_verify($pass, $row->password)){
            $users = array(
                  'uid' => $row->uid,
									'uimg' => $row->img,
                  'uname' => $row->uname,
									'ufname' => $row->fname,
                  'email' => $row->email,
                  'user_type' => '0',
                  'u_logged_in' => TRUE
                );
            $this->session->set_userdata($users);
            redirect('User');
          }else {
            $this->load->view('common/header');
            $this->load->view('home/login');
            $this->load->view('common/footer');
          }
        }
      }else {
        $this->load->view('common/header');
        $this->load->view('home/login');
        $this->load->view('common/footer');
      }
    }
  }

  public function staff() {
		//set validation rule
		$this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|max_length[100]|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[30]');
    if($this->form_validation->run()==FALSE) {
	    $this->load->view('common/header');
	    $this->load->view('home/stafflogin');
	    $this->load->view('common/footer');
		}else{
			$email = $this->input->post('email');
		  $pass = $this->input->post('password');
      $data['result1'] = $this->Home_model->e_check($this->input->post('email'));
      if($data['result1']) {
        foreach ($data['result1'] as $row) {
          if(password_verify($pass, $row->password)){
						if($row->user_type == 1){
            	$seller = array(
			                  'sid' => $row->uid,
			                  'sname' => $row->uname,
												'simg' => $row->img,
												'semail' => $row->email,
			                  'user_type' => '1',
			                  's_logged_in' => TRUE
			                );
            	$this->session->set_userdata($seller);
            	redirect('Staff');
						}elseif($row->user_type == 99){
							$owner = array(
			                  'oid' => $row->uid,
			                  'oname' => $row->uname,
												'oimg' => $row->img,
			                  'oemail' => $row->email,
			                  'user_type' => '1',
			                  'o_logged_in' => TRUE
			                );
            	$this->session->set_userdata($owner);
            	redirect('Staff/owner');
						}elseif($row->user_type == 2){
							$shipping = array(
			                  'shid' => $row->uid,
			                  'shname' => $row->uname,
												'shimg' => $row->img,
			                  'shemail' => $row->email,
			                  'user_type' => '1',
			                  'sh_logged_in' => TRUE
			                );
            	$this->session->set_userdata($shipping);
            	redirect('Staff/shipping');
						}else{
							$this->load->view('common/header');
	            $this->load->view('home/stafflogin');
	            $this->load->view('common/footer');
						}
          }else {
            $this->load->view('common/header');
            $this->load->view('home/stafflogin');
            $this->load->view('common/footer');
          }
        }
      }else {
        $this->load->view('common/header');
        $this->load->view('home/stafflogin');
        $this->load->view('common/footer');
      }
		}
  }

}
