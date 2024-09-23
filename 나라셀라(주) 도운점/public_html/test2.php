<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Load OBJ File with Three.js</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r133/three.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r133/loaders/OBJLoader.min.js"></script>
</head>
<body>
  <div id="model-container"></div>
  <script>
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 5;

    var renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.getElementById("model-container").appendChild(renderer.domElement);

    var objLoader = new THREE.OBJLoader();
    var objUrl = 'path_to_your_obj_file.obj'; // OBJ 파일 경로를 수정하세요.

    objLoader.load(objUrl, function(obj) {
      scene.add(obj);
    });

    function animate() {
      requestAnimationFrame(animate);
      renderer.render(scene, camera);
    }

    animate();
  </script>
</body>
</html>