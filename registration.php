<?php

    if($_POST)
    {
        $name1=$_POST['participant1'];

        echo 'successful';

        if(!empty($_POST["participant2"])){
        $name2=$_POST["participant2"];
        }

        else { $name2='nil'; }

        $email=$_POST["email"];
        $phone=$_POST["phone-number"];
        $school=$_POST["school"];
        $level=$_POST["level"];

        $string=$name1.",".$name2.",".$email.",".$phone.",".$school.",".$level."\n";

        $file = fopen("database.csv","a+");
        $status=fwrite($file,$string);
        fclose($file);

        if($status === false){ header("Location: unsuccessful.html "); }
        else { header("Location: successful.html"); }
    }
?>