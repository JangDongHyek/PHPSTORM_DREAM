<?php
include_once('../common.php');

 $sql = "
INSERT INTO 
    crontab_check
SET
    reg_date = NOW();
";
        
sql_query($sql);

?>    