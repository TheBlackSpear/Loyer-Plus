
<head>
    <link rel="stylesheet" type="text/css" href="public/front/bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/front/bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="public/front/perso/stylebase.css">
   <!--  <link rel="stylesheet" type="text/css" href="apparence/css/sticky-footer.css"> -->
</head>
<!-- BEGIN PAGE TITLE/BREADCRUMB -->
<div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="page-title">Mon Compte</h1>
        
        <ul class="breadcrumb">
          <li><a href="">Accueil </a></li>
          <li><a href="?p=locataire.compteConnected">compte</a></li>
          <li><a href="#">Mes bailleurs</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- END PAGE TITLE/BREADCRUMB -->
<hr>

<div class="container" style="min-height:480px;">

  <!-- si recruteur connecte Afficher son compte sinon Texte BREF Conditions et Form connexion ou Form inscription-->
  <div class="row">
    
    <div class="col-sm-12 blog-main">
      <div class="blog-masthead">
        <div class="container">
          <nav class="blog-nav">
            <a href="?p=logout.accountclose" class="blog-nav-item"><span style="font-weight:bold; font-size:18px; color:#ce0823"><i class="fa fa-sign-out"></i></span></a> 
            <a href="?p=locataire.compteConnected" class="blog-nav-item">
            <b><?=$_SESSION['nom_locataire']; ?></b> 
            </a>
            <a class="blog-nav-item" href="?p=locataire.editMdp">Mot de passe</a>
            <a class="blog-nav-item" href="?p=locataire.bailleursListe">Mes Bailleurs</a>
            <a class="blog-nav-item" href="?p=locataire.mespayements">Mes Payements</a>
            <a class="blog-nav-item" href="?p=locataire.finance">Mes Finances</a>
          </nav>
        </div>
      </div>
      <div class="blog-post">
        <section class="jobox">
          <div  class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12" style="overflow: scroll;">       
                 <?php
                    if(isset($warningMSG)){
                  ?>
                        <div class="alert alert-warning" style="margin-top:10px;">
                          <span class="fa fa-info-circle"></span> <strong><?php echo $warningMSG; ?></strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                  <?php
                      }
                  ?>
                      
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="7" class="text-center">
                    <b>Liste de mes Bailleurs</b>
                  </th>
                </tr>
                <tr>
                  <th class="text-center" scope="row">#</th>
                  <th class="text-center" scope="row">Nom</th>
                  <th class="text-center" scope="row">Prénoms</th>
                  <th class="text-center" scope="row">Téléphone</th>
                  <th class="text-center" scope="row">Loyer à payer</th>
                  <th colspan="2" class="text-center" scope="row">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php if(isset($bailleurListe) && !empty($bailleurListe)){ foreach ($bailleurListe as $offreindiv) { //var_dump($offreindiv);?>
                <tr>
                  <td class="text-center" ><?=$offreindiv->idbailleurs; ?></td>
                  <td class="text-center" ><?=$offreindiv->nom_bailleurs; ?></td>
                  <td class="text-center" ><?=$offreindiv->prenoms_bailleurs; ?></td>
                  <td class="text-center" ><?=$offreindiv->phone_bailleurs; ?></td>
                  <td class="text-center" > <?=$offreindiv->loyer; ?> F CFA</td>
                  <td class="text-center" >
                    <a href="?p=testpayement.index&bail=<?=$offreindiv->iduniq_bailleurs;?>&suitable=<?=$offreindiv->iduniq_locataires; ?>&home=<?=$offreindiv->iduniq_pat;?>" title="Payer son loyer">
                      <button class="btn btn-success">  <span style="font-size:1em; font-weight:bold;"><i class="fa fa-money" aria-hidden="true"></i> Payer</span>
                      </button>
                    </a>
                  </td>
                  <td class="text-center" >
                    <a href="?p=locataire.readMorebailleur&suitable=<?=$offreindiv->iduniq_locataires; ?>" title="Lire plus">
                      <button class="btn btn-primary"> <span style="font-size:1em; font-weight:bold;"><i class="fa fa-search" aria-hidden="true"></i> Lire</span></button>
                    </a>
                  </td>
                </tr> 
              <?php }}else{}?>              
              </tbody>
            </table>
              <?php if(isset($pageno) && isset($total_pages)){ ?>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <ul class="pagination">
                  <li><a href="?p=locataire.bailleursListe&pageno=1">Debut</a></li> &nbsp;&nbsp;
                  <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                      <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?p=locataire.bailleursListe&pageno=".($pageno - 1); } ?>">Precedent</a>
                  </li>&nbsp;&nbsp;
                  <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?p=locataire.bailleursListe&pageno=".($pageno + 1); } ?>">Suivant</a>
                  </li>&nbsp;&nbsp;
                  <li><a href="?p=locataire.bailleursListe&pageno=<?php echo $total_pages; ?>">Fin</a></li>
                </ul>
              </div> <?php } ?>
            </div>
              <br><br>
          </div>
        </section>
      </div><!-- /.blog-post -->
    </div><!-- /.blog-main -->
    <br>

  </div><!-- /.row -->
</div><!-- /.container -->