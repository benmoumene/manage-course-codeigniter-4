<?php
namespace Plafor\Models;

use CodeIgniter\Model;

class CoursePlanModel extends Model{
    protected $table='course_plan';
    protected $primaryKey='id';
    protected $allowedFields=['formation_number','official_name','date_begin'];
    protected $useSoftDeletes=true;
    protected $deletedField='archive';


}


?>