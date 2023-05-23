
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

        if (isset($_POST['card_number'])) {
            $card_num = rtrim(htmlentities($_POST['card_number']));
            if(!preg_match("/^\d{4}-\d{4}-\d{4}-\d{4}$/",$card_num)){
                $errors['card_number'] = 'Будь ласка, перевірьте написання вашого номеру банківської картки';
            }
        }else{
            $errors['card_number'] = 'Будь ласка, введіть ваш номер банківської картки';
        }

        if (isset($_POST['CVV'])) {
            $CVV = ltrim(htmlentities($_POST['CVV']));
            if(!preg_match("/^\d{3}$/",$CVV)){
                $errors['CVV'] = 'Будь ласка, перевірьте написання вашого CVV коду';
            }
        }else {
            $errors['CVV'] ='Будь ласка, введіть ваш CVV код';
        }

        if (isset($_POST['card_date'])) {
            $card_date = htmlentities($_POST['card_date']);
            if(!preg_match("/^(0[1-9]|1[0-2])\/[0-9]{2}$/",$card_date)){
                $errors['card_date'] = 'Будь ласка, перевірьте написання дати вашої картки';
            }
        }else{
            $errors['card_date'] = 'Будь ласка, введіть дату вашої картки';
        }
        echo json_encode($errors);
    }
    
    ?>
