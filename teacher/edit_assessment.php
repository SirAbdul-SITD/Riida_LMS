<?php
require("../settings.php");

if (isset($_GET['id'])) {
  $subject_id = $_GET['id'];
  $subject = $_GET['subject'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit Assessments | Rinda LMS
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

    .schedules :hover {
      background-color: blue;
      border-radius: 15px;
      animation: 2s fade-in-out;
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
                <p class="mb-1 mt-3 font-weight-semibold">Ahmad Isa</p>
                <p class="font-weight-light text-muted mb-0">allenmoreno@gmail.com</p>
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
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="profile-image">
                <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg" alt="profile image">
                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">
                <p class="profile-name">Ahmad Isa</p>
                <p class="designation">Premium user</p>
              </div>
            </a>
          </li>
          <li class="nav-item nav-category">Main Menu</li>
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="menu-icon typcn typcn-document-text"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="subjects.php" aria-expanded="false" aria-controls="ui-1">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Subjects</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#" aria-expanded="false"
              aria-controls="ui-3">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Assessments</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="calendar.php">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">Calendar</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notifications.php">
              <i class="menu-icon typcn typcn-bell"></i>
              <span class="menu-title">Notifications Center</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="analytics.php">
              <i class="menu-icon typcn typcn-user-outline"></i>
              <span class="menu-title">Analytics</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <div id="loading-screen">
            <img src="processing.gif" alt="Loading">
            <p style="font-size: 17px" id="loadingText"></p>
          </div>


          <?php

          $query = "SELECT * FROM assessments";
          $stmt = $pdo->prepare($query);
          $stmt->execute();
          $assessments = $stmt->fetchAll(PDO::FETCH_ASSOC);


          ?>


          <div class="row" style=" margin-top: 10px;">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body col-md-12 align-self-center">
                  <div class=" align-content-start">
                    <!-- Align content to left -->
                    <form method="GET" id="compileform">
                      <div class="form-group">
                        <label for="exampleTextarea1">Edit assessment questions</label>
                        <textarea style="border-radius: 10px;" class="form-control" id="content" name="content"
                          rows="34"></textarea>
                        <input type="hidden" name="original" id="original">
                        <input type="hidden" name="id_div" id="id_div">
                        <input type="hidden" name="generated_content" id="generated_content">
                      </div>

                      <button id="compile" type="submit" class="btn btn-inverse-success btn-sm" style="width: 100%">Save
                        Changes</button>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin  stretch-card">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <div class="wrapper">
                    <div class="row">
                      <p class="col-md-10">
                        <?= $subject ?>
                      </p>
                      <button id="saveConfig" type="submit" class="btn btn-inverse-success"
                        style="padding: 1% 2% 1% 3%;"> <i class="fa fa-save"></i></button>
                    </div>
                    <form id="formMode" action="" method="GET">
                      <div class="form-group">
                        <label for="type">Subjects</label>
                        <select style="border-radius: 10px; height: 40px" required class="form-control"
                          id="assessment_id" name="assessment_id">
                          <option selected disabled>Select</option>
                          <?php foreach ($assessments as $assessment): ?>
                            <option value="<?= $assessment['id']; ?>" data-mode="<?= $assessment['mode']; ?>"
                              data-type="<?= $assessment['type']; ?>"
                              data-date="<?= date("Y-m-d", strtotime($assessment['date'])); ?>"
                              data-time="<?= date("H:i", strtotime($assessment['time'])); ?>">
                              <?= date("j F, Y H:i", strtotime($assessment['date'] . ' ' . $assessment['time'])); ?> | <?= $assessment['subject']; ?> - <?= $assessment['class']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div id="messageDiv" style="height: 100%; justify-content: center; display: block;">
                        <center>
                          <p>Please select an assessment to edit</p>
                        </center>
                      </div>

                      <hr style="margin: 0px">
                      <center>
                        <p class="align-text-center" style="font-size: small; padding: 0%; margin: 0px;">Reschedule</p>
                      </center>
                      <hr style="margin-top: 0px">

                      <div style="display: block">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <input style="border-radius: 10px; height: 40px" name="date" class="form-control"
                                type="date" value="" disabled>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <input style="border-radius: 10px; height: 40px" class="form-control" type="time"
                                name="time" value="" disabled>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="type">Type</label>
                              <select style="border-radius: 10px; height: 40px" required class="form-control"
                                name="type" disabled>
                                <option selected disabled>Select</option>
                                <option>Homework</option>
                                <option>Test</option>
                                <option>Class work</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="mode">Mode</label>
                              <select style="border-radius: 10px; height: 40px" class="form-control" name="mode"
                                disabled>
                                <option disabled selected>Select</option>
                                <option>Physical</option>
                                <option>CBT</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <hr style="margin: 0px">
                        <center>
                          <p class="align-text-center" style="font-size: small; padding: 0%; margin: 0px;">Modify
                            Question(s)</p>
                        </center>
                        <hr style="margin-top: 0px">
                        <input type="hidden" name="questionContent" id="questionContent">
                        <div class="form-group">
                          <label for="focus">Question Focus</label>
                          <textarea style="border-radius: 10px;" class="form-control" id="focus" name="focus" rows="10"
                            placeholder="E.g Generate questions from ... and ... topics only" disabled></textarea>
                        </div>
                        <button type="submit" id="regenerate" class="btn btn-inverse-success btn-sm" style="width: 100%"
                          disabled>Re-Generate Content</button>
                      </div>
                    </form>
                    <!-- message div for select assessment -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>




        <script>
          //Function to display a popup message
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

            document.body.appendChild(popup);

            setTimeout(function () {
              popup.remove();
            }, 5000);
          }
        </script>



        <script>
          document.getElementById('assessment_id').addEventListener('change', function () {
            var selectedAssessment = this.options[this.selectedIndex];

            var isTopicSelected = this.value !== '';
            document.getElementsByName('date')[0].disabled = !isTopicSelected;
            document.getElementsByName('time')[0].disabled = !isTopicSelected;
            document.getElementsByName('type')[0].disabled = !isTopicSelected;
            document.getElementsByName('mode')[0].disabled = !isTopicSelected;
            document.getElementsByName('focus')[0].disabled = !isTopicSelected;
            document.getElementById('regenerate').disabled = !isTopicSelected;

            var messageDiv = document.getElementById('messageDiv');
            messageDiv.style.display = isTopicSelected ? 'none' : 'block';

            if (isTopicSelected) {
              // Get the date and time values from the selected assessment
              var dateValue = selectedAssessment.getAttribute('data-date');
              var timeValue = selectedAssessment.getAttribute('data-time');
              var modeValue = selectedAssessment.getAttribute('data-mode');
              var typeValue = selectedAssessment.getAttribute('data-type');

              // Update the date and time input fields
              document.getElementsByName('date')[0].value = dateValue;
              document.getElementsByName('time')[0].value = timeValue;
              document.getElementsByName('mode')[0].value = modeValue;
              document.getElementsByName('type')[0].value = typeValue;
            }
          });
        </script>

        <script>
          // JavaScript and jQuery code
          $(document).ready(function () {
            document.getElementById('saveConfig').addEventListener('click', function () {

              // Extract data from the form
              var formData = {
                date: $('input[name="date"]').val(),
                time: $('input[name="time"]').val(),
                mode: $('select[name="mode"]').val(),
                type: $('select[name="type"]').val(),
                id: $('select[name="assessment_id"]').val()
              };

              // Send an AJAX request to your PHP file
              $.ajax({
                type: 'POST',
                url: 'compile_content.php',
                data: formData,
                success: function (response) {
                  displayPopup(response.message, true);
                  console.log(response);
                },
                error: function (error) {
                  displayPopup(response.message, false);
                  console.log(error);
                }
              });
            });
          });
        </script>


        <script>
          $(document).ready(function () {
            $("#assessment_id").change(function () {
              const selectedValue = $(this).val();

              $.ajax({
                type: 'POST',
                url: 'get_content.php',
                data: { 'assessment_id': selectedValue },
                dataType: 'json',
                beforeSend: function () {
                  $("#loadingText").text("Getting Content...");
                  document.getElementById("loading-screen").style.display = "flex";
                },
                success: function (response) {
                  if (response.success) {
                    displayPopup(response.message, true);
                    console.log(response.content);
                    var textarea = document.getElementById("content");
                    textarea.value = response.content;
                    var hiddendiv = document.getElementById("questionContent");
                    hiddendiv.value = response.content;
                    var original = document.getElementById("id_div");
                    original.value = response.content;
                    var id_div = document.getElementById("original");
                    original.value = response.id;
                    // Process the response here, e.g., update the DOM with the content
                  } else {
                    console.log('Error: ' + response.message);
                    displayPopup(response.message, false);
                  }
                },

                error: function (error, xhr) {
                  //console.error('Error:', error, xhr);
                  displayPopup(error, false);
                  // Handle AJAX errors here
                },
                complete: function () {
                  document.getElementById("loading-screen").style.display = "none";
                },
              });
            });
          });


          $(document).ready(function () {
            document.getElementById("regenerate").addEventListener("click", function () {
              event.preventDefault();
              $.ajax({
                type: 'POST',
                url: 'update_content.php',
                data: $('#formMode').serialize(),
                dataType: 'json',
                beforeSend: function () {
                  $("#loadingText").text("Updating Content... May take upto a minute");
                  document.getElementById("loading-screen").style.display = "flex";
                },
                success: function (response) {
                  if (response.success) {
                    displayPopup(response.message, true);
                    console.log(response.content);
                    var textarea = document.getElementById("content");
                    textarea.value = response.content;
                    var hidden = document.getElementById("questionContent");
                    hidden.value = response.content;
                    var generated_content = document.getElementById("generated_content");
                    generated_content.value = response.content;
                    var id_div = document.getElementById("id_div");
                    original.value = response.id;

                    var compile_button = document.getElementById("compile");
                    compile_button.innerText = "Compile";
                    // Process the response here, e.g., update the DOM with the content
                  } else {
                    console.log('Error: ' + response.message);
                    displayPopup(response.message, false);
                  }
                },

                error: function (error, xhr) {
                  //console.error('Error:', error, xhr);
                  displayPopup(error, false);
                  // Handle AJAX errors here
                },
                complete: function () {
                  document.getElementById("loading-screen").style.display = "none";
                },
              });
            });
          });





          $(document).ready(function () {
            document.getElementById("compile").addEventListener("click", function () {
              event.preventDefault();
              $.ajax({
                type: 'POST',
                url: 'compile_content.php',
                data: $('#compileform').serialize(),
                dataType: 'json',
                beforeSend: function () {
                  $("#loadingText").text("Saving Changes... May take upto a minute");
                  document.getElementById("loading-screen").style.display = "flex";
                },
                success: function (response) {
                  if (response.success) {
                    displayPopup(response.message, true);
                    console.log(response.content);
                    var textarea = document.getElementById("content");
                    textarea.value = response.content;
                    var hidden = document.getElementById("questionContent");
                    hidden.value = response.content;
                    var original = document.getElementById("original");
                    original.value = response.content;
                    var id_div = document.getElementById("id_div");
                    original.value = response.id;
                    // Process the response here, e.g., update the DOM with the content
                  } else {
                    console.log('Error: ' + response.message);
                    displayPopup(response.message, false);
                  }
                },

                error: function (error, xhr) {
                  //console.error('Error:', error, xhr);
                  displayPopup(error, false);
                  // Handle AJAX errors here
                },
                complete: function () {
                  document.getElementById("loading-screen").style.display = "none";
                },
              });
            });
          });
        </script>
        <!-- content-wrapper ends -->


        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Rinda LMS
              2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free Rinda LMS Demo from <a
                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Rinda School Management
                Software</a></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../assets/js/shared/off-canvas.js"></script>
  <script src="../assets/js/shared/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
  <!-- End custom js for this page-->
</body>

</html>