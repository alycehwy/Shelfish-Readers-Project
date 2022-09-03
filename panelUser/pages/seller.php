<?php
    // $dbcon = mysqli_connect("localhost", "root", "", "shelfishrd_db");
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
                <input class='form-control' name="price" type="text" placeholder="Price" required />
            </div>
            <div>
                <label for="keyword" class='form-label'>Keyword: </label>
                <input class='form-control' name="keyword" type="text" placeholder="Keyword" required />
            </div>
            <div>
                <label for="bImg" class='form-label'>Image Upload: </label>
                <input class='form-control' name="bImg" type="file" required />
            </div>
            <div class="sellformBtn">
                <button type="submit" class="btn btn btn-primary">Post Ad</button>
            </div>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $productName = htmlspecialchars($_POST['productName']);
            $authorName = htmlspecialchars($_POST['authorName']);
            $productDetails = htmlspecialchars($_POST['productDetails']);
            $price = htmlspecialchars($_POST['price']);
            $sourceImg = $_FILES['bImg'];
            $imgInfo = pathinfo($sourceImg['name']);
            $imgDest = "../Bookimages/".$sourceImg['name'];
            $imgExtension = ["jpg", "jpeg", "webp"];
            $selectCmd = "SELECT * FROM user_tb WHERE username = '".$_SESSION['username']."' AND title = 'user'";
            $result = $dbConection->query($selectCmd);
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            if (in_array($imgInfo['extension'], $imgExtension) && getimagesize($sourceImg['tmp_name'])) {
                if ($sourceImg['size'] < 40000000000) {
                    if (move_uploaded_file($sourceImg['tmp_name'], $imgDest . $sourceImg['name'])) {
                        $dbcon = mysqli_connect("localhost", "root", "", "r_shelfishrd_db");
                        if ($dbcon->connect_error) {
                            echo "<h1>" . $dbcon->connect_error . "</h1>";
                        } else {
                            $insertCmd = "INSERT INTO book_tb (b_title, b_author, b_description, b_price, b_source_img, b_keywords, b_type, puser_id) VALUES (''" . $productName . "','" . $authorName . "','" . $productDetails . "','" . $price . "','" . $imgDest . "','" . $keyword . "','$user_id')";
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