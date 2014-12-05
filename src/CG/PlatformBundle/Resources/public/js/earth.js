
// Display objects
var container;
var camera, scene, renderer;
var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;

// Displayed object
var earthMesh;

// Mouse object
var mouse = {x : -0.01, y : 0, isClicked: false};

var objects = [];

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
	var manager = new THREE.LoadingManager();
	var texture = new THREE.Texture();

	var onProgress = function ( xhr ) {
		console.log('On Progress')
	};

	var onError = function ( xhr ) {
		//console.log('An error has occured');
		console.log(xhr)
	};

	var loader = new THREE.ImageLoader( manager );
	loader.load( '../img/earthTexture.jpg', function ( image ) {
		texture.image = image;
		texture.needsUpdate = true;
	}, onProgress, onError);

	var geometry   = new THREE.SphereGeometry(0.5, 32, 32)
	var material  = new THREE.MeshPhongMaterial()
	material.map = texture
	earthMesh = new THREE.Mesh(geometry, material)

	scene.add(earthMesh)

	d3.csv("../data/data.csv", type, function(error, data) {
		data.forEach( function(value,index,array) {
			var lat = value.lat
			var lon =  value.lon

			var pos = latLongToVector3(lat, lon, 0.5, 0)

			var geometry = new THREE.SphereGeometry(0.02,32,32);
			var material = new THREE.MeshLambertMaterial( { color: 0xE61E17 , ambient: 0x909090} );
			material.transparent = true;
			material.opacity = 0.8;
			var pin = new THREE.Mesh( geometry, material );
			pin.position.x = pos.x;
			pin.position.y = pos.y;
			pin.position.z = pos.z;

			pin.name = value.link;

			objects.push(pin);

			earthMesh.add(pin);
		});

		console.log(objects)
	});

	// Rendering
	renderer = new THREE.WebGLRenderer({alpha:true});
	renderer.setClearColor( 0xffffff, 1);
	renderer.setSize(window.innerWidth/2, window.innerHeight/2);
	container.appendChild( renderer.domElement );

	window.addEventListener( 'resize', onWindowResize, false );

}

function type(d)
{
	d.value = +d.value;
	return d;
}

function onWindowResize()
{
	windowHalfX = window.innerWidth / 2;
	windowHalfY = window.innerHeight / 2;

	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();

	renderer.setSize( window.innerWidth/2, window.innerHeight/2 );
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
		//console.log(objects)
		var projector = new THREE.Projector();
		var mouse3D = new THREE.Vector3( ( event.clientX / window.innerWidth ) * 2 - 1,   //x
		-( event.clientY / window.innerHeight ) * 2 + 1,  //y
		0.5 );                                            //z
		var raycaster = projector.pickingRay( mouse3D.clone(), camera );
		// Intercept the position of the click
		var intersects = raycaster.intersectObjects( objects );

		if ( intersects.length > 0 ) {
			var object = intersects[ 0 ].object
			object.onclick = window.open(object.name)
		}

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

		function latLongToVector3(lat, lon, radius, heigth) {
			var phi = (lat)*Math.PI/180;
			var theta = (lon-180)*Math.PI/180;

			var x = -(radius+heigth) * Math.cos(phi) * Math.cos(theta);
			var y = (radius+heigth) * Math.sin(phi);
			var z = (radius+heigth) * Math.cos(phi) * Math.sin(theta);

			return new THREE.Vector3(x,y,z);
		}
		
