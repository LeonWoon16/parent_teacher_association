<?php namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'tbl_children';
    protected $primaryKey = 'fld_id';
    protected $allowedFields = ['fld_name','fld_class','fld_year','fld_ic','fld_gender','fld_pid','fld_parent','fld_dob','fld_status'];

}

?>