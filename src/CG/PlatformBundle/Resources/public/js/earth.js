
// Display objects
var container;
var camera, scene, renderer;
var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;

// Displayed object
var earthMesh;

// Mouse object
var mouse = {x : 0, y : 0, isClicked: false};

init();
animate();


function init()
{
	container = document.getElementById("canvas_container")

	// Camera
	camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.01, 1000 );
	camera.position.x = 0;
	camera.position.y = 0;
	camera.position.z = 1.5;

	// Scene
	scene = new THREE.Scene();
	scene.add( camera );

	// Light
	var light	= new THREE.AmbientLight( 0xaaaaaa )
	scene.add( light )

	var light	= new THREE.DirectionalLight( 0xaaaaaa, 1 )
	light.position.set(5,3,5)
	scene.add( light )

	// EarthMesh
	var geometry   = new THREE.SphereGeometry(0.5, 32, 32)
	var material  = new THREE.MeshPhongMaterial()
	material.map = THREE.ImageUtils.loadTexture('earthmap1k.jpg')
	earthMesh = new THREE.Mesh(geometry, material)

	scene.add(earthMesh)

	// Rendering
	renderer = new THREE.WebGLRenderer({alpha:true});
	renderer.setClearColor( 0xeeeeee, 1);
	renderer.setSize(window.innerWidth, window.innerHeight);
	container.appendChild( renderer.domElement );

	window.addEventListener( 'resize', onWindowResize, false );

}

function onWindowResize()
{
	windowHalfX = window.innerWidth / 2;
	windowHalfY = window.innerHeight / 2;

	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();

	renderer.setSize( window.innerWidth, window.innerHeight );
}


document.addEventListener('mousemove', function(event)
{
	if(mouse.isClicked)
		{
			mouse.x	= (event.clientX / window.innerWidth ) - 0.5
			mouse.y	= (event.clientY / window.innerHeight) - 0.5
		}
	}, false)

	document.addEventListener('mousedown', function(event)
	{
		mouse.isClicked = true;
	})

	document.addEventListener('mouseup', function(event)
	{
		mouse.isClicked = false;
		mouse.x = 0;
		mouse.y = 0;
	})

	function animate()
	{
		requestAnimationFrame( animate );
		render();
	}

	function render()
	{
		if(!( (mouse.y>0 && earthMesh.rotation.x>1) || (mouse.y<0 && earthMesh.rotation.x<-1) ) )
			{
				earthMesh.rotation.x += mouse.y/10
			}
			earthMesh.rotation.y += mouse.x/5

			camera.lookAt( scene.position )

			renderer.render( scene, camera );
		}
