<?php include('php\header.php'); ?>


<body>

    <div class ="space">
        <ul class ="breadcrumb">
            <a href="http://localhost/lab5">
                <li>Головна </li>
                
            </a>
            <a href="">
                <li>Цибулини</li>
                
            </a>
        </ul>
    </div>
    <h1 class="page_title">Цибулинни квітів на весну 2023</h1>
    <div class ="products_items"> 
        <div class = "catalog_blog">
            <div class ="container">

                <?php
                    $hostname = '127.0.0.1';
                    $username = 'root';
                    $database = 'green_garden';
                    // Fetch and display user data from the database table
                    $conn = new mysqli($hostname, $username, 'root', $database);
                    $query = "SELECT p.id,p_d.img, p.name, p_d.planting_depth, p_d.features, p_d.plant_height, p_d.place_of_landing, p_d.frost_resistance, p.price  
                                        FROM product_description p_d
                                        RIGHT JOIN products p
                                        on p_d.id = p.description_id
                                        where p.category_id =  1;";
                    $result = mysqli_query($conn, $query);
                    
                    foreach ($result as $product) {
                        // Extract the necessary information
                        $product_id = $product['id'];
                        $product_name = $product['name'];
                        $img_url = $product['img'];
                        $planting_depth = $product['planting_depth'];
                        $features = $product['features'];
                        $plant_height = $product['plant_height'];
                        $place_of_landing = $product['place_of_landing'];
                        $frost_resistance = $product['frost_resistance'];
                        $price = $product['price'];

                        // Output the HTML structure for each product
                        echo '<form class="border" onsubmit="addToCart(event,'.$product_id.', \'blubs.php\')">';
                            echo '<img src="' . $img_url . '" alt="' . $product_name . '" title="' . $product_name . '">';
                            echo '<div class="product_name">';
                                echo '<a class="name link-product" href="">' . $product_name . '</a>';
                            echo '</div>';
                            echo '<div class="table_info">';
                                echo '<div class="tr">';
                                    echo '<div class="td"><span>Глибина посадки</span></div>';
                                    echo '<div class="td">' . $planting_depth . '</div>';
                                echo '</div>';
                                echo '<div class="tr">';
                                    echo '<div class="td"><span>Особливості</span></div>';
                                    echo '<div class="td">' . $features . '</div>';
                                echo '</div>';
                                echo '<div class="tr">';
                                    echo '<div class="td"><span>Висота рослини</span></div>';
                                    echo '<div class="td">' . $plant_height . '</div>';
                                echo '</div>';
                                echo '<div class="tr">';
                                    echo '<div class="td"><span>Місце посадки</span></div>';
                                    echo '<div class="td">' . $place_of_landing . '</div>';
                                echo '</div>';
                                echo '<div class="tr">';
                                    echo '<div class="td"><span>Морозостійкість</span></div>';
                                    echo '<div class="td">' . $frost_resistance . '</div>';
                                echo '</div>';
                                echo '<div class="tr">';
                                    echo '<div class="td"><span>Ціна</span></div>';
                                    echo '<div class="td">' .$price.'&#8372;</div>';
                                    echo '</div>';
                            echo '</div>';
                            echo '<button type="submit" class="buy_btn" data-limit_text="Вже куплений" data-limit_text_off="Ви вже купили акційний товар" >';
                                echo 'Купити';
                            echo '</button>';
                        echo '</form>';
                    }
                ?>
            </div>
        </div>
    </div> 
    <?php include('php\footer.php'); ?>