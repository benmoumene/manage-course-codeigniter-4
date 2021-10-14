<?php
helper('Form');
/**
 * Users List View
 *
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>
<div id="details"></div>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= lang('user_lang.title_apprentice_list'); ?></h1>
            <div style="display:flex;flex-direction:row;align-items:center;justify-content:space-between;">
                <?php
                echo form_open(base_url('plafor/apprentice/list_apprentice/'), ['method' => 'GET']);
                echo form_dropdown('trainer_id', $trainers, $trainer_id, ['class' => 'form-control', 'style' => 'width:unset!important;display:unset!important;margin-left:-10px;']);
                echo form_submit(null, lang('common_lang.btn_search'), ['class' => 'btn btn-primary', 'style' => 'vertical-align:unset!important;']); ?>
                <?php
                echo form_close();
                ?>
                <span>

            <?= form_checkbox('toggle_deleted', '', $with_archived, [
                'id' => 'toggle_deleted', 'class' => 'form-check-input'
            ]); ?>
            <?= form_label(lang('common_lang.btn_show_disabled'), 'toggle_deleted', ['class' => 'form-check-label']); ?>
                </span>
            </div>


        </div>
    </div>
</div>

<div class="row mt-2">
    <table class="table table-hover">
        <thead>
        <tr>
            <th><?= lang('user_lang.field_apprentice_username'); ?></th>
            <th><?= lang('user_lang.field_followed_courses'); ?></th>
            <th><?= lang('user_lang.title_progress') ?></th>
        </tr>
        </thead>
        <tbody id="apprenticeslist">
        <?php foreach ($apprentices as $apprentice) { ?>
            <tr>
                <td>
                    <a href="<?= base_url('plafor/apprentice/view_apprentice/' . $apprentice['id']); ?>"><?= $apprentice['username']; ?>
                </td>
                <td><a href="<?= base_url('plafor/admin/list_course_plan/' . $apprentice['id']) ?>"><?php
                        $linkedCourses = "";
                        foreach ($courses as $course) {
                            $linkedCourses .= ($course['fk_user'] == $apprentice['id'] ? $coursesList[$course['fk_course_plan']]['official_name'] . "," : "");
                        }
                        echo rtrim($linkedCourses, ",");
                        ?></a></td>
                <td style="width: 30%;max-width: 300px;min-width: 200px">
                    <div class="progressContainer" apprentice_id="<?= $apprentice['id'] ?>"></div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</div>

<script>
    $(document).ready(function () {
        $('#toggle_deleted').change(e => {
            let checked = e.currentTarget.checked;
            $.post('<?php echo base_url("plafor/apprentice/list_apprentice") . '/'?>' + ((checked == true ? '1' : '0')), {}, data => {
                $('#apprenticeslist').empty();
                $('#apprenticeslist')[0].innerHTML = $(data).find('#apprenticeslist')[0].innerHTML;
            });
        });
    });

</script>
<script type="text/babel">
    //because jquery use
    $(document).ready(async () => {
        //execute jquery code under
        const nodeList = document.querySelectorAll('.progressContainer');
        //add all nodes containing apprentice_id attribute
        let orderedArray = [];
        nodeList.forEach((element) => {
            orderedArray[parseInt(element.getAttribute('apprentice_id'))] = element;
        });
        //for each elements
        orderedArray.forEach((node, index) => {
            $.get("<?=base_url('plafor/apprentice/getCoursePlanProgress')?>/" + index, function () {

            }).done((response) => {
                //response received is json format
                let coursePlans=Object.values(response);
                coursePlans.forEach((coursePlan)=>{
                    const coursePlanStats=getCoursePlanProgress(coursePlan)
                    //in the case of multiple coursePlans
                    let div=document.createElement('div');
                    node.appendChild(div);
                    ReactDOM.render(<div><Progressbar colors={['#6ca77f', '#AE9B70', '#d9af47', '#D9918D']}
                                                      elements={coursePlanStats.progress}
                                                      timeToRefresh="10" elementToGroup={3} disabled={coursePlanStats.status>2}
                    />
                        {
                            coursePlanStats.status<=2?
                                <button style={{marginLeft:'5px'}} onClick={(e)=>{
                                    displayDetails(coursePlan);
                                }} className="btn btn-secondary"><?=lang('user_lang.details_progress')?></button>
                                :null
                        }</div>, div);

                })



                //render progressbar for each apprentice



                //count all objectives by acquisition status


            })
            //use ~5% of items for group

        })
    });
    function displayDetails(coursePlan){
        ReactDOM.render(<ProgressView coursePlan={coursePlan} callback={closeDetails}></ProgressView>,document.getElementById('details'))
    }
    function closeDetails(){
        ReactDOM.unmountComponentAtNode(document.getElementById('details'));
    }

</script>

