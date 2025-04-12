<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Specifies the character encoding for the HTML document -->
    <meta charset="UTF-8">
    
    <!-- Sets the viewport for responsive design, ensuring it adjusts for different screen sizes -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title of the webpage displayed in the browser tab -->
    <title>Crosby Merch</title>
    
    <!-- Link to the Bootstrap CSS for styling the page -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link to a custom CSS file for additional styles (mystyle.css) -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body style="background-color: #f2f2f2;">
    <!-- Main container for the login page, includes margin-top (mt-5) for spacing -->
    <div class="container mt-5 bg-opacity-0">
        
        <!-- Row to center the content horizontally -->
        <div class="row justify-content-center">
            <div class="p-4">
            </div>

            <!-- Main login box (column with a white background, rounded corners, and a solid border) -->
            <div class="col-5 bg-white rounded-4 align-middle" style="border-style: solid; border-width: 2px;">
                <div class="p-5">
                    <!-- Row for the Crosby logo -->
                    <div class="row">
                        <div class="container-fluid">
                            <!-- Crosby logo image positioned to the right -->
                            <img src="Crosby-Logo.jpg" class="float-end" alt="Crosby" style="width:100px;height:100px;">
                        </div>
                    </div>
                    
                    <!-- Row for the login form -->
                    <div class="row">
                        <h2>Login</h2>
                        
                        <!-- Form to submit the login data to 'loginprocess.php' using POST method -->
                        <form action="loginprocess.php" method="post">
                            <!-- Username input field -->
                            Username:</br><input type="text" class="form-control" name="username"><br>
                            
                            <!-- Password input field -->
                            Password:</br><input type="password" class="form-control" name="passwd"><br>

                            <!-- Submit button for the login form -->
                            <div class="row">
                                </br><input type="submit" class="btn btn-dark mt-3" value="Login">
                            </div>
                        </form>

                        <?php
                            session_start();

                            //displays error message if incorrect username has been attempted then unset the session
                            if (isset($_SESSION['usernamemessage'])){
                                echo("<div class='row' style='color:red;'>".$_SESSION['usernamemessage']."</div>");
                                unset($_SESSION['usernamemessage']);
                            }
                            //displays error message if incorrect username has been attempted then unset the session
                            if (isset($_SESSION['passwordmessage'])){
                                echo("<div class='row' style='color:red;'>".$_SESSION['passwordmessage']."</div>");
                                unset($_SESSION['passwordmessage']);
                            }
                        ?>

                    </div>
                </div>
                <div class="p-5">
                </div>
            </div>
        </div>
    </div>
</body>
</html>