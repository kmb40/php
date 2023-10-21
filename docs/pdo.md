# [PDO](/pdo/index.php)

## Resources
- Primary source - https://www.youtube.com/watch?v=yWJFbPT3TC0&list=RDCMUCzyuZJ8zZ-Lhfnz41DG5qLw&start_radio=1&rv=yWJFbPT3TC0&t=51

## PDO Explained
```php 
// Snippet
$query = "SELECT * FROM users WHERE username = :username AND pwd = :pwd;"; // SQL query to get data

$stmt = $pdo->prepare($query); // Passes query to database WITHOUT specific data using variables/placeholders
$stmt->bindParam(':username', $username); // Binds the actual username separetly from the prepare statement 
$stmt->bindParam(':pwd', $pwd); // Binds the actual username separetly from the prepare statement
$stmt->execute(); // executes the complete statement with query and properties/variables involved
```
### Issues
#### Issue

#### Resolution 