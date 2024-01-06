<?php
require("../settings.php");

if (isset($_GET['id'])) {
  $subject_id = $_GET['id'];
  $id = $_GET['id'];
} else {
  $id = 1;
  $subject_id = 1;
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,  user-scalable=no">


  <title>Homework | Rinda LMS
  </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
  <link rel="stylesheet" href="../assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/css/shared/style.css">
  <link rel="stylesheet" href="../assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/demo_1/style.css">
  <!-- End Layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.ico" />
  <script src="../jquery-3.6.4.min.js"></script>

  <style>
    .card {
      border-radius: 10px;
    }

    #topics :hover {
      color: grey#555
    }

    #topics {
      border-radius: 10px 10px 0px 0px
    }

    .topics_tab:hover {
      text-decoration: none;
      color: green;
    }



    .sticky-right {
      position: fixed;
      right: 0;
      width: 19%;
      z-index: 1000;
    }

    .sticky-left {
      position: fixed;
      left: 0.5;
      width: 22%;
      z-index: 1000;
    }

    .custom-input {
      position: relative;
      max-width: 100%;
      margin: 0 auto;
      height: 50px;
    }

    .chat-area {
      border: 2px solid #ccc;
      border-radius: 8px;
      padding: 10px;
      margin-bottom: 10px;
      height: 350px;
      /* Adjust as needed */
      overflow-y: auto;
    }

    .message-bubble {
      max-width: 100%;
      margin: 5px;
      padding: 5px 10px 5px 10px;
      border-radius: 10px;
      word-wrap: break-word;
      overflow: hidden;
      position: relative;
    }

    .user-message {
      max-width: 90%;
      background-color: #d4eaff;
      justify-self: flex-end;
      font-size: 0.9em;
      /* text-align: right; */
    }

    .bot-message {
      background-color: #eff8ff;
      align-self: flex-start;
      font-size: 0.9em;
      /* text-align: left; */
    }

    .typing-dot {
      position: absolute;
      bottom: 0;
      right: 0;
      display: inline-block;
      width: 10px;
      height: 10px;
      background-color: #ccc;
      border-radius: 50%;
      animation: typing-dot-animation 1s infinite;
    }

    @keyframes typing-dot-animation {

      0%,
      20%,
      80%,
      100% {
        transform: scale(1);
      }

      40% {
        transform: scale(0);
      }
    }

    .sender-name {
      font-weight: bold;
      font-size: 0.8em;
      margin-bottom: 5px;
    }

    .message-time {
      font-size: 0.8em;
      color: #555;
      margin-top: 5px;
    }

    .custom-input input {
      width: 100%;
      height: 100%;
      font-size: 14px;
      padding: 10px;
      border-radius: 10px;
      border: 2px solid #ccc;
      outline: none;
    }

    .custom-input .send-icon {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .popup {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 14px;
      z-index: 9999;
      display: flex;
      align-items: center;
      background-color: rgba(0, 10, 5, 0.8);
      /* Background color with opacity */
      color: #fff;
    }

    .popup.success {
      background-color: #4CAF50;
      color: #fff;
    }

    .popup.error {
      background-color: #F44336;
      color: white;
    }

    .popup i {
      margin-right: 5px;
    }


    #loading-screen {
      display: none;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.9);
      z-index: 1000;
    }

    #loading-screen img {
      width: 200px;
      border-radius: 70%;
      height: 200px;
      /* Adjust the height as needed */
    }

    .loading-container {
      display: flex;
      align-self: center;
      margin-bottom: 2%;
    }


    #loading-container {
      display: none;
    }

    .dot {
      width: 5px;
      height: 5px;
      background-color: #3498db;
      border-radius: 50%;
      display: inline-block;
      margin: 0 5px;
      animation-duration: 1.5s;
      animation-iteration-count: infinite;
    }

    /* Separate keyframes for each dot with different delays */
    @keyframes bounce-dot1 {

      0%,
      50%,
      100% {
        transform: translateY(0);
      }

      25% {
        transform: translateY(-20px);
      }

      75% {
        transform: translateY(-10px);
      }
    }

    @keyframes bounce-dot2 {

      0%,
      50%,
      100% {
        transform: translateY(0);
      }

      25% {
        transform: translateY(-15px);
      }

      75% {
        transform: translateY(-5px);
      }
    }

    @keyframes bounce-dot3 {

      0%,
      50%,
      100% {
        transform: translateY(0);
      }

      25% {
        transform: translateY(-18px);
      }

      75% {
        transform: translateY(-8px);
      }
    }

    /* Apply different animations and delays to each dot */
    #dot1 {
      animation: bounce-dot1 1.5s infinite;
    }

    #dot2 {
      animation: bounce-dot2 1.5s infinite;
      animation-delay: 0.2s;
      /* Adjust the delay as needed */
    }

    #dot3 {
      animation: bounce-dot3 1.5s infinite;
      animation-delay: 0.4s;
      /* Adjust the delay as needed */
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <div></div>
        <a class="navbar-brand brand-logo text-center" href="index.html">
          <i class="fa fa-graduation-cap"></i>
          <h3 style="font-weight: bold">Rinda LMS</h3>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <h3 style="font-weight: bold">Rinda LMS</h3>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block">Help : support@rinda.strad.frica</li>
          <li class="nav-item dropdown language-dropdown">
            <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#"
              data-toggle="dropdown" aria-expanded="false">
              <div class="d-inline-flex mr-0 mr-md-3">
                <div class="flag-icon-holder">
                  <i class="flag-icon flag-icon-us"></i>
                </div>
              </div>
              <span class="profile-text font-weight-medium d-none d-md-block">English</span>
            </a>
            <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
              <a class="dropdown-item">
                <div class="flag-icon-holder">
                  <i class="flag-icon flag-icon-us"></i>
                </div>English
              </a>
              <a class="dropdown-item">
                <div class="flag-icon-holder">
                  <i class="flag-icon flag-icon-fr"></i>
                </div>French
              </a>
              <a class="dropdown-item">
                <div class="flag-icon-holder">
                  <i class="flag-icon flag-icon-ae"></i>
                </div>Arabic
              </a>
              <a class="dropdown-item">
                <div class="flag-icon-holder">
                  <i class="flag-icon flag-icon-ru"></i>
                </div>Russian
              </a>
            </div>
          </li>
        </ul>
        <form class="ml-auto search-form d-none d-md-block" action="#">
          <div class="form-group">
            <input type="search" class="form-control" placeholder="Search Here">
          </div>
        </form>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown"
              aria-expanded="false">
              <i class="mdi mdi-bell-outline"></i>
              <span class="count">7</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
              aria-labelledby="messageDropdown">
              <a class="dropdown-item py-3">
                <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                <span class="badge badge-pill badge-primary float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../assets/images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../assets/images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../assets/images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-email-outline"></i>
              <span class="count bg-success">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
              aria-labelledby="notificationDropdown">
              <a class="dropdown-item py-3 border-bottom">
                <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                <span class="badge badge-pill badge-primary float-right">View all</span>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-alert m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                  <p class="font-weight-light small-text mb-0"> Just now </p>
                </div>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-settings m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                  <p class="font-weight-light small-text mb-0"> Private message </p>
                </div>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-airballoon m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration</h6>
                  <p class="font-weight-light small-text mb-0"> 2 days ago </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold">Student</p>
                <p class="font-weight-light text-muted mb-0">student@rindalms.com.ng</p>
              </div>
              <a class="dropdown-item">My Profile <span class="badge badge-pill badge-danger">1</span><i
                  class="dropdown-item-icon ti-dashboard"></i></a>
              <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>
              <a class="dropdown-item">Activity<i class="dropdown-item-icon ti-location-arrow"></i></a>
              <a class="dropdown-item">FAQ<i class="dropdown-item-icon ti-help-alt"></i></a>
              <a class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper" style="width: 100vw">


          <div id="loading-screen">
            <img src="processing.gif" alt="Loading">
            <p style="font-size: 17px" id="loadingText"></p>
          </div>


          <div class="row">
            <?php


            $query = "SELECT * FROM topics WHERE subject_id = :subject_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
            $stmt->execute();
            $subject_topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $topics = [];
            foreach ($subject_topics as $subject_topic) {
              $topics[] = $subject_topic;
            }

            ?>


            <div class="col-md-3">
              <div class="sticky-left">
                <div class="card">
                  <div class="card-body">
                    <?php
                    // Check if $subject_topics is not empty
                    if (!empty($subject_topics)) {
                      echo "<h4 class='card-title mb-0'>Topics</h4>";
                      foreach ($subject_topics as $subject_topic) {
                        ?>
                        <a class="topics_tab" href="javascript:void(0);" data-topic="<?= $subject_topic['id'] ?>">
                          <div class="d-flex py-2 border-bottom">
                            <div class="wrapper">
                              <small>
                                <?= $subject_topic['subtopic_no'] ?> Sub topics
                              </small>
                              <p class="font-weight-semibold text-black mb-0" style="padding-bottom: 5px">
                                <?= $subject_topic['topic'] ?>
                              </p>
                              <div class="progress" style="height: 4px; width: 160px">
                                <div class="progress-bar bg-danger" role="progressbar"
                                  style="width: <?= $subject_topic['progress'] ?>"
                                  aria-valuenow="<?= $subject_topic['progress'] ?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                              </div>
                            </div>
                            <small class="text-muted ml-auto">
                              <?= $subject_topic['progress'] ?>%
                            </small>
                          </div>
                        </a>
                        <?php
                      }
                    } else {
                      // Display a message when $subject_topics is empty
                      echo '<center><p>No topics available</p></center>';
                    }
                    ?>

                    <!-- <a class="d-block mt-5" href="#">Show all</a> -->
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <strong>
                    <h5>Study Screen</h5>
                  </strong>

                  <div class="questions_display">
                    <form id="homework_form" action="mark.php" method="get">
                      <input type="hidden" name="#subjectID" value="1">
                      <input type="hidden" name="id" value="<?= $id ?>">

                      <input type="hidden" name="id" value="<?= $id ?>">
                      <div class="chat-area" id="chatArea"
                        style="border: none; border-radius: 8px; height: 450px; margin-bottom: 10px; width: 100%;">



                      </div>



                      <!-- Add this to your HTML -->
                      <div id="loading-container" class="loading-container">
                        <p style="font-size: 14px">Typing</p>
                        <div class="dot" id="dot1"></div>
                        <div class="dot" id="dot2"></div>
                        <div class="dot" id="dot3"></div>
                      </div>

                      <div class="form-group">
                        <div class="custom-input">
                          <input type="text" class="form-control form-control-lg" placeholder="Type your message..."
                            id="userInput">
                          <div class="send-icon">
                            <button type="button" class="btn btn-icons btn-dark"
                              style="height: 30px; width: 30px; padding: 0%; border-radius: 7px;"
                              onclick="sendMessage()">
                              <i class="mdi mdi-arrow-up"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <div class="row">
                      <div style="width: 1%"></div>
                      <button type="submit" class="btn btn-inverse-primary btn-sm"
                        style="width: 49%; height: 40px; border-radius: 10px;">Back
                      </button>
                      <div style="width: 1%">
                      </div>
                      <button id="submit_homework" type="submit" class="btn btn-inverse-success btn-sm"
                        style="width: 49%; height: 40px; border-radius: 10px;">Next
                      </button>
                    </div>

                  </div>

                </div>
              </div>
            </div>



            <div class="col-md-2">
              <div class="col-md-12 grid-margin">
                <div class="grid-margin stretch-card">
                  <div class="row">
                    <div class="sticky-right">
                      <!-- <div class="wrap col-md-8" style="padding-bottom: 10px;">
                        <div class="wrapper">
                          <small>Progress</small>
                          <div class="progress" style=" height: 4px; width: 160%">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30"
                              aria-valuemin="0" aria-valuemax="100">
                            </div>
                          </div>
                        </div>
                      </div> -->
                      <div class="col-md-12 grid-margin stretch-card">

                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title mb-0" id="title_show" style="display: none">Subtopics:
                            </h4>
                            <center id="title_hide">
                              <p>Select A Topic</p>
                            </center>
                            <a id="subtopics_tab" target="_blank">
                              <div class="d-flex py-2 border-bottom">
                                <div class="wrapper">
                                  <small class="status text-muted">

                                  </small>
                                  <p class="subtopic_name font-weight-normal text-gray mb-0">
                                  </p>

                                  <input class="subtopic_title" type="hidden" name="subtopic_title" value="">
                                </div>
                              </div>
                            </a>
                            <!-- <a class="d-block mt-5" href="#">Show all</a> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- chat implementation -->
        <script>


          // Initialize an array to store messages
          const messagesHistory = [];

          // Function to append a message to the array and call appendMessage
          function appendMessageToArray(content, role) {
            // Add the message to the array
            messagesHistory.push({ content, role });

            // Call the appendMessage function
            appendMessage(content, role);
          }

          // Access the messages array if needed
          console.log(messagesHistory);


          function sendMessage() {
            var userInput = document.getElementById('userInput').value;

            // Append user message to the chat area
            appendMessageToArray(userInput, 'user');

            // Clear the input field
            document.getElementById('userInput').value = '';

            // Simulate bot response (replace this with your actual Ajax call)
            // simulateBotTyping();


            // cloudflare Hosted Rinda
            // Replace 'YOUR_API_ENDPOINT' with the actual endpoint URL
            // const apiEndpoint = 'https://rinda.abdulkarimhussain7.workers.dev/';

            // // Example user message
            // const userMessage = userInput;

            // // Prepare the request options
            // const requestOptions = {
            //   method: 'POST',
            //   headers: {
            //     'Content-Type': 'application/json',
            //   },
            //   body: JSON.stringify({ userMessage }),
            // };

            // // Make the fetch request
            // fetch(apiEndpoint, requestOptions)
            //   .then(response => {
            //     if (!response.ok) {
            //       throw new Error(`HTTP error! Status: ${response.status}`);
            //     }
            //     return response.json();
            //   })
            //   .then(data => {
            //     console.log(data);
            //     appendMessageToArray(data, 'bot');
            //   })
            //   .catch(error => {
            //     appendMessageToArray(error, 'bot');
            //     console.error('Fetch error:', error);
            //   });



            // huggyface Hosted Rinda
            // async function query(data) {
            //   const response = await fetch(
            //     "https://api-inference.huggingface.co/models/mistralai/Mixtral-8x7B-Instruct-v0.1",
            //     {
            //       headers: {
            //         "Authorization": "Bearer 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",
            //         "Content-Type": "application/json", // Add this line
            //       },
            //       method: "POST",
            //       body: JSON.stringify(data),
            //     }
            //   );
            //   const result = await response.json();
            //   return result;
            // }

            // query({ "inputs": userInput}).then((response) => {
            //   console.log(JSON.stringify(response));
            //   resbot = JSON.stringify(response)
            //   appendMessageToArray(resbot, 'bot');
            // });



            //todo this is the actual send message implementation

            $.ajax({
              type: 'POST',
              url: 'chat.php',
              data: { 'message': userInput, 'history': messagesHistory, },
              dataType: 'json',
              beforeSend: function () {
                document.getElementById("loading-container").style.display = "flex";
              },
              success: function (response) {
                if (response.success) {
                  // displayPopup(response.message, true);
                  $('#loading-container').hide();
                  appendMessageToArray(response.message, 'bot');
                  console.log(response.message);
                } else {
                  console.log('Error: ' + response.message);
                  displayPopup(response.message, false);
                }
              },

              error: function (error) {
                //console.error('Error:', error, xhr);
                displayPopup(error, false);
                document.getElementById("loading-container").style.display = "flex";
                // Handle AJAX errors here
              },
              complete: function () {
                document.getElementById("loading-container").style.display = "none";
              },
            });
          }

          function appendMessage(message, sender) {
            var chatArea = document.getElementById('chatArea');
            var messageDiv = document.createElement('div');
            var senderName = sender === 'user' ? 'You' : 'Rinda';
            var currentDate = new Date();
            var currentTime = currentDate.toLocaleTimeString();

            messageDiv.innerHTML = `<div class="sender-name">${senderName}</div><div class="message-bubble ${sender}-message">${message}</div><div class="message-time">${currentTime}</div>`;
            chatArea.appendChild(messageDiv);

            // Scroll to the bottom to show the latest message
            chatArea.scrollTop = chatArea.scrollHeight;
          }

          // function simulateBotTyping() {
          //   var chatArea = document.getElementById('chatArea');
          //   var typingDot = document.createElement('div');
          //   typingDot.className = 'typing-dot';
          //   chatArea.appendChild(typingDot);

          //   // Scroll to the bottom to show the typing dot
          //   chatArea.scrollTop = chatArea.scrollHeight;
          // }
        </script>


        <!-- initials greetings implementation -->
        <script>
          document.addEventListener('DOMContentLoaded', function () {

            // Function to append messages with delays
            function appendMessagesWithDelays(messages) {
              const loadingContainer = document.getElementById('loading-container');
              loadingContainer.style.display = 'flex';

              function appendMessageWithDelay(index) {
                setTimeout(() => {
                  // Display loading container for the specified intervals
                  loadingContainer.style.display = 'none';

                  // Append the message
                  appendMessageToArray(messages[index].content, 'bot');
                }, messages[index].delay);
              }

              // Loop through messages with delays
              for (let i = 0; i < messages.length; i++) {
                appendMessageWithDelay(i);
              }
            }

            // Messages to be displayed with delays
            const messagesWithDelays = [
              { content: 'Hey there, welcome onboard', delay: 3000 }, // 3 seconds delay
              { content: "You can call me Rinda. I'll be your personal tutor from now onwards, so feel free to ask anything you don't understand.", delay: 4000 }, // 2 seconds delay
              { content: 'You can select a topic on the left, and I will generate tailored subtopics for you. Then, you can click on any of the subtopics I generated to the right of your screen to get started.', delay: 8000 } // 4 seconds delay
            ];

            // Call the function to append messages with delays
            appendMessagesWithDelays(messagesWithDelays);


            // const subjectID = "As Rinda, a friendly casual teacher on the school's LMS, welcome the new student warmly. Initiate a casual conversation to learn more about the student, starting with their name, hobbies, and favorite subject. Keep your responses short and engaging. Wait for the student's reply before moving on to the next question. Once acquainted, guide the student through the LMS. Mention that they can explore topics on the left and sub-topics on the right. Encourage the student to select a topic so you can begin the tutorial together. Don;t generate untrue content";


            //huggyface initial model message
            // async function query(data) {
            //   const response = await fetch(
            //     "https://api-inference.huggingface.co/models/mistralai/Mixtral-8x7B-Instruct-v0.1",
            //     {
            //       headers: {
            //         "Authorization": "Bearer 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",
            //         "Content-Type": "application/json", // Add this line
            //       },
            //       method: "POST",
            //       body: JSON.stringify(data),
            //     }
            //   );
            //   const result = await response.json();
            //   return result;
            // }

            // query({ "inputs": "As Rinda, a friendly casual teacher on the school's LMS, welcome the new student warmly. Initiate a casual conversation to learn more about the student, starting with their name, hobbies, and favorite subject. Keep your responses short and engaging. Wait for the student's reply before moving on to the next question. Once acquainted, guide the student through the LMS. Mention that they can explore topics on the left and sub-topics on the right. Encourage the student to select a topic so you can begin the tutorial together. Don;t generate untrue content" }).then((response) => {
            //   console.log(JSON.stringify(response));
            //   resbot = JSON.stringify(response)
            //   appendMessageToArray(resbot, 'bot');
            // });



            //todo this is the actual initial message implementation

            // $.ajax({
            //     type: 'POST',
            //     url: 'chat.php',
            //     data: { 'message': subjectID },
            //     dataType: 'json',
            //     beforeSend: function () {
            //       $("#loadingText").text("Getting Content...");
            //       document.getElementById("loading-screen").style.display = "flex";
            //     },
            //     success: function (response) {
            //       if (response.success) {
            //         // displayPopup(response.message, true);
            //         appendMessageToArray(response.message, 'bot');
            //         console.log(response.message);
            //       } else {
            //         console.log('Error: ' + response.message);
            //         displayPopup(response.message, false);
            //       }
            //     },

            //     error: function (error) {
            //       //console.error('Error:', error, xhr);
            //       displayPopup(error, false);
            //       // Handle AJAX errors here
            //     },
            //     complete: function () {
            //       document.getElementById("loading-screen").style.display = "none";
            //     },
            //   });
          });
        </script>


        <!-- Display popup -->
        <script>

          // Function to display a popup message
          function displayPopup(message, success) {
            var popup = document.createElement('div');
            popup.className = 'popup ' + (success ? 'success' : 'error');

            var iconClass = success ? 'fa fa-check-circle' : 'fa fa-times-circle';
            var icon = document.createElement('i');
            icon.className = iconClass;
            popup.appendChild(icon);

            var text = document.createElement('span');
            text.textContent = message;
            popup.appendChild(text);

            // Add styles to change cursor to hand on hover
            popup.style.cursor = 'pointer';

            // // Add click event to navigate to the target page
            // popup.addEventListener('click', function () {
            //   window.location.href = 'your_target_page.html'; // Replace 'your_target_page.html' with the actual page URL
            // });

            document.body.appendChild(popup);
          }

        </script>


        <!-- Fetch subtopic -->
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            // Add click event listener to topics_tab links
            document.querySelectorAll('.topics_tab').forEach(function (tab) {
              tab.addEventListener('click', async function () {
                // Get the selected topic ID from the data attribute
                $("#loadingText").text("Generating Personalized Subtopics Content...");
                document.getElementById("loading-screen").style.display = "flex";
                const selectedTopicId = tab.getAttribute('data-topic');

                try {
                  // Send the selectedTopicId to fetch_subtopics.php using the fetch API
                  const response = await fetch('fetch_subtopics.php', {
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                      selectedTopicId: selectedTopicId,
                    }),
                  });

                  if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                    document.getElementById("loading-screen").style.display = "none";
                  }


                  document.getElementById("loading-screen").style.display = "none";
                  document.getElementById('title_hide').style.display = "none";
                  document.getElementById('title_show').style.display = "block";

                  const data = await response.json();

                  // Assuming 'data' is your parsed JSON response
                  const subtopicsArray = data.subtopics;

                  // Select the container where you want to append the subtopics
                  const subtopicsContainer = document.getElementById('subtopics_tab');

                  // Clear previous content
                  subtopicsContainer.innerHTML = '';

                  // Loop through each subtopic in the response
                  subtopicsArray.forEach((subtopic, index) => {
                    // Create elements dynamically
                    const subtopicDiv = document.createElement('div');
                    subtopicDiv.className = 'd-flex py-2 border-bottom';

                    const wrapperDiv = document.createElement('div');
                    wrapperDiv.className = 'wrapper';

                    const statusSmall = document.createElement('small');
                    statusSmall.className = 'status text-muted';
                    statusSmall.textContent = subtopic.status;

                    const subtopicNameP = document.createElement('p');
                    subtopicNameP.className = 'subtopic_name font-weight-normal text-gray mb-0';
                    subtopicNameP.textContent = subtopic.name;

                    const hiddenInputElement = document.createElement('input');
                    hiddenInputElement.className = 'subtopic_title';
                    hiddenInputElement.type = 'hidden';
                    hiddenInputElement.name = 'subtopic_title';
                    hiddenInputElement.value = subtopic.content;

                    // Append elements to the DOM
                    wrapperDiv.appendChild(statusSmall);
                    wrapperDiv.appendChild(subtopicNameP);
                    wrapperDiv.appendChild(hiddenInputElement);

                    subtopicDiv.appendChild(wrapperDiv);

                    subtopicsContainer.appendChild(subtopicDiv);
                  });
                } catch (error) {
                  console.error('Error:', error);
                }
              });
            });

            // // Retrieve the required elements
            const subtopicsTab = document.getElementById('subtopics_tab');
            subtopicsTab.addEventListener('click', function () {
              const hiddenInput = subtopicsTab.querySelector('.subtopic_title');
              const hiddenInputValue = hiddenInput.value;
              appendMessageToArray(hiddenInputValue, 'bot');
              console.log(messagesHistory);
            });

            // Retrieve the required elements
            // const subtopicsContainer = document.getElementById('subtopics_tab');
            // subtopicsContainer.addEventListener('click', function (event) {
            //     // Check if the clicked element or its parent has the 'subtopic_title' class
            //     const clickedSubtopic = event.target.classList.contains('subtopic_title') ? event.target : event.target.closest('.subtopic_title');

            //     if (clickedSubtopic) {
            //         const hiddenInputValue = clickedSubtopic.value;

            //         // Parse the JSON value to get the subtopic object
            //         const subtopicObject = JSON.parse(hiddenInputValue);

            //         // Access the content property of the subtopic
            //         const subtopicContent = subtopicObject.content;

            //         // Use subtopicContent as needed (e.g., display it, process it, etc.)
            //         console.log(subtopicContent);
            //     }
            // });

          });

        </script>




        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <!-- <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Rinda LMS
              2024</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Rinda LMS <a
                href="#" target="_blank">Rinda School
                Management
                Software</a></span>
          </div>
        </footer> -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../../../assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../../../assets/js/shared/off-canvas.js"></script>
  <script src="../../../assets/js/shared/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../../assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
  <!-- End custom js for this page-->
</body>

</html>