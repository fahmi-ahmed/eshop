<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Staff extends CI_Controller {

  public function __construct() {
		parent::__construct();
		$this->load->library('Ckeditor');
		$this->load->library('Ckfinder');
		$this->load->library('highcharts');
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->helper('text');
		$this->load->helper('html');
		$this->load->helper('analytics_helper');
		$this->load->model('Staff_model');
		$this->load->model('Chart_model');
		$this->load->library('pagination');
		$this->load->helper('form');
		$this->load->library('form_validation');
   	$this->form_validation->set_error_delimiters('<div role="alert">', '</div>');

		$this->ckeditor->basePath = base_url().'/assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
		                array( 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList', '-', 'Blockquote','-', 'Subscript', '-', 'Superscript', '-', 'Table','-', 'Maximize','-','Indent','-','Styles','-','Format','-','Font' ));
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['height'] = '300px';

		//Add Ckfinder to Ckeditor
		$this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');

  }

  public function index() {
		if($this->session->userdata('s_logged_in') == TRUE){
			// set validation rule
			$this->form_validation->set_rules('topic', 'Topic', 'required|min_length[1]|max_length[100]');
			$this->form_validation->set_rules('disc', 'disc', 'required|min_length[1]');
			if($this->form_validation->run() == FALSE) {
	    	$this->load->view('common/header');
				$this->load->view('nav/staffnav');
	    	$this->load->view('staff/home');
	    	$this->load->view('common/footer');
			}else{
				$article = array(
											'topic' => $this->input->post('topic'),
											'disc' => $this->input->post('disc'),
											'sellername' => $this->session->userdata('sname'),
									);
				$this->Staff_model->insert($article);
				redirect('Staff/article');
			}
		}else{
			redirect('Home/staff');
		}
  }

	public function editaccount() {
		if($this->session->userdata('s_logged_in') == TRUE){
			if($this->input->post()) {
				$id = $this->input->post('id');
			}else {
				$id = $this->uri->segment(3);
			}
			$data['result2'] = $this->Staff_model->usersdata($id);

			$this->form_validation->set_rules('full_name','Full_name','required');
			$this->form_validation->set_rules('user_name','User_name','required');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('mobile','Mobile','required');
			$this->form_validation->set_rules('kebele','kebele','required');
			$this->form_validation->set_rules('houseno','house number','required');

			if($this->form_validation->run() == FALSE) {
				$this->load->view('common/header');
				$this->load->view('nav/staffnav');
				$this->load->view('staff/editaccount',$data);
				$this->load->view('common/footer');
			}else{
				if($this->Staff_model->uname_email_check($this->input->post('email'),$this->input->post('user_name'))) {
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
					$this->Staff_model->insert($users);
					redirect('Staff');
				}else{
					redirect('Staff/editaccount/'.$id);
				}
			}
		}else{
			redirect('Home/staff');
		}
	}

	public function orders() {
		if($this->session->userdata('s_logged_in') == TRUE){
			$data['result'] = $this->Staff_model->getorders($this->session->userdata('sname'));
			$this->load->view('common/header');
			$this->load->view('nav/staffnav');
			$this->load->view('staff/orders',$data);
			$this->load->view('common/footer');
		}else{
			redirect('Home/staff');
		}
	}

	public function forward() {
		if ($this->session->userdata('s_logged_in') == TRUE) {
			$oid = $this->uri->segment(3);
			$order = $this->Staff_model->getorder($oid);
			foreach ($order as $row) {
				$table = $row->tables;
				$amount = $row->amount;
				$pro_name = $row->product;
				$newo = array(
									'id' => $oid,
									'fstat' => 1
								);
				$this->Staff_model->oupdate($oid,$newo);
			}
			$result1 = $this->Staff_model->product($table, $pro_name);
			foreach ($result1 as $row) {
				$pro_id = $row->id;
				$orders = $row->orders + $amount;
				$newpro = array(
										'id' => $pro_id,
										'orders' => $orders
									);
				$this->Staff_model->proupdate($pro_id,$newpro,$table);
			}
			$result = $this->Staff_model->get_seller($this->session->userdata('sname'));
			foreach ($result as $row) {
				$id = $row->sellerid;
				$salesamount = $row->salesamount + $amount;
				$newsales = array(
											'sellerid' => $id,
											'salesamount' => $salesamount
										);
				$this->Staff_model->supdate($id,$newsales);
			}
			redirect('Staff/orders');
		} else {
			redirect('Home');
		}

	}

	public function relation() {
		if ($this->session->userdata('s_logged_in') == TRUE) {
			$data['delivery'] = $this->Staff_model->get_delivery();
			$this->form_validation->set_rules('delivery','delivery','required');
			if($this->form_validation->run() == FALSE) {
				$data['msg'] = NULL;
				$this->load->view('common/header');
				$this->load->view('nav/staffnav');
				$this->load->view('staff/relations',$data);
				$this->load->view('common/footer');
			}else{
				$result = $this->Staff_model->get_del($this->input->post('delivery'));
				foreach ($result as $row) {
					$name = $row->dname;
					$sname = $this->session->userdata('sname');
					$id = $row->delid;
				}
				$newd = array(
										'delid' => $id,
										'sname' => $sname
									 );
				$this->Staff_model->dupdate($id, $newd);
				$result1 = $this->Staff_model->get_seller($this->session->userdata('sname'));
				foreach ($result1 as $row) {
					$id = $row->sellerid;
					$new = array(
											'sellerid' => $id,
											'dname' => $name
										 );
						$this->Staff_model->supdate($id, $new);
						$data['msg'] = "you have successfuly created a relation, from now on all deliveries will be done by: ".$name;
						$this->load->view('common/header');
						$this->load->view('nav/staffnav');
						$this->load->view('staff/relations',$data);
						$this->load->view('common/footer');
				}
			}
		} else {
			redirect('Home');
		}
	}

	public function check() {
		$id = $this->uri->segment(3);
		$order = $this->Staff_model->getorder($id);
		foreach ($order as $row) {
			$newdate = date( "d", strtotime($row->date) + 24 * 3600 );
			$product = $row->product;
			$seller = $row->seller;
			$table = $row->tables;
			$amount = $row->amount;
		}
		if ($newdate < date("d",strtotime(unix_to_human(time())))) {
			$result = $this->Staff_model->fetch_order($product,$seller,$table);
			foreach ($result as $row) {
				$pro_id = $row->id;
				$new = array(
									 'id' => $pro_id,
									 'amount' => $row->amount + $amount
									);
				$this->Staff_model->update($table,$pro_id,$new);
			}
			$this->Staff_model->delete($id);
			redirect('Staff/orders');
		}else{
			redirect('Staff/orders');
		}
	}

	public function stat() {
		if($this->session->userdata('s_logged_in') == TRUE){
			$data['result'] = $this->Staff_model->getnotpaidorders($this->session->userdata('sname'));
			$this->load->view('common/header');
			$this->load->view('nav/staffnav');
			$this->load->view('staff/paystat',$data);
			$this->load->view('common/footer');
		}else{
			redirect('Home/staff');
		}
	}

	public function change() {
		if ($this->session->userdata('s_logged_in') == TRUE) {
			$id = $this->uri->segment(3);
			$order = $this->Staff_model->getorder($id);
			foreach ($order as $row) {
				$new = array(
									 'id' => $row->id,
									 'paystat' => 1
									);
				if($this->Staff_model->updateorder($id,$new)) {
					redirect('Staff/orders');
				}else{
					redirect('Staff/stat');
				}
			}
		} else {
			redirect('Home');
		}

	}

	public function owner() {
		if($this->session->userdata('o_logged_in') == TRUE){
			$data['result'] = $this->Staff_model->sellers();
			$data['result1'] = $this->Staff_model->delivery();
			$data['report'] = $this->Chart_model->report();
			$this->load->view('common/header');
			$this->load->view('nav/ownernav');
			$this->load->view('staff/owner',$data);
			$this->load->view('common/footer');
		}else{
			redirect('Home/staff');
		}
	}

	public function add() {
		if($this->session->userdata('o_logged_in') == TRUE) {
			// set validation rule
			$this->form_validation->set_rules('full_name', 'Full_Name', 'required|min_length[1]|max_length[100]');
	  	$this->form_validation->set_rules('user_name', 'User_Name', 'required|min_length[1]|max_length[50]');
	  	$this->form_validation->set_rules('email', 'Email', 'required|min_length[1]|max_length[100]|valid_email');
	  	$this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[1]|max_length[10]');
			$this->form_validation->set_rules('kebele', 'Kebele', 'required|min_length[1]|max_length[10]');
			$this->form_validation->set_rules('houseno', 'House number', 'required|min_length[1]|max_length[10]');
			$this->form_validation->set_rules('reg', 'Register', 'required');
	  	if($this->form_validation->run()==FALSE) {
		    $this->load->view('common/header');
				$this->load->view('nav/ownernav');
		    $this->load->view('staff/add');
		    $this->load->view('common/footer');
			}else{
				if($this->Staff_model->uname_email_check($this->input->post('email'),$this->input->post('user_name'))) {
					if ($this->input->post('reg') == 1) {
						$user_type = 1;
					} else {
						$user_type = 2;
					}
					$pass = 12345;
					$hash = password_hash($pass,PASSWORD_DEFAULT);
					$seller = array(
												'uname' => $this->input->post('user_name'),
												'fname' => $this->input->post('full_name'),
												'email' => $this->input->post('email'),
												'password' => $hash,
												'kebele' => $this->input->post('kebele'),
												'housenumber' => $this->input->post('houseno'),
												'mobile' => $this->input->post('mobile'),
												'user_type' => $user_type,
											);
					$this->Staff_model->insertseller($seller);
					if ($this->input->post('reg') == 1) {
						$sellers = array(
													 'sellername' => $this->input->post('user_name'),
													 'tillnumber' => $this->input->post('till_number')
												);
						$this->Staff_model->insertsellers($sellers);
					} else {
						$delivery = array(
													 'dname' => $this->input->post('user_name'),
													 'tillnumber' => $this->input->post('till_number')
												);
						$this->Staff_model->insertdelivery($delivery);
					}
					redirect('Staff/owner');
				}else{
					$this->load->view('common/header');
					$this->load->view('nav/ownernav');
					$this->load->view('Staff/add');
					$this->load->view('common/footer');
				}
			}
		}else{
			redirect('Home/staff');
		}
	}

	public function shipping() {
		if($this->session->userdata('sh_logged_in') == TRUE){
			$shname = $this->session->userdata('shname');
			$delivery = $this->Staff_model->getdelivery($shname);
			foreach ($delivery as $row) {
				$sellername = $row->sname;
			}
			$data['result'] = $this->Staff_model->getorderss($sellername);
			$this->load->view('common/header');
			$this->load->view('nav/shippingnav');
			$this->load->view('staff/shipping',$data);
			$this->load->view('common/footer');
		}else{
			redirect('Home/staff');
		}
	}

	public function deliverd() {
		if ($this->session->userdata('sh_logged_in') == TRUE) {
			$id = $this->uri->segment(3);
			$result = $this->Staff_model->getorder($id);
			foreach ($result as $row) {
				$sellername = $row->seller;
				$amount = $row->amount;
			}
			$onew = array(
									'id' => $id,
									'dstat' => 1
								);
			$this->Staff_model->oupdate($id,$onew);
			$result1 = $this->Staff_model->get_seller($sellername);
			foreach ($result1 as $row) {
				$delname = $row->dname;
			}
			$result2 = $this->Staff_model->getdelivery($delname);
			foreach ($result2 as $row) {
				$delid = $row->delid;
				$damount = $row->damount + $amount;
			}
			$dnew = array(
									'delid' => $delid ,
									'damount' => $damount
								);
			$this->Staff_model->dupdate($delid,$dnew);
			redirect('Staff/shipping');
		} else {
			redirect('Home');
		}

	}

	public function terminate() {
		if ($this->session->userdata('o_logged_in') == TRUE) {
			$data['user'] = $this->Staff_model->get_user();
			$this->form_validation->set_rules('user','user','required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('common/header');
				$this->load->view('nav/ownernav');
				$this->load->view('staff/terminate',$data);
				$this->load->view('common/footer');
			} else {
				$id = $this->input->post('user');
				$result = $this->Staff_model->getuser($id);
				foreach ($result as $row) {
					$name = $row->uname;
				}
				if($result2 = $this->Staff_model->get_seller($name)) {
					foreach ($result2 as $row) {
						$sid = $row->sellerid;
					}
					$this->Staff_model->sdelete($sid);
				}elseif($result2 = $this->Staff_model->getdelivery($name)) {
					foreach ($result2 as $row) {
						$did = $row->delid;
					}
					$this->Staff_model->ddelete($did);
				}
				$this->Staff_model->udelete($id);
				redirect('Staff/logout');
			}
		} else {
			redirect('Home');
		}

	}

	public function article() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			//pagination settings
	    $config['base_url'] = site_url('Staff/article');
	    $config['total_rows'] = $this->db->count_all('hottopics');
	    $config['per_page'] = "5";
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
      // get news list
			$id = $this->session->userdata('sid');
      $data['topiclist'] = $this->Staff_model->get_article($id,$config["per_page"], $data['page'], NULL);
      $data['pagination'] = $this->pagination->create_links();
      // load view
      $this->load->view('common/header');
			$this->load->view('nav/staffnav');
      $this->load->view('staff/article',$data);
      $this->load->view('common/footer');
    }else {
      redirect('Home');
    }
	}

	public function search() {
		if($this->session->userdata('s_logged_in') == TRUE) {
      // get search string
      $search = ($this->input->post("topic"))? $this->input->post("topic") : "NIL";
      $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
      // pagination settings
      $config = array();
      $config['base_url'] = site_url("Staff/search/$search");
      $config['total_rows'] = $this->Staff_model->get_article_count($search);
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
      // get news list
			$id = $this->session->userdata('sid');
      $data['topiclist'] = $this->Staff_model->get_article($id,$config['per_page'], $data['page'], $search);
      $data['pagination'] = $this->pagination->create_links();
      //load view
      $this->load->view('common/header');
			$this->load->view('nav/staffnav');
      $this->load->view('staff/article',$data);
      $this->load->view('common/footer');
	    }else {
	      redirect('Home');
	    }
	}

	public function edit() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$this->form_validation->set_rules('id', 'id', 'required|min_length[1]|max_length[10]|integer|is_natural');
			$this->form_validation->set_rules('topic','Topic','required');
			$this->form_validation->set_rules('disc','Description','required');
			if ($this->input->post()) {
				$id = $this->input->post('id');
			}else {
				$id = $this->uri->segment(3);
			}
			if($this->form_validation->run() == FALSE) {
				$data['query'] = $this->Staff_model->getarticle($id);
				$this->load->view('common/header');
				$this->load->view('nav/staffnav');
				$this->load->view('staff/edit_article',$data);
	      $this->load->view('common/footer');
			}else {
				$article = array(
									'id' => $id,
	            		'topic' => $this->input->post('topic'),
	            	  'disc' => $this->input->post('disc')
	            		);
	      $this->Staff_model->a_update($id,$article);
				$data['query'] = $this->Staff_model->getarticle($id);
				redirect('Staff/article','refresh');
			}
		}else {
			redirect('Home');
		}
	}

	public function delete() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$this->form_validation->set_rules('id', 'id', 'required|min_length[1]|max_length[10]|integer|is_natural');
			if ($this->input->post()) {
				$id = $this->input->post('id');
			}else {
				$id = $this->uri->segment(3);
			}
			if($this->form_validation->run() == FALSE) {
				$data['query'] = $this->Staff_model->getarticle($id);
				$this->load->view('common/header', $data);
				$this->load->view('nav/staffnav');
				$this->load->view('staff/delete_article', $data);
				$this->load->view('common/footer', $data);
			}else {
				if ($this->Staff_model->delete($id)) {
					redirect('Home/article');
				}
			}
		}else {
			redirect('Home');
		}
	}

	public function new() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$data['type'] = $this->Staff_model->get_type();
			$data['subtype'] = $this->Staff_model->get_subtype();
			$this->form_validation->set_rules('type','Type','required');
			$this->form_validation->set_rules('subtype','Subtype','required');
			if($this->form_validation->run() == FALSE) {
				$this->load->view('common/header');
				$this->load->view('nav/staffnav');
				$this->load->view('staff/newproduct',$data);
				$this->load->view('common/footer',$data);
			}else{
				$data1['type'] = $this->input->post('type');
				$subtype = $this->input->post('subtype');
				if($subtype == 1) {
						$this->load->view('common/header');
						$this->load->view('nav/staffnav');
						$this->load->view('staff/products/camera',$data1);
						$this->load->view('common/footer');
				}elseif($subtype == 2) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/desktop',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 3) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/gaminglaptop',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 4) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/gamingtools',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 5) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/harddisk',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 6) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/headphone',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 7) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/ipad',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 8) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/laptop',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 9) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/mobile',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 10) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/motherboard',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 11) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/pcgames',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 12) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 13) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/ram',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 14) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/tablet',$data1);
					$this->load->view('common/footer');
				}elseif($subtype == 15) {
					$this->load->view('common/header');
					$this->load->view('nav/staffnav');
					$this->load->view('staff/products/xbox',$data1);
					$this->load->view('common/footer');
				}
			}
		}else{
			redirect('Home');
		}
	}

	public function old() {
		if($this->session->userdata('s_logged_in') == TRUE){
			$data['type'] = $this->Staff_model->get_type();
			$data['subtype'] = $this->Staff_model->get_subtype();
			$this->form_validation->set_rules('type','Type','required');
			$this->form_validation->set_rules('subtype','Subtype','required');
			$this->form_validation->set_rules('pro_name','Product name','required');
			$this->form_validation->set_rules('amount','Amount','required');
			if($this->form_validation->run() == FALSE) {
				$this->load->view('common/header');
				$this->load->view('nav/staffnav');
				$this->load->view('staff/old',$data);
				$this->load->view('common/footer',$data);
			}else{
				$subtype = $this->input->post('subtype');
				$pro_name = $this->input->post('pro_name');
				$amount = $this->input->post('amount');
				$result = $this->Staff_model->subtype($subtype);
				foreach ($result as $row) {
					$table = $row->name;
				}
				$result1 = $this->Staff_model->product($table, $pro_name);
				foreach ($result1 as $row) {
					$id = $row->id;
					$new = array(
										 'id' => $row->id,
										 'amount' => $row->amount + $amount
										);
					if($this->Staff_model->update($table, $id, $new)) {
						redirect('Staff');
					}else{
						redirect('Staff/old');
					}

				}
			}
		}else{
			redirect('Home');
		}
	}

	public function camera() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/camera/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'lensesize' => $this->input->post('lensesize'),
								'sdcard' => $this->input->post('sdcard'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->camera($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function laptop() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/laptop/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'processor' => $this->input->post('processor'),
								'hdd' => $this->input->post('hdd'),
								'ram' => $this->input->post('ram'),
								'graphics' => $this->input->post('graphics'),
								'connectivity' => $this->input->post('connectivity'),
								'usb' => $this->input->post('usb'),
								'cam' => $this->input->post('cam'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->laptop($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function gaminglaptop() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/gaminglaptop/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'processor' => $this->input->post('processor'),
								'hdd' => $this->input->post('hdd'),
								'ram' => $this->input->post('ram'),
								'resolution' => $this->input->post('resolution'),
								'graphics' => $this->input->post('graphics'),
								'batterylife' => $this->input->post('batterylife'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->gaminglaptop($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function mobile() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/mobile/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'memory' => $this->input->post('memory'),
								'ram' => $this->input->post('ram'),
								'display' => $this->input->post('display'),
								'camera' => $this->input->post('camera'),
								'batterylife' => $this->input->post('batterylife'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->mobile($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function motherboard() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/motherboard/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'expansionslot' => $this->input->post('expansionslot'),
								'ramslot' => $this->input->post('ramslot'),
								'cpusocket' => $this->input->post('cpusocket'),
								'bios' => $this->input->post('bios'),
								'cmosbattery' => $this->input->post('cmosbattery'),
								'connector' => $this->input->post('connector'),
								'usb' => $this->input->post('usb'),
								'powerconnector' => $this->input->post('powerconnector'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->motherboard($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function pcgames() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/pcgames/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->pcgames($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function desktop() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/desktop/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
										'sellername' => $this->session->userdata('sname'),
										'name' => $this->input->post('name'),
										'brand' => $this->input->post('brandname'),
										'processor' => $this->input->post('processor'),
										'hdd' => $this->input->post('hdd'),
										'ram' => $this->input->post('ram'),
										'graphics' => $this->input->post('graphics'),
										'type' => $this->input->post('type'),
										'price' => $this->input->post('price'),
										'amount' => $this->input->post('amount'),
										'img' => $data['upload_data']['file_name']
										);
					$this->Staff_model->desktop($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function harddisk() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/harddisk/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'size' => $this->input->post('size'),
								'usb' => $this->input->post('usb'),
								'cache' => $this->input->post('cache'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->harddisk($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function ram() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/ram/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'size' => $this->input->post('size'),
								'pin' => $this->input->post('pin'),
								'ramtype' => $this->input->post('ramtype'),
								'model' => $this->input->post('model'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->ram($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function headphone() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/headphone/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'features' => $this->input->post('features'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->headphone($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function ipad() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/ipad/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'screensize' => $this->input->post('screensize'),
								'connection' => $this->input->post('connection'),
								'memory' => $this->input->post('memory'),
								'tools' => $this->input->post('tools'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->ipad($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function tablet() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/tablet/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
	    }else {
	        $data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'screensize' => $this->input->post('screensize'),
								'processor' => $this->input->post('processor'),
								'memory' => $this->input->post('memory'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->tablet($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function gamingtools() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/gamingtools/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
			}else {
					$data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'tooltype' => $this->input->post('tooltype'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->gamingtools($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function xbox() {
		if($this->session->userdata('s_logged_in') == TRUE) {
			$config['upload_path']          = './proimages/xbox/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $this->input->post('name');

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				redirect('Staff/new');
			}else {
					$data = array('upload_data' => $this->upload->data());
					$pro = array(
								'sellername' => $this->session->userdata('sname'),
								'name' => $this->input->post('name'),
								'brand' => $this->input->post('brandname'),
								'size' => $this->input->post('size'),
								'type' => $this->input->post('type'),
								'price' => $this->input->post('price'),
								'amount' => $this->input->post('amount'),
								'img' => $data['upload_data']['file_name']
							);
					$this->Staff_model->xbox($pro);
					redirect('Staff/products');
			}
		}else{
			redirect('Home');
		}
	}

	public function products() {
		$data['sellername'] = $this->session->userdata('sname');
		$data['camera'] = $this->Staff_model->get_camera($data['sellername']);
		$data['laptop'] = $this->Staff_model->get_laptop($data['sellername']);
		$data['gaminglaptop'] = $this->Staff_model->get_gaminglaptop($data['sellername']);
		$data['mobile'] = $this->Staff_model->get_mobile($data['sellername']);
		$data['motherboard'] = $this->Staff_model->get_motherboard($data['sellername']);
		$data['pcgames'] = $this->Staff_model->get_pcgames($data['sellername']);
		$data['desktop'] = $this->Staff_model->get_desktop($data['sellername']);
		$data['harddisk'] = $this->Staff_model->get_harddisk($data['sellername']);
		$data['ram'] = $this->Staff_model->get_ram($data['sellername']);
		$data['headphone'] = $this->Staff_model->get_headphone($data['sellername']);
		$data['ipad'] = $this->Staff_model->get_ipad($data['sellername']);
		$data['tablet'] = $this->Staff_model->get_tablet($data['sellername']);
		$data['gamingtools'] = $this->Staff_model->get_gamingtools($data['sellername']);
		$data['xbox'] = $this->Staff_model->get_xbox($data['sellername']);
		$this->load->view('common/header');
		$this->load->view('nav/staffnav');
		$this->load->view('staff/products',$data);
		$this->load->view('common/footer');
	}

	public function populate_subtype() {
  	$id = $this->input->post('id');
		echo(json_encode($this->Staff_model->get_subtype($id)));
  }

	public function logout() {
		$this->session->sess_destroy();
		redirect('Home', 'refresh');
	}

}
