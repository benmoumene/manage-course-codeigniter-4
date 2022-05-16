<?php
helper('form');

// Prevents test errors
if (!function_exists('form_module')) {
    /**
     * Returns the contents to display for a selectable module
     *
     * @param  array     $module
     * @param  integer[] $modules_selected
     * @return string
     */
    function form_module($module, $modules_selected = []): string
    {
        // The checkbox must be prepared on its own in case the module is selected
        $is_school_input = [
            'name' => 'modules_selected[' . $module['id'] . ']',
            'value' => 'is_school:' . $module['id'],
            'type' => 'radio',
            'class' => 'form-radio',
            'id' => 'module_select_school_' . $module['id'],
        ];
        $is_not_school_input = [
            'name' => 'modules_selected[' . $module['id'] . ']',
            'value' => 'is_not_school:' . $module['id'],
            'type' => 'radio',
            'class' => 'form-radio',
            'id' => 'module_select_not_school_' . $module['id'],
        ];
        $unlink_input = [
            'name' => 'modules_selected[' . $module['id'] . ']',
            'value' => 'no_link:' . $module['id'],
            'type' => 'radio',
            'class' => 'form-radio',
            'id' => 'module_select_no_link_' . $module['id'],
        ];
        if (!array_key_exists($module['id'], $modules_selected)) $unlink_input['checked'] = TRUE;
        elseif ($modules_selected[$module['id']]) $is_school_input['checked'] = TRUE;
        else $is_not_school_input['checked'] = TRUE;

        $content = '<span class="font-weight-bold">' . $module['module_number'] . '</span> ' . $module['official_name'] . ' V' . $module['version'];
        $content .= '<br>';
        $content .= form_label(lang('plafor_lang.module_is_school'), 'module_select_school_' . $module['id'], ['class' => 'form-label']);
        $content .= form_input($is_school_input);
        $content .= '<br>';
        $content .= form_label(lang('plafor_lang.module_is_not_school'), 'module_select_not_school_' . $module['id'], ['class' => 'form-label']);
        $content .= form_input($is_not_school_input);
        $content .= '<br>';
        $content .= form_label(lang('plafor_lang.module_no_link'), 'module_select_no_link_' . $module['id'], ['class' => 'form-label']);
        $content .= form_input($unlink_input);
        $content .= '<br>';

        return $content;
    }
}
?>
<div class="container">
    <!-- TITLE -->
    <div class="row">
        <div class="col">
            <h1 class="title-section">
                <?= $title; ?>
            </h1>
        </div>
    </div>

    <!-- FORM OPEN -->
    <?php
    $attributes = [
        'id' => 'module_link_form',
        'name' => 'module_link_form',
    ];
    echo form_open('plafor/courseplan/link_module', $attributes, [
        'course_plan_id' => $course_plan['id'],
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
        <?php foreach ($modules as $module) { ?>
            <div class="col-sm-6 form-group">
                <?= form_module($module, $modules_selected); ?>
            </div>
        <?php } ?>
    </div>

    <!-- BUTTONS -->
    <div class="row">
        <div class="col text-right">
            <a href="<?= base_url('plafor/courseplan/view_course_plan/' . $course_plan['id']); ?>" class="btn btn-default"><?= lang('common_lang.btn_cancel'); ?></a>
            <?= form_submit('save', lang('common_lang.btn_save'), ['class' => 'btn btn-primary']); ?>
        </div>
    </div>

    <?= form_close(); ?>
</div>
