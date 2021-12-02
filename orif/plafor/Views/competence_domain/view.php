<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="bg-primary text-white"><?=lang('plafor_lang.title_view_course_plan')?></p>
        </div>
        <div class="col-md-6">
            <p class="font-weight-bold"><?=lang('plafor_lang.field_course_plan_formation_number')?></p>
            <a href="<?= base_url('plafor/courseplan/view_course_plan/'.$course_plan['id'])?>"><?=$course_plan['formation_number']?></a>
        </div>
        <div class="col-md-6">
            <p class="font-weight-bold"><?=lang('plafor_lang.field_course_plan_official_name')?></p>
            <a href="<?= base_url('plafor/courseplan/view_course_plan/'.$course_plan['id'])?>"><?=$course_plan['official_name']?></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="bg-primary text-white"><?=lang('plafor_lang.details_competence_domain')?></p>
        </div>
        <div class="col-md-6">
            <p class="font-weight-bold"><?=lang('plafor_lang.field_competence_domain_symbol')?></p>
            <p><?=$competence_domain['symbol']?></p>
        </div>
        <div class="col-md-6">
            <p class="font-weight-bold"><?=lang('plafor_lang.field_competence_domain_name')?></p>
            <p><?=$competence_domain['name']?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="bg-primary text-white"><?=lang('plafor_lang.title_view_operational_competence_linked')?></p>
        </div>
        <div class="col-md-12">
            <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_admin):?>
            <a href="<?=base_url('plafor/admin/save_operational_competence/0/'.$competence_domain['id'])?>" class="btn btn-primary"><?=lang('common_lang.btn_new_f')?></a>
            <?php endif?>
            <table class="table table-hover">
            <thead>
                <tr>
                    <th><span class="font-weight-bold"><?=lang('plafor_lang.field_operational_competences_symbols')?></span></th>
                    <th><span class="font-weight-bold"><?=lang('plafor_lang.field_operational_competences_names')?></span></th>
                    <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_admin):?>
                        <th></th>
                        <th></th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody><?php
            foreach (\Plafor\Models\CompetenceDomainModel::getOperationalCompetences($competence_domain['id']) as $operational_competence){
                ?><tr>
                    <td><a class="font-weight-bold" href="<?= base_url('plafor/courseplan/view_operational_competence/'.$operational_competence['id'])?>"><?=$operational_competence['symbol']?></a></td>
                    <td><a href="<?= base_url('plafor/courseplan/view_operational_competence/'.$operational_competence['id'])?>"><?=$operational_competence['name']?></a></td>
                <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_admin):?>
                    <td><a href="<?= base_url('plafor/admin/save_operational_competence/'.$operational_competence['id'].'/'.$competence_domain['id']); ?>"><?= lang('common_lang.btn_edit')?></a></td>
                    <td><a href="<?= base_url('plafor/admin/delete_operational_competence/'.$operational_competence['id']); ?>" class="<?=$competence_domain['archive']==null?'bi bi-trash':'bi bi-reply-all-fill'?>"></td>
                <?php endif;?>
                <?php
                }?>

            </tr>
            </tbody>
            </table>
        </div>
    </div>
</div>