<?php 
/**
* Author:Alain KIKOUN
**/
 ?>


    <style type="text/css">
      body {
       /* padding-top: 40px;
        padding-bottom: 40px;*/
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
  <form class="form-signin" method="post">
    <h2 class="form-signin-heading center">Identification</h2>

    <?php
        if(isset($errMSG)){
          ?>
            <div class="alert alert-danger" style="margin-top:10px;">
              <span class="fa fa-info-circle"></span> <strong><?php echo $errMSG; ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
          }elseif(isset($successMSG)){
        ?>
          <div class="alert alert-success" style="margin-top:10px;">
                <strong><span class="fa fa-info-circle"></span> <?php echo $successMSG; ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
        </div>
    <?php  } ?>
    
    <label for="inputEmail" class="sr-only">Adresse Email </label>
    <input type="email" id="inputEmail"  name="username"  class="form-control" placeholder=" Adresse Email" required autofocus>
    <br>
    <label for="inputPassword" class="sr-only">Mot de Passe</label>
    <input type="password" id="inputPassword"  name="password"  class="form-control" placeholder="Mot de Passe" required>
   <!--<div class="checkbox">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label> 
    </div>-->
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="connexionof">Connexion</button>
    <br>
    <div class="">
      <a href="?p=annonce.compteCreate">Vous n'avez pas de compte.</a>
      <br>
      <a href="?p=annonce.lostPass"><i> <b>Mot de passe oublié.</b></i></a>
    </div>
  </form>

  
</div> 
    <!-- /container -->
