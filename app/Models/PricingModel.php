<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class PricingModel extends Model
{
	protected $table			= 'harga_paket';
	protected $primaryKey		= 'kode_harga_paket';
	protected $returnType		= 'array';
	protected $allowedFields 	= '';
	protected $request;
	protected $db;
	protected $dt;

	public function getpaketdetail($paket)
	{
		return $this->where('kode_harga_paket !=', 'HPKT001')->where('kode_harga_paket', $paket)->where('is_ready',1)->first();
	}

	function getFaq()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('faq');
		return $builder->get()->getResultArray();
	}
	
	public function getmemberdisc(){
		$db      = \Config\Database::connect();
		$builder = $db->table('m_jenis_member');
		
		return $builder->select('m_jenis_member.kode_jenis_member, jenis_member, disc_val')
					->join('disc_member d','d.kode_jenis_member=m_jenis_member.kode_jenis_member')->get()->getResultArray();
	}
}
