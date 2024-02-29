<?php

require_once 'config.php';


# Trade code for access token
if(isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $google_oauth = new Google\Service\Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    $userinfo = [
        'email' => $google_account_info['email'],
        'first_name' => $google_account_info['givenName'],
        'last_name' => $google_account_info['familyName'],
        'full_name' => $google_account_info['name'],
        'picture' => $google_account_info['picture'],
        'verifiedEmail' => $google_account_info['verifiedEmail'],        
        'token' => $google_account_info['id'],
    ];

    # Check whether user already exists in db
    $sql = "SELECT * FROM users WHERE email = '{$userinfo['email']}'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $userinfo = mysqli_fetch_assoc($result);
        $token = $userinfo['token'];
    } else {
        $sql = "INSERT INTO users (email, first_name, last_name, full_name, picture, verifiedEmail, token) VALUES ('{$userinfo['email']}', '{$userinfo['first_name']}', '{$userinfo['last_name']}', '{$userinfo['full_name']}', '{$userinfo['picture']}', '{$userinfo['verifiedEmail']}', '{$userinfo['token']}')";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $token = $userinfo['token'];
        } else {
            echo "User has not been created";
            die();
        }
    }

    # Save user data to session
    $_SESSION['user_token'] = $token;
  }
  else {
    if(!isset($_SESSION['user_token'])) {
        header("Location: index.php");
        die();
    }

    $sql = "SELECT * FROM users WHERE token = '{$_SESSION['user_token']}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        # User exists
        $userinfo = mysqli_fetch_assoc($result);
    }

  }

  # Show welcome message when token is present
  if(isset($_SESSION['user_token'])) {
    echo "<h2>Welcome. Your account is valid</h2>";
  }

?>

<body>
  <img src="<?= $userinfo['picture'] ?>" width="125px"/>
  <ul>
  <li>Full Name: <?= $userinfo['full_name'] ?></li>
  <li>Email Address: <?= $userinfo['email'] ?></li>
  <li><a href="logout.php">Logout</a></li>
  </ul>
</body>