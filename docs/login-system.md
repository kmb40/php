# Login System OOP

### 3rd party libraries

#### CSS
* Used reset css to keep styling consitent accross browsers as referenced at https://css-tricks.com/an-interview-with-elad-shechter-on-the-new-css-reset/#top-of-site. [Ref File](/login-system/header.php)

#### Fonts
 * Used Google fonts at https://fonts.google.com/specimen/Roboto.[Ref File](/login-system/header.php)
***
### Issues
#### Issue
* On form submission returns two failure to connect to database error type.[Ref File](/login-system/includes/dba.inc.php), [Commit](https://github.com/kmb40/php/commit/27da2b583f49c94e926eba41d77cbc6835e9e793)

#### Resolution
* Use port 8889 for MAMP mySQL port.  
* Use password "root".
***
#### Issue
* On form submission returns "Fatal error: Uncaught ArgumentCountError: mysqli_init() expects exactly 0 arguments, 1 given".[Ref File](/login-system/includes/functions.inc.php), [Commit](https://github.com/kmb40/php/commit/560dda1d427e62cba2ddb156c25e29251ad8742f)

#### Resolution
* Replace mysqli_init with mysqli_stmt_init. mysqli_init is deprecated and does not use paramaters.  
***
#### Issue
* After Sign in, logged expereince did not exist. Such as displaying navigation items specific to logged in users.[Ref File](/login-system/header.php ), [Commit](https://github.com/kmb40/php/commit/391325c960749964c5d4b7037dba7443507f6c98?diff=unified#diff-69573dac8a3e18a9599e0fe81128f2f6cdd89bac8107247fdb0a37d1013e8e82)

#### Resolution
* Replaced "$_SESSION["userid"]" with $_SESSION["useruid"]
***