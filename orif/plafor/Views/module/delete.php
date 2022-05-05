<?php
$disable = $module['archive'] == NULL;
?>
<div class="page-content-warpper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <h1><?= lang('plafor_lang.module') . ' "' . $module['official_name'] . '"'; ?></h1>

                    <h4><?= lang('user_lang.what_to_do')?></h4>
                    <div class="alert alert-info">
                        <?= lang('plafor_lang.module_' . ($disable ? 'disable' : 'enable') . '_explanation'); ?>
                    </div>
                </div>
                <div class="text-right">
                    <a href="<?= session('_ci_previous_url'); ?>" class="btn btn-default">
                        <?= lang('common_lang.btn_cancel'); ?>
                    </a>
                    <a href="<?= base_url('plafor/module/delete_module/' . $module['id'] . '/' . ($disable ? '1' : '3')); ?>" class="btn <?= $disable ? 'btn-danger' : ''; ?>">
                        <?= lang('common_lang.' . ($disable ? 'btn_disable' : 'reactivate')); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
