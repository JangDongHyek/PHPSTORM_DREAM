<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8" />
		<title>이엘플라워</title>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;" />
		<link rel="stylesheet" type="text/css" href="../css/m_style.css" />
        <link rel="stylesheet" type="text/css" href="../css/owl.carousel.css" />
        <link rel="stylesheet" type="text/css" href="../css/owl.theme.css" />
        
        <script type="text/JavaScript" src="../js/jquery-1.7.min.js"></script>
        <script src="../js/owl.carousel.js"></script>
		<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
		<script type="text/javascript">
			document.createElement('header');
			document.createElement('nav');
			document.createElement('section');
			document.createElement('article');
			document.createElement('footer');
			
			function check_submit() {
 
				var query = document.searchForm.searchTerm.value;
 
				if(query != ''){
					document.searchForm.submit();
				} else {
					alert("검색어를 입력하세요");
					document.searchForm.searchTerm.focus(); 
					return;
				}	
			}			
		</script>
	</head>
	<body>
<link rel="stylesheet" type="text/css" href="../../market/css/font-awesome.min.css">
<script src="../js/jquery.scrollbox.js"></script><!--전후롤링-->
<script>
document.title = "이엘플라워";
</script>
	<script type="text/javascript">
	//<[CDATA[
		var currentMenuId = '';
		
		function showSubMenu(menuId) {
			
			if(currentMenuId != "") {
				$(".iconSet"+currentMenuId+" .subCategory").toggle();
				if($(".iconSet"+currentMenuId+" .toggleBullet").is(".btnOn")) {
					$(".iconSet"+currentMenuId+" .toggleBullet").removeClass("btnOn").addClass("btnOut");
				}
			}
			
			if(currentMenuId != menuId) {
				$(".iconSet"+menuId+" .subCategory").slideDown();
				$(".iconSet"+menuId+" .toggleBullet").removeClass("btnOut").addClass("btnOn");
				currentMenuId = menuId;
			} else {
				currentMenuId = "";
			}
		}
	//]]>

//상단배너
function tbnView(){
	document.getElementById("bnImg").style.display="inline";
	document.getElementById("tbn1").style.display="none";
	document.getElementById("tbn2").style.display="block";
}
function tbnHidden(){
	document.getElementById("bnImg").style.display="none";
	document.getElementById("tbn1").style.display="block";
	document.getElementById("tbn2").style.display="none";
}
    </script>

<div id="top_bn">
    <div id="bnImg">
      <!--<a href="https://open.kakao.com/o/sbrddZJ" target="_blank"><img src="../../market/images2/top_bn01.jpg" alt="" border="0"></a>
      <img src="../../market/images2/top_bn02.jpg" alt="" border="0">
      <img src="../../market/images2/top_bn03.jpg" alt="" border="0">
      <a href="../main/product_list.html?&flag=&category_num=54"><img src="../../market/images2/top_bn04.jpg" alt="" border="0"></a> -->
      <a href=""><img src="../../market/images2/top_bn05.jpg" alt="" border="0"></a>
      <a href="../main/join.html"><img src="../../market/images2/top_bn06.jpg" alt="" border="0"></a>
</div>
    <div class="btn">
        <span id="tbn1" onclick="tbnView()" style="display:none">EVENT OPEN</span>
        <span id="tbn2" onclick="tbnHidden()">CLOSE</span>
    </div>
</div>

<header>
     <div id="top">
          <h1 id="logo"><a href="../main/"><img src="../../market/images2/logo.png" /></a></h1>
          <!--<div class="home"><a href="../main/"><img src="../images/home.png"  border="0" /></a></div> -->
          <!--<div class="phone"><a href="tel:0512663607"><img src="../images/phone.png" border="0" /></a></div> -->
          <div class="my"><a href="../main/mypage.html"><img src="../images/my.png" border="0" /></a></div>
          <div class="cate"><a href="javascript:menuView()" id="allmenu"><img src="../images/cate.png" border="0" /></a></div>
     </div>
		   <div class="topSearch">
				<form name="searchForm" method="post" action='../main/search.html' onsubmit="check_submit(); return false;">
				<input type='hidden' name='select_key' value='item_name'>
				<input type='hidden' name='mode' value='search'>
				<input type="text" name="searchTerm" /> <input type="submit" class="smit" value="검색"/></form>
		   </div> 
			<nav id="nav">
				<div class="menu">
		            <!--<dl>
		              	<dd><a href="javascript:alert('준비중입니다');">회사소개</a></dd>
			            <dd><a href="../main/category.html">제품소개</a></dd>
						<dd><a href="../board/board.html">커뮤니티</a></dd>
			            <dd style="border:0px;"><a href="../main/mypage.html">마이페이지</a></dd>
                   </dl> -->
                   <!--카테고리시작-->
                <dl class="iconSetCategory">
                <!--<ul> -->
                


					<dd class="iconSet1">
											<a href="../main/product_list.html?category_num=39">꽃바구니</a>
					
					</dd>
                    
				


					<dd class="iconSet2">
											<a href="../main/product_list.html?category_num=38">꽃다발</a>
					
					</dd>
                    
				


					<dd class="iconSet3">
											<a href="../main/product_list.html?category_num=37">꽃상자</a>
					
					</dd>
                    
				


					<dd class="iconSet4">
											<a href="../main/product_list.html?category_num=36">화분/식물</a>
					
					</dd>
                    
				


					<dd class="iconSet5">
											<a href="../main/product_list.html?category_num=35">축하화환</a>
					
					</dd>
                    
				


					<dd class="iconSet6">
											<a href="../main/product_list.html?category_num=34">근조화환</a>
					
					</dd>
                    
				


					<dd class="iconSet7">
											<a href="../main/product_list.html?category_num=33">동양란</a>
					
					</dd>
                    
				


					<dd class="iconSet8">
											<a href="../main/product_list.html?category_num=31">분재</a>
					
					</dd>
                    
				


					<dd class="iconSet9">
											<a href="../main/product_list.html?category_num=32">서양란</a>
					
					</dd>
                    
								</dl>

                   <!--카테고리끝-->
				</div>
                <div class="icon"><!--<img src="../images/more_icon.png"> -->
                    <span class="open"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                    <span class="close"><i class="fa fa-chevron-up" aria-hidden="true"></i></span>
                </div>
			</nav>
			<script>
                    $("#nav .icon .open").click(function(){
                        $("#nav .menu").addClass("over");
                        $("#nav .icon").addClass("over");
                    });
                    $("#nav .icon .close").click(function(){
                        $("#nav .menu").removeClass("over");
                        $("#nav .icon").removeClass("over");
                    });
            </script>
            <div class="cate2wrap">
                <div id="cate2ul">
                    <a href="../main/product_list.html?&flag=&category_num=59">장미100송이</a>
                    <a href="../main/product_list.html?&flag=&category_num=58">비누꽃</a>
                    <a href="../main/product_list.html?&flag=&category_num=57">쌀화환</a>
                    <a href="../main/product_list.html?&flag=&category_num=56">최저가</a>
                    <a href="../main/product_list.html?&flag=&category_num=55">프리미엄</a>
                    <a href="../main/product_list.html?&flag=&category_num=54">김영란꽃</a>
                    <a href="../main/product_list.html?&flag=&category_num=53">대량주문</a>
                    <a href="../main/product_list.html?&flag=&category_num=52">코사지</a>
                    <a href="../main/product_list.html?&flag=&category_num=51">사방화</a>
                </div>
            </div>
		</header>
        
		<script language="javascript">
		/*애니메이션 메뉴*/
	     function menuView(){
		//var FullScreenWidth=$(window).width();
		//if(FullScreenWidth>450){
		//$("#cate").css("width","450");
		//}
		$("#cate").animate({"left":"0%"},"fast");
		//$("#cate").css("top",$(window).scrollTop());
		$("#cate").css("height","100%");
		$("#left_menu").css("height","100%");
		$("#lay").css("opacity","0.7");
		$("#lay").css("display","block");
		//$("#wrap").css({overflow:'hidden',position:'fixed'})
		//$("#wrap").css({overflow:'hidden'}).bind('touchmove', function(e){e.preventDefault()}); 
		//팝업 애니메이션 시 스크롤을 막음 (활성화 시)
    	}
	    function menuClose(){
		$("#cate").animate({"left":"-90%"},"fast");
		$("#lay").css("display","none");
		//$("#wrap").css({overflow:'scroll',position:'relative'})
		//$("#wrap").unbind('touchmove');
	   }

       </script>


       <div id="cate" style="position:absolute;left:-100%;width:70%;z-index:10; height:100%; top:0; background:#414141; position:fixed;">
                    <div id="left_menu">
       <div class="close"><a href="javascript:menuClose()"><img src="../images/btn_close.png" /></a></div>
       <div class="title"><img src="../images/all_menu.png" /> 이엘플라워</div>
        <!--메뉴시작-->
        <section id="content">
            <article id="sublist">
            	<div id="tnb">
                	<ul>
                    	<li>
                        <a href='../main/login.html'>로그인<i class='fa fa-sign-in'></i></a>                        </li>
                    	<li><a href="../cart/cart.html">장바구니<i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                    	<li><a href="../main/mypage.html">주문내역<i class="fa fa-file-text-o" aria-hidden="true"></i></a></li>
                    	<li>
							<a href="../main/mypoint.php">적립금 <span <span style="color:red;font-weight:bold">0</span>P<i class="fa fa-money" aria-hidden="true"></i></a>
						</li>
                    </ul>
                </div>
                 
                <div id="lnb">
                	<ul>
                    	<li><a href="../main/recomm.htm" class="modal" onclick="sharedInfo('[이엘플라워] 친구추천','http://www.elflower.co.kr')">친구추천</a></li>
                    	<li><a href="">모바일쿠폰</a></li>
                    	<li><a href="">이용약관</a></li>
                        <li><a href="../board/board_list.html?bbs_no=1">공지사항</a></li>
						<li><a href="../board/board_list.html?bbs_no=14">배송갤러리</a>
						                    </ul>
                </div>
			</article>
		</section>
       <!--메뉴끝-->
       </div>
       <a href="javascript:menuClose()"><div id="lay"></div></a>
             </div>
       <div id="lay"></div>

        <div id="glayLayer"></div>
        <div id="overLayer">
        	<div class="title">공유하기</div>
             <ul>
            	<li><a href="javascript:;" onclick="toSNS('naver','[이엘플라워] 친구추천','http://www.elflower.co.kr')"><img src="../images/sns/sns01.png" alt="네이버"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('band','[이엘플라워] 친구추천','http://www.elflower.co.kr')"><img src="../images/sns/sns02.png" alt="밴드"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('line','[이엘플라워] 친구추천','http://www.elflower.co.kr')"><img src="../images/sns/sns03.png" alt="라인"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('kakaostory','[이엘플라워] 친구추천','http://www.elflower.co.kr')"><img src="../images/sns/sns04.png" alt="카카오스토리"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('twitter','[이엘플라워] 친구추천','http://www.elflower.co.kr')"><img src="../images/sns/sns05.png" alt="트위터"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('facebook','[이엘플라워] 친구추천','http://www.elflower.co.kr')"><img src="../images/sns/sns06.png" alt="페이스북"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('google','[이엘플라워] 친구추천','http://www.elflower.co.kr')"><img src="../images/sns/sns07.png" alt="구글+"></a></li>
            	<li><a href="javascript:;"><img src="../images/sns/sns08.png" alt="카카오스토리"></a></li>
            </ul>
        </div>
		<div id="overLayer">
        	<div class="title">공유하기</div>
             <ul>
            	<li><a href="javascript:;" onclick="toSNS('naver')"><img src="../images/sns/sns01.png" alt="네이버"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('band')"><img src="../images/sns/sns02.png" alt="밴드"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('line')"><img src="../images/sns/sns03.png" alt="라인"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('kakaostory')"><img src="../images/sns/sns04.png" alt="카카오스토리"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('twitter')"><img src="../images/sns/sns05.png" alt="트위터"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('facebook')"><img src="../images/sns/sns06.png" alt="페이스북"></a></li>
            	<li><a href="javascript:;" onclick="toSNS('google')"><img src="../images/sns/sns07.png" alt="구글+"></a></li>
            	<li><a id="kakao-link-btn" href="javascript:;"><img src="//developers.kakao.com/assets/img/about/logos/kakaolink/kakaolink_btn_medium.png"/></a></li>
            </ul>
        </div>
		
        <script type="text/javascript">
        $(function(){
            //$("body").append("<div id='glayLayer'></div><div id='overLayer'></div>")
            $("#glayLayer, #overLayer").hide();
            $("#glayLayer").click(function(){
                $(this).hide();
                $("#overLayer").hide();	
            })
            $("a.modal").click(function(){
                //그레이레이어 보이기
                $("#glayLayer").show();
                $("#overLayer").show()
                return false;
                //$(this).attr("href")	
            })
        });
		var sharedTitle="";
		var sharedUrl="";
		function sharedInfo(title,url){
			sharedTitle=title;
			sharedUrl=url;
		}
		//sns공유
		function toSNS(sns) { 
			var snsArray = new Array(); 
			var image = "이미지경로"; 
			snsArray['twitter'] = "http://twitter.com/home?status=" + encodeURIComponent(sharedTitle) + ' ' + encodeURIComponent(sharedUrl); 
			snsArray['facebook'] = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(sharedUrl)+"&t="+encodeURIComponent(sharedTitle); 
			snsArray['band'] = "http://band.us/plugin/share?body=" + encodeURIComponent(sharedTitle) + "  " + encodeURIComponent(sharedUrl) + "&route=" + encodeURIComponent(sharedUrl); 
			snsArray['blog'] = "http://blog.naver.com/openapi/share?url=" + encodeURIComponent(sharedUrl) + "&title=" + encodeURIComponent(sharedTitle); 
			snsArray['line'] = "http://line.me/R/msg/text/?" + encodeURIComponent(sharedTitle) + " " + encodeURIComponent(sharedUrl); 
			snsArray['naver'] = "http://share.naver.com/web/shareView.nhn?url="+encodeURIComponent(sharedUrl)+"&title=" + encodeURIComponent(sharedTitle); 
			snsArray['kakaostory'] = "https://story.kakao.com/s/share?url="+encodeURIComponent(sharedUrl)+"&amp;text="+encodeURIComponent(sharedTitle); 
			snsArray['google'] = "https://plus.google.com/share?url=" + encodeURIComponent(sharedUrl) + "&t=" + encodeURIComponent(sharedTitle); 
			window.open(snsArray[sns]); 
		} 
		
        </script>
		<script type='text/javascript'>
  //<![CDATA[
    // // 사용할 앱의 JavaScript 키를 설정해 주세요.
    Kakao.init('aee322cb87cf618d04fdaa0c5169b5ac');
    // // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
    Kakao.Link.createDefaultButton({
      container: '#kakao-link-btn',
      objectType: 'feed',
      content: {
        title: '딸기 치즈 케익',
        description: '#케익 #딸기 #삼평동 #카페 #분위기 #소개팅',
        imageUrl: 'http://mud-kage.kakao.co.kr/dn/Q2iNx/btqgeRgV54P/VLdBs9cvyn8BJXB3o7N8UK/kakaolink40_original.png',
        link: {
          mobileWebUrl: 'https://developers.kakao.com',
          webUrl: 'https://developers.kakao.com'
        }
      },
      social: {
        likeCount: 286,
        commentCount: 45,
        sharedCount: 845
      },
      buttons: [
        {
          title: '웹으로 보기',
          link: {
            mobileWebUrl: 'https://developers.kakao.com',
            webUrl: 'https://developers.kakao.com'
          }
        },
        {
          title: '앱으로 보기',
          link: {
            mobileWebUrl: 'https://developers.kakao.com',
            webUrl: 'https://developers.kakao.com'
          }
        }
      ]
    });
  //]]>
</script>







<section id="content">	


<div class="m_rolling_banner">
          
                <div id="owl-demo" class="owl-carousel">
				                <div class="item">
					<a href="../main/product_list.html?category_num=46">
					<img src="../../up/elfower/201804280156041.jpg" alt="" border="0">
					</a>
				</div>
				                <div class="item">
					<a href="../main/product_list.html?category_num=46">
					<img src="../../up/elfower/201804280156042.jpg" alt="" border="0">
					</a>
				</div>
				                <div class="item">
					<a href="../main/product_list.html?category_num=46">
					<img src="../../up/elfower/201804280156043.jpg" alt="" border="0">
					</a>
				</div>
				                <div class="item">
					<a href="../main/product_list.html?category_num=46">
					<img src="../../up/elfower/201804280156044.jpg" alt="" border="0">
					</a>
				</div>
								
				               <!-- <div class="item"><img class="lazyOwl" data-src="images/m_rolling_banner_01.jpg"></div>
                <div class="item"><img class="lazyOwl" data-src="images/m_rolling_banner_02.jpg"></div>
                <div class="item"><img class="lazyOwl" data-src="images/m_rolling_banner_03.jpg"></div>-->

              </div>
              <!-- rolling -->   
     <script>
     $(document).ready(function() {
 
     $("#owl-demo").owlCarousel({
		 
	  autoPlay : 3000,
	  navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem : true,
		 
		 
		  //autoPlay : 5000,
          //items : 1,
          //lazyLoad : true,
          //navigation : true

      });
    });
    </script>
          
</div>
 
<!--제품배너-->
        <section class="infomation cf">
        	<ul>
            	<li class="w7"><a href="../main/product_list.html?&flag=&category_num=38">꽃다발</a></li>
            	<li class="w3"><a href="../main/product_list.html?&flag=&category_num=39">꽃바구니</a></li>
                <li class="w33"><a href="../main/product_list.html?&flag=&category_num=36">화분/식물</a></li>
                <li class="w33"><a href="../main/product_list.html?&flag=&category_num=35">축하화환</a></li>
                <li class="w33"><a href="../main/product_list.html?&flag=&category_num=34">근조화환</a></li>
                <li class="w5"><a href="../main/product_list.html?&flag=&category_num=32">서양란</a></li>
                <li class="w5"><a href="../main/product_list.html?&flag=&category_num=33">동양란</a></li>
                <li class="w3"><a href="../main/product_list.html?&flag=&category_num=31">분재</a></li>
                <li class="w7"><a href="../main/product_list.html?&flag=&category_num=37">꽃상자</a></li>
            	<li class="w7"><a href="../main/product_list.html?&flag=&category_num=52">코사지</a></li>
            	<li class="w3"><a href="../main/product_list.html?&flag=&category_num=51">사방화</a></li>
            </ul>
        </section><!--infomation-->
<div><img src="../images/img_business_05.jpg" border="0" style="width:100%"></div>


<!--동글배너-->


    <div id="m_cus">
    	<ul>
        	<li>
            	<div class="c_title"><img src="../images/cus_icon01.png"><p>고객센터</p></div>
                <p>051.891.0088</p>
                <h3><span>평일&nbsp;&nbsp;&nbsp;</span> 오전 09:00~18:00<br><span>토요일&nbsp;&nbsp;&nbsp;</span>09:00~13:00(일요일/공휴일 휴무)</h3>
            </li>
            <li>
            	<div class="c_title"><img src="../images/cus_icon02.png"><p style="padding-top:7px;">입금계좌</p></div>
            	<p class="con">123-45-678910</p>
                <h3><span>입금은행&nbsp;&nbsp;&nbsp;</span> 신한은행<br>
                <span>예금주&nbsp;&nbsp;&nbsp;</span>홍길동</h3>
            </li>
        </ul>
    </div><!--m_cus-->


<!--div class="intro_icon mt5">
				 <dl>
		     	<dd><a href=""><img src="../images/m_icon_01.png"></a></dd>
			    <dd><a href=""><img src="../images/m_icon_02.png"></a></dd>
			    <dd><a href=""><img src="../images/m_icon_03.png"></a></dd>
			    <dd><a href=""><img src="../images/m_icon_04.png"></a></dd
		     </dl>
</div-->



<!--
<div class="intro_icon mt10">
				 <dl>
		     	<dd><a href=""><img src="../images/m_icon_01.png"></a></dd>
			    <dd><a href=""><img src="../images/m_icon_02.png"></a></dd>
			    <dd><a href=""><img src="../images/m_icon_03.png"></a></dd>
			    <dd><a href=""><img src="../images/m_icon_04.png"></a></dd>
		     </dl>
</div>-->


<!--<article style="width:95%">
                <h3 style="text-align:center; padding-top:40px;"><img src="../images/best.gif" style="width:40%"></h3>
                <ul class="specialList" style="text-align:center; padding-left:2%">
				<br>




                    <li >
                        <div><a href='../main/product_info.html?mart_id=elfower&category_num=32&category_num1=0&category_num2=&cate_num=32&item_no=188' target='_parent'><img src='../../co_img/elfower/188_1_b1_20180421210505.jpg130.jpg' width=100 height=100 class=img></a></div>
                        <div class="txt">금나비 서양란</div>
                        <div class="price">152,100 원</div>

						                    </li>









                    <li >
                        <div><a href='../main/product_info.html?mart_id=elfower&category_num=32&category_num1=0&category_num2=&cate_num=32&item_no=189' target='_parent'><img src='../../co_img/elfower/189_1_b1_20180421210646.jpg130.jpg' width=100 height=100 class=img></a></div>
                        <div class="txt">노란 호접란 B113</div>
                        <div class="price">145,300 원</div>

						                    </li>









                    <li >
                        <div><a href='../main/product_info.html?mart_id=elfower&category_num=32&category_num1=0&category_num2=&cate_num=32&item_no=191' target='_parent'><img src='../../co_img/elfower/191_1_b1_20180421211239.jpg130.jpg' width=100 height=100 class=img></a></div>
                        <div class="txt">노랑 심비디움 K04 (겨</div>
                        <div class="price">123,500 원</div>

						                    </li>




				</ul>
</article>-->


<article id="mainNotice">
                <h3><span class="ic"></span>공지사항</h3>

				 											                <ul>
                    <li>등록된 공지사항이 없습니다.</li>
                </ul>
																						
</article>

</section>


        <div id="m_data">
    	<h3><img src="../images/dong_title.png" style="width:40%"></h3>
        <ul>
            <li><a href="tel:0512663607"><p class="icon"><i class="fa fa-phone" aria-hidden="true"></i></p><span>전화문의</span></a></li>
        	<li><a href="https://open.kakao.com/o/sbrddZJ" target="_blank"><p class="icon"><img src="../images/kakao.png" style="width:60%;  margin:15px auto;"></p><span>카톡상담</span></a></li>
            <li><a href="../main/"><p class="icon"><i class="fa fa-th-list" aria-hidden="true"></i></p><span>제품리스트</span></a></li> 
            <li><a href="../main/mypoint.php"><p class="icon"><i class="fa fa-file-text" aria-hidden="true"></i></p><span>포인트몰</span></a></li>
            
            <!--<li><a href="../board/board_list.html?bbs_no=4"><p class="icon"><i class="fa fa-comments-o" aria-hidden="true"></i></p><span>온라인상담</span></a></li>
            <li><a href="../board/board_list.html?bbs_no=2"><p class="icon"><i class="fa fa-file-text" aria-hidden="true"></i></p><span>이용안내</span></a></li>-->
        </ul>
    </div><!--m_data--> 


<footer id="footer">
    <div class="f_menu">
                <a href="../board/board_list.html?bbs_no=1">고객센터</a>
                <a href="../board/board_list.html?bbs_no=11">상품후기</a>
                <a href="../board/board_list.html?bbs_no=6">상품문의</a>
                <a href="../../market/main/" target="_blank">PC버전</a>
</div>
			<div class="copy">
            이엘플라워&nbsp;&nbsp;&nbsp;&nbsp;
            주소 : 부산시 해운대구 센텀북대로 60(재송동, 센텀아이에스타워) 707호&nbsp;&nbsp;&nbsp;&nbsp;
            사업자등록번호 : 605-18-89014&nbsp;&nbsp;&nbsp;&nbsp;
            대표이사 : 서미애<br />
            제작관련전문상담 : 051-891-0087&nbsp;&nbsp;&nbsp;&nbsp;
            문의전화 : 051-891-0088&nbsp;&nbsp;&nbsp;&nbsp;
            FAX : 051-893-2088&nbsp;&nbsp;&nbsp;&nbsp;
            E-mail : itforyou@hanmail.net<br />
			<div class="copyright">COPYRIGHT(C) 2017. <span class="point">ELFLOWER</span> ALL RIGHTS RESERVED.</div>
</div>
		</footer>
        
        
 	</body>
</html>
