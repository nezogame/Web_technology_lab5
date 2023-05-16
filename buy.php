<?php include('php\header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF_8">
    <meta http_equiv="X_UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device_width, initial_scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\style.css">
    <title>Acquire</title>
</head>
<body>
    <div class="block_title">Покупка</div>
    <form class="contact_form" method = "POST" >
        <div class ="form_content">
            <div class="form_group group_email field">
                <div class="form_validation">  </div>
                <input class="form_field anonym_data_email" type="email" name="email" value="" data_ph="E-mail" onkeydown="if(event.keyCode==13){return false;}" placeholder="E-mail" data_gtm_form_interact_field_id="5" >
            </div>
            <div class="form_group group_phone field">
                <div class="form_validation"> </div>
                <input class="form_field phone" type="tel" name="phone" placeholder="+38 " data_ph="+38" onkeydown="if(event.keyCode==13){return false;}" maxlength="19">
            </div>                                
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
           

        <div class ="buttons_blok">
            <button class="submit_btn" name ="submit_button">Продовжити</button>
        </div>  
    </form>
    </div >
    <?php
    
    
    if (isset($_POST['submit_button'])) {
        $errors = array();
        $valid = array();
      
        $email = '';
        $phone = '';
        $card_num = '';
        $card_date = '';
        $CVV =''; 
        
        if (isset($_POST['email'])) {
            $email = ltrim(htmlentities($_POST['email']));
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Будьбласка, перевірьте написання вашого email';
            }
        }else {
            $errors['email'] ='Будьбласка, введіть ваш email';
        }

        if (isset($_POST['phone'])) {
            $phone = trim(htmlentities($_POST['phone']));
            if(!preg_match("/^\+\d{1,3}\d{9}$/",$phone)){
                $errors['phone'] = 'Будьбласка, перевірьте написання вашого телефону';
            }
        }else{
            $errors['phone'] = 'Будьбласка, введіть ваш телефон';
        }

        if (isset($_POST['card_number'])) {
            $card_num = rtrim(htmlentities($_POST['card_number']));
            if(!preg_match("/^\d{4}-\d{4}-\d{4}-\d{4}$/",$card_num)){
                $errors['card_number'] = 'Будьбласка, перевірьте написання вашого номеру банківської картки';
            }
        }else{
            $errors['card_number'] = 'Будьбласка, введіть ваш номер банківської картки';
        }

        if (isset($_POST['CVV'])) {
            $CVV = ltrim(htmlentities($_POST['CVV']));
            if(!preg_match("/^\d{3}$/",$CVV)){
                $errors['CVV'] = 'Будьбласка, перевірьте написання вашого CVV коду';
            }
        }else {
            $errors['CVV'] ='Будьбласка, введіть ваш CVV код';
        }

        if (isset($_POST['card_date'])) {
            $card_date = htmlentities($_POST['card_date']);
            if(!preg_match("/^(0[1-9]|1[0-2])\/[0-9]{2}$/",$card_date)){
                $errors['card_date'] = 'Будьбласка, перевірьте написання дати вашої картки';
            }
        }else{
            $errors['card_date'] = 'Будьбласка, введіть дату вашої картки';
        }

        if (count($errors) == 0) {
            echo '-----ВСЕ ГАРАЗД-----<br/>';
            $valid = array_fill_keys(['one','two'],50);
            print_r($valid);
            echo "<br/>";
            print ('-----1-----');
            echo "<br/>";
            $valid = array_change_key_case($valid, CASE_UPPER);    
            print_r($valid);
            echo "<br/>";
            print ('-----2-----');
            echo "<br/>";
            $key = array_search(50,$valid);
            print($key);
            echo "<br/>";
            print ('-----3-----');
            echo "<br/>";
            $valid=array_flip($valid);
            print_r($valid);
            echo "<br/>";
            print ('-----4-----');
            echo "<br/>";
            array_push( $valid, 'three', 45, 13, 11 );
            print_r($valid);
            echo "<br/>";
            print ('-----5-----');
            echo "<br/>";
            $color=array("red","green","blue","yellow","brown");
            echo "orriginal aaray:";
            print_r($color);
            echo "<br/>modifaed aaray:";
            print_r(array_slice($color,2));
            
        } else {
            // Если ошибки есть, выведем сообщения об ошибках
            foreach ($errors as $error) {
                $count = strlen($error);
                echo "$error; ";
                echo "<br/>";
                print "довжина рядка $count \n";
                echo "<br/>";
            }
        }
    }
    ?>
     <script src="scripts/reg_validation.js"> </script>  
</body>
</html>