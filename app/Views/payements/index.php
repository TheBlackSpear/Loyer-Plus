  
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/front/perso/stylebase.css">
    <style>
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }

      tr:nth-child(even) {
        background-color: rgba(150, 212, 212, 0.4);
      }

      th:nth-child(even){
        background-color: rgba(150, 212, 212, 0);
      }

      td:nth-child(even) {
        background-color: rgba(150, 212, 212, 0.4);
      }
    </style>
</head>
<body>

<div class="main">
  <div class="container">
    <div class="row">
      <!-- Carousel================================================== -->
      <div id="myCarousel" class="carousel slide" data-ride="carousel" style="max-width: 1150px;">  
        <div class="carousel-inner" role="listbox">             
          <div class="item active">
            <img class="second-slide" src="app/Upload/image_fichiers/diapo_pic/banner_infoci.jpg" alt="Second slide" width="1150" height="300">
          </div> 
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div><!-- /.carousel -->
      <hr>
    </div><!-- fin row carousel -->
  </div>

  <div class="container alert alert-info text-center" style="min-height:480px;margin-top:15px;">
    <div class="row">
      <div class="col-sm-12 blog-main" style="margin-left:-4px; min-height:500px;"> 
        <div class="row"> 
          <div class="col-sm-12">
            
            <h3>PLATEFORME DE PAYEMENT</h3>
          </div> 
        </div> 
        <div class="col-sm-12">

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
           }elseif(isset($warningMSG)){
          ?>
            <div class="alert alert-warning" role="alert">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $warningMSG; ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php
            }else if(isset($successMSG)){
          ?>
          <div class="alert alert-success" role="alert">
              <strong><span class="glyphicon glyphicon-ok-sign"></span> <?php echo $successMSG; ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <?php  }  ?>
          <div class="row">
            <div class="col-md-12">
              <table style="width:100%">
                <tr>
                  <th class="text-center">LOYER MENSUEL</th>
                  <th class="text-center">MONTANT A PAYER</th>
                </tr>
                <tr>
                  <td class="text-center"><b><?=$loyerH; ?> F CFA</b></td>
                  <td class="text-center"><b><?=$loyerDu; ?> F CFA</b></td>
                </tr>
              </table>
            </div>
          </div>
          <br><br>
          <div class="row">
            <div class="col-md-12">              
              <form method="post">
                <div class="form-group col-sm-8">
                  <input type="text" name="numero-paymt" placeholder="Veuillez saisir votre numéro de payement MTN..." class="form-control">
                </div>
                <div class="form-group col-sm-4">
                  <input type="submit" name="pay-btn" class="btn btn-primary form-control" value="Payer">
                </div>
                  <input type="hidden" name="lebailleur" class="form-control" value="<?=$bailleur ;?>">
                  <input type="hidden" name="lelocataire" class="form-control" value="<?=$locataire ;?>">
                  <input type="hidden" name="lamaison" class="form-control" value="<?=$maison ;?>">
              </form>
            </div>
          </div>
        </div>  
        <br><br>


        <hr style="border:1px #085f8a dashed;">
      </div><!-- /.blog-main -->
    </div><!-- /.row -->
  </div> <!-- /container -->
</div> 
   
</body>
</html>

    

