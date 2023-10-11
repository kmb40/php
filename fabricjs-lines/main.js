console.log('Hi this is the "Lines" indexjs file')

let canvas = new fabric.Canvas('canvas', { // Create new canvas

    width: window.innerWidth, // Sets for full browser window width
    height: window.innerHeight // Sets for full browser window height
});

// Set var for line button
let addingLineBtn = document.getElementById('adding-line-btn'); 
let addingLineBtnClicked = false;

// Add event listener for button click for function
addingLineBtn.addEventListener('click', activateAddingLine); 

// Function to draw, move, and stop drwaing line
function activateAddingLine() {
    if(addingLineBtnClicked === false) {
        addingLineBtnClicked = true;
        canvas.on('mouse:down', startAddingLine);
        canvas.on('mouse:move', startDrawingLine);
        canvas.on('mouse:up', stopDrawingLine);
    
        canvas.selection = false;
        canvas.hoverCursor = 'auto';

        objectSelectability('added-line', false);
        
    }
 
}
let line; // Set Global Var
let mouseDown = false; // Set initial state

function startAddingLine (o) { // Creates starting poing of line
    mouseDown = true;

    let pointer = canvas.getPointer(o.e); // Locates the cursor

    line = new fabric.Line([pointer.x, pointer.y, pointer.x, pointer.y], { // Draw line
        id: 'added-line',
        stroke: 'red',
        strokeWidth: 3,
        selectable: false
    });
   // console.log(pointer.x);
   // console.log(pointer.y);
   canvas.add(line);
   canvas.requestRenderAll();
}

function startDrawingLine (o) {
    if (mouseDown === true) { // Only draw when mouse down 
    let pointer = canvas.getPointer(o.e); // Locates the cursor

    line.set({  // Set to new position when moved
        x2: pointer.x,
        y2: pointer.y
    });

    canvas.requestRenderAll()

    }
}

function stopDrawingLine () {
    line.setCoords(); // Gathers coordinates of a line object on the canvas so that canvas knows where the line is so that it can be selected 
    mouseDown = false;
}

// Set var for deactivate button
let deactivateAddiingShapeBtn = document.getElementById('deactivate-adding-shape-btn');

// Add event listener for deactivate button click for function
deactivateAddiingShapeBtn.addEventListener('click', deactivateAddiingShape);

// Function for deactivating line drawing
function deactivateAddiingShape() {
    canvas.off('mouse:down', startAddingLine);
    canvas.off('mouse:move', startDrawingLine);
    canvas.off('mouse:up', stopDrawingLine);

    objectSelectability('added-line', true);

    canvas.hoverCursor = 'all-scroll';
    addingLineBtnClicked = false;
}
// Function that controls whether an object is selectable or not
function objectSelectability (id, value) {

    canvas.getObjects().forEach(o => {
        if(o.id === id) {
            o.set({
                selectable: value
            });
        }
    });

}

// When a selected item is double clicked
canvas.on('mouse:dblclick', addingControlPoints);

// Function for adding points (circles) at the ends of the line 
function addingControlPoints(o) {
    console.log('You Double Clicked');
    let obj = o.target;

    let pointer1 = new fabric.Circle({
        radius: obj.strokeWidth*3,
        fill: 'blue',
        opacity: 0.5,
        top: obj.y1,
        left: obj.x1,
        originX: 'center',
        originY: 'center'
    });

    let pointer2 = new fabric.Circle({
        radius: obj.strokeWidth*3,
        fill: 'blue',
        opacity: 0.5,
        top: obj.y2,
        left: obj.x2,
        originX: 'center',
        originY: 'center'
    });

    canvas.add(pointer1, pointer2);
    canvas.requestRenderAll();

}
