<?php
$is_admin = session('user_access') >= config('\User\Config\UserConfig')->access_lvl_admin;
view('\Plafor\templates\navigator', ['reset' => true]);
helper('form');
/**
 * Users List View
 *
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= lang('plafor_lang.title_module_list'); ?></h1>
        </div>
    </div>
    <div class="row" style="justify-content:space-between;">
        <div class="col-sm-3">
            <a href="<?= base_url('plafor/module/save_module'); ?>" class="btn btn-primary">
                <?= lang('common_lang.btn_new_m'); ?>
            </a>
        </div>
        <div class="col-sm-9 text-right">
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
    <div class="row mt-2">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th><?= lang('plafor_lang.field_module_official_name'); ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="module_list">
                <?php foreach ($modules as $module) { ?>
                    <tr>
                        <td>
                            <a href="<?= base_url('plafor/module/view_module/' . $module['id']); ?>">
                                <span class="font-weight-bold"><?= $module['module_number']; ?></span>
                                <?= $module['official_name']; ?>
                                (V<?= $module['version']; ?>)
                            </a>
                        </td>
                        <td><a href="<?= base_url('plafor/module/view_module/' . $module['id']); ?>"><?= lang('common_lang.btn_details'); ?></a></td>
                        <td>
                            <?php if ($is_admin) { ?>
                                <a href="<?= base_url('plafor/module/save_module/' . $module['id']); ?>"><?= lang('common_lang.btn_edit'); ?></a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($is_admin) { ?>
                                <a href="<?= base_url('plafor/module/delete_module/' . $module['id']); ?>" class="bi <?= $module['archive'] == null ? 'bi-trash' : 'bi-reply-all-fill' ?>"></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#toggle_deleted').change(e => {
            let checked = e.currentTarget.checked;
            $.post('<?= base_url(); ?>/plafor/module/list_modules/' + (+checked), {}, data => {
                $('#module_list').empty();
                $('#module_list')[0].innerHTML = $(data).find('#module_list')[0].innerHTML;
            });
        });
    });
</script>
