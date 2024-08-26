const SVGNS = "http://www.w3.org/2000/svg";
const π = Math.PI;

class Dial {
  constructor(params) {
    this.radius = 120;
    this.RECT_HEIGHT = 50;
    this.RECT_WIDTH = 60;
    this.LINE_LENGTH = 70;
    this.selectedId = null;
    this.data = params.data;
    this.onselectchange = params.onselectchange;

    this.container = document.createElementNS(SVGNS, "svg");
    this.container.classList.add("container");
    document.querySelector(params.bindTo).appendChild(this.container);
    this.centerX = this.container.clientWidth / 2;
    this.centerY = this.container.clientHeight / 2;

    const { top, left } = this.container.getBoundingClientRect();
    this.top = top;
    this.left = left;

    this.linesGraphic = document.createElementNS(SVGNS, "g");
    this.linesGraphic.classList.add("lines");

    this.rectsGraphic = document.createElementNS(SVGNS, "g");
    this.rectsGraphic.classList.add("rects");

    this.circlesGraphic = document.createElementNS(SVGNS, "g");
    this.circlesGraphic.classList.add("circles");

    this.radar = document.createElementNS(SVGNS, "polygon");
    this.radar.classList.add("radar");

    this.container.appendChild(this.rectsGraphic);
    this.container.appendChild(this.radar);
    this.container.appendChild(this.linesGraphic);
    this.container.appendChild(this.circlesGraphic);

    this.circlePositions = [];
    this.data.forEach((item, i) => {
      const line = document.createElementNS(SVGNS, "line");
      line.setAttribute("x1", this.centerX);
      line.setAttribute("y1", this.centerY);
      line.setAttribute(
        "x2",
        `calc(${this.centerX}px + ${this.LINE_LENGTH}px * cos(${
          (i * 2 * π) / this.data.length
        }))`
      );
      line.setAttribute(
        "y2",
        `calc(${this.centerY}px + ${this.LINE_LENGTH}px * sin(${
          (i * 2 * π) / this.data.length
        }))`
      );
      this.linesGraphic.appendChild(line);

      const rectGraphic = document.createElementNS(SVGNS, "g");
      rectGraphic.classList.add(item.id, item.level);
      const rect = document.createElementNS(SVGNS, "rect");
      const diseaseText = document.createElementNS(SVGNS, "text");
      diseaseText.classList.add("disease");
      diseaseText.setAttribute("x", 30);
      diseaseText.setAttribute("y", 20);
      const levelText = document.createElementNS(SVGNS, "text");
      levelText.classList.add("level");
      levelText.setAttribute("x", 30);
      levelText.setAttribute("y", 40);
      diseaseText.append(item.id);
      levelText.append(item.level);

      rectGraphic.appendChild(rect);
      rectGraphic.appendChild(diseaseText);
      rectGraphic.appendChild(levelText);

      this.rectsGraphic.appendChild(rectGraphic);

      const circle = document.createElementNS(SVGNS, "circle");
      circle.setAttribute("r", "2.5");
      let distance = 60;
      if (item.level === "정상") {
        distance = 60;
      }
      if (item.level === "주의") {
        distance = 50;
      }
      if (item.level === "위험") {
        distance = 40;
      }

      const calcX =
        this.centerX + distance * Math.cos((i * 2 * π) / this.data.length);
      const calcY =
        this.centerY + distance * Math.sin((i * 2 * π) / this.data.length);

      this.circlePositions.push([calcX, calcY].join());
      circle.classList.add(item.level);
      circle.setAttribute("cx", `${calcX}px`);
      circle.setAttribute("cy", `${calcY}px`);
      this.circlesGraphic.appendChild(circle);
    });
    this.radar.setAttribute("points", this.circlePositions.join(" "));

    this.draggable = false;
    this.dragging = false;
    this.Δθ;
    this.initTheta; // 드래그 시작 시점의 포인터 각도
    this.pastTheta = -π / 2; // 드래그 시작 시점에 그래프가 돌아간 정도
    this.θ = { θ: this.pastTheta };

    this.container.onmousemove = this.container.ontouchmove = (e) =>
      this.drag(e);
    this.container.onmouseup = this.container.ontouchend = (e) =>
      this.endDragging(e);
    this.container.onmousedown = this.container.ontouchstart = (e) =>
      this.startDragging(e);
    this.rectsGraphic.childNodes.forEach((rect, i) => {
      rect.onmousedown = rect.ontouchstart = (e) => {
        this.draggable = true;
      };
      rect.onclick = (e) => {
        if (this.dragging) return;
        const a = -(i * 2 * π) / this.data.length - π / 2;
        let diff = (a - this.θ.θ) % (2 * π);
        // diff 범위를 [-π, π) 로 변환
        diff = diff - π - Math.floor((diff - π) / (2 * π)) * (2 * π) - π;

        this.pastTheta = this.θ.θ + diff;
        new TWEEN.Tween(this.θ)
          .to({ θ: this.θ.θ + diff }, 800)
          .easing(TWEEN.Easing.Cubic.InOut)
          .start();
      };
    });
  }

  rotate(θ) {
    // 각 사각형들을 회전시킴
    // 현재 원 궤도, to be: 타원 궤도
    this.rectsGraphic.childNodes.forEach((rect, i) => {
      // 원 위의 점 좌표 계산
      const x =
        this.centerX +
        this.radius * Math.cos(θ + (i * 2 * π) / this.data.length);
      const y =
        this.centerY +
        this.radius * Math.sin(θ + (i * 2 * π) / this.data.length);

      // 사각형 좌표 계산
      const rx = -this.RECT_WIDTH / 2 + x;
      const ry = -this.RECT_HEIGHT / 2 + y;

      rect.style.transform = `translate(${rx}px, ${ry}px)`;

      const threshold = 20;

      if (
        (y < this.centerY) &
        ((this.centerX - threshold < x) & (x < this.centerX + threshold))
      ) {
        rect.style.transform += " scale(1.3)";

        // 선택이 바뀐 경우
        if (rect.classList[0] !== this.selectedId) {
          this.selectedId = rect.classList[0];
          this.onselectchange({ id: this.selectedId });
        }
      }
    });

    // 선분 회전
    this.linesGraphic.style.setProperty("transform", `rotate(${θ}rad)`);

    // 점 회전
    this.circlesGraphic.style.setProperty("transform", `rotate(${θ}rad)`);

    // 폴리곤 회전
    this.radar.style.setProperty("transform", `rotate(${θ}rad)`);
  }

  getAngle(e) {
    let clientX, clientY;
    if (e.type === "touchstart") {
      clientX = e.touches[0].clientX;
      clientY = e.touches[0].clientY;
    } else {
      clientX = e.clientX;
      clientY = e.clientY;
    }
    const x = clientX - this.left - this.centerX;
    const y = clientY - this.top - this.centerY;
    return Math.atan2(y, x);
  }

  startDragging(e) {
    // 드래그 시작 시 initTheta 업데이트
    this.initTheta = this.getAngle(e);
  }

  drag(e) {
    if (!this.draggable) return;
    this.dragging = true;

    let clientX, clientY;
    if (e.type === "touchmove") {
      clientX = e.touches[0].clientX;
      clientY = e.touches[0].clientY;
    } else {
      clientX = e.clientX;
      clientY = e.clientY;
    }

    // 드래그 가능한 컨테이너 대한 포인터의 상대 위치 계산
    // 컨테이너의 중심 좌표를 빼서 좌표계 원점을 컨테이너의 중심으로 이동
    const x = clientX - this.left - this.centerX;
    const y = clientY - this.top - this.centerY;

    // 현재 포인터의 원점에 대한 각도 계산
    const theta = Math.atan2(y, x); // 리턴 범위: (−π, π]

    // 각변위 계산
    // theta: (−π, π], initTheta: (−π, π] 이므로 Δθ: (−2π, 2π]
    this.Δθ = theta - this.initTheta;
    if ((this.initTheta < 0) & (theta > 0)) {
      this.Δθ = -Math.abs(this.initTheta) + Math.abs(theta);
    } else if ((this.initTheta > 0) & (theta < 0)) {
      this.Δθ = -Math.abs(this.initTheta) + Math.abs(theta);
    }

    // 현재 돌아간 정도
    this.θ.θ = this.pastTheta + this.Δθ;
    this.pastTheta = this.θ.θ;
    this.initTheta = theta;
  }

  endDragging(e) {
    if (!this.draggable) return;
    this.draggable = false;

    setTimeout(() => {
      this.dragging = false;
    }, 100);

    // 드래그 종료 시 pastTheta 업데이트
    this.pastTheta = this.pastTheta + this.Δθ;
  }

  update() {
    this.rotate(this.θ.θ);
  }
}
