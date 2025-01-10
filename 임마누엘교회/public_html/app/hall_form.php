<?php
$pid = "hall_form";
include_once("./app_head.php");

?>
    <div id="rental" class="form">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental_hall'"><i class="fa-solid fa-arrow-left"></i> 본당 대관 목록</button>
        <div class="box_radius box_white table">
            <ul class="tabs">
                <li class="tab-link current" data-tab="tab-1">신청하기</li>
                <li class="tab-link" data-tab="tab-2">나의 대관 신청</li>
            </ul>

            <div id="tab-1" class="tab-content current">
                <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
                <div class="table">
                    <table>
                        <tbody>
                        <tr class="top">
                            <td>신청부서 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr class="top">
                            <td>사용목적 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr class="top">
                            <td>날짜선택 <span class="txt_color">*</span></td>
                            <td>
                                <div class="date-container">
                                    <input type="date" class="date-input" aria-label="날짜 선택" />
                                    <label for="date-input" class="date-placeholder-label">날짜를 선택해주세요</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <br>
                <p class="text_center txt_blue"><i class="fa-solid fa-left-right"></i> 좌우로 스크롤 하세요</p>
                <div class="table">
                    <!-- 예루살렘성전 Table -->
                    <table class="click">
                        <thead>
                        <tr>
                            <th>예루살렘성전</th>
                            <th colspan="11"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>자모실(우)</td>
                            <td class="disabled">09~10</td>
                            <td>10~11</td>
                            <td class="disabled">11~12</td>
                            <td class="disabled">12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>자모실(좌)</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>찬양대석(우)</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>찬양대석(좌)</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>우측</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>좌측</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>중앙</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- 1층 Table -->
                    <table class="click">
                        <thead>
                        <tr>
                            <th>1층</th>
                            <th colspan="11"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>베들레헴성전</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>찬양대실</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>IMC카페</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>ROOM2</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>ROOM3</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>ROOM4</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- 2층 Table -->
                    <table class="click">
                        <thead>
                        <tr>
                            <th>2층</th>
                            <th colspan="11"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>지하체육관</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>학생찬양대실</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>유치부실</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>영아부실</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>식당 ROOM1</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>식당 ROOM2</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>식당 ROOM3</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>식당 ROOM4</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>식당 ROOM5</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>식당 ROOM6</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>식당 ROOM7</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        <tr>
                            <td>식당 ROOM8</td>
                            <td>09~10</td>
                            <td>10~11</td>
                            <td>11~12</td>
                            <td>12~13</td>
                            <td>13~14</td>
                            <td>14~15</td>
                            <td>15~16</td>
                            <td>16~17</td>
                            <td>17~18</td>
                            <td>18~19</td>
                            <td>19~20</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <p class="text_center txt_blue"><i class="fa-solid fa-left-right"></i> 좌우로 스크롤 하세요</p>
                <br>
                <div class="table">
                <table>
                    <tbody>
                        <tr>
                            <td>음식섭취 <span class="txt_color">*</span></td>
                            <td>
                                <div class="gap5 select nowrap">
                                    <input type="radio" name="state" id="s1" value="1">
                                    <label class="w100" for="s1">유</label>
                                    <input type="radio" name="state" id="s2" value="3" checked="">
                                    <label class="w100" for="s2">무</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>특이사항</td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>숙지사항<br>체크 <span class="txt_color">*</span></td>
                            <td class="text_left">
                                <label><input type="checkbox"> 1. 다음 예약을 위해 사용시간을 엄수해주시기 바랍니다.</label><br>
                                <label><input type="checkbox"> 2. 해당 장소의 열쇠를 받으신 경우 사용 후 즉시 경비실에 열쇠를 반납해 주셔야 합니다.</label><br>
                                <label><input type="checkbox"> 3. 사용 후에는 뒷정리 및 소등, 냉난방기를 꼭 꺼주시길 부탁드립니다.</label><br>
                                <label><input type="checkbox"> 4. 사용시 기물 등이 분실, 파손 된 경우 반드시 해당 내용을 사무실에 고지해 주시기 바랍니다.</label>
                            </td>
                        </tr>
                        <tr>
                            <td>신청인 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>연락처 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="guide">
                    <h6>위와 같이 대관을 신청합니다.</h6>
                    <p>※주의사항 : 기재해주신 연락처로 확정문자를 받으셔야 예약이 확정됩니다.<br>
                        해당 장소와 시간에 예약신청이 먼저 되어 있는 경우,
                        원하시는 장소와 시간에 사용이 불가할 수 있습니다.</p>
                </div>
                <br>
                <button type="button" class="btn btn_color btn-large" onclick="location.href='./rental_hall'">신청하기</button>
            </div>

            <div id="tab-2" class="tab-content">

                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>사용일</th>
                            <th>신청인</th>
                            <th>신청부서</th>
                            <th>장소</th>
                            <th>관리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr onclick="location.href='./hall_view'">
                            <td>24.09.01</td>
                            <td>전민웅 집사</td>
                            <td>제10남선교회</td>
                            <td>찬양대석(좌)</td>
                            <td>
                                <button type="button" class="btn btn_mini btn_gray">보기</button>
                            </td>
                        </tr>
                        <tr onclick="location.href='./hall_view'">
                            <td>24.09.01</td>
                            <td>전민웅 집사</td>
                            <td>제10남선교회</td>
                            <td>찬양대석(좌)</td>
                            <td>
                                <button type="button" class="btn btn_mini btn_gray">보기</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="b-pagination-outer">
                    <ul id="border-pagination">


                        <li><a href="javascript:void(0)" class="active">1</a></li>
                        <li><a href="?page=2&amp;" class="">2</a></li>
                        <li><a href="?page=3&amp;" class="">3</a></li>
                        <li><a href="?page=4&amp;" class="">4</a></li>


                        <li><a href="?page=4&amp;">»</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dateInputs = document.querySelectorAll('.date-input');

            dateInputs.forEach(dateInput => {
                // 포커스 시 'hide' 클래스를 추가하여 안내 문구를 숨김
                dateInput.addEventListener('focus', () => {
                    dateInput.classList.add('filled');
                }, { once: true }); // { once: true } 옵션으로 이벤트가 한 번만 실행되도록 설정
            });
        });
    </script>

    <script>
        // 모든 테이블의 tbody 내 td 요소를 대상으로 클릭 이벤트 추가
        document.querySelectorAll("table.click tbody tr").forEach(row => {
            row.querySelectorAll("td:not(:first-child)").forEach(cell => {
                // "disabled" 클래스를 가진 셀은 클릭 불가
                if (!cell.classList.contains("disabled")) {
                    cell.addEventListener("click", () => {
                        cell.classList.toggle("selected"); // 선택 상태 토글
                    });
                }
            });
        });
    </script>

<script>
    $(document).ready(function(){

        $('ul.tabs li').click(function(){
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        })

    })

</script>
<?php
include_once("./app_tail.php");
?>