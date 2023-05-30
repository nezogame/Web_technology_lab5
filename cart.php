<?php include('php\header.php'); ?>
<body>
    

    <div class="container">
        <h1 class="page_title">Оформлення замовлення</h1>
        <div class="order_steps">
            <div class="order_step checked" data-order-step="1">
                <div class="order_step_box">
                    <div class="num">1</div>
                    <div class="text">Ваш кошик</div>
                </div>
            </div>
            <div class="order_step" data-order-step="2">
                <div class="order_step_box">
                    <div class="num">2</div>
                    <div class="text">Контактні дані</div>
                </div>
            </div>
            <div class="order_step" data-order-step="3">
                <div class="order_step_box">
                    <div class="num">3</div>
                    <div class="text">Оплата</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="order-steps">
        <div class="order-step" data-order-step="1">
            <div class="container"> 
                <div class="cart-list-ttl bbox">
                    <div class="product-title bbox">Товар</div>
                    <div class="product-price bbox">
                        <div class="bbox">Назва</div>
                        <div class="bbox">Ціна</div>
                        <div class="bbox">Кількість</div>
                        <div class="bbox">Сума</div>
                    </div>
                    <div class="product-remove bbox"> Видалити</div>
                </div>
            </div>
            <div class="cart-list-body">
                <div class = "container">
                    <?php
                        
                        $hostname = '127.0.0.1';
                        $username = 'root';
                        $database = 'green_garden';
                        $conn = new mysqli($hostname, $username, 'root', $database);

                        $connection = new mysqli($hostname, $username, 'root', $database);
                        // Retrieve the user ID from the cookie
                        
                        $userId = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : '';
                        if(empty($userId)){
                            echo '<script type="text/javascript">';
                            echo ' window.location.href = "index.php";';
                            echo ' function displayRegistrationForm() {';
                                echo '    const registrationPopup = document.querySelector(".reg_form");';
                                echo ' registrationPopup.style.display = "block";}';
                            echo ' window.onload = displayRegistrationForm;';
                            echo '</script>';
                        }
                        // Query the database to fetch all rows from the "cart" table based on the user ID
                        $query = "SELECT c.id, pd.img, c.product_id, p.name, p.price, c.quantity, c.final_price 
                        FROM cart c
                        left join products p
                        on c.product_id = p.id
                        left join product_description pd
                        on p.description_id = pd.id
                        WHERE c.user_id = '$userId';";
                        $result = mysqli_query($connection, $query);

                        // Check if the query was successful
                        if ($result) {
                            // Loop through each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                $dataId = $row['id'];
                                $dataTitle = $row['name'];
                                $dataImg = $row['img'];
                                
                                // and so on for other data fields

                                // Output the HTML code for each row with the fetched data
                                echo '<div class="cart-item-line item-product data-eec bbox" data-id="' . $dataId . '" data-title="' . $dataTitle . '">';

                                echo '<div class="image-inner bbox">';
                                echo '<img class="thumb" data-src=".." onerror="" alt="' . $dataTitle . '" title="' . $dataTitle . '" src="'.$dataImg.'">';
                                echo '</div>';

                                echo '<div>';
                                // Add any additional content you want to display in this div
                                echo '</div>';

                                echo '<div class="price-inner bbox">';
                                echo '<div class="title-inner bbox">';
                                echo '<div>' . $dataTitle . '</div>';
                                echo '</div>';

                                echo '<div class="price_block bbox">';
                                echo '<span class="price item-price">';
                                echo '<span id="price_'.$row['product_id'].'" class="value">' . $row['price'] . ' </span>';
                                echo '<span class="currency">грн</span>';
                                echo '</span>';
                                echo '</div>';

                                echo '<div class="quantity-inner bbox">';
                                echo '<div class="quantity_block">';
                                echo '<button class="input minus" data-sign="minus" onclick="decrementFromCart(event,'.$row['product_id'].', \'cart.php\')">-</button>';
                                echo '<input name="qty" id="quantity_'.$row['product_id'].'" class="quantity" value="' . $row['quantity'] . '" type="text">';
                                echo '<button class="input plus" data-sign="plus" style="margin: 0px;"onclick="addToCart(event,'.$row['product_id'].', \'cart.php\')">+</button>';
                                echo '<div class="clr"></div>';
                                echo '</div>';
                                echo '</div>';

                                echo '<div class="sum_block bbox">';
                                echo '<span class="price item-sum">';
                                echo '<span id="final_price_'.$row['product_id'].'" class="value">' . $row['final_price'] . ' </span>';
                                echo '<span class="currency">грн</span>';
                                echo '</span>';
                                echo '</div>';

                                echo '</div>';

                                echo '<div class="remove-inner bbox">';
                                echo '<button class="remove_btn remove-item" onclick = "removeFromCart(' . $dataId . ')"></button>';
                                echo '</div>';

                                echo '</div>';

                            
                            }
                            $query = "SELECT sum(final_price) total_sum 
                            FROM cart 
                            WHERE user_id = '$userId';";
                            $result = mysqli_query($connection, $query);
                            $row = mysqli_fetch_assoc($result);
                            echo '<div class="total_sum">';
                            echo '<div class="text">Сума до оплати:</div>';
                            echo '<span class="price">';
                            echo '<span class="value total_price">'.$row['total_sum'].'</span>';
                            echo '<span class="currency">грн</span> ';
                            echo ' </span> ';
                            echo '</div>';
                            echo '<div class="buttons_block">';
                            echo '<button class="continue_btn next_btn order_step_btn btn" onclick="displayFormAt(2)" data-order-step="2">';
                            echo 'Продовжити';
                            echo '</button>';
                            echo '</div>';
                        } else {
                            // Handle the case where the query fails
                            echo 'Error fetching data from the database.';
                        }

                        // Close the database connection
                        mysqli_close($connection);
                    ?>         
                </div>
            </div>  
        </div>

        <div class="order-step" data-order-step="2">
            <div class="block_title">Контактна інформація</div>
                <form class="contact_form"  >
                    <div class ="form_content">
                        <div class="form_group group_email field">
                            <div class="form_validation">  </div>
                            <input class="form_field anonym_data_email" type="email" name="cont_email" value="" data_ph="E-mail" onkeydown="if(event.keyCode==13){return false;}" placeholder="E-mail" data_gtm_form_interact_field_id="5" >
                        </div>
                        <div class="form_group group_phone field">
                            <div class="form_validation"> </div>
                            <input class="form_field phone" type="tel" name="cont_phone" placeholder="+38 " data_ph="+38" onkeydown="if(event.keyCode==13){return false;}" maxlength="19">
                        </div>                                
                        <div class="form_group group_name field">
                            <div class="form_validation"> </div>
                            <input class="form_field anonym_data_name _success" type="text" name="cont_name" value="" data_ph="Імя" onkeydown="if(event.keyCode==13){return false;}" placeholder="Імя" data_gtm_form_interact_field_id="6">
                        </div>
                        <div class="form_group group_fname field">
                            <div class="form_validation"> </div>
                            <input class="form_field _success" type="text" name="fname" placeholder="Прізвище*" data_ph="Прізвище" onkeydown="if(event.keyCode==13){return false;}">
                        </div>
                        <div class="form_group group_pname field">
                            <div class="form_validation"> </div>
                            <input class="form_field" type="text" name="pname" placeholder="По батькові" data_ph="По батькові" onkeydown="if(event.keyCode==13){return false;}">
                        </div>
                        <div class="form_group group_comment field">
                            <div class="form_validation"> </div>
                            <textarea class="form_field" name="comment" placeholder="Коментар до замовлення" onkeydown="if(event.keyCode==13){return false;}"></textarea>
                        </div>

                        <div id="error-messages-2"></div>
                    
                </form>
                
            </div >
            <div class ="buttons_block">
                        <button class=" prev_btn order_step_btn btn" onclick="displayFormAt(1)" data-order-step="1">Повернутися до кошику</button>
                        <button class="continue_btn next_btn order_step_btn btn" name ="submit_button"  onclick="validateContactInfo(event)">Продовжити</button>
                    </div>  
        </div>

        <div class="order-step" data-order-step="3">
            <div class="block_title">Оплата</div>
                    <form class="contact_form" onsubmit="validateContactInfo(event)">
                        <div class ="form_content">
                                                         
                            <div class="form_group group_card_number field">
                                <div class="form_validation"> </div>
                                <input class="form_field anonym_data_name _success" type="text" name="card_number" value="" data_ph="Номер картки" onkeydown="if(event.keyCode==13){return false;}" placeholder="Номер картки" data_gtm_form_interact_field_id="6">
                            </div>
                            <div class="form_group group_card_date field">
                                <div class="form_validation"> </div>
                                <input class="form_field _success" type="text" name="card_date" placeholder="xx/xx" data_ph="card_date" onkeydown="if(event.keyCode==13){return false;}">
                            </div>
                            <div class="form_group group_CVV field">
                                <div class="form_validation"> </div>
                                <input class="form_field" type="text" name="CVV" placeholder="CVV" data_ph="CVV" onkeydown="if(event.keyCode==13){return false;}">
                            </div>
                            <div id="error-messages-3"></div>


                        
                    </form>
                </div >
                <div class ="buttons_block">
                        <button class=" prev_btn order_step_btn btn" onclick="displayFormAt(2)" data-order-step="1">Повернутися до кошику</button>
                        <button class="submit_btn order_step_btn" name ="submit_button" onclick="confirmPurchaseInfo(event)">Продовжити</button>
                </div>  
        </div>

        
    </div>
    
<?php include('php\footer.php')?>
