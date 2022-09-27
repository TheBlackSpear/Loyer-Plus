
    <!-- BEGIN PAGE TITLE/BREADCRUMB -->
    <div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="page-title">Contact</h1>
            
            <ul class="breadcrumb">
              <li><a href="?p=loyerplus.index">Accueil </a></li>
              <li><a href="#">Contacts</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- END PAGE TITLE/BREADCRUMB -->
    
    
    <!-- BEGIN CONTENT WRAPPER -->
    <div class="content contacts">
      <div class="container">
        <div class="row">
        
          <div id="contacts-overlay" class="col-sm-6">
            <img src="public/front/images/Image-contact.jpg" class="img-responsive" width="400">

          </div>
          
          <!-- BEGIN MAIN CONTENT -->
          <div class="main col-sm-6">
            
            <ul class="col-sm-6">
              <li><i class="fa fa-map-marker"></i> FreeLight Team - Abidjan - Cote d'Ivoire</li>
              <li><i class="fa fa-envelope"></i> <a href="mailto:alain.kone@gmail.com">alain.kone@gmail.com</a></li>
            </ul>
            
            <ul class="col-sm-6">
              <li><i class="fa fa-phone"></i> Tel.: +225 07 47 80 95 27 </li>
              <li><i class="fa fa-phone"></i> Tel.: +225 07 48 97 70 81 / 05 55 25 12 01 </li>
            </ul>

            <h2 class="section-title">Contact</h2>
            <p class="col-sm-12 left">Vous avez des questions, suggestions ? <br> Votre avis est important. <br> <strong>Merci de nous le faire savoir en envoyant un message maintenant !</strong></p>
            
            <form method="post" enctype="multipart/form-data" autocomplete="off">           
              <div class="col-sm-12">
                <?php
                       if(isset($errMSG)){
                     ?>  
                        <div class="alert alert-danger letexte" role="alert">
                            <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                      }
                      elseif(isset($warningMSG)){
                    ?>
                        <div class="alert alert-warning letexte" role="alert">
                            <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $warningMSG; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        }
                        else if(isset($successMSG)){
                    ?>
                        <div class="alert alert-success letexte" role="alert">
                            <strong><span class="glyphicon glyphicon-ok-sign"></span> <?php echo $successMSG; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php  }  ?>
              </div>
              <div class="col-sm-12">
                    <div class="form-group">
                  <input type="text" name="sendnom" placeholder="Nom et Prénoms*" class="exp_name form-control"  required="required"/>
                </div>
                <div class="form-group">
                  <input type="email" name="sendmail" placeholder="Votre E-mail*" class="exp_mail form-control"  required="required" />
                </div>
                <div class="form-group">
                  <input type="tel" name="sendphone" placeholder="Votre Téléphone*" class="exp_phone form-control"  required="required" />
                </div>
                <div class="form-group">
                  <input type="text" name="sendobjet" placeholder="Objet du message*" class="exp_objmsg form-control"  required="required"/>
                </div>
                <div class="form-group">
                  <textarea name="sendmsg" placeholder="Votre Message *" class="exp_msg form-control " id="mymessage"  required="required"></textarea>
                </div>
                
              </div>
              <div class="col-sm-12" id="verifier">
                <div class="form-group">
                  <p><?php //require_once('captcha.php');?> <label>Captcha: <span style="color:#f00;"> <?php //=captcha0();?> </span></label> </p>
                
                  <input type="text" name="filtreform" autocomplete="off" placeholder="Entrer ici les caracteres rouges ! *" class="form-control msg_captcha"  required="required" /> 
                </div>
              </div>
              <div class="form-group text-center">
                <button type="submit" name="sendform" class="btn btn-default-color btn-lg submit_form"><i class="fa fa-envelope"></i> Envoyez votre Message</button>
              </div>
            </form>
          </div>  
          <!-- END MAIN CONTENT -->

        </div>
      </div>
    </div>
    <br><br>
    
    

  <script>
    $(document).ready(function(){
      var hiddenbox= $("#verifier");
      var messg= $("#mymessage");
        hiddenbox.hide();
        messg.focus(function(){
            hiddenbox.show();
          });/*
        messg.blur(function(){
            hiddenbox.hide();
          });
*/    });
    </script>