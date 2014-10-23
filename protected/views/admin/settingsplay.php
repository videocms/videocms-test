<?php
echo '<h1>Player</h1>';
echo '<table class="table table-hover">';
echo '<tr class="active">';
echo '<th>Type</th>';
echo '<th>Autoplay</th>';
echo '<th>Edytuj</th>';
echo '<tr>';

foreach($Data as $ModelPlayerShow)
{
    if($Class == 0)
    {
        $Class = 1;
        $RowClass = 'row1';
    }
    else
    {
        $Class = 0;
        $RowClass = 'row2';
    }
    
    echo '<tr>';
    echo '<td class="'.$RowClass.'">'.$ModelPlayerShow['player_type'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelPlayerShow['player_autoplay'].'</td>';
    echo '<td class="'.$RowClass.'">';
    
    echo CHtml::link(
            'Edytuj',
            array('admin/settingsplayer/'.$ModelPlayerShow['player_id'])
            );
    echo '</td>';
    echo '</tr>';
}

echo '</table>';
?>

