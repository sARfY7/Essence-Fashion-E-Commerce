<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/register.css" />
    <script src="js/register.js"></script>
</head>
<body>
<div class="container">
  <form autocomplete="off" id="form" method="POST">
    <h1 id="message">Get Started</h1><small id="smallMessage"> </small>
    <div class="field">
      <input type="text" name="fname" placeholder="First Name" id="fname" autocomplete="nope"/>
      <label for="fname">First Name</label>
    </div>
    <div class="field">
      <input type="text" name="lname" placeholder="Last Name" id="lname" autocomplete="nope"/>
      <label for="lname">Last Name</label>
    </div>
    <div class="field">
      <input type="email" name="email" placeholder="Email" id="email" autocomplete="nope"/>
      <label for="email">Email</label>
    </div>
    <div class="field">
      <input type="password" name="password" placeholder="Password" id="password"/>
      <label for="password">Password</label>
    </div>
    <div class="field">
      <input type="password" name="cpassword" placeholder="Confirm Password" id="cpassword"/>
      <label for="cpassword">Confirm Password</label>
    </div>
    <div class="field">
      <input type="text" name="phone" placeholder="Mobile Number" id="phone" autocomplete="nope"/>
      <label for="phone">Mobile Number</label>
    </div>
    <button type="button" name="submit" id="submit">Create My Account</button>
  </form>
  <a href="index.php">Home</a>
</div>
</body>
</html>