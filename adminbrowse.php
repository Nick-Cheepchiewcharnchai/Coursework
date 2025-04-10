<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Specifies the character encoding for the HTML document -->
    <meta charset="UTF-8">
    
    <!-- Sets the viewport for responsive design, ensuring the page adjusts for different screen sizes -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title of the webpage displayed in the browser tab -->
    <title>Crosby Merch</title>
    
    <!-- Link to Bootstrap CSS for styling the page -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link to a custom CSS file for additional styles (mystyle.css) -->
    <link href="mystyle.css" rel="stylesheet">
    
    
</head>
<body>

    <?php
    // Start the session to allow access to session variables
    session_start(); 

    // Check if the session does not have a 'name' key, indicating the user is not logged in
    if (!isset($_SESSION['name'])) {   
        // Redirect the user to the login page if not logged in
        header("Location:login.php");
    }
    ?>


    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Navbar brand with a logo and text -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Navbar toggle button for smaller screens (for mobile view) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar menu items -->
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="items.php">Items</a></li>
                    <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="accounts.php">Accounts</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content area with item browsing functionality -->
    <div class="container mt-5">
        <!-- Heading that dynamically changes based on the selected item filter -->
        <h1 id="viewAllHeading">View All</h1>
        <p>Total no. of items: <span id="totalItems"></span></p>

        <!-- Search input, category filter, and sorting options -->
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
                    <option value="priceLowToHigh">Cost (Low to High)</option>
                    <option value="priceHighToLow">Cost (High to Low)</option>
                </select>
            </div>
        </div>

        <!-- Grid of items dynamically fetched from the database -->
        <div class="row" id="itemContainer">
            <?php
            include_once("connection.php");

            // Fetch all items from the database
            $stmt = $conn->prepare("SELECT * FROM tblitems");
            $stmt->execute();

            // Display each item in a grid format
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo('<div class="col-lg-3 item-card" data-type="' . $row['Itemtype'] . '">');
                echo('<a style="text-decoration:none; color:inherit;" href="adminitemdisplay.php?IID=' . $row["ItemID"] . '">');
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
<script>
    // JavaScript function to handle filtering, sorting, and searching of items
    function filterItems() {
        const searchQuery = document.getElementById("searchInput").value.toLowerCase();  // Gets the search input
        const itemTypeFilter = document.getElementById("itemTypeFilter").value;  // Gets the selected item type filter
        const sortBy = document.getElementById("sortBy").value;  // Gets the selected sorting option

        const items = document.querySelectorAll(".item-card");  // Selects all item cards to filter

        let visibleItemsCount = 0;  // Variable to count visible items

        items.forEach(item => {
            const itemName = item.querySelector(".item-name").textContent.toLowerCase();  // Gets the item name
            const itemType = item.getAttribute("data-type");  // Gets the item type stored as data attribute
            const itemPrice = parseFloat(item.querySelector(".item-price").textContent.substring(1));  // Extracts item price

            // Check if item matches the search query
            let matchesSearch = itemName.includes(searchQuery);
                
            // Check if item matches the selected item type filter
            let matchesItemType = itemTypeFilter === "all" || itemType === itemTypeFilter;

            // Display or hide items based on search query and item type filter
            if (matchesSearch && matchesItemType) {
                item.style.display = "block";  // Shows the item
                visibleItemsCount++;  // Increments the visible items count
            } else {
                item.style.display = "none";  // Hides the item
            }
        });

        sortItems(sortBy);  // Sorts the items based on the selected sorting option

        // Updates the total number of visible items
        document.getElementById("totalItems").textContent = visibleItemsCount;

        // Changes the heading based on the selected item type filter
        const itemTypeName = itemTypeFilter === "all" ? "View All" : document.querySelector(`#itemTypeFilter option[value='${itemTypeFilter}']`).textContent;
        document.getElementById("viewAllHeading").textContent = itemTypeName;
    }

    // JavaScript function to sort the items based on the selected sorting option
    function sortItems(sortBy) {
        const items = Array.from(document.querySelectorAll(".item-card"));  // Convert NodeList to an array
        items.sort((a, b) => {
            const priceA = parseFloat(a.querySelector(".item-price").textContent.substring(1));  // Extract price from item A
            const priceB = parseFloat(b.querySelector(".item-price").textContent.substring(1));  // Extract price from item B

            const nameA = a.querySelector(".item-name").textContent.toLowerCase();  // Get name of item A
            const nameB = b.querySelector(".item-name").textContent.toLowerCase();  // Get name of item B

            // Sort based on the selected option
            if (sortBy === "priceLowToHigh") {
                return priceA - priceB;  // Sort by price (low to high)
            } else if (sortBy === "priceHighToLow") {
                return priceB - priceA;  // Sort by price (high to low)
            } else if (sortBy === "nameAZ") {
                return nameA.localeCompare(nameB);  // Sort by name (A-Z)
            } else if (sortBy === "nameZA") {
                return nameB.localeCompare(nameA);  // Sort by name (Z-A)
            }
        });

        const container = document.getElementById("itemContainer");
        container.innerHTML = "";  // Clears the container
        items.forEach(item => container.appendChild(item));  // Append sorted items back to the container
    }
</script>
</html>