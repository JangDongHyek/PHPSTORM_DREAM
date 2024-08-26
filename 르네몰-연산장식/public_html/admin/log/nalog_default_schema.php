<?
####################################################################################
//					접속통계테이블
####################################################################################
$table="
CREATE TABLE nalog3_data (
  no int(11) NOT NULL auto_increment,
  yy int(4) default NULL,
  mm int(4) default NULL,
  dd int(4) default NULL,
  h0 int(11) default '0',
  h1 int(11) default '0',
  h2 int(11) default '0',
  h3 int(11) default '0',
  h4 int(11) default '0',
  h5 int(11) default '0',
  h6 int(11) default '0',
  h7 int(11) default '0',
  h8 int(11) default '0',
  h9 int(11) default '0',
  h10 int(11) default '0',
  h11 int(11) default '0',
  h12 int(11) default '0',
  h13 int(11) default '0',
  h14 int(11) default '0',
  h15 int(11) default '0',
  h16 int(11) default '0',
  h17 int(11) default '0',
  h18 int(11) default '0',
  h19 int(11) default '0',
  h20 int(11) default '0',
  h21 int(11) default '0',
  h22 int(11) default '0',
  h23 int(11) default '0',
  hit int(11) default '0',
  week int(1) default NULL,
  counter varchar(50) NOT NULL default '',
  PRIMARY KEY  (no)
)";
@mysql_query($table,$connect);
@mysql_query("ALTER TABLE `nalog3_data` ADD INDEX `idx` (`counter`,`yy`,`mm`,`dd`,`week`)",$connect);

####################################################################################
//					os/browser
####################################################################################
$table="

CREATE TABLE nalog3_os (
  no int(11) NOT NULL auto_increment,
  name varchar(100) default NULL,
  os tinyint(1) default NULL,
  hit int(11) default '0',
  counter varchar(50) default NULL,
  PRIMARY KEY  (no)
)";
@mysql_query($table,$connect);
@mysql_query("ALTER TABLE `nalog3_os` ADD INDEX `idx` (`counter`,`os`,`name`,`hit`)",$connect);
?>