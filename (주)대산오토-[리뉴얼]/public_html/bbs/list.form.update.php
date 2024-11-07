<?php
include_once("./_common.php");

$sql = " update {$write_table}
                set wr_content='$wr_content'
              where wr_id = '$wr_id' ";
echo $sql;
sql_query($sql);

