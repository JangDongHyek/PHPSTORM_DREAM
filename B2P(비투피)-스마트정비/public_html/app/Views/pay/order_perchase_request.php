<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>가맹점 결제 결과</title>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <link href="/css/KCP_pay.css?v=<?= filemtime(FCPATH . 'css/KCP_pay.css'); ?>" rel="stylesheet" type="text/css" id="cssLink"/>
</head>
<body>
<div class="wrap">
    <form name="cancel" method="post" action="<?=base_url()?>pay/OrderPerchase">
        <!-- header -->
        <div class="header">
            <h1 class="title">결과 출력</h1>
        </div>
        <!-- //header -->
        <!-- contents -->
        <div id="skipCont" class="contents">
            <!-- 정기과금 정보 -->
            <h2 class="title-type-3">매입요청 noti 정보</h2>
            <ul class="list-type-1">

                <!-- 배치키 -->
                <li>
                    <div class="left"><p class="title">노티</p></div>
                    <div class="right">
                        <div class="ipt-type-1 pc-wd-2">
                            <select name="tno">

                                <?php foreach ($vcnt_noti as $row): ?>
                                    <option value="<?=$row['tno']?>"><?=$row['ipgm_mnyx']?> | <?=$row['remitter']?> | <?=$row['account']?></option>
                                <?php endforeach; ?>
                            </select>
                            <!--
                            <input type="text" name="bt_batch_key" value="" />
                            -->
                            <a href="#none" class="btn-clear"></a>
                        </div>

                    </div>
                    <button type="submit" value="매입요청" class="btn-type-2 pc-wd-2">매입요청</button>
                </li>


            </ul>
            
            <div Class="Line-Type-1"></div>
            <ul class="list-btn-2">
                <li><a href="../index.php" class="btn-type-3 pc-wd-2">처음으로</a></li>
            </ul>
        </div>
        <!-- //contents -->
        <div class="grid-footer">
            <div class="inner">
                <!-- footer -->
                <div class="footer">
                    ⓒ NHN KCP Corp.
                </div>
                <!-- //footer -->
            </div>
        </div>
    </form>
</div>
</body>
</html>