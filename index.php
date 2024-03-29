<!DOCTYPE <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <title>US Quiz</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          //global variables
          var SCORE = 0;
          var ATTEMPTS = localStorage.getItem("total_attempts");
          //event listeners
          //"Submit QuiZ" button
          $("button").on("click", gradeQuiz);
          //Question 5 images
          $(".q5Choice").on("click", function() {
            $(".q5Choice").css("background", "");
            $(this).css("background", "rgb(255, 255, 0)");
          });
          displayQ4Choices();
          //functions
          function displayQ4Choices() {
            let q4ChoicesArray = ["Maine", "Rhode Island", "Maryland", "Delaware"];
            q4ChoicesArray = _.shuffle(q4ChoicesArray);
            for (let i = 0; i < q4ChoicesArray.length; i++) {
              $("#q4Choices").append(` <input type="radio" name="q4" id="${q4ChoicesArray[i]}"
                value="${q4ChoicesArray[i]}"> <label for="${q4ChoicesArray[i]}"> ${
                q4ChoicesArray[i]}</label>`);
            }
          }
          
          function isFormValid() {
            let isValid = true;
            if ($("#q1").val() == "") {
              isValid = false;
              $("#validationFdbk").html("Question 1 was not answered");
            }
              return isValid;
          }
          
          function rightAnswer(index) {
            $(`#q${index}Feedback`).html("Correct!");
            $(`#q${index}Feedback`).attr("class", "bg-success text-white");
            $(`#markImg${index}`).html("<img src='img/checkmark.png' alt='checkmark'>");
            SCORE += 12.5;
          }
          
          function wrongAnswer(index) {
            $(`#q${index}Feedback`).html("Incorrect!");
            $(`#q${index}Feedback`).attr("class", "bg-warning text-white");
            $(`#markImg${index}`).html("<img src='img/xmark.png' alt='xmark'>");
          }
                
          function gradeQuiz() {
            $("#validationFdbk").html(""); //resets validation feedback
            if (!isFormValid()) {
              return;
            }
            //variables
            SCORE = 0;
            let q1Response = $("#q1").val().toLowerCase();
            let q2Response = $("#q2").val();
            let q4Response = $("input[name=q4]:checked").val();
            let q6Response = $("#q6").val();
            let q7Response = $("#q7").val().toLowerCase();
            //Question 1
            if (q1Response == "sacramento") {
              rightAnswer(1);
            } else {
              wrongAnswer(1);
            }
            //Question 2
            if (q2Response == "mo") {
              rightAnswer(2);
            } else {
              wrongAnswer(2);
            }
            //Question 3
            if ($("#Jefferson").is(":checked") && $("#Roosevelt").is(":checked")
              && !$("#Jackson").is(":checked") && !$("#Franklin").is(":checked")) {
              rightAnswer(3);
            } else {
              wrongAnswer(3);
            }
            //Question 4
            if (q4Response == "Rhode Island") {
              rightAnswer(4);
            } else {
              wrongAnswer(4);
            }
            //Question 5
            if ($("#seal2").css("background-color") == "rgb(255, 255, 0)") {
              rightAnswer(5);
            } else {
              wrongAnswer(5);
            }
            //Question 6
            if (q6Response == "denali") {
              rightAnswer(6);
            } else {
              wrongAnswer(6);
            }
            //Question 7
            if (q7Response == "fifty" || q7Response == "50") {
              rightAnswer(7);
            } else {
              wrongAnswer(7);
            }
            //Question 8
            if ($("#arizona").is(":checked") && $("#washington").is(":checked")
              && !$("#jefferson").is(":checked") && !$("#stLouis").is(":checked")) {
              rightAnswer(8);
            } else {
              wrongAnswer(8);
            }
            $("#totalScore").html(`Total Score: ${SCORE}`)
            // set score font color based on final score
            if (SCORE < 80) {
              $("#totalScore").css("color", "rgb(255, 0, 0)")
            } else {
              $("#totalScore").css("color", "rgb(0, 255, 0)")
              $("#goodScoreMessage").html("Great Job!!!");
            }
            $("#totalAttempts").html(`Total Attempts: ${++ATTEMPTS}`);
            localStorage.setItem("total_attempts", ATTEMPTS);
          }
        })//ready
        </script>
    </head>
    <body class="text-center">
        <h1 class="jumbotron">US Geography Quiz</h1>
        
        <h3><span id="markImg1"></span>What is the capital of California?</h3>
        <input type="text" id="q1">
        <br><br>
        <div id="q1Feedback"></div>
        <br>
        
        <h3><span id="markImg2"></span>What is the longest river?</h3>
        <select id="q2">
          <option value="">Select One</option>
          <option value="ms">Mississippi</option>
          <option value="mo">Missouri</option>
          <option value="co">Colorado</option>
          <option value="de">Delaware</option>
        </select>
        <br><br>
        <div id="q2Feedback"></div>
        <br>
        
        <h3><span id="markImg3"></span>What presidents are carved into mount Rushmore?</h3>
        <input type="checkbox" id="Jackson"><label for="Jackson"> A. Jackson </label>
        <input type="checkbox" id="Franklin"><label for="Franklin"> B. Franklin </label>
        <input type="checkbox" id="Jefferson"><label for="Jefferson"> T. Jefferson </label>
        <input type="checkbox" id="Roosevelt"><label for="Roosevelt"> T. Roosevelt </label>
        <br><br>
        <div id="q3Feedback"></div>
        <br>
        
        <h3><span id="markImg4"></span> What is the smallest US State? </h3>
        <div id="q4Choices"></div>
        <div id="q4Feedback"></div>
        <br></br>
        
        <h3><span id="markImg5"></span> What image is in the Great Seal
          of the State of California? </h3>
        <img src="img/seal1.png" alt="Seal 1" class="q5Choice" id="seal1">
        <img src="img/seal2.png" alt="Seal 2" class="q5Choice" id="seal2">
        <img src="img/seal3.png" alt="Seal 3" class="q5Choice" id="seal3">
        <div id="q5Feedback"></div>
        <br></br>
        
        <h3><span id="markImg6"></span>What is the tallest mountain?</h3>
        <select id="q6">
          <option value="">Select One</option>
          <option value="denali">Denali</option>
          <option value="elias">Mount St. Elias</option>
          <option value="foraker">Mount Foraker</option>
          <option value="bona">Mount Bona</option>
        </select>
        <br><br>
        <div id="q6Feedback"></div>
        <br>
        
        <h3><span id="markImg7"></span>How many states are in the US?</h3>
        <input type="text" id="q7">
        <br><br>
        <div id="q7Feedback"></div>
        <br>
        
        <h3><span id="markImg8"></span>Which of the following are US States?</h3>
        <input type="checkbox" id="arizona"><label for="arizona"> Arizona </label>
        <input type="checkbox" id="washington"><label for="washington"> Washington </label>
        <input type="checkbox" id="jefferson"><label for="jefferson"> Jefferson </label>
        <input type="checkbox" id="stLouis"><label for="stLouis"> St. Louis </label>
        <br><br>
        <div id="q8Feedback"></div>
        <br>
        
        <h3 id="validationFdbk" class="bg-danger text-white"></h3>
        <button class="btn btn-outline-success">Submit Quiz</button>
        <br>
        <h2 id="totalScore"></h2>
        <h3 id="goodScoreMessage" class="text-info"></h3>
        <h3 id="totalAttempts"></h3>
    </body>
</html>