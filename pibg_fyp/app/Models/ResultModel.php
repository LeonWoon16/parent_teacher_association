<?php namespace App\Models;

use CodeIgniter\Model;

class ResultModel extends Model
{
    protected $table = 'tbl_result';
    protected $primaryKey = 'result_id';
    protected $allowedFields = ['fld_id','fld_class','fld_type','fld_bm','fld_bi','fld_history','fld_science','fld_maths','fld_marks','fld_description'];

}

?>