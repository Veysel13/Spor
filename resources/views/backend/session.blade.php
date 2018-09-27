veysel
<?php print_r($id);


for ($i=1;$i<(count($id)-2)/4;$i++){
    echo "<br>";
    print_r($id['ekleyen_id']);
    echo "<br>";
    print_r($id['combobox']);
    echo "<hr>";
    print_r($id['egzersiz-'.$i]);
    print_r($id['set-'.$i]);
    print_r($id['tekrar-'.$i]);

    print_r($id['dinlenme-'.$i]);
    echo "<br>";
}



?>
