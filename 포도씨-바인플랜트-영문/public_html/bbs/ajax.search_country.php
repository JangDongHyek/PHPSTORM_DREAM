<?php
include_once('./_common.php');
/**
 * 기업의뢰 - 국가검색 (최대 5개)
 */
$cnt = 0;
foreach($arr_country_code as $code=>$value) {
    if(strpos(strtolower($value[1]), $country) !== false) {
        ++$cnt;
    ?>
    <li>
        <input type="checkbox" id="<?=$value[1]?>" name="country" value="<?=$value[1]?>" onclick="company_search_list();">
        <label for="<?=$value[1]?>">
            <span></span>
            <em><?=$value[1]?></em>
        </label>
    </li>
    <?php
    }

    if($cnt == 5) { break; }
}
?>