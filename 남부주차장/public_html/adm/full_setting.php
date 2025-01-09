<?php
$sub_menu = "300100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
$sql = "select * from g5_fullsetting";
$result=sql_query($sql);

$g5['title'] = '만차설정';
include_once('./admin.head.php');
?>

<div class="local_ov01 local_ov">
    <p>아래 주차장의 만차 설정을 하실 수 있습니다. 원하시는 주차장의 on/off 체크 후 아래 설정 버튼을 선택해주세요.</p>
    <p class="check">※ <span class="on">on</span> 은 주차를 받을 수 있는 상탭니다. <span class="off">off</span> 는 주차를 받을 수 없는 상탭니다. </p>
</div>
<form name="form" method="post" action="./full_setting_update.php">
<div id="full_setting">
    <ul>
		<? 
		$no=1;
		while($row=sql_fetch_array($result)){?>
		<li>
            <dl>
                <dt><?php echo $row[parkname]?><span class="<?php echo $row[full]=="1"?"on":"off";?>"><?php echo $row[full]=="1"?"on":"off";?></span></dt>
                <dd>
                    <span><input type="radio" name="full<?=$no?>" id="full<?=$no?>" value="1" required=""<?php echo $row[full]=="1"?" checked":"";?>>
                    <label for="full<?=$no?>">on</label></span>
                    <span><input type="radio" name="full<?=$no?>" id="full<?=$no?>" value="0" required=""<?php echo $row[full]=="0"?" checked":"";?>>
                    <label for="full<?=$no?>">off</label></span>
                </dd>
                <dd><strong>명성주차장</strong>은 예약을 받을 수 있습니다.</dd>
            </dl>
         </li>
		<? $no++;}?>
        
    </ul>
     <div class="btn_group">
	    <input type="submit" value="설정하기" class="submit">
	</div>
</div>
</form>

<?php if ($is_admin == 'super') { ?>
<?php } ?>


<?php
include_once('./admin.tail.php');
?>
