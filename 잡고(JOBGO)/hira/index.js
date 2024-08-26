import * as THREE from 'three'
import { OrbitControls } from 'three/addons/controls/OrbitControls.js'
import { OBJLoader } from 'three/addons/loaders/OBJLoader.js';
import './style.css';
import myObj from './static/example_mesh.obj';
import textureImg from './static/texture.png';
import { GUI } from 'dat.gui';

const pointer = new THREE.Vector2();

function onPointerMove(event) {
    const bound = event.target.getBoundingClientRect();
    const relativeX = event.clientX - bound.left;
    const relativeY = event.clientY - bound.top;


    pointer.x = (relativeX / container.clientWidth) * 2 - 1;
    pointer.y = - (relativeY / container.clientHeight) * 2 + 1;
}

window.addEventListener('pointermove', onPointerMove);

function initScene() {
    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0xEAEDED);
    return scene;
}

function initLoader() {
    return new OBJLoader();
}

function setLight() {
    const light = new THREE.HemisphereLight(0xeeeeee, 0x666666, 1);
    scene.add(light);
}

const gui = new GUI();

function loadPerson(scene) {
    loader.load(
        myObj,
        function (object) {
            const texture = new THREE.TextureLoader().load(textureImg);

            object.traverse(function (child) {
                if (child instanceof THREE.Mesh) {
                    // child.geometry.computeVertexNormals();
                    // child.material.map = texture;

                    // const plane = new THREE.Plane(new THREE.Vector3(0, -1, 0), 0.2);
                    // const material = new THREE.MeshPhongMaterial({ side: THREE.DoubleSide, clipShadows: true, clippingPlanes: [plane] });
                    // child.material = material;


                    const cubeFolder = gui.addFolder('Cube');

                    const materialParams = {
                        color: 0x000000,
                    };

                    // cubeFolder.add(object.rotation, 'x', 0, Math.PI * 2);
                    cubeFolder.addColor(materialParams, 'color').onChange((value) => child.material.color.set(value));
                    cubeFolder.open();

                }
            })
            scene.add(object);
        },
        // called when loading is in progresses
        function (xhr) {
            console.log((xhr.loaded / xhr.total * 100) + '% loaded');
        },
        // called when loading has errors
        function (error) {
            console.log(error);
        }
    );
}

function initCamera(container) {
    const camera = new THREE.PerspectiveCamera(50, container.clientWidth / container.clientHeight, 0.1, 2000);
    camera.position.x = 0;
    camera.position.y = 1;
    camera.position.z = 2;
    return camera
}

function initRenderer(container) {
    const renderer = new THREE.WebGLRenderer({
        antialias: true
    });

    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;
    renderer.localClippingEnabled = true;
    container.appendChild(renderer.domElement);
    return renderer
}

function initControls(camera, renderer) {
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.rotateSpeed = 1.0;
    controls.zoomSpeed = 1.2;
    controls.panSpeed = 0.8;
    controls.minDistance = 1;
    controls.maxDistance = 100;

    controls.minPolarAngle = Math.PI / 2.5;
    controls.maxPolarAngle = Math.PI / 2.5;
    return controls;
}

function addSphere(scene, radius, color, opacity, position) {
    const geometry = new THREE.SphereGeometry(radius);
    const material = new THREE.MeshBasicMaterial({ color: color });
    material.transparent = true;
    material.opacity = opacity;
    const mesh = new THREE.Mesh(geometry, material);
    mesh.position.set(...position);
    scene.add(mesh);
}

let intersected = null;

function animate() {
    requestAnimationFrame(animate);

    raycaster.setFromCamera(pointer, camera);
    const intersects = raycaster.intersectObjects(scene.children);

    if (intersects.length > 0) {
        if (intersected != intersects[0].object) {
            if (intersected) {
                console.log(intersected)
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


    renderer.render(scene, camera);
    controls.update();
}

const raycaster = new THREE.Raycaster();
const container = document.querySelector("#scene");
const scene = initScene();
const loader = initLoader();
const camera = initCamera(container);
const renderer = initRenderer(container, raycaster);
const controls = initControls(camera, renderer);


setLight();
let person;
loadPerson(scene);

const positions = {
    head: [0, 0.67, 0.01],
    knee: [0.1, -0.43, 0.05],
    hand: [0.4, 0, 0.1],
    chest: [],
    eyes: [],
    mouse: [],
    nose: [],
    ear: [],
    arm: [],
    shoulder: [-0.2, 0.5, -0.04],
    foot: [0.11, -0.8, 0.1],
    ankle: [],
    leg: [-0.1, -0.6, -0.06],
    hip: [],
    sto: [],
    pelvis: []
}

const spheres = [{
    position: positions["head"],
    opacity: 0.2,
    color: 0xffff00,
    radius: 0.15
}, {
    position: positions["knee"],
    opacity: 0.2,
    color: 0x00ff00,
    radius: 0.1
}, {
    position: positions["hand"],
    opacity: 0.2,
    color: 0xff0000,
    radius: 0.1
}, {
    position: positions["foot"],
    opacity: 0.2,
    color: 0xff00ff,
    radius: 0.1
}, {
    position: positions["leg"],
    opacity: 0.2,
    color: 0x00ffff,
    radius: 0.1
}, {
    position: positions["shoulder"],
    opacity: 0.2,
    color: 0x8E44AD,
    radius: 0.08
}]

spheres.forEach(sphere => addSphere(scene, sphere.radius, sphere.color, sphere.opacity, sphere.position));



animate(scene, raycaster, camera);





