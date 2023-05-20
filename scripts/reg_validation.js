const themeButton = document.querySelector(".button_theme");

  function changeTheme(){
    var elements = document.querySelectorAll('*');
    var randomColor = "#" + Math.floor(Math.random()*16777215).toString(16);
    document.body.style.background = "GREY";
    for (var i = 0; i < elements.length; i++) {
      elements[i].style.color = randomColor;
    }
  }



themeButton.addEventListener("click", changeTheme);

// regestration

const closeButton = document.querySelector('.close_button');
const openButton = document.querySelector('.registration_button');
const closeAccountButton = document.querySelector('.account_close_button');

const closeLogButton = document.querySelector('.log_close_button');


const registrationPopup = document.querySelector('.reg_form');
const loginPopup = document.querySelector('.login_form');
const accountPopup = document.querySelector('.account_form');


function close() {
  registrationPopup.style.display = 'none';
}

function displayForm(){
  if(localStorage.getItem('authorized')){
    accountPopup.style.display = "block";
  }else{
    registrationPopup.style.display = "block";
  }
}

closeButton.addEventListener('click', ()=>close());
closeLogButton.addEventListener('click', ()=>closeLogin());
openButton.addEventListener('click',()=>displayForm());
closeAccountButton.addEventListener('click', ()=>closeAccount());

var userEmail = document.querySelector(".user_email");
var greeting = document.querySelector(".greeting");


function FormValidation( e ){
  e.preventDefault();
  //alert(“Alert”)
  var isValid = true;
  let name = document.getElementsByName("name")[0];
  let email = document.getElementsByName("email")[0];
  let phone = document.getElementsByName("phone")[0];
  let password = document.getElementsByName("password")[0];

  let regExpName = /^[a-zA-Z ]{2,30}$/;
  let regExpEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  let regExpPhon = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
  let regExpPas = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
  //Name validation

    if (!name.value.match(regExpName) || name.value == "") {
      document.querySelector(".error_name").style.visibility = "visible";
      name.style.border = "1px solid #f00";
      isValid=false;
    }else {
      name.nextElementSibling.style.visibility = "hidden";
      name.style.border = "1px solid #1e8a1e";
    }
    //email validation
    if (!email.value.match(regExpEmail) || email.value == "") {
      console.log(email);
      document.querySelector(".error_email").style.visibility = "visible";
      email.style.border = "1px solid #f00";
      isValid=false;

    }
    else {
      email.nextElementSibling.style.visibility = "hidden";
      email.style.border = "1px solid #1e8a1e";
    }
    //phone no validation
    if (!phone.value.match( regExpPhon) || phone.value == "") {
      console.log(phone);
      document.querySelector(".error_phone").style.visibility = "visible";
      phone.style.border = "1px solid #f00";
      isValid=false;
    }
    else {
      
      phone.nextElementSibling.style.visibility = "hidden";
      phone.style.border = "1px solid #1e8a1e";
    }

    //password no validation
    if (!password.value.match( regExpPas) || password.value == "") {
      console.log(phone);
      document.querySelector(".error_password").style.visibility = "visible";
      password.style.border = "1px solid #f00";
      isValid=false;
    }
    else {
      password.nextElementSibling.style.visibility = "hidden";
      password.style.border = "1px solid #1e8a1e";
    }
    if(isValid===true){
        localStorage.setItem("authorized",true);
        localStorage.setItem("name",name.value);
        localStorage.setItem("email",email.value);
        localStorage.setItem("phone",phone.value);
        document.querySelector(".reg_form").submit();
        closeRegistration();
    }
}


  document.addEventListener("DOMContentLoaded", function() {

  var greeting = document.querySelector(".greeting");
  var userEmail = document.querySelector(".user_email");
  userEmail.textContent = "Your Email: " + localStorage.getItem('email');
  greeting.textContent = "Hi " + localStorage.getItem('name');
  });


function loginValidation( e ){
  e.preventDefault();
  //alert(“Alert”)
  let regExpEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  let regExpPas = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
  var isValid=true;
  let password = document.getElementsByName("login_password")[0];
  let email = document.getElementsByName("login_email")[0];
    
    //email validation
    if (!email.value.match(regExpEmail) || email.value == "") {
      console.log(email);
      document.querySelector(".log_error_email").style.visibility = "visible";
      email.style.border = "1px solid #f00";
      isValid=false;
    }
    else {
      email.nextElementSibling.style.visibility = "hidden";
      email.style.border = "1px solid #1e8a1e";
    }

    //password validation
    if (!password.value.match( regExpPas) || password.value == "") {
      document.querySelector(".log_error_password").style.visibility = "visible";
      password.style.border = "1px solid #f00";
      isValid=false;
    }else {
      password.nextElementSibling.style.visibility = "hidden";
      password.style.border = "1px solid #1e8a1e";
    }
    if(isValid===true){
      closeLogin();
      localStorage.setItem("authorized",true);
      userEmail.textContent = 'your Email: '+ email.value;
      document.querySelector(".login_form").submit();
  }
}

function swapToLogin(){
    registrationPopup.style.display = 'none';
    loginPopup.style.display = "block";
}

function swapToRegistration(){
  loginPopup.style.display = 'none';
  registrationPopup.style.display = "block";
}

function closeLogin(){
  loginPopup.style.display = 'none';
}

function closeAccount(){
  accountPopup.style.display = 'none';
}

function closeRegistration(){
  registrationPopup.style.display = 'none';
}



function autorization(){
  if(!localStorage.getItem('authorized')){
    displayForm();
    return false;
  }
  return true
}




const changeLogin = document.querySelector(".login");
changeLogin.addEventListener("click",()=>swapToLogin());


const changeSignOut = document.querySelector(".sign_in");
changeSignOut.addEventListener("click",()=>swapToRegistration());



const LogOut = document.querySelector(".log_out");
LogOut.addEventListener("click",()=>{localStorage.clear()});

const canelAccount = document.querySelector(".account_canel");
canelAccount.addEventListener("click",()=>closeAccount());

function addCount(){
  var countElement = document.querySelector(".count");
  var count = parseInt(countElement.innerText);
  count++;
  countElement.innerText = count;
}
  
function subtractCount(){
  var countElement = document.querySelector(".count");
  var count = parseInt(countElement.innerText);
  if (count > 0) {
    count--;
    countElement.innerText = count;
  }
}

function addToCart(e, productId, target) {
  e.preventDefault();
  if (autorization()) {
    $.ajax({
      url: "add_to_cart.php",
      method: "POST",
      data: {
        id: productId,
        name: localStorage.getItem('name'),
        email: localStorage.getItem('email'),
        location: target
      },
      success: function(response) {
        // Handle the response from the PHP script
        addCount();
        console.log(response);
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.log(error);
      }
    });
  }
  
}

function decrementFromCart(e, productId, target) {
  e.preventDefault();
  if (autorization()) {
    $.ajax({
      url: "decrement_from_cart.php",
      method: "POST",
      data: {
        id: productId,
        name: localStorage.getItem('name'),
        email: localStorage.getItem('email'),
        location: target
      },
      success: function(response) {
        // Handle the response from the PHP script
        subtractCount();
        console.log(response);
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.log(error);
      }
    });
  }
}
