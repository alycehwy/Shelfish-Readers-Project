<?php
    $dbcon = mysqli_connect("localhost", "root", "", "shelfishrd_db");
?>
<section class="main_content">
    <article class="sellform_body">
        <h3>Sell Form</h3>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div>
                <label for="productName" class='form-label'>Product Name: </label>
                <input class='form-control' name="productName" placeholder="Enter product name" required />
            </div>
            <div>
                <label for="authorName" class='form-label'>Author Name: </label>
                <input class='form-control' name="authorName" placeholder="Enter author name" required />
            </div>
            <div>
                <label for="productDetails" class='form-label'>Product Description: </label>
                <input class='form-control' name="productDetails" placeholder="Enter product description" required />
            </div>
            <div>
                <label for="price" class='form-label'>Price: </label>
                <input class='form-control' name="price" type="number" placeholder="Price" required />
            </div>
            <div>
            <label for="bImg" class='form-label'>Image Upload: </label>
                <input class='form-control' name="bImg" type="file" required />
            </div>
            <div class="sellformBtn">
                <button type="submit" class="btn btn btn-primary">Post Ad</button>
                <a type="butto" class="btn btn btn-secondary" href="<?php dirname($_SERVER['PHP_SELF']).'/' ?>">Back</a>
            </div>
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
                            $insertCmd = "INSERT INTO book_bs_tb (productName,authorName,productDetails,price,sourceImg) VALUES ('" . $productName . "','" . $authorName . "','" . $productDetails . "','" . $price . "','" . $imgDest . "')";
                            if ($dbcon->query($insertCmd) === TRUE) {
                                echo "<script>alert('Ad posted Success')</script>";  
                                header("Refresh:0.01; url=http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/seller", true);
                            } else {

                                echo "<script>alert('Action failed')</script>";
                            }
                            $dbcon->close();
                        }
                    } else {
                        echo "<script>alert('Can't upload the image')</script>";
                        
                    }
                }
            }
        }
        ?>
    </article>
</section>