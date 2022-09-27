
<!-- BEGIN PAGE TITLE/BREADCRUMB -->
<div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">Cr&eacute;ation de compte sur infoci.info</h1>
				
				<ul class="breadcrumb">
					<li><a href="http://www.infoci.info/">Accueil </a></li>
					<li><a href="#">Inscription</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE TITLE/BREADCRUMB -->

<div class="content">
	<div class="container">    
	    <br><br>
	    <div style=" margin-top:50px" class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
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
	                        <label for="lastname" class="col-md-3 control-label">Nom de famille</label>
	                        <div class="col-md-9">
	                            <input type="text" class="form-control" name="nomowner" placeholder="Nom de famille">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label for="firstname" class="col-md-3 control-label">Pr&eacute;nom(s)</label>
	                        <div class="col-md-9">
	                            <input type="text" class="form-control" name="prenomowner" placeholder="pr&eacute;nom(s)">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label for="email" class="col-md-3 control-label">Email</label>
	                        <div class="col-md-9">
	                            <input type="text" class="form-control" name="emailowner" placeholder="Adresse Email">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label for="login-password" class="col-md-3 control-label">Mot de passe</label>
	                        <div class="col-md-9">
	                            <input type="password" id="login-password" class="form-control" name="passowner" placeholder="mot de passe">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label for="password" class="col-md-3 control-label">Confirmation mot de passe</label>
	                        <div class="col-md-9">
	                            <input type="password" class="form-control" name="confpassowner" placeholder="mot de passe">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="control-label col-md-3" for="contacts">Contacts</label>
	                        <div class="col-md-9"><input name="contacts" type="text" placeholder="+225 00000000" class="form-control" id="contacts"></div>
	                    </div>
	                    <div class="form-group">	                        
	                        <div class="col-md-9">
						        <small for="terms_and_conditions">En cochant cette case, je déclare avoir pris connaissance des <a href="?p=apropos.cguinfoci" target="_blank">Conditions Générales d'Utilisation (CGU)</a> du site internet et les accepte :</small>
						        <input type="checkbox" name="cgucheck" id="terms_and_conditions" value="1" />
	                        </div>
	                    </div>
	                    <div class="form-group">
	                                <!-- Button -->                                        
	                        <div class="col-md-offset-3 col-md-9">
	                            <button type="submit" id="submit_button" class="btn btn-lg btn-primary btn-block" name="validaform" disabled><i class="icon-hand-right"></i> Envoyer </button>
	                        </div>
	                    </div>
	                </form>
	            </div>
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