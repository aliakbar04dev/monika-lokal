<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactusModel extends Model
{
    protected $table = 'contact_us';
    protected $primaryKey = 'id_contact_us';
	protected $allowedFields = ['nama', 'email', 'no_hp', 'isi_pesan'];
}
