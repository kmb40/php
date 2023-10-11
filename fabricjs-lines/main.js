console.log('Hi this is the "Lines" indexjs file')

let canvas = new fabric.Canvas('canvas', { // Create new canvas

    width: window.innerWidth, // Sets for full browser window width
    height: window.innerHeight // Sets for full browser window height
});

// Set var for line button
let addingLineBtn = document.getElementById('adding-line-btn'); 
let addingSingleArrowLineBtn = document.getElementById('adding-single-arrow-line-btn');

let addingLineBtnClicked = false;
let addingSingleLineArrowBtnClicked = false;

let line; // Set Global Var
let arrowHead1;
let mouseDown = false; // Set initial state

addingSingleArrowLineBtn.addEventListener('click', activateAddingSingleArrowLine);

function activateAddingSingleArrowLine() {
    if(addingSingleArrowLineBtn ===  false) {
        addingSingleArrowLineBtn = true;

        canvas.on({
            'mouse:down': startAddingSingleArrowLine,
            'mouse:move': startDrawingSingleArrowLine,
            'mouse:up': stopDrawingSingleArrowLine
        });

        canvas.selection = false;
        canvas.hoverCursor = 'auto';

        objectSelectability(false);
    }
}

// Draw single arrow function
function startAddingSingleArrowLine (o) {
    mouseDown = true;

    let pointer = canvas.getPointer(o.e); // Locates the cursor

    line = new fabric.Line([pointer.x, pointer.y, pointer.x, pointer.y], { // Draw line
        id: 'added-single-arrow-line',
        stroke: 'red',
        strokeWidth: 3,
        selectable: false,
        hasControls: false
    });

   arrowHead1 = new fabric.Polygon([
        {x:10, y:10},
        {x:-20, y:-10},
        {x:-20, y:10}
    ], {
        id: 'arrow-head',
        stroke: 'red',
        strokeWidth: 3,
        fill: 'red',
        selectable: false,
        hasControls: false,
        top: pointer.y,
        left: pointer.x
    });

   canvas.add(line, arrowHead1);
   canvas.requestRenderAll();
}

function startDrawingSingleArrowLine () {
    
}

function stopDrawingSingleArrowLine () {
    
}


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

    objectSelectability(true);

    canvas.hoverCursor = 'all-scroll';
    addingLineBtnClicked = false;
}
// Function that controls whether an object is selectable or not
function objectSelectability (value) {
    canvas.getObjects().forEach(o => {
        o.set({
            selectable: value
        });
    });

}

