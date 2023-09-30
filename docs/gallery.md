# Gallery

### Issues
#### Issue
* After image upload, image failed to show using background `<!-- <div style="background-image: url(img/gallery'.$row["imgFullNameGallery"].');"></div> -->`

#### Resolution
* Used img tag `  <img src="img/gallery'.$row["imgFullNameGallery"].'" width="250"; /> `
