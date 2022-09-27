 <?php 
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    {
        $url = "https";
    }
    else
    {
        $url = "http"; 
    }  
    $url .= "://"; 
    $url .= $_SERVER['HTTP_HOST']; 
    $url .= $_SERVER['REQUEST_URI']; 


  if(isset($oneartisan) && $oneartisan!==" "){
    $meta_descr=$oneartisan->meta_description;
     $meta_author="infoci.info";
    $meta_keywd=$oneartisan->meta_kwdshop;
    $title=$oneartisan->meta_titleshop . " | INFOCISHOP, la vitrine de l'authentique | BOTHENTIK, c'est Beau et Authentique ! | www.infoci.info" ;
    $seoimage="https://www.infoci.info/app/Views/infocishop/imgshop/".$oneartisan->ph1;

    }else{
      $meta_author="KIKOUN Alain KONE ";
      $meta_keywd="rendez-vous, Showbiz de Babi, opportunit&eacute;, Buzz, religion ivoirienne, Mode et beaut&eacute;, Sport, Education, esth&eacute;tique";
      $meta_descr="BOTHENTIK, espace de promotion pour petit budget. BOTHENTIK, réservé aux commerçants et artisans de la mode, du vestimentaire et de l'art. Avec BOTHENTIK, mettez les projecteurs sur votre boutique, atelier, votre business. BOTHENTIK, c'est beau et authentique !";
    $title="INFOCISHOP, la vitrine de l'authentique | BOTHENTIK, c'est Beau et Authentique ! | www.infoci.info";
  }

 ?>

<head>
  <link rel="stylesheet" type="text/css" href="public/front/bootstrap-3.3.7/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="public/front/bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="public/front/perso/stylebase.css">
   <!--  <link rel="stylesheet" type="text/css" href="apparence/css/sticky-footer.css"> -->
  <style type="text/css">

    #myImg1,#myImg2,#myImg3,#myImg4 {
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }

   /* #myImg1:hover ,#myImg2:hover ,#myImg3:hover ,#myImg4:hover {opacity: 0.7;}*/
    #myImg1:hover ,#myImg2:hover ,#myImg3:hover ,#myImg4:hover {left: 0; top: 0; width: 100%; background: url(app/Views/infocishop/imgshop/zoom-in.png) 50% 54% no-repeat #000; opacity: .5; color: #FFF;}

    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    .modal-content{
        margin: auto;
        display: block;
        width: 100%;
        max-width: 700px;
      }


    /* Caption of Modal Image */
    #caption {
      width: 100%;
      z-index: 1;
      position: absolute;
      margin-left: auto;
      margin-right: auto;
      display: block;
      text-align: center;
      color: #ccc;
      top:87%;
      padding: 10px 0;
      height: 150px;
    }

    /* Add Animation */
    .modal-content, #caption {  
      -webkit-animation-name: zoom;
      -webkit-animation-duration: 0.6s;
      animation-name: zoom;
      animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
      from {-webkit-transform:scale(0)} 
      to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
      from {transform:scale(0)} 
      to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
      position: absolute;
      z-index: 1;
      top: 90px;
      right: 305px;
      color: #bf3e02;
      opacity: 1;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
    }

    .close:hover,
    .close:focus {
      color: #bbb;
      text-decoration: none;
      cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
      .modal-content {
        width: 100%;
      }
    }

  </style>
</head>
<body>

  <div class="container" style="min-height:480px;">

    <div class="row">

      <div class="col-sm-8 blog-main">
        <ul class="breadcrumb">
          <li><a href="http://www.infoci.info/">Accueil </a></li>
          <li><a href="?p=bothentik.index">Bothentik</a></li>
          <li><a href="?p=bothentik.allShopByCategorie&list=<?=$categname->orderbtkcateg;?>"><?=$categname->btkcateg_lib; ?></a></li>
          <li><?=ucfirst(substr($oneartisan->nom_artisan, 0, 200)); ?></li>
        </ul>
        <div class="blog-post">
          <?php if(isset($oneartisan) && $oneartisan!=false){ ?>
          <section class="jobox">

          
          <div class="text-center" style="margin-top: 20px;">
            <?php 
            if(isset($oneartisan->logobtk) && $oneartisan->logobtk!=="logobtk.png"){ 
              $chemin = "app/Views/infocishop/imgshop/".$oneartisan->logobtk;  
              $infos_image = @getImageSize($chemin);
              $largeur = $infos_image[0];
              $hauteur = $infos_image[1];
              if ($largeur==$hauteur){ 
            ?> 
                <img class="rounded-circle" src="app/Views/infocishop/imgshop/<?=$oneartisan->logobtk; ?>" alt="<?=substr(html_entity_decode($oneartisan->nom_artisan), 0,50); ?>" width="75" height="75">
            <?php 
              }else{ 
            ?>
                <img class="rounded-circle" src="app/Views/infocishop/imgshop/<?=$oneartisan->logobtk; ?>" alt="<?=substr(html_entity_decode($oneartisan->nom_artisan), 0,50); ?>" style="width:15%; Height:15%;">
            <?php   
              }
            }else{} 
            ?>
          </div>
          <div class="text-center">
            <h1 class="jumbotron-heading text-center">
              <b>
                <span style="color:#007bff; font-size:0.5em;"><?=ucfirst(html_entity_decode($oneartisan->nom_artisan)); ?></span>
              </b>
            </h1>
          </div>
            <div class="text-muted col-xs-12 col-sm-12 col-md-12" style="">                
              <?=htmlspecialchars_decode($oneartisan->presentation); ?>
              <hr>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12" style="">
              <div class="col-sm-6"> 
                <p class=" text-muted"><b>Adresses et contacts </b>
                  <br><i class="fa fa-map-marker"></i> &nbsp; &nbsp; <?=html_entity_decode($oneartisan->zone_nom); ?>
                  <br><i class="fa fa-map-marker"></i> &nbsp; &nbsp; <?=html_entity_decode($oneartisan->adressgeo); ?>
                  <br><i class="fa fa-phone"></i> &nbsp; &nbsp; <?=html_entity_decode($oneartisan->contactphone); ?>
                  <br><i class="fa fa-envelope"></i> &nbsp; &nbsp; <?=html_entity_decode($oneartisan->courriel); ?>
                     <?php if(isset($oneartisan->weblink) && $oneartisan->weblink!==""){ ?>
                  <br><i class="fa fa-globe"></i> &nbsp; &nbsp; <a href="<?=html_entity_decode($oneartisan->weblink); ?>" target="_blank">Me Suivre en ligne</a>
                  <?php }else{} ?> 
                </p>
              </div> 
              <div class="col-sm-6">
                <?php if(isset($oneartisan->video_url) && $oneartisan->video_url!==""){ ?>
                <p class=""><b>WATCH ME !</b>
                  <br>
                  <iframe width="220" height="150" src="<?=html_entity_decode($oneartisan->video_url); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </p>
                  <?php }else{} ?>
              </div>
            </div>  

          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-12 col-sm-12 col-md-6" style="">
              <figure>
                <img class="media-object img-responsive thumbnail" src="app/Views/infocishop/imgshop/<?=$oneartisan->ph1; ?>" alt="<?=$oneartisan->nom_artisan; ?>" id="myImg1"  onclick="onClick(this)" title="Agrandir l'image au clic.">
                <?php if(isset($oneartisan->foto_author) && $oneartisan->foto_author!=NULL && isset($oneartisan->foto_legend)){ ?>
                  <figcaption><i><?=$oneartisan->foto_legend; ?> || Crédit photo: <b><?=ucfirst($oneartisan->foto_author); ?></b></i>
                  </figcaption>
                <?php }elseif(isset($oneartisan->foto_legend)){ ?>
                  <figcaption><i><?=$oneartisan->foto_legend; ?></i>
                  </figcaption>
                <?php } ?>
              </figure>            
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="">
              <figure>
                <img class="media-object img-responsive thumbnail" src="app/Views/infocishop/imgshop/<?=$oneartisan->ph2; ?>" alt="<?=$oneartisan->nom_artisan; ?>" id="myImg2"  onclick="onClick(this)" title="Agrandir l'image au clic.">
                <?php if(isset($oneartisan->foto_author) && $oneartisan->foto_author!=NULL && isset($oneartisan->foto_legend)){ ?>
                  <figcaption><i><?=$oneartisan->foto_legend; ?> || Crédit photo: <b><?=ucfirst($oneartisan->foto_author); ?></b></i>
                  </figcaption>
                <?php }elseif(isset($oneartisan->foto_legend)){ ?>
                  <figcaption><i><?=$oneartisan->foto_legend; ?></i>
                  </figcaption>
                <?php } ?>
              </figure>            
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-12 col-sm-12 col-md-6" style="">
              <figure>
                <img class="media-object img-responsive thumbnail" src="app/Views/infocishop/imgshop/<?=$oneartisan->ph3; ?>" alt="<?=$oneartisan->nom_artisan; ?>" id="myImg3"  onclick="onClick(this)" title="Agrandir l'image au clic.">
                <?php if(isset($oneartisan->foto_author) && $oneartisan->foto_author!=NULL && isset($oneartisan->foto_legend)){ ?>
                  <figcaption><i><?=$oneartisan->foto_legend; ?> || Crédit photo: <b><?=ucfirst($oneartisan->foto_author); ?></b></i>
                  </figcaption>
                <?php }elseif(isset($oneartisan->foto_legend)){ ?>
                  <figcaption><i><?=$oneartisan->foto_legend; ?></i>
                  </figcaption>
                <?php } ?>
              </figure>            
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="">
              <figure>
                <img class="media-object img-responsive thumbnail" src="app/Views/infocishop/imgshop/<?=$oneartisan->ph4; ?>" alt="<?=$oneartisan->nom_artisan; ?>" id="myImg4"  onclick="onClick(this)" title="Agrandir l'image au clic.">
                <?php if(isset($oneartisan->foto_author) && $oneartisan->foto_author!=NULL && isset($oneartisan->foto_legend)){ ?>
                  <figcaption><i><?=$oneartisan->foto_legend; ?> || Crédit photo: <b><?=ucfirst($oneartisan->foto_author); ?></b></i>
                  </figcaption>
                <?php }elseif(isset($oneartisan->foto_legend)){ ?>
                  <figcaption><i><?=$oneartisan->foto_legend; ?></i>
                  </figcaption>
                <?php } ?>
              </figure>            
            </div>
          </div>
              
            <br>             
            <br> 
            
          </section>

          <!-- MODAL pop up -->
          <div id="modal01" class="modal" onclick="this.style.display='none'">
            <span class="close">&times;</span>
            <div class="modal-content">
              <img id="img01" style="min-width:50%; max-width:100%" class="modal-content thumbnail responsive">
              <div id="caption"></div>      
            </div>
          </div>
          <!-- MODAL pop up -->

          <?php }else{ echo "Cet Article n'est plus disponible !"; } ?>
        </div><!-- /.blog-post -->
      </div><!-- /.blog-main -->
      <br>


      <div class="col-sm-4 blog-sidebar">
        <div class="sidebar-module sidebox">          
          <h4 class="text-center">Categories prestataires</h4>
          <p>
            <ul class="categories">
              <?php if(isset($blogcateg) && !empty($blogcateg)){foreach ($blogcateg as $categoriesblog): ?>
                <li><a href="?p=bothentik.allShopByCategorie&list=<?=$categoriesblog->orderbtkcateg;?>"><?=ucfirst($categoriesblog->btkcateg_lib);?> <span> </span></a></li>
              <?php endforeach;}else{ echo "Aucun Blog disponible pour l'instant !";} ?>
              <!-- <li><a href="#">Commercial <span>(1)</span></a></li>
              <li><a href="#">Land <span>(3)</span></a></li>
              <li><a href="#">Loans <span>(2)</span></a></li>
              <li><a href="#">News and Updates <span>(6)</span></a></li>
              <li><a href="#">Properties for Sale <span>(1)</span></a></li>
              <li><a href="#">Real Estate <span>(1)</span></a></li> -->
            </ul>
          </p>  
          <p></p>
        </div>
        <div class="sidebar-module sidebox">
          <img src="app/Views/infocijob/pub/300X600.jpg" class="img-thumbnail text-center">
        </div>
        <div class="sidebar-module sidebox">
          
        </div>
      </div><!-- /.blog-sidebar -->

    </div><!-- /.row -->
    

  </div><!-- /.container -->

    <!-- Script MODAL -->
  <script type="text/javascript">
    function onClick(element) {
      document.getElementById("img01").src = element.src;
      document.getElementById("modal01").style.display = "block";
      document.getElementById("caption").innerHTML=element.alt;
    }
  /*console.log(img01);*/
  </script>
</body>

    
