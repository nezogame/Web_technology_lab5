
 <!-- header in top of the web site -->
<?php include('php\header.php'); ?>


<body>
    <div class="block_title">Контактна інформація</div>
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
            <div class="form_group group_name field">
                <div class="form_validation"> </div>
                <input class="form_field anonym_data_name _success" type="text" name="name" value="" data_ph="Імя" onkeydown="if(event.keyCode==13){return false;}" placeholder="Імя" data_gtm_form_interact_field_id="6">
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

        <div class ="buttons_blok">
            <button class="submit_btn" name ="submit_button">Продовжити</button>
        </div>  
    </form>
    </div >
    <?php
    
    
    if (isset($_POST['submit_button'])) {
        $errors = array();
        $valid = array();
        $name = '';
        $email = '';
        $lastname = '';
        $phone = '';
        $pname =''; 
        $comment =''; 
        
        if (isset($_POST['name'])) {
            $name = trim(htmlentities($_POST['name']));
            if(!preg_match("/^([a-zA-Z' ]+)$/",$name)){
                $errors['name'] = 'Будь ласка, перевірьте написання вашого імені';
            }
        }else{
            $errors['name'] = 'Будь ласка, введіть ваше ім&rsquo;я';
        }

        if (isset($_POST['lastname'])) {
            $lastname = rtrim(htmlentities($_POST['lastname']));
            if(!preg_match("/^([a-zA-Z' ]+)$/",$lastname)){
                $errors['lastname'] = 'Будь ласка, перевірьте написання вашого прізвища';
            }
        }else{
            $errors['lastname'] = 'Будь ласка, введіть ваше прізвище';
        }

        if (isset($_POST['email'])) {
            $email = ltrim(htmlentities($_POST['email']));
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Будь ласка, перевірьте написання вашого email';
            }
        }else {
            $errors['email'] ='Будь ласка, введіть ваш email';
        }

        if (isset($_POST['phone'])) {
            $phone = trim(htmlentities($_POST['phone']));
            if(!preg_match("/^\+\d{1,3}\d{9}$/",$phone)){
                $errors['phone'] = 'Будь ласка, перевірьте написання вашого телефону';
            }
        }else{
            $errors['phone'] = 'Будь ласка, введіть ваш телефон';
        }

        if (isset($_POST['pname'])) {
            $pname = trim(htmlentities($_POST['pname']));
            if(!preg_match("/^([a-zA-Z' ]+)$/",$pname)){
                $errors['pname'] = 'Будь ласка, перевірьте написання вашого по батькові';
            }
        }else{
            $errors['pname'] = 'Будь ласка, введіть ваше по батькові';
        }

        if(isset($_POST['comment'])){
            $comment = strtolower( htmlentities($_POST['comment']));
        }

        if (count($errors) == 0) {
            
            echo '$comment';
        } else {
            // Если ошибки есть, выведем сообщения об ошибках
            foreach ($errors as $error) {
                $count = strlen($error);

                echo "$error; ";
                print "довжина рядка $count \n";
            }
            $comment = strtoupper($comment);
            echo 'Коментар';
            echo $comment;
        }
    }
    ?>
<?php include('php\footer.php'); ?>