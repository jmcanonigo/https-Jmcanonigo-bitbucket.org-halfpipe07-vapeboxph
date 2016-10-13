<?php
class Settings_model extends CI_Model {

	public function __construct()	{
		parent::__construct();
	}

	public function get_value_by_key($key) {
	  if($key != FALSE) {
	    $query = $this->db->get_where('settings', array('k' => $key));
	    return $query->row_array()['v'];
	  }
	}

	public function update_settings_by_key($key, $value) {
        $this->v = $value;

        if(!!$this->get_value_by_key($key) == TRUE) {
        	if($this->db->update('settings', $this, array('k' => $key))) {
				return $key;
			}
        }
        return FALSE;
	}

}
?>