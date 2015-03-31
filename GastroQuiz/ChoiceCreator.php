<!DOCTYPE html>
<html>
<body>
<head>
	<link rel = "stylesheet" type = "text/css" href = "./css/ChoiceCreator.css">
</head>


<?php


function choiceLeftOut($fileName,$fullList)
# function to return the left out choices
{
  $fileToOpen = fopen($fileName,'r');
  #open the file in read mode.
  
  $chosen = array();
  #a array variable to hold the chosen choices
  
  while (!feof($fileToOpen))
  #while not reaching the end of file
  {
    $currentChosen = rtrim(fgets($fileToOpen));
    
    if (strlen($currentChosen) > 0)
    {
      array_push($chosen,$currentChosen);
    }
    
    
  }
  
  $arrayToReturn = array_diff($fullList,$chosen);
  fclose($fileName);
  return $arrayToReturn;
  
}

$folder = $_POST["QuizRounds"];
echo "<h1>Menu Card-".$folder."</h1>";
#this variable will hold the quiz round that was selecte from main.php
#echo $folder;

$imageFolder = "./".$folder."/"."Images";
#this variable will hold the location of the images of the chosen round
#echo $imageFolder;

$a = array_diff(scandir($imageFolder,1),array('..','.'));
#the above operation will weed out the . and .. from the array returned by scandir function
#print_r ($a);

$choiceFile = "./".$folder."/"."Choice.txt";
#this variable will hold the location of the choices chosen text file.
#echo $choiceFile;

$toDisplay = choiceLeftOut($choiceFile,$a);
#print_r ($toDisplay);

$i = 1;
#to name the forms diffrently

# conditional to tackle the diffrent HiddenIdentity
if ($folder == "HiddenIdentity")
{
	$formHandlder = "HiddenIdentity.php";
}
else
{
	$formHandlder = "QuestionDisplay.php";
}

echo "<table style=\"width:100%\">";
echo "<tr>";

foreach ($toDisplay as $picture)
#programmatically create the forms
#tabulation to be added.
{
  
  echo "<form name=\"$i\"";
  echo "action=\"$formHandlder\" method=\"POST\">";
  
  $icon = $imageFolder."/".$picture;
  
  echo "<td>";
  echo "<input type=\"image\"";
  echo " src=\"$icon\"";
  echo " name =\"image\">";
  echo "</td>";
  
  echo "<input type=\"hidden\"";
  echo " name =\"file\"";
  echo " value=\"$picture\">";
  
  echo "<input type=\"hidden\"";
  echo " name =\"QuizRounds\"";
  echo " value=\"$folder\">";
  
  echo "</form>";
  
  
 
  $i = $i + 1;
  
}
echo "</tr>";
echo "</table>";
?>

</body>
</html> 