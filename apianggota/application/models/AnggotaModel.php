<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnggotaModel extends CI_Model {
	function check($input)
	{
		$result = $this->db->get_where('tb_user', array('email' => $input));
		return $result->row_object();
	}
}