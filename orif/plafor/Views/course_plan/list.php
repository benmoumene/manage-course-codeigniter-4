<?php
/**
 * Users List View
 *
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>
<div class="container">
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="<?= base_url('apprentice/list_apprentice/') ?>" class="nav-link"><?= lang('user_lang.admin_apprentices'); ?></a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('plafor/admin/list_course_plan/') ?>" class="nav-link active"><?= lang('user_lang.admin_course_plans'); ?></a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('plafor/admin/list_competence_domain/') ?>" class="nav-link"><?= lang('user_lang.admin_competence_domains'); ?></a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('plafor/admin/list_operational_competence/') ?>" class="nav-link"><?= lang('user_lang.admin_operational_competences'); ?></a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('plafor/admin/list_objective/') ?>" class="nav-link"><?= lang('user_lang.admin_objectives'); ?></a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= lang('user_lang.title_course_plan_list'); ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 text-left">
            <a href="<?= base_url('plafor/admin/save_course_plan'); ?>" class="btn btn-primary">
                <?= lang('common_lang.btn_add_m'); ?>
            </a>
        </div>
    </div>
    <div class="row mt-2">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><?= lang('user_lang.field_course_plan_official_name'); ?></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody id="course_planslist">
            <?php foreach($course_plans as $course_plan) { ?>
                <tr>
                    <td><a href="<?= base_url('plafor/admin/list_competence_domain/'.$course_plan['id']); ?>"><span class="font-weight-bold"><?= $course_plan['formation_number']?></span><?= $course_plan['official_name']; ?></td>
                    <td><a href="<?= base_url('apprentice/view_course_plan/'.$course_plan['id'])?>"><?= lang('common_lang.btn_details')?></a></td>
                    <td><a href="<?= base_url('plafor/admin/save_course_plan/'.$course_plan['id']); ?>"><?= lang('common_lang.btn_update')?></a></td>
                    <td><a href="<?= base_url('plafor/admin/delete_course_plan/'.$course_plan['id']); ?>" class="close">×</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#toggle_deleted').change(e => {
            let checked = e.currentTarget.checked;
            $.post('<?=base_url();?>plafor/admin/list_course_plan/'+(+checked), {}, data => {
                $('#course_planslist').empty();
                $('#course_planslist')[0].innerHTML = $(data).find('#course_planslist')[0].innerHTML;
            });
        });
    });
</script>