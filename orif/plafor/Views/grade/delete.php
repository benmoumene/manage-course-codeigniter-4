<div class="page-content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <h1>
                        <?= lang('plafor_lang.grade') . ' ' . $grade['grade'] . ' (' . mb_strtolower(lang('common_lang.for')) . ' ' . $module['official_name'] . ')'; ?>
                    </h1>

                    <h4><?= lang('user_lang.what_to_do') ?></h4>
                    <div class="alert alert-info">
                        <?= lang('plafor_lang.grade_delete_explanation'); ?>
                    </div>
                <div class="text-right">
                    <a href="<?= session('_ci_previous_url'); ?>" class="btn btn-default">
                        <?= lang('common_lang.btn_cancel'); ?>
                    </a>
                    <a href="<?= base_url('plafor/apprentice/delete_grade/' . $grade['id'] . '/1'); ?>" class="btn btn-danger">
                        <?= lang('common_lang.btn_delete'); ?>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
