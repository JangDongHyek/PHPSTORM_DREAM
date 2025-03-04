
<link href="<?php echo G5_THEME_URL; ?>/skin/submenu/basic/style.css" rel="stylesheet" type="text/css">
<div class="sub_margin">
<div class="sub_nav">
    <section>
        <div id="left">
            <dl>
                <div class="dd">
                    <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01" class="" target=""><i class="fa-solid fa-arrow-left"></i></a></dd>
                    <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_05" class="<?php if($co_id == "sub01_05"){ echo "on";}?>" target="">예배안내</a></dd>
                    <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_05_02" class="<?php if($co_id == "sub01_05_02"){ echo "on";}?>" target="">찾아오시는길</a></dd>
                    <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_05_03" class="<?php if($co_id == "sub01_05_03"){ echo "on";}?>" target="">셔틀버스안내</a></dd>
                    <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_05_04" class="<?php if($co_id == "sub01_05_04"){ echo "on";}?>" target="">주차안내</a></dd>
                    <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_05_05" class="<?php if($co_id == "sub01_05_05"){ echo "on";}?>" target="">성전안내</a></dd>
                    </div>
            </dl>
        </div><!--#left-->
    </section>
</div>
</div>
<div id="sub01_01" class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
    <? if(defined('_INDEX_')) {?>
    <? }else if($co_id == "sub01_05"){ ?>
        <div class="sub sub01_05">
            <div class="inr v2">
                <div>
                    <div class="grid_wrap">
                        <h2>예배 안내</h2>
                        <p>모든 예배는 유튜브를 통해 생중계 됩니다.</p>
                    </div>
                    <div class="grid_wrap">
                        <h2>IMC WORSHIP</h2>
                        <div class="table">
                            <table>
                                <thead>
                                <tr>
                                    <th>예배</th>
                                    <th>시간</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>주일 대예배 <br>(Simultaneous English Interpretation Available)</td>
                                    <td>2부 09:00 / 3부 11:00</td>
                                </tr>
                                <tr>
                                    <td>주일 4부예배</td>
                                    <td>14:00</td>
                                </tr>
                                <tr>
                                    <td>주일 저녁예배</td>
                                    <td>19:30</td>
                                </tr>
                                <tr>
                                    <td>수요 저녁예배</td>
                                    <td>19:30</td>
                                </tr>
                                <tr>
                                    <td>새벽예배</td>
                                    <td>05:30 (월-토요일)</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="grid_wrap">
                        <h2>CHURCH SCHOOL</h2>
                        <div class="table">
                            <table>
                                <thead>
                                <tr>
                                    <th>예배</th>
                                    <th>시간</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>고등부 예배</td>
                                    <td>09:00 (지하체육관)</td>
                                </tr>
                                <tr>
                                    <td>중등부 예배</td>
                                    <td>09:00 (베들레헴성전)</td>
                                </tr>
                                <tr>
                                    <td>드림2부 예배</td>
                                    <td>09:00 (교육관 11층)</td>
                                </tr>
                                <tr>
                                    <td>드림1부 예배</td>
                                    <td>09:00 (교육관 10층)</td>
                                </tr>
                                <tr>
                                    <td>유치부 예배</td>
                                    <td>1부 09:00 / 2부 11:00 (유치부실)</td>
                                </tr>
                                <tr>
                                    <td>영아부 예배</td>
                                    <td>1부 09:00 / 2부 11:00 (영아부실)</td>
                                </tr>
                                <tr>
                                    <td>ISES (English School)</td>
                                    <td>11:00 (교육관 10층)</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <? }else if($co_id == "sub01_05_02"){ ?>
    <div class="sub sub01_05_02">
        <div class="inr v2">
            <div class="sub" id="sub07_01">
                <!-- * 카카오맵 - 지도퍼가기 -->
                <!-- 1. 지도 노드 -->
                <div id="daumRoughmapContainer1709011276368" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100%;border-radius: 10px; overflow: hidden;"></div>

                <!--
                    2. 설치 스크립트
                    * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
                -->
                <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

                <!-- 3. 실행 스크립트 -->
                <script charset="UTF-8">
                    new daum.roughmap.Lander({
                        "timestamp" : "1709011276368",
                        "key" : "2i9oy",
                        "mapWidth" : "100%",
                        "mapHeight" : "500"
                    }).render();
                </script>


                <div class="sub_layout">
                    <div class="titwrap">
                        <h3>교회위치 &amp; 교통편 안내</h3>
                    </div>
                    <div class="conwrap">
                        <dl>
                            <dt>주소</dt>
                            <dd>서울시 송파구  방이동 위례성대로 28 기독교 대한감리회 임마누엘교회</dd>
                            <dt>전화</dt>
                            <dd>02-415-3021</dd>
                            <dt>팩스</dt>
                            <dd>02-2202-7590</dd>
                        </dl>
                        <dl>
                            <dt>지하철</dt>
                            <dd>
                                <span style="color:#BD9A31;">9호선 한성백제역</span> ①번출구 / 교회 바로 앞<br>
                                <span style="color:#EF5D9C;">8호선 몽촌토성역</span> ②번출구 / 도보 3분<br>
                                <span style="color:#39B64A;">2호선 잠실나루역</span> ③번출구 / 택시 환승<br>
                                <span style="color:#39B64A;">2호선 잠실역</span> 송파전화국방면 / 택시, 버스 환승
                            </dd>

                            <dt>버스</dt>
                            <dd>
                                <span style="color:#4B96F3">교회 앞(올림픽공원)</span> : 333, 340, 3412, 3413, 30, 30-5<br>
                                <span style="color:#4B96F3">올림픽회관</span> : 340, 341, 351, 3318, 3319, 3411, 4318, 16, 30, 30-1, 30-3, 70<br>
                                <span style="color:#4B96F3">방이2동주민센터</span> : 333, 340<br>
                                <span style="color:#4B96F3">몽촌토성역</span> : 341, 3319, 3411, 6006, 30-1, 30-3, 70
                            </dd>

                            <dt>교회버스</dt>
                            <dd>
                                주일예배, 수요저녁예배에 교회버스 운영<br>
                                - 버스노선 및 시간은 [셔틀버스 운행] 참고
                            </dd>

                            <dt>자가용</dt>
                            <dd>
                                네비게이션 검색 시 :<br>
                                <span style="color:#444">[서울 송파구 위례성대로 28]</span> ,
                                <span class="color:#444">[서울 송파구 방이동 45-5]</span><br>
                                혹은 <span style="color:#444">[방이동 임마누엘교회]</span> 입력<br>
                                주차장 안내 : 주차안내 참고
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? }else if($co_id == "sub01_05_03"){ ?>
    <div class="sub sub01_05 sub01_05_03">
        <div class="inr v2">
            <div>
                <div class="grid_wrap">
                    <div>
                        <h2>1호 버스(8337)</h2>
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub01_05/8337.jpg" alt="">
                        <h2><br>저녁 : 스타리아(7413)</h2>
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub01_05/7413.jpg" alt="">
                    </div>
                    <div class="table">
                        <p>강일, 고덕, 길동, 둔촌동, 성내동, 풍납동, 파크리오</p>
                        <p>차량 기사 : 신봉국 권사 010-8904-0409</p>
                        <table>
                            <thead>
                            <tr>
                                <th rowspan="2">
                                    <p>정류장</p>
                                </th>
                                <th rowspan="2">
                                    <p>주일 2부</p>
                                </th>
                                <th rowspan="2">
                                    <p>주일 3부</p>
                                </th>
                                <th>
                                    <p>주일 저녁</p>
                                </th>
                                <th rowspan="2">
                                    <p>철야 예배</p>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <p>수요 저녁</p>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <p>강일A 힐스테이트 503동 앞<br /> 강동 리버스트 406동 앞</p>
                                </td>
                                <td>
                                    <p>07:45</p>
                                </td>
                                <td>
                                    <p>09:45</p>
                                </td>
                                <td>
                                    <p>18:15</p>
                                </td>
                                <td>
                                    <p>20:45</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>강일동 성당 건너편</p>
                                </td>
                                <td>
                                    <p>07:57</p>
                                </td>
                                <td>
                                    <p>09:57</p>
                                </td>
                                <td>
                                    <p>18:27</p>
                                </td>
                                <td>
                                    <p>20:57</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>고덕6단지정류장 앞</p>
                                </td>
                                <td>
                                    <p>08:00</p>
                                </td>
                                <td>
                                    <p>10:00</p>
                                </td>
                                <td>
                                    <p>18:30</p>
                                </td>
                                <td>
                                    <p>21:00</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>상일동 주민센터 앞</p>
                                </td>
                                <td>
                                    <p>08:02</p>
                                </td>
                                <td>
                                    <p>10:02</p>
                                </td>
                                <td>
                                    <p>18:32</p>
                                </td>
                                <td>
                                    <p>21:02</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>현대고덕숲107동 앞</p>
                                </td>
                                <td>
                                    <p>08:05</p>
                                </td>
                                <td>
                                    <p>10:05</p>
                                </td>
                                <td>
                                    <p>18:35</p>
                                </td>
                                <td>
                                    <p>21:05</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>길동주민센터</p>
                                </td>
                                <td>
                                    <p>08:15</p>
                                </td>
                                <td>
                                    <p>10:15</p>
                                </td>
                                <td>
                                    <p>18:45</p>
                                </td>
                                <td>
                                    <p>21:15</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>달려라병원(길조식당)</p>
                                </td>
                                <td>
                                    <p>08:20</p>
                                </td>
                                <td>
                                    <p>10:20</p>
                                </td>
                                <td>
                                    <p>18:50</p>
                                </td>
                                <td>
                                    <p>21:20</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>둔촌역 우리은행</p>
                                </td>
                                <td>
                                    <p>08:23</p>
                                </td>
                                <td>
                                    <p>10:23</p>
                                </td>
                                <td>
                                    <p>18:53</p>
                                </td>
                                <td>
                                    <p>21:23</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>서원 카 공업사</p>
                                </td>
                                <td>
                                    <p>08:26</p>
                                </td>
                                <td>
                                    <p>10:26</p>
                                </td>
                                <td>
                                    <p>18:56</p>
                                </td>
                                <td>
                                    <p>21:26</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>MG새마을금고</p>
                                </td>
                                <td>
                                    <p>08:27</p>
                                </td>
                                <td>
                                    <p>10:27</p>
                                </td>
                                <td>
                                    <p>18:57</p>
                                </td>
                                <td>
                                    <p>21:27</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>레미안 103동 앞</p>
                                </td>
                                <td>
                                    <p>08:29</p>
                                </td>
                                <td>
                                    <p>10:29</p>
                                </td>
                                <td>
                                    <p>18:59</p>
                                </td>
                                <td>
                                    <p>21:29</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>풍납 미성 아파트</p>
                                </td>
                                <td>
                                    <p>08:32</p>
                                </td>
                                <td>
                                    <p>10:32</p>
                                </td>
                                <td>
                                    <p>19:02</p>
                                </td>
                                <td>
                                    <p>21:32</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>풍납 백제공원 횡단보도</p>
                                </td>
                                <td>
                                    <p>08:33</p>
                                </td>
                                <td>
                                    <p>10:33</p>
                                </td>
                                <td>
                                    <p>19:03</p>
                                </td>
                                <td>
                                    <p>21:33</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>다사랑 약국</p>
                                </td>
                                <td>
                                    <p>08:35</p>
                                </td>
                                <td>
                                    <p>10:35</p>
                                </td>
                                <td>
                                    <p>19:05</p>
                                </td>
                                <td>
                                    <p>21:35</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>가위손 헤어샵</p>
                                </td>
                                <td>
                                    <p>08:36</p>
                                </td>
                                <td>
                                    <p>10:36</p>
                                </td>
                                <td>
                                    <p>19:06</p>
                                </td>
                                <td>
                                    <p>21:36</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>풍납동 하나은행</p>
                                </td>
                                <td>
                                    <p>08:39</p>
                                </td>
                                <td>
                                    <p>10:39</p>
                                </td>
                                <td>
                                    <p>19:09</p>
                                </td>
                                <td>
                                    <p>21:39</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>다리위</p>
                                </td>
                                <td>
                                    <p>08:42</p>
                                </td>
                                <td>
                                    <p>10:42</p>
                                </td>
                                <td>
                                    <p>19:12</p>
                                </td>
                                <td>
                                    <p>21:42</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>파크리오</p>
                                </td>
                                <td>
                                    <p>08:45</p>
                                </td>
                                <td>
                                    <p>10:45</p>
                                </td>
                                <td>
                                    <p>19:15</p>
                                </td>
                                <td>
                                    <p>21:45</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>교회 도착</p>
                                </td>
                                <td>
                                    <p>08:50</p>
                                </td>
                                <td>
                                    <p>10:50</p>
                                </td>
                                <td>
                                    <p>19:20</p>
                                </td>
                                <td>
                                    <p>21:50</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="grid_wrap">
                    <div>
                        <h2>솔라티(3764)</h2>
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub01_05/3764.jpg" alt="">
                    </div>
                    <div class="table">
                        <p>자양동, 잠실동, 잠실역, 파크리오</p>
                        <p>차량 기사 : 조재흥 집사 010-7220-5794</p>
                        <table>
                            <thead>
                            <tr>
                                <th rowspan="2">
                                    <p>정류장</p>
                                </th>
                                <th rowspan="2">
                                    <p>주일 2부</p>
                                </th>
                                <th rowspan="2">
                                    <p>주일 3부</p>
                                </th>
                                <th>
                                    <p>주일 저녁</p>
                                </th>
                                <th rowspan="2">
                                    <p>철야 예배</p>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <p>수요 저녁</p>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <p>자양동 신가초등</p>
                                </td>
                                <td>
                                    <p>08:14</p>
                                </td>
                                <td>
                                    <p>10:14</p>
                                </td>
                                <td>
                                    <p>18:44</p>
                                </td>
                                <td>
                                    <p>21:14</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>자양동 주유소</p>
                                </td>
                                <td>
                                    <p>08:16</p>
                                </td>
                                <td>
                                    <p>10:16</p>
                                </td>
                                <td>
                                    <p>18:46</p>
                                </td>
                                <td>
                                    <p>21:16</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>리센츠</p>
                                </td>
                                <td>
                                    <p>08:21</p>
                                </td>
                                <td>
                                    <p>10:21</p>
                                </td>
                                <td>
                                    <p>18:51</p>
                                </td>
                                <td>
                                    <p>21:21</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>엘스 아파트</p>
                                </td>
                                <td>
                                    <p>08:22</p>
                                </td>
                                <td>
                                    <p>10:22</p>
                                </td>
                                <td>
                                    <p>18:52</p>
                                </td>
                                <td>
                                    <p>21:22</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>새마을시장</p>
                                </td>
                                <td>
                                    <p>08:25</p>
                                </td>
                                <td>
                                    <p>10:25</p>
                                </td>
                                <td>
                                    <p>18:55</p>
                                </td>
                                <td>
                                    <p>21:25</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>겔러리 아파트</p>
                                </td>
                                <td>
                                    <p>08:29</p>
                                </td>
                                <td>
                                    <p>10:29</p>
                                </td>
                                <td>
                                    <p>18:59</p>
                                </td>
                                <td>
                                    <p>21:29</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>향군회관</p>
                                </td>
                                <td>
                                    <p>08:33</p>
                                </td>
                                <td>
                                    <p>10:33</p>
                                </td>
                                <td>
                                    <p>19:03</p>
                                </td>
                                <td>
                                    <p>21:33</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>파크리오 119동</p>
                                    <p>맞은 편</p>
                                </td>
                                <td>
                                    <p>08:40</p>
                                </td>
                                <td>
                                    <p>10:40</p>
                                </td>
                                <td>
                                    <p>19:10</p>
                                </td>
                                <td>
                                    <p>21:40</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>잠실 고등학교</p>
                                </td>
                                <td>
                                    <p>08:42</p>
                                </td>
                                <td>
                                    <p>10:42</p>
                                </td>
                                <td>
                                    <p>19:12</p>
                                </td>
                                <td>
                                    <p>21:42</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>파크리오 6경비실</p>
                                    <p>앞 큰길</p>
                                </td>
                                <td>
                                    <p>08:44</p>
                                </td>
                                <td>
                                    <p>10:44</p>
                                </td>
                                <td>
                                    <p>19:14</p>
                                </td>
                                <td>
                                    <p>21:44</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>교회도착</p>
                                </td>
                                <td>
                                    <p>08:50</p>
                                </td>
                                <td>
                                    <p>10:50</p>
                                </td>
                                <td>
                                    <p>19:20</p>
                                </td>
                                <td>
                                    <p>21:50</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="grid_wrap">
                    <div>
                        <h2>5호 카운티 (6954)</h2>
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub01_05/6954.jpg" alt="">
                    </div>
                    <div class="table">
                        <p>하남, 천현동, 신장동, 덕풍동, 감북동, 방이동</p>
                        <p>차량 기사 : 박만수 집사 010-3975-3004</p>
                        <table>
                            <thead>
                            <tr>
                                <th rowspan="2">
                                    <p>정류장</p>
                                </th>
                                <th rowspan="2">
                                    <p>주일 2부</p>
                                </th>
                                <th rowspan="2">
                                    <p>주일 3부</p>
                                </th>
                                <th>
                                    <p>주일 저녁</p>
                                </th>
                                <th rowspan="2">
                                    <p>철야 예배</p>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <p>수요 저녁</p>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <p>덕풍시장 입구</p>
                                </td>
                                <td>
                                    <p>08:00</p>
                                </td>
                                <td>
                                    <p>10:00</p>
                                </td>
                                <td>
                                    <p>18:30</p>
                                </td>
                                <td>
                                    <p>21:00</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>솔파크</p>
                                </td>
                                <td>
                                    <p>08:03</p>
                                </td>
                                <td>
                                    <p>10:03</p>
                                </td>
                                <td>
                                    <p>18:33</p>
                                </td>
                                <td>
                                    <p>21:03</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>대명 아파트</p>
                                </td>
                                <td>
                                    <p>08:14</p>
                                </td>
                                <td>
                                    <p>10:14</p>
                                </td>
                                <td>
                                    <p>18:34</p>
                                </td>
                                <td>
                                    <p>21:14</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>하남 소방서</p>
                                </td>
                                <td>
                                    <p>08:15</p>
                                </td>
                                <td>
                                    <p>10:15</p>
                                </td>
                                <td>
                                    <p>18:35</p>
                                </td>
                                <td>
                                    <p>21:15</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>두메촌</p>
                                </td>
                                <td>
                                    <p>08:16</p>
                                </td>
                                <td>
                                    <p>10:16</p>
                                </td>
                                <td>
                                    <p>18:36</p>
                                </td>
                                <td>
                                    <p>21:16</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>동부 주유소</p>
                                </td>
                                <td>
                                    <p>08:19</p>
                                </td>
                                <td>
                                    <p>10:19</p>
                                </td>
                                <td>
                                    <p>18:39</p>
                                </td>
                                <td>
                                    <p>21:19</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>블루밍</p>
                                </td>
                                <td>
                                    <p>08:20</p>
                                </td>
                                <td>
                                    <p>10:20</p>
                                </td>
                                <td>
                                    <p>18:40</p>
                                </td>
                                <td>
                                    <p>21:20</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>현대 아파트</p>
                                </td>
                                <td>
                                    <p>08:21</p>
                                </td>
                                <td>
                                    <p>10:21</p>
                                </td>
                                <td>
                                    <p>18:41</p>
                                </td>
                                <td>
                                    <p>21:21</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>한솔</p>
                                </td>
                                <td>
                                    <p>08:24</p>
                                </td>
                                <td>
                                    <p>10:24</p>
                                </td>
                                <td>
                                    <p>18:44</p>
                                </td>
                                <td>
                                    <p>21:24</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>도로공사</p>
                                </td>
                                <td>
                                    <p>08:34</p>
                                </td>
                                <td>
                                    <p>10:34</p>
                                </td>
                                <td>
                                    <p>18:54</p>
                                </td>
                                <td>
                                    <p>21:34</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>신구 아파트</p>
                                    <p>앞 gs 편의점</p>
                                </td>
                                <td>
                                    <p>08:42</p>
                                </td>
                                <td>
                                    <p>&nbsp;</p>
                                </td>
                                <td>
                                    <p>&nbsp;</p>
                                </td>
                                <td>
                                    <p>&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>곰 할인마트</p>
                                </td>
                                <td>
                                    <p>08:44</p>
                                </td>
                                <td>
                                    <p>&nbsp;</p>
                                </td>
                                <td>
                                    <p>&nbsp;</p>
                                </td>
                                <td>
                                    <p>&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>교회 도착</p>
                                </td>
                                <td>
                                    <p>08:50</p>
                                </td>
                                <td>
                                    <p>&nbsp;</p>
                                </td>
                                <td>
                                    <p>&nbsp;</p>
                                </td>
                                <td>
                                    <p>&nbsp;</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="grid_wrap">
                    <div>
                        <h2>스타렉스 (6509)</h2>
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub01_05/6509.jpg" alt="">
                    </div>
                    <div class="table">
                        <p>거여동, 개롱역, 오금동, 삼전동, 송파동, 방이동</p>
                        <p>차량 기사 : 정후남 집사 010-8338-0048</p>
                        <table>
                            <thead>
                            <tr>
                                <th rowspan="2">
                                    <p>정류장</p>
                                </th>
                                <th rowspan="2">
                                    <p>주일 2부</p>
                                </th>
                                <th rowspan="2">
                                    <p>주일 3부</p>
                                </th>
                                <th>
                                    <p>주일 저녁</p>
                                </th>
                                <th rowspan="2">
                                    <p>철야 예배</p>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <p>수요 저녁</p>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <p>삼환 아파트</p>
                                </td>
                                <td>
                                    <p>08:10</p>
                                </td>
                                <td>
                                    <p>10:10</p>
                                </td>
                                <td>
                                    <p>18:40</p>
                                </td>
                                <td>
                                    <p>21:10</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>프라자A 건너편</p>
                                </td>
                                <td>
                                    <p>08:12</p>
                                </td>
                                <td>
                                    <p>10:12</p>
                                </td>
                                <td>
                                    <p>18:42</p>
                                </td>
                                <td>
                                    <p>21:12</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>송파 참 노인병원</p>
                                    <p>맞은 편</p>
                                </td>
                                <td>
                                    <p>08:13</p>
                                </td>
                                <td>
                                    <p>10:13</p>
                                </td>
                                <td>
                                    <p>18:43</p>
                                </td>
                                <td>
                                    <p>21:13</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>전주교회 앞</p>
                                </td>
                                <td>
                                    <p>08:14</p>
                                </td>
                                <td>
                                    <p>10:14</p>
                                </td>
                                <td>
                                    <p>18:44</p>
                                </td>
                                <td>
                                    <p>21:14</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>오금동 알파문고 앞</p>
                                </td>
                                <td>
                                    <p>08:16</p>
                                </td>
                                <td>
                                    <p>10:16</p>
                                </td>
                                <td>
                                    <p>18:46</p>
                                </td>
                                <td>
                                    <p>21:16</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>오금동 현대 아파트</p>
                                </td>
                                <td>
                                    <p>08:17</p>
                                </td>
                                <td>
                                    <p>10:17</p>
                                </td>
                                <td>
                                    <p>18:47</p>
                                </td>
                                <td>
                                    <p>21:17</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>삼전동 장수설렁탕</p>
                                </td>
                                <td>
                                    <p>08:30</p>
                                </td>
                                <td>
                                    <p>10:30</p>
                                </td>
                                <td>
                                    <p>19:00</p>
                                </td>
                                <td>
                                    <p>21:30</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>타이어뱅크</p>
                                </td>
                                <td>
                                    <p>08:31</p>
                                </td>
                                <td>
                                    <p>10:31</p>
                                </td>
                                <td>
                                    <p>19:01</p>
                                </td>
                                <td>
                                    <p>21:31</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>송파구구민회관</p>
                                </td>
                                <td>
                                    <p>08:35</p>
                                </td>
                                <td>
                                    <p>10:35</p>
                                </td>
                                <td>
                                    <p>19:05</p>
                                </td>
                                <td>
                                    <p>21:35</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>삼전우체국</p>
                                </td>
                                <td>
                                    <p>08:37</p>
                                </td>
                                <td>
                                    <p>10:37</p>
                                </td>
                                <td>
                                    <p>19:07</p>
                                </td>
                                <td>
                                    <p>21:37</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>한솔아파트 앞</p>
                                </td>
                                <td>
                                    <p>08:38</p>
                                </td>
                                <td>
                                    <p>10:38</p>
                                </td>
                                <td>
                                    <p>19:08</p>
                                </td>
                                <td>
                                    <p>21:38</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>여성문화회관 앞</p>
                                </td>
                                <td>
                                    <p>08:40</p>
                                </td>
                                <td>
                                    <p>10:40</p>
                                </td>
                                <td>
                                    <p>19:10</p>
                                </td>
                                <td>
                                    <p>21:44</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>송파동 참설렁탕</p>
                                </td>
                                <td>
                                    <p>08:46</p>
                                </td>
                                <td>
                                    <p>10:46</p>
                                </td>
                                <td>
                                    <p>19:16</p>
                                </td>
                                <td>
                                    <p>21:46</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>교회도착</p>
                                </td>
                                <td>
                                    <p>08:50</p>
                                </td>
                                <td>
                                    <p>10:50</p>
                                </td>
                                <td>
                                    <p>19:20</p>
                                </td>
                                <td>
                                    <p>21:50</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <? }else if($co_id == "sub01_05_04"){ ?>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <div class="sub sub01_05_04">
        <div class="inr v2">
            <div class="sub" id="sub07_01">


                <div class="sub_layout">
                    <div class="titwrap">
                        <h3>🚘 이용가능한 주차장</h3>
                    </div>
                    <div class="conwrap">
                        <dl>
                            <dt>● 무료주차 : 320대 <br>(주차선 : 190대 / <br class="hidden-xs">통로 : 110대 / <br class="hidden-xs">기타 : 20대)</dt>
                            <dd><b style="color:#000">1. 교회 마당</b> : 40대 (주차선 : 10대 / 통로 : 30대)<br>
                                – 장애인, 임산부, 노약자, 새가족 우선<br><br>

                                <b style="color:#000">2. 교회 지하주차장</b> : 115대 (주차선 : 75대 / 통로 : 40대)<br>
                                – 중립이 안되는 차는 통로에 주차하지 마시고 부득이한 경우에는 연락처 기록<br><br>

                                <b style="color:#000">3. 방이중학교</b> : 주일 오전 8시~오후2시 (출차시간 엄수)<br>
                                – 통로에 주차할 경우에 연락처 기록하여 차에 놓아 주시기 바랍니다.<br>
                                – 수요예배와 주일 저녁에는 방이중학교 주차가 않됩니다.<br><br>

                                <b style="color:#000">4. 교회에서 석촌역방향 국민은행 건물 앞</b> : 10대<br>
                                – 올라가는 전용길이 없으니 확인하시고 주차하시기 바랍니다.</dd>
                        </dl>

                        <div class="conslide">

                            <div class="swiper free-slider">
                                <div class="swiper-wrapper">
                                    <?php for($i=1;$i<5;$i++){?>
                                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub01_05/free-<?php echo $i ?>.jpg" alt=""></div>
                                    <?php }?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <script>
                            var swiper = new Swiper(".free-slider", {
                                slidesPerView: 2,
                                spaceBetween: 10,
                                loop :true,
                                pagination: {
                                    el: ".swiper-pagination",
                                    type: "fraction",
                                },
                                breakpoints: {
                                    640: {
                                        slidesPerView: 2,
                                        spaceBetween: 10,
                                    },
                                    768: {
                                        slidesPerView: 4,
                                        spaceBetween: 10,
                                    },
                                    1024: {
                                        slidesPerView: 4,
                                        spaceBetween: 10,
                                    },
                                },
                            });
                        </script>
                        <dl>
                            <dt>● 유료주차 : 310대</dt>
                            <dd>
                                <b style="color:#000">1. 공원남4문</b> : 50여대<br>
                                <b style="color:#000">2. 한성백제박물관 </b>: 50대<br>
                                <b style="color:#000">3. 공원남3문(소마미술관)</b> : 180대<br>
                                <b style="color:#000">4. 교회 앞 노상 공영주차장</b> : 30대
                            </dd>
                        </dl>
                        <div class="conslide">

                            <div class="swiper fee-slider">
                                <div class="swiper-wrapper">
                                    <?php for($i=1;$i<5;$i++){?>
                                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub01_05/fee-<?php echo $i ?>.jpg" alt=""></div>
                                    <?php }?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <script>
                            var swiper = new Swiper(".fee-slider", {
                                slidesPerView: 2,
                                spaceBetween: 10,
                                loop :true,
                                pagination: {
                                    el: ".swiper-pagination",
                                    type: "fraction",
                                },
                                breakpoints: {
                                    640: {
                                        slidesPerView: 2,
                                        spaceBetween: 10,
                                    },
                                    768: {
                                        slidesPerView: 4,
                                        spaceBetween: 10,
                                    },
                                    1024: {
                                        slidesPerView: 4,
                                        spaceBetween: 10,
                                    },
                                },
                            });
                        </script>
                    </div>
                    <div class="titwrap">
                        <h3>🚘 주차장 이용 안내</h3>
                    </div>
                    <div class="conwrap">
                        <dl>
                            <dt style="color:#ff4e4e">● 다른 차량에 불편을 주어 삼가할 주차 사례</dt>
                            <dd>1. 2부 예배 끝나고 10분 이후에 나가는 경우(특히 통로에 주차한 경우)<br>
                                2. 주변 건물의 출입구 등에 연락처 없이 무단주차한 경우<br>
                                3. 주차공간이 있는데 통로입구에 주차하는 경우<br>
                                4. 중립이 안되는 차를 연락처 없이 통로에 주차하는 경우<br>
                                5. 연락처 없이 통로에 주차하고 늦게 오는 경우</dd>
                        </dl>
                        <dl>
                            <dt style="color:#ff4e4e">● 절대 주차금지 장소</dt>
                            <dd><b style="color:#000">1. 방이중학교 앞 인도</b><br>
                                (인도 주차는 어떠한 경우에도 단속대상 입니다)<br><br>
                                <b style="color:#000">2. 교회 앞 정문 좌우인도 및 도로(IMC cafe 앞)</b><br>
                                (서울시에서 주일에도 이동카메라로 단속을 합니다)<br><br>
                                <b style="color:#000">3. 교회 주변 이면도로 삼거리 중앙부분에 통행 방해하는 주차</b><br>
                                (주행차량이 방해된다고 운전자가 신고하면 단속합니다)<br><br>

                                <b style="color:#ff4e4e">*교회 뒷길 절대 주차 금지 바랍니다. (어린이보호구역. 수시로 단속함)</b>
                            </dd>
                        </dl>
                    </div>
                    <div class="conslide">

                        <div class="swiper ban-slider">
                            <div class="swiper-wrapper">
                                <?php for($i=1;$i<4;$i++){?>
                                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub01_05/ban-<?php echo $i ?>.jpg" alt=""></div>
                                <?php }?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <script>
                        var swiper = new Swiper(".ban-slider", {
                            slidesPerView: 2,
                            spaceBetween: 10,
                            loop :true,
                            pagination: {
                                el: ".swiper-pagination",
                                type: "fraction",
                            },
                            breakpoints: {
                                640: {
                                    slidesPerView: 2,
                                    spaceBetween: 10,
                                },
                                768: {
                                    slidesPerView: 3,
                                    spaceBetween: 10,
                                },
                                1024: {
                                    slidesPerView: 3,
                                    spaceBetween: 10,
                                },
                            },
                        });
                    </script>
                </div>
            </div>


        </div>
    </div>
    <? }else if($co_id == "sub01_05_05"){ ?>
    <div class="sub sub01_05_05">
        <div class="inr v2">
            <div class="flex">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub01_05_05_1.jpg" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub01_05_05_2.jpg" alt="">
            </div>

        </div>
    </div>
    <? }else if($bo_table == "" || $co_id == ""){ ?>
<? } ?>
</div>