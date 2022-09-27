
<div class="content">
  <div class="container">
    <div>
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
        
<p><b>Veuillez Cliquer le bouton #<i>Valider mon Compte</i># ci-dessous</b></p><br>
<form method="post">
	<button type="submit" name="okcompte">Valider compte</button>
</form>
</div>
</div>
</div>