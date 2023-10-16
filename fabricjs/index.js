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
            /*
            canvas.freeDrawingBrush = new fabric.SprayBrush(canvas) // Set Brush Type
            canvas.freeDrawingBrush.color = 'red' // Set brush color BaseBrush
            canvas.freeDrawingBrush.width = 15 // Set brush width BaseBrush
            */
            // End Handles Fancy Brush

            currentMode = modes.drawing
            canvas.freeDrawingBrush.color = color
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

// Color listener function. Update color var and brush color when color is changed
const setColorListener = () => {
    const picker = document.getElementById ('colorPicker')
    picker.addEventListener('change', (event) => {
        console.log(event.target.value)
        color = event.target.value // '#' + was not needed before event.target.value. It in fact caused an the color not to change
        canvas.freeDrawingBrush.color =  color
        canvas.renderAll()
    })
}
// Clear canvas function
const clearCanvas = (canvas, state) => {
    state.val = canvas.toSVG()
    canvas.getObjects().forEach((o) => { // Loads all objects into an array
        if(o !== canvas.backgroundImage) { // Removes everything from the array except the background image
            canvas.remove(o)
        }
    })
}
// Restore canvas function
const restoreCanvas = (canvas, state, bgUrl) => {
    if(state.val) {
        //canvas.clearCanvas()
        fabric.loadSVGFromString(state.val, objects => {
            console.log(objects)
            objects = objects.filter(o => o['xlink:href'] !== bgUrl)
            canvas.add(...objects)
            canvas.requestRenderAll()
        })
    } 
}

// Rectangle Object
const createRect = (canvas) => {
    console.log("rect")
    const canvCenter = canvas.getCenter() // Captures center of object
    const rect = new fabric.Rect({
        width: 100,
        height: 100,
        stroke: 'red',
        strokeWidth: 3,
        fill: 'transparent', // Sets fill color of object. Set to 'transparent' for empty.
       // stroke: 'white', // Sets stroke of object
       // strokeWidth: 5, // Sets stroke width of object
        left: canvCenter.left, // Sets initial left position of object
        top: canvCenter.top, // Sets initial top position of object
        originX: 'center',
        origninY: 'center',
        cornerColor: 'white'
    })
    canvas.add(rect)
    canvas.renderAll()
}

// Circle Object
const createCirc = (canvas) => {
    console.log("circ")
    const canvCenter = canvas.getCenter() // Captures center of object
    const circle = new fabric.Circle({
        radius: 50,
        stroke: 'red',
        strokeWidth: 3,
        fill: 'transparent', // Sets fill color of object. Set to 'transparent' for empty.
       // stroke: 'white', // Sets stroke of object
       // strokeWidth: 5, // Sets stroke width of object
        left: canvCenter.left, // Sets initial left position of object
        top: canvCenter.top, // Sets initial top position of object
        originX: 'center',
        origninY: 'center',
        cornerColor: 'white'
    })
    canvas.add(circle)
    canvas.renderAll()
}

// Arrow Object
const createArrow = (canvas) => {
    console.log("arrow")

    var site_url = '/img/red-up-right-arrow-16789.svg';

    fabric.loadSVGFromURL(site_url, function(objects) {
      var group = new fabric.Group(objects, {
        id: 'arrow',
        left: canvas.width/2,
        top: canvas.height/2,
        width: 100,
        height: 100,
        cornerColor: 'white'
      });

        canvas.add(group);
        canvas.renderAll();
    });
     /*
      fabric.Image.fromURL(site_url, function(img) {
        canvas.add(img.set({ left: 400, top: 350, angle: 30 }).scale(0.25));
      });
     */ 

     // canvas.add(group);
     // canvas.renderAll();
    
    /*
    const canvCenter = canvas.getCenter() // Captures center of object
    const arrow = new fabric.line({
        strokeWidth: 3,
        fill: 'red', // Sets fill color of object. Set to 'transparent' for empty.
       // stroke: 'white', // Sets stroke of object
       // strokeWidth: 5, // Sets stroke width of object
        left: canvCenter.left, // Sets initial left position of object
        top: canvCenter.top, // Sets initial top position of object
        originX: 'center',
        origninY: 'center',
        cornerColor: 'white'
    })
    
    canvas.add(arrow)
    canvas.renderAll()
    */
}


// Object grouping functiopn
const groupObjects = (canvas, group, shouldGroup) => {
    if(shouldGroup) { // If Group button which passes the true parameter
        const objects = canvas.getObjects() // Group objects that are on the canvas
        group.val = new fabric.Group(objects, {cornerColor: 'white'}) // Outline group with white border
        clearCanvas(canvas, svgState)
        canvas.add(group.val)
        canvas.setActiveObject(group.val) // Added by KMB to highlight objects once grouped
        canvas.requestRenderAll()
    } else { // If Ungroup button which passes the false parameter
        group.val.destroy() // Ungroup objects that are in a group
        let oldGroup = group.val.getObjects()
        clearCanvas(canvas, svgState)
        //canvas.remove(group.val)
        canvas.add(...oldGroup)
        group.val = null
        canvas.requestRenderAll()
    }
}

// Call function to draw canvas
const canvas = initCanvas('canvas')
const svgState = {}
let mousePressed = false
let color = '#000000'
const group = {} //creates an empty object and assigns it to the constant variable "group"
const bgUrl = 'https://placehold.co/500x500'

let currentMode;

const modes = {
    pan: 'pan',
    drawing: 'drawing'
}

// Key stroke logging testing
let x = canvas.width
let y = canvas.height
console.log(canvas)
console.log(x,'is the value of x')
console.log(y,'is the value of y')

// Test canvas id
console.log(initCanvas)

// Caoture if del/backspace keystroke
document.addEventListener('keydown', logkey)

function logkey(e) {
    console.log(e.code)
    if(e.code === 'Backspace'){
        deleteObj();
    }
}

//Deleting selected objects
function deleteObj() {
    var active = canvas.getActiveObject()
    if (active) {
      canvas.remove(active)
      if (active.type == "activeSelection") {
        active.getObjects().forEach(x => canvas.remove(x))
        canvas.discardActiveObject().renderAll()
      }
    }console.log("deleteObj fired");
  }
  
// Pull image into canvas for editing
function importImage() {
     console.log("Import Image fired")
     fabric.Image.fromURL('/img/screenshots-qs.png', function(img) {// Takes three parameters http://fabricjs.com/docs/fabric.Image.html#.fromURL 
        canvas.insertAt(img, 0);
     }, {
        selectable: false // Prevents imported image from being selected / moved
     })
}

// Save canvas as image
function saveCanvas () {
   const dataURL = canvas.toDataURL({
       // format: 'png',
       // quality: 0.8
       // left: 0,
       // right: 0,
       // width: canvas.width,
       // height: canvas.height
    });
    console.log('Save Canvas Fired = ' + dataURL)
    publishSavedImage(dataURL);

}

// Publish saved canvas image
function publishSavedImage(dataURL) {
    var printWindow = window.open('', 'height=600,width=800');
    
    var html  = '<html><head><title>I was generated by canvas</title></head>';
    html += '<body style="width: 100%; padding: 0; margin: 0;"';
    html += ' onload="window.focus();">';
    html += '<img src="' + dataURL + '" /></body></html>';
    
    printWindow.document.open();
    printWindow.document.write(html);
    printWindow.document.close();
    //printWindow.close();

}

// Set image background
//setBackground(bgUrl, canvas) // Commented out to prevent tainted canvas error message due to CORS
//https://www.agrimaccari.com/en/wp-content/uploads/2015/05/girl-500x500.jpg
setPanEvents(canvas) // Call pan handling. No pun intended
setColorListener() // Call color listener