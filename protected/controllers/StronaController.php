<?php
// jest to test
class StronaController extends CController
{
    public function actionIndex() {
        echo 'Została wywołana akcja Index';
    }
    
    public function actionPokaz(){
        echo 'Została wywołana akcja Pokaż';
    }
    
    public function actionPolicz($liczba1,$liczba2)
    {
        echo 'Wynikiem działania '.$liczba1.' + '.$liczba2.' jest '.($liczba1+$liczba2);
    }
}

?>