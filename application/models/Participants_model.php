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

	public function get_participants_by_status($status) {
	  if($status != FALSE) {
	    $query = $this->db->get_where('participants', array('status' => $status));
	    return $query->result_array();
	  }
	  else {
	    return FALSE;
	  }
	}

	public function add_participants($fname, $lname, $email, $mobile, $ref_id) {
		$sel_participant = $this->get_participants_by_email($email);
		if($sel_participant != TRUE) {
			$this->fname    = $fname;
	        $this->lname  	= $lname;
	        $this->email    = $email;
	        $this->mobile   = $mobile;
	        $this->ref_id   = $ref_id;

	        $this->db->insert('participants', $this);
	        return $this->db->insert_id();
		} else if ($sel_participant['prize'] > 0) {
			return FALSE;
		} else {
			return $sel_participant['id'];
		}
	}

	public function update_participants($id, $prize) {
        $this->prize = $prize;
        $this->status = $prize > 0 ? "new" : "returned";
        if(!!$this->get_participants_by_id($id) == TRUE) {
        	if($this->db->update('participants', $this, array('id' => $id))) {
				return $id;
			}
        }
        return FALSE;
	}

	public function update_participants_tf($id, $address, $claim, $plan, $payment, $cost) {
        
        $this->address = $address;
        $this->claim_option = $claim;
        $this->plan = $plan;
        $this->payment = $payment;
        $this->cost = $cost;
        $this->status = "to claim";

        date_default_timezone_set('Asia/Hong_Kong');
        $this->date_entered = date('Y-m-d H:i:s');

        if(!!$this->get_participants_by_id($id) == TRUE) {
        	if($this->db->update('participants', $this, array('id' => $id))) {
				return $this->get_participants_by_id($id);
			}
        }
        return FALSE;
	}

}
?>