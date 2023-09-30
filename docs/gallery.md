# Gallery

### Issues
#### Issue
* On form submission, images would not upload to "img" directory.

#### Resolution
* In `gallery-upload.inc.php` changed path from `$fileDestination = "../img/gallery/" . $imageFullName;` to `$fileDestination = "../img/gallery" . $imageFullName;`

***
### Issues
#### Issue
* After image upload, image failed to show using background `<!-- <div style="background-image: url(img/gallery'.$row["imgFullNameGallery"].');"></div> -->`

#### Resolution
* Used img tag `  <img src="img/gallery'.$row["imgFullNameGallery"].'" width="250"; /> `
