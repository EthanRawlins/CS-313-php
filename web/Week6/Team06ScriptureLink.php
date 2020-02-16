<?php
  session_start();

$book;
if(isset($_POST["book"])){
    $book = $_POST["book"];
}

$chapter;
if(isset($_POST["chapter"])){
    $chapter = $_POST["chapter"];
}

$verse;
if(isset($_POST["verse"])){
    $verse = $_POST["verse"];
}

$content;
if(isset($_POST["content"])){
    $content = $_POST["content"];
}

$topicArray = array ();
//Pushes all chosen continent values if checked by user
if(isset($_POST["Faith"])){
    array_push($topicArray, $_POST["Faith"]);
}
if(isset($_POST["Sacrifice"])){
    array_push($topicArray, $_POST["Sacrifice"]);
}
if(isset($_POST["Charity"])){
    array_push($topicArray, $_POST["Charity"]);
}



  $dbUrl = getenv('DATABASE_URL');

  if (empty($dbUrl)) {
   // example localhost configuration URL with postgres username and a database called cs313db
   $dbUrl = "postgres://postgres:password@localhost:5432/cs313db";
  }
  
  $dbopts = parse_url($dbUrl);
  
  $dbHost = $dbopts["host"];
  $dbPort = $dbopts["port"];
  $dbUser = $dbopts["user"];
  $dbPassword = $dbopts["pass"];
  $dbName = ltrim($dbopts["path"],'/');
  
  //print "<p>pgsql:host=$dbHost;port=$dbPort;dbname=$dbName</p>\n\n";
  
  try {
   $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
  }
  catch (PDOException $ex) {
   print "<p>error: $ex->getMessage() </p>\n\n";
   die();
  }
  
  //Inserts
  $scriptureInsert = "INSERT INTO scripture (book, chapter, verse, content)
  VALUES ('$book', $chapter, $verse, '$content')";

$stmt = $db->prepare($scriptureInsert);
$stmt->execute();

  $scriptureId;
  $topicsId;

    foreach ($db->query('SELECT id FROM scripture;') as $row)
    {
        $scriptureId = $row['id'];;
    }

  

    foreach ($topicArray as $topic)  {
        //Link Insert
        //$topicsId = $topic;
        $linkInsert = "INSERT INTO scripture_link (scripture, topics) 
        VALUES ($scriptureId, $topic)";

        $stmt = $db->prepare($linkInsert);
        $stmt->execute();
    }


 
  
 

?>

<!DOCTYPE HTML>
<html lang="en-us">
<head>
<meta charset="utf-8">
<title>Scripture Link</title>
<script>

</script>
</head>

<body>
<header> 
</header>
Please enter a Book: 
</header>
<form action="Team06ScriptureDisplay.php" method="POST">
<input name="book" type="text"><br><br>
<input name="chapter" type="text"><br><br>
<input name="verse" type="text"><br><br>
<input name="content" type="textarea"><br><br>

Select Topic(s):
  <input type="checkbox" name ="Faith" value="1">Faith<br>
  <input type="checkbox" name ="Sacrifice" value="2">Sacrifice<br>
  <input type="checkbox" name ="Charity" value="3">Charity<br>
  <br><br>
<input type="submit" name= "submit" value="Submit">
</form>
    
</div>
</body>
</html>