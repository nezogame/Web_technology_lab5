<?php include('php\header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\style.css">
    <title>GreenHome</title>
</head>
<body>
    
        
	</header>
    <div class="main_content"> 
        <div class="advantages_block">
            <div class="advanteges">
                
                <div class="block_title">Наші переваги</div>
                <div class="advantages">
                    <div class="advantages_item">
                        <div class="num  ">0</div>
                        <div class="title"> нульовий</div>
                        <div class="text">досвіду на садівничому<br> 
                            ринку в Україні, але ми стараємося</div>
                    </div>
                    <div class="advantages_item">
                        <div class="num  ">90</div>
                        <div class="title">90 днів гарантії</div>
                        <div class="text">з моменту 
                            отримання посилки</div>
                    </div>
                    <div class="advantages_item">
                        <div class="num ">10</div>
                        <div class="title">10 товарів</div>
                        <div class="text">широкий каталог насіння,<br>
                            саджанців і цибулин</div>
                    </div>
                    <div class="advantages_item">
                        <div class="num small ">100%</div>
                        <div class="title">Зберігаюча упаковка</div>
                        <div class="text">для комфортного транспортування наших рослин</div>
                    </div>
                </div>
            </div>
        </div >
        
        <div class="block_title">популярні категорії</div>
                
        <div class="board">
            <h3 class = "category_name">Ягоди</h3>
            <button class="click_arrow click_prev">prev</button>
            
            <div class="slideshow_image">
                <a class= "category_acquire" href="http://localhost/lab4/fruity.php">
                <img src="source\raspberry.jpg" alt="Image 1" id="changable_img">
                
                <img src="source\blueberry.jpg"  alt="Image 2" id="changable_img">
                
                <img src="source\strawberry.jpg" alt="Image 3" id="changable_img">
                </a>
            </div> 
            <button class="click_arrow click_next" >next</button>
                       
        </div>

        
             
    </div> 
    <script src="scripts/main.js"> </script>
    <script src="scripts/reg_validation.js"> </script>  
</body>
</html>
