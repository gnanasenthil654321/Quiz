<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "./css/QuestionDisplay.css">
	</head>
	<body>

		<?php
		$quizRound = $_POST["QuizRounds"];
		#echo $quizRound;
		#echo <br>
		#this will get the quiz round that is going to be played.
		
		$ruleFile = "./"."Rules/".$quizRound.".txt";
		#echo $ruleFile;
		
		$fileToOpen = fopen($ruleFile,'r');
		echo "<div id = \"questionDisplayArea\">";
		echo "<center>".$quizRound."</center>";
		echo "<ol type = \"1\">";
		while (!feof($fileToOpen))
		{
			$line = fgets($fileToOpen);
			echo "<li>".$line."</li>";
			
		}
		echo "</ol>";
		echo "</div>";
		#link to ChoiceCreator for corresponding round
		echo "<div id = \"next\">";
		echo "<form name=\"ChoiceCreator\"";
		echo "action=\"ChoiceCreator.php\" method=\"POST\">";
		echo "<input type=\"image\"";
		echo " src=\"./NavigationImages/MenuCard.jpg\"";
		echo " name =\"next\">";

		echo "<input type=\"hidden\"";
		echo " name =\"QuizRounds\"";
		echo " value=\"$quizRound\">";

		echo "</form>";
		echo "</div>";
		
		#link to home
		echo "<div id = \"home\">";
		echo "<form name=\"Choices\"";
		echo "action=\"main.php\" method=\"POST\">";
		echo "<input type=\"image\"";
		echo " src=\"./NavigationImages/home.jpg\"";
		echo " name =\"home\">";
		echo "</div>";

		echo "</div>";
		
		?>

	</body>
</html> 