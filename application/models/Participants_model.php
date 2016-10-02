<?php
class Participants_model extends CI_Model {

	public function __construct()	{
		parent::__construct();
	}

	public function get_participants_by_id($id) {
	  if($id != FALSE) {
	    $query = $this->db->get_where('participants', array('id' => $id));
	    return $query->row_array();
	  }
	  else {
	    return FALSE;
	  }
	}

	public function get_participants_by_email($email) {
	  if($email != FALSE) {
	    $query = $this->db->get_where('participants', array('email' => $email));
	    return $query->row_array();
	  }
	  else {
	    return FALSE;
	  }
	}

	public function add_participants($fname, $lname, $email, $mobile) {
		if($this->get_participants_by_email($email) != TRUE) {
			$this->fname    = $fname;
	        $this->lname  	= $lname;
	        $this->email    = $email;
	        $this->mobile   = $mobile;

	        $this->db->insert('participants', $this);
	        return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function update_participants($id, $prize) {
        $this->prize = $prize;
        if(!!$this->get_participants_by_id($id) == TRUE) {
        	if($this->db->update('participants', $this, array('id' => $id))) {
				return $id;
			}
        }
        return FALSE;
	}

}
?>