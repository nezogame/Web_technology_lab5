

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
  if(getCookie('authorized')){
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


// Retrieve cookies in JavaScript
function getCookie(cookieName) {
  // Split the cookie string into individual cookies
  var cookies = document.cookie.split(';');

  // Iterate over the cookies to find the desired cookie
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();

    // Check if the cookie name matches
    if (cookie.startsWith(cookieName + '=')) {
      // Extract and decode the cookie value
      var cookieValue = cookie.substring(cookieName.length + 1);
      return decodeURIComponent(cookieValue);
    }
  }

  // Return null if the cookie is not found
  return null;
}


  document.addEventListener("DOMContentLoaded", function() {

  var greeting = document.querySelector(".greeting");
  var userEmail = document.querySelector(".user_email");
  userEmail.textContent = "Your Email: " + getCookie('email');
  greeting.textContent = "Hi " + getCookie('name');
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
      if(email === "admin@a.com"&& password === "admin"){

      }
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
  rauthorizedDOMegistrationPopup.style.display = "block";
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
  if(!getCookie('authorized')){
    displayForm();
    return false;
  }
  return true
}




const changeLogin = document.querySelector(".login");
changeLogin.addEventListener("click",()=>swapToLogin());


const changeSignOut = document.querySelector(".sign_in");
changeSignOut.addEventListener("click",()=>swapToRegistration());



const logoutButton = document.querySelector(".log_out");
logoutButton.addEventListener("click", () => {
  // Split the cookies by semicolon to get individual cookie strings
  const cookies = document.cookie.split(";");

  // Loop through each cookie and set its expiration to a past date
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i];
    const eqPos = cookie.indexOf("=");
    const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
  }

  // Redirect or perform any other actions after clearing the cookies
  window.location.href = "index.php";
});
const canelAccount = document.querySelector(".account_canel");
canelAccount.addEventListener("click",()=>closeAccount());

function addCount(){
  var countElement = document.querySelector(".count");
  var count = parseInt(countElement.innerText);
  count++;
  countElement.innerText = count;
}

function addQuantity(id){
  let quantityElement = document.getElementById("quantity_"+id);
  let priceElement  = document.getElementById("price_"+id);
  let sumElement  = document.getElementById("final_price_"+id);
  let totalPriceElement = document.querySelector(".total_price");

  let totalPrice = parseInt(totalPriceElement.innerText*100);
  let price =parseInt(priceElement.innerText*100);
  let count = parseInt(quantityElement.value);
  count++;
  
  quantityElement.value = count;
  sumElement.innerText = price*count/100 +' ';
  totalPriceElement.innerText = (totalPrice + price)/100 +' ';
}
  
function subtractCount(){
  var countElement = document.querySelector(".count");
  var count = parseInt(countElement.innerText);
  if (count > 0) {
    count--;
    countElement.innerText = count;
  }
}

function subtractQuantity(id){
  let quantityElement  = document.getElementById("quantity_"+id);
  let priceElement  = document.getElementById("price_"+id);
  let sumElement  = document.getElementById("final_price_"+id);
  let totalPriceElement = document.querySelector(".total_price");

  let totalPrice = parseInt(totalPriceElement.innerText*100);
  let price =parseInt(priceElement.innerText*100);
  let count = parseInt(quantityElement.value);
  if (count > 0) {
    count--;
    quantityElement.value = count;
    sumElement.innerText = price*count/100 +' ';
    totalPriceElement.innerText = (totalPrice-price)/100 +' ';
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
        name: getCookie('name'),
        email: getCookie('email'),
        location: target
      },
      success: function(response) {
        if(target==='cart.php'){
          addQuantity(productId);
        }
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
        name: getCookie('name'),
        email: getCookie('email'),
        location: target
      },
      success: function(response) {
        if(target==='cart.php'){
          subtractQuantity(productId);
        }
        subtractCount(productId);
        console.log(response);
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.log(error);
      }
    });
  }
}




const orderSteps = document.querySelectorAll('.order-step');
const orderStepBoxs = document.getElementsByClassName("order_step");

function addCheckedClass(orderStepIndex) {
  // Remove the "checked" class from all order steps

  for (var i = 0; i < orderStepBoxs.length; i++) {
    orderStepBoxs[i].classList.remove("checked");
  }
  
  // Add the "checked" class to the order step with the specified index
  var orderStep = document.querySelector('[data-order-step="' + orderStepIndex + '"]');
  if (orderStep) {
    orderStep.classList.add("checked");
  }
}
addCheckedClass(1);

  function displayFormAt(step){
    window.event
          // Hide all order steps except the first one
          for (let i = 0; i < orderSteps.length; i++) {
              orderSteps[i].style.display = 'none';
          }
          const current= document.querySelector('.order-step[data-order-step="'+step+'"]');
          if(current){
          current.style.display = 'block';
          addCheckedClass(step);
           }
    }
    displayFormAt(1); 
function validateEmail(email) {
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function validateName(name){
  var nameRegex = /^([a-zA-Z' ]+)$/;
  return nameRegex.test(name);
}

function validateLastName(lastName) {
  var lastNameRegex = /^([a-zA-Z' ]+)$/;
  return lastNameRegex.test(lastName);
}

function validatePname(pname) {
  var pnameRegex = /^([a-zA-Z' ]+)$/;
  return pnameRegex.test(pname);
}

function validatePhone(phone) {
  var phoneRegex = /^\+\d{1,3}\d{9}$/;
  return phoneRegex.test(phone);
}

function validateCardNumber(cardNumber) {
  var cardNumberRegex = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
  return cardNumberRegex.test(cardNumber);
}

function validateCVV(CVV) {
  var CVVRegex = /^\d{3}$/;
  return CVVRegex.test(CVV);
}

function validateCardDate(cardDate) {
  var cardDateRegex = /^(0[1-9]|1[0-2])\/[0-9]{2}$/;
  return cardDateRegex.test(cardDate);
}


function displayErrors(errors,id) {
  var errorContainer = document.getElementById('error-messages-'+id);
  errorContainer.innerHTML = ''; // Очистить контейнер от предыдущих сообщений об ошибках

  if (Object.keys(errors).length > 0) {
    var ul = document.createElement('ul');

    for (var field in errors) {
      if (errors.hasOwnProperty(field)) {
        var li = document.createElement('li');
        li.className = 'validate_error';
        li.textContent = errors[field];
        ul.appendChild(li);
      }
    }

    errorContainer.appendChild(ul);
  }
}

    
function confirmPurchaseInfo(e) {
  e.preventDefault();
  var errors = {};

  var cardNumberInput = document.querySelector('input[name="card_number"]');
  var cardNumber = cardNumberInput.value.trim();
  if (!cardNumber) {
    cardNumberInput.style.border = "1px solid #f70f0f";
    errors['card_number'] = 'Будь ласка, введіть ваш номер банківської картки';
  } else if (!validateCardNumber(cardNumber)) {
    cardNumberInput.style.border = "1px solid #f70f0f";
    errors['card_number'] = 'Будь ласка, перевірьте написання вашого номеру банківської картки';
  }else{
    cardNumberInput.style.border = "1px solid #1e8a1e";
  }

  var CVVInput = document.querySelector('input[name="CVV"]');
  var CVV = CVVInput.value.trim();
  if (!CVV) {
    CVVInput.style.border = "1px solid #f70f0f";
    errors['CVV'] = 'Будь ласка, введіть ваш CVV код';
  } else if (!validateCVV(CVV)) {
    CVVInput.style.border = "1px solid #f70f0f";
    errors['CVV'] = 'Будь ласка, перевірьте написання вашого CVV коду';
  }else{
    CVVInput.style.border = "1px solid #1e8a1e";
  }

  var cardDateInput = document.querySelector('input[name="card_date"]');
  var cardDate = cardDateInput.value.trim();
  if (!cardDate) {
    cardDateInput.style.border = "1px solid #f70f0f";
    errors['card_date'] = 'Будь ласка, введіть дату вашої картки';
  } else if (!validateCardDate(cardDate)) {
    cardDateInput.style.border = "1px solid #f70f0f";
    errors['card_date'] = 'Будь ласка, перевірьте написання дати вашої картки';
  }else{
    cardDateInput.style.border = "1px solid #1e8a1e";
  }

  if (Object.keys(errors).length > 0) {
    displayErrors(errors);
  }else{
    $.ajax({
      url: "move_to_order.php",
      method: "POST",
      data: {
        id: getCookie('user_id'),
      },
      success: function(response) {
        
        console.log(response);
        if (response.trim() === '') {
          window.location.href = 'index.php';
      }
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.log(error);
      }
    });
  }
}

function validateContactInfo(e) {
  e.preventDefault();
  var errors = {};

  var nameInput = document.querySelector('input[name="cont_name"]');
var name = nameInput.value.trim();

if (!name) {
  nameInput.style.border = "1px solid #f70f0f";
  errors['name'] = 'Будь ласка, введіть ваше ім’я';
} else if (!validateName(name)) {
  nameInput.style.border = "1px solid #f70f0f";
  errors['name'] = 'Будь ласка, перевірьте написання вашого імені';
} else {
  nameInput.style.border = "1px solid #1e8a1e";
}

var lastnameInput = document.querySelector('input[name="fname"]');
var lastname = lastnameInput.value.trim();

if (!lastname) {
  lastnameInput.style.border = "1px solid #f70f0f";
  errors['lastName'] = 'Будь ласка, введіть ваше прізвище';
} else if (!validateLastName(lastname)) {
  lastnameInput.style.border = "1px solid #f70f0f";
  errors['lastName'] = 'Будь ласка, перевірьте написання вашого прізвища';
} else {
  lastnameInput.style.border = "1px solid #1e8a1e";
}

var emailInput = document.querySelector('input[name="cont_email"]');
var email = emailInput.value.trim();

if (!email) {
  emailInput.style.border = "1px solid #f70f0f";
  errors['email'] = 'Будь ласка, введіть ваш email';
} else if (!validateEmail(email)) {
  emailInput.style.border = "1px solid #f70f0f";
  errors['email'] = 'Будь ласка, перевірьте написання вашого email';
} else {
  emailInput.style.border = "1px solid #1e8a1e";
}

var phoneInput = document.querySelector('input[name="cont_phone"]');
var phone = phoneInput.value.trim();

if (!phone) {
  phoneInput.style.border = "1px solid #f70f0f";
  errors['phone'] = 'Будь ласка, введіть ваш телефон';
} else if (!validatePhone(phone)) {
  phoneInput.style.border = "1px solid #f70f0f";
  errors['phone'] = 'Будь ласка, перевірьте написання вашого телефону';
} else {
  phoneInput.style.border = "1px solid #1e8a1e";
}

var pnameInput = document.querySelector('input[name="pname"]');
var pname = pnameInput.value.trim();

if (!pname) {
  pnameInput.style.border = "1px solid #f70f0f";
  errors['pname'] = 'Будь ласка, введіть ваше по батькові';
} else if (!validatePname(pname)) {
  pnameInput.style.border = "1px solid #f70f0f";
  errors['pname'] = 'Будь ласка, перевірьте написання вашого по батькові';
} else {
  pnameInput.style.border = "1px solid #1e8a1e";
}

  if (Object.keys(errors).length > 0) {
    displayErrors(errors,2);
  }else{
    displayFormAt(3);
  }
}

document.addEventListener("DOMContentLoaded", function() {
  if(getCookie('user_id')==1){
    adminPanel();
  }
});

function adminPanel() {
  var li = document.createElement('li');

  // Create the new <a> element
  var a = document.createElement('a');
  a.className = 'nav-link';
  a.href = 'admin.php';
  a.textContent = 'Адмін';

  // Append the <a> element to the <li> element
  li.appendChild(a);

  // Find the <ul> element with the class "horizontal-list"
  var ul = document.querySelector('.horizontal-list');

  // Append the new <li> element to the <ul> element
  ul.appendChild(li);
}

function removeFromCart(cartId) {

  if (autorization()) {
    $.ajax({
      url: "remove_product.php",
      method: "POST",
      data: {
        id: cartId,
      },
      success: function(response) {
        
        window.location.href = "cart.php";
        console.log(response);
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.log(error);
      }
    });
  }
}