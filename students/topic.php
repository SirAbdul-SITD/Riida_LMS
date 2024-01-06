<?php
require("../settings.php");

if (isset($_POST['new_subject'])) {
  $class = $_POST['new_class'];
  $new_subject = $_POST['new_subject'];
  
  $updateQuery = "INSERT INTO `subjects` (`subject`, `class`, `assigned`) VALUES (:subject, :class, :assigned)";
  $updateStmt = $pdo->prepare($updateQuery);
  $updateStmt->bindParam(':subject', $new_subject, PDO::PARAM_STR);
  $updateStmt->bindParam(':class', $class, PDO::PARAM_STR);
  $updateStmt->bindParam(':assigned', $teacher_id, PDO::PARAM_STR);
  $updateStmt->execute();

  $amount = 1;
  $updateBalanceQuery = "UPDATE classes SET subject_no = subject_no + :amount WHERE class = :class";
  $updateBalanceStmt = $pdo->prepare($updateBalanceQuery);
  $updateBalanceStmt->bindParam(':amount', $amount, PDO::PARAM_INT);
  $updateBalanceStmt->bindParam(':class', $class, PDO::PARAM_STR);
  $updateBalanceStmt->execute();
}

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
  <meta name="viewport" content="width=device-width, initial-scale=0.1, shrink-to-fit=no">


  <title>Subject Settings | Rinda LMS
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

    #loadingScreen {
      position: fixed;
      top: 50%;
      left: 60%;
      transform: translate(-50%, -50%);
      display: none;
      background-color: rgba(0, 0, 0, 0.5);
      color: #fff;
      padding: 20px;
      border-radius: 8px;
      z-index: 9999;
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
        <h3 style="font-weight: bold">Rinda LMS</h3> </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <h3 style="font-weight: bold">Rinda LMS</h3> </a>
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
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="profile-image">
                <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg" alt="profile image">
                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">
                <p class="profile-name">Student</p>
                
              </div>
            </a>
          </li>
          <li class="nav-item nav-category">Main Menu</li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="menu-icon typcn typcn-document-text"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="subjects.php" aria-expanded="false">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Subjects</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" aria-expanded="false">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Timetable</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" aria-expanded="false">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Assessments</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">Calendar</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">Events</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="menu-icon typcn typcn-bell"></i>
              <span class="menu-title">Notifications Center</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

        <div id="loadingScreen">Generating... May take a while</div>



          <?php
          $query = "SELECT * FROM classes";
          $stmt = $pdo->prepare($query);
          $stmt->execute();
          $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

          $query = "SELECT * FROM topics WHERE subject_id = :subject_id";
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_STR);
          $stmt->execute();
          $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>


          <div class="row" style=" margin-top: 10px;">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body col-md-12 align-self-center">
                  <div class=" align-content-start">
                    <!-- Align content to left -->
                    <form method="GET" id="compileform">
                      <div class="form-group">
                        <label for="exampleTextarea1">Edit topic contents</label>
                        <textarea style="border-radius: 10px;" class="form-control" id="content" name="content"
                         rows="32"></textarea>
                         <input type="hidden" name="original" id="original">
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
                      <p class="col-md-10">Tweak Settings</p>
                      <button type="submit" class="btn btn-inverse-success" style="padding: 1% 2% 1% 3%;"> <i
                          class="fa fa-save"></i></button>
                    </div>
                    <form id="formMode" action="" method="GET">
                      <div class="form-group">
                        <label for="type">Topic</label>
                        <select style="border-radius: 10px; height: 40px" required class="form-control" id="topic"
                          name="topic">
                          <option selected disabled> Select </option>
                          <?php foreach ($topics as $topic): ?>
                            <option value="<?= $topic['id']; ?>"> <?= $topic['topic']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <!-- implement display none/block -->

                      <hr style=" margin: 0px">
                        <center>
                          <p class="align-text-center" style="font-size: small; padding: 0%; margin: 0px;">Schedule a class
                            </p>
                        </center>
                        <hr style=" margin-top: 0px">


                      <div style="display: block">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">

                              <input style="border-radius: 10px; height: 40px" name="date" class="form-control"
                                type="date">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">

                              <input style="border-radius: 10px; height: 40px" class="form-control" type="time"
                                name="time">
                            </div>
                          </div>
                        </div>




                        <div class="form-group">
                          <label for="mode">Mode</label>
                          <select style="border-radius: 10px; height: 40px" class="form-control" name="mode">
                            <option disabled selected>Select</option>
                            <option>Physical</option>
                            <option>Virtual (Supervised)</option>
                            <option>Virtual (AI Tutor)</option>
                          </select>
                        </div>

                        <hr style=" margin: 0px">
                        <center>
                          <p class="align-text-cente" style="font-size: small; padding: 0%; margin: 0px;">Modify
                            Content</p>
                        </center>
                        <hr style=" margin-top: 0px">

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="examples">Number of examples</label>
                              <input style="border-radius: 10px; height: 40px" name="examples" class="form-control"
                                type="number" placeholder="3 by default">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="time">Adjust Content level</label>
                              <select style="border-radius: 10px; height: 40px" class="form-control" name="mode">
                                <option selected>Not Specified</option>
                                <option>Basic Explanations</option>
                                <option>in-depth Explanation</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <input type="hidden" name="topicContent" id="topicContent">
                       
                        

                        <div class="form-group">
                          <label for="focus">Additional Requirement</label>
                          <textarea style="border-radius: 10px;" class="form-control" id="message" name="message" rows="3"
                            placeholder="E.g. Spread the number of examples across the sub-topics evenly..."></textarea>
                        </div>
                        <button type="submit" id="regenerate" class="btn btn-inverse-success btn-sm" style="width: 100%">Re-Generate
                          Content</button>
                      </div>



                      <!-- implement display none/block -->
                      <div style="height: 100%; justify-content: center; display: none;">
                        <center>
                          <p>Please select a topic to edit</p>
                        </center>
                      </div>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <script>
            Function to display a popup message
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


          document.getElementById("form_button").addEventListener("click", function () {
            $.ajax({
              type: 'POST',
              url: 'suggest.php',
              data: $('#subject_form').serialize(),
              dataType: 'json',
            });
          });

        </script>


        <script>
          $(document).ready(function () {
            $("#topic").change(function () {
              const selectedValue = $(this).val();

              $.ajax({
                type: 'POST',
                url: 'get_content.php',
                data: { 'topic_id': selectedValue },
                dataType: 'json',
                beforeSend: function () {
                  // Show loading icon or perform any pre-request actions
                },
                success: function (response) {
                  if (response.success) {
                    console.log(response.content);
                    var textarea = document.getElementById("content");
                    textarea.value = response.content;
                    var hiddendiv = document.getElementById("topicContent");
                    hiddendiv.value = response.content;
                    var original = document.getElementById("original");
                    original.value = response.content;
                    // Process the response here, e.g., update the DOM with the content
                  } else {
                    console.log('Error: ' + response.message);
                  }
                },

                error: function (error, xhr) {
                  console.error('Error:', error, xhr);
                  // Handle AJAX errors here
                },
                complete: function () {
                  // Disable loading icon or perform any post-request actions
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
                  $('#loadingScreen').show();
                },
                success: function (response) {
                  if (response.success) {
                    console.log(response.content);
                    var textarea = document.getElementById("content");
                    textarea.value = response.content;
                    var hidden = document.getElementById("topicContent");
                    hidden.value = response.content;
                    var generated_content = document.getElementById("generated_content");
                    generated_content.value = response.content;
                    

                    var compile_button = document.getElementById("compile");
                    compile_button.innerText = "Compile";
                    // Process the response here, e.g., update the DOM with the content
                  } else {
                    console.log('Error: ' + response.message);
                  }
                },

                error: function (error, xhr) {
                  console.error('Error:', error, xhr);
                  // Handle AJAX errors here
                },
                complete: function () {
                  $('#loadingScreen').hide();
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
                  $('#loadingScreen').show();
                },
                success: function (response) {
                  if (response.success) {
                    console.log(response.content);
                    var textarea = document.getElementById("content");
                    textarea.value = response.content;
                    var hidden = document.getElementById("topicContent");
                    hidden.value = response.content;
                    var original = document.getElementById("original");
                    original.value = response.content;
                    // Process the response here, e.g., update the DOM with the content
                  } else {
                    console.log('Error: ' + response.message);
                  }
                },

                error: function (error, xhr) {
                  console.error('Error:', error, xhr);
                  // Handle AJAX errors here
                },
                complete: function () {
                  $('#loadingScreen').hide();
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
              2024</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Rinda LMS <a
                href="#" target="_blank">Powered By Rinda AI</a></span>
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