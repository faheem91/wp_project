<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Search_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	public function search_main(){
		// grab user input
		
		$firstName = $this->security->xss_clean($this->input->post('firstName'));
		$lastName = $this->security->xss_clean($this->input->post('lastName'));
		$company=$this->security->xss_clean($this->input->post('company'));
		$school=$this->security->xss_clean($this->input->post('school'));
		$keywords = $this->security->xss_clean($this->input->post('keywords'));
		$keywords_box = $this->security->xss_clean($this->input->post('keywordsbox'));
	//	$this->db->select('*');
		$this->db->from('users');
		$this->db->join('profile', 'users.userid = profile.userId');
		$this->db->join('education', 'education.userId = profile.userId');
		$this->db->join('institution','education.institutionId = institution.institutionId');
		//$this->db->join('job','job.userId = users.userid');
		//$this->db->join('company','job.CompanyId = company.CompanyId');
		//$this->db->join('education','profile.userId = education.userId');
		//$this->db->join('institution','education.institutionId = institution.institutionId');

		if($keywords != '' || $keywords_box != '')
		{	
			// Prep the query
			$this->db->where('fname', $keywords);
			$this->db->or_where('lname',$keywords);
			//$this->db->or_where('companyName', $keywords);
			$this->db->or_where('name', $keywords);
			
			
			
		}
		if($firstName != '')
		{	
			// Prep the query
			$this->db->where('fname', $firstName);
			
		}
		if($lastName != '')
		{	
			// Prep the query
			$this->db->where('lname', $lastName);
			
		}
		if($company != '')
		{	
			// Prep the query
			$this->db->where('companyName', $company);
			
		}
		if($school != '')
		{	
			// Prep the query
			$this->db->where('name', $school);
			
		}
		$query = $this->db->get();
			// Let's check if there are any results
			if($query->num_rows >= 1)
			{
				
			    return $query->result();
			   
			}
			//echo var_dump($query);
			return NULL;
		
}

	public function get_add_friend(){

		$id = $this->input->post('addignore');
		$this->db->where('userid', $id);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0)
		{
			return $query->row(1);
		}
		
	}
	public function add_friend(){

		//echo 'THE ID IS '.$this->input->post('userid');
		
		
		$friendid = $this->input->post('userid');
		$userid = $this->session->userdata('userid');
		
		
	//	echo $this->input->post('userid');
		$data = array(
			'userId1' => $userid,
			'userId2' => $friendid
		);
		if($this->db->insert('requests', $data))
		{
			return true;
		}
		return false;
		
		
	}
}
?>