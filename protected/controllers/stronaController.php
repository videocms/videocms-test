<?php

class StronaController extends CController
{
    public function actionIndex() {
        echo 'Została wywołana akcja Index';
    }
    
    public function actionPokaz(){
        echo 'Została wywołana akcja Pokaż';
    }
}

?>