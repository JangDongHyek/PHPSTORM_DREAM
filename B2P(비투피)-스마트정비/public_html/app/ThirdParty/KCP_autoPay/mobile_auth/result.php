<?
    /* ============================================================================== */
    /* =   PAGE : ���� ��� ��� PAGE                                               	= */
    /* ============================================================================== */
?>
<?
    /* ============================================================================== */
    /* =   01. ���� ���                                                            = */
    /* = -------------------------------------------------------------------------- = */
    $res_cd      = $_POST[ "res_cd"      ];                // ��� �ڵ�
    $res_msg     = $_POST[ "res_msg"     ];                // ��� �޽���
    /* = -------------------------------------------------------------------------- = */
    $ordr_idxx   = $_POST[ "ordr_idxx"   ];                // �ֹ���ȣ
    $buyr_name   = $_POST[ "buyr_name"   ];                // �ֹ��ڸ�
    $card_cd     = $_POST[ "card_cd"     ];                // ī�� �ڵ�
    $batch_key   = $_POST[ "batch_key"   ];                // ��ġŰ

    /* ============================================================================== */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>������ ���� ����������</title>

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
        <!-- Ÿ��Ʋ Start -->
		<div class="header">
			 <h1 class="title">��ġŰ �߱� ��� ���</h1>
		</div>
		<!-- Ÿ��Ʋ End -->

		<div id="skipCont" class="contents">
            <p class="txt-type-1">�� �������� ��ġŰ ����� ����ϴ� ����(����) �������Դϴ�.</p>
            <p class="txt-type-2">��û ����� ����ϴ� ������ �Դϴ�.<br />���������� ó���� ��� ����ڵ�(res_cd)���� 0000���� ǥ�õ˴ϴ�.</p>
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
                    <div class="right"><div class="ipt-type-1 pc-wd-2"><?=$res_cd?></div></div>
                </li>
                <!-- ��� �޽��� -->
                <li>
                    <div class="left"><p class="title">����޼���</p></div>
                    <div class="right"><div class="ipt-type-1 pc-wd-2"><?=$res_msg?></div></div>
                </li>
            </ul>
                    
<?
            /* ============================================================================== */
            /* =   1. ���� ������ ���� ��� ��� ( res_cd���� 0000�� ���)                  = */
            /* = -------------------------------------------------------------------------- = */
            if ( $res_cd == "0000" )
            {
?>
               <div class="line-type-1"></div>
					
					<h2 class="title-type-3">�ֹ�����</h2>
					<ul class="list-type-1">
						<!-- �ֹ���ȣ -->
						<li>
							<div class="left"><p class="title">�ֹ���ȣ</p></div>
							<div class="right"><div class="ipt-type-1 pc-wd-2"><?=$ordr_idxx?></div></div>
						</li>
					
						<!-- �ֹ��ڸ� -->
						<li>
							<div class="left"><p class="title">�ֹ��ڸ�</p></div>
							<div class="right"><?= $buyr_name ?></div>
						</li>
					</ul>
					
					<h2 class="title-type-3">���� ���� ����</h2>
					<ul class="list-type-1">
						<!-- ����ī���ڵ� -->
						<li>
							<div class="left"><p class="title">����ī���ڵ�</p></div>
							<div class="right"><div class="ipt-type-1 pc-wd-2"><?=$card_cd?></div></div>
						</li>
					
						<!-- ��ġŰ -->
						<li>
							<div class="left"><p class="title">��ġŰ</p></div>
							<div class="right"><?= $batch_key ?></div>
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