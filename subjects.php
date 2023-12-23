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
  <title>Subjects | Riida LMS
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
          <h3 style="font-weight: bold">Riida LMS</h3>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <h3 style="font-weight: bold">Riida LMS</h3>
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
            <a class="nav-link" href="pages/tables/basic-table.html">
              <i class="menu-icon typcn typcn-bell"></i>
              <span class="menu-title">Apps</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-1" aria-expanded="false" aria-controls="ui-1">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Students</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-1">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-2" aria-expanded="false" aria-controls="ui-2">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Lectures</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/buttons.html">All lectures</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/dropdowns.html">Process new lecture</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/typography.html">Edit lectures</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-3" aria-expanded="false" aria-controls="ui-3">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Exams</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-3">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/buttons.html">All Exams</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/dropdowns.html">Generate New</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/typography.html">Mark Assessments</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">Calendar</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">Events</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <i class="menu-icon typcn typcn-bell"></i>
              <span class="menu-title">Notifications Center</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/icons/font-awesome.html">
              <i class="menu-icon typcn typcn-user-outline"></i>
              <span class="menu-title">Chats</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon typcn typcn-document-add"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/samples/login.html"> Login </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/samples/register.html"> Register </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/samples/error-404.html"> 404 </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/samples/error-500.html"> 500 </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>

      <?php
      // $query = "SELECT * FROM terms";
      // $stmt = $pdo->prepare($query);
      // // $stmt->bindParam(':class', $class, PDO::PARAM_STR);
      // $stmt->execute();
      // $terms = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      $query = "SELECT * FROM classes";
      $stmt = $pdo->prepare($query);
      // $stmt->bindParam(':class', $class, PDO::PARAM_STR);
      $stmt->execute();
      $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

      ?>

      <!-- todo display modal -->
      <div class="modal fade" id="add_new" tabindex="-1" aria-hidden="true" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div class="">
                <div class="">
                  <div class="card-body d-flex flex-column">
                    <form action="" id="add_subject_form" method="post">
                      <div class="add_new_subject">
                        <p>Add New Subject</p>
                        <div>
                          <div class="form-group">
                            <label for="term">Academic Term & Session</label>
                            <select style="border-radius: 10px; height: 40px" class="form-control" name="term">
                              <option value="Third Term">Third Term 2023/2024 academic session
                                (current)</option>
                            </select>
                          </div>


                          <div class="form-group">
                            <label for="class">Class</label>
                            <select style="border-radius: 10px; height: 40px" class="form-control" name="class">
                              <option selected disabled>Select</option>
                              <?php
                              foreach ($classes as $class): ?>
                                <option value="<?= $class['class']; ?>"> <?= $class['class']; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="subject">Subject</label>
                            <input style="border-radius: 10px; height: 40px" name="subject" class="form-control"
                              type="text" placeholder="Subject Name">
                          </div>

                          <div class="row  schedule_tab" id="schedule_tab">
                            <div class="col-md-5">
                              <div class="form-group">
                                <label for="schedule_day">Schedule(s)</label>
                                <select style="border-radius: 10px; height: 40px" class="form-control"
                                  name="schedule_day[]">
                                  <option disabled selected>day</option>
                                  <option>Monday</option>
                                  <option>Tuesday</option>
                                  <option>Wednesday</option>
                                  <option>Thursday</option>
                                  <option>Friday</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-5">
                              <div class="form-group">
                                <label for="schedule_time"></label>
                                <input style="border-radius: 10px; height: 40px" class="form-control" type="time"
                                  name="schedule_time[]" id="">
                              </div>
                            </div>


                            <div>
                              <div class="form-group">
                                <label for="add_schedule"></label>
                                <div>
                                  <button id="add_schedule" type="button"
                                    style="width: 40px; border-radius: 10px; height: 40px;"
                                    class=" align-items-center btn btn-icons btn-inverse-success">
                                    <i class="mdi mdi-plus"></i>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div id="schedules"></div>
                          <div style="display: none">
                            <div class="row schedule-tab" id="schedule-tab">
                              <div class="col-md-5">
                                <div class="form-group">
                                  <select style="border-radius: 10px; height: 40px" class="form-control"
                                    name="schedule_day[]">
                                    <option disabled selected>day</option>
                                    <option>Monday</option>
                                    <option>Tuesday</option>
                                    <option>Wednesday</option>
                                    <option>Thursday</option>
                                    <option>Friday</option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-5">
                                <div class="form-group">
                                  <input style="border-radius: 10px; height: 40px" class="form-control" type="time"
                                    name="schedule_time[]" id="">
                                </div>
                              </div>


                              <div>
                                <div class="form-group">
                                  <div>
                                    <button id="remove-schedule" type="button"
                                      style="width: 40px; border-radius: 10px; height: 40px;"
                                      class=" align-items-center btn btn-icons btn-inverse-danger">
                                      <i class="mdi mdi-minus"></i>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>

                          <div class="form-group">
                            <label for="tutor">Tutor</label>
                            <select style="border-radius: 10px; height: 40px" class="form-control" name="tutor">
                              <option disabled selected>Select</option>
                              <option>Ahmad</option>
                            </select>
                          </div>

                          <div class="row">
                            <div class="col-md-10">
                              <div class="form-group">
                                <label for="topics">Topic(s)</label>
                                <input style="border-radius: 10px; height: 40px" class="form-control" type="text"
                                  name="topics[]" id="">
                              </div>
                            </div>

                            <div>
                              <div class="form-group">
                                <label for="add_topic"></label>
                                <div>
                                  <button id="add_topic" type="button"
                                    style="width: 40px; border-radius: 10px; height: 40px;"
                                    class=" align-items-center btn btn-icons btn-inverse-success">
                                    <i class="mdi mdi-plus"></i>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="new-topic-tab"></div>

                          <div style="display: none">
                            <div class="row add-new-topic">
                              <div class="col-md-10">
                                <div class="form-group">
                                  <input style="border-radius: 10px; height: 40px" class="form-control" type="text"
                                    name="topics[]" id="">
                                </div>
                              </div>

                              <div>
                                <div class="form-group">
                                  <div>
                                    <button id="remove-topic" type="button"
                                      style="width: 40px; border-radius: 10px; height: 40px;"
                                      class=" align-items-center btn btn-icons btn-inverse-danger">
                                      <i class="mdi mdi-minus"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="mode">Mode</label>
                            <select style="border-radius: 10px; height: 40px" class="form-control" name="mode">
                              <option disabled selected>Select</option>
                              <option>Physical</option>
                              <option>Virtual</option>
                            </select>
                          </div>



                        </div>
                        <button id="add_subject_form_button" type="submit" class="btn btn-inverse-success btn-sm"
                          style="width: 100%; height: 40px; border-radius: 10px;">Create Subject</button>
                      </div>
                    </form>
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
        <div id="loading-screen">
            <img src="processing.gif" alt="Loading">
            <p style="font-size: 17px">Generating Subject Contents... May take upto a minute</p>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-11">
                      <h4 class="card-title">Subjects</h4>
                      <p class="card-description" style="padding: 2px 5px;">
                        <?php if (isset($_POST['class'])) {
                          echo $_POST['class'];
                        } ?>
                      </p>
                    </div>
                    <div>
                      <div class="form-group">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#add_new"
                          style=" width: 40px; border-radius: 10px; height: 40px;"
                          class=" align-items-center btn btn-icons btn-inverse-success">
                          <i class="mdi mdi-plus"></i>
                        </button>
                      </div>
                    </div>
                  </div>




                  <?php

                  $query = "SELECT * FROM subjects";
                  $stmt = $pdo->prepare($query);
                  // $stmt->bindParam(':class', $class, PDO::PARAM_STR);
                  $stmt->execute();
                  $Subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);



                  if (count($Subjects) === 0) {
                    echo '<p class="text-center">None added Yet!</p>';
                    echo '<center> <a href="#" data-bs-toggle="modal"
                    data-bs-target="#add_new"> <button type="submit" class="btn btn-inverse-success btn-sm" style="width: 20%">Add New</button> </a></center>';

                    $query = "SELECT * FROM classes ORDER BY `classes`.`class` ASC";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  } else {
                    ?>


                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Index </th>
                          <th> Name </th>
                          <th> Class </th>
                          <th> Topics </th>
                          <th> Tutor </th>
                          <th> Progress </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($Subjects as $index => $Subject): ?>
                          <tr>
                            <td class="py-1">
                              <?= $index + 1; ?>
                            </td>
                            <td>
                              <?= $Subject['subject']; ?>
                            </td>
                            <td>
                              <?= $Subject['class']; ?>
                            </td>
                            <td>
                              <?= $Subject['topics_no']; ?> Topics
                            </td>
                            <td>
                              <?= $Subject['tutor']; ?>
                            </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar"
                                  style="width: <?= $Subject['progress']; ?>%" aria-valuenow="<?= $Subject['progress']; ?>"
                                  aria-valuemin="0" aria-valuemax="100">
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="row" style="justify-content: space-around;">
                                <a href="edit_subject.php?id=<?= $Subject['id']; ?>">
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


        <script src="jquery-3.6.4.min.js"></script>

        <script>
          $(document).ready(function () {
            // Add new schedule tab
            $("#add_schedule").on("click", function () {
              console.log('clicked');
              var newScheduleTab = $(".schedule-tab:first").clone();
              newScheduleTab.find("select").val("day"); // Reset day selection
              newScheduleTab.find("input[type='time']").val(""); // Reset time input
              newScheduleTab.appendTo("#schedules");
            });

            // Add new topic tab
            $("#add_topic").on("click", function () {
              console.log('clicked');
              var newScheduleTab = $(".add-new-topic:first").clone();
              newScheduleTab.find("input[type='text']").val(""); // Reset time input
              newScheduleTab.appendTo(".new-topic-tab");
            });

            // Remove schedule tab
            $(document).on("click", "#remove-schedule", function () {
              $(this).closest(".schedule-tab").remove();
            });

            // Remove topic tab
            $(document).on("click", "#remove-topic", function () {
              $(this).closest(".add-new-topic").remove();
            });
          });
        </script>

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




          document.getElementById("add_subject_form_button").addEventListener("click", function () {
            console.log('form submitted');
            event.preventDefault();



            $.ajax({
              type: 'POST',
              url: 'add_subject_data.php',
              data: $('#add_subject_form').serialize(),
              dataType: 'json',
              beforeSend: function () {
                document.getElementById("loading-screen").style.display = "flex";
                // Disable submit button and input fields
                $('#add_subject_form_button').prop('disabled', true);
                $('#add_subject_form :input').prop('disabled', true);
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
              },
              complete: function () {
                document.getElementById("loading-screen").style.display = "none";
                // Enable submit button and input fields after AJAX request is complete
                $('#add_subject_form_button').prop('disabled', false);
                $('#add_subject_form :input').prop('disabled', false);
              },
            });
          });


        </script>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Riida LMS
              2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free Riida LMS Demo from <a
                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Riida School Management
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