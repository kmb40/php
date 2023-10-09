console.log('Hi this is the indexjs file')

//// Function to draws canvas
//const canvas = new fabric.Canvas('canvas',{
//
//    width: 500,
//    height: 500,
//    //backgroundColor: 'red'
//});
//
//canvas.renderAll(); // Renders function
//
//// Fundtion to set background of canvas
//fabric.Image.fromURL('https://placehold.co/500x500',(img) => {
//
//    canvas.backgroundImage = img
//    canvas.renderAll();
//})

// Function to draw canvas
const initCanvas = (id) => {
    return new fabric.Canvas(id, {
        width: 500,
        height: 500,
        selection: false
        });
}
// Canvas background function
const setBackground = (url, canvas) => {

    fabric.Image.fromURL(url,(img) => {
    canvas.backgroundImage = img
    canvas.renderAll();
})
}

// Toggle function
const toggleMode = (mode) => {
    if(mode === modes.pan) {
        if (currentMode === 'pan') {
            currentMode = ''
        } else {
            currentMode = modes.pan
            canvas.isDrawingMode = false
            canvas.renderAll()
        }
    } else if (mode === modes.drawing) {
        if(currentMode === modes.drawing) {
            currentMode = ''
            canvas.isDrawingMode = false
            canvas.renderAll()
        } else {
            // Start Handles Fancy Brush
            canvas.freeDrawingBrush = new fabric.SprayBrush(canvas) // Set Brush Type
            canvas.freeDrawingBrush.color = 'red' // Set brush color BaseBrush
            canvas.freeDrawingBrush.width = 15 // Set brush width BaseBrush
            // End Handles Fancy Brush

            currentMode = modes.drawing
            canvas.isDrawingMode = true
            canvas.renderAll()
        }
    }
    console.log(mode)
}

// Set Pan (grab and move image background inside of canvas) to be controlled with a button

const setPanEvents = (canvas) => {
    // Mouse over
    canvas.on('mouse:move', (event) => {
        //console.log(e)
        if(mousePressed && currentMode === modes.pan){
        canvas.setCursor('grab')
        canvas.renderAll()
        const mEvent = event.e;
        const delta = new fabric.Point(mEvent.movementX, mEvent.movementY)
        canvas.relativePan(delta)
        } else if (mousePressed && currentMode === modes.drawing) {
          //  canvas.isDrawingMode = true
          //  canvas.renderAll()
        }
    })

    // Track mouse up and down 
    canvas.on('mouse:down', (event) => {
        mousePressed = true;
        if (currentMode === modes.pan){
        canvas.setCursor('grab')
        canvas.renderAll()
        }
    })
    canvas.on('mouse:up', (event) => {
        mousePressed = false;
        canvas.setCursor('default')
        canvas.renderAll()
    })
}

// Call function to draw canvas
const canvas = initCanvas('canvas');
let mousePressed = false;

let currentMode;
const modes = {
    pan: 'pan',
    drawing: 'drawing'
}

// Set image background
setBackground('https://placehold.co/500x500', canvas);
//https://www.agrimaccari.com/en/wp-content/uploads/2015/05/girl-500x500.jpg

setPanEvents(canvas) // Call pan handling. No pun intended