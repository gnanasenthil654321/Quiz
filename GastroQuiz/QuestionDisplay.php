<html>
<head>
	<link rel = "stylesheet" type = "text/css" href = "./css/QuestionDisplay.css">
</head>
<body>



<?php 

$toWrite = $_POST["file"]."\n";
#will hold just the name of file chosen with a newline Charecter.
#echo $toWrite;
#echo "<br>";

$forFileName = $_POST["file"];

$folder = $_POST["QuizRounds"];
#will hold the just the name of the round chosen
#echo $folder;
#echo "<br>";



$fileWrite = "./".$folder."/"."Choice.txt";
#will create and hold the location of the correponding choice.txt file
#echo $fileWrite;
#echo "<br>";



$fileToOpen = fopen($fileWrite,'a') or die('failed');
fwrite($fileToOpen,$toWrite);

fclose($fileToOpen);
#echo $toWrite;
#echo "<br>";



#code to display the question

# our images are numbered from 1 to 6
# our files containing the questions are also numbered 1 to 6
# extract the basename of the filename of the picture,
# create the name of the text file by appending .txt

$dotPos = strpos($_POST["file"],".");
#echo $dotPos;



$stem = substr($_POST["file"],0,$dotPos);
#echo $stem;

$corresQues = $stem.".txt";
#echo $corresQues;
# contains just the file name

$quesFilePath = "./".$folder."/".$corresQues;
#echo $quesFilePath;

$quesFileToOpen = fopen($quesFilePath,'r') or die ("could not open question file");
#opening of file in read mode

#displaying the content of the file line by line as a paragraph 

$lineStore = array();

while (!feof($quesFileToOpen))
{
	array_push($lineStore,fgets($quesFileToOpen));
}

# displays the question
echo "<div id = \"questionDisplayArea\">";
echo "<p>";
foreach ($lineStore as $line)
{
	echo $line;
	echo "<br>";
}
echo "</p>";
echo "</div>";

#create the links for navigation
# three links, one to main.php, another to choiceCreator.php and another one to AnswerDisplayer.php

echo "<div id = \"navigators\">";
# to Choicecreator
echo "<div id = \"next\">";
echo "<form name=\"Choices\"";
echo "action=\"ChoiceCreator.php\" method=\"POST\">";
echo "<input type=\"image\"";
echo " src=\"./NavigationImages/next.jpg\"";
echo " name =\"next\">";

echo "<input type=\"hidden\"";
echo " name =\"QuizRounds\"";
echo " value=\"$folder\">";

echo "</form>";
echo "</div>";

# to AnswerDisplayer.php
echo "<div id = \"Answer\">";
echo "<form name=\"Choices\"";
echo "action=\"AnswerDisplayer.php\" method=\"POST\">";
echo "<input type=\"image\"";
echo " src=\"./NavigationImages/answer.jpg\"";
echo " name =\"answer\">";

echo "<input type=\"hidden\"";
echo " name =\"fileName\"";
echo " value=\"$forFileName\">";

echo "<input type=\"hidden\"";
echo " name =\"QuizRounds\"";
echo " value=\"$folder\">";

echo "</form>";
echo "</div>";

# to main.php
echo "<div id = \"home\">";
echo "<form name=\"Choices\"";
echo "action=\"main.php\" method=\"POST\">";
echo "<input type=\"image\"";
echo " src=\"./NavigationImages/home.jpg\"";
echo " name =\"home\">";
echo "</div>";

echo "</div>";
#
/*
this page should contain a hidden form to POST "QuizRounds" to the ChoiceCreator.php page.
*/
echo "<div id = \"timer\" style = \"float:left\">";
echo "<script src = \"./scripts/timer.js\" type = \"text/javascript\">";
echo "</script>";
if ($folder == "RapidFire")
{
	echo "<script src =\"./scripts/rapidFire.js\" type = \"text/javascript\">";
	echo "</script>";
	
}
else
{
	echo "<script src =\"./scripts/others.js\" type = \"text/javascript\">";
	echo "</script>";
}
echo "</div>";

?>




</body>
</html> 