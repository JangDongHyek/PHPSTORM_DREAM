<?
    /* ============================================================================== */
    /* =   PAGE : ���� ��� ��� PAGE                                               	= */
    /* ============================================================================== */
?>
<?
    /* ============================================================================== */
    /* =   ���� ���                                                                = */
    /* = -------------------------------------------------------------------------- = */
    $res_cd           = $_POST[ "res_cd"       ];      // ��� �ڵ�
    $res_msg          = $_POST[ "res_msg"      ];      // ��� �޽���
    $amount           = $_POST[ "amount"       ];      // �ѱݾ�
    /* = -------------------------------------------------------------------------- = */
    $ordr_idxx        = $_POST[ "ordr_idxx"    ];      // �ֹ���ȣ
    $tno              = $_POST[ "tno"          ];      // NHN KCP �ŷ���ȣ
    $good_mny         = $_POST[ "good_mny"     ];      // ���� �ݾ�
    $good_name        = $_POST[ "good_name"    ];      // ��ǰ��
    $buyr_name        = $_POST[ "buyr_name"    ];      // �����ڸ�
    $buyr_tel2        = $_POST[ "buyr_tel2"    ];      // ������ �޴�����ȣ
    $buyr_mail        = $_POST[ "buyr_mail"    ];      // ������ E-Mail
    /* = -------------------------------------------------------------------------- = */
    $card_cd          = $_POST[ "card_cd"      ];      // ī�� �ڵ�
    $card_no          = $_POST[ "card_no"      ];      // ī�� ��ȣ
    $card_name        = $_POST[ "card_name"    ];      // ī���
    $app_time         = $_POST[ "app_time"     ];      // ���νð�
    $app_no           = $_POST[ "app_no"       ];      // ���ι�ȣ
    $quota            = $_POST[ "quota"        ];      // �Һΰ���
    /* = -------------------------------------------------------------------------- = */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>������ ���� ��� ����������</title>
  
  <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
  <meta http-equiv="Pragma" content="no-cache"> 
  <meta http-equiv="Expires" content="-1">
  <link href="../static/css/style.css" rel="stylesheet" type="text/css" id="cssLink"/>
</head>
<body>
<div class="wrap">
    <form name="cancel" method="post">
    <!-- header -->
        <div class="header">
            <a href="../index.html" class="btn-back"><span>�ڷΰ���</span></a>
            <h1 class="title">��� ���</h1>
        </div>
        <!-- //header -->
        <!-- contents -->
        <div id="skipCont" class="contents">
            <p class="txt-type-1">�� �������� ���� ����� ����ϴ� ����(����) �������Դϴ�.</p>
            <p class="txt-type-2">��û ����� ����ϴ� ������ �Դϴ�.<br />��û�� ���������� ó���� ��� ����ڵ�(res_cd)���� 0000���� ǥ�õ˴ϴ�.</p>
            <h2 class="title-type-3">ó�����</h2>
<?
    /* ============================================================================== */
    /* =   ���� ��� �ڵ� �� �޽��� ���(����������� �ݵ�� ������ֽñ� �ٶ��ϴ�.)= */
    /* = -------------------------------------------------------------------------- = */
    /* =   ���� ���� : res_cd���� 0000���� �����˴ϴ�.                              = */
    /* =   ���� ���� : res_cd���� 0000�̿��� ������ �����˴ϴ�.                     = */
    /* = -------------------------------------------------------------------------- = */
?>
          <ul class="list-type-1">
                <!-- ��� �ڵ� -->
                <li>
                    <div class="left"><p class="title">����ڵ�</p></div>
                    <div class="right"><div class="ipt-type-1 pc-wd-2"><?= $res_cd ?></div></div>
                </li>
                <!-- ��� �޽��� -->
                <li>
                    <div class="left"><p class="title">����޼���</p></div>
                    <div class="right"><div class="ipt-type-1 pc-wd-2"><?= $res_msg ?></div></div>
                </li>
            </ul>

<?
			/* ============================================================================== */
            /* =   ���� ������ ���� ��� ���� ��� ( res_cd���� 0000�� ���)                  = */
            /* = -------------------------------------------------------------------------- = */
            if ( $res_cd == "0000" )                  // ���� ����
            {
?>
                <div class="line-type-1"></div>
					<!-- �ֹ����� -->
					<h2 class="title-type-3">�ֹ�����</h2>
					<ul class="list-type-1">
						<!-- �ֹ���ȣ -->
						<li>
							<div class="left"><p class="title">�ֹ���ȣ</p></div>
							<div class="right"><div class="ipt-type-1 pc-wd-2"><?=$ordr_idxx?></div></div>
						</li>
						<!-- KCP �ŷ���ȣ -->
						<li>
							<div class="left"><p class="title">KCP �ŷ���ȣ</p></div>
							<div class="right"><div class="ipt-type-1 pc-wd-2"><?=$tno?></div></div>
						</li>
						<!-- ��ǰ�� -->
						<li>
							<div class="left"><p class="title">��ǰ��</p></div>
							<div class="right"><?=$good_name?></div>
						</li>
						<!-- �����ݾ� -->
						<li>
							<div class="left"><p class="title">�����ݾ�</p></div>
							<div class="right"><?= $amount ?>��</div>
						</li>
						<!-- �ֹ��ڸ�(buyr_name) -->
						<li>
							<div class="left"><p class="title">�ֹ��ڸ�</p></div>
							<div class="right"><?= $buyr_name ?></div>
						</li>
						<!-- �޴�����ȣ(buyr_tel2) -->
						<li>
							<div class="left"><p class="title">�޴�����ȣ</p></div>
							<div class="right"><?= $buyr_tel2 ?></div>
						</li>
						<!-- �ֹ��� E-mail(buyr_mail) -->
						<li>
							<div class="left"><p class="title">E-mail</p></div>
							<div class="right"><?= $buyr_mail ?></div>
						</li>
					</ul>
				<div class="line-type-1"></div>
				<h2 class="title-type-3">�ſ�ī�� ����</h2>
					
					<ul class="list-type-1">
						<!-- ���� ī�� -->
						<li>
							<div class="left"><p class="title">���� ī��</p></div>
							<div class="right"><?=$card_cd ?> / <?=$card_name ?></div>
						</li>
						<!-- ���� �ð� -->
						<li>
							<div class="left"><p class="title">���� �ð�</p></div>
							<div class="right"><?=$app_time?></div>
						</li>
						<!-- ���� ��ȣ -->
						<li>
							<div class="left"><p class="title">���� ��ȣ</p></div>
							<div class="right"><?=$app_no?></div>
						</li>
						<!-- �Һ� ���� -->
						<li>
							<div class="left"><p class="title">�Һ� ����</p></div>
							<div class="right"><?=$quota ?></div>
						</li>
					</ul>
                <div class="line-type-1"></div>
<?
                    }
?>
        <div Class="Line-Type-1"></div>
            <ul class="list-btn-2">
                <li><a href="../index.html" class="btn-type-3 pc-wd-2">ó������</a></li>
            </ul>
        </div>
        <!-- //contents -->
        <div class="grid-footer">
            <div class="inner">
                <!-- footer -->
                <div class="footer">
                    �� NHN KCP Corp.
                </div>
                <!-- //footer -->
            </div>
        </div>
    </form>
</div>  
</body>
</html>