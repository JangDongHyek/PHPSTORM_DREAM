<?php
include_once("./db_config.php");
include_once("../lib/util.php");

$rs = $_POST;
$val = $rs['val'];

$reg_time = empty($rs['srl_reg_time']) ? "00:00:00" : $rs['srl_reg_time'].":00";
$comp_time = empty($rs['srl_complete_time']) ? "00:00:00" : $rs['srl_complete_time'].":00";
$sh_reg_time = empty($rs['sh_reg_time']) ? "00:00:00" : $rs['sh_reg_time'].":00";


$reg_datetime = empty($rs['srl_reg_date']) ? "" : $rs['srl_reg_date']." ".$reg_time;
$comp_datetime = empty($rs['srl_complete_date']) ? "" : $rs['srl_complete_date']." ".$comp_time;
$sh_reg_datetime = empty($rs['sh_reg_date']) ? "" : $rs['sh_reg_date']." ".$sh_reg_time;

switch ($val) {
  case 'insert':

    $sql = "INSERT INTO store_receipt_list SET
    srl_comp_name = '".$rs['srl_comp_name']."',
    srl_reg_date = '".$reg_datetime."',                        
    srl_reg_time = '".$reg_time."',   
    srl_class = '".$rs['srl_class']."',
    srl_state = '".$rs['srl_state']."',
    srl_account_class = '".$rs['srl_account_class']."',
    srl_content = '".$rs['srl_content']."'
    ";

    // 완료일이 존재하면
    if($rs['srl_complete_date']!=''){
      $sql.= ", srl_complete_date = '".$comp_datetime."' ";
    }

    if(sql_query($sql)){
        alert("스토어 등록 작성이 완료되었습니다.","../store_list.php");
    }else{
        alert_back("쿼리 실행이 잘못되었습니다.");
    }

    break;

  case 'update':

    $sql = "UPDATE store_receipt_list SET
    
    srl_comp_name = '".$rs['srl_comp_name']."',
    srl_reg_date = '".$reg_datetime."',           
    srl_reg_time = '".$reg_time."',
    srl_class = '".$rs['srl_class']."',
    srl_state = '".$rs['srl_state']."',
    srl_account_class = '".$rs['srl_account_class']."',
    srl_content = '".$rs['srl_content']."', 
    srl_complete_date = '".$comp_datetime."'
    WHERE srl_no = '".$rs['srl_no']."'  ";

    if(sql_query($sql)){
      alert("스토어 기록 수정이 완료되었습니다.","../store_read.php?srl_no=".$rs['srl_no']);
    }else{
      alert_back("쿼리 실행이 잘못되었습니다.");
    }

    break;

  case 'delete':
    $sql = "DELETE FROM store_receipt_list
    WHERE srl_no = '".$rs['srl_no']."'
    ";

    if(sql_query($sql)){
      $sql = "DELETE FROM store_history WHERE srl_no = '".$rs['srl_no']."' ";
      sql_query($sql);

      alert("스토어 기록이 삭제되었습니다.","../store_list.php");
    }else{
      alert_back("쿼리 실행이 잘못되었습니다.");
    }
    break;

  case 'history_insert' :

    $sql = "INSERT INTO store_history SET 
    sh_reg_date = '".$sh_reg_datetime."',  
    sh_reg_time = '".$rs['sh_reg_time']."',
    sh_content = '".$rs['sh_content']."',
    srl_no = '".$rs['srl_no']."' ";

    if(sql_query($sql)){
      alert("히스토리 작성이 완료되었습니다.","../store_read.php?srl_no=".$rs['srl_no']);
    }else{
      alert_back("쿼리 실행이 잘못되었습니다.");
    }

    break;

  case 'history_select' :
    $sql = "SELECT * FROM store_history 
    WHERE sh_no = '".$rs['sh_no']."' ";

    $rs = sql_fetch($sql);

    echo json_encode($rs);

    break;

  case 'history_update' :
    $sql = "UPDATE store_history SET 
    sh_reg_date = '".$sh_reg_datetime."',  
    sh_reg_time = '".$rs['sh_reg_time']."',
    sh_content = '".$rs['sh_content']."',
    srl_no = '".$rs['srl_no']."' 
    WHERE sh_no = '".$rs['sh_no']."' ";

    if(sql_query($sql)){
      alert("히스토리 수정이 완료되었습니다.","../store_read.php?srl_no=".$rs['srl_no']);
    }else{
      alert_back("쿼리 실행이 잘못되었습니다.");
    }
    break;

  case 'history_delete' :
    $sql = "DELETE FROM  store_history 
    WHERE sh_no = '".$rs['sh_no']."' ";

    $result = "";

    if(sql_query($sql)){
      $result = true;
    }else{
      $result = false;
    }

    echo $result;
    break;

  // 히스토리 번호 페이지 이동
  case 'page_move' :
    $srl_no = $rs['srl_no'];
    $cur_page = $rs['page'];
    $start = $cur_page * 10;

    // 보여줄 개수
    $end = 5;

    $sql = "SELECT count(*) AS cnt FROM store_history WHERE (1) AND srl_no = '$srl_no' ";
    $cnt = sql_fetch($sql);

    $sql = "SELECT * FROM g5_bugo_addr_list WHERE (1)
        AND srl_no = '$srl_no'                               
        LIMIT ".$start.",".$end;
    $state = sql_query($sql);

    while($rs = sql_fetch_array($state)){
      array_push($arr,$rs);
    }

    array_push($arr,$cnt);
    array_push($arr,$sql);
    echo json_encode($arr);

    break;


  default:
    echo "error";
    break;
}







?>
