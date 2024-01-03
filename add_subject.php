<?php
require("settings.php");

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
  <style>
    .card {
      border-radius: 10px;
    }
    
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->

    <!-- partial -->
    <di class="container-fluid page-body-wrapper col-lg-12">
      <!-- partial:partials/_sidebar.html -->
      <!-- partial -->

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
                <div class="card-body col-md-10 align-self-center">
                  <div class=" align-content-start">
                    <!-- Align content to left -->
                    <p style="font-size: large; font-weight: normal;" class="card-title mb-0">Add New Subject
                    </p>

                    <p>Provide information below to setup a new subject</p>
                    <div style="height: 15px"></div>
                    <div>
                      <div class="form-group">
                        <label for="new_subject">Subject Name</label>
                        <input required type="text" class="form-control" name="new_subject"
                          placeholder="Enter Subject Name" />
                      </div>
                      <div class="form-group">
                        <label for="new_subject">Class</label>
                        <select required class="form-control" name="new_class">
                          <option selected disabled> Select </option>
                          <?php
                          foreach ($classes as $class): ?>
                            <option value="<?= $class['class']; ?>"> <?= $class['class']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Add Material</label>
                        <textarea class="form-control" id="exampleTextarea1" name="material" rows="12"></textarea>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <p>Enable modules</p>
                            <div class="col-md-12">
                              <div class="row">

                                <div class="col-md-4">
                                  <input type="checkbox" name="" id="" style="width: 18px; height: 18px">
                                  <small>CBT Assessment</small>
                                </div>
                                <div class="col-md-4">
                                  <input type="checkbox" name="" id="" style="width: 18px; height: 18px">
                                  <small>Virtual Classes </small>
                                </div>
                                <div class="col-md-4">
                                  <input type="checkbox" name="" id="" style="width: 18px; height: 18px">
                                  <small>AI Learning </small>
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
            </div>
            <div class="col-md-4 grid-margin">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <div class="wrapper">
                    <p>Custom Settings</p>
                    <div>
                      <div class="form-group">
                        <label for="new_subject">Academic Session</label>
                        <select disabled class="form-control" name="session">
                          <option selected disabled> 2023/2024 academic session (current)</option>
                          <?php
                          foreach ($classes as $class): ?>
                            <option value="<?= $class['class']; ?>"> <?= $class['class']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="new_subject">Schedule</label>
                            <select class="form-control" name="objective">
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
                            <label for="new_subject"></label>
                            <input class="form-control" type="time" name="" id="">
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="new_subject"></label>
                            <div>
                              <button type="button" style="width: 33px; height: 33px; padding: 0px;" class=" align-items-center btn btn-icons btn-inverse-success">
                                <i class="mdi mdi-plus"></i>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="new_subject">Expected No. of topics</label>
                        <select class="form-control" name="objective">
                          <option disabled selected>select</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                          <option>7</option>
                          <option>8</option>
                          <option>9</option>
                          <option>10</option>
                          <option>11</option>
                          <option>12</option>
                          <option>13</option>
                          <option>14</option>
                          <option>15</option>
                          <option>16</option>
                          <option>17</option>
                          <option>18</option>
                          <option>19</option>
                          <option>20</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="new_subject">Weeks to cover topics</label>
                        <input required type="number" class="form-control" name="new_subject"
                          placeholder="Choose a number" />
                      </div>

                      <div class="form-group">
                        <label for="new_subject">Assign Teacher</label>
                        <select class="form-control" name="objective">
                          <option disabled selected>select</option>
                          <option>Edward Carl</option>
                          <option>Will Clinton</option>
                          <option>Demon Parker</option>
                          <option>Edward Carl</option>
                          <option>Will Clinton</option>
                          <option>Demon Parker</option>
                        </select>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <p>AI Learning</p>
                            <div class="row">
                              <div class="col-md-2">
                                <input type="checkbox" name="" id="" style="width: 18px; height: 18px">
                              </div>
                              <div class="col-md-10">
                                <p>By ticking this you agree to use AI to analys, generate, process, save and
                                  output student's data related to this subject as stated in our <a href="http://"
                                    target="_blank" rel="noopener noreferrer">Privacy Policy</a>.
                                </p>
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
          </div>

          <button type="submit" class="btn btn-inverse-success btn-fw" style="width: 100%">Proceed</button>
        </form>
      </div>


      <script src="jquery-3.6.4.min.js"></script>
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
      <!-- content-wrapper ends -->



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