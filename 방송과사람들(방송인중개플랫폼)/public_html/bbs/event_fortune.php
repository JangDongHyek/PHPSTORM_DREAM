<?
include_once('./_common.php');
$name = "event_fortune";
$pid = "event_fortune";
$g5['title'] = '오늘의 운세';
include_once('./_head.php');
?>

<section class="event_fortune">


    <h2>🔮 오늘의 운세 🔮</h2>
    <div class="card" onclick="startLoading()">
        <div class="card-inner">
            <div class="card-back">
                <span id="default-text">운세 뽑기</span>
                <div class="loader-container" id="loader-container">
                    <svg class="progress-circle">
                        <circle cx="40" cy="40" r="40"></circle>
                    </svg>
                    <span id="progress-text" class="progress-text">0%</span>
                </div>
                <span id="loading-message">들여다보는 중...</span>
            </div>
            <div class="card-front" id="fortune-text"></div>
        </div>
    </div>

    <script>
        function startLoading() {
            let progress = 0;
            const progressText = document.getElementById("progress-text");
            const circle = document.querySelector("circle");
            const loaderContainer = document.getElementById("loader-container");
            const loadingMessage = document.getElementById("loading-message");
            const defaultText = document.getElementById("default-text");

            // 초기 UI 변경
            defaultText.style.display = "none"; // "운세 뽑기" 숨김
            loaderContainer.style.display = "flex"; // 로딩 바 표시
            loadingMessage.style.display = "block"; // "들여다보는 중..." 표시

            // 3초 동안 0 → 100% 증가
            const interval = setInterval(() => {
                progress += 10;
                progressText.innerText = progress + "%";
                circle.style.strokeDashoffset = 251.2 * (1 - progress / 100); // 원형 차오르는 효과

                if (progress >= 100) {
                    clearInterval(interval);
                    revealFortune();
                }
            }, 300);
        }

        function revealFortune() {
            const fortunes = [
                { type: "매우좋음", text: "가만히 있기보단 용감하게 도전하면 모든 일이 잘 풀릴 거예요." },
                { type: "매우좋음", text: "관계운이 최상입니다. 귀인이 나타나 당신을 도와줄 거예요." },
                { type: "매우좋음", text: "금전운이 최상. 엄청난 행운이 찾아올 예정이예요." },
                { type: "매우좋음", text: "모든 일이 순조로운날이에요. 최상의 결과를 기대해도 좋아요." },
                { type: "매우좋음", text: "새로운 장소에 가세요. 우연한 기회로 기다려왔던 인연을 만날 수 있어요." },
                { type: "매우좋음", text: "애정운이 최상입니다. 사랑하는 사람에게 고백하는 것을 주저하지 마세요." },
                { type: "좋음", text: "기다려왔던 좋은 기회가 생길 거예요. 놓치지 말고 꼭 잡아보세요." },
                { type: "좋음", text: "가족들과 함께 하면 좋은 날이예요. 서로에게 따뜻한 마음을 전달해보세요." },
                { type: "좋음", text: "가족에게 연락해보세요. 마음을 표현하면 행운 지수가 올라가는 날이에요." },
                { type: "좋음", text: "공과 사를 잘 구분해야하는 하루예요. 오늘 운이 더 좋아질거예요." },
                { type: "좋음", text: "공들여 온 일이 마무리 될 것 같아요. 조금 더 힘내면 잘될 수 있어요." },
                { type: "좋음", text: "관계운이 상승하고 있습니다. 주변 사람들과 좋은 관계를 구축하기 좋을거예요." },
                { type: "보통", text: "가벼운 산책을 하면서 긴장을 풀면 모든 일이 좋아질 거예요." },
                { type: "무난", text: "계획을 할 때, 함께 논의해 보는 것이 좋은 날이에요." }
            ];

            // 랜덤 운세 선택
            const randomFortune = fortunes[Math.floor(Math.random() * fortunes.length)];

            // 결과 표시
            document.getElementById("fortune-text").innerHTML = `<strong>${randomFortune.type}</strong><p>${randomFortune.text}</p>`;

            // 카드 뒤집기
            document.querySelector(".card").classList.add("flipped");
        }
    </script>


</section>

<?
include_once('./_tail.php');
?>
