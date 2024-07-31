<?php

ini_set('memory_limit','1024M');
include_once("../common.php");
header("Content-Type: text/html; charset=UTF-8");
include_once('../lib/PHPExcel/Classes/PHPExcel/IOFactory.php');


$excel_file = $_FILES["excel_file"];
for($sheetnum =2; $sheetnum<3; $sheetnum++){
    $filetype = PHPExcel_IOFactory::identify($excel_file['tmp_name']);
    $reader = PHPExcel_IOFactory::createReader($filetype);
    $php_excel = $reader->load($excel_file['tmp_name']);
    $sheet = $php_excel->getSheet($sheetnum);           // 첫번째 시트
    $maxRow = $sheet->getHighestRow();          // 마지막 라인
    $maxColumn = $sheet->getHighestColumn();    // 마지막 칼럼
    $target = "A"."1".":"."$maxColumn"."$maxRow";
    $datenow = date("Y-m-d");
    $lines = $sheet->rangeToArray($target, NULL, TRUE, FALSE);
    $array_column = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $itemperrow = array();
    $date_rownum = array();
    //행 -> 열로 변경 배열 초기화

    $now_column = array_search($maxColumn,$array_column);
    $now_line = 0;

    for($i=0; $i<=$now_column; $i++){
        $itemperrow[$array_column[$i]] = array();
    }


    foreach ($lines as $key => $line){
        $col = 0;
        $item=array();
        for($k=0; $k<26; $k++){

            if(in_array("Day",$line) && $col>0 && $col%2==0){
                if(count($date_rownum) ==0 || end($date_rownum) != $now_line)
                    array_push($date_rownum,$now_line);
                array_push($item,PHPExcel_Style_NumberFormat::toFormattedString($line[$col++], PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2));
            }

            else{
                array_push($item,$line[$col++]);
            }

            if($maxColumn == $array_column[$k])
                break;

        }

        for($i=0; $i<count($item); $i++){
            array_push($itemperrow[$array_column[$i]],$item[$i]);
        }
        $now_line++;

    }

    $time_cate = $itemperrow["A"][2];
    $menu_cate =  str_replace(array("\r\n","\r","\n"),' ',$itemperrow["B"][$i]);
    $row_date = $itemperrow["C"][0];

    $date_now = date('Y-m-d H:i:s');


//    echo "first : ".$row_date."<br>";
//    var_dump($itemperrow);


//    if($sheetnum==2)
//        print_r($date_rownum);

    for($k=2; $k<=$now_column; $k+=2){
        for($i=2; $i<count($itemperrow["A"]); $i+=2){

            if($i==2){
                $row_date = $itemperrow[$array_column[$k]][0];
            }
            if($itemperrow["B"][$i] != $menu_cate && $itemperrow["B"][$i]!='Day' && !empty($itemperrow["B"][$i])){
                $menu_cate =  str_replace(array("\r\n","\r","\n"),' ',$itemperrow["B"][$i]);
            }
            if($time_cate!=$itemperrow["A"][$i] && $itemperrow["A"][$i]!='Menu' && !empty($itemperrow["A"][$i])){
                $time_cate = $itemperrow["A"][$i];
            }

            if(in_array($i,$date_rownum)){
                $row_date = $itemperrow[$array_column[$k]][$i];
            }else{

                $menu_array = array();

                if(!empty($itemperrow[$array_column[$k]][$i]))
                    array_push($menu_array,$itemperrow[$array_column[$k]][$i]);
//				if(!empty($itemperrow[$array_column[$k]][$i+1]))
//					array_push($menu_array,$itemperrow[$array_column[$k]][$i+1]);
                if(!empty($itemperrow[$array_column[$k+1]][$i]))
                    array_push($menu_array,$itemperrow[$array_column[$k+1]][$i]);

                $eng_val = $itemperrow[$array_column[$k]][$i+1];


                if(count($menu_array)>0)
                    $string_menu = implode("|",$menu_array);
                else
                    $string_menu = "";

                $string_menu = str_replace("'","\'",$string_menu);


                if(strpos($itemperrow["A"][$i],"Salad Bar") !==false){

                    if($k==2){
                        if($row_date_cut==''){
//                            $row_date_cut  = substr($itemperrow["C"][0],0,7);
                            for($o=2;$o<count($itemperrow);$o+=2){
                                $row_date_cut = substr($itemperrow[$array_column[$o]][0],0,7);
                                if($row_date_cut != ""){
                                    break;
                                }
                            }
                        }
                        for($l=$i; $l<count($itemperrow["A"]); $l++){

                            $sql="insert into g5_write_carte set 
                                                    wr_1 = '{$itemperrow['A'][$l]}' , 
                                                    wr_3='{$row_date_cut}', 
                                                    wr_4 = '{$date_now}' , 
                                                    wr_5 = '{$itemperrow['E'][$l]}' , 
                                                    wr_6 = {$sheetnum},
                                                    wr_7 = '{$eng_val}'";
                            sql_query($sql);

//                            echo "---------------------------------<br>";
//                            echo $sql."<br>";

                            $sql ="delete from g5_write_carte where 
                                                    wr_1 = '{$itemperrow['A'][$l]}' and 
                                                     wr_3='{$row_date_cut}' and 
                                                     wr_4 < '{$date_now}' and 
                                                     wr_6 = {$sheetnum}";
                            sql_query($sql);
//                            echo $sql."<br>";
//                            echo "---------------------------------<br>";
                        }
                    }
                    break;
                }

//                echo $row_date."<br>";
//                echo "---------------------------------<br>";
                $sql ="insert into g5_write_carte set 
                                            wr_1 = '{$time_cate}' ,
                                            wr_2 = '{$menu_cate}', 
                                            wr_3 = '{$row_date}', 
                                            wr_4 = '{$date_now}', 
                                            wr_5 = '{$string_menu}' , 
                                            wr_6 = {$sheetnum},
                                            wr_7 = '{$eng_val}'";
//                if($sheetnum==2  && $time_cate=='Snack')
//                    echo $sql;
                sql_query($sql);
//                echo $sql."<br>";

                $sql ="delete from g5_write_carte where 
                                            wr_1 = '{$time_cate}' and 
                                            wr_2 = '{$menu_cate}' and 
                                            wr_3 = '{$row_date}' and 
                                            wr_4 < '{$date_now}' and 
                                            wr_6 = {$sheetnum}";
//                if($sheetnum==2  && $time_cate=='Snack')
//                    echo $sql;
                sql_query($sql);
//                echo $sql."<br>";
//                echo "---------------------------------<br>";


            }
            //날짜 시간 메뉴 메뉴이름
        }
    }
}


?>