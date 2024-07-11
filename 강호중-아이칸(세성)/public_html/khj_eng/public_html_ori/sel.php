<? 
include "./connect.php";
?>
<script>
<!-- 
var arrItems1 = new Array(); 
var arrItemsGrp1 = new Array(); 


<?php
//$SQL="SELECT * FROM category where category_degree='1'";
$SQL = "select * from category where category_degree='1' group by sung_area order by category_num ";
$result = mysql_query($SQL, $dbconn);
while($rows=mysql_fetch_array($result)){
$i="$rows[sung_num]"; //그룹고유번호
$cont="$rows[sung_area]"; 
printf("arrItems1[\"$i\"] = \"$cont\"; \n");
printf("arrItemsGrp1[\"$i\"] = \"$rows[sea_area]\"; \n");
}
?>

var arrItems2 = new Array(); 
var arrItemsGrp2 = new Array(); 

<?php
$SQL1 = "select * from category where category_degree='2' group by khan_area order by category_num ";
$result1 = mysql_query($SQL1, $dbconn);
while($rows1=mysql_fetch_array($result1)){
$i+=1; //그룹고유번호
$cont1="$rows1[khan_area]";
printf("arrItems2[$i] = \"$cont1\"; \n");
printf("arrItemsGrp2[$i] = \"$rows1[sung_num]\"; \n"); //부모그룹고유번호랑 $rows1[prevno]랑 일치해야함
$i++;
}
?>

var arrItems3 = new Array(); 
var arrItemsGrp3 = new Array(); 

<?php
$SQL3="SELECT * FROM category where category_degree='3'";
$result3 = mysql_query($SQL3, $dbconn);
$i=1;
while($rows3=mysql_fetch_array($result3)){
$cont3="$rows3[category_name]";
printf("arrItems3[$i] = \"$cont3\"; \n");
printf("arrItemsGrp3[$i] = \"$rows3[prevno]\"; \n"); //부모그룹고유번호랑 $rows1[prevno]랑 일치해야함
$i++;
}
?>

function selectChange(control, controlToPopulate, ItemArray, GroupArray) 
{ 
var myEle ; 
var x ; 
for (var q=controlToPopulate.options.length;q>=0;q--) controlToPopulate.options[q]=null; 
if (control.name == "firstChoice") { 
for (var q=myChoices.thirdChoice.options.length;q>=0;q--) myChoices.thirdChoice.options[q] = null; 
} 
myEle = document.createElement("option") ; 
myEle.value = 0 ; 
myEle.text = "[항목을 선택 하세요]" ; 
controlToPopulate.add(myEle) ; 
for ( x = 0 ; x < ItemArray.length ; x++ ) 
{ 
if ( GroupArray[x] == control.value ) 
{ 
myEle = document.createElement("option") ; 
myEle.value = x ; 
myEle.text = ItemArray[x] ; 
controlToPopulate.add(myEle) ; 
} 
} 
} 
//--> 
</script>

<form name='form' method='post' action='pds_upost.php' enctype='multipart/form-data'>
<SELECT id=sea_area name=sea_area onchange="selectChange(this, form.sung_area, arrItems1, arrItemsGrp1);">
<option value=0 SELECTED>제조사</option>
<?
$SQL = "select distinct(sea_area) from category where category_degree='0' order by category_num ";
$result = mysql_query($SQL, $dbconn);
while($rows=mysql_fetch_array($result)){
?>
<option value="<?=$rows[sea_area]?>"><?=$rows[sea_area]?></option>
<?
}
?>
</select>

</SELECT>
<SELECT id=sung_area name=sung_area onchange="selectChange(this, form.khan_area, arrItems2, arrItemsGrp2);"></SELECT>

<SELECT id=khan_area name=khan_area ></SELECT>


</form> 