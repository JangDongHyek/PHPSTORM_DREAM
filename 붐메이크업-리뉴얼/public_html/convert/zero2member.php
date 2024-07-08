<?
include "dbconn.php" ;

$dbqry="TRUNCATE TABLE rg_member";
mysql_query($dbqry);

echo ('<pre> MEMBER CONVERT START==========></pre><br>');
$q='SELECT * FROM zetyx_member_table order by no';
$result=mysql_query($q);
while($data=mysql_fetch_array($result)) {

	$mb_level=1 ;
	if($data[level]==1) $mb_level=10 ;

	$mb_icon = "";
	$mb_photo = "";
	$data[birth] = strftime("%Y%m%d",$data[birth]);

	//member icon
	if (file_exists("../$zero_dir/icon/private_name/$data[no].gif")) {
		$mb_icon = $data[no]."_".substr(md5(uniqid(rand())), 0, 4).".gif";
        @copy("../$zero_dir/icon/private_name/$data[no].gif", "../$rg_dir/data/__mb_icon/$mb_icon");
        chmod("../$rg_dir/data/__mb_icon/$mb_icon", 0606);
    }

	//member picture
	if ($data[picture] && file_exists("../$zero_dir/$data[picture]")) {
		$temp=explode(".",$data[picture]);
		$file[ext]=$temp[count($temp)-1];
		$mb_photo = $data[no]."_".substr(md5(uniqid(rand())), 0, 4).".".$file[ext];
        @copy("../$zero_dir/$data[picture]", "../$rg_dir/data/__mb_photo/$mb_photo");
        @chmod("../$rg_dir/data/__mb_photo/$mb_photo", 0606);
    }
	
	$dbqry="
		INSERT INTO rg_member ( mb_num,mb_id,mb_password,mb_nick,mb_name,
			 mb_email,mb_msn,mb_homepage,mb_tel,mb_mobile,mb_jumin,mb_birth,
			 mb_address1,mb_address2,mb_job,mb_hobby,mb_photo,mb_mailing,mb_open_info,mb_icon,
			 mb_greet,mb_point,mb_level,mb_reg_date)
		VALUES (
		'$data[no]','$data[user_id]','$data[password]','$data[name]','$data[name]','$data[email]',
		'$data[msn]','$data[homepage]','$data[home_tel]','$data[handphone]','$data[jumin]',
		'$data[birth]','$data[home_address]','$data[office_address]','$data[job]','$data[hobby]',
		'$mb_photo','$data[mailing]','$data[openinfo]','$mb_icon','$data[comment]','$data[point1]',
		'$mb_level','$data[reg_date]') ";
	mysql_query($dbqry);

}
echo ('<pre> FINISH!!!!!!!!</pre><br>');

?>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr><td align=center>
<a href=javascript:void(history.back()) onfocus=blur()>back</a></td>
</tr>
</table>

