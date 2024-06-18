<?php namespace App\Models;

use CodeIgniter\Model;

class CrowdfundingModel extends Model
{
    protected $table = 'tbl_crowdfunding';
    protected $primaryKey = 'fld_id';
    protected $allowedFields = ['fld_name','fld_activity','fld_money','fld_status','fld_pid','fld_date','fld_aid','fld_transaction'];

}

?>