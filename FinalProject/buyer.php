<?php
$dbcon = mysqli_connect("localhost", "root", "", "books_db");

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
    <?php
    function component($productName, $authorName, $price, $productDetails, $sourceImg, $productid)
    {
        $element = "
                <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                    <form action=\"buyer.php\" method=\"POST\">
                        <div>
                            <div>
                                <img src=$sourceImg alt=\"Image1\" class=\"img-fluid card-img-top\">
                            </div>
                            <div>
                                <h5>$productName</h5>
                                <h6>$authorName</h6>
                                <p>
                                    $productDetails
                                </p>
                                <h5>
                                    <span>$$price</span>
                                </h5>
                                <button type=\"submit\" name=\"add\">Add to Cart</button>
                                <input type='hidden' name='product_id' value='$productid'>
                            </div>
                        </div>
                    </form>
                </div>
        ";
        echo $element;
    }
    function cartElement($sourceImg, $productName, $authorName, $price, $productid)
    {
        $element = "
                    <form action=\"cart.php?action=remove&id=$productid\" method=\"POST\" class=\"cart-items\">
                        <div class=\"border rounded\">
                            <div class=\"row bg-white\">
                                <div class=\"col-md-3 pl-0\">
                                    <img src=$sourceImg alt=\"Image1\" class=\"img-fluid\">
                                </div>
                                <div class=\"col-md-6\">
                                    <h5 class=\"pt-2\">$productName</h5>
                                    <small class=\"text-secondary\">Author: $authorName</small>
                                    <h5 class=\"pt-2\">$$price</h5>
                                    <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                                    <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                                </div>
                                <div class=\"col-md-3 py-5\">
                                    <div>
                                        <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                                        <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                                        <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            ";
        echo $element;
    }
    $connection = mysqli_connect('localhost', 'root', '', 'books_db');

    $SelectCmd = "SELECT * FROM books_tb";
    $result = $dbcon->query($SelectCmd);

    echo "<table>";

    while ($row = mysqli_fetch_array($result)) {
        // component($productName,$authorName,$productDetails,$price,$sourceImg,$productid);
        echo "<tr><td>" . $row['productName'] . "</td><td>" . $row['authorName'] . "</td><td>" . $row['productDetails'] . "</td><td>$" . $row['price'] . "</td><td><img src='" . $row['sourceImg'] . "' alt=\"Image1\" class=\"img-fluid\"></td></tr>";
    }

    echo "</table>";

    $dbcon->close();
    // component("ikigai","Francesc Miralles and Hector Garcia",200,"something",'./BookImages/book-1.webp',1);
    ?>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>