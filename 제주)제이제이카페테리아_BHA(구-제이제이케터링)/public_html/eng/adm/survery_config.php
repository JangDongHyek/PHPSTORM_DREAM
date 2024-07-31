<?php

$g5['survey_table'] = "g5_eazy_survey";
$g5['clause_table'] = "g5_eazy_clause";

if(!sql_query(" DESCRIBE {$g5['survey_table']} ", false)) {
    sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['survey_table']}` (
                    `sv_id` int(11) NOT NULL AUTO_INCREMENT,
                    `sv_subject` varchar(255) NOT NULL,
                    `sv_cnt` int(11) NOT NULL,
                    `sv_date` date NOT NULL,
                    `sv_ips` varchar(255) NOT NULL,
                    `mb_ids` varchar(255) NOT NULL,
                    PRIMARY KEY (`sv_id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;", true);
    $db_reload = true;
}

if(!sql_query(" DESCRIBE {$g5['clause_table']} ", false)) {
    sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['clause_table']}` (
                    `cl_id` int(11) NOT NULL AUTO_INCREMENT,
                    `cl_subject` varchar(255) NOT NULL,
                    `cl_1` varchar(255) NOT NULL,
                    `cl_2` varchar(255) NOT NULL,
                    `cl_3` varchar(255) NOT NULL,
                    `cl_4` varchar(255) NOT NULL,
                    `cl_5` varchar(255) NOT NULL,
                    `cl_6` varchar(255) NOT NULL,
                    `cl_7` varchar(255) NOT NULL,
                    `cl_8` varchar(255) NOT NULL,
                    `cl_cnt1` int(11) NOT NULL,
                    `cl_cnt2` int(11) NOT NULL,
                    `cl_cnt3` int(11) NOT NULL,
                    `cl_cnt4` int(11) NOT NULL,
                    `cl_cnt5` int(11) NOT NULL,
                    `cl_cnt6` int(11) NOT NULL,
                    `cl_cnt7` int(11) NOT NULL,
                    `cl_cnt8` int(11) NOT NULL,
                    `cl_ext` int(1) NOT NULL,
                    `cl_ext_cnt` int(11) NOT NULL,
                    `cl_ext_txt` text NOT NULL,
                    `sv_id` int(11) NOT NULL,
                    PRIMARY KEY (`cl_id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;", true);
    $db_reload = true;
}

if ($db_reload) { 
    alert("DB를 갱신합니다.", G5_ADMIN_URL.'/survey_form.php'); 
} 

?>