<?php
require("../settings.php");


if (isset($_POST['class'])) {
  $class = $_POST['class'];
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,  user-scalable=no">


  <title>Subjects | Rinda LMS
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
      background-color: lightseagreen;
      border-radius: 15px;
      animation: 2s fade-in-out;
    }

    .schedules {
      background-color: black;
      border-radius: 10px;
      animation: 2s fade-in-out;
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
                <p class="mb-1 mt-3 font-weight-semibold">Teacher</p>
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
                <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg" alt="profile image">
                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">
                <p class="profile-name">Teacher</p>
                
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
            <a class="nav-link" data-toggle="collapse" href="subjects.php" aria-expanded="false" aria-controls="ui-1">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Subjects</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="assessments.php" aria-expanded="false"
              aria-controls="ui-3">
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
              <i class="menu-icon typcn typcn-bell"></i>
              <span class="menu-title">Notifications Center</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="menu-icon typcn typcn-user-outline"></i>
              <span class="menu-title">Analytics</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- partial -->
      <div class="main-panel">


        <?php
        $query = "SELECT * FROM assessments WHERE teacher_id = :teacher_id ORDER BY `assessments`.`date` ASC";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_STR);
        $stmt->execute();
        $assessments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($assessments) {
           // Count the number of 'completed' and 'Queued' assessments
        $completedCount = 0;
        $queuedCount = 0;


          foreach ($assessments as $assessment) {
            if ($assessment['status'] === 'Completed') {
              $completedCount++;
            } elseif ($assessment['status'] === 'Queued') {
              $queuedCount++;
            }
          }

          // Calculate the percentage of completed assessments
          $totalAssessments = count($assessments);
          $completionPercentage = ($completedCount / $totalAssessments) * 100;
        } else {
          $completedCount = 0;
          $totalAssessments = 0;
          $completionPercentage = 0;
        }
       


          $suggestionMessage = '';
          if ($completionPercentage < 40) {
            $dotColor = 'bg-danger';
            $suggestionMessage = "I suggest you conduct more assessments to assess individual performance.";
          } elseif ($completionPercentage >= 41 && $completionPercentage <= 80) {
            $dotColor = 'bg-warning';
            $suggestionMessage = "Students are doing great! Consider providing real-time lesson feedback to help improve analysis.";
          } elseif ($completionPercentage > 80) {
            $dotColor = 'bg-success';
            $suggestionMessage = "Students are doing excellent! Encourage them to maintain their performance.";
          }

          ?>

          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body" style="padding: 4%; margin: 0%;">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="d-flex align-items-center pb-2">
                              <div class="dot-indicator <?= $dotColor ?> mr-2"></div>
                              <p class="mb-0">Performance</p>
                            </div>
                            <?php

                            echo '<p style="padding: 0px">' . $suggestionMessage . '</p>';
                            ?>


                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="d-flex align-items-center pb-2">
                              <?php
                              $backgroundColor = '';
                              if ($completionPercentage < 40) {
                                $backgroundColor = 'bg-danger';
                              } elseif ($completionPercentage >= 41 && $completionPercentage <= 80) {
                                $backgroundColor = 'bg-warning';
                              } elseif ($completionPercentage > 80) {
                                $backgroundColor = 'bg-success';
                              }

                              $indicatorHTML = '<div class="dot-indicator ' . $backgroundColor . ' mr-2"></div>';
                              echo $indicatorHTML;
                              ?>

                              <p class="mb-0">Assessments</p>
                            </div>
                            <h5 class="font-weight-semibold">
                              <?= $completedCount ?> /
                              <?= $totalAssessments ?>
                            </h5>
                            <div class="progress progress-md">
                              <div class="progress-bar <?= $backgroundColor ?>" role="progressbar"
                                style="width: <?= $completionPercentage ?>%" aria-valuenow="<?= $completionPercentage ?>"
                                aria-valuemin="0" aria-valuemax="30"></div>
                            </div>
                            <?php

                            ?>
                          </div>
                          <div class="col-md-6 mt-4 mt-md-0">
                            <div class="d-flex align-items-center pb-2">
                              <div class="dot-indicator bg-primary mr-2"></div>
                              <p class="mb-0">Current Week</p>
                            </div>
                            <h5 class="font-weight-semibold">Week 1</h5>
                            <div class="progress progress-md">
                              <div class="progress-bar bg-primary" role="progressbar" style="width: 10%"
                                aria-valuenow="10" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 grid-margin">
                    <div class="card">
                      <div class="card-body"> <strong>
                          <h5>Assigned Subjects</h5>
                        </strong>


                        <?php

                        $query = "SELECT * FROM subjects WHERE teacher_id = :teacher_id ORDER BY `subjects`.`subject` ASC";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_STR);
                        $stmt->execute();
                        $Subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);



                        if (count($Subjects) === 0) {
                          echo '<p class="text-center">No subject assigned to you yet!</p>';

                        } else {
                          ?>

                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th> Name </th>
                                <th>Class</th>
                                <th> No. of topics </th>
                                <th> Progress </th>
                                <th> Action </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              foreach ($Subjects as $index => $Subject): ?>
                                <tr>
                                  <td>
                                    <?= $Subject['subject']; ?>
                                  </td>
                                  <td class="py-1">
                                    <?= $Subject['class']; ?>
                                  </td>

                                  <td>
                                    <?= $Subject['topics_no']; ?> Topics
                                  </td>
                                  <td>
                                    <div class="progress">
                                      <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: <?= $Subject['progress']; ?>%"
                                        aria-valuenow="<?= $Subject['progress']; ?>" aria-valuemin="0" aria-valuemax="100">
                                      </div>
                                    </div>
                                  </td>
                                  <td>
<!-- 
                                    <button style="padding:7px 5px" type="button" id="form_button"
                                      class="btn social-btn btn-rounded btn-social-outline-twitter">
                                      <a href="topic.php">
                                        <i class="fa fa-graduation-cap "></i>
                                      </a>
                                    </button> -->
                                    <a href="topic.php?subject=<?= $Subject['subject']; ?> & id=<?= $Subject['id']; ?> ">
                                      <button style="padding:7px" type="button" id="form_button"
                                        class="btn social-btn btn-rounded btn-social-outline-twitter">
                                        <i class="mdi mdi-settings"></i>
                                      </button></a>
                                  </td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="col-md-12 grid-margin">
                  <h5>Upcoming Classes</h5>
                  <?php
                  $query = "SELECT * FROM class_schedule WHERE tutor = :tutor ORDER BY `class_schedule`.`schedule_day` ASC";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':tutor', $teacher_id, PDO::PARAM_STR);
                  $stmt->execute();
                  $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  if (count($schedules) === 0) {
                    echo '<p class="text-center" style="padding-top: 15%;">You have no upcoming classes</p>';

                  } else {

                  foreach ($schedules as $index => $schedule):
                    // Only display the first 3 assessments
                    if ($index < 3):
                      ?>
                      <div class="schedules grid-margin stretch-card average-price-card">
                        <div class="card schedule text-white" style="background-color: lightseagreen;">
                          <div class="card-body">
                            <div class="d-flex justify-content-between pb-2 align-items-center">
                              <h2 class="font-weight-semibold mb-0">
                                <?= $schedule['subject']; ?>
                              </h2>
                            </div>
                            <div class="d-flex justify-content-between">
                              <p style="font-weight: bold; color: white" class="font-weight-semibold mb-0">
                                <?= $schedule['type']; ?>
                              </p>
                              <p class="text-white mb-0">
                                <?= $schedule['schedule_day']; ?> -
                                <?php
                                $time = date("H:i", strtotime($schedule['schedule_time']));
                                echo $time;
                                ?>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php
                    endif;
                  endforeach;
                  ?>

                  <?php
                  if ($index > 3): ?>
                    <div class="row">
                      <div style="width: 195px;"></div>
                      <a href="schedules">
                        <p style="color: lightseagreen">View
                          <?= $index - 2 ?> more
                        </p>
                      </a>
                    </div>
                  <?php endif; } ?>
                </div>
              </div>
            </div>
          </div>

        
        <script src="jquery-3.6.4.min.js"></script>
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


          document.getElementById("form_button").addEventListener("click", function () {
            $.ajax({
              type: 'POST',
              url: 'suggest.php',
              data: $('#subject_form').serialize(),
              dataType: 'json',
            });
          });
        </script>
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