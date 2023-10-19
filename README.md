# php
PHP Research and Development

# Objective    
The purpose of this repo is research and development with PHP. 

# Environment and Preparation used for this event   
These are the tools used to conduct this research and development. 

## Hardware
* Macbook - MacOS Ventura 13.4.2

## Software
1. VS Code - Version: 1.82.0-insider  
(Note: all references to the command line refer to the VSCode command line unless otherwise noted) (Optional).

2. Installed PHP - **Verison 8.2** - using homebrew using instructions at https://www.php.net/manual/en/install.macosx.packages.php 
3. Installed VsCode extenions referenced at https://www.youtube.com/watch?v=zT6QrGIfXaU 
4. Installed MAMP (https://www.mamp.info/en/mamp/mac/) for the mySQL database **Version 5.3.79**. This could have been used for PHP as well instead of installing PHP in step 2.
5. Because this codebase is 17 years old, I installed a php switcher to make refactoring and testing more efficient. Use ` brew install brew-php-switcher`, then switch versions using `brew-php-switcher 5.4`.   
**Note:** PHP Switcher can only handle arguments of: 5.6 7.0 7.1 7.2 7.3 7.4 8.0 8.1   
[Ref](https://stackoverflow.com/questions/34909101/how-can-i-easily-switch-between-php-versions-on-mac-osx)

## How to use this repo
The method used to teach with this repo is via commented code and commits.  

This means that you should read the comments in each file to learn what the code does in conjunction with the commits to observe code edits.

Finally and very importantly, reference the Issues and Resolution section of the docs to find errors that were encountered and the resolution of this errors.

## Topics
 1. Basic Classes
 2. [Login System](/docs/login-system.md)
 3. [Login System OOP](/docs/login-system-OOP.md)
 4. [Profile Page](/docs/profile-page.md)
 5. [Gallery](/docs/gallery.md)
 6. [API](/docs/api.md)
 7. [Advanced API](/docs/advanced-api.md)
 8. [GD](/docs/gd.md)
 9. [FabricJS](/docs/fabricjs.md)
 10. [Containers](/Containers/ReadMe.md)