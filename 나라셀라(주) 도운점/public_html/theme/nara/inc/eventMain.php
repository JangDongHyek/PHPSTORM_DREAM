<?
    $page = empty($_GET['page'])? 1 : (int)$_GET['page'];
    $offSet = 6;
    $limit = ($page - 1) * $pagingCount;
        

    $status = empty($_GET['status'])? '' : $_GET['status'];
    $sort = empty($_GET['sort'])? 'C.regDate' : $_GET['sort'];
        
    $list = array();

    $sqlSearch = "";
    switch($status){
        case 'I': $sqlSearch = "C.eventDateTime > '{$DATE_HI}' AND "; break;
        case 'F': $sqlSearch = "C.eventDateTime < '{$DATE_HI}' AND "; break;
    }

    $sql = "
        SELECT
            C.*,
            IF(H.heart_idx IS NULL, '', 'active') AS clsActive,
            IF(H.heart_idx IS NULL, 'far', 'fas') AS clsHeart
        FROM
            class_list AS C LEFT JOIN
            heart_list AS H ON H.class_idx = C.class_idx AND H.mb_id = '{$member['mb_id']}' AND H.isUse = 'Y'
        WHERE
            C.floor = '{$floor}' AND
            $sqlSearch
            C.isUse = 'Y'
        ORDER BY
            $sort DESC
        -- LIMIT
            -- $limit, $offSet;
    ";
    
    $classRes = sql_query($sql);

    //echo $sql;
        
    for($i = 0; $info = sql_fetch_array($classRes); $i++){
        
        $row = sortClassInfo($info);
        $list[] = $row;
    }
?>

<form id="eventSearch" method="get">
    <div class="selectBox">
        <p>구분</p>
        <select name="status" onChange="formEventSearch()">
            <option value="">전체</option>
            <? foreach(CLASS_STATUS as $key=>$name){ ?>
            <option value="<?=$key?>" <?=$status == $key? 'selected' : ''?>><?=$name?></option>
            <? } ?>
        </select>
        <select name="sort" onChange="formEventSearch()">
            <? 
                $sortSch = [
                    'C.regDate' => '등록순',
                    'C.eventDateTime' => '클래스 날짜순'
                ];
            ?>
            <? foreach($sortSch as $key=>$name){ ?>
            <option value="<?=$key?>" <?=$sort == $key? 'selected' : ''?>><?=$name?></option>
            <? } ?>
        </select>
    </div>
</form>

<? if(!count($list)){ ?>
    <p style="text-align: center; " align="center"><span style="font-size: 18pt;">CLASS 내역이 존재하지 않습니다.</span></p>
<? }else{ ?>
<div class="classBox">

    <? foreach($list as $key => $data){
        //테스트중
        if($data['class_idx'] == 12 && $_SERVER['REMOTE_ADDR'] != '121.140.204.65'){
            continue;
        }
    ?>

    <div class="classItem <?=$data['clsClassStatus']?>">
        <a href="./event.view.php?idx=<?=$data['class_idx']?>" class="nextLink" data-status="<?=$data['classStatus']?>">
            <div class="img">
                <img src="<?=$data['thumbnail']?>">
                <h6 class="<?=$data['clsActive']?>" onclick="onClassHeart($(this), '<?=$data['class_idx']?>'); return false;">
                    <i class="<?=$data['clsHeart']?> fa-heart"></i>
                </h6>
            </div>
            <div class="txt">
                <h2><span><?=$data['classStatus']?></span><?=$data['className']?></h2>
                <h3><i class="fas fa-calendar-star"></i> <?=replaceHyphenWithDot($data['eventDate'])?> <br class="visible-xs"> <?=$data['eventTime1']?> ~ <?=$data['eventTime2']?><span class="hidden-xs"> | </span><span class="visible-xs"><br></span><i class="fas fa-user-friends"></i> 정원 <?=$data['maxPerson']?>명</h3>
                <h4><strong><?=number_format($data['price'])?></strong> 원</h4>
            </div>
        </a>
    </div>
    <? } ?>
</div>

<? } ?>



<script>
        
    function formEventSearch(){
        $('#eventSearch').submit();
    }
    
    async function onClassHeart($this, class_idx) {
        
        const onClassHeartRes = await postJson(getAjaxUrl('class'), {
            mode : 'onClassHeart',            
            class_idx : class_idx,
            isUse : $this.hasClass('active')? 'N' : 'Y'
        }, false);

        if(!onClassHeartRes.result){
            showAlert(onClassHeartRes.msg);
            return;
        }
        
        let heart = "";                
        
        $this.toggleClass('active');
        
        if (!$this.hasClass('active')) {
            heart = `<i class="far fa-heart"></i>`;
        }else{
            heart = `<i class="fas fa-heart"></i>`;                        
        }
        
        $this.html(heart);
        
        return false;
    }
    
    $(function(){
        
        $('.nextLink').on('click', function(){
            let status = $(this).data('status');
            
            switch(status){
                case '종료':
                    Swal.fire({
                        toast: true,
                        icon: 'warning',
                        title: '해당 클래스는 종료됐어요!',
                        animation: false,
                        position: 'middle',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    return false;
                break;
            }
        });
    });
    
</script>