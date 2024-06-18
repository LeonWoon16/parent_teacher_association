<?php namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table = 'tbl_activity';
    protected $primaryKey = 'fld_id';
    protected $allowedFields = ['fld_name','fld_description','fld_date','fld_budget','fld_help','fld_participants'];

}

?>