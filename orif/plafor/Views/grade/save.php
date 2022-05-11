<?php
helper('form');

$hidden = [];
if (isset($user_course_id)) {
    $hidden['user_course_id'] = $user_course_id;
}
if (isset($module_id)) {
    $hidden['module_id'] = $module_id;
}
if (isset($grade_id)) {
    $hidden['grade_id'] = $grade_id;
}

$input_grade_grade = [
    'name' => 'grade',
    'value' => $grade['grade'] ?? 0,
    'type' => 'number',
    'max' => config('\Plafor\Config\PlaforConfig')->GRADE_HIGHEST,
    'min' => config('\Plafor\Config\PlaforConfig')->GRADE_LOWEST,
    'class' => 'form-control',
    'id' => 'grade',
    'step' => 0.1,
];
$input_grade_date_exam = [
    'name' => 'date_exam',
    'value' => $grade['date_exam'] ?? '',
    'type' => 'date',
    'class' => 'form-control',
    'id' => 'date_exam',
];

$disable = $grade['archive'] == NULL;
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
        'id' => 'grade_form',
        'name' => 'grade_form',
    ];
    echo form_open($form_url, $attributes, $hidden);
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
            <?= form_label(lang('plafor_lang.field_grade_grade'), 'grade', ['class' => 'form_label']); ?>
            <?= form_input($input_grade_grade); ?>
            <?= form_label(lang('plafor_lang.field_grade_date_exam'), 'date_exam', ['class' => 'form_label']); ?>
            <?= form_input($input_grade_date_exam); ?>
        </div>
    </div>

    <!-- BUTTONS -->
    <div class="row">
        <div class="col text-right">
            <?php if (isset($grade['id']) && $_SESSION['user_access'] >= config('\User\Config\UserConfig')->access_lvl_admin) { ?>
                <a href="<?= base_url('plafor/apprentice/delete_grade/' . $grade['id']); ?>" class="btn btn-<?= $disable ? 'danger' : 'secondary'; ?>"><?= lang('common_lang.btn_' . ($disable ? 'disable' : 'reactivate')); ?></a>
            <?php } ?>
            <a href="<?= base_url('plafor/apprentice/list_grades/' . $apprentice_id); ?>" class="btn btn-default"><?= lang('common_lang.btn_cancel'); ?></a>
            <?= form_submit('save', lang('common_lang.btn_save'), ['class' => 'btn btn-primary']); ?>
        </div>
    </div>

    <?= form_close(); ?>
</div>
