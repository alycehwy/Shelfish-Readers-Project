<main>
    <?php
        function component($productName, $authorName, $price, $productDetails, $sourceImg, $productid){
        $element = "
                <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                    <form action=\"buyer.php\" method=\"POST\">
                        <div>
                            <div>
                                <img src=\"$sourceImg\" alt=\"Image1\" class=\"img-fluid card-img-top\">
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
        function cartElement($sourceImg, $productName,$authorName, $price, $productid){
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
            echo  $element;
        }

        component(productName:"$productName",authorName:"$authorName",price:"$price",productDetails:"$productDetails",sourceImg:"/FinalProject/BookImages/book-1.jpg",productid:"");

        if($dbConection->connect_error){
            die("Connection error");
        }else{
            $selectCmd = "SELECT * FROM book_b&s_tb";
            $result = $dbConection->query($selectCmd);
            $users = [];
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                    echo "<td>".$row['user_id']."</td>";
                    echo "<td>".$row['firstName']." ".$row['lastName']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['dob']."</td>";
                    echo "<td>".$row['phone']."</td>";
                    echo "<td><a class='btn' href='".$_SERVER['PHP_SELF']."?id=".$row['user_id']."&action=del'>Delete</a></td>";
                    echo "<td><a class='btn' href='".$_SERVER['PHP_SELF']."?id=".$row['user_id']."&action=edit'>Edit</a></td>";
                echo "</tr>";
            }
            $dbConection->close();
        }
    ?>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</main>