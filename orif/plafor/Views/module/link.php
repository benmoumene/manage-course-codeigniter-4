<?php
helper('form');

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
    $checkbox = [
        'name' => 'modules_selected[]',
        'value' => $module['id'],
        'type' => 'checkbox',
        'class' => 'form-checkbox',
        'id' => 'modules_selected_' . $module['id'],
    ];
    if (in_array($module['id'], $modules_selected)) $checkbox['checked'] = TRUE;

    $content = form_label(
        '<span class="font-weight-bold">' . $module['module_number'] . '</span> ' . $module['official_name'] . ' V' . $module['version'],
        'modules_selected_' . $module['id'],
        ['class' => 'form-label']
    );
    $content .= ' ';
    $content .= form_input($checkbox);

    return $content;
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
