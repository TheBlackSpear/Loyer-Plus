<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inscription bailleur</title>
    <link rel="shortcut icon" type="image/x-icon" href="../icones/infoci-favicon.ico" />
      <link rel="stylesheet" type="text/css" href="../apparence/bootstrap-3.3.7/dist/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../apparence/bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">

      <link rel="stylesheet" type="text/css" href="../apparence/jquery-ui/chosen_v1.8.7/chosen.css">
      <link rel="stylesheet" type="text/css" href="../apparence/css/stylebase.css">
      <link rel="stylesheet" type="text/css" href="../apparence/css/sticky-footer.css">
      <style type="text/css">body { padding-top: 70px;} </style>
  </head>

    <div class="col-md-12 col-sm-12">
      <div class="col-md-12 col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
               <div class="panel-title">FORMULAIRE D'INSCRIPTION</div>
            </div>  
            <div class="panel-body">

             <?php
               if(isset($errMSG)){
             ?>  
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
                    
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
                }
                else if(isset($warningMSG)){
            ?>
                <div class="alert alert-warning" role="alert">
                    <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $warningMSG; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
                }
                else if(isset($successMSG)){
            ?>
                <div class="alert alert-success" role="alert">
                    <strong><span class="glyphicon glyphicon-ok-sign"></span> <?php echo $successMSG; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php  }  ?>
                <form method="post" enctype="multipart/form-data" class="form-horizontal" role="form"  onsubmit="return checkCheckBoxes(this);">
                    <div class="form-group">
                      <label for="civilite" class="col-md-3 control-label">Civilité</label>
                      <div class="col-md-9">
                          <select name="civilite_bail" id="civilite" class="form-control">
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lastname" class="col-md-3 control-label">Nom</label>
                      <div class="col-md-9">
                          <input type="text" class="form-control" name="nom_bail" placeholder="Votre Nom de famille">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="firstname" class="col-md-3 control-label">Pr&eacute;nom(s)</label>
                      <div class="col-md-9">
                          <input type="text" class="form-control" name="prenom_bail" placeholder="pr&eacute;nom(s)">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-md-3 control-label">Email</label>
                      <div class="col-md-9">
                          <input type="email" class="form-control" name="mail_bail" placeholder="Adresse Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="login-password" class="col-md-3 control-label">Mot de passe</label>
                      <div class="col-md-9">
                          <input type="password" id="login-password" class="form-control" name="motdepasse_bail" placeholder="mot de passe">
                          <small><span style="color:#cc0d0d;">Le mot de passe doit contenir un minimum de 9 caractères alphanumériques !</span></small>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-md-3 control-label">Confirmation mot de passe</label>
                      <div class="col-md-9">
                          <input type="password" class="form-control" name="conf_motdepasse_bail" placeholder="mot de passe">
                          <small><span style="color:#cc0d0d;">Le mot de passe doit contenir un minimum de 9 caractères alphanumériques !</span></small>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" for="contacts">Contacts</label>
                      <div class="col-md-9"><input name="phone_bail" type="text" placeholder="+225 00000000" class="form-control" id="contacts"></div>
                    </div>
                    <div class="form-group">                          
                      <div class="col-md-12">
                        <small for="terms_and_conditions">En cochant cette case, je déclare avoir pris connaissance des <a href="" target="_blank">Conditions Générales d'Utilisation (CGU)</a> du site internet et les accepte :</small>
                        <input type="checkbox" name="cgucheck" id="terms_and_conditions" value="1" />
                      </div>
                    </div>
                    <div class="form-group">                          
                      <div class="col-md-12">
                        <small for="terms_and_conditions">J'ai déjà un compte. <a href="?p=bailleur.loginForm" title="Connexion"><i class=""></i>Je me CONNECTE</a></small>                      
                      </div>
                    </div>
                    <div class="form-group">
                                <!-- Button -->                                        
                      <div class="col-md-12">
                        <button type="submit" id="submit_button" class="btn btn-lg btn-primary btn-block" name="valideform" disabled><i class="icon-hand-right"></i> Envoyer </button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>


    <script type="text/javascript">
      //Add a JQuery click event handler onto our checkbox.
      $('#terms_and_conditions').click(function(){
          //If the checkbox is checked.
          if($(this).is(':checked')){
              //Enable the submit button.
              $('#submit_button').attr("disabled", false);
          } else{
              //If it is not checked, disable the button.
              $('#submit_button').attr("disabled", true);
          }
      });
    </script>