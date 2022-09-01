<?php
$dbcon = mysqli_connect("localhost", "root", "", "shelfishrd_db");

?>
<section class="main_content_buy">
    <article class="buyer_body">
        <h3>Buy a Second-hand book</h3>
        <?php
        function component($productName, $authorName, $price, $productDetails, $sourceImg, $productid)
        {
            $element = "
                <div class='border border-secondary buyer_div'>
                    <div class=\"card mb-3"."style=\"max-width: 540px;"."\>
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
                                    <p class=\"card-text font-monospace\"><small class=\"text-muted\">updated a few seconds ago.</small></p>
                                </div>
                                <div class='centerBtn'>
                                    <button class=\"btn text-white bg-primary bg-gradient border mx-3\" type=\"submit\" name=\"add\">Add to Cart</button>
                                </div>
                             </div>
                        </div>
                        <input type='hidden' name='product_id' value='$productid'>
                    </div>
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
                                        <img src=$sourceImg class=\"img-fluid\">
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
        $connection = mysqli_connect('localhost', 'root', '', 'shelfishrd_db');
    
        $SelectCmd = "SELECT * FROM book_bs_tb";
        $result = $dbcon->query($SelectCmd);
        while($row = mysqli_fetch_array($result)){
            echo component($row['productName'],$row['authorName'],$row['price'],$row['productDetails'],$row['sourceImg'],$row['productDetails']);
        }
        // while($row = mysqli_fetch_array($result)){
        //     echo cartElement($row['productName'],$row['authorName'],$row['price'],$row['productDetails'],$row['sourceImg'],$row['productDetails']);
        // }
        $dbcon->close();
        ?>
    
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </article>
</section>