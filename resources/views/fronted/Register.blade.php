<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
        <title>REGISTER</title>
</head>
<style>
html,body{
background-image: url('background.jpg');
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}
    </style>
<body>
<div class="card  bg-transparent text-dark">
    <article class="card-body mx-auto" style="max-width: 900px;">
        
    <h4 class="card-title mt-3 text-center text-dark">Create Account</h4>
 
    <form action="" method="post">
    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div> 
         <input name="username" class="form-control" placeholder="Full name" type="text">
         
    </div> 
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
         <input name="email" class="form-control" placeholder="Email address" type="email">
        
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>
           <!-- form-group// -->
          
          <select class="custom-select" style="max-width: 120px;">
		    <option selected="">+91</option>
		    <option value="1">+92</option>
		    <option value="2">+71</option>
		    <option value="3">+82</option>
		</select>
    	<input name="number" class="form-control" placeholder="Phone number" type="text">
    </div> 
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-address-card"></i> </span>
		 </div>
         <input name="address" class="form-control" placeholder="address" type="adress">
        
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		</div>
           <!-- form-group// -->
          
          <select class="custom-select">
		    <option value="1">Admin</option>
		    <option value="2">Trust</option>
		    <option value="3">User</option>
		</select>
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		</div>
           <!-- form-group// -->
          
          <select class="custom-select">
		    <option value="1">Active</option>
		    <option value="2">InActive</option>
		</select>
    </div>
   
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Create password" type="password" name="password">
        
    </div>
    <div class="form-group">
        <button name="submit" type="submit" class="btn btn-primary btn-block"> Create Account  </button>
    </div> 
    <p class="text-center text-dark">Have an account? <a href="login.php" >Log In</a> </p>     
    </form>
</article>
</div> <!-- card.// -->

</div> 
</body>
</html>