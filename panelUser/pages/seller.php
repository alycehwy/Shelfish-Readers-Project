<main>
    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
        <input name="productName" placeholder="Enter product name" required/>
        <input name="authorName" placeholder="Enter author name" required/>
        <input name="productDetails" placeholder="Enter product description" required/>
        <input name="price" type="number" placeholder="Price" required/>
        <input name="bImg" type="file" required/>
        <button type="submit">Post Ad</button>
    </form>
    <?php 
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $productid = " ";
            $productName = $_POST['productName'];
            $authorName = $_POST['authorName'];
            $productDetails = $_POST['productDetails'];
            $price = $_POST['price'];
            $sourceImg = $_FILES['bImg'];
            $imgExtension = pathinfo($sourceImg['name'])['extension'];
            $imgInfo = pathinfo($sourceImg['name']);
            $imgDest = "./Bookimages/".str_replace(" ","_",$productName)."img.".$imgExtension;
            $imgExtension = ["jpg","jpeg","webp"];
            if(in_array($imgInfo['extension'],$imgExtension) && getimagesize($sourceImg['tmp_name'])){
                if($sourceImg['size']<400000){
                    if(move_uploaded_file($sourceImg['tmp_name'],$imgDest)){
                        $dbConection = mysqli_connect("localhost","root","","books_db");
                        if($dbConection->connect_error){
                            echo "<h1>".$dbConection->connect_error."</h1>";
                        }else{
                            $insertCmd = "INSERT INTO books_tb (productName,authorName,productDetails,price) VALUES ('".$productName."','".$authorName."','".$productDetails."','".$price."')";
                            if($dbConection->query($insertCmd)===TRUE){
                                echo "<h1>Ad posted</h1>";
                                echo "<a href='/FinalProject/buyer.php'>View ad</a>";
                            }else{
                                echo "<h1>Ad not registered</h1>".$dbConection->error;
                            }
                            $dbConection->close();
                        }
                    }else{
                        echo "<h1>Can't upload the image</h1>";
                    }
                }
            }
        }
    ?>
</main>