<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>가맹점 결제 샘플페이지</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi">
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <link href="/css/KCP_pay.css?v=<?= filemtime(FCPATH . 'css/KCP_pay.css'); ?>" rel="stylesheet" type="text/css" id="cssLink"/>

    <script type="text/javascript">
        // 주문번호 생성 예제
        function init_orderid()
        {
            var today = new Date();
            var year  = today.getFullYear();
            var month = today.getMonth()+ 1;
            var date  = today.getDate();
            var time  = today.getTime();

            if(parseInt(month) < 10)
            {
                month = "0" + month;
            }

            var vOrderID = "B2P_" + year + "" + month + "" + date + "" + time;

            document.forms[0].ordr_idxx.value = vOrderID;
        }
    </script>
</head>
<body onload="init_orderid();">
<div class="wrap">

    <form name="form_order" method="post" action="<?=base_url()?>pay/OrderPayPop" accept-charset="euc-kr" onsubmit="document.charset='euc-kr';">

        <?
        /* ============================================================================== */
        /* =   1. 주문 정보 입력                                                        = */
        /* = -------------------------------------------------------------------------- = */
        ?>
        <!-- header -->
        <div class="header">
            <a href="../index.php" class="btn-back"><span>뒤로가기</span></a>
            <h1 class="title">배치키 결제 요청</h1>
        </div>
        <!-- //header -->
        <!-- contents -->
        <div id="skipCont" class="contents">
            <p class="txt-type-1">이 페이지는 배치키로 신용카드 결제요청을 하는 페이지입니다.</p>

            <h2 class="title-type-3">주문 정보</h2>
            <ul class="list-type-1">

                <!-- 주문번호 -->
                <li>
                    <div class="left"><p class="title">주문번호</p></div>
                    <div class="right">
                        <div class="ipt-type-1 pc-wd-2">
                            <input type="text" name="ordr_idxx" value="" maxlength="40" />
                            <a href="#none" class="btn-clear"></a>
                        </div>
                    </div>
                </li>

                <!-- 상품명 -->
                <li>
                    <div class="left"><p class="title">상품명</p></div>
                    <div class="right">
                        <div class="ipt-type-1 pc-wd-2">
                            <input type="text" name="good_name" value="운동화" maxlength="40" />
                            <a href="#none" class="btn-clear"></a>
                        </div>
                    </div>
                </li>

                <!-- 결제 금액 -->
                <li>
                    <div class="left"><p class="title">결제 금액</p></div>
                    <div class="right">
                        <div class="ipt-type-1 pc-wd-2">
                            <input type="text" name="good_mny" value="1004" maxlength="9" />
                            <a href="#none" class="btn-clear"></a>
                        </div>
                    </div>
                </li>

                <!-- 주문자명 -->
                <li>
                    <div class="left"><p class="title">주문자명</p></div>
                    <div class="right">
                        <div class="ipt-type-1 pc-wd-2">
                            <input type="text" name="buyr_name" value="홍길동"  />
                            <a href="#none" class="btn-clear"></a>
                        </div>
                    </div>
                </li>

                <!-- 주문자 E-mail -->
                <li>
                    <div class="left"><p class="title">주문자 E-mail</p></div>
                    <div class="right">
                        <div class="ipt-type-1 pc-wd-2">
                            <input type="text" name="buyr_mail" value="test@test.co.kr" />
                            <a href="#none" class="btn-clear"></a>
                        </div>
                    </div>
                </li>

                <!-- 휴대폰번호 -->
                <li>
                    <div class="left"><p class="title">휴대폰번호</p></div>
                    <div class="right">
                        <div class="ipt-type-1 pc-wd-2">
                            <input type="text" name="buyr_tel2" value="010-0000-0000" />
                            <a href="#none" class="btn-clear"></a>
                        </div>
                    </div>
                </li>
            </ul>

            <!-- 정기과금 정보 -->
            <h2 class="title-type-3">정기과금 정보</h2>
            <ul class="list-type-1">

                <!-- 배치키 -->
                <li>
                    <div class="left"><p class="title">배치키</p></div>
                    <div class="right">
                        <div class="ipt-type-1 pc-wd-2">
                            <select name="bt_batch_key">

                            <?php foreach ($key_list as $row): ?>
                                <?php if($row['res_cd'] != '0000'){ continue; } ?>
                                <option value="<?=$row['batch_key']?>"><?=$row['card_name']?> | <?=$row['buyr_name']?> | <?=$row['batch_key']?></option>
                            <?php endforeach; ?>
                            </select>
                            <!--
                            <input type="text" name="bt_batch_key" value="" />
                            -->
                            <a href="#none" class="btn-clear"></a>
                        </div>
                    </div>
                </li>

                <!-- 그룹 ID -->
                <li>
                    <div class="left"><p class="title">그룹 ID</p></div>
                    <div class="right">
                        <div class="ipt-type-1 pc-wd-2">
                            <input type="text" name="bt_group_id" value="A52Q71000489" maxlength="40" />
                            <a href="#none" class="btn-clear"></a>
                        </div>
                    </div>
                </li>

            </ul>
            <div Class="Line-Type-1">
                <ul class="list-btn-2">
                    <li><input name="" type="submit" class="submit" value="결제요청"/></li>
                    <li class="pc-only-show"><a href="../index.php" class="btn-type-3 pc-wd-2">처음으로</a></li>
                </ul>
            </div>
            <!-- //contents -->

            <!-- footer -->
            <div class="grid-footer">
                <div class="inner">
                    <div class="footer">
                        ⓒ NHN KCP Corp.
                    </div>
                </div>
            </div>
            <!--//footer-->
    </form>
</div>
</body>
</html>
