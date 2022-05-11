<?php
$trainer_access = config('\User\Config\UserConfig')->access_lvl_trainer;
$admin_access = config('\User\Config\UserConfig')->access_lvl_admin;
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= lang('plafor_lang.title_grade_list') . ' ' . $apprentice['username']; ?></h1>
        </div>
    </div>
    <br />
    <?php
    foreach ($course_plans as $course_plan) {
        $course_modules = $modules[$course_plan['id']];
        $course_grades = $grades[$course_plan['id']];
    ?>
        <div class="row">
            <p class="font-weight-bold user-course-details-course-plan-name"><?= $course_plan['official_name']; ?></p>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= lang('plafor_lang.field_module_official_name'); ?></th>
                        <th><?= lang('plafor_lang.field_grade_grades'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($course_modules as $module) {
                        $module_grades = $course_grades[$module['id']];
                    ?>
                        <tr>
                            <td>
                                <?php if ($_SESSION['user_access'] >= $admin_access) { ?>
                                    <a href="<?= base_url('plafor/module/view_module/' . $module['id']); ?>">
                                    <?php } ?>
                                    <span class="font-weight-bold"><?= $module['module_number']; ?></span> <?= $module['official_name']; ?>
                                    <?php if ($_SESSION['user_access'] >= $admin_access) { ?>
                                    </a>
                                <?php } ?>
                            </td>
                            <td>
                                <?php
                                if (count($module_grades) > 0) {
                                    foreach ($module_grades as $i => $grade) {
                                        $g = $grade['grade'];
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
                            <td><a href="<?= base_url('plafor/apprentice/add_grade/' . $course_plan['id'] . '/' . $module['id']); ?>" class="btn btn-primary">+</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
