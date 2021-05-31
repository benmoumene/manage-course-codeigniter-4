<?php
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
            <h1 class="title-section"><?= lang('user_lang.title_operational_competence_list'); ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 text-left">
            <a href="<?= base_url('plafor/admin/save_operational_competence'); ?>" class="btn btn-primary">
                <?= lang('common_lang.btn_new_f'); ?>
            </a>
        </div>
    </div>
    <div class="row mt-2">
        <table class="table table-hover">
        <thead>
            <tr>
                <th><?= lang('user_lang.field_operational_competence_name'); ?></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="operational_competenceslist">
            <?php foreach($operational_competences as $operational_competence) { ?>
                <tr>
                    <td><a href="<?= base_url('plafor/admin/list_objective/'.$operational_competence['id']); ?>"><span class="font-weight-bold"><?= $operational_competence['symbol']?></span> <?= $operational_competence['name']; ?></td>
                    <td><a href="<?= base_url('plafor/apprentice/view_operational_competence/'.$operational_competence['id'])?>"><?= lang('common_lang.btn_details')?></a></td>
                    <td><a href="<?= base_url('plafor/admin/save_operational_competence/'.$operational_competence['id']); ?>"><?= lang('common_lang.btn_edit')?></a></td>
                    <td><a href="<?= base_url('plafor/admin/delete_operational_competence/'.$operational_competence['id']); ?>" class="close">×</td>
                </tr>
            <?php } ?>
        </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#toggle_deleted').change(e => {
        let checked = e.currentTarget.checked;
        $.post('<?=base_url();?>admin/list_operational_competence/'+(+checked), {}, data => {
            $('#operational_competenceslist').empty();
            $('#operational_competenceslist')[0].innerHTML = $(data).find('#operational_competenceslist')[0].innerHTML;
        });
    });
});
</script>
