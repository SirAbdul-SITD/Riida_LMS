<?php
require("../settings.php");

if (isset($_POST['new_subject'])) {
  $class = $_POST['new_class'];
  $new_subject = $_POST['new_subject'];
  
  $updateQuery = "INSERT INTO `subjects` (`subject`, `class`, `assigned`) VALUES (:subject, :class, :assigned)";
  $updateStmt = $pdo->prepare($updateQuery);
  $updateStmt->bindParam(':subject', $new_subject, PDO::PARAM_STR);
  $updateStmt->bindParam(':class', $class, PDO::PARAM_STR);
  $updateStmt->bindParam(':assigned', $tutor, PDO::PARAM_STR);
  $updateStmt->execute();

  $amount = 1;
  $updateBalanceQuery = "UPDATE classes SET subject_no = subject_no + :amount WHERE class = :class";
  $updateBalanceStmt = $pdo->prepare($updateBalanceQuery);
  $updateBalanceStmt->bindParam(':amount', $amount, PDO::PARAM_INT);
  $updateBalanceStmt->bindParam(':class', $class, PDO::PARAM_STR);
  $updateBalanceStmt->execute();
}

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
  <title>Topic | Riida LMS
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
  <script src="jquery-3.6.4.min.js"></script>

  <style>
    .card {
      border-radius: 10px;
    }

    .schedules :hover {
      background-color: blue;
      border-radius: 15px;
      animation: 2s fade-in-out;
    }

    .assistant {

      background-color: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(5px);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .assistant-card {
      padding: 0%;
      border-radius: 10px;
      background-image: url('Frame.png');
    }

    .sub_menu_ {
			background: #e8e6e7 none repeat scroll 0 0;
			left: 100%;
			max-width: 233px;
			position: absolute;
			width: 100%;
		}

		.sub_menu_ {
			background: #f5f3f3 none repeat scroll 0 0;
			border: 1px solid rgba(0, 0, 0, 0.15);
			display: none;
			left: 100%;
			margin-left: 0;
			max-width: 233px;
			position: absolute;
			top: 0;
			width: 100%;
		}

		.all_conversation ul li:hover .sub_menu_ {
			display: block;
		}

		.new_message_head button {
			background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
			border: medium none;
		}

		.new_message_head {
			background-color: rgb(29, 83, 163);
			color: white;
			float: left;
			font-size: 13px;
			font-weight: 600;
			padding: 18px 10px;
			width: 100%;
			position: relative;
			filter: blur(0px);
			-webkit-filter: blur(0px);
			-moz-filter: blur(0px);
			-ms-filter: blur(0px);
			-o-filter: blur(0px);
			z-index: 999;
		}

		.new_message_head::before {
			content: '';
			position: absolute;
			z-index: -1;
			height: 100%;
			width: 100%;
			overflow: hidden;
			top: 0px;
			right: 0px;
			left: 0px;
			bottom: 0px;
			filter: blur(15px);
			-webkit-filter: blur(20px);
			-moz-filter: blur(15px);
			-ms-filter: blur(15px);
			-o-filter: blur(15px);
		}

		.message_section .row {
			height: 100vh;
		}

		.chat_area {
			float: left;
			overflow-x: hidden;
			overflow-y: auto;
			width: 100%;
			margin-bottom: 0px;
			max-height: 82vh;
		}

		.chat_area ul.list-unstyled {
			margin-bottom: 0px;
			padding-bottom: 55px;
		}

		.chat_area li {
			padding: 14px 14px 0;
		}

		.chat_area li .chat-img1 img {
			height: 40px;
			width: 40px;
		}

		.chat_area .chat-body1 {
			margin-left: 50px;
		}

		.chat-body1 p {
			background: rgba(245, 243, 243, 0.9) none repeat scroll 0 0;
			padding: 10px;
			border-radius: 10px;
			min-width: 50px;
			max-width: 90%;
			padding-bottom: 7px;
			margin-top: 10px;
			display: block;
		}

		.chat_area .user-chat .chat-body1 {
			margin-left: 0;
			margin-right: 50px;
		}

		.user-chat .chat-body1.clearfix p {
			float: right;
			box-sizing: content-box;
			position: relative;
			min-width: 50px;
			max-width: 90%;
		}

		.admin-chat .chat-body1.clearfix div.image_chat {
			background: rgba(245, 243, 243, 0.9) none repeat scroll 0 0;
			padding: 10px;
			border-radius: 10px;
			display: block;
			max-width: 60%;
			margin-top: 10px;
			float: left;
			box-sizing: content-box;
			position: relative;
		}

		.admin-chat .chat-body1.clearfix .image_chat::before {
			display: block;
			content: '';
			width: 10px;
			height: 10px;
			background-color: rgba(245, 243, 243, 0.9);
			border-radius: 50%;
			position: absolute;
			left: -8px;
			top: -7px;
		}

		.user-chat .chat-body1.clearfix div.image_chat {
			background: rgba(245, 243, 243, 0.9) none repeat scroll 0 0;
			padding: 10px;
			border-radius: 10px;
			display: block;
			max-width: 60%;
			margin-top: 10px;
			float: right;
			box-sizing: content-box;
			position: relative;
		}

		.user-chat .chat-body1.clearfix .image_chat::before {
			display: block;
			content: '';
			width: 10px;
			height: 10px;
			background-color: rgba(245, 243, 243, 0.9);
			border-radius: 50%;
			position: absolute;
			right: -8px;
			top: -7px;
		}

		.admin-chat .chat-body1.clearfix p {
			float: left;
			box-sizing: content-box;
			position: relative;
			min-width: 50px;
			max-width: 90%;
		}

		.user-chat .chat-body1.clearfix p::before {
			display: block;
			content: '';
			width: 10px;
			height: 10px;
			background-color: rgba(245, 243, 243, 0.9);
			border-radius: 50%;
			position: absolute;
			right: -8px;
			top: -7px;
		}


		.admin-chat .chat-body1.clearfix p::before {
			display: block;
			content: '';
			width: 10px;
			height: 10px;
			background-color: rgba(245, 243, 243, 0.9);
			border-radius: 50%;
			position: absolute;
			left: -8px;
			top: -7px;
		}

		ul.dropdown-menu {
			min-width: 250px;
			box-shadow: 0px 4px 8px 2px rgba(25, 25, 25, 0.4);
			border-radius: 0px;
			border: none;
		}

		.chat_area li:last-child {
			padding-bottom: 10px;
		}

		.message_write {
			background: #f5f3f3 none repeat scroll 0 0;
			float: left;
			padding: 15px 15px 15px 15px;
			width: 100%;
			position: absolute;
			bottom: 0px;
			margin-top: 0px;

		}

		.message_write textarea.form-control {
			/*padding: 10px;*/
			border-radius: 0px;
			border-color: #dddddd;
			box-shadow: none;
			-webkit-transition: box-shadow .25s ease-in-out;
			-moz-transition: box-shadow .25s ease-in-out;
			transition: box-shadow .25s ease-in-out;
			resize: none;
			overflow-y: auto;
			overflow-x: hidden;
			box-sizing: border-box;
			line-height: 20px;
			height: 50px;
			min-height: 50px;
			max-height: 100px;
			word-wrap: break-word;
			white-space: pre-wrap;
			text-rendering: optimizeLegibility;
		}

		.message_write textarea.form-control:focus {
			box-shadow: 0px 5px 8px 2px rgba(25, 25, 25, 0.4);
		}

		a.pull-right.btn.btn-success {
			background-color: #777777;
			border-radius: 0px;
			border: none;
		}

		a.pull-right.btn.btn-success:hover {
			background-color: #dddddd;
			color: #777777;
		}

		i.fa.fa-paperclip.fa-2x {
			transform: rotateY(180deg);
		}

		.chat_bottom {
			float: left;
			margin-top: 13px;
			width: 100%;
		}

		.upload_btn {
			color: #777777;
			padding: 0px 10px;
		}

		.sub_menu_>li a,
		.sub_menu_>li {
			float: left;
			width: 100%;
		}

		.member_list li:hover {
			background: #428bca none repeat scroll 0 0;
			color: #fff;
			cursor: pointer;
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
        <h3 style="font-weight: bold">Riida LMS</h3> </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <h3 style="font-weight: bold">Riida LMS</h3> </a>
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
                <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg" alt="profile image">
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
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <div
            style="position: absolute; top:0; left: 0; font-size: 14px; color: black; background-color: white; border-bottom-right-radius: 50px; padding: 0px 30px 2px 2px;">
            <a href="http://"><i class="fa fa-long-arrow-left"></i> Back to subjects</a>
          </div>

          <?php
          $query = "SELECT * FROM classes";
          $stmt = $pdo->prepare($query);
          $stmt->execute();
          $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>

          <form id="subject_form" action="" method="post">
            <div class="row" style=" margin-top: 10px;">
              <div class="col-md-8 grid-margin ">
                <div class="card">
                  <div class="card-body col-md-12 align-self-center">
                    <div class=" align-content-start">
                      <!-- Align content to left -->
                      <p>Add Material
                      </p>
                      <div>
                        <div class="form-group">
                          <label for="exampleTextarea1">Add all topics materials below, you can copy paste and edit AI
                            generated content below</label>
                          <textarea class="form-control" id="exampleTextarea1" name="material" rows="25"></textarea>
                        </div>

                        <button type="submit" class="btn btn-inverse-success btn-fw" style="width: 100%">Save
                          Edit</button>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="assistant-card col-md-4 grid-margin stretch-card">
                <div class="card assistant ">
                  <div class="card-body d-flex flex-column">
                    <div class="wrapper">
                      <p style="color: white;">Lesson Plan Assistant </p>
                      <hr color="white">

                      <div class="chat_area">
                        <ul class="list-unstyled">
                          
                          <div class="chat-body1 clearfix">
                            <p style="font-size: Small">
                              <span id="user-text" style="display:block; padding:0px;">
                               welcomehug gg uyg ibng8h89 8g 7hu b7ff65g xguvur cybgjcrtc vctycyvgtrcy v
                              </span>
                              <span
                                style="font-size:0.85em; color:grey; display:block; float:right;">99</span>
                            </p>
                          </div>

                        </ul>

                        <div class="chat-box">

                          <div class="col-md-11" style="position: absolute; bottom: 1px">
                            <div class="row">
                              <div class="form-group col-md-10">
                            
                                <input id="message-input" type="text" class="form-control form-control-lg"
                                  placeholder="Message" aria-label="Text">
                              </div>
                              <div class="col-md-2">
                                <button id="send-icon" type="button" style="width: 36px; height: 36px; padding: 0px;"
                                  class=" align-items-center btn btn-icons btn-inverse-success">
                                  <i class="fa fa-send-o"></i>
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


          </form>
        </div>


        <script>
          document.addEventListener("DOMContentLoaded", function () {
            const chatMessages = document.querySelector(".list-unstyled");
            const messageInput = document.getElementById("message-input");
            const sendButton = document.getElementById("send-icon");

            sendButton.addEventListener("click", function () {
              const messageText = messageInput.value;

              if (messageText) {
                const userMessageElement = document.createElement("li");
                userMessageElement.className = "left clearfix user-chat";

                const currentTime = getCurrentTime();

                userMessageElement.innerHTML = `
                <span class="chat-img1 pull-right">
                  <img src="person.jpg" alt="User Avatar" class="img-circle">
                </span>
                <div class="chat-body1 clearfix">
                  <p>
                    <span id="user-text" style="display:block; padding:5px 0px 5px 0px;">
                      ${messageText}
                    </span>
                    <span style="font-size:0.85em; color:grey; display:block; float:right;">${currentTime}</span>
                  </p>
                </div>
              `;

                chatMessages.appendChild(userMessageElement);

                messageInput.value = "";

                chatMessages.scrollTop = chatMessages.scrollHeight;

                // Assuming sendMessageToServer is defined
                sendMessageToServer(messageText);
              }
            });


            function sendMessageToServer(messageText) {
              const loadingIndicator = document.querySelector(".loading-indicator");
              const chatMessages = document.querySelector(".list-unstyled");

              // Show the loading indicator
              loadingIndicator.style.display = "flex";

              fetch('message.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ message: messageText }),
              })
                .then(response => response.text())
                .then(assistantResponse => {
                  console.log(assistantResponse);
                  // Hide the loading indicator when the response is received
                  loadingIndicator.style.display = "none";

                  const assistantMessageElement = document.createElement('li');
                  assistantMessageElement.className = 'left clearfix admin-chat';

                  assistantMessageElement.innerHTML = `
                <span class="chat-img1 pull-left">
                  <img src="rinda.jpg" alt="Rinda Avatar" class="img-circle">
                </span>
                <div class="chat-body1 clearfix">
                  <p>
                    <span style="display:block; padding:5px 0px 5px 0px;">
                      ${assistantResponse}
                    </span>
                    <span style="font-size:0.85em; color:grey; display:block; float:right;">09:40PM</span>
                  </p>
                </div>
              `;

                  chatMessages.appendChild(assistantMessageElement);

                  chatMessages.scrollTop = chatMessages.scrollHeight;
                })
                .catch(error => {
                  console.error('An error occurred:', error);
                  // Make sure to hide the loading indicator if an error occurs
                  loadingIndicator.style.display = "none";
                });
            }



          });

        </script>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.autosize/3.0.20/autosize.min.js"></script>

        <!-- content-wrapper ends -->


        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Riida LMS
              2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free Riida LMS Demo from <a
                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Riida School Management Software</a></span>
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