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
            <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_admin):?>
                <a href="<?=base_url('plafor/courseplan/save_competence_domain/'.$course_plan['id'].'/0/')?>" class="btn btn-primary"><?=lang('common_lang.btn_new_m')?></a>
            <?php endif; ?>

            <?php
            $datas=[];
            foreach ($competence_domains as $competence_domain){
                $datas[]=['id'=>$competence_domain['id'],'symbol'=>$competence_domain['symbol'],'compDom'=>$competence_domain['name']];
            }
            ?>

            <?= view('Common\Views\items_list',[
                'columns'=>[
                    'symbol'=>lang('plafor_lang.symbol'),
                    'compDom'=>lang('plafor_lang.competence_domain')
                 ],
                'items'=>$datas,
                'primary_key_field'=>'id',
                'url_update'=>'plafor/courseplan/save_competence_domain/',
                'url_delete'=>'plafor/courseplan/delete_competence_domain/',
                'url_detail'=>'plafor/courseplan/view_competence_domain/',
                ])?>
        </div>
    </div>
</div>