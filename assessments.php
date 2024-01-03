<?php
require("settings.php");

if (isset($_POST['class'])) {
  $class = $_POST['class'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Assessments | Rinda LMS
  </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/shared/style.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/demo_1/style.css">
  <!-- End Layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
  <script src="../jquery-3.6.4.min.js"></script>
  <!-- <script src="../bootstrap.min.js"></script> -->

  <!-- Add these links in the head section of your HTML file -->
  <!-- <link rel="stylesheet" href="../bootstrap.min.css">
  <script src="../popper.min.js"></script> -->
  <script src="../bootstrap.min.js"></script>


  <style>
    .card {
      border-radius: 10px;
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
                  <img src="assets/images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="assets/images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="assets/images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
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
              <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image">
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
            <a class="nav-link" href="index.php">
              <i class="menu-icon typcn typcn-document-text"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="teachers.php" aria-expanded="false" aria-controls="ui-2">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Teachers</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="classes.php" aria-expanded="false" aria-controls="ui-1">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Classes</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="students.php" aria-expanded="false" aria-controls="ui-1">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Students</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="assessments.php" aria-expanded="false" aria-controls="ui-3">
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




      <?php
      $query = "SELECT * FROM assessments WHERE create_by = :tutor";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':tutor', $tutor, PDO::PARAM_STR);
      $stmt->execute();
      $assessments = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $query = "SELECT * FROM subjects WHERE tutor = :tutor";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':tutor', $tutor, PDO::PARAM_STR);
      $stmt->execute();
      $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);




      ?>

      <!-- todo display modal -->
      <div class="modal fade" id="add_new" tabindex="-1" aria-hidden="true" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div class="">
                <div class="">
                  <div class="card-body d-flex flex-column">
                    <div class="wrapper">
                      <p>Tweak Settings</p>
                      <form action="" method="post" id="generate_form">
                        <div>
                          <div class="form-group">
                            <label for="type">Subject</label>
                            <select style="border-radius: 10px; height: 40px" required class="form-control"
                              name="subject">
                              <option selected disabled> Select </option>
                              <?php foreach ($subjects as $subjectItem): ?>
                                <option value="<?= $subjectItem['subject']; ?>" > <?= $subjectItem['subject'] . ' - ' . $subjectItem['class']; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="type">Type</label>
                            <select style="border-radius: 10px; height: 40px" required class="form-control" name="type">
                              <option selected disabled>Select</option>
                              <option>Homework</option>
                              <option>Test</option>
                              <option>Class work</option>
                            </select>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="date">Schedule</label>
                                <input style="border-radius: 10px; height: 40px" name="date" class="form-control"
                                  type="date">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="time"></label>
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
                              <option>CBT</option>
                            </select>
                          </div>


                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="date">Number of Questions</label>
                                <input style="border-radius: 10px; height: 40px" name="objective" class="form-control"
                                  type="number" placeholder="Objective Questions">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="time"></label>
                                <input style="border-radius: 10px; height: 40px" class="form-control" type="number"
                                  name="essay" placeholder="Essay Questions">
                              </div>
                            </div>
                          </div>

                          <input type="hidden" name="tutor" value="<?= $tutor ?>">
                          <input type="hidden" name="class" value="<?= $subjectItem['class'] ?>">
                          <input type="hidden" name="subject_id" value="<?= $subjectItem['id'] ?>">

                          <div class="form-group">
                            <label for="focus">Question Focus</label>
                            <textarea style="border-radius: 10px;" class="form-control" id="focus" name="focus" rows="5"
                              placeholder="E.g Generate questions from ... and ... topics only"></textarea>
                          </div>

                        </div>
                        <button type="submit" class="btn btn-inverse-success btn-sm" style="width: 100%"
                          id="generate">Generate
                          Assessment</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div id="loadingScreen">Generating... May take a while</div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-11">
                      <h4 class="card-title">Assessments</h4>
                      <p class="card-description" style="padding: 2px 5px;">
                        <?php if (isset($_POST['class'])) {
                          echo $_POST['class'];
                        } ?>
                      </p>
                    </div>
                    <div>
                      <div class="form-group">
                        <div>
                          <button type="button" data-bs-toggle="modal" data-bs-target="#add_new"
                            style=" width: 40px; border-radius: 10px; height: 40px;"
                            class=" align-items-center btn btn-icons btn-inverse-success">
                            <i class="mdi mdi-plus"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>




                  <?php
                  if (count($assessments) === 0) {
                    echo '<p class="text-center">None added Yet!</p>';
                    echo '<center> <a href="#" data-bs-toggle="modal"
                    data-bs-target="#add_new"> <button type="submit" class="btn btn-inverse-success btn-sm" style="width: 20%">Add New</button> </a></center>';


                  } else {
                    ?>


                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Index </th>
                          <th> Subject </th>
                          <th> Class </th>
                          <th> Type </th>
                          <th> Time </th>
                          <th> Date </th>
                          <th> Mode </th>
                          <th> Status </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($assessments as $index => $assessment): ?>
                          <tr>
                            <td class="py-1">
                              <?= $index + 1; ?>
                            </td>
                            <td>
                              <?= $assessment['subject']; ?>
                            </td>
                            <td>
                              <?= $assessment['class']; ?>
                            </td>
                            <td>
                              <?= $assessment['type']; ?>
                            </td>
                            <td>
                              <?php $time = date("H:i", strtotime($assessment['time']));
                              echo $time;
                              ?>
                            </td>
                            <td>
                              <?php $dt = date("j F, Y", strtotime($assessment['date']));
                              echo $dt; ?>
                            </td>
                            <td>
                              <?= $assessment['mode']; ?>
                            </td>
                            <td class="text-warning">
                              <?= $assessment['status']; ?>
                            </td>
                            <td>
                              <div class="row" style="justify-content: space-around;">
                                <a
                                  href="edit_assessment.php?id=<?= $assessment['id'] ?> & subject=<?= $assessment['subject'] ?>">
                                  <button type="button" id="form_button"
                                    class="btn social-btn btn-rounded btn-social-outline-twitter"
                                    style="width: 30px; height: 30px; padding: 0%;">
                                    <i class="mdi mdi-settings"></i>
                                  </button>
                                </a>


                                <button type="button" id="form_button"
                                  class="btn social-btn btn-rounded btn-social-outline-twitter"
                                  style="width: 30px; height: 30px; padding: 0%">
                                  <i class="fa fa-bar-chart-o"></i>
                                </button>
                              </div>
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




          $(document).ready(function () {
            document.getElementById("generate").addEventListener("click", function () {
              event.preventDefault();

              $.ajax({
                type: 'POST',
                url: 'add_assessment.php',
                data: $('#generate_form').serialize(),
                dataType: 'json',
                beforeSend: function () {
                  $('#generate').prop('disabled', true);
                  $('#generate_form :input').prop('disabled', true);
                  $('#loadingScreen').show();
                },
                success: function (response) {
                  if (response.success) {
                    console.log(response.content);
                    displayPopup(response.message, true);
                    // $('#loadingScreen').hide();
                    // $('#add_new').modal('hide');
                    // Process the response here, e.g., update the DOM with the content
                  } else {
                    console.log('Error: ' + response.message);
                    displayPopup(response.message, false);
                  }
                },

                error: function (error, xhr) {
                  console.error('Error:', error, xhr);
                  displayPopup('Error occurred during AJAX request', false);
                  // Handle AJAX errors here
                },
                complete: function () {
                  // Disable loading icon or perform any post-request actions
                  $('#loadingScreen').hide();
                  $('#add_new').modal('hide');
                  $('#generate').prop('disabled', false);
                  $('#generate_form :input').prop('disabled', false);
                },
              });
            });
          });
        </script>

        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Rinda LMS
              2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free Rinda LMS Demo from <a
                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Rinda School Management Software</a></span>
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
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../../assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../../assets/js/shared/off-canvas.js"></script>
  <script src="../../assets/js/shared/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
  <!-- End custom js for this page-->
</body>

</html>