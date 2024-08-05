<?php
$sub_menu = "280100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$today = date("Y-m-d");

$sql = "select * from `v5_holiday_list` where `date` >= '$today' order by `date` desc limit 20 ";
$re = sql_query($sql);


$g5['title'] = '공휴일 관리';
include_once ('./admin.head.php');

$colspan = 9;

?>

<style>
	
 .td_mbid {
	text-align: center !important;
 }	

  .tbl_wrap {
    width: 100%;
    text-align: center;
  }

  table {
    margin: 0 auto;
  }

  th, td {
    text-align: center;
  }

  input[type="date"], #add_date_btn {
    display: inline-block;
    vertical-align: middle;
  }
  #add_date_btn {
      margin-left: 30px;
    }
</style>

<form name="fpointlist" id="fpointlist" method="post">
  <div class="tbl_head01 tbl_wrap">
    <table>
      <caption><?php echo $g5['title']; ?> 목록</caption>
      <thead>
        <tr>
          <th scope="col">날짜</a></th>
        </tr>
      </thead>
      <tbody>
        <tr class="<?php echo $bg; ?>">
          <td class="td_mbid">
            <input type="date" id="date" name="date">
            <button type="button" id="add_date_btn"  onclick="add()">추가하기</button>
          </td>
        </tr>

		<? while($row = sql_fetch_array($re)) { ?>
			<tr>
				<td class="td_mbid">
					<span><?=$row['date']?></span>
					<button type="button" id="add_date_btn" onclick="remove('<?=$row['idx']?>')">삭제하기</button>
				</td>
			</tr>
		<?}?>

      </tbody>
    </table>
  </div>
</form>


<script>


function add(){
    var date = $("#date").val();

	if(date == "" || date == null){
		alert("날짜를 입력해주세요");
		return false;
	}

    $.ajax({
      type: "POST",
      url: "./v5_holiday_update.php",
      data: { "date": date },
      success: function() {
        alert("날짜가 추가되었습니다.");
		location.reload();
      }
    });
}

function remove(idx){

    $.ajax({
      type: "POST",
      url: "./v5_holiday_update.php",
      data: { "idx": idx, "w":"d" },
      success: function() {
        alert("날짜가 삭제되었습니다.");
		location.reload();
      }
    });
}


</script>

<?php
include_once ('./admin.tail.php');
?>
