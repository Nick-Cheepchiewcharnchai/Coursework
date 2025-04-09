<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet">
    <script>
        // JavaScript to handle filtering and searching
        function filterItems() {
            const searchQuery = document.getElementById("searchInput").value.toLowerCase();
            const itemTypeFilter = document.getElementById("itemTypeFilter").value;
            const sortBy = document.getElementById("sortBy").value;

            const items = document.querySelectorAll(".item-card");

            let visibleItemsCount = 0;

            items.forEach(item => {
                const itemName = item.querySelector(".item-name").textContent.toLowerCase();
                const itemType = item.getAttribute("data-type"); // Use item type attribute
                const itemPrice = parseFloat(item.querySelector(".item-price").textContent.substring(1)); // Remove '£' and convert to number

                // Check if item matches the search query
                let matchesSearch = itemName.includes(searchQuery);
                
                // Check if item matches the item type filter
                let matchesItemType = itemTypeFilter === "all" || itemType === itemTypeFilter;

                // Hide or show items based on search query and item type filter
                if (matchesSearch && matchesItemType) {
                    item.style.display = "block";
                    visibleItemsCount++;  // Increment visible items counter
                } else {
                    item.style.display = "none";
                }
            });

            sortItems(sortBy);

            // Update the total number of visible items
            document.getElementById("totalItems").textContent = visibleItemsCount;

            // Change the heading based on the item type selected
            const itemTypeName = itemTypeFilter === "all" ? "View All" : document.querySelector(`#itemTypeFilter option[value='${itemTypeFilter}']`).textContent;
            document.getElementById("viewAllHeading").textContent = itemTypeName;
        }

        function sortItems(sortBy) {
            const items = Array.from(document.querySelectorAll(".item-card"));
            items.sort((a, b) => {
                const priceA = parseFloat(a.querySelector(".item-price").textContent.substring(1));
                const priceB = parseFloat(b.querySelector(".item-price").textContent.substring(1));

                const nameA = a.querySelector(".item-name").textContent.toLowerCase();
                const nameB = b.querySelector(".item-name").textContent.toLowerCase();

                if (sortBy === "priceLowToHigh") {
                    return priceA - priceB;
                } else if (sortBy === "priceHighToLow") {
                    return priceB - priceA;
                } else if (sortBy === "nameAZ") {
                    return nameA.localeCompare(nameB);
                } else if (sortBy === "nameZA") {
                    return nameB.localeCompare(nameA);
                }
            });

            const container = document.getElementById("itemContainer");
            container.innerHTML = "";
            items.forEach(item => container.appendChild(item));
        }
    </script>
</head>
<body>

    <?php
    session_start(); 
    if (!isset($_SESSION['name'])) {   
        header("Location: login.php");
    }
    ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Circular image before "Crosby Merch" -->
            <a class="navbar-brand" href="homepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="homepage.php">Browse</a></li>
                    <li class="nav-item"><a class="nav-link" href="basket.php">Basket</a></li>
                    <li class="nav-item"><a class="nav-link" href="purchases.php">Purchases</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content area -->
    <div class="container mt-5">
        <!-- Heading dynamically updated -->
        <h1 id="viewAllHeading">View All</h1>
        <p>Total no. of items: <span id="totalItems"></span></p>

        <!-- Search, Category Filter, Sort -->
        <div class="row mb-4">
            <div class="col-md-6">
                <input id="searchInput" type="text" class="form-control" placeholder="Search..." oninput="filterItems()">
            </div>
            <div class="col-md-3">
                <select id="itemTypeFilter" class="form-control" onchange="filterItems()">
                    <option value="all">All</option>
                    <option value="T">Tops</option>
                    <option value="B">Bottoms</option>
                    <option value="A">Accessories</option>
                    <option value="O">Others</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="sortBy" class="form-control" onchange="filterItems()">
                    <option value="nameAZ">A-Z</option>
                    <option value="nameZA">Z-A</option>
                    <option value="priceLowToHigh">Cost (High to Low)</option>
                    <option value="priceHighToLow">Cost (Low to High)</option>
                </select>
            </div>
        </div>

        <!-- Item Grid -->
        <div class="row" id="itemContainer">
            <?php
            include_once("connection.php");

            // Fetch all items from the database
            $stmt = $conn->prepare("SELECT * FROM tblitems");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo('<div class="col-lg-3 item-card" data-type="' . $row['Itemtype'] . '">');
                echo('<a style="text-decoration:none; color:inherit;" href="itemdisplay.php?IID=' . $row["ItemID"] . '">');
                echo('<div><img src="/Coursework/Coursework-1/Pictures/' . $row["Picfront"] . '" width="200" height="200"></div>');
                echo('<div class="item-name"><b>' . $row["Itemname"] . '</b></div>');
                echo('<div class="item-price">£' . $row["Itemcost"] . '</div>');
                echo('</a>');
                echo('</div>');
            }
            ?>
        </div>
    </div>
</body>
</html>
