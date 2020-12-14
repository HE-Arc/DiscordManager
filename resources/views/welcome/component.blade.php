@extends('layout.componant')
@section('openbody')
    <body onload="initWebGL();" width="100%"   >
@endsection

@section('script_include')
<script type="text/javascript" src="/js/glMatrix-0.9.5.min.js"></script>
<script type="text/javascript" src="/js/webgl-utils.js"></script>
<script type="text/javascript" src="/js/commonFunctions.js"></script>
<script type="text/javascript" src="/js/paralax.js"></script>
@endsection


@section('webgl_include')
<script id = "shader-vs" type = "x-shader/x-vertex">
	// Input variables
	attribute vec3 aVertexPosition;
	attribute vec2 aTextureCoord;

    uniform mat4 uMVMatrix; // Model View Matrix: Used to change the 3D coordinates from world to camera view.
    uniform mat4 uPMatrix; // Projection Matrix; Used to project 3D coordinates into 2D coordinates.

	// Output variables
	varying vec2 vTextureCoord;

    void main(void) {
        gl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition, 1.0);
		vTextureCoord = aTextureCoord;
    }
</script>

<!-- Fragment Shader: Sets the right color for every fragment (pixel). -->
<script id = "shader-fs" type = "x-shader/x-fragment">
    precision mediump float;
	varying vec2 vTextureCoord;

	uniform sampler2D uSampler; // Sampler is the shader's way of representing the texture.
	uniform bool ubText; // Stores if we are currently displaying a pixel.

    void main(void) {
		float s = vTextureCoord.s;
		float t = vTextureCoord.t;
		vec4 texelColor = texture2D(uSampler, vec2(s, t)); // gets the appropriate color from texture using coordinates (s, t)

		gl_FragColor = texelColor;
    }
</script>

@endsection

    @section('script')
    </script>

<script type="text/javascript">


var vertexBuffer;
var colorBuffer;
var indexBuffer;
var textureCoordBuffer;
var indices;



var mvMatrix = mat4.create();
var pMatrix = mat4.create();

var xPos = 0.0;
var yPos = 0.0;
var zPos = 0.0;


var gl;

function initWebGL() {
    var canvas = document.getElementById("canvas-exercice");
    try {
        gl = canvas.getContext("experimental-webgl");
        gl.viewportWidth = canvas.width;
        gl.viewportHeight = canvas.height;
    } catch (e) {
        alert(e);
    }
    if (!gl) {
        alert("Could not initialise WebGL.");
    }

    document.body.onmousemove = handleMouseMove;

    initShaders(gl);
    initShaderParameters();
    initBuffers();
    var hour = new Date().getHours();


    if(hour > 23 || hour < 6){
        // charge la texture de nuit
        texture0 = initTexture(gl, "/test2.png");
    }else if (hour>22) {
        // charge la texture du soir
        texture0 = initTexture(gl, "/test2.png");
    }else if (hour<9) {
        // charge la texture du matin
        texture0 = initTexture(gl, "/test2.png");
    }else {
        // charge la texture de jour
        texture0 = initTexture(gl, "/test2.png");
    }

    tick();
}
</script>
@endsection

@section('banner')
    <canvas id="canvas-exercice" style="border: none;" width="4000" height="1390" ></canvas>
@endsection

@section('footer')
    <!-- Footer -->
    <footer class="page-footer ">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3 footer">
            <a>footer</a>
        </div>
        <!-- Copyright -->
    </footer>

@endsection
