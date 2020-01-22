<?php
$name = $_POST["name"];
$email = $_POST["email"];

$major = $_POST["major"];

$comments = $_POST["comments"];

$continents = array ();
//Pushes all chosen continent values if checked by user
if(isset($_POST["continent1"])){
    array_push($continents, $_POST["continent1"]);
}
if(isset($_POST["continent2"])){
    array_push($continents, $_POST["continent2"]);
}
if(isset($_POST["continent3"])){
    array_push($continents, $_POST["continent3"]);
}
if(isset($_POST["continent4"])){
    array_push($continents, $_POST["continent4"]);
}
if(isset($_POST["continent5"])){
    array_push($continents, $_POST["continent5"]);
}
if(isset($_POST["continent6"])){
    array_push($continents, $_POST["continent6"]);
}
if(isset($_POST["continent7"])){
    array_push($continents, $_POST["continent7"]);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <h1>Welcome <?php echo $name ?> </h1><br>
    Your Email is: <a href="mailto:" + <?php $email; ?>> <?php echo $email ?></a><br>
    Your Major is: <?php echo $major ?><br>

    Continents you Visited: <br>
        <?php
        foreach ($continents as $value) {
            switch ($value) {
                case "na":
                    echo "North America <br> ";
                    break;
                case "sa":
                    echo "South America <br>";
                    break;
                case "eu":
                        echo "Europe <br>";
                        break;
                case "as":
                    echo "Asia <br>";
                    break;
                case "au":
                    echo "Australia <br>";
                    break;
                case "af":
                    echo "Africa <br>";
                    break;
                case "an":
                    echo "Antarctica <br>";
                    break;
                default:
                    echo "None Chosen <br>";
            }
        }
        ?>

    <br>

    Comments: <?php echo $comments ?><br>

</body>
</html>





