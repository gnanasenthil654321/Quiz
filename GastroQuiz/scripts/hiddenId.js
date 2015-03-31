	var timeInSecs;
	var ticker;
	
	function playSound(audioFile){
		var snd = new Audio(audioFile);
		snd.play();
	}
	
	function startTimer(secs){
		timeInSecs = parseInt(secs)-1;
		ticker = setInterval("tick()",1000);// every second
		
		
		}

	function tick() {
		var secs = timeInSecs;
		if (secs>0) {
			timeInSecs--;
		}
		else {
			playSound("./Audio/beep1.wav")
			clearInterval(ticker); // stop counting at zero
		// startTimer(60);  // remove forward slashes in front of startTimer to repeat if required
		}

		document.getElementById("timer").innerHTML = secs;
		}
		
	
startTimer(5);