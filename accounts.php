<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navbar styling */
        .custom-navbar {
            background-color: #980930;
            color: white;
            border-top: 8px solid black;
            border-bottom: 8px solid black;
        }

        .custom-navbar .navbar-brand {
            font-weight: bold;
            font-size: 28px;
            color: white;
            display: flex;
            align-items: center;
        }

        .custom-navbar .navbar-brand img {
            border-radius: 100%; /* Circular image */
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .custom-navbar .nav-link {
            color: white;
        }

        /* Hover effect for the links */
        .custom-navbar .nav-link:hover {
            text-decoration: underline;
        }

        /* Styling for item boxes */
        .item-box {
            transition: all 0.5s ease;
        }

        .item-box:hover {
            background-color: #f8f9fa;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Circular image before "Crosby Merch" -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="items.php">Items</a></li>
                    <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="accounts.php">Accounts</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content area -->
    <div class="container mt-5">
        <h1>Accounts</h1><br>
        <h2><a style="text-decoration:none; color:#980930;" href="accountslist.php">Accounts list</a></h2><br>
        <h2><a style="text-decoration:none; color:#980930;" href="addusers.php">Add account</a></h2><br>
        <h2><a style="text-decoration:none; color:#980930;" href="removeusers.php">Remove account</a></h2><br>
    </div>

</body>
</html>