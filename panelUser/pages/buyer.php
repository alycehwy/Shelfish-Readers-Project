<?php
    include '../dbConFile.php';
    $database = new CreateDb("shelfishrd_db", "book_bs_tb");

    if (isset($_POST['add'])){
        $pId = $_POST['add'];
        array_push($_SESSION['cart'], $pId);
        if(isset($_SESSION['cart'])){
            
            if(in_array($pId, $_SESSION['cart'])){
                echo "<script>alert('Product is already added in the cart..!')</script>";
                echo "<script>window.location = 'cart'</script>";
            }else{
    
                $count = count($_SESSION['cart']);
                $item_array = array(
                    'productid' => $_POST['productid']
                );
    
                $_SESSION['cart'][$count] = $item_array;
            }
    
        }else{
            echo $productid;
            print_r($_POST['productid']);

            $item_array = array(
                'productid' => $_POST['productid']
            );
    
            $_SESSION['cart'][0] = $item_array;
            print_r($_SESSION['cart']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <title>Buyer Page</title>
</head>

<body>
<section class="main_content_buy">
    <article class="buyer_body">
        <h3>Buy a Second-hand book</h3>
        <?php

        function component($productName, $authorName, $price, $productDetails, $sourceImg, $productid){
            $element = "
                <div class='border border-secondary buyer_div'>
                    <div class=\"card mb-3 " ."style=\"max-width: 540px;"."\>
                        <div class=\"row g-0\">
                            <div class=\"col-md-4\">
                                <img src=$sourceImg class=\"img-thumbnail rounded-start" ."style=\"max-width: 70%;"."\">
                            </div>
                            <div class=\"col-md-8\">
                                <div class=\"card-body\">
                                    <h5 class=\"fs-1 fw-bold card-title\">$productName</h5>
                                    <h6 class=\"fs-3 fw-normal\">$authorName</h6>
                                    <p class=\"fs-5 fw-lighter card-text\">$productDetails</p>
                                    <h5><span>$$price</span></h5>
                                </div>
                                <form method='POST' action='./buyer'>
                                    <button class=\"btn text-white bg-primary bg-gradient border mx-3\" type=\"submit\" name=\"add\" value='$productid'>Add to Cart</button>
                                </form>  
                            </div>
                        </div>
                        <input type='hidden' name='productid' value='$productid'>
                    </div>
                </div>  
            ";
            echo $element;
        }

        $result = $database->getData();
        $SelectCmd = "SELECT * FROM book_bs_tb";

        while($row = mysqli_fetch_array($result)){
            echo component($row['productName'],$row['authorName'],$row['price'],$row['productDetails'],$row['sourceImg'],$row['productid']);
        }
        ?>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>