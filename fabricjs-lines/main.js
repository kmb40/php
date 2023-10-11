console.log('Hi this is the "Lines" indexjs file')

let canvas = new fabric.Canvas('canvas', { // Create new canvas

    width: window.innerWidth, // Sets for full browser window width
    height: window.innerHeight // Sets for full browser window height
});

// Set var for line button
let addingLineBtn = document.getElementById('adding-line-btn'); 
let addingSingleArrowLineBtn = document.getElementById('adding-single-arrow-line-btn');

let addingLineBtnClicked = false;
let addingSingleArrowLineBtnClicked = false;

let line; // Set Global Var
let arrowHead1; // Set Global Var
let mouseDown = false; // Set initial state

addingSingleArrowLineBtn.addEventListener('click', activateAddingSingleArrowLine);

function activateAddingSingleArrowLine() {
    if(addingSingleArrowLineBtnClicked ===  false) {
        addingSingleArrowLineBtnClicked = true;

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

    // Controls arrow head
   arrowHead1 = new fabric.Polygon([
        {x:0, y:0},
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
        left: pointer.x,
        originX: 'center',
        originY: 'center'
    });

   canvas.add(line, arrowHead1);
   canvas.requestRenderAll();
}

function startDrawingSingleArrowLine (o) {
    // Arrow drawing geometry logic detailed
    // https://youtu.be/tGycvFh723U?list=PL-gIJFyHJjykXg776HNz3H7XXzBMSu5mL&t=187

    if (mouseDown === true) { // Only draw when mouse down 
        let pointer = canvas.getPointer(o.e); // Locates the cursor coordinates
    
        line.set({  // Set to the starting position when mousedown
            x2: pointer.x,
            y2: pointer.y
        });
    
        arrowHead1.set({ // Make the arrow head follow the cursor
            left: pointer.x,
            top: pointer.y,
        });

        // Find vertical and horizontal heights
        let x1 = line.x1; // Set line horizontal location
        let y1 = line.y1; // Set line vertical location
        let x2 = pointer.x; // Set cursor horizontal location
        let y2 = pointer.y; // Set cursor vertical location

        let verticalHeight = Math.abs(y2-y1);
        let horizontalWidth = Math.abs(x2-x1);

        let tanRatio = verticalHeight/horizontalWidth;
        let basicAngle = Math.atan(tanRatio)*180/Math.PI;

        if(x2>x1) {
            if(y2<y1) {
                arrowHead1.set({ // Make the arrow head angle adjust to the cursor
                    angle: -basicAngle
                });
            }
            else if(y2 === y1) {
                arrowHead1.set({ // Make the arrow head angle adjust to the cursor
                    angle: 0
                });
            }
            else if(y2>y1) {
                arrowHead1.set({ // Make the arrow head angle adjust to the cursor
                    angle: basicAngle
                });
            }
        }

        else if(x2<x1) {
            if(y2>y1) {
                arrowHead1.set({ // Make the arrow head angle adjust to the cursor
                    angle: 180-basicAngle
                });
            }
            else if(y2 === y1) {
                arrowHead1.set({ // Make the arrow head angle adjust to the cursor
                    angle: 180
                });
            }
            else if(y2<y1) {
                arrowHead1.set({ // Make the arrow head angle adjust to the cursor
                    angle: 180+basicAngle
                });
            }
        }

        //console.log(basicAngle);
        line.setCoords();
        arrowHead1.setCoords();
        canvas.requestRenderAll();
    
        }
}

function stopDrawingSingleArrowLine () {
    line.setCoords(); // Gathers coordinates of a line object on the canvas so that canvas knows where the line is so that it can be selected 
    mouseDown = false;
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
let deactivateAddingShapeBtn = document.getElementById('deactivate-adding-shape-btn');

// Set var for arrow deactivate button
let deactivateAddingArrowBtn = document.getElementById('deactivate-adding-single-arrow-btn');

// Add event listener for deactivate button click for function
deactivateAddingShapeBtn.addEventListener('click', deactivateAddingShape);

// Add event listener for arrow deactivate button click for function
deactivateAddingArrowBtn.addEventListener('click', deactivateAddingArrow);

// Function for deactivating line drawing
function deactivateAddingShape() {
    canvas.off('mouse:down', startAddingLine);
    canvas.off('mouse:move', startDrawingLine);
    canvas.off('mouse:up', stopDrawingLine);

    objectSelectability(true);

    canvas.hoverCursor = 'all-scroll';
    addingLineBtnClicked = false;
}

// Function for deactivating line drawing
function deactivateAddingArrow() {
    canvas.off({
        'mouse:down': startAddingSingleArrowLine,
        'mouse:move': startDrawingSingleArrowLine,
        'mouse:up': stopDrawingSingleArrowLine
    });

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

