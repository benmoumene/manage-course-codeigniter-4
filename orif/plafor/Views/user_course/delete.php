<div id="page-content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <h1><?= lang('plafor_lang.apprentice').' "'.$apprentice['username'].'"' ?></h1>
                    <h1><?= lang('plafor_lang.course_plan').' "'.$course_plan['official_name'].'"' ?></h1>
                    <h1><?= lang('plafor_lang.status').' "'.$status['name'].'"' ?></h1>
                    <h4><?= lang('user_lang.what_to_do')?></h4>
                    <div class = "alert alert-info" ><?= lang('plafor_lang.user_course_disable_explanation')?></div>
                </div>
                <div class="text-right">
                    <a href="<?= base_url('apprentice/view_user_course/'.$apprentice['id']); ?>" class="btn btn-default">
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
