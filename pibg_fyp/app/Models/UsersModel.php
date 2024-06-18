<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'tbl_teacher';
    protected $primaryKey = 'fld_id';
    protected $allowedFields = ['fld_name','fld_password','fld_email','fld_phone','fld_role','fld_address','fld_dob'];

}

?>