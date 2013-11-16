<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */
class Connection extends CI_Controller{
		function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index(){
		// Load our view to be displayed
		// to the user
		$this->load->helper('url');
		$this->load->model('connection_model');
		$res = $this->connection_model->get_friend_list();
		$data['list'] = $res;

		if($this->session->userdata('username')){
			$this->load->model('signup_model');
		// Validate the user can login
		$id = $this->signup_model->getProfileImage();
			
				$data["pic_url"]='uploads/30_'.$id.'.jpg';
				$fname=$this->session->userdata('fname');
				$lname=$this->session->userdata('lname');
				$fullname=$fname." ".$lname;
				//$another=base_url();
				//$anotherData='http://'.$another.$data["pic_url"];

				$data["fullname"]=$fullname;
				
				

			$this->load->view('common/header');
			$this->load->view('connections/friends_add_list.php',$data);
		}else{
			$data['msg'] = $msg;
			$data['heading'] = "Login";
			$this->load->view('common/header');
			//$this->load->view('loginView/login_view', $data)
			$this->load->view('myview/default_main_page.php');
		}


		//$this->load->view('common/footer',$data);
	}

public function acceptfriend(){
	

	$this->load->model('connection_model');
	$x = $this->connection_model->accept_friend();
	if($x)
	{
		$data['message'] = "Friend added";
	}
	else
	{
		$data['message'] = "Friend ignored";
	}
	
		$this->load->view('common/header.php');
		$this->load->view('search/friendadded.php',$data);
}	
}
?>