<div class="container">
    <?= view('\Plafor\templates\navigator', ['title' => lang('plafor_lang.title_view_module')]); ?>
    <div class="row">
        <div class="col-12">
            <p class="bg-primary text-white"><?= lang('plafor_lang.title_view_module'); ?></p>
        </div>
        <div class="col-12">
            <p class="font-weight-bold"><?= $module['official_name']; ?></p>
        </div>
        <div class="col-12">
            <p><?= lang('plafor_lang.number_abr') . ' ' . $module['module_number']; ?></p>
        </div>
        <div class="col-12">
            <p><?= lang('plafor_lang.module_is_' . ($module['is_school'] ? '' : 'not_') . 'school'); ?></p>
        </div>
    </div>
</div>