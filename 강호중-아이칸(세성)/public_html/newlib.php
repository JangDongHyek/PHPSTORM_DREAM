<?php
    function alert($msg,$href = "") {
        echo "<script>";
        echo "alert('{$msg}');";
        if($href) {
            echo "window.location.href='$href';";
        }else {
            echo "window.history.back();";
        }
        
        echo "</script>";
    }

    function getTotalBonus() {
        global $dbconn;
        
        if($_SESSION["MemberLevel"] == 4){//일반회원
            $SQL = "select * from item where mart_id ='khj' and item_id='$_SESSION[Mall_Admin_ID]'";
            $dbresult = mysql_query($SQL, $dbconn);
            $rows = mysql_fetch_array($dbresult);
        
            $mem_num = $rows[sea_num].$rows[sung_num].$rows[khan_num].$rows[sudong_num];
        
            $sum_sql = "select sum(bonus) as bonus_total from bonus where mart_id ='khj' and id='$mem_num'";
        }else{//그룹장
            $SQL = "select * from category where g_id='$_SESSION[Mall_Admin_ID]'";
        
            $dbresult = mysql_query($SQL, $dbconn);
            $rows = mysql_fetch_array($dbresult);
        
            $mem_num = $rows[sea_num].$rows[sung_num].$rows[khan_num];
        
            $sum_sql = "select sum(bonus) as bonus_total from bonus where mart_id ='khj' and id='$mem_num'";
        }
        
        $sum_rs = mysql_query($sum_sql, $dbconn);
        $sum_rows = mysql_fetch_array($sum_rs);
        return (int)$sum_rows[bonus_total];
    }
?>