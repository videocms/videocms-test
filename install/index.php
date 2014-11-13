<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Instalacja bazy danych</title>
         <link href="../js/libs/twitter-bootstrap/css/bootstrap.css" rel="stylesheet" />
         <script src="../js/jquery-1.11.1.min.js"></script>
         <script src="../js/libs/twitter-bootstrap/js/bootstrap.min.js"></script>
         <style>
             .bg-white {
                 background: #FFF;
             }
             .home-section {
                 width: 100%;
                 padding: 90px 0px 150px 0px;
             }
             section {
                 display: block;
             }
             .section-heading {
                 margin-bottom: 70px;
             }
             .section-heading h2 {
                 font-size: 38px;
                 text-transform: uppercase;
             }
             h2 {
                 color: #3A3A3A;
                 font-weight: 700;
                 margin-bottom: 20px;
                 font-family: 'Montserrat', sans-serif;
             }
             .btn-theme {
                 background: #529abb;
                 color: #FFF;
             }
             .btn-theme:hover {
                 background: transparent !important;
                 border-color: #999;
                 color: #999;
             }
         </style>
    </head>
    <body>
        <section class="home-section bg-white">
            <div class="container">  
                <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="section-heading">
                    <center> <h2>Instalacja</h2>
                        <p>Proszę uzupełnić poprawnie pola, aby zainstalować bazę danych!</p>
                        </center></div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-1 col-md-10">
                        <form action="install.php" method="post" class="form-horizontal" role="form">
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-8">
                                    <input type="text" class="form-control" placeholder="Host serwera" name="host">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-8">
                                    <input type="text" class="form-control" placeholder="Nazwa użytkownika bazy danych" name="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-8">
                                    <input type="password" class="form-control" placeholder="Hasło użytkownika bazy danych" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-8">
                                    <input type="text" class="form-control" placeholder="Nazwa bazy danych" name="database">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-8">
                                     <input type="submit" class="btn btn-theme btn-lg btn-block" value="Instaluj bazę danych">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            
        
            </div>
        </section>
    </body>
</html>
