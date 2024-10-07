<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script>
function no_search(){
	document.search_form.keyset.value='';
	document.search_form.searchword.value='';
	document.search_form.submit();
}
function check(keyset, searchword){
	if(keyset == '' || searchword == ''){
		alert("먼저 검색을 하세요.");
		return false;
	}
	else{
		window.location.href='mail_send.php?keyset='+keyset+'&searchword='+searchword;
		return true;
	}
}
function opensub(t,w,h)
{	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}  
function opensub1(t,w,h)
{	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=no,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}  
function goTo(f){
	if(f.target_value.value != ""){
		f.action=f.target_value.value;
		f.submit();
	}
}
</script>

</head>

<body bgColor="#ffffff" leftMargin="0" topMargin="0">

<table height="100%" cellSpacing="0" cellPadding="0" width="780" border="0">
  <tr>
    <td vAlign="top" width="106"><p align="left"><br>
    <br>
    <br>
    </p>
    <table cellSpacing="0" cellPadding="0" width="100%" border="0">
      <tr>
        <td width="100%"><img height="36" src="../images/a5.gif" width="160"></td>
      </tr>
      <tr>
        <td width="100%" bgColor="#5a94bd" height="1"></td>
      </tr>
      <tr>
        <td width="100%" bgColor="#f2f2f2"><p style="PADDING-LEFT: 5px"><span class="bb"><br>
        <small>▶</small> <font face="돋움">쇼핑몰에 가입한<strong> 업체회원을 
        &nbsp;&nbsp; 그룹별</strong>로 관리합니다.<br>
        </font><br>
        </span></td>
      </tr>
      <tr>
        <td width="100%" bgColor="#5a94bd" height="1"></td>
      </tr>
    </table>
    <p align="left"><br>
    <br>
    </td>
    <td width="1" bgColor="#5a94bd"></td>
    <td vAlign="top" width="646" bgColor="#ffffff"><div align="center"><center>
    <table cellSpacing="0" cellPadding="0" width="100%" border="0">
      <tr>
        <td vAlign="top" width="90%" bgColor="#ffffff"><p style="PADDING-LEFT: 10px"><span
        class="aa"><br>
        현재 쇼핑몰에 가입한 업체회원들을 그룹별로 관리합니다.<br>
        그룹명을 클릭하시면 해당그룹의 업체회원리스트가 출력됩니다.<br>
        <br>
        </span></td>
      </tr>
      <tr>
        <td vAlign="top" width="90%" bgColor="#ffffff"></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#808080" height="1"></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
        <table width="100%" border="0">
          <tr>
            <td width="100%" colSpan="3" height="20"><p align="center"><strong><span class="cc"></span></strong></p>
            <table border="0" width="100%">
              <tr>
                <td width="84%"><p align="left"><strong><span class="cc">[업체회원그룹관리&gt;개별그룹관리]</span></strong></td>
                <td width="16%"><p align="right"><a href="mem_grp_list.php"><strong><span class="cc">[처음으로]</span></strong></a></td>
              </tr>
              <tr>
                <td width="84%"><strong><span class="cc"><br>
                </span></strong></td>
                <td width="16%"><strong><span class="cc"></span></strong></td>
              </tr>
            </table>
            </td>
          </tr>
          <tr>
            <td width="200">
            <table cellSpacing="0" cellPadding="0" width="100%" border="0">
              <tr>
                <td width="100%" bgColor="#cccccc">
                <table cellSpacing="1" cellPadding="3" width="100%" border="0">
                  <tr>
                    <td width="100%" bgColor="#f7f7f7" height="20">
                    <table cellSpacing="0" cellPadding="0" width="100%" border="0">
                      <form method='post'>
                      <tr>
                        <td width="33%" height="25"><p align="left"><span class="aa">&nbsp; 그룹이동</span></td>
                        <td width="67%" height="25"><p align="center">
                        <select name="target_value" onchange="goTo(this.form)" class="bb" style="height: 18px; background-color: rgb(255,255,255); border: 1px solid black" size="1">
                        <?
                        $SQL0 = "select * from $Member_GroupTable where mart_id='$mart_id' order by date desc";
							          $dbresult0 = mysql_query($SQL0,$dbconn);
							          $numRows0 = mysql_num_rows($dbresult0);
							          for($i=0;$i<$numRows0;$i++){
					              	mysql_data_seek($dbresult0,$i);
													$ary = mysql_fetch_array($dbresult0);
													$grp_no_tmp = $ary["grp_no"];
													$grp_name = $ary["grp_name"];
							          	echo "
							          <option value='mem_grp_mem_list.php?grp_no=$grp_no_tmp'
							          	";
							          	if($grp_no == $grp_no_tmp) echo " selected";
							          	echo">$grp_name</option>";
							          }
							          ?>
							          </select></td>
                      </tr>
                      </form>
                    </table>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
            </td>
          </tr>
          <tr>
            <td width="100%" colSpan="3" height="20"><p align="center"></td>
          </tr>
          <tr>
            <td width="100%" colSpan="3" height="20"></td>
          </tr>
          <?
          if($order == '') $order = 'date';
          if($orderby == '') $orderby = 'desc';
          
          if($order == 'name') $binary_str = 'binary';
          else $binary_str = '';
              
          $SQL = "select * from $Member_GroupTable where grp_no='$grp_no' and mart_id='$mart_id'";
          $dbresult = mysql_query($SQL,$dbconn);
          mysql_data_seek($dbresult,0);
					$ary = mysql_fetch_array($dbresult);
					$grp_no = $ary["grp_no"];
					$grp_name = $ary["grp_name"];
	  			$grp_detail = $ary["grp_detail"];
	  			$area_use = $ary["area_use"];
	  			$sex_use = $ary["sex_use"];
	  			$age_use = $ary["age_use"];
	  			$login_use = $ary["login_use"];
	  			$money_use = $ary["money_use"];
	  			$bonus_use = $ary["bonus_use"];
	  			$area = $ary["area"];
	  			$sex = $ary["sex"];
	  			$age_from = $ary["age_from"];
	  			$age_to = $ary["age_to"];
	  			$login_from = $ary["login_from"];
	  			$login_to = $ary["login_to"];
	  			$money_from = $ary["money_from"];
	  			$money_to = $ary["money_to"];
	  			$bonus_from = $ary["bonus_from"];
	  			$bonus_to = $ary["bonus_to"];
				  
				  $today_year = date("y") + 100;
								
					$SQL1 = "select * from $Mart_Member_NewTable where mart_id='$mart_id' ";
					$SQL_AREA = " and binary address like '%$area%' ";
					$SQL_SEX = " and substring(passport2,1,1) ='$sex'";
					$SQL_AGE = " and ($today_year - substring(passport1,1,2)*1) between $age_from and $age_to ";
					$SQL_LOGIN = " and login_count between $login_from and $login_to ";
					$SQL_MONEY = " and money_total between $money_from and $money_to ";
					$SQL_BONUS = " and bonus_total between $bonus_from and $bonus_to ";
					
					$SQL2 = " and binary $keyset like '%$searchword%' ";
					$SQL3 = " order by $binary_str $order $orderby";
							
					if($area_use == '1')
						$SQL1 = $SQL1.$SQL_AREA;
					if($sex_use == '1')
						$SQL1 = $SQL1.$SQL_SEX;
					if($sex_use == '1')
						$SQL1 = $SQL1.$SQL_SEX;
					if($age_use == '1')
						$SQL1 = $SQL1.$SQL_AGE;
					if($login_use == '1')
						$SQL1 = $SQL1.$SQL_LOGIN;
					if($money_use == '1')
						$SQL1 = $SQL1.$SQL_MONEY;
					if($bonus_use == '1')
						$SQL1 = $SQL1.$SQL_BONUS;				
    			
    			$dbresult1 = mysql_query($SQL1, $dbconn);
					$numRows1 = mysql_num_rows($dbresult1);
							
    			if(!empty($keyset)&&!empty($searchword))
						$SQL=$SQL1.$SQL2.$SQL3;
					else
						$SQL=$SQL1.$SQL3;
					?>
          <form name='search_form' action='mem_grp_mem_list.php' method="POST">
      		<input type='hidden' name='grp_no' value='<?echo $grp_no?>'>
      		<input type='hidden' name='page' value=''>
      		
          <tr>
            <td width="35%" height="20"><p align="left"><strong><span class="bb">&nbsp;&nbsp; 
            <?echo $grp_name?> 
            현재 업체회원수 : 총 <font color="#ff0000"><?echo $numRows1?></font> 명</span></strong></td>
            <td width="50%" height="20"><p align="right">
            <select class="aa" size="1" name="keyset">
              <option value="username"
              <?
              if($keyset == 'username') echo "selected";
              ?>
              >아이디</option>
              <option value="name"
              <?
              if($keyset == 'name') echo "selected";
              ?>
              >이름</option>
              <option value="address"
              <?
              if($keyset == 'address') echo "selected";
              ?>
              >주소</option>
              <option value="email"
              <?
              if($keyset == 'email') echo "selected";
              ?>
              >메일</option>
              <option value="passport1"
              <?
              if($keyset == 'passport1') echo "selected";
              ?>
              >주민등록번호</option>
            </select> <span class="aa">
            <input name="searchword" value='<?echo $searchword?>' class="aa" style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="13"> &nbsp; </span>
            <input class="aa" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="검색"> </td>
            <td width="15%" height="20"><p align="center">
            <img onclick="javascript:no_search()" src="../images/none.gif" width="65" height="18" border="0"></a></td>
          </tr>
          </form>
        </table>
        </td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center>
        <table width="97%" border="0">
          <tr>
            <td width="100%" bgColor="#999999">
            <table cellSpacing="1" cellPadding="3" width="100%" border="0">
              <tr>
                <td align="middle" width="13%" bgColor="#8fbecd">
                <strong><span class="dd">
                <?
                if($order == 'username'){
                	if($orderby == 'desc') {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=username&orderby=asc'>
                		ID 
                		</a>
                		<small>▼</small>
                		";
                	}
                	else {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=username&orderby=desc'>
                		ID 
                		</a>
                		<small>▲</small>";
                	}	
                }
                else{
                	echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=username&orderby=desc'>
                		ID 
                		</a>
                	";
                }
                ?>
                </span></strong></td>
                <td align="middle" width="13%" bgColor="#8fbecd">
                <strong><span class="dd"> 
                <?
                if($order == 'name'){
                	if($orderby == 'desc') {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=name&orderby=asc'>
                		성명 
                		</a>
                		<small>▼</small>
                		";
                	}
                	else {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=name&orderby=desc'>
                		성명 
                		</a>
                		<small>▲</small>
                		";
                	}	
                }
                else{
                	echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=name&orderby=desc'>
                		성명 
                		</a>
                	";
                }
                ?>
                </span></strong></td>
                <td align="middle" width="27%" bgColor="#8fbecd">
                <strong><span class="dd">
                <?
                if($order == 'email'){
                	if($orderby == 'desc') {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=email&orderby=asc'>
                		이메일 
                		</a>
                		<small>▼</small>
                		";
                	}
                	else {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=email&orderby=desc'>
                		이메일 
                		</a>
                		<small>▲</small>
                		";
                	}	
                }
                else{
                	echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=email&orderby=desc'>
                		이메일 
                		</a>
                	";
                }
                ?>
                </span></strong></td>
                <td align="middle" width="13%" bgColor="#8fbecd">
                <strong><span class="dd">
                <?
                if($order == 'date'){
                	if($orderby == 'desc') {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=date&orderby=asc'>
                		가입일 
                		</a>
                		<small>▼</small>
                		";
                	}
                	else {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=date&orderby=desc'>
                		가입일 
                		</a>
                		<small>▲</small>
                		";
                	}	
                }
                else{
                	echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=date&orderby=desc'>
                		가입일 
                		</a>
                	";
                }
                ?></span></strong></td>
                <td align="middle" width="13%" bgColor="#8fbecd">
                <strong><span class="dd">
                <?
                if($order == 'money_total'){
                	if($orderby == 'desc') {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=money_total&orderby=asc'>
                		총구매액 
                		</a>
                		<small>▼</small>
                		";
                	}
                	else {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=money_total&orderby=desc'>
                		총구매액 
                		</a>
                		<small>▲</small>
                		";
                	}	
                }
                else{
                	echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=money_total&orderby=desc'>
                		총구매액 
                		</a>
                	";
                }
                ?>
                <small></small></span></strong></td>
                <td align="middle" width="10%" bgColor="#8fbecd">
                <strong><span class="dd">
                <?
                if($order == 'bonus_total'){
                	if($orderby == 'desc') {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=bonus_total&orderby=asc'>
                		M 
                		</a>
                		<small>▼</small>
                		";
                	}
                	else {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=bonus_total&orderby=desc'>
                		M 
                		</a>
                		<small>▲</small>
                		";
                	}	
                }
                else{
                	echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=bonus_total&orderby=desc'>
                		M 
                		</a>
                	";
                }
                ?>
                <small></small></span></strong></td>
                <td align="middle" width="12%" bgColor="#8fbecd">
                <strong><span class="dd">
                <?
                if($order == 'login_count'){
                	if($orderby == 'desc') {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=login_count&orderby=asc'>
                		로그인 
                		</a>
                		<small>▼</small>
                		";
                	}
                	else {
                		echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=login_count&orderby=desc'>
                		로그인 
                		</a>
                		<small>▲</small>
                		";
                	}	
                }
                else{
                	echo "
                		<a class='dd' href='mem_grp_mem_list.php?grp_no=$grp_no&page=$page&keyset=$keyset&searchword=$searchword&order=login_count&orderby=desc'>
                		로그인 
                		</a>
                	";
                }
                ?>
                </span></strong></td>
              </tr>
              <?
              //echo "sql=$SQL";
              $dbresult = mysql_query($SQL, $dbconn);
							$numRows = mysql_num_rows($dbresult);
							if ($cnfPagecount == "") $cnfPagecount = 10;
							if ($page == "") $page = 1;
							$skipNum = ($page - 1) * $cnfPagecount;
							
							$prev_page = $page - 1;
							$next_page = $page + 1;
							
							$total_page = ($numRows - 1) / $cnfPagecount;
							$total_page = intval($total_page)+1;
							
							if($page % 10 == 0)
							$start_page = $page - 9;
							else
							$start_page = $page - ($page % 10) + 1;
							
							$end_page = $start_page + 9;
							if($end_page >= $total_page)
								$end_page = $total_page;
							$prev_start_page = $start_page - 10;
							$next_start_page = $start_page + 10;
							
							for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
								if ($i >= $numRows) break;
								mysql_data_seek($dbresult, $i);
								$ary=mysql_fetch_array($dbresult);
								$username = $ary["username"];
								$password = $ary["password"];
								$name = $ary["name"];
								$passport1 = $ary["passport1"];
								$passport2 = $ary["passport2"];
								$age = $ary["age"];
								$birth = $ary["birth"];
								$email = $ary["email"];
								$tel = $ary["tel"];
								$tel1 = $ary["tel1"];
								$zip = $ary["zip"];
								$resd = $ary["resd"];
								$address = $ary["address"];
								$date = $ary["date"];
								$date_str = substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2);
								$is_member = $ary["is_member"];
								$if_maillist = $ary["if_maillist"];
								$login_count = $ary["login_count"];
								$bonus_total = $ary["bonus_total"];
								$money_total = $ary["money_total"];
								
								if($if_maillist == '1') $if_maillist_str ="<img src='../images/y.gif'>";
								else $if_maillist_str ="<img src='../images/n.gif'>";
								
								$bonus_total_str = number_format($bonus_total);
								$money_total_str = number_format($money_total);
								echo "
							<tr>
                <td align='left' width='13%' bgColor='#ffffff'><span class='aa'>
                <a href=\"javascript:opensub('mem_order_list.php?username=$username', 620, 500)\">
		             $username</a></span></td>
                <td align='left' width='13%' bgColor='#ffffff'><span class='aa'>
                $if_maillist_str
                <a href='member_view.php?page=$page&keyset=$keyset&searchword=$searchword&username=$username'>$name</a></span></td>
                <td align='left' width='27%' bgColor='#ffffff'>
               	<a href=\"javascript:opensub1('mem_email_send.php?username=$username', 645, 645)\">
               	<span class='aa'>$email</span></a></td>
                <td align='left' width='13%' bgColor='#ffffff'><span class='aa'>$date_str</span></td>
                <td align='right' width='13%' bgColor='#ffffff'>
                <span class='aa'>$money_total_str</span></td>
                <td align='right' width='10%' bgColor='#ffffff'>
                <a href=\"javascript:opensub('bonus.php?username=$username', 665, 400)\">
                <span class='aa'>$bonus_total_str</span></a></td>
                <td align='right' width='12%' bgColor='#ffffff'>
                <span class='aa'>$login_count</span></td>
              </tr>
              	";
              }
              ?>
            </table>
            </td>
          </tr>
        </table>
        </center></div></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"><p align="right">
        <span class="aa">
        <?
        		if($page == 1){
        			echo ("
        			처음
        			");
        		}
        		else{
        			echo ("
        			<a href='mem_grp_mem_list.php?grp_no=$grp_no&page=1&keyset=$keyset&searchword=$searchword&order=$order&orderby=$orderby'>처음</a> 
        			");
        		}
        	
        		if($start_page > 1){
					echo ("
					<a href='mem_grp_mem_list.php?grp_no=$grp_no&page=$prev_start_page&keyset=$keyset&searchword=$searchword&order=$order&orderby=$orderby'>
					◁&nbsp; 
					</a>
					");
				}
				else{
					echo ("
					◁&nbsp; 
					");
				}
				for($i=$start_page;$i<=$end_page;$i++){
					if($i == $page){
						echo ("	
						[<b>$i</b>]
						");
					}
					else{
						echo ("
					<a href='mem_grp_mem_list.php?grp_no=$grp_no&page=$i&keyset=$keyset&searchword=$searchword&order=$order&orderby=$orderby'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='mem_grp_mem_list.php?grp_no=$grp_no&page=$next_start_page&keyset=$keyset&searchword=$searchword&order=$order&orderby=$orderby'>
					&nbsp;▷
					</a>
					");
				}
				else{
					echo ("
					&nbsp;▷
					");
				}
				if($page == $total_page){
        			echo ("
        			끝
        			");
        		}
        		else{
        			echo ("
        			<a href='mem_grp_mem_list.php?grp_no=$grp_no&page=$total_page&keyset=$keyset&searchword=$searchword&order=$order&orderby=$orderby'>끝</a> 
        			");
        		}
        		?>
        		</span></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"><p align="center"></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"></td>
      </tr>
      <tr align="middle">
        <td vAlign="top" width="100%" bgColor="#ffffff"><p align="center"><br>
        <br>
        <input onclick="window.location.href='mail_send.php?grp_no=<?echo $grp_no?>'" class="aa" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="현재그룹 메일발송하기"> </td>
      </tr>
      <tr align="middle">
        <td vAlign="top" width="100%" bgColor="#ffffff"></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"></td>
      </tr>
</TBODY>
    </table>
    </center></div></td>
  </tr>
</TBODY>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>