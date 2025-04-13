<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php include("customerloggedin.php"); ?>
    <?php include("navbar.php"); ?>

    <div class="container mt-5">

        <h1 id="viewAllHeading">View All</h1>
        <p>Total no. of items: <span id="totalItems"></span></p>

        <div class="row mb-4">
            <div class="col-md-6">
            <input id="searchInput" type="text" class="form-control" placeholder="Search..." oninput="filterItems()">
            </div>
            <div class="col-md-3">
                <select id="itemTypeFilter" class="form-control" oninput="filterItems()">
                    <option value="all">All</option>
                    <option value="T">Tops</option>
                    <option value="B">Bottoms</option>
                    <option value="A">Accessories</option>
                    <option value="O">Others</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="sortBy" class="form-control" oninput="filterItems()">
                    <option value="nameAZ">A-Z</option>
                    <option value="nameZA">Z-A</option>
                    <option value="priceLowToHigh">Cost (Low to High)</option>
                    <option value="priceHighToLow">Cost (High to Low)</option>
                </select>
            </div>
        </div>

        <div class="row" id="itemContainer">
            <?php
                include_once("connection.php");

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

<script>
    function filterItems() {
        const searchQuery = document.getElementById("searchInput").value.toLowerCase();
        const itemTypeFilter = document.getElementById("itemTypeFilter").value;
        const items = document.querySelectorAll(".item-card");

        let visibleItemsCount = 0;

        items.forEach(item => {
            const itemName = item.querySelector(".item-name").textContent.toLowerCase();
            const itemType = item.getAttribute("data-type");

            const matchesSearch = itemName.includes(searchQuery);
            const matchesItemType = itemTypeFilter === "all" || itemType === itemTypeFilter;

            if (matchesSearch && matchesItemType) {
                item.style.display = "block";
                visibleItemsCount++;
            } else {
                item.style.display = "none";
            }
        });

        document.getElementById("totalItems").textContent = visibleItemsCount;

        const itemTypeName = itemTypeFilter === "all"
            ? "View All"
            : document.querySelector(`#itemTypeFilter option[value='${itemTypeFilter}']`).textContent;

        document.getElementById("viewAllHeading").textContent = itemTypeName;

        sortItems(sortBy);
    }

    function sortItems(sortBy) {
        const items = Array.from(document.querySelectorAll(".item-card"));

        items.sort((a, b) => {
            const nameA = a.querySelector(".item-name").textContent.toLowerCase();
            const nameB = b.querySelector(".item-name").textContent.toLowerCase();
            const priceA = parseFloat(a.querySelector(".item-price").textContent.substring(1));
            const priceB = parseFloat(b.querySelector(".item-price").textContent.substring(1));

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

    window.onload = filterItems;
</script>

</html>