<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="Team03FormHandle.php" method="POST"><br>
        Name: <input type="text" name="name"><br>
        Email: <input type="text" name="email"><br>
        <br>

        <?php
            $majors = array("Computer Science", "Web Design & Development", 
            "Computer Information Technology", "Computer Engineering");

            foreach ($majors as $value) {
                echo "<input type='radio' name='major' value='$value'> $value <br>";
            }
        ?>

        <!--<input type="radio" name="major" value="Computer Science">Computer Science<br>
        <input type="radio" name="major" value="Web Design & Development">Web Design & Development<br>
        <input type="radio" name="major" value="Computer Information Technology">Computer Information Technology<br>
        <input type="radio" name="major" value="Computer Engineering">Computer Engineering<br>
        <br>
        <br>-->

        Where have you visited?<br>
        <input type="checkbox" name="continent1" value="na">North America<br>
        <input type="checkbox" name="continent2" value="sa">South America<br>
        <input type="checkbox" name="continent3" value="eu">Europe<br>
        <input type="checkbox" name="continent4" value="as">Asia<br>
        <input type="checkbox" name="continent5" value="au">Australia<br>
        <input type="checkbox" name="continent6" value="af">Africa<br>
        <input type="checkbox" name="continent7" value="an">Antarctica<br>

        <!--<input type="checkbox" name="continent1" value="North America">North America<br>
        <input type="checkbox" name="continent2" value="South America">South America<br>
        <input type="checkbox" name="continent3" value="Europe">Europe<br>
        <input type="checkbox" name="continent4" value="Asia">Asia<br>
        <input type="checkbox" name="continent5" value="Australia">Australia<br>
        <input type="checkbox" name="continent6" value="Africa">Africa<br>
        <input type="checkbox" name="continent7" value="Antarctica">Antarctica<br>-->


        <br>
        Comments: <input type="textarea" name="comments"><br><br>

        <input type="submit" name="submit" value="Submit Form"><br>

        </form>
        



    </form>
</body>
</html>