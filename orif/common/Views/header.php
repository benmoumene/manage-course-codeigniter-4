<?php
/**
 * Header view
 *
 * @author      Orif (ViDi,HeMa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Copied from Bootstrap model https://getbootstrap.com/docs/4.6/getting-started/introduction/) -->

    <title><?php
        if (!isset($title) || is_null($title) || $title == '') {
            echo lang('Common_lang.page_prefix');
        } else {
            echo lang('Common_lang.page_prefix').' - '.$title;
        }
    ?></title>

    <!-- Icon -->
    <link rel="icon" type="image/png" href="<?= base_url("images/favicon.png"); ?>" />
    <link rel="shortcut icon" type="image/png" href="<?= base_url("images/favicon.png"); ?>" />

    <!-- Bootstrap  -->
    <!-- Orif Bootstrap CSS personalized with https://bootstrap.build/app -->
    <link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css"); ?>" />
    <link rel="stylesheet" href="<?= base_url("css/progressview.css"); ?>" />
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- jquery, popper and Bootstrap javascript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Application styles -->
    <link rel="stylesheet" href="<?= base_url("css/MY_styles.css"); ?>" />
    <link rel="stylesheet" href="<?= base_url("css/progressbarstyle.css"); ?>" />
    <script type="text/babel">
        function initProgress() {
            $(document).ready(async () => {
                //execute jquery code under
                const nodeList = document.querySelectorAll('.progressContainer');
                //for each elements
                nodeList.forEach((node) => {
                    $.get("<?=base_url('plafor/apprentice/getCoursePlanProgress')?>/" + node.getAttribute('apprentice_id')+'/'+(node.getAttribute('course_plan_id')!=null?node.getAttribute('course_plan_id'):''), function () {

                    }).done((response) => {
                        //response received is json format
                        let coursePlans = Object.values(response);
                        coursePlans.forEach((coursePlan) => {
                            const coursePlanStats = getCoursePlanProgress(coursePlan)
                            //in the case of multiple coursePlans
                            let div = document.createElement('div');
                            node.appendChild(div);
                            ReactDOM.render(<div><Progressbar colors={['#6ca77f', '#AE9B70', '#d9af47', '#D9918D']}
                                                              elements={coursePlanStats.progress}
                                                              timeToRefresh="10" elementToGroup={3}
                                                              disabled={coursePlanStats.status > 2}
                            />
                                {
                                    coursePlanStats.status <= 2 ?
                                        <button style={{marginLeft: '5px'}} onClick={(e) => {
                                            displayDetails(coursePlan);
                                        }} className="btn btn-secondary"><?=lang('plafor_lang.details_progress')?></button>
                                        : null
                                }</div>, div);

                        })


                        //render progressbar for each apprentice


                        //count all objectives by acquisition status

                    })
                    //use ~5% of items for group

                })
            });
        }
        function displayDetails(coursePlan){
            const detailsPanel=document.createElement('div');
            detailsPanel.id='details';
            document.body.append(detailsPanel);
            ReactDOM.render(<ProgressView coursePlan={coursePlan} callback={closeDetails}></ProgressView>,detailsPanel)
        }
        function closeDetails(){
            ReactDOM.unmountComponentAtNode(document.getElementById('details'));
            document.body.removeChild(document.getElementById('details'));
        }
    </script>
</head>
<body>
    <?php
        if (ENVIRONMENT != 'production') {
            echo '<div class="alert alert-warning text-center">CodeIgniter environment variable is set to '.strtoupper(ENVIRONMENT).'. You can change it in .env file.</div>';
        }
    ?>