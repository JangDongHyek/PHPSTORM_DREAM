<?php
//24.02.15 뱅크다에서 확인해서 맞으면 보내주는 시스템 구현하기 wc
include "../../connect.php";
include "./json.php";

// Future-friendly json_encode
if( !function_exists('json_encode') ) {
    function json_encode($data) {
        $json = new Services_JSON();
        return( $json->encode($data) );
    }
}
// Future-friendly json_decode
if( !function_exists('json_decode') ) {
    function json_decode($data) {
        $json = new Services_JSON();
        return( $json->decode($data) );
    }
}

if (!function_exists('curl_setopt_array')) {
    function curl_setopt_array(&$ch, $curl_options)
    {
        foreach ($curl_options as $option => $value) {
            if (!curl_setopt($ch, $option, $value)) {
                return false;
            }
        }
        return true;
    }
}


// CURL 경로
$url = 'https://www.bankda.com/dtsvc/xmldown.php';

$xml_date = date("Ymd");
$postfields = array();
$postfields['xml_userid'] = 'Hojung';
$postfields['xml_pwd'] = '77265679';
$postfields['xml_acctno'] = '140014374890';
$postfields['xml_date'] = $xml_date; //20240206
//$postfields['xml_mode'] = 'test';

if(!$xml_date){
    exit('nodate');
}
$xml2 = sendXmlOverPost($url,$postfields);
if(!$xml2){
    exit('nodata'.$xml2);
}

/*
$xml_data ='<?xml version="1.0" encoding="utf-8"?>
<bankda>
<account number="140014374890" bkname="신한은행" bkdate="20240206" record="1" description="정상">
<accinfo bkcode="81754804" accountnum="140014374890" bkdate="20240206" bktime="143718" bkjukyo="1001010965" bkcontent="타행FB" bketc="(하나)" bkinput="100" bkoutput="0" bkjango="1100"/>
<accinfo bkcode="12754804" accountnum="120014374890" bkdate="12240206" bktime="123718" bkjukyo="1201010965" bkcontent="12타행FB" bketc="12(하나)" bkinput="12100" bkoutput="120" bkjango="121100"/>
</account>
</bankda>';
*/
//echo '<pre>' . $xml2 . '</pre>';
//$xml2 = iconv('KSC5601', 'utf-8', $xml2);
//$xml2 = str_replace('&', '&amp;', $xml2);
//$xml2 = str_replace('<', '&lt;', $xml2);



$i = 0;
$xml2 = str_replace("KSC5601","euc-kr",$xml2);
$dom = domxml_open_mem($xml2);
$root = $dom->document_element();
$loops = $root->children();
$result = '';
foreach($loops as $loopNode){

    if($loopNode->node_name()!="#text"){
        $cells = $loopNode->children();

        foreach($cells as $cellNode){
            $cells2 = $cellNode->attributes();

            if($cellNode->node_name()!="#text") {
                foreach ($cells2 as $cellNode2) {
                    if($cellNode2->name == 'bkjukyo' || $cellNode2->name == 'bkcode' || $cellNode2->name == 'bkinput'){
                        $result .= $cellNode2->value.'|';
                    }
                }
                $result = substr($result, 0, -1);
                $result .= '*';
            }
        }
        $result = substr($result, 0, -1);
        $i++;
    }
}
//var_dump($result);

//$result = "81754804|1001010965|100_12754804|1201010965|120";


$array1 = array();
$array2 = array();
$array3 = array();

$array1 = explode("*", $result);
for ($i=0; $i < count($array1) ; $i++){
    $array2[$i] = explode("|", $array1[$i]);
}

//bkcode 고유번호 $array2[$j][0]
//bkjukyo 보낸사람 $array2[$j][1]
//bkinput 보낸금액 $array2[$j][2]

for ($j=0; $j < count($array2) ; $j++){
    $write_date = date("YmdHis");
    $bkcode = $array2[$j][0];
    //$bkjukyo = iconv('KSC5601','utf-8',$array2[$j][1]);
    $bkjukyo = $array2[$j][1];
    $bkinput = $array2[$j][2];

    $numRows1 = 0;
    if($array2[$j][0]) {
        $SQL = "select BKid from TBLBANK where Bkcode = {$array2[$j][0]}";
        $dbresult = mysql_query($SQL, $dbconn);
        $numRows1 = mysql_num_rows($dbresult);
    }else{
        exit('nodata');
    }

    if ($numRows1 > 0){

        echo 'allreay'.$bkcode.'|';

    }else{

        $SQL = "insert into TBLBANK (Bkcode, bkjukyo, bkinput, Bkxferdatetime)  values ('$bkcode', '$bkjukyo', '$bkinput', '$write_date')";
        $dbresult = mysql_query($SQL, $dbconn);

        $mart_id = 'khj';
        $content = "송금완료 충전금";
        $content = iconv('utf-8', 'euc-kr', $content);
        $mode = "ug";
        $id = $array2[$j][1];
        //$array_id = explode("_", $id);

        $id_sql = "select * from $ItemTable where provider_id = '{$id}'";
        $id_rs = mysql_query($id_sql, $dbconn);
        $id_arr = mysql_fetch_array($id_rs);

        echo $id_sql;
        var_dump($id_arr);

        if($id_arr){
            $id_real = $id_arr['sea_num'].$id_arr['sung_num'].$id_arr['khan_num'].$id_arr['sudong_num'];
            $bonus = $array2[$j][2];
            $SQL = "insert into $BonusTable (mart_id, provider_id, id, write_date, bonus, content, mode)  values ('$mart_id', '$provider_id', '$id_real', '$write_date', '$bonus', '$content', '$mode')";
            $dbresult = mysql_query($SQL, $dbconn);

            echo 'ok.'.$id_real.'|';
        }else{
            echo 'no_id|';
        }




    }
}



exit($dbresult);


function sendXmlOverPost($url, $xml) {


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);

    // For xml, change the content-type.
    curl_setopt ($ch, CURLOPT_HTTPHEADER, Array("Content-Type: multipart/form-data"));

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, "xml=" . $xml);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // ask for results to be returned

    // Send to remote and return data to caller.
    $result = curl_exec($ch);



    curl_close($ch);
    return $result;
}

