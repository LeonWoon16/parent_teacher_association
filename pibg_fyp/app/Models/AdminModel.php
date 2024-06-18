<?php namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'tbl_admin';
    protected $primaryKey = 'fld_id';
    protected $allowedFields = ['fld_name','fld_password','fld_email','fld_role'];

}

?>