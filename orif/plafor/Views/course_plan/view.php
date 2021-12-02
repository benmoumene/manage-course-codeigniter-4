<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="bg-primary text-white"><?=lang('plafor_lang.title_view_course_plan')?></p>
        </div>
        <div class="col-md-4">
            <p class="font-weight-bold"><?=lang('plafor_lang.field_course_plan_formation_number')?></p>
            <p><?=$course_plan['formation_number']?></p>
        </div>
        <div class="col-md-4">
            <p class="font-weight-bold"><?=lang('plafor_lang.field_course_plan_official_name')?></p>
            <p><?=$course_plan['official_name']?></p>
        </div>
        <div class="col-md-4">
            <p class="font-weight-bold"><?=lang('plafor_lang.field_course_plan_date_begin')?></p>
            <p><?=$course_plan['date_begin']?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="bg-primary text-white"><?=lang('plafor_lang.title_view_competence_domains_linked')?></p>
        </div>
        <div class="col-md-12">
            <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_admin):?>
            <a href="<?=base_url('plafor/admin/save_competence_domain/'.'0/'.$course_plan['id'])?>" class="btn btn-primary"><?=lang('common_lang.btn_new_m')?></a>
            <?php endif; ?>
            <table class="table table-hover">
            <thead>
                <tr>
                    <th><span class="font-weight-bold"><?=lang('plafor_lang.field_competence_domains_symbols')?></span></th>
                    <th><span class="font-weight-bold"><?=lang('plafor_lang.field_competence_domains_names')?></span></th>
                    <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_admin):?>
                    <th></th>
                    <th></th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody><?php
            foreach ($competence_domains as $competence_domain){
                ?><tr>
                    <td><a class="font-weight-bold" href="<?= base_url('plafor/courseplan/view_competence_domain/'.$competence_domain['id'])?>"><?=$competence_domain['symbol']?></a></td>
                    <td><a href="<?= base_url('plafor/courseplan/view_competence_domain/'.$competence_domain['id'])?>"><?=$competence_domain['name']?></a></td>
                    <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_admin):?>
                        <td><a href="<?= base_url('plafor/admin/save_competence_domain/'.$competence_domain['id'].'/'.$course_plan['id']); ?>"><?= lang('common_lang.btn_edit')?></a></td>
                        <td><a href="<?= base_url('plafor/admin/delete_competence_domain/'.$competence_domain['id']); ?>" class="<?=$course_plan['archive']==null?'bi bi-trash':'bi bi-reply-all-fill'?>"></td>

                    <?php endif;?>
                <?php
                }?></tr>
            </tbody>
            </table>
        </div>
    </div>
</div>