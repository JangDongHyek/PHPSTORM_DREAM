<?php
include_once('./_common.php');

$pattern = '#[/\'\"%=*\#\(\)\|\+\&\!\$~\{\}\[\]`;:\?\^\,]#';

$it_id  = preg_replace($pattern, '', $_POST['it_id']);
//$opt_id = preg_replace($pattern, '', $_POST['opt_id']);
$opt_id = addslashes(sql_real_escape_string(preg_replace(G5_OPTION_ID_FILTER, '', $_POST['opt_id'])));
$idx    = preg_replace('#[^0-9]#', '', $_POST['idx']);
$sel_count = preg_replace('#[^0-9]#', '', $_POST['sel_count']);

/*
옵션명 비슷한 부분 오류 수정
수정자 : IT FOR ONE
수정 내용 : and io_id like '$opt_id%' => and io_id like '$opt_id".chr(30)."'
*/
$sql = " select * from {$g5['g5_shop_item_option_table']}
                where io_type = '0'
                  and it_id = '$it_id'
                  and io_use = '1'
                  and io_id like '$opt_id".chr(30)."%'
                order by io_no asc ";
$result = sql_query($sql);

$str = '<option value="">선택</option>';
$opt = array();

for($i=0; $row=sql_fetch_array($result); $i++) {
    $val = explode(chr(30), $row['io_id']);
    $key = $idx + 1;

    if(!strlen($val[$key]))
        continue;

    $continue = false;
    foreach($opt as $v) {
        if(strval($v) === strval($val[$key])) {
            $continue = true;
            break;
        }
    }
    if($continue)
        continue;

    $opt[] = strval($val[$key]);

    if($key + 1 < $sel_count) {
        $str .= PHP_EOL.'<option value="'.$val[$key].'">'.$val[$key].'</option>';
    } else {
        if($row['io_price'] > 0)
            $price = '&nbsp;&nbsp;+ '.number_format($row['io_price']).'원';
        else
            $price = '&nbsp;&nbsp; ';

        $io_stock_qty = get_option_stock_qty($it_id, $row['io_id'], $row['io_type']);

        if($io_stock_qty < 1)
            $soldout = '&nbsp;&nbsp;[품절]';
        else
            $soldout = '';

        $str .= PHP_EOL.'<option value="'.$val[$key].','.$row['io_price'].','.$io_stock_qty.'">'.$val[$key].$price.$soldout.'</option>';
    }
}

echo $str;
?>