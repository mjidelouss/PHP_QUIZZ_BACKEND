// Declaring variables 
const question = document.querySelector('#question');
const options = Array.from(document.getElementsByClassName("option-text"));
const progressText = document.querySelector('#progressText');
const scoreText = document.querySelector('#score');
const progressBarFull = document.querySelector('#progressBarFull');
const timer = document.querySelector('#timer');

let questions = [];
let shuffledQuestions;
let score = 0;
let questionIndex = 0;
let questionCounter = 0;
let countdown = 30;
let correctQuestionsCounter = 0;
let incorrectQuestionsCounter = 0;
let maxQuestions;
let performance;

const xhr = new XMLHttpRequest();
xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        questions = JSON.parse(this.responseText);
        shuffleArray(questions);
        initTest(shuffledQuestions);
    }
};
xhr.open('GET', 'classes/questions.class.php?question', true);
xhr.send();

// function shuffleArray to shuffle the array
function shuffleArray(array) {
    shuffledQuestions = array.sort(() => Math.random() - 0.5);
    maxQuestions = shuffledQuestions.length;
}
// function initTest sets the data from the array
function initTest(shuffledQuestions) {
    // Setting the Questions from the array
    question.innerText = shuffledQuestions[questionIndex].question;
    options.forEach((option, index) => {
      // Set the text and data-correct attribute for each option element
      option.innerText = shuffledQuestions[questionIndex].options[index];
      option.dataset.correct = shuffledQuestions[questionIndex].answer === (index + 1);
      // hide the option element by default
      option.parentElement.style.display = 'none';
    });
    // Show the options and their parent elements that are needed for the current question
    shuffledQuestions[questionIndex].options.forEach((option, index) => {
      options[index].innerText = option;
      options[index].parentElement.style.display = 'block';
    });
    startCountdown();
}

let intervalId;

// Function startCountdown starts the countdown
function startCountdown() {
  // Display the countdown in the page
  timer.innerText = countdown;

  // Decrement the countdown every 1000 milliseconds (1 second)
  intervalId = setInterval(() => {
    countdown--;
    timer.innerText = countdown;
    // In case the countdown reaches 0
    if (countdown <= 0) {
      clearInterval(intervalId);
      intervalId = null;
      // Incrementing the incorrect questions counter
      incorrectQuestionsCounter++;
      // Move on to the next question after the countdown ends
      goToNextQuestion();
    }
  }, 1000);
}

// Function goToNextQuestion loads the next question
function goToNextQuestion() {
  questionCounter++;

  // In case the questions reaches the maximum
  if (questionCounter >= maxQuestions)
  {
    console.log('tree');
    if (correctQuestionsCounter < (maxQuestions / 2))
        performance = "Bad";
    if (correctQuestionsCounter == (maxQuestions / 2))
        performance =  "Average";
    if (correctQuestionsCounter > (maxQuestions / 2))
        performance = "Good";
    if (correctQuestionsCounter == maxQuestions)
        performance = "Perfect";
    var data = {
        score: score,
        correct: correctQuestionsCounter,
        incorrect: incorrectQuestionsCounter,
        performance: performance
        };
    var my_json = JSON.stringify(data);
    window.location.href = "score.php?data="+my_json;
    return;
  }
  countdown = 30;
  // Clear the countdown from the page
  timer.innerText = '';
  // Updating the Prograss Bar
  progressBarFull.style.width = `${(questionCounter / maxQuestions) * 100}%`;
  progressText.innerText = `Question ❔ ${questionCounter} / ${maxQuestions}`;
  // Increment the question index and update the quiz with the new question
  questionIndex++;
  initTest(shuffledQuestions);
}

options.forEach(option => {
    option.addEventListener('click', e => {
        // Clear the countdown timer
        clearInterval(intervalId);
        intervalId = null;
        // Selected option by the user
        const selectedoption = e.target;
        const correct = selectedoption.dataset.correct;

        // Updating the progress bar when the user clicks on an option
        progressBarFull.style.width = `${(questionCounter / maxQuestions) * 100}%`;
        progressText.innerText = `Question ❔ ${questionCounter} / ${maxQuestions}`;

        // In case the option is correct
        if (correct === 'true') {

            // Incrementing the score and the correct Questions Counter 
            score += 100;
            correctQuestionsCounter++;
            scoreText.innerText = score;

            // adding the class correct to the selected option
            selectedoption.parentElement.classList.add('correct');
            // adding the class incorrect to the rest of the options
            options.forEach (option => {
                if (option != selectedoption) {
                    option.parentElement.classList.add('incorrect');
                }
            })
        
        // In case the option is incorrect
        } else if (correct === 'false') {

            // Incrementing the Incorrect Questions Counter
            incorrectQuestionsCounter++;

            // Adding the class incorrect to the selected option
            selectedoption.parentElement.classList.add('incorrect');
            // Adding the correct class to the correct option and incorrect class to the other ones
            options.forEach(option => {
                if (option !== selectedoption) {
                    if (option.dataset.correct === 'true') {
                    option.parentElement.classList.add('correct');
                    }
                    else {
                        option.parentElement.classList.add('incorrect');
                    }
                }
            });
        }
        // Delaying of 1 second after the user clicks on an option
        setTimeout(() => {
            // Removing the correct and incorrect classes from each option
            options.forEach(option => {
                option.parentElement.classList.remove('correct');
                option.parentElement.classList.remove('incorrect');
            });
            goToNextQuestion();
          }, 1000);
    });
});

// Starting the Test