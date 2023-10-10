console.log('Hi this is the "Lines" indexjs file')

let canvas = new fabric.Canvas('canvas', { // Create new canvas

    width: window.innerWidth, // Sets for full browser window width
    height: window.innerHeight // Sets for full browser window height
});

let addingLineBtn = document.getElementById('adding-line-btn'); // Set var for line button

addingLineBtn.addEventListener('click', activateAddingLine); // Functon for button click

// Function to draw, move, and stop drwaing line
function activateAddingLine() {
    canvas.on('mouse:down', startAddingLine);
    canvas.on('mouse:move', startDrawingLine);
    canvas.on('mouse:up', stopDrawingLine);

    canvas.selection = false;
}
let line; // Set Global Var
let mouseDown = false; // Set initial state

function startAddingLine (o) { // Creates starting poing of line
    mouseDown = true;

    let pointer = canvas.getPointer(o.e); // Locates the cursor

    line = new fabric.Line([pointer.x, pointer.y, pointer.x, pointer.y], { // Draw line
        stroke: 'red',
        strokeWidth: 3
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
    mouseDown = false;
}