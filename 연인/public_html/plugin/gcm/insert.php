<?
include_once('./_common.php');

$RegID			=	$_REQUEST['RegID'];
$mb_id			=	$_REQUEST['mb_id'];
$DeviceID		=	$_REQUEST['DeviceID'];
$type			=	$_REQUEST['type'];
$bundle			=	$_REQUEST['bundle'];

if($type == "" || !$type) {
	$type = "0";
}

if(!$RegID || !($DeviceID||$mb_id)){
	return;
}

sql_query("CREATE TABLE IF NOT EXISTS `gcm_member` (
  `idx` int(11) NOT NULL auto_increment,
  `mb_id` varchar(50) NOT NULL,
  `DeviceID` varchar(50) NOT NULL,
  `RegID` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `state` varchar(10) NOT NULL,
  `count` int(11) NOT NULL,
  `sound` int(11) NOT NULL,
  `bundle` varchar(50) NOT NULL,
  PRIMARY KEY  (`idx`),
  KEY `idx` (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

sql_query("CREATE TABLE IF NOT EXISTS `gcm_write_msg` (
  `idx` int(11) NOT NULL auto_increment COMMENT '인덱스',
  `mb_id` varchar(50) NOT NULL COMMENT '보낸사람 아이디',
  `title` varchar(50) NOT NULL COMMENT '제목',
  `msg` text NOT NULL COMMENT '내용',
  `link` varchar(255) NOT NULL COMMENT 'URL',
  `date` datetime NOT NULL COMMENT '보낸 날짜/시간',
  `count` int(11) NOT NULL COMMENT '메시지 안 읽은 사람 수',
  `view_member` text NOT NULL COMMENT '메시지 읽은 사람 아이디',
  `send_member` text NOT NULL COMMENT '받는 사람 아이디',
  PRIMARY KEY  (`idx`),
  KEY `idx` (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

$row = sql_fetch("Select * From `gcm_member` Where `DeviceID` = '$DeviceID' and `type` = '$type'");

if($row != null){
	sql_query("Update `gcm_member` set 
	`mb_id` = '$mb_id',
	`DeviceID` = '$DeviceID',
	`RegID` = '$RegID',
	`bundle` = '$bundle'
	Where `DeviceID` = '$DeviceID' and `type` = '$type'");
} else {
	sql_query("Insert into `gcm_member` set
	`mb_id` = '$mb_id',
	`DeviceID` = '$DeviceID',
	`RegID` = '$RegID',
	`type` = '$type',
	`state` = '1',
	`bundle` = '$bundle',
	`count` = '0'");
}


?>