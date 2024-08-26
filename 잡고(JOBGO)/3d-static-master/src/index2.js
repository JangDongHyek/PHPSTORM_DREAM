import * as THREE from "./modules/three.module.js";
import { OrbitControls } from "./modules/OrbitControls.js";
import { OBJLoader } from "./modules/OBJLoader.js";
import { TWEEN } from "./modules/tween.module.min.js";

let scene,
  container,
  camera,
  camera2,
  raycaster,
  renderer,
  controls,
  controls2,
  light,
  timer;
const pointer = new THREE.Vector2();

function init() {
  scene = new THREE.Scene();
  container = document.querySelector("#scene2");

  camera = new THREE.PerspectiveCamera(
    50,
    ((container.clientWidth / container.clientHeight) * 1) / 2,
    0.1,
    5
  );
  camera.position.set(-5, 0, 2);

  camera2 = new THREE.PerspectiveCamera(
    50,
    ((container.clientWidth / container.clientHeight) * 1) / 2,
    0.1,
    5
  );
  camera2.position.set(5, 0, 2);

  raycaster = new THREE.Raycaster();

  renderer = new THREE.WebGLRenderer({
    antialias: true,
    alpha: true,
    localClippingEnabled: true,
  });
  renderer.shadowMap.enabled = true;
  renderer.shadowMap.type = THREE.PCFSoftShadowMap;
  renderer.setPixelRatio(window.devicePixelRatio);
  renderer.setSize(container.clientWidth, container.clientHeight);
  renderer.setClearColor(0x000000, 1);
  renderer.autoClear = false;

  container.appendChild(renderer.domElement);

  controls = new OrbitControls(camera, renderer.domElement);
  controls.minDistance = 0.4;
  controls.maxDistance = 2;
  controls.enableDamping = true;
  controls.rotateSpeed = 1;
  controls.dampingFactor = 0.09;
  controls.target = new THREE.Vector3(-5, 0, 0);

  controls.minPolarAngle = Math.PI / 2;
  controls.maxPolarAngle = Math.PI / 2;
  // controls.autoRotate = true;

  controls2 = new OrbitControls(camera2, renderer.domElement);
  controls2.minDistance = 0.4;
  controls2.maxDistance = 2;
  controls2.enableDamping = true;
  controls2.rotateSpeed = 1;
  controls2.dampingFactor = 0.09;
  controls2.target = new THREE.Vector3(5, 0, 0);

  controls2.minPolarAngle = Math.PI / 2;
  controls2.maxPolarAngle = Math.PI / 2;

  light = new THREE.HemisphereLight(0xeeeeee, 0x666666, 1);
  scene.add(light);
}

function loadPerson(a, x, y, z, color) {
  const objLoader = new OBJLoader();

  objLoader.load(
    `./src/static/${a}.obj`,
    function (object) {
      object.traverse(function (child) {
        if (child.type == "Mesh") {
          const material = new THREE.MeshPhongMaterial({
            // wireframe: true,
            color: color,
            side: THREE.DoubleSide,
          });

          child.material = material;
        }
      });
      object.position.x = x;
      object.position.y = y;
      object.position.z = z;
      scene.add(object);
    },
    function (xhr) {
      console.log((xhr.loaded / xhr.total) * 100 + "% loaded");
    },
    function (error) {
      console.log(error);
    }
  );
}

function render() {
  renderer.clear();

  renderer.setViewport(0, 0, container.clientWidth / 2, container.clientHeight);
  renderer.setClearColor(0x000000, 1);
  renderer.render(scene, camera);

  renderer.setViewport(
    container.clientWidth / 2,
    0,
    container.clientWidth / 2,
    container.clientHeight
  );
  renderer.setClearColor(0xffffff, 1);
  renderer.render(scene, camera2);
}

function animate() {
  requestAnimationFrame(animate);

  render();

  // TWEEN.update();
  controls.update();
  controls2.update();
}

init();
loadPerson("body", 5, -0.08, 0, 0xccccff);
loadPerson("body2", -5, 0, 0, 0xff7f50);

animate();
