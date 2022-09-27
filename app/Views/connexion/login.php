<?php 
/**
* Author:Alain KIKOUN
**/
 ?>
  
    <style type="text/css">
      /**/body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
      }

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
  background: rgba(0, 153, 255, 0.4);
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

    </style>

<div class="container">
  <form method="post" class="form-signin">
    <h2 class="text-center">IDENTIFICATION</h2>
        <?php
          if(isset($errMSG)){
        ?>
          <div class="alert alert-danger" style="margin-top:10px;">
            <span class="fa fa-info-circle"></span> <strong><?php echo $errMSG; ?></strong>
          </div>
        <?php
          }
            else if(isset($successMSG)){
        ?>
          <div class="alert alert-success" style="margin-top:10px;">
            <strong><span class="fa fa-info-circle"></span> <?php echo $successMSG; ?></strong>
          </div>
        <?php  } ?>
    <div class="form-group">
    	<label for="inputEmail" class="sr-only">Email address </label> <!-- type="email" -->
    	<input type="text" id="inputEmail" name="username" class="form-control" placeholder="Email address" required autofocus>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="remembered" value="remember-me"> se souvenir de moi
        <br><a href="?p=usermanage.lostPass"><i> <b>Mot de passe oublié.</b></i></a>
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
  </form> 

</div>