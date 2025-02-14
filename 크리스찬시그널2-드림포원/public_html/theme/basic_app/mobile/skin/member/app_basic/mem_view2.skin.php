<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>


<!--회원상세페이지(인터뷰)-->
<div id="mem_view">
	<!--상단카테고리-->
    <ul class="cate cf">
        <li><a href="javascript:void(0);" onclick="location.replace('<?php echo G5_BBS_URL ?>/mem_view.php?mb_no=<?=$mb_no?>')">기본정보</a></li>
        <li class="active"><a href="javascript:void(0);">인터뷰</a></li>
        <li><a href="javascript:void(0);" onclick="location.replace('<?php echo G5_BBS_URL ?>/mem_view3.php?mb_no=<?=$mb_no?>')">취미/관심사</a></li>
    </ul>
    
    <!--내용부분--> 
    <div class="in">
        <div class="con_info">
        	<div class="list top">
            	<dl class="part">
                	<dt class="title">교회에서 해왔던 활동</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<span><?php echo empty($mi['interview1_text1']) ? '등록예정입니다.' : $mi['interview1_text1']?></span>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">자주가는 곳, 추억의 장소는?</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<span><?php echo empty($mi['interview2_text1']) ? '등록예정입니다.' : ($mi['interview2_text1'] == '직접기재' ?  $mi['interview2_text2'] : $mi['interview2_text1'])?></span>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">인생에서 가장 기억에 남는 순간</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<span><?php echo empty($mi['interview3_text1']) ? '등록예정입니다.' : ($mi['interview3_text1'] == '직접기재' ?  $mi['interview3_text2'] : $mi['interview3_text1'])?></span>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">나의 매력 혹은 장점</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<span><?php echo empty($mi['interview4_text1']) ? '등록예정입니다.' : ($mi['interview4_text1'] == '직접기재' ?  $mi['interview4_text2'] : $mi['interview4_text1'])?></span>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">연인과 함께 먹고 싶은 음식</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<span><?php echo empty($mi['interview5_text1']) ? '등록예정입니다.' : ($mi['interview5_text1'] == '직접기재' ?  $mi['interview5_text2'] : $mi['interview5_text1'])?></span>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">내가 바라는 것, 기도제목</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<span><?php echo empty($mi['interview6_text1']) ? '등록예정입니다.' : $mi['interview6_text1']?></span>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">연인이 생기면 하고 싶은 것</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<span><?php echo empty($mi['interview7_text1']) ? '등록예정입니다.' : $mi['interview7_text1']?></span>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">나의 학교, 전공</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<span class="fix_blur"><?php echo empty($mi['interview8_text1']) ? '등록예정입니다.' : $mi['interview8_text1']?></span>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">일했던 회사, 업무분야</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<span><?php echo empty($mi['interview9_text1']) ? '등록예정입니다.' : $mi['interview9_text1']?></span>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">하나님께 받은/기도중인 비전</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<span><?php echo empty($mi['interview10_text1']) ? '등록예정입니다.' : $mi['interview10_text1']?></span>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">좋아하는 말씀/찬양</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<div class="pt">
                            	<strong>좋아하는 말씀</strong>
                            	<div><?php echo empty($mi['interview11_text1']) ? '등록예정입니다.' : $mi['interview11_text1']?></div>
                                <div><?php echo empty($mi['interview11_text2']) ? '등록예정입니다.' : $mi['interview11_text2']?></div>
                            </div>
                            <div class="pt">
                            	<strong>좋아하는 찬양</strong>
                            	<div><?php echo empty($mi['interview12_text1']) ? '등록예정입니다.' : $mi['interview12_text1']?></div>
                                <div><?php echo empty($mi['interview12_text2']) ? '등록예정입니다.' : $mi['interview12_text2']?></div>
                            </div>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">앞으로의 계획</dt>
                    <dd class="cont">
                    	<div class="chul">
                        	<div class="pt">
                            	<strong>신앙적</strong>
                                <div><?php echo empty($mi['interview13_text1']) ? '등록예정입니다.' : $mi['interview13_text1']?></div>
                            </div>
                            <div class="pt">
                            	<strong>사회적</strong>
                            	<div><?php echo empty($mi['interview14_text1']) ? '등록예정입니다.' : $mi['interview14_text1']?></div>
                            </div>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        </div><!--con_info-->
    </div><!--in-->
</div><!--mem_view-->
<!--회원상세페이지(인터뷰)-->