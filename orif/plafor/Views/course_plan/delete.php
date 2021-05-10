<?php
$courses=\Plafor\Models\CoursePlanModel::getUserCourses($course_plan['id']);
$apprentices=[];
$userCourseStatus=[];
foreach ($courses as $course){
    $apprentices[]=\Plafor\Models\UserCourseModel::getUser($course['fk_user']);
    $userCourseStatus[]=\Plafor\Models\UserCourseModel::getUserCourseStatus($course['fk_status']);
}
/**@TODO
 * Make situation when there are multiple apprentices associated with the same Course Plan
 **/
?>
<div id="page-content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <h1><?= lang('user_lang.apprentice').' "'.$apprentices[0]['username'].'"' ?></h1>
                    <h1><?= lang('user_lang.course_plan').' "'.$course_plan['official_name'].'"' ?></h1>
                    <h1><?= lang('user_lang.status').' "'.$userCourseStatus[0]['name'].'"' ?></h1>
                    <h4><?= lang('user_lang.what_to_do')?></h4>
                    <div class = "alert alert-info" ><?= lang('user_lang.user_course_disable_explanation')?></div>
                </div>
                <div class="text-right">
                    <a href="<?= base_url('apprentice/view_user_course/'.$apprentices[0]['id']); ?>" class="btn btn-default">
                        <?= lang('common_lang.btn_cancel'); ?>
                    </a>
                    <a href="<?= base_url(uri_string().'/1'); ?>" class="btn btn-danger">
                        <?= lang('common_lang.btn_disable'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
