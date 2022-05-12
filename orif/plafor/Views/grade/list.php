<?php
helper('form');
$trainer_access = config('\User\Config\UserConfig')->access_lvl_trainer;
$admin_access = config('\User\Config\UserConfig')->access_lvl_admin;
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= lang('plafor_lang.title_grade_list') . ' ' . $apprentice['username']; ?></h1>
        </div>
        <div class="col-sm-12 text-right no-print">
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
    <br />
    <?php
    foreach ($course_plans as $user_course_id => $course_plan) {
        $course_modules = $modules[$course_plan['id']];
        $course_grades = $grades[$course_plan['id']];
        $course_averages = $averages[$course_plan['id']];
    ?>
        <div class="row">
            <p class="font-weight-bold user-course-details-course-plan-name"><?= $course_plan['official_name']; ?></p>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= lang('plafor_lang.field_module_official_name'); ?></th>
                        <th><?= lang('plafor_lang.field_grade_grades'); ?></th>
                        <th><?= lang('plafor_lang.grade_average'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="module_grades" id="modules_grades_<?= $course_plan['id']; ?>">
                    <?php
                    foreach ($course_modules as $module) {
                        $module_grades = $course_grades[$module['id']];
                    ?>
                        <tr>
                            <td>
                                <?php if ($_SESSION['user_access'] >= $admin_access) { ?>
                                    <a href="<?= base_url('plafor/module/view_module/' . $module['id']); ?>">
                                    <?php } ?>
                                    <span class="font-weight-bold"><?= $module['module_number']; ?></span>
                                    <?= $module['official_name']; ?>
                                    (V<?= $module['version']; ?>)
                                    <?php if ($_SESSION['user_access'] >= $admin_access) { ?>
                                    </a> (<?= lang('plafor_lang.module_is_' . ($module['is_school'] ? '' : 'not_') . 'school'); ?>)
                                <?php } ?>
                            </td>
                            <td>
                                <?php
                                if (count($module_grades) > 0) {
                                    foreach ($module_grades as $i => $grade) {
                                        $g = $grade['grade'];
                                        if ($grade['archive'] != NULL) {
                                            $g = '<span class="text-danger">' . $g . '</span>';
                                        }
                                        if ($_SESSION['user_access'] >= $trainer_access) {
                                            $url = base_url('plafor/apprentice/edit_grade/' . $grade['id']);
                                            $g = '<a href="' . $url . '">' . $g . '</a>';
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
                            <td><a href="<?= base_url('plafor/apprentice/add_grade/' . $user_course_id . '/' . $module['id']); ?>" class="btn btn-primary no-print">+</a></td>
                        </tr>
                    <?php } ?>
                    <?php if (array_key_exists('average', $course_averages)) { ?>
                        <tr>
                            <td><span class="font-weight-bold"><?= lang('plafor_lang.grade_course_average'); ?></span></td>
                            <td></td>
                            <td><?= round($course_averages['average'], 2); ?></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <br>
    <?php } ?>
</div>

<script>
    $(document).ready(function() {
        $('#toggle_deleted').change(e => {
            let checked = e.currentTarget.checked;
            $.post('<?= base_url('/plafor/apprentice/list_grades/' . $apprentice['id']); ?>/' + (+checked), {}, data => {
                $('.module_grades').empty();
                $('.module_grades').each((_, elem) => elem.innerHTML = $(data).find(`#${elem.id}`)[0].innerHTML);
            });
        });
    });
</script>
