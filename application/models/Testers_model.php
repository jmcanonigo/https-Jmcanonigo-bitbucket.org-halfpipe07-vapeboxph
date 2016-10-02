<?php
class Testers_model extends CI_Model {

	public function __construct()	{
		parent::__construct();
	}

	public function get_tester() {
	    $this->db->where('quantity > 0');
	    $this->db->from('testers');
	    $selected = rand(0, $this->db->count_all_results() - 1);

	    $query = $this->db->get_where('testers', 'quantity > 0', 1, $selected);
	    return $query->row_array();
	}

	public function inventory($id, $add_or_subtract) {
		if($add_or_subtract == 'add') {
			$this->db->set('quantity', 'quantity+1', FALSE);
		} else {
			$this->db->set('quantity', 'quantity-1', FALSE);
		}
		$this->db->where('id', $id);
		return $this->db->update('testers');
	}

}
?>