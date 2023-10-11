# Fabric

## Resources
- Primary source - https://www.youtube.com/watch?v=mghXNWvVGTs&t

1. Setup file structure.
- index.html
- index.js
2. Install package json using `npm init`. This creates a package.json file.
3. Install lite-server with `npm install lite-server`
4. Add dev to the script section of package.json.
- The file should contain this snippet.
```json
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1",
    "dev": "lite-server"
  }
```
**Note:** Most issues discovered were related to typos in code.

### Color Picker
- Added [jscolor picker](https://jscolor.com/)

### Draw Lines and Arrows
- Secondary source for lines and arrows - https://www.youtube.com/watch?v=qisBBCae7iE&list=PL-gIJFyHJjykXg776HNz3H7XXzBMSu5mL


### Issues
#### Issue
Color Picker would not change color on stage

#### Resolution
Removed hashtag from function "setColorListener()"

***

#### Issue
Dev Console (chrome) doesnt log mouse:dblclick events. Tried using fabric.js 4.5.0 since it was used in the lesson. This failed to work

#### Resolution
Function appears to work despite this fact.
The Dev Console "device" mode was suppressing the logging of this event. Ref - https://stackoverflow.com/questions/51660145/double-click-not-working-when-chrome-web-inspector-open