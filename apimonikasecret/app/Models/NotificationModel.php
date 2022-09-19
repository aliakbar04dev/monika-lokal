<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 't_notif';
    protected $primaryKey = 'id_notif';
    protected $allowedFields = ['kode_notif', 'email_user', 'tittle', 'description', 'is_broadcast'];
}
