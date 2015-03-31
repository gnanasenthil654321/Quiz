<html>

<body>
<head>
	<link rel = "stylesheet" type = "text/css" href = "./css/ChoiceCreator.css">
</head>
<?php 



$forFileName = $_POST["fileName"];

$folder = $_POST["QuizRounds"];
#will hold the just the name of the round chosen
#echo $folder;
#echo "<br>";




#code to display the answer

# our images are numbered from 1 to 6
# our files containing the questions are also numbered 1 to 6
# extract the basename of the filename of the picture,
# create the name of the answer text file by appending .txt

$dotPos = strpos($forFileName,".");
#echo $dotPos;



$stem = substr($forFileName,0,$dotPos);
#echo $stem;

$corresAns = $stem.".txt";
#echo $corresAns;
# contains just the file name

$quesFilePath = "./".$folder."/Answer/".$corresAns;
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
echo "<p style = \"color:black;font-size:200%;font-family:arial;text-align:center \">";
foreach ($lineStore as $line)
{
	echo $line;
	echo "<br>";
}
echo "</p>";

#create the links for navigation
# three links, one to main.php, another to choiceCreator.php and another one to AnswerDisplayer.php

# to Choicecreator
echo "<form name=\"Choices\"";
echo "action=\"ChoiceCreator.php\" method=\"POST\">";
echo "<input type=\"image\"";
echo " src=\"./NavigationImages/next.jpg\"";
echo " name =\"next\">";

echo "<input type=\"hidden\"";
echo " name =\"QuizRounds\"";
echo " value=\"$folder\">";

echo "</form>";




# to main.php
echo "<form name=\"Choices\"";
echo "action=\"main.php\" method=\"POST\">";
echo "<input type=\"image\"";
echo " src=\"./NavigationImages/home.jpg\"";
echo " name =\"home\">";

#
/*
this page should contain a hidden form to POST "QuizRounds" to the ChoiceCreator.php page.
*/


?><br>


</body>
</html> 