<?php namespace App\Models;

use CodeIgniter\Model;

class ParticipantModel extends Model
{
    protected $table = 'tbl_participant';
    protected $primaryKey = 'participantID';
    protected $allowedFields = ['fld_aid','fld_activity','fld_pid','fld_name','fld_phone','fld_email'];

}

?>