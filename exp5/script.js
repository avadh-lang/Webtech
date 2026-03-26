const quizData = [
    {
        question: "What is HTML?",
        options: ["Programming Language", "Markup Language", "Database", "OS"],
        answer: "Markup Language"
    },
    {
        question: "Which is used for styling?",
        options: ["HTML", "CSS", "Python", "Java"],
        answer: "CSS"
    },
    {
        question: "Which language adds interactivity?",
        options: ["CSS", "HTML", "JavaScript", "C++"],
        answer: "JavaScript"
    }
];

let currentQuestion = 0;
let score = 0;
let selectedAnswer = "";

function loadQuestion() {
    let q = quizData[currentQuestion];
    document.getElementById("question").innerText = q.question;

    let optionsHTML = "";
    q.options.forEach(option => {
        optionsHTML += `<button onclick="selectAnswer(this, '${option}')">${option}</button>`;
    });

    document.getElementById("options").innerHTML = optionsHTML;
}

function selectAnswer(btn, answer) {
    selectedAnswer = answer;

    // Remove previous selection
    let buttons = document.querySelectorAll("#options button");
    buttons.forEach(b => b.classList.remove("selected"));

    // Add selected class
    btn.classList.add("selected");
}

function nextQuestion() {
    if (selectedAnswer === quizData[currentQuestion].answer) {
        score++;
    }

    selectedAnswer = "";
    currentQuestion++;

    if (currentQuestion < quizData.length) {
        loadQuestion();
    } else {
        document.querySelector(".quiz-container").innerHTML =
            `<h2>Your Score: ${score}/${quizData.length}</h2>`;
    }
}

loadQuestion();