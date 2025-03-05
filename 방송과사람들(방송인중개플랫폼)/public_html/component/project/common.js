class ProjectCommon {
    constructor(jl) {
        this.jl = jl;
        console.log(1);
    }

    getClass(project,request = null) {
        let status = this.getStatus(project,request);

        if(status == '검토중') return "";
        if(status == '종료') return "v2";
        if(status == '진행중') return "v3";
        if(status == '모집중') return "v1";

        if(status == '대기중') return "";
        if(status == '마감') return "v1";
        if(status == '지원 취소') return "v2";
        if(status == '작업완료') return "v3";
        if(status == '진행중') return "v3";

        return ""
    }

    getStatus(project,request = null) {
        if(request) {
            if(request.cancel) return "지원 취소";
            if(request.prize) {
                if(project.complete) return "작업완료";
                else return "진행중";
            }

            if(project.choice) return "마감"
            if(this.jl.isRangeDate(project.start_date,project.end_date)) return "대기중";
        }else {
            if(!project.status) return "검토중";
            if(project.complete) return "종료"
            if(project.choice) return "진행중";
            if(this.jl.isRangeDate(project.start_date,project.end_date)) return "모집중";
        }


        return "상태값 없음";
    }

    getDurationDays(project) {
        let startDate = project.start_date;
        let endDate = project.end_date;
        // 날짜 형식 검증 (YYYY-MM-DD)
        const dateRegex = /^\d{4}-\d{2}-\d{2}$/;

        if (!dateRegex.test(startDate) || !dateRegex.test(endDate)) {
            throw new Error('날짜 형식은 YYYY-MM-DD로 입력해주세요.');
        }

        // Date 객체 생성
        const start = new Date(startDate);
        const end = new Date(endDate);

        if (isNaN(start.getTime()) || isNaN(end.getTime())) {
            throw new Error('유효하지 않은 날짜입니다.');
        }

        // 일수 계산 (하루 86400000ms)
        const diffInMs = end - start;
        const diffInDays = diffInMs / (1000 * 60 * 60 * 24);

        if (diffInDays < 0) {
            throw new Error('시작 날짜가 종료 날짜보다 이후일 수 없습니다.');
        }

        return diffInDays + 1; // 시작일부터 종료일까지 포함
    }

    totalPrize(project) {
        let total = 0;

        for (const prize of project.prize) {
            total += prize.money * prize.people;
        }

        return total;
    }
}

window.ProjectCommon = ProjectCommon;