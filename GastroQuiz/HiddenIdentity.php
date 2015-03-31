<html>
<body>
<head>
	<link rel = "stylesheet" type = "text/css" href = "./css/HiddenIdentity.css">
</head>
<?php 

#echo "hai";

#a post variable is to be created.
#this variable will hold the number of times the next clue button was pressed.
#this variable will have to be incremented by 1 every time next clue button was pressed.

$clueNumber = $_POST["clueNumber"];
if ($clueNumber == "")
#when this page arrives from ChoiceCreator.php, this post variable will be an empty string.
{
	$clueNumber = 0;
	
	$folder = $_POST["QuizRounds"];
	#will hold the just the name of the round chosen
	#echo $folder;
	#echo "<br>";
	
	$toWrite = $_POST["file"]."\n";
	#will hold just the name of file chosen with a newline Charecter.
	#echo $toWrite;
	#echo "<br>";

	$forFileName = $_POST["file"];
	
	#Choice.txt will opened and written to only when the page is arrived from ChoiceCreator.php
	#this is done to minimize unnecessary file operations.
	
	$fileWrite = "./".$folder."/"."Choice.txt";
	#will create and hold the location of the correponding choice.txt file
	#echo $fileWrite;
	#echo "<br>";



	$fileToOpen = fopen($fileWrite,'a') or die('failed');
	fwrite($fileToOpen,$toWrite);

	fclose($fileToOpen);
	#echo $toWrite;
	#echo "<br>";
}


if ($clueNumber > 0)
# if the page arrives from itself
{
	$localFolder = $_POST["localFolder"];
	$folder = $localFolder;
	#$folder variable is given the value gotten from $post localFolder
	#this re assignment is done since the following code uses $folder variable to create a path.
	
	$localFileName = $_POST["localFileName"];
	$forFileName = $localFileName;
	
}





#code to display the question

# our images are numbered from 1 to 6
# our files containing the questions are also numbered 1 to 6
# extract the basename of the filename of the picture,
# create the name of the text file by appending .txt

$dotPos = strpos($forFileName,".");
#echo $dotPos;



$stem = substr($forFileName,0,$dotPos);
#echo $stem;

$corresQues = $stem.".txt";
#echo $corresQues;
# contains just the file name

$quesFilePath = "./".$folder."/".$corresQues;
echo $quesFilePath;
echo "<br>";

$quesFileToOpen = fopen($quesFilePath,'r') or die ("could not open question file");
#opening of file in read mode

#displaying the content of the file line by line as a paragraph 

$lineStore = array();

while (!feof($quesFileToOpen))
{
	array_push($lineStore,fgets($quesFileToOpen));
}
fclose($quesFilePath);
# a variable to keep track of the index of the array $lineStore

$i = 0;

# displays the question
echo "<div id = \"questionDisplayArea\">";
echo "<p>";
foreach ($lineStore as $line)
{
	echo $line;
	echo "<br>";
	if ($i == $clueNumber)
	#if the index number $i and $clueNumber are the same, this means that adequate clues for this time have been displayed.
	{
		break;	
	}
	$i = $i + 1;
}


#increment the clueNumber so that an additional clue will be displayed next time.
echo "</p>";
echo "</div>";


$clueNumber = $clueNumber + 1;
echo $clueNumber;
# link for next clue
echo "<div id = \"nextClue\">";
echo "<form name=\"Clue\"";
echo "action=\"HiddenIdentity.php\" method=\"POST\">";
echo "<input type=\"image\"";
echo " src=\"./NavigationImages/clue.jpg\"";
echo " name =\"clueImage\">";

#post variable to send clueNumber
echo "<input type=\"hidden\"";
echo " name =\"clueNumber\"";
echo " value=\"$clueNumber\">";

#as the page is reloaded, a variable indicate the folder HiddenIdentity is required
echo "<input type=\"hidden\"";
echo " name =\"localFolder\"";
echo " value=\"$folder\">";

echo "<input type=\"hidden\"";
echo " name =\"localFileName\"";
echo " value=\"$forFileName\">";

echo "</form>";
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

?><br>


</body>
</html> 