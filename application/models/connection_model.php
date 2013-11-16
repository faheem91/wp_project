<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Connection_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	public function get_friend_list(){
		$index = 0;
		$userid = $this->session->userdata('userid');
		$this->db->where('userId2', $userid);
		$query = $this->db->get('requests');
		foreach($query->result() as $item)
		{

			$this->db->where('userid',$item->userId1);
			$query1 = $this->db->get('users');
			$res = $query1->row(1);
			$data[$index] = $res;
			$index++;
		}

		return $data;

	}
	
	public function accept_friend(){

		
		$choice = $this->input->post('addignore');
		$userid = $this->session->userdata('userid');
		$friendid = $this->input->post('friendid');
		$del = array(
			'userId2' => $userid,
			'userId1' => $friendid
		);
		
		$this->db->delete('requests', $del); 

		if($choice!='Ignore')
		{
			
			$data = array(
			'userId1' => $userid,
			'userId2' => $friendid
			);
			$this->db->insert('connections', $data);
			$data1 = array(
			'userId2' => $userid,
			'userId1' => $friendid
			);
			$this->db->insert('connections', $data1);
			return true;
		}
		return false;
		
		
	//	echo $this->input->post('userid');
	
		
		
	}
}
?>