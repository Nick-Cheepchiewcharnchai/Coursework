<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet">
</head>
<body style="background-color: #f2f2f2;">

    <div class="container mt-5 bg-opacity-0">
        <div class="row justify-content-center">
            <div class="p-4">
            </div>
            <!--<div class="col">-->
                <!-- CROSBY PICTURE -->
            <!--</div>-->
            <div class="col-5 bg-white rounded-4 align-middle" style="border-style: solid; border-width: 2px;">
                <div class="p-5">
                    <div class="row">
                        <div class="container-fluid">
                            <img src="Crosby-Logo.jpg" class="float-end" alt="Crosby" style="width:100px;height:100px;">
                        </div>
                    </div>
                    <div class="row">
                        <h2>Login</h2>
                        <form action="loginprocess.php" method= "post">
                            Username:</br><input type="text" class="form-control" name="username"><br>
                            Password:</br><input type="password" class="form-control" name="passwd"><br>
                            <div class="row">
                                </br><input type="submit" class="btn btn-dark mt-3" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="p-5">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
