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
            <?php
            $datas=[];
            foreach (\Plafor\Models\CompetenceDomainModel::getOperationalCompetences($competence_domain['id']) as $operational_competence){
                $datas[]=['id'=>$operational_competence['id'],'symbol'=>$operational_competence['symbol'],'opComp'=>$operational_competence['name']];
            }
            ?>

            <?= view('Common\Views\items_list',[
                'columns'=>[
                    'symbol'=>lang('plafor_lang.symbol'),
                    'opComp'=>lang('plafor_lang.operational_competence')
                ],
                'items'=>$datas,
                'primary_key_field'=>'id',
                'url_update'=>'plafor/courseplan/save_operational_competence/',
                'url_delete'=>'plafor/courseplan/delete_operational_competence/',
                'url_detail'=>'plafor/courseplan/view_operational_competence/',
            ])?>
        </div>
    </div>
</div>