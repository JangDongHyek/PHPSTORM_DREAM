<?php 

// ���ó�¥ ����
$today = getdate(); 
$b_month = $today['mon'];
$b_day = $today['mday']; 
$b_year = $today['year']; 

// ����Ʈ��Ŀ�� ��¥ ���ý� �� �ֱ�
if($pickdate){
	$month = substr($pickdate,4,2);
	$day = substr($pickdate,6,2);
	$year = substr($pickdate,0,4);
}
// �ƹ��͵� �Ѿ�� ���� ������ ���ó�¥ �ֱ�
if ($year < 1) { 
  $month = $b_month;
  $day = $b_day;
  $year = $b_year;
}

// üũ�� �ο� �� �˻������� �����Ҽ��ֵ��� ���� ������
// �۾��˻�, ����Ʈ��Ŀ, �޷¹���, Ȯ�ι�ư, ������, �̹���, ������ ��Ȳ�϶� �����
// �ʱ�ȭ, �������� ��Ȳ������ ������
for($j=0; $j<count($chk_where); $j++){
	$chk_member_url .= "&chk_where[".$j."]=".$chk_where[$j];
}
for(; $j<count($chk_where2); $j++){
	$chk_member_url .= "&chk_where2[".$j."]=".$chk_where2[$j];
}
if($stx) $chk_member_url .= "&stx=".$stx;
// ���� ��

// �޷¹���, �Ѿ�°��� ������ 2���� �⺻
if($lookdate == "") $lookdate = "20"; 

// �޷¹��� ����
$lookdateurl = "&lookdate=".$lookdate;


// �޷»������� �⺻ ��¥ ����...............
$f_day = date("Ymd",mktime(0, 0, 0, $month, $day-7, $year));
$prevyear  = substr($f_day,0,4);
$prevmonth = sprintf("%d",substr($f_day,4,2));
$prevday   = sprintf("%d",substr($f_day,6,2));

$l_day = date("Ymd",mktime(0, 0, 0, $month, $day+7, $year));
$nextyear  = substr($l_day,0,4);
$nextmonth = sprintf("%d",substr($l_day,4,2));
$nextday   = sprintf("%d",substr($l_day,6,2));

$offset  = date("w", mktime(0, 0, 0, $month, 1, $year));

$cur_day = date("w",mktime(0, 0, 0, $month, $day, $year));
$minus_day = $lookdate - $cur_day;

$week_first = date("Ymd", mktime(0, 0, 0, $month, $day-$cur_day, $year));
$week_last  = date("Ymd", mktime(0, 0, 0, $month, $day+$minus_day, $year));

//���� �� ����
$col_height= 60 ; 


$query = "SELECT * FROM `g5_member` Where `mb_level` <> 10 and `mb_level` > 1  ORDER BY mb_1 desc";
$result = sql_query($query);
$all_member = array(); // ��ڿ� 1������ ������ ��� ���
for($j=0; $row=sql_fetch_array($result); $j++) {
	$all_member[] = $row;
}

$de_member = array(); // ���α׷� ���
$pr_member = array(); // ������ ���
$ma_member = array(); // ������ ���
$yy_member = array(); // ���� ���

for($j=0; $j<count($all_member); $j++){
	if($all_member[$j]['mb_level'] == 2){
		$pr_member[] = $all_member[$j]; // ����2�� ���α׷�
	} else if($all_member[$j]['mb_level'] == 3){
		$de_member[] = $all_member[$j]; // ����3�� ������
	} else if($all_member[$j]['mb_level'] == 4){
		$ma_member[] = $all_member[$j];	// ����4�� ���� �����ο��� �ʱ��ȹ�ϰ� �ٸ��� �� 8,9 ������ �ٲ���� ����� �� ��
	} else if($all_member[$j]['mb_level'] == 5){
		$yy_member[] = $all_member[$j]; // ����5�� ������
	} else if($all_member[$j]['mb_level'] == 8){
		$ma_member[] = $all_member[$j]; // ����8�� ����������
	} else if($all_member[$j]['mb_level'] == 9){
		$ma_member[] = $all_member[$j]; // ����9�� ����������
	}
}

for($j=0; $j<count($pr_member); $j++){
	$pr_url .= "&chk_where[".$j."]=".$pr_member[$j]['mb_name']; // ���α׷��� ��ü����
}

if($pr_url) $pr_url .= "&chk_where[".$j."]=".$ma_member[1]['mb_name']; // ���α׷��� ��ü���ÿ� ���������� �߰�

for($j=0; $j<count($de_member); $j++){
	$de_url .= "&chk_where[".$j."]=".$de_member[$j]['mb_name']; // �������� ��ü����
} 

if($de_url) $de_url .= "&chk_where[".$j."]=".$ma_member[0]['mb_name']; // ���������� ��ü���ÿ� ���������� �߰�

for($j=0; $j<count($ma_member); $j++){
	$ma_url .= "&chk_where[".$j."]=".$ma_member[$j]['mb_name']; // ������ ��ü����
}

$sql = "select * from `hollyday` where `date` >= '$week_first' and `date` <= '$week_last'";
$result = sql_query($sql);
for($j=0; $row=sql_fetch_array($result); $j++) {
	$hollday[] = $row;
	$hollday2[$row['date']] = $row;
}

?>