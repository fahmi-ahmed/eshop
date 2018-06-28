<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->helper('html');
		$this->load->helper('file');
		$this->load->helper('form');
		$this->load->library('pagination');
		$this->load->model('User_model');
		$this->load->library('form_validation');
   	$this->form_validation->set_error_delimiters('<div role="alert">', '</div>');
  }

  public function index() {
		if($this->session->userdata('u_logged_in') == TRUE){
			$data['result'] = $this->User_model->laptop();
			$data['result1'] = $this->User_model->gaminglaptop();
			$data['result2'] = $this->User_model->mobile();
			$data['result3'] = $this->User_model->motherboard();
			$data['result4'] = $this->User_model->pcgames();
			//pagination settings
	    $config['base_url'] = site_url('User');
	    $config['total_rows'] = $this->db->count_all('hottopics');
	    $config['per_page'] = "3";
	    $config["uri_segment"] = 3;
	    $choice = $config["total_rows"]/$config["per_page"];
	    $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = '«';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '»';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // get list
      $data['topiclist'] = $this->User_model->get_article($config["per_page"], $data['page'], NULL);
      $data['pagination'] = $this->pagination->create_links();
      // load view
	    $this->load->view('common/header');
			$this->load->view('nav/usernav');
	    $this->load->view('user/home',$data);
	    $this->load->view('common/footer');
		}else{
			redirect('Home/login');
		}
  }

	public function selectedtopic($id) {
		if($this->session->userdata('u_logged_in') == TRUE){
			$data['result'] = $this->User_model->selectedtopic($id);
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/selected',$data);
			$this->load->view('common/footer');
		}else{
			redirect('Home/login');
		}
	}

	public function order() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			if($this->input->post()){
				$data['id'] = $this->input->post('id');
				$data['table'] = $this->input->post('table');
			}else{
				$data['id'] = $this->uri->segment(4);
				$data['table'] = $this->uri->segment(3);
			}
			$resu = $this->User_model->pro($data['table'],$data['id']);
			foreach ($resu as $row) {
				$sellername = $row->sellername;
			}
			$ress = $this->User_model->user($sellername);
			foreach ($ress as $row) {
				$mobile = $row->mobile;
				$kebele = $row->Kebele;
				$houseno = $row->housenumber;
			}
			$res = $this->User_model->seller($sellername);
			foreach ($res as $row) {
				$till_number = $row->tillnumber;
			}
			if ($this->uri->segment(5) == 'e') {
				$data['error'] = "We don't have that much at this particular time, please order according to the specified amount!";
			}elseif($this->uri->segment(5) == 's'){
				$data['error'] = "using this till number (". $till_number . ") pay using your CBE account, If you don't pay with in the following 24 hours your order will be erased!";
			}else{
				$data['error'] = NULL;
			}
			$data['result'] = $this->User_model->pro($data['table'],$data['id']);
			$this->form_validation->set_rules('amount', 'amount', 'required|min_length[1]|max_length[10]');
			if($this->form_validation->run() == FALSE) {
				$this->load->view('common/header');
				$this->load->view('nav/usernav');
				$this->load->view('user/order',$data);
				$this->load->view('common/footer');
			}else{
				$amount = $this->input->post('amount');
				$result1 = $this->User_model->pro($data['table'],$data['id']);
				foreach ($result1 as $row) {
					if($amount > $row->amount) {
						redirect('User/order/'.$data['table'].'/'.$data['id'].'/e');
					}else{
						$new = array(
											 'id' => $row->id,
											 'amount' => $row->amount - $amount
											);
						$this->User_model->update($data['table'],$data['id'],$new);
						$order = array(
													'buyer' => $this->session->userdata('ufname'),
													'seller' => $row->sellername,
													'product' => $row->name,
													'amount' => $this->input->post('amount'),
													'mobile' => $mobile,
													'kebele' => $kebele,
													'houseno' => $houseno,
													'paystat' => 0,
													'tables' => $data['table']
												);
						$this->User_model->orderin($order);
						redirect('User/order/'.$data['table'].'/'.$data['id'].'/s');
					}
				}
			}
		}else{
			redirect('Home/login');
		}
	}

	public function terminate() {
		if ($this->session->userdata('u_logged_in') == TRUE) {
			if($this->input->post()){
				$data['id'] = $this->input->post('id');
			}else{
				$data['id'] = $this->uri->segment(3);
			}
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/terminate',$data);
			$this->load->view('common/footer');
		} else {
			redirect('Home');
		}

	}

	public function delete() {
		if ($this->session->userdata('u_logged_in') == TRUE) {
			if($this->input->post()){
				$data['id'] = $this->input->post('id');
			}else{
				$data['id'] = $this->uri->segment(3);
			}
			$this->User_model->delete($data['id']);
			redirect('Home');
		} else {
			redirect('User/logout');
		}

	}

	public function camera() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
	    $config['base_url'] = site_url('User/camera');
	    $config['total_rows'] = $this->db->count_all('camera');
	    $config['per_page'] = "6";
	    $config["uri_segment"] = 3;
	    $choice = $config["total_rows"]/$config["per_page"];
	    $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = '«';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '»';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // get list
      $data['cameralist'] = $this->User_model->get_camera($config["per_page"], $data['page'], NULL);
      $data['pagination'] = $this->pagination->create_links();
      // load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/camera',$data);
			$this->load->view('common/footer');
    }else {
      redirect('Home/login');
    }
	}

	public function searchcamera() {
		if($this->session->userdata('u_logged_in') == TRUE) {
      // get search string
      $search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
      $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
      // pagination settings
      $config = array();
      $config['base_url'] = site_url("User/searchcamera/$search");
      $config['total_rows'] = $this->User_model->get_camera_count($search);
      $config['per_page'] = "5";
      $config["uri_segment"] = 4;
      $choice = $config["total_rows"]/$config["per_page"];
      $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = 'Prev';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      // get list
			if ($this->input->post('searchby') == 1) {
				$data['cameralist'] = $this->User_model->get_camera($config['per_page'], $data['page'], $search);
			} elseif ($this->input->post('searchby') == 2) {
				$data['cameralist'] = $this->User_model->get_camerab($config['per_page'], $data['page'], $search);
			}elseif ($this->input->post('searchby') == 3) {
				$data['cameralist'] = $this->User_model->get_cameral($config['per_page'], $data['page'], $search);
			}else {
				$data['cameralist'] = $this->User_model->get_camera($config['per_page'], $data['page'], $search);
			}

      $data['pagination'] = $this->pagination->create_links();
      //load view
      $this->load->view('common/header');
			$this->load->view('nav/usernav');
      $this->load->view('user/camera',$data);
      $this->load->view('common/footer');
	    }else {
	      redirect('Home/login');
	    }
	}

	public function laptop() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
	    $config['base_url'] = site_url('User/laptop');
	    $config['total_rows'] = $this->db->count_all('laptop');
	    $config['per_page'] = "6";
	    $config["uri_segment"] = 3;
	    $choice = $config["total_rows"]/$config["per_page"];
	    $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = '«';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '»';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // get list
      $data['laptoplist'] = $this->User_model->get_laptop($config["per_page"], $data['page'], NULL);
      $data['pagination'] = $this->pagination->create_links();
      // load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/laptop',$data);
			$this->load->view('common/footer');
    }else {
      redirect('Home/login');
    }
	}

	public function searchlaptop() {
		if($this->session->userdata('u_logged_in') == TRUE) {
      // get search string
      $search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
      $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
      // pagination settings
      $config = array();
      $config['base_url'] = site_url("User/searchlaptop/$search");
      $config['total_rows'] = $this->User_model->get_laptop_count($search);
      $config['per_page'] = "5";
      $config["uri_segment"] = 4;
      $choice = $config["total_rows"]/$config["per_page"];
      $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = 'Prev';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      // get list
			if ($this->input->post('searchby') == 1) {
			  $data['laptoplist'] = $this->User_model->get_laptop($config['per_page'], $data['page'], $search);
			} elseif ($this->input->post('searchby') == 2) {
			  $data['laptoplist'] = $this->User_model->get_laptopb($config['per_page'], $data['page'], $search);
			}elseif ($this->input->post('searchby') == 3) {
			  $data['laptoplist'] = $this->User_model->get_laptopp($config['per_page'], $data['page'], $search);
			}elseif ($this->input->post('searchby') == 4) {
			  $data['laptoplist'] = $this->User_model->get_laptopr($config['per_page'], $data['page'], $search);
			}elseif ($this->input->post('searchby') == 5) {
			  $data['laptoplist'] = $this->User_model->get_laptoph($config['per_page'], $data['page'], $search);
			}else {
			  $data['laptoplist'] = $this->User_model->get_laptop($config['per_page'], $data['page'], $search);
			}
      $data['pagination'] = $this->pagination->create_links();
      //load view
      $this->load->view('common/header');
			$this->load->view('nav/usernav');
      $this->load->view('user/laptop',$data);
      $this->load->view('common/footer');
	    }else {
	      redirect('Home/login');
	    }
	}

	public function desktop() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
	    $config['base_url'] = site_url('User/desktop');
	    $config['total_rows'] = $this->db->count_all('desktop');
	    $config['per_page'] = "6";
	    $config["uri_segment"] = 3;
	    $choice = $config["total_rows"]/$config["per_page"];
	    $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = '«';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '»';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // get list
      $data['desktoplist'] = $this->User_model->get_desktop($config["per_page"], $data['page'], NULL);
      $data['pagination'] = $this->pagination->create_links();
      // load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/desktop',$data);
			$this->load->view('common/footer');
    }else {
      redirect('Home/login');
    }
	}

	public function searchdesktop() {
		if($this->session->userdata('u_logged_in') == TRUE) {
      // get search string
      $search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
      $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
      // pagination settings
      $config = array();
      $config['base_url'] = site_url("User/searchdesktop/$search");
      $config['total_rows'] = $this->User_model->get_desktop_count($search);
      $config['per_page'] = "5";
      $config["uri_segment"] = 4;
      $choice = $config["total_rows"]/$config["per_page"];
      $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = 'Prev';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      // get list
      $data['desktoplist'] = $this->User_model->get_desktop($config['per_page'], $data['page'], $search);
      $data['pagination'] = $this->pagination->create_links();
      //load view
      $this->load->view('common/header');
			$this->load->view('nav/usernav');
      $this->load->view('user/desktop',$data);
      $this->load->view('common/footer');
	    }else {
	      redirect('Home/login');
	    }
	}

	public function gaminglaptop() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
	    $config['base_url'] = site_url('User/gaminglaptop');
	    $config['total_rows'] = $this->db->count_all('gaminglaptop');
	    $config['per_page'] = "6";
	    $config["uri_segment"] = 3;
	    $choice = $config["total_rows"]/$config["per_page"];
	    $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = '«';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '»';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // get list
      $data['gaminglaptoplist'] = $this->User_model->get_gaminglaptop($config["per_page"], $data['page'], NULL);
      $data['pagination'] = $this->pagination->create_links();
      // load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/gaminglaptop',$data);
			$this->load->view('common/footer');
    }else {
      redirect('Home/login');
    }
	}

	public function searchgaminglaptop() {
		if($this->session->userdata('u_logged_in') == TRUE) {
      // get search string
      $search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
      $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
      // pagination settings
      $config = array();
      $config['base_url'] = site_url("User/searchgaminglaptop/$search");
      $config['total_rows'] = $this->User_model->get_gaminglaptop_count($search);
      $config['per_page'] = "5";
      $config["uri_segment"] = 4;
      $choice = $config["total_rows"]/$config["per_page"];
      $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = 'Prev';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      // get list
			if ($this->input->post('searchby') == 1) {
			  $data['gaminglaptoplist'] = $this->User_model->get_gaminglaptop($config['per_page'], $data['page'], $search);
			} elseif ($this->input->post('searchby') == 2) {
			  $data['gaminglaptoplist'] = $this->User_model->get_gaminglaptopb($config['per_page'], $data['page'], $search);
			}elseif ($this->input->post('searchby') == 3) {
			  $data['gaminglaptoplist'] = $this->User_model->get_gaminglaptopp($config['per_page'], $data['page'], $search);
			}elseif ($this->input->post('searchby') == 4) {
			  $data['gaminglaptoplist'] = $this->User_model->get_gaminglaptopr($config['per_page'], $data['page'], $search);
			}elseif ($this->input->post('searchby') == 5) {
			  $data['gaminglaptoplist'] = $this->User_model->get_gaminglaptoph($config['per_page'], $data['page'], $search);
			}else {
			  $data['gaminglaptoplist'] = $this->User_model->get_gaminglaptop($config['per_page'], $data['page'], $search);
			}
      $data['pagination'] = $this->pagination->create_links();
      //load view
      $this->load->view('common/header');
			$this->load->view('nav/usernav');
      $this->load->view('user/gaminglaptop',$data);
      $this->load->view('common/footer');
	    }else {
	      redirect('Home/login');
	    }
	}

	public function mobile() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
	    $config['base_url'] = site_url('User/mobile');
	    $config['total_rows'] = $this->db->count_all('mobile');
	    $config['per_page'] = "6";
	    $config["uri_segment"] = 3;
	    $choice = $config["total_rows"]/$config["per_page"];
	    $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = '«';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '»';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // get list
      $data['mobilelist'] = $this->User_model->get_mobile($config["per_page"], $data['page'], NULL);
      $data['pagination'] = $this->pagination->create_links();
      // load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/mobile',$data);
			$this->load->view('common/footer');
    }else {
      redirect('Home/login');
    }
	}

	public function searchmobile() {
		if($this->session->userdata('u_logged_in') == TRUE) {
      // get search string
      $search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
      $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
      // pagination settings
      $config = array();
      $config['base_url'] = site_url("User/searchmobile/$search");
      $config['total_rows'] = $this->User_model->get_mobile_count($search);
      $config['per_page'] = "5";
      $config["uri_segment"] = 4;
      $choice = $config["total_rows"]/$config["per_page"];
      $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = 'Prev';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      // get list
			if ($this->input->post('searchby') == 1) {
			  $data['mobilelist'] = $this->User_model->get_mobile($config['per_page'], $data['page'], $search);
			} elseif ($this->input->post('searchby') == 2) {
			  $data['mobilelist'] = $this->User_model->get_mobileb($config['per_page'], $data['page'], $search);
			}elseif ($this->input->post('searchby') == 3) {
			  $data['mobilelist'] = $this->User_model->get_mobilep($config['per_page'], $data['page'], $search);
			}elseif ($this->input->post('searchby') == 4) {
			  $data['mobilelist'] = $this->User_model->get_mobiler($config['per_page'], $data['page'], $search);
			}else {
			  $data['mobilelist'] = $this->User_model->get_mobile($config['per_page'], $data['page'], $search);
			}
      $data['pagination'] = $this->pagination->create_links();
      //load view
      $this->load->view('common/header');
			$this->load->view('nav/usernav');
      $this->load->view('user/mobile',$data);
      $this->load->view('common/footer');
	    }else {
	      redirect('Home/login');
	    }
	}

	public function motherboard() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
	    $config['base_url'] = site_url('User/motherboard');
	    $config['total_rows'] = $this->db->count_all('motherboard');
	    $config['per_page'] = "6";
	    $config["uri_segment"] = 3;
	    $choice = $config["total_rows"]/$config["per_page"];
	    $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = '«';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '»';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // get list
      $data['motherboardlist'] = $this->User_model->get_motherboard($config["per_page"], $data['page'], NULL);
      $data['pagination'] = $this->pagination->create_links();
      // load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/motherboard',$data);
			$this->load->view('common/footer');
    }else {
      redirect('Home/login');
    }
	}

	public function searchmotherboard() {
		if($this->session->userdata('u_logged_in') == TRUE) {
      // get search string
      $search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
      $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
      // pagination settings
      $config = array();
      $config['base_url'] = site_url("User/searchmotherboard/$search");
      $config['total_rows'] = $this->User_model->get_motherboard_count($search);
      $config['per_page'] = "5";
      $config["uri_segment"] = 4;
      $choice = $config["total_rows"]/$config["per_page"];
      $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = 'Prev';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      // get list
      $data['motherboardlist'] = $this->User_model->get_motherboard($config['per_page'], $data['page'], $search);
      $data['pagination'] = $this->pagination->create_links();
      //load view
      $this->load->view('common/header');
			$this->load->view('nav/usernav');
      $this->load->view('user/motherboard',$data);
      $this->load->view('common/footer');
	    }else {
	      redirect('Home/login');
	    }
	}

	public function pcgames() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
	    $config['base_url'] = site_url('User/pcgames');
	    $config['total_rows'] = $this->db->count_all('pcgames');
	    $config['per_page'] = "6";
	    $config["uri_segment"] = 3;
	    $choice = $config["total_rows"]/$config["per_page"];
	    $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = '«';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '»';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // get list
      $data['pcgameslist'] = $this->User_model->get_pcgames($config["per_page"], $data['page'], NULL);
      $data['pagination'] = $this->pagination->create_links();
      // load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/pcgames',$data);
			$this->load->view('common/footer');
    }else {
      redirect('Home/login');
    }
	}

	public function searchpcgames() {
		if($this->session->userdata('u_logged_in') == TRUE) {
      // get search string
      $search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
      $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
      // pagination settings
      $config = array();
      $config['base_url'] = site_url("User/searchpcgames/$search");
      $config['total_rows'] = $this->User_model->get_pcgames_count($search);
      $config['per_page'] = "5";
      $config["uri_segment"] = 4;
      $choice = $config["total_rows"]/$config["per_page"];
      $config["num_links"] = floor($choice);
      // integrate bootstrap pagination
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = 'Prev';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      // get list
			if ($this->input->post('searchby') == 1) {
			  $data['pcgameslist'] = $this->User_model->get_pcgames($config['per_page'], $data['page'], $search);
			} elseif ($this->input->post('searchby') == 2) {
			  $data['pcgameslist'] = $this->User_model->get_pcgamesb($config['per_page'], $data['page'], $search);
			}else {
			  $data['pcgameslist'] = $this->User_model->get_pcgames($config['per_page'], $data['page'], $search);
			}
      $data['pagination'] = $this->pagination->create_links();
      //load view
      $this->load->view('common/header');
			$this->load->view('nav/usernav');
      $this->load->view('user/pcgames',$data);
      $this->load->view('common/footer');
	    }else {
	      redirect('Home/login');
	    }
	}

	public function harddisk() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
			$config['base_url'] = site_url('User/harddisk');
			$config['total_rows'] = $this->db->count_all('harddisk');
			$config['per_page'] = "6";
			$config["uri_segment"] = 3;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '«';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '»';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			// get list
			$data['harddisklist'] = $this->User_model->get_harddisk($config["per_page"], $data['page'], NULL);
			$data['pagination'] = $this->pagination->create_links();
			// load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/harddisk',$data);
			$this->load->view('common/footer');
		}else {
			redirect('Home/login');
		}
	}

	public function searchharddisk() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			// get search string
			$search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
			$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
			// pagination settings
			$config = array();
			$config['base_url'] = site_url("User/searchharddisk/$search");
			$config['total_rows'] = $this->User_model->get_harddisk_count($search);
			$config['per_page'] = "5";
			$config["uri_segment"] = 4;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			// get list
			$data['harddisklist'] = $this->User_model->get_harddisk($config['per_page'], $data['page'], $search);
			$data['pagination'] = $this->pagination->create_links();
			//load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/harddisk',$data);
			$this->load->view('common/footer');
			}else {
				redirect('Home/login');
			}
	}

	public function ram() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
			$config['base_url'] = site_url('User/ram');
			$config['total_rows'] = $this->db->count_all('ram');
			$config['per_page'] = "6";
			$config["uri_segment"] = 3;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '«';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '»';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			// get list
			$data['ramlist'] = $this->User_model->get_ram($config["per_page"], $data['page'], NULL);
			$data['pagination'] = $this->pagination->create_links();
			// load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/ram',$data);
			$this->load->view('common/footer');
		}else {
			redirect('Home/login');
		}
	}

	public function searchram() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			// get search string
			$search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
			$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
			// pagination settings
			$config = array();
			$config['base_url'] = site_url("User/searchram/$search");
			$config['total_rows'] = $this->User_model->get_ram_count($search);
			$config['per_page'] = "5";
			$config["uri_segment"] = 4;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			// get list
			$data['ramlist'] = $this->User_model->get_ram($config['per_page'], $data['page'], $search);
			$data['pagination'] = $this->pagination->create_links();
			//load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/ram',$data);
			$this->load->view('common/footer');
			}else {
				redirect('Home/login');
			}
	}

	public function headphone() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
			$config['base_url'] = site_url('User/headphone');
			$config['total_rows'] = $this->db->count_all('headphone');
			$config['per_page'] = "6";
			$config["uri_segment"] = 3;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '«';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '»';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			// get list
			$data['headphonelist'] = $this->User_model->get_headphone($config["per_page"], $data['page'], NULL);
			$data['pagination'] = $this->pagination->create_links();
			// load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/headphone',$data);
			$this->load->view('common/footer');
		}else {
			redirect('Home/login');
		}
	}

	public function searchheadphone() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			// get search string
			$search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
			$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
			// pagination settings
			$config = array();
			$config['base_url'] = site_url("User/searchheadphone/$search");
			$config['total_rows'] = $this->User_model->get_headphone_count($search);
			$config['per_page'] = "5";
			$config["uri_segment"] = 4;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			// get list
			$data['headphonelist'] = $this->User_model->get_headphone($config['per_page'], $data['page'], $search);
			$data['pagination'] = $this->pagination->create_links();
			//load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/headphone',$data);
			$this->load->view('common/footer');
			}else {
				redirect('Home/login');
			}
	}

	public function ipad() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
			$config['base_url'] = site_url('User/ipad');
			$config['total_rows'] = $this->db->count_all('ipad');
			$config['per_page'] = "6";
			$config["uri_segment"] = 3;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '«';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '»';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			// get list
			$data['ipadlist'] = $this->User_model->get_ipad($config["per_page"], $data['page'], NULL);
			$data['pagination'] = $this->pagination->create_links();
			// load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/ipad',$data);
			$this->load->view('common/footer');
		}else {
			redirect('Home/login');
		}
	}

	public function searchipad() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			// get search string
			$search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
			$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
			// pagination settings
			$config = array();
			$config['base_url'] = site_url("User/searchipad/$search");
			$config['total_rows'] = $this->User_model->get_ipad_count($search);
			$config['per_page'] = "5";
			$config["uri_segment"] = 4;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			// get list
			$data['ipadlist'] = $this->User_model->get_ipad($config['per_page'], $data['page'], $search);
			$data['pagination'] = $this->pagination->create_links();
			//load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/ipad',$data);
			$this->load->view('common/footer');
			}else {
				redirect('Home/login');
			}
	}

	public function tablet() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
			$config['base_url'] = site_url('User/tablet');
			$config['total_rows'] = $this->db->count_all('tablet');
			$config['per_page'] = "6";
			$config["uri_segment"] = 3;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '«';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '»';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			// get list
			$data['tabletlist'] = $this->User_model->get_tablet($config["per_page"], $data['page'], NULL);
			$data['pagination'] = $this->pagination->create_links();
			// load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/tablet',$data);
			$this->load->view('common/footer');
		}else {
			redirect('Home/login');
		}
	}

	public function searchtablet() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			// get search string
			$search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
			$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
			// pagination settings
			$config = array();
			$config['base_url'] = site_url("User/searchtablet/$search");
			$config['total_rows'] = $this->User_model->get_tablet_count($search);
			$config['per_page'] = "5";
			$config["uri_segment"] = 4;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			// get list
			$data['tabletlist'] = $this->User_model->get_tablet($config['per_page'], $data['page'], $search);
			$data['pagination'] = $this->pagination->create_links();
			//load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/tablet',$data);
			$this->load->view('common/footer');
			}else {
				redirect('Home/login');
			}
	}

	public function gamingtools() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
			$config['base_url'] = site_url('User/gamingtools');
			$config['total_rows'] = $this->db->count_all('gamingtools');
			$config['per_page'] = "6";
			$config["uri_segment"] = 3;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '«';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '»';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			// get list
			$data['gamingtoolslist'] = $this->User_model->get_gamingtools($config["per_page"], $data['page'], NULL);
			$data['pagination'] = $this->pagination->create_links();
			// load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/gamingtools',$data);
			$this->load->view('common/footer');
		}else {
			redirect('Home/login');
		}
	}

	public function searchgamingtools() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			// get search string
			$search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
			$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
			// pagination settings
			$config = array();
			$config['base_url'] = site_url("User/searchgamingtools/$search");
			$config['total_rows'] = $this->User_model->get_gamingtools_count($search);
			$config['per_page'] = "5";
			$config["uri_segment"] = 4;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			// get list
			$data['gamingtoolslist'] = $this->User_model->get_gamingtools($config['per_page'], $data['page'], $search);
			$data['pagination'] = $this->pagination->create_links();
			//load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/gamingtools',$data);
			$this->load->view('common/footer');
			}else {
				redirect('Home/login');
			}
	}

	public function xbox() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			//pagination settings
			$config['base_url'] = site_url('User/xbox');
			$config['total_rows'] = $this->db->count_all('xbox');
			$config['per_page'] = "6";
			$config["uri_segment"] = 3;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '«';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '»';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			// get list
			$data['xboxlist'] = $this->User_model->get_xbox($config["per_page"], $data['page'], NULL);
			$data['pagination'] = $this->pagination->create_links();
			// load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/xbox',$data);
			$this->load->view('common/footer');
		}else {
			redirect('Home/login');
		}
	}

	public function searchxbox() {
		if($this->session->userdata('u_logged_in') == TRUE) {
			// get search string
			$search = ($this->input->post("name"))? $this->input->post("name") : "NIL";
			$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
			// pagination settings
			$config = array();
			$config['base_url'] = site_url("User/searchxbox/$search");
			$config['total_rows'] = $this->User_model->get_xbox_count($search);
			$config['per_page'] = "5";
			$config["uri_segment"] = 4;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			// get list
			$data['xboxlist'] = $this->User_model->get_xbox($config['per_page'], $data['page'], $search);
			$data['pagination'] = $this->pagination->create_links();
			//load view
			$this->load->view('common/header');
			$this->load->view('nav/usernav');
			$this->load->view('user/xbox',$data);
			$this->load->view('common/footer');
			}else {
				redirect('Home/login');
			}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('Home', 'refresh');
	}

}
