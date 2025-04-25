
    document.getElementById("gamerun").onclick = playGame;
    function playGame()
    {
        const game = {
            1: "Stone" , 2: "Paper", 3: "Scissor"
        };

        let randomNo =  Math.floor(Math.random() * 3) + 1;
        let p1 = Number(document.getElementById("userInput").value);
        let playerChoice = game[p1];
        let compChoice = game[randomNo];

        if(compChoice == playerChoice)
        {
            console.log("Its a tie");
            document.getElementById("ans").textContent = "It's a tie";
        }

        else if((compChoice == "Stone" && playerChoice == "Scissor") || 
                (compChoice == "Scissor" && playerChoice== "Paper") ||
                (compChoice == "Paper" && playerChoice== "Stone"))
        {
            console.log("Computer Wins");
            document.getElementById("ans").textContent = "Computer Wins";
        }

        else if((compChoice == "Stone" && playerChoice == "Paper") || 
                (compChoice == "Scissor" && playerChoice=="Stone") ||
                (compChoice == "Paper" && playerChoice=="Scissor"))
        {
                console.log("Player Wins");
                document.getElementById("ans").textContent = "Player Wins";
        }
        else
        {
            console.log("Error")
        }

    }


