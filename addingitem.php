<?php

// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Include the connection script to access the database
    include_once("connection.php");

    // Prepare the SQL query to insert a new item into the 'tblitems' table
    // The 'ItemID' is set to 'null' because it's an auto-increment field in the database
    $stmt = $conn->prepare("INSERT INTO tblitems (ItemID, Itemname, Itemdescription, Itemtype, Itemcost, Picfront, Picback)
                            VALUES (null, :itemname, :itemdescription, :itemtype, :itemcost, :picfront, :picback)");

    // Bind form data to the prepared statement parameters
    $stmt->bindParam(':itemname', $_POST["itemname"]);
    $stmt->bindParam(':itemdescription', $_POST["itemdescription"]);
    $stmt->bindParam(':itemtype', $_POST["itemtype"]);
    $stmt->bindParam(':itemcost', $_POST["itemcost"]);
    $stmt->bindParam(':picfront', $_FILES["picfront"]["name"]); // Name of the front image file
    $stmt->bindParam(':picback', $_FILES["picback"]["name"]);  // Name of the back image file
    $stmt->execute(); // Execute the query to insert the item

    // Define the target directory to store the uploaded pictures
    $target_dir = "Pictures/";

    // Print the details of the uploaded files for debugging purposes
    print_r($_FILES);

    // Handle the upload of the front picture
    $target_file = $target_dir . basename($_FILES["picfront"]["name"]); // Construct the file path for the front image
    echo $target_file; // Debugging line: Print the file path

    // Initialize upload flag
    $uploadOk = 1;
    // Get the file extension of the front picture
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file was successfully uploaded
    if (move_uploaded_file($_FILES["picfront"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["picfront"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // Handle the upload of the back picture
    $target_file = $target_dir . basename($_FILES["picback"]["name"]); // Construct the file path for the back image
    echo $target_file; // Debugging line: Print the file path

    // Get the file extension of the back picture
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file was successfully uploaded
    if (move_uploaded_file($_FILES["picback"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["picback"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

} catch (PDOException $e) {
    // Catch any exceptions thrown during the execution of the try block and display the error message
    echo "error" . $e->getMessage();
}

// Close the database connection
$conn = null;

// Debugging: Print the form data to confirm that the values were correctly captured
echo $_POST["itemname"] . "<br>";
echo $_POST["itemdescription"] . "<br>";
echo $_POST["itemtype"] . "<br>";
echo $_POST["itemcost"] . "<br>";

// Redirect to the 'additems.php' page after the form is submitted successfully
header('Location:additems.php');

?>