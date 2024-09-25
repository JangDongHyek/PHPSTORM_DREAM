anychart.onDocumentReady(function () {
    // JSON 데이터 로드
    anychart.data.loadJsonFile(
        'http://14.48.175.236/~hanwool/js/gantt-chart.json',
        function (data) {
            // 데이터 트리 생성
            var treeData = anychart.data.tree(data, 'as-table');

            // Gantt 차트 생성
            var chart = anychart.ganttProject();

            // 차트에 데이터 설정
            chart.data(treeData);

            // 시작 분할기 위치 설정
            chart.splitterPosition(460);

            // 데이터 그리드 가져와서 열 설정
            var dataGrid = chart.dataGrid();

            // 첫 번째 열 설정 (공종명 및 상세)
            dataGrid.column(0)
                .title('공종명 및 상세')  // 열 제목 변경
                .width(250)      // 열 너비
                .labels({ hAlign: 'left' })
                .labelsOverrider(labelTextSettingsFormatter);

            // 두 번째 열 설정 (담당자)
            dataGrid.column(1)
                .title('담당자')  // 새 열 제목
                .width(80)      // 열 너비
                .labels({ hAlign: 'center' })
                .labelsOverrider(labelTextSettingsFormatter);

            // 세 번째 열 설정 (상태)
            dataGrid.column(2)
                .title('상태')  // 새 열 제목
                .width(70)    // 열 너비
                .labels({ hAlign: 'center' })
                .labelsOverrider(labelTextSettingsFormatter);

            // 네 번째 열 설정 (시작예정일)
            dataGrid.column(3)
                .title('시작예정일')
                .width(100)
                .labels({ hAlign: 'center' })
                .labelsOverrider(labelTextSettingsFormatter)
                .labels()
                .format(thirdColumnTextFormatter);

            // 다섯 번째 열 설정 (마감예정일)
            dataGrid.column(4)
                .title('마감예정일')
                .width(100)
                .labels({ hAlign: 'center' })
                .labelsOverrider(labelTextSettingsFormatter)
                .labels()
                .format(fourthColumnTextFormatter);

            // 여섯 번째 열 설정 (시작일)
            dataGrid.column(5)
                .title('시작일')  // 새 열 제목
                .width(100)
                .labels({ hAlign: 'center' })
                .labelsOverrider(labelTextSettingsFormatter)
                .labels()
                .format(actualStartDateFormatter);

            // 일곱 번째 열 설정 (마감일)
            dataGrid.column(6)
                .title('마감일')  // 새 열 제목
                .width(100)
                .labels({ hAlign: 'center' })
                .labelsOverrider(labelTextSettingsFormatter)
                .labels()
                .format(actualEndDateFormatter);

            var timeline = chart.getTimeline();

            // 기준선 위에 배치
            timeline.baselines().above(true);

            // 마일스톤 미리보기 활성화
            timeline.milestones().preview().enabled(true);
            timeline.baselineMilestones().preview().enabled(true);

            // 차트 컨테이너 ID 설정
            chart.container('container');

            // 차트 그리기 시작
            chart.draw();

            // 차트 줌 설정
            chart.zoomTo(Date.UTC(2010, 0, 8, 15), Date.UTC(2010, 3, 25, 20));
        }
    );
});

// 모든 상위 항목에 볼드체와 이탤릭체 설정 추가
function labelTextSettingsFormatter(label, dataItem) {
    if (dataItem.numChildren()) {
        label.fontWeight('bold').fontStyle('italic');
    }
}

// 날짜 포맷팅 함수 (YYYY-MM-DD 형식으로 변경)
function formatDate(date) {
    var year = date.getUTCFullYear();
    var month = ('0' + (date.getUTCMonth() + 1)).slice(-2);
    var day = ('0' + date.getUTCDate()).slice(-2);
    return `${year}-${month}-${day}`;
}

// 세 번째 열 (시작예정일) 날짜 포맷팅
function thirdColumnTextFormatter(data) {
    var field = data.baselineStart;
    if (field) {
        var baselineStart = new Date(field);
        return formatDate(baselineStart);
    }
    var actualStart = data.item.get('actualStart');
    var actualEnd = data.item.get('actualEnd');
    if (actualStart === actualEnd || (actualStart && !actualEnd)) {
        var start = new Date(actualStart);
        return formatDate(start);
    }
    return '';
}

// 네 번째 열 (마감예정일) 날짜 포맷팅
function fourthColumnTextFormatter(item) {
    var field = item.baselineEnd;
    if (field) {
        var baselineEnd = new Date(field);
        return formatDate(baselineEnd);
    }
    return '';
}

// 실제 시작일 날짜 포맷팅
function actualStartDateFormatter(item) {
    var field = item.actualStart;
    if (field) {
        var actualStart = new Date(field);
        return formatDate(actualStart);
    }
    return '';
}

// 실제 종료일 날짜 포맷팅
function actualEndDateFormatter(item) {
    var field = item.actualEnd;
    if (field) {
        var actualEnd = new Date(field);
        return formatDate(actualEnd);
    }
    return '';
}

