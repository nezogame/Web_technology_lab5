

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

        if (count($errors) == 0) {
        
        } else {
         
        }
    }
    ?>
