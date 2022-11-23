<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
        <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <div id="main">
                <h1>Login</h1>
                <div id="login">
				<?php
					if(isset($_GET["error"]))
					{
						if($_GET["error"] == "wronglogin")
						{
							echo "<div class='error'>Login failed</div> ";
						}
					}
				?>
                                <form method="post" action="inc/login.inc.php">
                                <div>Username</div>
                                <div><input type="text" name="username"></div>
                                <div>Password</div>
                                <div><input type="password" name="password"></div>
                                <div><input type="submit" name="submit" value="Login"></div>
                        </form>
                </div>
        </div>
</body>
</html>