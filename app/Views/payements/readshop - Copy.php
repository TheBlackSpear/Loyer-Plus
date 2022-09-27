<?php

  if(isset($infociseo) && $infociseo!==" "){
    $meta_descr=$infociseo->seo_description;
     $meta_author=$infociseo->seo_auteur;
    $meta_keywd=$infociseo->seo_keyword;
    $title="INFOCIBLOG : ". $infociseo->seo_titre;
    }else{
      $meta_author="KIKOUN Alain KONE ";
      $meta_keywd="rendez-vous, Showbiz de Babi, opportunit&eacute;, Buzz, religion ivoirienne, Mode et beaut&eacute;, Sport, Education, esth&eacute;tique";
      $meta_descr="infoci.info, Support de buzz num&eacute;rique mondial. Explosion de vues sur votre manifestation. ";
    $title=" INFOCIBLOG: Informer pour l'harmonie. || www.infoci.info";
  }
 ?>

<head>
    <link rel="stylesheet" type="text/css" href="public/front/bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/front/bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="public/front/perso/stylebase.css">
   <!--  <link rel="stylesheet" type="text/css" href="apparence/css/sticky-footer.css"> -->
</head>
<body>

  <div class="container" style="min-height:480px;">

    <div class="row">

      <div class="col-sm-8 blog-main">
        <ul class="breadcrumb">
          <li><a href="http://www.infoci.info/">Accueil </a></li>
          <li><a href="?p=blog.index">Blog</a></li>
          <li><a href="?p=blog.allBlogByCategorie&list=<?=$categname->ordercategorie;?>"><?=$categname->categorie_lib; ?></a></li>
          <li><?=ucfirst(substr($oneblog->blogtitle, 0, 200)); ?></li>
        </ul>
        <div class="blog-post">
          <?php if(isset($oneblog) && $oneblog!=false){ ?>
          <section class="jobox">
            
            <span style="font-style:italic; font-size:14px; color:rgb(51, 122, 183); font-weight:bold;">
              <h3><?=ucfirst($oneblog->blogtitle); ?></h3> 
          </span>

          <br><b>Rubrique:</b> <?=$oneblog->categorie_lib; ?>  |
            <b>Auteur:</b> <?=ucwords(substr($oneblog->pseudoauteur, 0, 20)); ?>  |
            <b>Publi&eacute; le:</b> <span style="font-style:italic; font-size:11px; color:#0ac45b;"><?=$oneblog->dateadd; ?></span> &nbsp; | &nbsp; 
            <b>Mise à jour:</b> <span style="font-style:italic; font-size:11px; color:#fc1e3c;"><?=$oneblog->updte; ?></span>              
            <br>     

          <div class="" style="">
            <figure>
              <img class="media-object img-responsive" src="app/Views/infociblog/imgblog/<?=$oneblog->blogimg2; ?>" alt="<?=$oneblog->blogtitle; ?>">
              <?php if($oneblog->foto_author!=NULL){ ?>
                <figcaption><i><?=$oneblog->foto_legend; ?> || Crédit photo: <b><?=ucfirst($oneblog->foto_author); ?></b></i>
                </figcaption>
              <?php }else{ ?>
                <figcaption><i><?=$oneblog->foto_legend; ?></i>
                </figcaption>
              <?php } ?>
            </figure>            
          </div>
      
              
            <br>             
            <br> 
              <?=htmlspecialchars_decode($oneblog->blogcontent); ?>
            <br><br> <i>Rédigé par : <b><?=$oneblog->pseudoauteur; ?></b></i> 
            </p>
          </section>
          <?php }else{ echo "Cet Article n'est plus disponible !"; } ?>
        </div><!-- /.blog-post -->
      </div><!-- /.blog-main -->
      <br>


      <div class="col-sm-4 blog-sidebar">
        <div class="sidebar-module sidebox">          
          <h4 class="text-center">Categories blog</h4>
          <p>
            <ul class="categories">
              <?php if(isset($blogcateg) && !empty($blogcateg)){foreach ($blogcateg as $categoriesblog): ?>
                <li><a href="?p=blog.allBlogByCategorie&list=<?=$categoriesblog->ordercategorie;?>"><?=$categoriesblog->categorie_lib;?> <span> </span></a></li>
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

</body>

    
