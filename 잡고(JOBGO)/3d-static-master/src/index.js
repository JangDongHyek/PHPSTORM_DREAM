import * as THREE from "./modules/three.module.js";
import { OrbitControls } from "./modules/OrbitControls.js";
import { OBJLoader } from "./modules/OBJLoader.js";
import { TWEEN } from "./modules/tween.module.min.js";
import { EffectComposer } from "./modules/postprocessing/EffectComposer.js";
import { RenderPass } from "./modules/postprocessing/RenderPass.js";
import { UnrealBloomPass } from "./modules/postprocessing/UnrealBloomPass.js";
import { ShaderPass } from "./modules/postprocessing/ShaderPass.js";
import { SSAARenderPass } from "./modules/postprocessing/SSAARenderPass.js";
import { OutlinePass } from "./modules/postprocessing/OutlinePass.js";

let scene,
  container,
  camera,
  raycaster,
  renderer,
  controls,
  light,
  timer,
  bloomComposer,
  finalComposer,
  bloomLayer,
  darkMaterial,
  storedMaterials,
  originalColors,
  outlinePass,
  pointer,
  tweens,
  objLoader;
const ENTIRE_SCENE = 0;
const BLOOM_SCENE = 1;

function init() {
  container = document.querySelector("#scene");
  storedMaterials = {};
  originalColors = {};
  tweens = [];
  scene = new THREE.Scene();
  objLoader = new OBJLoader();
  pointer = new THREE.Vector2();
  raycaster = new THREE.Raycaster();
  darkMaterial = new THREE.MeshBasicMaterial({ color: "black" });
  bloomLayer = new THREE.Layers();
  bloomLayer.set(BLOOM_SCENE);

  // init camera
  camera = new THREE.PerspectiveCamera(
    50,
    container.clientWidth / container.clientHeight,
    0.1,
    2000
  );
  camera.position.set(0, 2.2, 0);

  // init renderer
  renderer = new THREE.WebGLRenderer({
    antialias: true,
    alpha: true,
  });
  renderer.shadowMap.enabled = true;
  renderer.shadowMap.type = THREE.PCFSoftShadowMap;
  renderer.localClippingEnabled = true;
  renderer.setSize(container.clientWidth, container.clientHeight);
  renderer.setClearColor(0x000000, 0);
  renderer.setPixelRatio(window.devicePixelRatio);
  container.appendChild(renderer.domElement);

  // postprocessing
  const renderPass = new RenderPass(scene, camera);
  const ssaaRenderPass = new SSAARenderPass(scene, camera);
  ssaaRenderPass.sampleLevel = 32;
  ssaaRenderPass.unbiased = true;
  const bloomPass = new UnrealBloomPass(
    new THREE.Vector2(container.clientWidth, container.clientHeight),
    0.1,
    1,
    0
  );

  const renderTarget = new THREE.WebGLRenderTarget(
    container.clientWidth,
    container.clientHeight,
    {
      minFilter: THREE.LinearFilter,
      magFilter: THREE.LinearFilter,
      format: THREE.RGBAFormat,
      stencilBuffer: false,
    }
  );

  bloomComposer = new EffectComposer(renderer, renderTarget);
  bloomComposer.setSize(container.clientWidth, container.clientHeight);
  bloomComposer.setPixelRatio(window.devicePixelRatio);
  bloomComposer.addPass(renderPass);
  bloomComposer.addPass(bloomPass);
  bloomComposer.renderToScreen = false;

  const finalPass = new ShaderPass(
    new THREE.ShaderMaterial({
      uniforms: {
        baseTexture: { value: null },
        bloomTexture: { value: bloomComposer.renderTarget2.texture },
      },
      vertexShader: document.getElementById("vertexShader").textContent,
      fragmentShader: document.getElementById("fragmentShader").textContent,
      defines: {},
    }),
    "baseTexture"
  );
  finalPass.needsSwap = true;

  outlinePass = new OutlinePass(
    new THREE.Vector2(container.clientWidth, container.clientHeight),
    scene,
    camera
  );
  outlinePass.pulsePeriod = 5;

  finalComposer = new EffectComposer(renderer, renderTarget);
  finalComposer.addPass(renderPass);
  // finalComposer.addPass(ssaaRenderPass);
  finalComposer.addPass(outlinePass);
  finalComposer.addPass(finalPass);

  // init orbitControls
  controls = new OrbitControls(camera, renderer.domElement);
  controls.minDistance = 0.4;
  controls.maxDistance = 2;
  controls.enableDamping = true;
  controls.rotateSpeed = 1;
  controls.dampingFactor = 0.09;
  controls.minPolarAngle = Math.PI / 2;
  controls.maxPolarAngle = Math.PI / 2;
  controls.autoRotate = true;

  // restrict panning scope to keep in viewport
  const minPan = new THREE.Vector3(-0.5, -0.8, -0.5);
  const maxPan = new THREE.Vector3(0.5, 0.8, 0.5);
  const _v = new THREE.Vector3();

  controls.addEventListener("change", function () {
    _v.copy(controls.target);
    controls.target.clamp(minPan, maxPan);
    _v.sub(controls.target);
    camera.position.sub(_v);
  });

  // init light
  light = new THREE.HemisphereLight(0xeeeeee, 0x666666, 1);
  scene.add(light);
}

// load a human with given parts
function loadHuman() {
  // load single body part from obj file.
  function loadPart(part) {
    objLoader.load(`./src/static/${part.id}.obj`, (obj) => {
      obj.traverse((child) => {
        if (child.type == "Mesh") {
          const material = new THREE.MeshPhongMaterial({
            color: part.color,
          });
          child.material = material;

          if (part.sick === true) outlinePass.selectedObjects.push(child);
          scene.add(child);
        }
      });
    });
  }

  const parts = [
    { id: "head2", color: 0xff3c3c },
    { id: "chest2", color: 0x3cff3c },
    { id: "stomach", color: 0x3c3cff, sick: true },
    { id: "arms", color: 0xffff3c },
    { id: "hip", color: 0xff3cff },
    { id: "pelvis", color: 0xff3c3c },
    { id: "legs", color: 0x3cff3c },
    { id: "feet", color: 0x3c3cff, sick: true },
  ];
  parts.forEach((part) => loadPart(part));
}

// mark parts with spheres
function markParts() {
  function addMark(sphere) {
    const geometry = new THREE.SphereGeometry(sphere.radius);
    const material = new THREE.MeshBasicMaterial({
      color: sphere.color,
      side: THREE.FrontSide,
      transparent: true,
      opacity: sphere.opacity,
    });
    const mesh = new THREE.Mesh(geometry, material);
    mesh.position.set(...sphere.position);
    scene.add(mesh);

    if (sphere.sick === true) outlinePass.selectedObjects.push(mesh);
  }

  const spheres = [
    {
      id: "eyes",
      position: [-0.04, 0.67, 0.1],
      opacity: 0.5,
      color: 0x00ffff,
      radius: 0.02,
    },
    {
      id: "nose",
      position: [-0.01, 0.65, 0.12],
      opacity: 0.5,
      color: 0x00ff00,
      radius: 0.02,
    },
    {
      id: "neck",
      position: [0.005, 0.55, 0],
      opacity: 0.5,
      color: 0x0000ff,
      radius: 0.07,
    },
    {
      id: "ears",
      position: [0.09, 0.66, 0.03],
      opacity: 0.5,
      color: 0x00ff00,
      radius: 0.03,
    },
    {
      id: "ankle",
      position: [-0.085, -0.7, -0.065],
      opacity: 0.5,
      color: 0xff00ff,
      radius: 0.05,
    },
    {
      id: "knee",
      position: [0.1, -0.43, 0],
      opacity: 0.5,
      color: 0xffff00,
      radius: 0.1,
    },
    {
      id: "hand",
      position: [0.4, 0, 0.1],
      opacity: 0.4,
      color: 0xff0000,
      radius: 0.1,
    },
    {
      id: "shoulder",
      position: [-0.2, 0.5, -0.04],
      opacity: 0.5,
      color: 0x8e44ad,
      radius: 0.08,
      sick: true,
    },
    {
      id: "mouth",
      position: [-0.01, 0.62, 0.11],
      opacity: 0.5,
      color: 0x0000ff,
      radius: 0.02,
    },
  ];

  spheres.forEach(addMark);
}

function render() {
  // renderer.render(scene, camera);

  scene.traverse(darkenNonBloomed);
  bloomComposer.render();
  scene.traverse(restoreMaterial);
  finalComposer.render();

  TWEEN.update();
  controls.update();
}

function animate() {
  requestAnimationFrame(animate);
  render();
}

function darkenNonBloomed(obj) {
  if (obj.isMesh && bloomLayer.test(obj.layers) == false) {
    storedMaterials[obj.uuid] = obj.material;
    obj.material = darkMaterial;
  }
}

function restoreMaterial(obj) {
  if (storedMaterials[obj.uuid]) {
    obj.material = storedMaterials[obj.uuid];
    delete storedMaterials[obj.uuid];
  }
}

function stopSpinning() {
  controls.autoRotate = false;
  clearTimeout(timer);
  timer = setTimeout(() => {
    controls.autoRotate = true;
  }, 5000);
}

function translate(event) {
  const bound = event.target.getBoundingClientRect();
  const relativeX = event.clientX - bound.left;
  const relativeY = event.clientY - bound.top;

  pointer.x = (relativeX / container.clientWidth) * 2 - 1;
  pointer.y = -(relativeY / container.clientHeight) * 2 + 1;
}

function selectPart(target) {
  target.object.layers.toggle(BLOOM_SCENE);

  // 선택되지 않은 부위들 어둡게
  scene.traverse((obj) => {
    if (obj.isMesh && bloomLayer.test(obj.layers) == false) {
      if (!originalColors[obj.uuid]) {
        originalColors[obj.uuid] = obj.material.color;
      }
      obj.material.color = new THREE.Color(originalColors[obj.uuid]).lerp(
        new THREE.Color("#000"),
        0.5
      );
    }
  });

  scene.traverse((obj) => {
    if (obj.isMesh && bloomLayer.test(obj.layers) == true) {
      if (!originalColors[obj.uuid]) {
        originalColors[obj.uuid] = obj.material.color;
      }
      obj.material.color = originalColors[obj.uuid];
    }
  });

  // 선택된 부위가 하나도 없으면 모두 원래 색으로 복구
  let selected = false;
  scene.traverse((obj) => {
    if (obj.isMesh && bloomLayer.test(obj.layers) == true) selected = true;
  });
  if (selected == false) {
    scene.traverse((obj) => {
      if (obj.isMesh) obj.material.color = originalColors[obj.uuid];
    });

    const tween1 = new TWEEN.Tween(controls.target)
      .to({ x: 0, y: 0, z: 0 }, 400)
      .easing(TWEEN.Easing.Cubic.Out)
      .start();

    const tween2 = new TWEEN.Tween(camera.position)
      .to(
        new THREE.Vector3(
          camera.position.x,
          camera.position.y,
          camera.position.z
        ).setLength(2.2),
        400
      )
      .easing(TWEEN.Easing.Cubic.Out)
      .start();

    tweens.push(tween1);
    tweens.push(tween2);
  }

  // const targetPosition = target.object.position;
  const targetPosition = target.point;
  let length = 1;

  const nextCameraPosition = new THREE.Vector3(
    camera.position.x,
    camera.position.y,
    camera.position.z
  ).setLength(length);

  if (selected) {
    const tween1 = new TWEEN.Tween(controls.target)
      .to(
        { x: targetPosition.x, y: targetPosition.y, z: targetPosition.z },
        400
      )
      .easing(TWEEN.Easing.Cubic.Out)
      .start();

    const tween2 = new TWEEN.Tween(camera.position)
      .to(nextCameraPosition, 400)
      .easing(TWEEN.Easing.Cubic.Out)
      .start();

    tweens.push(tween1);
    tweens.push(tween2);
  }
}

function onClick(event) {
  stopSpinning();
  translate(event);
  raycaster.setFromCamera(pointer, camera);

  const intersects = raycaster.intersectObjects(scene.children);
  if (intersects.length > 0) {
    const target = intersects[0];
    selectPart(target);
  }
}

function stopTweens(event) {
  tweens.forEach((tween) => {
    console.log(tween);
    tween.stop();
  });
  tweens.length = 0;
}

init();
loadHuman();
markParts();
animate();

container.addEventListener("click", onClick);
container.addEventListener("mousedown", onTouchMove);


  let zoomOutTweenControls;
  let initialDistance = null;
  let lastDistance = null;
  let zoomControlsTarget;
  let zoomControlsCamera;
  let initialControlsTarget = controls.target.clone();

  function getDistance(touches) {
    const [touch1, touch2] = touches;
    const dx = touch1.clientX - touch2.clientX;
    const dy = touch1.clientY - touch2.clientY;
    return Math.sqrt(dx * dx + dy * dy);
  }

  function onTouchStart(e) {

    if (e.touches.length === 2) {
      initialDistance = getDistance(e.touches);
      lastDistance = initialDistance;
    }
  }

  function onTouchMove(e) {
    e.preventDefault();
    if (e.touches.length === 2 && initialDistance !== null) {
      const distance = getDistance(e.touches);
      const threshold = 5;

      if (distance > lastDistance + threshold) {
        stopZoomMove();
      } else if (distance < lastDistance - threshold) {
        if(isCameraAtMaxDistance()){
          if (zoomControlsTarget != null) zoomControlsTarget.stop();
          if (zoomControlsCamera != null) zoomControlsCamera.stop();
          zoomOutTweenControls = new TWEEN.Tween(controls.target).to(initialControlsTarget, 800).easing(TWEEN.Easing.Cubic.Out).start();
        }
      }

      lastDistance = distance;
    }
  }

  function onTouchEnd(e) {
    if (e.touches.length === 1) {
      initialDistance = null;
      lastDistance = null;
    }
  }

  container.addEventListener('touchstart', onTouchStart);
  container.addEventListener('touchmove', onTouchMove, { passive: false });
  container.addEventListener('touchend', onTouchEnd);


  function isCameraAtMaxDistance() {
    const distance = camera.position.distanceTo(controls.target);
    console.log(distance);
    return compareNumbers(distance, controls.maxDistance);
  }

  function compareNumbers(num1, num2) {
    const precision = 5;
    const diff = Math.abs(num1 - num2);
    const threshold = Math.pow(10, -precision);

    return diff < threshold;
  }

  function stopZoomMove(){
    if (zoomOutTweenControls != null) zoomOutTweenControls.stop();
    if (zoomControlsTarget != null) zoomControlsTarget.stop();
    if (zoomControlsCamera != null) zoomControlsCamera.stop();
  }