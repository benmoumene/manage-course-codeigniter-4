<?php
helper('form');
$trainer_access = config('\User\Config\UserConfig')->access_lvl_trainer;
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= lang('plafor_lang.title_grade_list') . ' ' . $apprentice['username']; ?></h1>
        </div>
        <div class="col-sm-12 text-right no-print row">
            <div class="col-6">
                <label class="btn btn-default form-check-label" for="toggle_all">
                    <?= form_label(lang('common_lang.btn_display_all_page'), 'toggle_all', [
                        'class' => 'form-check-label',
                    ]); ?>
                </label>
                <?= form_checkbox('toggle_all', '', $display_all, [
                    'id' => 'toggle_all',
                ]); ?>
            </div>
            <div class="col-6">
                <label class="btn btn-default form-check-label" for="toggle_deleted">
                    <?= form_label(lang('common_lang.btn_show_disabled'), 'toggle_deleted', [
                        'class' => 'form-check-label',
                    ]); ?>
                </label>
                <?= form_checkbox('toggle_deleted', '', $with_archived, [
                    'id' => 'toggle_deleted',
                ]); ?>
            </div>
        </div>
    </div>
    <br />
    <?php
    foreach ($course_plans as $user_course_id => $course_plan) {
        $course_modules = $modules[$user_course_id];
        $course_grades = $grades[$user_course_id];
        $course_averages = $averages[$user_course_id];
    ?>
        <div class="row module_grades" id="modules_grades_<?= $user_course_id; ?>">
            <div class="col-12">
                <p class="font-weight-bold user-course-details-course-plan-name"><?= $course_plan['official_name']; ?></p>
            </div>

            <?php if (array_key_exists('average', $course_averages)) { ?>
                <div class="col-4">
                    <?= lang('plafor_lang.grade_course_average', ['average' => round($course_averages['average'], 2)]); ?>
                </div>
                <div class="col-4">
                    <?php if (array_key_exists('average_school', $course_averages)) {
                        echo lang('plafor_lang.grade_course_average_school', ['average' => round($course_averages['average_school'], 2)]);
                    } ?>
                </div>
                <div class="col-4">
                    <?php if (array_key_exists('average_not_school', $course_averages)) {
                        echo lang('plafor_lang.grade_course_average_not_school', ['average' => round($course_averages['average_not_school'], 2)]);
                    } ?>
                </div>
            <?php } ?>

            <?php if (!is_null($pagers[$user_course_id])) { ?>
                <div class="col-12 no-print">
                    <?= $pagers[$user_course_id]->links('course_' . $user_course_id); ?>
                </div>
            <?php } ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-6"><?= lang('plafor_lang.field_module_official_name'); ?></th>
                        <th class="col-2"><?= lang('plafor_lang.module_school_type'); ?></th>
                        <th class="col-2"><?= lang('plafor_lang.field_grade_grades'); ?></th>
                        <th class="col-1"><?= lang('plafor_lang.grade_average'); ?></th>
                        <th class="col-1" aria-label="<?= lang('plafor_lang.title_grade_new'); ?>"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($course_modules as $module) {
                        $module_grades = $course_grades[$module['id']];
                    ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('plafor/module/view_module/' . $module['id']); ?>">
                                    <span class="font-weight-bold"><?= $module['module_number']; ?></span>
                                    <?= $module['official_name']; ?>
                                    (V<?= $module['version']; ?>)
                                </a>
                            </td>
                            <td><?= lang('plafor_lang.module_is_' . ($module['is_school'] ? '' : 'not_') . 'school'); ?></td>
                            <td>
                                <?php
                                if (count($module_grades) > 0) {
                                    foreach ($module_grades as $i => $grade) {
                                        $g = $grade['grade'];
                                        if ($grade['archive'] != NULL) {
                                            $g = '<span class="text-danger print-strikethrough">' . $g . '</span>';
                                        }
                                        if ($_SESSION['user_access'] >= $trainer_access) {
                                            $url = base_url('plafor/apprentice/edit_grade/' . $grade['id']);
                                            $g = '<a href="' . $url . '" role="button">' . $g . '</a>';
                                        }
                                        if ($i != 0) echo ', ';
                                        echo $g;
                                    }
                                } else {
                                    echo lang('plafor_lang.grade_no_grades');
                                }
                                ?>
                            </td>
                            <td>
                                <?= array_key_exists($module['id'], $course_averages) ? round($course_averages[$module['id']], 1) : ''; ?>
                            </td>
                            <td><a href="<?= base_url('plafor/apprentice/add_grade/' . $user_course_id . '/' . $module['id']); ?>" class="btn btn-primary no-print" role="button">+</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php if (!is_null($pagers[$user_course_id])) { ?>
                <div class="col-12 no-print">
                    <?= $pagers[$user_course_id]->links('course_' . $user_course_id); ?>
                </div>
            <?php } ?>
        </div>
        <br>
    <?php } ?>
</div>

<script>
    $(document).ready(function() {
        $('#toggle_deleted').change(refresh_tables);
        $('#toggle_all').change(refresh_tables);
    });

    function refresh_tables() {
        let with_deleted = $('#toggle_deleted')[0].checked;
        let show_all = $('#toggle_all')[0].checked;

        $.post(`<?= base_url('/plafor/apprentice/list_grades/' . $apprentice['id']); ?>/${+with_deleted}/${+show_all}`, {}, data => {
            $('.module_grades').empty();
            $('.module_grades').each((_, elem) => elem.innerHTML = $(data).find(`#${elem.id}`)[0].innerHTML);
        });
    }
</script>
