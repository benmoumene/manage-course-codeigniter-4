<?php
helper('form');

$input_module_number = [
    'name' => 'module_number',
    'value' => $module['module_number'] ?? '',
    'type' => 'number',
    'max' => str_repeat('9', config('\Plafor\Config\PlaforConfig')->MODULE_NUMBER_MAX_LENGTH),
    'min' => 0,
    'class' => 'form-control',
    'id' => 'module_module_number'
];
$input_official_name = [
    'name' => 'official_name',
    'value' => $module['official_name'] ?? '',
    'maxlength' => config('\Plafor\Config\PlaforConfig')->MODULE_OFFICIAL_NAME_MAX_LENGTH,
    'class' => 'form-control',
    'id' => 'module_official_name'
];
$input_is_school = [
    'name' => 'is_school',
    'value' => 1,
    'type' => 'checkbox',
    'class' => 'form-checkbox',
    'id' => 'module_is_school',
];
if (($module['is_school'] ?? 0) == 1) $input_is_school['checked'] = TRUE;
?>
<div class="container">
    <!-- TITLE -->
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= $title; ?></h1>
        </div>
    </div>

    <!-- FORM OPEN -->
    <?php
    $attributes = [
        'id' => 'module_form',
        'name' => 'module_form',
    ];
    echo form_open(base_url('plafor/module/save_module'), $attributes, [
        'module_id' => $module['id'] ?? 0,
        'course_plan_id' => $course_plan_id,
    ]);
    ?>

    <!-- ERRORS -->
    <?php foreach (($errors ?? []) as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
    <?php } ?>

    <!-- FIELDS -->
    <div class="row">
        <div class="col-sm-12 form-group">
            <?= form_label(lang('plafor_lang.field_module_module_number'), 'module_module_number', ['class' => 'form-label']); ?>
            <?= form_input($input_module_number); ?>
            <?= form_label(lang('plafor_lang.field_module_official_name'), 'module_official_name', ['class' => 'form-label']); ?>
            <?= form_input($input_official_name); ?>
            <?= form_label(lang('plafor_lang.field_module_is_school'), 'module_is_school', ['class' => 'form-label']); ?>
            <?= form_input($input_is_school); ?>
        </div>
    </div>

    <!-- BUTTONS -->
    <div class="row">
        <div class="col text-right">
            <a href="<?= base_url('plafor/module/list_modules'); ?>" class="btn btn-default"><?= lang('common_lang.btn_cancel'); ?></a>
            <?= form_submit('save', lang('common_lang.btn_save'), ['class' => 'btn btn-primary']); ?>
        </div>
    </div>

    <?= form_close(); ?>
</div>

<script>
    $(document).ready(function() {
        $('#module_module_number').change(e => {
            // Left pad the number so it's displayed the same as it is saved
            e.currentTarget.value = (+e.currentTarget.value).toString().padStart(e.currentTarget.max.length, '0');
        });
    });
</script>
