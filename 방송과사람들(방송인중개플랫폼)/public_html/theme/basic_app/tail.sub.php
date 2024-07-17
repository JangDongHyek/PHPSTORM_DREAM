<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 로딩중 -->
<style>
#loader_wrap {display: none; position: fixed; top: 0; left: 0; bottom: 0; width: 100%; height: 100%; padding-top: 50%; padding-top: 50%;    margin-top: -25%;}
.spinner {width: 40px;height: 40px;background-color: #2e76e5; margin: 100px auto;-webkit-animation: sk-rotateplane 1.2s infinite ease-in-out;animation: sk-rotateplane 1.2s infinite ease-in-out;}
@-webkit-keyframes sk-rotateplane {
  0% { -webkit-transform: perspective(120px) }
  50% { -webkit-transform: perspective(120px) rotateY(180deg) }
  100% { -webkit-transform: perspective(120px) rotateY(180deg)  rotateX(180deg) }
}
@keyframes sk-rotateplane {
  0% { 
    transform: perspective(120px) rotateX(0deg) rotateY(0deg);
    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg) 
  } 50% { 
    transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg) 
  } 100% { 
    transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
  }
}
</style>
<div id="loader_wrap"><div class="spinner"></div></div>

</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>