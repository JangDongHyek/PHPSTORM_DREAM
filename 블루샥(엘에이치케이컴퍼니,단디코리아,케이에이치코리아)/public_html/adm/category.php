<?php
$sub_menu = "300000";
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');
$sql="select * from g5_category order by idx asc";
$result=sql_query($sql);
?>

<style>
  body{ padding:4%}
  h2{ padding:0 !important; text-align:center;} 
  .confirm button{ background-color: #2f8bbf; color: #fff; font-weight: bold; font-size:1.20em; padding:15px 12px; border:0}
  .add button{ background-color: #5b6c76; color: #fff; font-weight: bold; font-size:1.0em; padding:5px 10px; border:0}
  .tbl_head01 thead th{ padding:5px !important}
  .tbl_head01 input { height:24px}
</style>

<h2>분류관리</h2>
<form method="post" action="./category.update.php" name="form">
    <div class="tbl_head01 tbl_wrap">
    <table width="100%">
        <colgroup>
               <col style="width:10%" />
               <col style="width:*" />
        </colgroup>
        <thead>
            <tr>
                <th colspan="3" align="right" class="add">
                    <button type="button" id="add-btn">추가</button>
                    <button type="button" id="remove-btn">삭제</button>
                </th>
            </tr>
            <tr>
                <th>번호</th>
                <th>분류명</th>
                
            </tr>
        </thead>
        <tbody id="cateform">
            <?php
                for($i=0;$row=sql_fetch_array($result);$i++){
            ?>
            <input type="hidden" name="idx[]" value="<?php echo $row[idx]?>">
            <tr>
                <td style="text-align:center">
                    <?php echo $i+1?>
                </td>
                <td>
                    <input type="text" name="category_name[]" value="<?php echo $row[category_name]?>">
                </td>
            </tr>
            <?php }?>
            <tr>
                <td style="text-align:center"><?php echo $i+1?></td>
                <td>
                    <input type="text" name="category_name[]" value="">
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    
    <div class="confirm" style="text-align:center"><button type="submit">확인</button></div>
</form>

<script type="text/javascript">
	$(function(){
		let no = $("#cateform").find("tr").length;
		$("#add-btn").click(function(){
			no++;
			let strHtml=`<tr>
			<td>${no}</td>
			<td>
				<input type="text" name="category_name[]" value="">
			</td>
			<td></td>
		</tr>`;
		$("#cateform").append(strHtml);

		});
		$("#remove-btn").click(function(){
			if(1 < no){
				$("#cateform").find("tr:last").remove();
				no--;
			}else{
			
			}
		});
	});


</script>