# Profile Page

## Issues
#### Issue
* On form submission fields for title and text information would traspose each time the save button was pressed. [Ref File](/login-system-OOP/classes/profileinfo.classes.php), [Commit](https://github.com/kmb40/php/commit/b7e408bd0ff21ca02ff141dc4e0a4f0e108a27a5?diff=unified)

#### Resolution
* Methods `setNewProfileInfo` and `setProfileInfo`, `prepare` statements properties/parameters should be in the proper order.  