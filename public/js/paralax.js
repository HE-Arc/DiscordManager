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
