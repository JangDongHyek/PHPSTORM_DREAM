<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');

$class_idx = $_GET['idx'];

if(empty($class_idx)){
    alert('해당 CLASS는 종료되었거나 존재하지 않습니다.');
    exit;
}

$info = getClassInfo($class_idx, $member['mb_id']);

if(empty($info)){
    alert('해당 CLASS는 종료되었거나 존재하지 않습니다.');
    exit;
}

?>

<style></style>

<section id="class">
    <ul class="tab">
        <li class="active"><a href="./event<?=$info['floor']?>.php">클래스</a></li>
        <li class=""><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$info['floor']?>fphoto">이용후기</a></li>
    </ul>


    <div class="classInfo">
        <div class="img">
            <img src="<?=$info['thumbnail']?>">
        </div>
        <div class="txt">
            <h2>
                <span><?=$info['classStatus']?></span>
                <em class="<?=$info['clsActive']?>" onclick="onClassHeart($(this), '<?=$info['class_idx']?>'); return false;">
                    <a>
                        <i class="<?=$info['clsHeart']?> fa-heart"></i>
                    </a>
                </em>
            </h2>
            <h2><?=$info['className']?></h2>
            <p><?=nl2br($info['content'])?></p>
            <h3>
                <i class="fas fa-calendar-star"></i>
                <?=replaceHyphenWithDot($info['eventDate'])?>일 <?=$info['eventTime1']?> ~ <?=$info['eventTime2']?><br>
                <i class="fas fa-user-friends"></i> 정원 <?=$info['maxPerson']?>명
            </h3>
            <h4><strong><?=number_format($info['price'])?></strong> 원</h4>
            <div class="btnWrap">
                <button type="button" class="submit" onclick="submitClass(<?=$info['class_idx']?>)">클래스 신청하기</button>
            </div>
        </div>
    </div>
    <div class="classCont">

        <nav id="contnav" class="contnav">
            <ul class="nav__menu">
                <li><a href="#one" class="nav__menu--foused">클래스 정보</a></li>
                <li><a href="#two">클래스 규정</a></li>
                <li><a href="#three">클래스 문의</a></li>
                <li><a href="#four">클래스 후기</a></li>
                <div class="marker"></div>
            </ul>
        </nav>
        <section id="one">
            <?=nl2br($info['classContent'])?>
        </section>
        <section id="two">
            <div class="cont2">
                <div></div>
                <h3>취소 / 환불 정책</h3>
                <p>환불 규정은 아래와 같이 적용됩니다.</p>
                <table class="eo_table">
                    <thead>
                        <tr>
                            <th>환불 시점</th>
                            <th>환불 방법</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>수업 7일 전까지</td>
                            <td>100% 취소 / 환불 가능</td>
                        </tr>
                        <tr>
                            <td>수업 7일 이내</td>
                            <td>환불 불가</td>
                        </tr>
                    </tbody>
                </table>
                <div class="cont2 v2">
                    <h5>※유의사항</h5>
                    <div class="info">
                        <p>취소/환불 정책인 수업 7일 전까지 100% 환불 가능하며<strong> 기간 경과 후 취소를 희망하는 경우 별도 문의 바랍니다.</strong></p>
                        <br>
                        <p>환불은 신청일로부터 최대 1~2주 가량 소요됩니다.</p>
                        <p>수강료 환불 시 반드시 결제하신 방식(카드/입금)으로만 환불 가능합니다.</p>
                        <br>
                        <p>최저 수강인원에 미달하는 경우와 그 외 불가피한 상황의 경우 강의가 취소될 수 있습니다.</p>
                        <p>이 경우 기간에 관계없이 100% 환불처리됩니다.</p>
                        <br>
                        <p><strong>문의 </strong>02-543-1529 | <i class="fab fa-instagram"></i> the_dowoon DM</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="three">
            <h5>클래스 진행에 대해 궁금한 점이 있으신가요?</h5>
            <p>문의를 남겨주시면 신속 정확하게 답변해드리겠습니다.</p>
            <button onClick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=qna'" type="button">문의하기</button>
        </section>
        <section id="four">
            <?php echo latest("theme/gallery2", "{$info['floor']}fphoto", 4, 50); ?>
        </section>
    </div>

</section>

<script>
    const marker = document.querySelector(".marker");


    async function onClassHeart($this, class_idx) {

        const onClassHeartRes = await postJson(getAjaxUrl('class'), {
            mode: 'onClassHeart',
            class_idx: class_idx,
            isUse: $this.hasClass('active') ? 'N' : 'Y'
        }, false);

        if (!onClassHeartRes.result) {
            showAlert(onClassHeartRes.msg);
            return;
        }

        let heart = "";

        $this.toggleClass('active');

        if (!$this.hasClass('active')) {
            heart = `<i class="far fa-heart"></i>`;
        } else {
            heart = `<i class="fas fa-heart"></i>`;
        }

        $this.html(heart);

        return false;
    }

    async function submitClass(class_idx) {
        const payUrl = `./event.pay.php?idx=${class_idx}`,
            checkSubmitClassRes = await postJson(getAjaxUrl('class'), {
                mode: 'checkSubmitClass',
                class_idx: class_idx
            });

        if (!checkSubmitClassRes.result) {
            showAlert(checkSubmitClassRes.msg)
                .then((result) => {
                    location.href = '<?php echo G5_URL ?>/bbs/login.php';
                });
            return;
        }

        /* 정원초과의 경우 */
        if (checkSubmitClassRes.type == 'WAIT') {
            showConfirm(checkSubmitClassRes.msg)
            .then((result) => {                
                if(!result.value) return;
                
                location.href = payUrl;
            });
            return;
        }
        
        location.href = payUrl;
    }

    //nav의 marker의 길이와 위치를 설정하는 함수
    //A function to set the length and position of the nav marker.
    function setMarker(e) {
        marker.style.left = e.offsetLeft + "px";
        marker.style.width = e.offsetWidth + "px";
    }

    const sections = document.querySelectorAll(".classCont > section");
    const menus = document.querySelectorAll(".nav__menu > li > a")

    //스크롤 위치에 따라 해당하는 menu의 색깔과 마커가 달라짐
    //The color and marker of the corresponding menu change according to the scroll position

    window.addEventListener("scroll", () => {
        //현재 영역의 id값
        //id of the current section
        let current = ""

        sections.forEach(section => {
            //각 section의 top 위치(절대적 위치)
            // The top of each section (absolute)
            const sectionTop = window.scrollY + section.getBoundingClientRect().top;

            //누적된 스크롤이 section의 top위치에 도달했거나 section의 안에 위치할 경우
            //When the accumulated scroll reaches the top of the section or is located inside the section
            if (window.scrollY >= sectionTop) {
                current = section.getAttribute("id");
            }


            menus.forEach(menu => {
                menu.classList.remove("nav__menu--foused");
                const href = menu.getAttribute("href").substring(1);
                if (href === current) {
                    //현재 있는 영역의 id와 메뉴의 링크주소가 일치할때
                    //When the Id of the current section matches the href of the menu
                    menu.classList.add("nav__menu--foused");
                    setMarker(menu);
                }
            })
        })
    })
</script>

<?php
include_once(G5_PATH.'/tail.php');
?>