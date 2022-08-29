<?php
$dbcon = mysqli_connect("localhost", "root", "", "books_db");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Page</title>
</head>

<body>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <input name="productName" placeholder="Enter product name" required />
        <input name="authorName" placeholder="Enter author name" required />
        <input name="productDetails" placeholder="Enter product description" required />
        <input name="price" type="number" placeholder="Price" required />
        <input name="bImg" type="file" required />
        <button type="submit">Post Ad</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $productid = " ";
        $productName = $_POST['productName'];
        $authorName = $_POST['authorName'];
        $productDetails = $_POST['productDetails'];
        $price = $_POST['price'];
        $sourceImg = $_FILES['bImg'];
        $imgInfo = pathinfo($sourceImg['name']);
        $imgDest = "./Bookimages/".$sourceImg['name'];
        $imgExtension = ["jpg", "jpeg", "webp"];
        if (in_array($imgInfo['extension'], $imgExtension) && getimagesize($sourceImg['tmp_name'])) {
            if ($sourceImg['size'] < 40000000000) {
                if (move_uploaded_file($sourceImg['tmp_name'], $imgDest . $sourceImg['name'])) {
                    $dbcon = mysqli_connect("localhost", "root", "", "books_db");
                    if ($dbcon->connect_error) {
                        echo "<h1>" . $dbcon->connect_error . "</h1>";
                    } else {
                        $insertCmd = "INSERT INTO books_tb (productName,authorName,productDetails,price,sourceImg) VALUES ('" . $productName . "','" . $authorName . "','" . $productDetails . "','" . $price . "','" . $imgDest . "')";
                        if ($dbcon->query($insertCmd) === TRUE) {
                            echo "<h1>Ad posted</h1>";
                            echo "<a href='/FinalProject/buyer.php'>View ad</a>";
                        } else {
                            echo "<h1>Ad not registered</h1>" . $dbcon->error;
                        }
                        $dbcon->close();
                    }
                } else {
                    echo "<h1>Can't upload the image</h1>";
                }
            }
        }
    }
    ?>
</body>

</html>