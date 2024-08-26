import * as THREE from 'three'
import * as PinchZoom from 'https://unpkg.com/pinch-zoom-js@2.3.5/dist/pinch-zoom.min.js'
import * as VConsole from 'https://unpkg.com/vconsole@latest/dist/vconsole.min.js'


import { OrbitControls } from 'three/addons/controls/OrbitControls.js'
import { OBJLoader } from 'three/addons/loaders/OBJLoader.js';
import { TWEEN } from 'three/addons/libs/tween.module.min';

var vConsole = new window.VConsole();
const pointer = new THREE.Vector2();
function initScene() {
    const scene = new THREE.Scene();
    return scene;
}

function setLight() {
    const light = new THREE.HemisphereLight(0xeeeeee, 0x666666, 1);
    scene.add(light);
}

function loadPerson() {
    const objLoader = new OBJLoader();

    objLoader.load(
        "./src/static/example_mesh.obj",
        function (object) {

            object.traverse(function (child) {
                if (child instanceof THREE.Mesh) {
                    //child.userData.id = "body";
                    // child.geometry.computeVertexNormals();
                    // child.material.map = texture;

                    // const plane = new THREE.Plane(new THREE.Vector3(0, -1, 0), 0.2);
                    const material = new THREE.MeshPhongMaterial({ wireframe: true, color: 0x3c3c3c });
                    child.material = material;


                    // const cubeFolder = gui.addFolder('Cube');

                    // const materialParams = {
                    //     color: 0x000000,
                    // };

                    // // cubeFolder.add(object.rotation, 'x', 0, Math.PI * 2);
                    // cubeFolder.addColor(materialParams, 'color').onChange((value) => child.material.color.set(value));
                    // cubeFolder.open();

                }
            })
            scene.add(object);
        },
        // called when loading is in progresses
        function (xhr) {
            //console.log((xhr.loaded / xhr.total * 100) + '% loaded');
        },
        // called when loading has errors
        function (error) {
            console.log(error);
        }
    );
}

function initCamera(container) {
    const camera = new THREE.PerspectiveCamera(50, container.clientWidth / container.clientHeight, 0.1, 2000);
    camera.position.set(0, 2.2, 0);
    return camera
}

function initRenderer(container) {
    const renderer = new THREE.WebGLRenderer({
        antialias: true,
        alpha: true
    });

    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;
    renderer.localClippingEnabled = true;

    renderer.setClearColor(0x000000, 0);
    renderer.setPixelRatio(window.devicePixelRatio);

    container.appendChild(renderer.domElement);
    return renderer
}

function initControls(camera, renderer) {
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.minDistance = 0.4;
    controls.maxDistance = 2;
    controls.enableDamping = true;
    controls.rotateSpeed = 1;
    controls.dampingFactor = 0.09;

    controls.minPolarAngle = Math.PI / 2;
    controls.maxPolarAngle = Math.PI / 2;
    controls.autoRotate = true;
    controls.saveState();

	

    return controls;
}

function addSphere(scene, radius, color, opacity, position, id, renderOrder = 0) {
    const geometry = new THREE.SphereGeometry(radius);
    const material = new THREE.MeshBasicMaterial({ color: color, side: THREE.FrontSide, transparent: true, opacity: opacity });
    const mesh = new THREE.Mesh(geometry, material);

    mesh.renderOrder = renderOrder;
    mesh.position.set(...position);
    mesh.userData.id = id;
    scene.add(mesh);
}

let intersected = null;

function renderHover() {
    const intersects = raycaster.intersectObjects(scene.children);

    if (intersects.length > 0) {
        if (intersected != intersects[0].object) {
            if (intersected) {
                intersected.material.color.set(intersected.currentColor);
            }
            intersected = intersects[0].object;
            intersected.currentColor = { ...intersected.material.color };
            intersected.material.color.set(0xffffff);
        }
    } else {
        if (intersected) {
            intersected.material.color.set(intersected.currentColor);
        }
        intersected = null;
    }
}

function animate() {
    requestAnimationFrame(animate);

    raycaster.setFromCamera(pointer, camera);

    // renderHover();

    renderer.render(scene, camera);

    TWEEN.update();
    controls.update();
}

const raycaster = new THREE.Raycaster();
const container = document.querySelector("#scene");
const scene = initScene();
const camera = initCamera(container);
const renderer = initRenderer(container, raycaster);
const controls = initControls(camera, renderer);
const canvas = renderer.domElement;
let initialControlsTarget = controls.target.clone();

setLight();
loadPerson();

    const positions = {
        chest: [0.003467, 0.387831, 0.099294],
        neck: [-0.001083, 0.563993, 0.054719],
        pelvis: [0.098800, 0.034311, 0.092489],
        abdomen: [0.007795, 0.147866, 0.125574],
        head: [-0.009016, 0.698794, 0.117864],
        hand: [0.367360, -0.040160, 0.136653],
        arm: [-0.304839, 0.174641, -0.013752],
        shoulder: [-0.181618, 0.494080, 0.005266],
        foot: [0.115984, -0.836289, 0.084041],
        ankle: [-0.069955, -0.781353, -0.036818],
        knee: [-0.097813, -0.462938, -0.014365],
        leg: [0.113745, -0.675460, -0.011128],
        hip: [0.004587, -0.024168, -0.126536]
    }

    const spheres = [{
        id: "chest",
        position: positions["chest"],
        opacity: 0.5,
        color: 0xFF6EFA,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: "neck",
        position: positions["neck"],
        opacity: 0.5,
        color: 0xF99507,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'pelvis',
        position: positions["pelvis"],
        opacity: 0.5,
        color: 0x8E81FF,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'abdomen',
        position: positions["abdomen"],
        opacity: 0.5,
        color: 0x27D1AA,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'head',
        position: positions["head"],
        opacity: 0.5,
        color: 0x45A6EA,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'hand',
        position: positions["hand"],
        opacity: 0.5,
        color: 0xF26563,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'arm',
        position: positions["arm"],
        opacity: 0.5,
        color: 0xA31621,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'shoulder',
        position: positions["shoulder"],
        opacity: 0.5,
        color: 0xFFD449,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'foot',
        position: positions["foot"],
        opacity: 0.5,
        color: 0x053C5E,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'ankle',
        position: positions["ankle"],
        opacity: 0.5,
        color: 0xFF6978,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'knee',
        position: positions["knee"],
        opacity: 0.5,
        color: 0x314CB6,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'arm',
        position: positions["arm"],
        opacity: 0.5,
        color: 0x47DAEB,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'leg',
        position: positions["leg"],
        opacity: 0.5,
        color: 0xCDC4FF,
        radius: 0.08,
        renderOrder: 0
    }, {
        id: 'hip',
        position: positions["hip"],
        opacity: 0.5,
        color: 0x0ECE6E,
        radius: 0.08,
        renderOrder: 0
    }

    ]

spheres.forEach(sphere => addSphere(scene, sphere.radius, sphere.color, sphere.opacity, sphere.position, sphere.id, sphere.renderOrder));

animate(scene, raycaster, camera);


function onPointerMove(event) {
    const bound = event.target.getBoundingClientRect();
    const relativeX = event.clientX - bound.left;
    const relativeY = event.clientY - bound.top;

    pointer.x = (relativeX / container.clientWidth) * 2 - 1;
    pointer.y = - (relativeY / container.clientHeight) * 2 + 1;
}


let timer;
function stopSpinning() {
    controls.autoRotate = false;
    clearTimeout(timer);
    timer = setTimeout(() => { controls.autoRotate = true; controls.isSpinning = true; }, 5000);
}

let zoomControlsTarget;
let zoomControlsCamera;

function onClick(event) {
    stopSpinning();
	stopZoomMove();

    raycaster.setFromCamera(pointer, camera);
    const intersects = raycaster.intersectObjects(scene.children);

    if (intersects.length > 0) {
        const target = intersects[0];
        const targetPosition = target.object.position;
        let length = 1;

        const nextCameraPosition = new THREE.Vector3(camera.position.x, camera.position.y, camera.position.z).setLength(length);
		if (zoomOutTweenControls != null) zoomOutTweenControls.stop();

        zoomControlsTarget = new TWEEN.Tween(controls.target).to({ x: targetPosition.x, y: targetPosition.y, z: targetPosition.z }, 800).easing(TWEEN.Easing.Cubic.Out).start()
        zoomControlsCamera = new TWEEN.Tween(camera.position).to(nextCameraPosition, 800).easing(TWEEN.Easing.Cubic.Out).start()
    }
}

canvas.addEventListener('pointermove', onPointerMove);
canvas.addEventListener('click', onClick);


let zoomOutTweenControls;
let initialDistance = null;
let lastDistance = null;

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

document.addEventListener('touchstart', onTouchStart);
document.addEventListener('touchmove', onTouchMove, { passive: false });
document.addEventListener('touchend', onTouchEnd);


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