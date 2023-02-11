<!DOCTYPE html>


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>TK Shop</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="vendors/linericon/style.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <link rel="stylesheet" href="css/flaticon.css" />
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css" />
  <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
  <link rel="stylesheet" href="vendors/animate-css/animate.css" />
  <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css" />
  <!-- main css -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
  <style>
    .otp_input  {
        display: flex;
        gap: 1em;
        justify-content: center;
    }
    .otp_input input {
        outline: none;
        border: none;
        border-radius: 7px;
        text-align: center;
        font-size: 1.5em;
        font-weight: bold;

        padding: 10px;
        width: 70px;
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center flex-column" style="height: 100vh;">
  <h1>Forgot password</h1>
  <form class="container d-flex flex-column align-items-center justify-content-center">
    
    <div class="mt-10 w-50">
      <input type="text" name="first_name" placeholder="Enter your email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your email'"
      required class="single-input">
    </div>
    <div class="mt-10 w-50">
      <button class="btn text-white btn-block " style="background-color: #71cd14">Continue</button>
    </div>
    <div class="mt-10 w-50">
      
      <a href="#" style="color:currentColor" class="text-center d-block">Can't not access?</a>
    </div>
    
    <div class="mt-10 w-50">
 
</div>       
    
  </form>
  <form>
    <div class="otp_input">

        <input type="text" class="single-input" onblur="checkPaste(this)">
        <input type="text" class="single-input" maxlength="1">
        <input type="text" class="single-input" maxlength="1">
        <input type="text" class="single-input" maxlength="1">
        <input type="text" class="single-input" maxlength="1">
        <input type="text" class="single-input" maxlength="1">
       </div>
  </form>
  <br><br>
  <form class="container d-flex justify-content-between flex-column align-items-center">
    
    <div class="mt-10 w-50">
        <input type="text" name="first_name" placeholder="Enter new password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your new password'"
        required class="single-input">
    </div>
    <div class="mt-10 w-50">
        <input type="text" name="first_name" placeholder="Repeat the password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Repeat the password'" class="single-input" />
    </div>
    <div class="mt-10 w-50">
        <button class="btn text-white btn-block " style="background-color: #71cd14">Change password</button>
    </div>
      
      <div class="mt-10 w-50">
   
  </div>       
      
  </form>
  <script>
      var inp = document.querySelectorAll('.otp_input>input')
    function checkPaste(obj) {
        if(obj.value.length > 1 &&  Number.isInteger(parseInt(obj.value)) && obj.value.length < 7) {
            let otp = obj.value
            for (let i = 0; i < 7; i++) {
                inp[i].value = otp[i]
            }
        }
        else if(!Number.isInteger(parseInt(obj.value))) {
            obj.value = '' 
            obj.focus()
        }
    }
     
    for (let i = 0; i < inp.length; i++) {
        inp[i].oninput = function() {
            if(i != 5) {    
                inp[i+1].focus()

            }
            
        }
        
    }
  </script>
  
  
</body>