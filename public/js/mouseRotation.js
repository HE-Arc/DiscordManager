var rotX = 0;
var rotY = 0;
var dragging = false;
var oldMousePos = {x: 0, y: 0};
var mousePos;
var rotSpeed = 3.0;

function handleMouseMove(event) {
	event = event || window.event;
	mousePos = {x: event.clientX, y: event.clientY};
	if (dragging) {
		dX = mousePos.x - oldMousePos.x;
		dY = mousePos.y - oldMousePos.y;
		rotY = dX > 0 ? rotSpeed: dX < 0 ? -rotSpeed: 0;
		rotX = dY > 0 ? rotSpeed: dY < 0 ? -rotSpeed: 0;
		oldMousePos = mousePos;
	}
}

function handleMouseDown(event) {
	dragging = true;
	oldMousePos.x = oldMousePos.y = 0;
}

function handleMouseUp(event) {
	dragging = false;
}

function rotateModelViewMatrixUsingQuaternion() {
	angle = degToRad(rotY);
	rotYQuat = quat4.create([0, Math.sin(angle/2.0), 0, Math.cos(angle/2.0)]);
	
	angle = degToRad(rotX);
	rotXQuat = quat4.create([Math.sin(angle/2.0), 0, 0, Math.cos(angle/2.0)]);
	
	myQuaternion = quat4.multiply(rotYQuat, rotXQuat);
	mvMatrix = mat4.multiply(quat4.toMat4(myQuaternion), mvMatrix);
	
	rotX = 0;
	rotY = 0;
}