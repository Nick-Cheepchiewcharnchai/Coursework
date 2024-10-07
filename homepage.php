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
            font-size: 24px;
        }
        .custom-navbar .nav-link {
            color: white !important;
        }

        .custom-navbar .navbar-brand img {
            border-radius: 50%; /* Circular image */
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        /* Hover effect for the links */
        .custom-navbar .nav-link:hover {
            text-decoration: underline;
        }

        /* Styling for item boxes */
        .item-box {
            transition: all 0.3s ease;
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
            <a class="navbar-brand" href="#">
                <img src="path-to-your-logo.jpg" alt="Logo"> <strong>Crosby Merch</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="browse.php">Browse</a></li>
                    <li class="nav-item"><a class="nav-link" href="basket.php">Basket</a></li>
                    <li class="nav-item"><a class="nav-link" href="purchases.php">Purchases</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content area -->
    <div class="container mt-5">
        <h2>View All</h2>
        <p>Total no. of items: <span id="totalItems"></span></p>

        <!-- Search, Category Filter, Sort -->
        <div class="row mb-4">
            <div class="col-md-6">
                <input type="text" class="form-control" id="searchInput" placeholder="Search...">
            </div>
            <div class="col-md-3">
                <select class="form-select" id="categoryFilter">
                    <option value="">Category</option>
                    <!-- Dynamically populate categories -->
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="sortBy">
                    <option value="price">Sort by Price</option>
                    <option value="name">Sort by Name</option>
                </select>
            </div>
        </div>

        <!-- Item Grid -->
        <div class="row" id="itemContainer">
            <!-- Dynamically populated items from tblitems will go here -->
        </div>
    </div>

    <!-- Bootstrap and JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Example of how you might dynamically load items from a database
            const items = [
                {id: 1, name: "Item 1", price: 20.00, img1: "img/item1.jpg", img2: "img/item1_hover.jpg"},
                {id: 2, name: "Item 2", price: 30.00, img1: "img/item2.jpg", img2: "img/item2_hover.jpg"},
                // Additional items would be fetched from the database
            ];

            const itemContainer = document.getElementById('itemContainer');
            const totalItems = document.getElementById('totalItems');

            function displayItems(items) {
                itemContainer.innerHTML = "";
                items.forEach(item => {
                    const itemBox = document.createElement('div');
                    itemBox.classList.add('col-md-3', 'item-box', 'mb-4');
                    itemBox.innerHTML = `
                        <div class="card">
                            <img src="${item.img1}" class="card-img-top" alt="${item.name}" onmouseover="this.src='${item.img2}'" onmouseout="this.src='${item.img1}'">
                            <div class="card-body">
                                <h5 class="card-title">${item.name}</h5>
                                <p class="card-text">$${item.price.toFixed(2)}</p>
                            </div>
                        </div>
                    `;
                    itemContainer.appendChild(itemBox);
                });
                totalItems.textContent = items.length;
            }

            // Initial item display
            displayItems(items);

            // Add search and filter functionality (simplified)
            document.getElementById('searchInput').addEventListener('input', function() {
                const searchValue = this.value.toLowerCase();
                const filteredItems = items.filter(item => item.name.toLowerCase().includes(searchValue));
                displayItems(filteredItems);
            });
        });
    </script>
</body>
</html>
