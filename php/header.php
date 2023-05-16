
<section > 

    <div>            
            <div class="header">
            <a href ="http://localhost/lab5" class="logo">
            <img src="source\logo-removebg.png"  
                 alt="Магазин GreenHome" title="Магазин GreenHome" >
                </img>
            </a>
                
                <div class="phones_block">
                    <div class="phone_block">    
                        <div class="phone_label">
                            Відділ консультації
                            <a class="phone_number" href="tel:8 (800) 555-35-35" class="phone_number">8 (800) 555-35-35</a>
                        </div>
                        <div class="phone_label">
                            Замовлення 
                            <a class="phone_number" href="tel:4 (800) 353-55-55" class="phone_number">4 (800) 353-55-55</a>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="circle">
                        <button class="log_out">
                            <div>LogOut</div>
                        </button>
                    </div>
                    <div class="circle">
                        <button class="button_theme">
                            <img src="source\dark-theme-icon-512x512-185rlszm.png" alt="Change Theme">
                        </button>
                    </div>
                    
                    <div class="circle">
                        <button class="registration_button">
                        <svg  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 350 350" xml:space="preserve"> <g> <path d="M175,171.2c38.9,0,70.5-38.3,70.5-85.6C245.5,38.3,235.1,0,175,0s-70.5,38.3-70.5,85.6C104.5,132.9,136.1,171.2,175,171.2z "></path> <path d="M41.9,301.9C41.9,299,41.9,301,41.9,301.9L41.9,301.9z"></path> <path d="M308.1,304.1C308.1,303.3,308.1,298.6,308.1,304.1L308.1,304.1z"></path> <path d="M307.9,298.4c-1.3-82.3-12.1-105.8-94.4-120.7c0,0-11.6,14.8-38.6,14.8s-38.6-14.8-38.6-14.8 c-81.4,14.7-92.8,37.8-94.3,118c-0.1,6.5-0.2,6.9-0.2,6.1c0,1.4,0,4.1,0,8.7c0,0,19.6,39.5,133.1,39.5 c113.5,0,133.1-39.5,133.1-39.5c0-3,0-5,0-6.4C308.1,304.6,308,303.7,307.9,298.4z"></path> </g> </svg>
                        </button>
                        <div class="greating"></div>
                    </div>
                    <a href="http://localhost/Lab5/acquire.php">
                    <div class="circle" onclick="location.href=''"> Contact</div>
                    </a >
                    <a href="http://localhost/Lab5/buy.php">
                    <div class="circle" >
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 510 510" xml:space="preserve"> <g> <g id="shopping-cart"> <path d="M153,408c-28.1,0-51,23-51,51s22.9,51,51,51s51-23,51-51S181.1,408,153,408z M0,0v51h51l91.8,193.8L107.1,306 c-2.6,7.6-5.1,17.9-5.1,25.5c0,28,22.9,51,51,51h306v-51H163.2c-2.6,0-5.1-2.5-5.1-5.1v-2.6l22.9-43.4h188.7 c20.4,0,35.7-10.2,43.4-25.5l91.8-165.7c5.1-5.1,5.1-7.7,5.1-12.8c0-15.3-10.2-25.5-25.5-25.5H107.1L84.2,0H0z M408,408 c-28,0-51,23-51,51s23,51,51,51s51-23,51-51S436,408,408,408z"></path> </g> </g> </svg>
                    </div>
                    </a>
                </div>
            </div>      
            <div class="nav_menu_block">
                <ul class = "horizontal-list">
                    <li>
                        <a class="nav-link" href ="index.php">Каталог</a>
                    </li>
                    <li>
                        <a class="nav-link" href ="discount.php">Акії</a>
                    </li>
                    <li>
                        <a class="nav-link" href ="blubs.php">Цибулини</a>
                    </li>
                    <li>                        
                        <a class="nav-link" href ="perennial.php">Багаторічні</a>
                    </li>
                    <li>                        
                        <a class="nav-link" href ="berries.php">Ягідні</a>
                    </li>
                    <li>                        
                        <a class="nav-link" href ="сonifers.php">Хвойні</a>
                    </li>
                    <li>                        
                        <a class="nav-link" href ="annual.php">Однорічні</a>
                    </li>
                </ul>
            </div>
    </div> 

    <form class="reg_form" action="registration.php" method="POST" onsubmit="FormValidation(event)" >
            <div class="registration-popup">
              <div class="close_button">&times;</div> <!-- добавлен элемент для крестика -->
              <h1 class="registration_heder">Registration Form</h1>
              <div class="input-row">
                <input class="textarea" name="name" placeholder="Name*">
                <span class="error error_name">Your Name is incorect it min length 2 and max 30</span>
              </div>
              <div class="input-row">
                <input class="textarea" name="email" placeholder="Email*">
                <span class="error error_email">Your Email is incorect it should contain 
                    @ sign with ending</span>
              </div>
              <div class="input-row">
                <input type="tel" class="textarea" name="phone" placeholder="Phone*">
                <span class="error error_phone">Your Phone is incorect it should contain + and decimal
                    from 10 to 12  </span>
              </div>
              <div class="input-row">
                <input class="textarea" name="password" placeholder="Password*">
                <span class="error error_password">Your Password is incorect it should contain 
                    at least one number and special charecter</span>
              </div>
              <div class="button_wraper">
                <button class="submit" type="submit">Submit</button>
                <div class="login"> Login</div>
              </div>
            </div>
        </form>
    
        <form class="login_form" method = "get"action = "login.php" onsubmit="loginValidation(event)">
            <div class="login_popup">
              <div class="log_close_button">&times;</div> <!-- добавлен элемент для крестика -->
              <h1 class="login_heder">login Form</h1>
              
              <div class="input-row">
                <input class="textarea" name="login_email" placeholder="Email*">
                <span class="error log_error_email">Your Email is incorect it should contain 
                    @ sign with ending</span>
              </div>
              <div class="input-row">
                <input class="textarea" name="login_password" placeholder="Password*">
                <span class="error log_error_password">Your Password is incorect it should contain 
                    at least one number and special charecter</span>
              </div>
              <div class="button_wraper">
                <button class="login_submit" type="submit">Submit</button>
                <div class="sign_in"> Sign up</div>
              </div>
            </div>
        </form>
       
</section > 