<?php
require("settings.php");


if (isset($_GET['id'])) {
  $subject_id = $_GET['id'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Subjects | Rinda LMS
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
  <script src="jquery-3.6.4.min.js"></script>
  <script src="bootstrap.min.js"></script>

  <style>
    .card {
      border-radius: 10px;
    }

    .schedules :hover {
      background-color: blue;
      border-radius: 15px;
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
            <a class="nav-link" href="index.html">
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
            <a class="nav-link" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="ui-1">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Students</span>
              <i class="menu-arrow"></i>
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

          <?php
          $query = "SELECT * FROM subjects WHERE id = :id";
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':id', $subject_id, PDO::PARAM_INT);
          $stmt->execute();
          $subjects = $stmt->fetch(PDO::FETCH_ASSOC);

          $query = "SELECT * FROM class_schedule WHERE subject_id = :subject_id";
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
          $stmt->execute();
          $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

          $query = "SELECT * FROM teachers";
          $stmt = $pdo->prepare($query);
          $stmt->execute();
          $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);

          $query = "SELECT content FROM topics WHERE subject_id = :subject_id";
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
          $stmt->execute();
          $subject_topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

          $topics = [];
          foreach ($subject_topics as $subject_topic) {
            $topics[] = $subject_topic;
          }


          ?>

          <form id="subject_form">
            <div class="row" style=" margin-top: 10px;">
              <div class="col-md-7 grid-margin ">
                <div class="card">
                  <div class="card-body col-md-12 align-self-center">
                    <div class=" align-content-start">
                      <!-- Align content to left -->
                      <div>
                        <div class="form-group">
                          <label for="exampleTextarea1">Lesson Material</label>
                          <textarea disabled aria-disabled="not editable" class="form-control" id="exampleTextarea1"
                            name="material"
                            rows="38"><?php foreach ($topics as $topicArray): ?><?= implode(" \n ", $topicArray) ?><?php endforeach; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body d-flex flex-column">
                    <div class="wrapper">
                      <p>Settings</p>
                      <div>
                        <div class="form-group">
                          <label for="new_subject">Academic Term & Session</label>
                          <select style="border-radius: 10px; height: 40px" disabled class="form-control"
                            name="session">
                            <option selected disabled>Third Term 2023/2024 academic session (current)</option>
                          </select>
                        </div>


                        <div class="form-group">
                          <label for="class">Class</label>
                          <select disabled style="border-radius: 10px; height: 40px" class="form-control" name="class">
                            <option selected disabled value="<?= $subjects['class']; ?>"> <?= $subjects['class']; ?>
                            </option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="subject">Subject</label>
                          <input disabled style="border-radius: 10px; height: 40px" name="subject" class="form-control"
                            type="text" placeholder="Subject Name" value="<?= $subjects['subject']; ?>">
                        </div>

                        <div class="form-group">
                          <label for="teacher_id">Assign Teacher</label>
                          <select style="border-radius: 10px; height: 40px" class="form-control" name="teacher_id">
                            <option selected>
                              <?= $subjects['teacher_name']; ?>
                            </option>
                            <?php foreach ($teachers as $teacher): ?>
                              <?php if ($teacher['id'] != $subjects['teacher_id']): ?>
                                <option value="<?= $teacher['id']; ?>"> <?= $teacher['first_name'] . ' ' . $teacher['last_name']; ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </div>



                        <?php foreach ($schedules as $index => $schedule): ?>
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-group">
                                <?php echo ($index < 1) ? '<label for="schedule_day">Schedules</label>' : '' ?>
                                <select style="border-radius: 10px; height: 40px" class="form-control"
                                  name="schedule_day">
                                  <?php
                                  $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                  foreach ($daysOfWeek as $day) {
                                    $selected = ($day == $schedule['schedule_day']) ? 'selected' : '';
                                    // $disabled = ($index < 1 && $day == $schedule['schedule_day']) ? 'disabled' : '';
                                    echo "<option $selected>$day</option>";
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-5">
                              <div class="form-group">
                                <?php echo ($index < 1) ?
                                  '<label for="schedule_day"></label>'
                                  :
                                  '' ?>
                                <input style="border-radius: 10px; height: 40px" class="form-control" type="time"
                                  name="schedule_time" id="" value="<?php $time = date("H:i", strtotime($schedule['schedule_time']));
                                  echo $time; ?>">
                              </div>
                            </div>

                            <div>
                              <?php echo ($index < 1) ?
                                '<div class="form-group">
                                    <label for="add_schedule"></label>
                                    <div>
                                        <button type="button" style="width: 40px; border-radius: 10px; height: 40px;"
                                            class=" align-items-center btn btn-icons btn-inverse-success">
                                            <i class="mdi mdi-plus"></i>
                                    </div>
                                </div>'
                                :
                                '<div class="form-group">
                                    
                                    <div>
                                        <button type="button" style="width: 40px; border-radius: 10px; height: 40px;"
                                            class=" align-items-center btn btn-icons btn-inverse-danger">
                                            <i class="mdi mdi-minus"></i>
                                    </div>
                                </div>'
                              ; ?>
                            </div>
                          </div>
                        <?php endforeach ?>


                        <div class="form-group">
                          <label for="mode">Mode</label>
                          <select style="border-radius: 10px; height: 40px" class="form-control" name="mode">
                            <option disabled>Select</option>
                            <?php $mode = $subjects['mode']; ?>
                            <option <?= ($mode == 'Physical') ? 'selected' : ''; ?> value="Physical">Physical</option>
                            <option <?= ($mode == 'Virtual') ? 'selected' : ''; ?> value="Virtual">Virtual</option>
                          </select>
                        </div>
                        <input type="hidden" name="subject_id" value="<?= $subjects['id']; ?>">
                      </div>
                      <button id="updateSubject" class="btn btn-inverse-success btn-sm"
                        style="width: 100%; height: 40px; border-radius: 10px;">Save Changes
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
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


          document.getElementById("updateSubject").addEventListener("click", function () {
            event.preventDefault(); // Stop the default form submission

            $.ajax({
              type: 'POST',
              url: 'update_subject_data.php',
              data: $('#subject_form').serialize(),
              dataType: 'json',
              beforeSend: function () {
                document.getElementById("loading-screen").style.display = "flex";
                $('#subject_form').modal('hide');
              },
              success: function (response) {
                // Check the 'success' property in the response
                if (response.success) {
                  // Display success popup
                  displayPopup(response.message, true);
                  // Close the modal (adjust this based on your modal implementation)
                  document.getElementById("loading-screen").style.display = "none";
                } else {
                  // Display error popup
                  displayPopup(response.message, false);
                }
              },
              error: function (error, xhr) {
                // Display error popup for AJAX error
                displayPopup('Error occurred during AJAX request', false);
                console.error('Error:', error, xhr);
                $('#subject_form').modal('show');
              },
              complete: function () {
                document.getElementById("loading-screen").style.display = "none";
              },
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