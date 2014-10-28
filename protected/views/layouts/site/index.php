<!DOCTYPE html>
<html lang="pl">
<head>
        <meta charset="utf-8">
        <meta name="language" content="pl" />
        <meta name="advertising" content="ask" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
        <meta property="og:title" content="<?php echo CHtml::encode($this->pageTitle); ?>" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php   if (!empty($this->pageMetaDescription))
                    {
                        echo '<meta name="description" content="' . $this->pageMetaDescription . '" />';
                        echo '<meta property="og:description" content="' . $this->pageMetaDescription . '" />';
                    } 
                if (!empty($this->pageMetaRobots))
                    {
                        echo '<meta name="robots" content="' . $this->pageMetaRobots . '" />';
                        echo '<meta property="og:image" content="http://videocms-test.pl/' . $this->pageMetaOgImage.'" />';
                        echo '<meta property="og:locale" content="pl_PL"/>';
                    } 
                if (!empty($this->pageMetaKeywords))
                    {
                         echo '<meta name="keywords" content="' . $this->pageMetaKeywords . '" />';
                    }
        ?>
        <?php if ($this->ogtype == "yes")
        { ?>
        <meta property="og:type" content="video">
        <meta property="og:video" content="http://videocms-test.pl/embed/<?php echo $this->videoID; ?>-<?php echo $this->pageAlias; ?>">
       <!-- <meta property="og:video:secure_url" content="http://videocms-test.pl/embed/<?php //echo $this->videoID; ?>">-->
        <meta property="og:video:type" content="video/mp4">
        <meta property="og:video:width" content="1280">
        <meta property="og:video:height" content="720">
        <?php } ?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/pace.min.js"></script>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/videojs.vast.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/videojs-contrib-ads/videojs.ads.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/video-js.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/button-styles.css" rel="stylesheet" type="text/css" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/twitter-bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/component.css" rel="stylesheet" />
         <!-- Custom CSS -->
        <style type="text/css">
            #vid1 {
              width: 75%;
            }
            .pace .pace-progress {
              background: #29d;
              position: fixed;
              z-index: 2000;
              top: 0;
              left: 0;
              height: 2px;

              -webkit-transition: width 1s;
              -moz-transition: width 1s;
              -o-transition: width 1s;
              transition: width 1s;
            }

            .pace-inactive {
              display: none;
            }
            #image:hover {
                 background: url("http://videotube.marstheme.com/wp-content/themes/videotube/img/logo.png");
                 background-size: 80px 60px;
                 background-repeat: no-repeat;
                 opacity: 0.4;
                 filter: alpha(opacity=40); /* For IE8 and earlier */
            }
        </style>
        <style> 
            .captionOrange, .captionBlack
            {
                color: #fff;
                font-size: 20px;
                line-height: 30px;
                text-align: center;
                border-radius: 4px;
            }
            .captionOrange
            {
                background: #EB5100;
                background-color: rgba(235, 81, 0, 0.6);
            }
            .captionBlack
            {
                    font-size:16px;
                background: #000;
                background-color: rgba(0, 0, 0, 0.4);
            }
            a.captionOrange, A.captionOrange:active, A.captionOrange:visited
            {
                    color: #ffffff;
                    text-decoration: none;
            }
            a.captionOrange:hover
            {
                color: #eb5100;
                text-decoration: underline;
                background-color: #eeeeee;
                background-color: rgba(238, 238, 238, 0.7);
            }
            .bricon
            {
                background: url(<?php echo Yii::app()->request->baseUrl; ?>/js/slider-jquery/img/browser-icons.png);
            }
        </style>
        <!-- video -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/video.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/video-quality-selector.js"></script>
	<!--[if lt IE 9]><script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/es5.js"></script><![endif]-->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/videojs-contrib-ads/videojs.ads.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/vast-client.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/videojs.vast.js"></script>
        <script>
             videojs.options.flash.swf = "<?php echo Yii::app()->request->baseUrl; ?>/js/video/video-js.swf";
        </script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->      
</head>
<body style="padding-top:50px">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div id="wrapper">
        <div class="row">
          <div class="col-xs-5 col-sm-4 col-md-2" style="padding-top:7px; padding-left: 30px;">
              <a href="/"><img src="http://alexie.pl/logo.png" alt="tekst"></a>
         </div>
        <div class="col-xs-1 col-sm-1" style="padding-top:7px;"><button id="showLeft" class="btn btn-default"><span class="glyphicon glyphicon-align-justify"></span></button></div>
    <div class="col-xs-6 col-sm-6" style="padding-top:7px;">
        
        <div class="like" style="display: none;"><div class="col-xs-1" style="padding-top: 3px;"><img src="/css/img/OK-button.png"></div></div>
        <div class="dis-like" style="display: none;"><div class="col-xs-1" style="padding-top: 3px;"><img src="/css/img/OK-button.png"></div></div>
        <div class="dis-like-dis" style="display: none;"><div class="col-xs-1" style="padding-top: 3px;"><img src="/css/img/OK-button.png"></div></div>
        <div class="like-dis" style="display: none;"><div class="col-xs-1" style="padding-top: 3px;"><img src="/css/img/OK-button.png"></div></div>
      
        
<!--      <div class="input-group"> 
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Szukaj</button>
      </span>
          
      <input type="text" class="form-control">
    </div>-->

 <?php echo CHtml::form(Yii::app()->createUrl('search'),'get',array('class' => 'input-group')); ?>
            <?php echo CHtml::textField('search_key', '', array('class' => 'form-control')); ?>
    <span class="input-group-btn"><?php echo CHtml::submitButton('Szukaj',array('class' => 'btn btn-default', 'name' => 'search')); ?></span>
        <?php echo CHtml::endForm() ?>

  </div>
  </div>
  </div>
</div>
<div class="cbp-spmenu-push">
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
        
    <!-- Navigation -->

        <!-- Brand and toggle get grouped for better mobile display -->

           
            <!-- Collect the nav links, forms, and other content for toggling -->
          <!--  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
          <div>     <?php 
                        $this->widget('application.components.ActiveMenu',array(
                            //'id'=>'bs-example-navbar-collapse-1',
                           // 'items'=>$this->myMenu,
                           // 'htmlOptions'=>array(
                           //                'class'=>'nav navbar-nav'),
                          ) 
                        );
                ?>

              
            </div><!-- /.navbar-collapse -->

 </nav>
    <!-- Page Content -->
    
        <div class="main">
            <section>
       <?php echo $content; ?>
            </section>
            <hr>
            <footer>
                <div class="container">
                <p>© VideoCMS 2014</p>
                </div>
            </footer>
    </div>
    <!-- /.container -->
</div>
    <!-- jQuery -->
    <script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeft = document.getElementById( 'showLeft' ),
				body = document.body;

			showLeft.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
			}			
		</script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/twitter-bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/classie.js"></script>
    <br />
<?php 

$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$start = $time; 


$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$finish = $time; 
$totaltime = ($finish - $start); 
printf ("<small><center>Załadowanie strony trwało %f sekund.</center></small>", $totaltime); 

?> 
</body>
</html>
