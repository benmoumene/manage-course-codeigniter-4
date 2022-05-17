<?php
$is_admin = service('session')->get('user_access') >= config('\User\Config\UserConfig')->access_lvl_admin;
?>
<div class="container">
    <?=view('\Plafor\templates\navigator',['title'=>lang('plafor_lang.title_view_course_plan')])?>
    <div class="row">
        <div class="col-12">
            <p class="bg-primary text-white"><?=lang('plafor_lang.title_view_course_plan')?></p>
        </div>
        <div class="col-12">
            <p class="font-weight-bold"><?=$course_plan['official_name']?></p>
        </div>
        <div class="col-12">
            <p><?= lang('plafor_lang.number_abr').' '.$course_plan['formation_number'].', '
               .mb_strtolower(lang('plafor_lang.field_course_plan_into_effect')).' '.$course_plan['date_begin']?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="bg-primary text-white"><?=lang('plafor_lang.title_view_competence_domains_linked')?></p>
        </div>
        <div class="col-12">
            <?php if($is_admin):?>
                <a href="<?=base_url('plafor/courseplan/save_competence_domain/'.'0/'.$course_plan['id'])?>" class="btn btn-primary"><?=lang('common_lang.btn_new_m')?></a>
            <?php endif; ?>

            <table class="table table-hover mt-2">
            <thead>
                <tr>
                    <th><span class="font-weight-bold"><?=lang('plafor_lang.symbol')?></span></th>
                    <th><span class="font-weight-bold"><?=lang('plafor_lang.competence_domain')?></span></th>
                    <?php if($is_admin):?>
                        <th></th>
                        <th></th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($competence_domains as $competence_domain){ ?>
                    <tr>
                        <td><a href="<?= base_url('plafor/courseplan/view_competence_domain/'.$competence_domain['id'])?>"><?=$competence_domain['symbol']?></a></td>
                        <td><a href="<?= base_url('plafor/courseplan/view_competence_domain/'.$competence_domain['id'])?>"><?=$competence_domain['name']?></a></td>
                        <?php if($is_admin):?>
                            <td><a href="<?= base_url('plafor/courseplan/save_competence_domain/'.$competence_domain['id'].'/'.$course_plan['id']); ?>"><i class="bi-pencil" style="font-size: 20px;"></i></a></td>
                            <td><a href="<?= base_url('plafor/courseplan/delete_competence_domain/'.$competence_domain['id']); ?>" ><i class="<?=$course_plan['archive']==null?'bi bi-trash':'bi bi-reply-all-fill' ?>" style="font-size: 20px;" ></td>
                        <?php endif;?>
                    </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="bg-primary text-white"><?=lang('plafor_lang.title_view_modules_linked')?></p>
        </div>
        <div class="col-12">
            <?php if($is_admin): ?>
                <div class="mb-2">
                    <a href="<?= base_url('plafor/module/save_module/0'); ?>" class="btn btn-primary"><?=lang('common_lang.btn_new_m')?></a>
                    <a href="<?= base_url('plafor/courseplan/link_module/' . $course_plan['id']); ?>" class="btn btn-primary"><?= lang('plafor_lang.change_course_plan_module_links'); ?></a>
                </div>
            <?php endif; ?>

            <?= $pager->links('modules'); ?>
            <table class="table table-hover mt-2">
                <thead>
                    <tr>
                        <th><?= lang('plafor_lang.field_module_official_name'); ?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modules as $module) { ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('plafor/module/view_module/'.$module['id']); ?>">
                                    <span class="font-weight-bold"><?= $module['module_number']; ?></span> <?= $module['official_name']; ?> (V<?= $module['version']; ?>)
                                </a>
                            </td>
                            <td><?= lang('plafor_lang.module_is_' . ($module['is_school'] ? '' : 'not_') . 'school'); ?></td>
                            <td>
                                <?php if($is_admin): ?>
                                <a href="<?= base_url('plafor/module/view_module/'.$module['id']); ?>">
                                    <?= lang('common_lang.btn_details'); ?>
                                </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($is_admin): ?>
                                <a href="<?= base_url('plafor/module/save_module/'.$module['id']); ?>">
                                    <?= lang('common_lang.btn_edit'); ?>
                                </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($is_admin): ?>
                                <a href="<?= base_url('plafor/module/delete_module/'.$module['id']); ?>" class="bi <?= $module['archive'] == null ? 'bi-trash' : 'bi-reply-all-fill' ?>"></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= $pager->links('modules'); ?>
        </div>
    </div>
</div>
