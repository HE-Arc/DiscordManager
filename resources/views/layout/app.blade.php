
<!doctype html>
<html lang="en">
<head>
    <!-- layout app -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Discord Manager</title>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome-->
    <script src="https://kit.fontawesome.com/60010d6147.js" crossorigin="anonymous"></script>
    <link href="/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="/js/glMatrix-0.9.5.min.js"></script>
    <script type="text/javascript" src="/js/webgl-utils.js"></script>
    <script type="text/javascript" src="/js/commonFunctions.js"></script>

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

    <script type="text/javascript">
        function initShaderParameters() {
            // Bridge between CPU and GPU
            shaderProgram.vertexPositionAttribute = gl.getAttribLocation(shaderProgram, "aVertexPosition");
            gl.enableVertexAttribArray(shaderProgram.vertexPositionAttribute);

            shaderProgram.textureCoordAttribute = gl.getAttribLocation(shaderProgram, "aTextureCoord");
            gl.enableVertexAttribArray(shaderProgram.textureCoordAttribute);

            shaderProgram.mvMatrixUniform = gl.getUniformLocation(shaderProgram, "uMVMatrix");
            shaderProgram.pMatrixUniform = gl.getUniformLocation(shaderProgram, "uPMatrix");
            shaderProgram.ubTextUniform = gl.getUniformLocation(shaderProgram, "ubText");
        }


        var vertexBuffer;
        var colorBuffer;
        var indexBuffer;
        var textureCoordBuffer;
        var indices;

        function initBuffers() {

            var vertices = [  //indices des 5 plans du parallax

                //background
                -1.0, -1.0, 0.0,
                1.0, -1.0, 0.0,
                1.0,  1.0, 0.0,
                -1.0,  1.0, 0.0,

                -1.0, -1.0, 0.15,
                1.0, -1.0, 0.15,
                1.0,  1.0, 0.15,
                -1.0,  1.0, 0.15,

                -1.0, -1.0, 0.3,
                1.0, -1.0, 0.3,
                1.0,  1.0, 0.3,
                -1.0,  1.0, 0.3,

                -1.0, -1.0, 0.45,
                1.0, -1.0, 0.45,
                1.0,  1.0, 0.45,
                -1.0,  1.0, 0.45,

                //texte
                -1.0, -1.0, 0.6,
                1.0, -1.0, 0.6,
                1.0,  1.0, 0.6,
                -1.0,  1.0, 0.6
            ];
            vertexBuffer = constructVertexBuffer(vertices.map(function(x) {return x*1.1}));

            var textureC = [ // coordonÃ©Ã©es des textures a charger
                0.0, 0.0,
                1.0, 0.0,
                1.0, 0.2,
                0.0, 0.2,

                0.0, 0.2,
                1.0, 0.2,
                1.0, 0.4,
                0.0, 0.4,

                0.0, 0.4,
                1.0, 0.4,
                1.0, 0.6,
                0.0, 0.6,

                0.0, 0.6,
                1.0, 0.6,
                1.0, 0.8,
                0.0, 0.8,

                0.0, 0.8,
                1.0, 0.8,
                1.0, 1.0,
                0.0, 1.0

            ];

            textureCoordBuffer = constructVertexBuffer(textureC);

            indices = [
                16, 17, 18, 16, 18, 19,
                12, 13, 14, 12, 14, 15,
                8, 9, 10, 8, 10, 11,
                4, 5, 6, 4, 6, 7,
                0, 1, 2, 0, 2, 3];

            indexBuffer = constructIndexBuffer(indices);

        }

        var mvMatrix = mat4.create();
        var pMatrix = mat4.create();

        var xPos = 0.0;
        var yPos = 0.0;
        var zPos = 0.0;

        function initTexture(gl, fileName) {
            var myTexture;
            myTexture = gl.createTexture();
            myTexture.image = new Image();
            myTexture.image.crossOrigin = "anonymous";
            myTexture.image.onload = function() {
                handleLoadedTexture (myTexture, gl); // this is a callback
                //console.log("finished handling");
            }

            myTexture.image.src = fileName;
            return myTexture
        }

        function handleLoadedTexture(texture, gl) {
            gl.bindTexture(gl.TEXTURE_2D, texture); // Sets current texture
            gl.pixelStorei(gl.UNPACK_FLIP_Y_WEBGL, true); // Flip loaded image vertically (to match local coordinate system)
            gl.pixelStorei(gl.UNPACK_PREMULTIPLY_ALPHA_WEBGL, true);
            gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, texture.image); // Load image to the texture space
            // Utilisation d'une approximation linÃ©aire pour Ã©viter des problÃ¨mes d'aliasing
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR); // Scaling things
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
            gl.bindTexture(gl.TEXTURE_2D, null); // set current texture to null (good practice)
        }

        function drawScene() {
            gl.clearColor(1.0, 0.0, 0.0, 1.0);
            gl.enable(gl.DEPTH_TEST); // Only the visible parts are drawn.
            gl.viewport(0, 0, gl.viewportWidth, gl.viewportHeight);
            gl.clear(gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);
            gl.enable(gl.BLEND); // Enable trasparency (on floating text)
            gl.blendFunc(gl.ONE, gl.ONE_MINUS_SRC_ALPHA);
            // mat4.perspective(45, gl.viewportWidth / gl.viewportHeight, 0.1, 100.0, pMatrix);

            mat4.identity(mvMatrix);
            mat4.identity(pMatrix);
            gl.uniform1i(shaderProgram.ubTextUniform, false);

            mat4.translate(mvMatrix, [xPos, yPos, zPos]);

            gl.uniformMatrix4fv(shaderProgram.pMatrixUniform, false, pMatrix);
            gl.uniformMatrix4fv(shaderProgram.mvMatrixUniform, false, mvMatrix);

            gl.bindBuffer(gl.ARRAY_BUFFER, vertexBuffer);
            gl.vertexAttribPointer(shaderProgram.vertexPositionAttribute, 3, gl.FLOAT, false, 0, 0);

            gl.bindBuffer(gl.ARRAY_BUFFER, textureCoordBuffer);
            gl.vertexAttribPointer(shaderProgram.textureCoordAttribute, 2, gl.FLOAT, false, 0, 0);

            /*Load and rotate all textures*/

            mat4.identity(mvMatrix);
            mat4.rotate(mvMatrix, degToRad(rotY), [0, 1, 0]);

            gl.uniformMatrix4fv(shaderProgram.mvMatrixUniform, false, mvMatrix);

            gl.activeTexture(gl.TEXTURE0); // Texture 0
            gl.bindTexture(gl.TEXTURE_2D, texture0);
            gl.uniform1i(shaderProgram.samplerUniform, 0);// Last argument is texture number

            gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, indexBuffer);
            gl.drawElements(gl.TRIANGLES, indices.length, gl.UNSIGNED_SHORT, 0);
        }

        var rotY = 0;
        var rotYdest = 0;
        var mousePos;
        var lastTime = 0;

        function animate() {
            // Rend les mouvements brusques de la souris plus fluides
            var delta = rotYdest-rotY;
            if(delta>0){
                rotY+=Math.min(delta, 0.35);
            }
            else{
                rotY+=Math.max(delta, -0.35);
            }
        }

        function tick() {
            // In webgl-utils.js - used by web browser to request refresh.
            requestAnimFrame(tick);
            drawScene();
            animate();
        }

        function handleMouseMove(event) {
            event = event || window.event;
            mousePos = {x: event.clientX, y: event.clientY};
            dX = 1.0*mousePos.x/window.innerWidth*gl.viewportWidth - (gl.viewportWidth/2);

            rotYdest = dX/100;
        }

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

            //Test des diffÃ©rentes variantes
            //Matin
            //hour=8;
            //JournÃ©e
            //hour=13;
            //Soir
            //hour=20;
            //Nuit
            //hour=23;

            //charge la bonne texture en fonction de l'heure cÃ´tÃ© client
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


</head>

<body onload="initWebGL();" width="100%">
<header>
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="#">Discord Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ml-auto">
            @if (Session::has('discord_token'))
                @if (Route::has('home'))
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route("home")}}">Home <i class="fas fa-home"></i></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route("test")}}">TEST API<i class="fab fa-discord"></i></a>
                    </li>
                @endif
                    <li class="nav-item active">
                        <a class="nav-link" href=""> <i class="fas fa-home"></i></a>
                    </li>

            @else
                <li class="nav-item active">
                    <a class="nav-link" href="{{route("login")}}">Login with Discord <i class="fab fa-discord"></i></a>
                </li>
            @endif
        </ul>
    </nav>
</header>



<canvas id="canvas-exercice" style="border: none;" width="4000" height="1390" ></canvas>
@yield('content')


</body>
</html>
