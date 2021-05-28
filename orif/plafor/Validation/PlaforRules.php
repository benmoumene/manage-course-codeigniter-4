<?php


namespace Plafor\Validation;


use Plafor\Models\CoursePlanModel;

class PlaforRules
{
    public function checkFormPlanNumber($number, &$error){
        if(count((new CoursePlanModel())->getWhere(['formation_number'=>$number])->getResultArray())>0){
            $error= lang('user_lang.form_number_not_unique');
            return false;
        }

        return true;
    }

}