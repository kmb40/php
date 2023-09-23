<?php
    include_once('header.php');
?>

<section>
    <div class="container">
      <div>
      <section>

<p><!-- Start Body content.//--></p>
        <?php
        if (isset($_SESSION["useruid"])){ // Check if a session exists with a useruid. If so, display profile and log out options on nav
            echo "<h1>Hello there " . $_SESSION["useruid"] . " you are logged in.</h1>";
        }
        ?>
        <h1>This is an Research and Development for PHP</h1>
          <p>The objective is to practice coding with an actual project while documenting the process to internalize the knowledge.</p>
        <p><!-- End body content. //--></p>
    <br/>
</section>
      </div>  
      <div class="row">
        <div class="col sm">

        <!-- Signup Form //-->    
        <h3>Sign Up</h3>
        <form action="includes/signup.inc.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="uid" class="form-control" id="uid" placeholder="Username">
          </div>            
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Password">
         </div>
         <div class="form-group">
            <label for="exampleInputPassword2">Repeat Password</label>
            <input type="password" name="pwdRepeat" class="form-control" id="pwdRepeat" placeholder="Repeat Password">
         </div>         
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
       </div>

       <!-- Login Form //-->
        <div class="col-sm">
        <h3>Login</h3>
        <form action="includes/login.inc.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="uid" class="form-control" id="uid" placeholder="Username">
          </div>   
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="pwd" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>  
     </div>
    </div>
</section>

<?php
    include_once('footer.php');
?>