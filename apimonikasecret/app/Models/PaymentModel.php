<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 't_pembayaran';
    protected $primaryKey = 'kode_pembayaran';
    protected $allowedFields = ['kode_pembayaran', 'id_user', 'email_user', 'kode_paket', 'nama_paket', 'harga_paket', 'disc_per', 'disc_val', 'langganan',
                                'total', 'created_at', 'pay_method', 'bank', 'number_code', 'expire_date', 'status_pembayaran', 'description', 'link_midtrans'];
}
