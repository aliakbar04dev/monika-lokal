<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KomunitasModel extends CI_Model {
	function check($input)
	{
		$result = $this->db->get_where('account', array('client_id' => $input));
		return $result->row_object();
	}
}