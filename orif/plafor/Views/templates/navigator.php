<?php
if (isset($reset)){
    service('session')->remove('navigator');
}
else{
$navigatorLink=service('session')->get('navigator');
if (isset($navigatorLink)){
    $index=null;

    for ($i=count($navigatorLink)-1;$i>=0;$i--){
        if ($navigatorLink[$i]['link']==((current_url().(strlen($_SERVER['QUERY_STRING'])?'?'.$_SERVER['QUERY_STRING']:'')))){
            $index=$i;
        }
    }
    if($index===null){
        $navigatorLink[]=['link'=>current_url().(strlen($_SERVER['QUERY_STRING'])?'?'.$_SERVER['QUERY_STRING']:''),'title'=>$title];
        service('session')->set('navigator',$navigatorLink);

    }
    else{
        for($i=count($navigatorLink);$i>$index;$i--){
            array_pop($navigatorLink);
        }
        $navigatorLink[]=['link'=>current_url().(strlen($_SERVER['QUERY_STRING'])?'?'.$_SERVER['QUERY_STRING']:''),'title'=>$title];
        service('session')->set('navigator',$navigatorLink);
    }

}
else{

    service('session')->set('navigator',[['link'=>current_url().(strlen($_SERVER['QUERY_STRING'])?'?'.$_SERVER['QUERY_STRING']:''),'title'=>$title]]);
}
?>
<span id="navigator">
<?php
    $navigatorLink=service('session')->get('navigator');
    for($i=0;$i<count($navigatorLink);$i++){?>
        <a href="<?=$navigatorLink[$i]['link']?>"><?=$navigatorLink[$i]['title']?></a> <?php echo count($navigatorLink)>1&&$i!=count($navigatorLink)-1?'<i class="bi bi-arrow-right-short" style="color: #ae9b70"></i>':''?>
<?php }?>
    <?php if(count($navigatorLink)>1):?>
    <a class="btn btn-primary bi bi-arrow-left-circle" style="margin-left: 0.5rem" href="<?=$navigatorLink[count($navigatorLink)-2]['link']?>"></a>
    <?php endif;?>
</span>
<?php } ?>