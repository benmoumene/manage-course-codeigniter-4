<div class="container">
    <?=view('\Plafor\templates\navigator',['title'=>lang('plafor_lang.details_competence_domain')])?>
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
            <p class="bg-primary text-white"><?=lang('plafor_lang.details_competence_domain')?></p>
        </div>
        <div class="col-12">
            <p><?=$competence_domain['symbol']?> : <?=$competence_domain['name']?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="bg-primary text-white"><?=lang('plafor_lang.title_view_operational_competence_linked')?></p>
        </div>
        <div class="col-12">
            <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_admin):?>
                <a href="<?=base_url('plafor/courseplan/save_operational_competence/0/'.$competence_domain['id'])?>" class="btn btn-primary"><?=lang('common_lang.btn_new_f')?></a>
            <?php endif?>

            <table class="table table-hover mt-2">
            <thead>
                <tr>
                    <th><span class="font-weight-bold"><?=lang('plafor_lang.symbol')?></span></th>
                    <th><span class="font-weight-bold"><?=lang('plafor_lang.operational_competence')?></span></th>
                    <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_admin):?>
                        <th></th>
                        <th></th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php foreach (\Plafor\Models\CompetenceDomainModel::getOperationalCompetences($competence_domain['id']) as $operational_competence){ ?>
                    <tr>
                        <td><a href="<?= base_url('plafor/courseplan/view_operational_competence/'.$operational_competence['id'])?>"><?=$operational_competence['symbol']?></a></td>
                        <td><a href="<?= base_url('plafor/courseplan/view_operational_competence/'.$operational_competence['id'])?>"><?=$operational_competence['name']?></a></td>
                        <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_admin):?>
                            <td><a href="<?= base_url('plafor/courseplan/save_operational_competence/'.$operational_competence['id'].'/'.$competence_domain['id']); ?>"><i class="bi-pencil" style="font-size: 20px;"></i></a></td>
                            <td><a href="<?= base_url('plafor/courseplan/delete_operational_competence/'.$operational_competence['id']); ?>" ><i class="<?=$competence_domain['archive']==null?'bi bi-trash':'bi bi-reply-all-fill'?>" style="font-size: 20px;" ></a></td>
                        <?php endif;?>
                    </tr>
                <?php  }?>
            </tbody>
            </table>
        </div>
    </div>
</div>