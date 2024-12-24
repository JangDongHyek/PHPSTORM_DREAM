<?php
include_once('./_common.php');


$response = array( "message" => "" );
$_method = $_POST["_method"];
$obj = str_replace('\\','',$_POST['obj']);
$obj = json_decode($obj);

try {
    switch (strtolower($_method)) {
        case "gets":
        {
            $response['success'] = true;
            break;
        }

        case "get":
        {
            $response['success'] = true;
            break;
        }

        case "post":
        {
            $obj->mb_id = $_SESSION['ss_mb_id'];

            $query = "";
            $bool = false;
            foreach($obj as $key => $value){
                if($bool) {
                   $query .= ", ";
                }
                $query .= $key." = '{$value}'" ;
                $bool = true;
            }

            $sql = "INSERT INTO petition SET $query";

//            $result = mysql_query($sql,$g5['connect_db']);
//            if(!$result) throw new Exception(mysql_error());

            sql_query($sql);
            $response['data'] = $sql;
            $response['success'] = true;
            break;
        }
        case "put":
        {
            $response['success'] = true;
            break;
        }
        case "delete":
        {
            $response['success'] = true;
            break;
        }
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

echo json_encode($response);


//$address = $_POST["addr"].' '.$_POST["addr_dtl"];
//$sql = "INSERT INTO petition
//        SET name = '{$_POST["name"]}',
//            mb_hp = '{$_POST["mb_hp"]}',
//            organization = '{$_POST["organization"]}',
//            address = '{$address} ',
//            create_at = now()";
//
//echo $sql;
?>