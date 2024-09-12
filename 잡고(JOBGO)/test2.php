<?php
//include_once("./jl/JlModel2.php");

//$model->error($current_date);
include_once("./jl/JlConfig.php");

//echo $jl->getClientIP();
// 캠페인 선장자


//echo $request_data['sql'];

//
$model = new JlModel(array(
    "table" => "g5_member",
    "empty" => false
));

echo $model->primary."<br>";
echo $model->primary_type."<br>";
echo $model->autoincrement."<br>";

//$getData = $model->where("idx","16")->get()['data'][0];
//
//$file = new JlFile("/jl/jl_resource/campaign");

//$file->deleteDirGate($getData['thumb']);
//$file->deleteDirGate($getData['company_thumb']);

//$dir = $jl->ROOT."/jl/jl_resource";
//echo $dir;
//if(!is_dir($dir)) {
//    if(mkdir($dir, 0777)) {
//        echo 1;
//    }else {
//        echo 2;
//    }
//}

//$model = new JlModell(array(
//    "table" => "campaign",
//    "primary" => "idx",
//    "autoincrement" => true,
//    "empty" => false
//));
//
//$model->join("campaign_like","idx","campaign_idx");
//$model->groupBy("campaign.idx","campaign_like.campaign_idx", "likess");
//$model->orderBy("insert_date","DESC");
//$model->where("user_idx","31");
//$data = $model->get(0,0,"campaign");




//$model->join("campaign","campaign_idx","idx");
//$model->where("category","SNS","AND","campaign");
//$model->between("activity_date","2024-08-07 00:00:00","2024-08-07 11:20:20","AND","campaign");
//$model->in("idx",array("2","4","5"),"AND","campaign");
//$model->like("subject","2","AND","campaign");
//$sql = $model->getSql("campaign");
//$data = $model->get();

//echo $sql;
?>