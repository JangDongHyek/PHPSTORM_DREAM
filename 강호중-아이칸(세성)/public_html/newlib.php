<?php
function alert($msg, $href = "")
{
    echo "<script>";
    echo "alert('{$msg}');";
    if ($href) {
        echo "window.location.href='$href';";
    } else {
        echo "window.history.back();";
    }

    echo "</script>";
}

function postBonus($bonus, $content,$id = "")
{
    global $dbconn;
    $id = $id ? $id : getID($_SESSION[Mall_Admin_ID]);
    $write_date = date("YmdHis");
    $sql = "insert into bonus 
                (mart_id, id, write_date, bonus, content, mode)  
                values 
               ('khj','$id', '$write_date', '$bonus', '$content', 'ug')";
    mysql_query($sql, $dbconn);
}

function getNewBoard($idx)
{
    global $dbconn;

    $sql = "SELECT * FROM new_board WHERE index_no = '$idx'";
    $dbresult = mysql_query($sql, $dbconn);
    $row = mysql_fetch_assoc($dbresult);

    return $row;
}

function getID($id = "")
{
    global $dbconn;

    $id = $id ? $id : $_SESSION[Mall_Admin_ID];
    if ($_SESSION["MemberLevel"] == 10) {
        return "admin";
    } else if ($_SESSION["MemberLevel"] == 4) {
        $SQL = "select * from item where mart_id ='khj' and item_id='$id'";
        $dbresult = mysql_query($SQL, $dbconn);
        $rows = mysql_fetch_array($dbresult);

        $mem_num = $rows[sea_num] . $rows[sung_num] . $rows[khan_num] . $rows[sudong_num];
    } else {
        $SQL = "select * from category where g_id='$id'";

        $dbresult = mysql_query($SQL, $dbconn);
        $rows = mysql_fetch_array($dbresult);

        $mem_num = $rows[sea_num] . $rows[sung_num] . $rows[khan_num];
    }

    return $mem_num;
}

function getTotalBonus()
{
    global $dbconn;

    if ($_SESSION["MemberLevel"] == 10) {
        return 10000;
    }

    $mem_num = getID();

    $sum_sql = "select sum(bonus) as bonus_total from bonus where mart_id ='khj' and id='$mem_num'";

    $sum_rs = mysql_query($sum_sql, $dbconn);
    $sum_rows = mysql_fetch_array($sum_rs);
    return (int)$sum_rows[bonus_total];
}

?>