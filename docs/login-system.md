# Login System 

### 3rd party libraries

#### CSS
* Used reset css to keep styling consitent accross browsers as referenced at https://css-tricks.com/an-interview-with-elad-shechter-on-the-new-css-reset/#top-of-site. [Ref File](/login-system/header.php)

#### Fonts
 * Used Google fonts at https://fonts.google.com/specimen/Roboto.[Ref File](/login-system/header.php)
***
### Issues
#### Issue
* On form submission returns "Fatal error: Uncaught ArgumentCountError: mysqli_init() expects exactly 0 arguments, 1 given".[Ref File](/login-system/includes/functions.inc.php), [Commit](https://github.com/kmb40/php/commit/560dda1d427e62cba2ddb156c25e29251ad8742f)

#### Resolution
* Replace mysqli_init with mysqli_stmt_init. mysqli_init is deprecated and does not use paramaters.  
***