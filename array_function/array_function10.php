<?php
$ctg_tree = array(
    '1'=>array('parent_id'=>0,
        'children'=>array(
            '2'=>array('parent_id'=>1,
                'children'=>array(
                    '3'=>array('parent_id'=>2))),
            '4'=>array('parent_id'=>1,
                'children'=>array(
                    '5'=>array('parent_id'=>4),
                    '6'=>array('parent_id'=>4))))));

function getSubCategories($ctg_tree, $id, $level = null) {

    $getBranchIds =
        create_function(
            '$tree, $ctg_id, $level = null, $arr = null,'.
            ' $push = false, $getBranchIds','
            if(!$arr) {
                $arr = array();
            }
            if(intval($level) && $push){
                $level--;
            }

            foreach($tree as $key=>$ctg) {
                if($push) {
                    $arr[] = $key;
                }
                if($ctg_id == $key) {
                    $start = true;
                    $push = true;
                }
if(count($ctg[\'children\']) && (intval($level) || $level === null)) {
$getBranchIds(
$ctg[\'children\'],$ctg_id,$level,&$arr,$push,$getBranchIds
);
                }
                if($start) return $arr;
            }

            return $arr;');

    return $getBranchIds(
        $ctg_tree, $id, $level, null, false, $getBranchIds
    );
}

print_r(getSubCategories($ctg_tree, 4, 1));
?>