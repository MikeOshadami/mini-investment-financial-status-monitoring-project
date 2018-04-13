<?php
session_start();
if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}
include_once 'dbconfig.php';
include_once 'scripts/functions.php';
include_once 'scripts/app.php';
$userId = $_SESSION['user_session'];
$userDetails = getUserDetails($db_con, $userId);
$reportId = $_GET['reportId'];
if( isset( $_GET['reportId'] )) {
    $companyId = $userDetails['company_id'];
    $pendingStatement = getPendingFinancialStatement($db_con, $companyId, $userId, $reportId);
}
$error = true;
if(isset($_POST['submit'])){
    $error = false;
    $grossIncome = $_POST['grossIncome'];
    $operatingCost = $_POST['operatingCost'];
    $adminExpenses = $_POST['adminExpenses'];
    $marketingExpenses = $_POST['marketingExpenses'];
    $depreciation = $_POST['depreciation'];
    $otherCharges = $_POST['otherCharges'];
    $incomeTax = $_POST['incomeTax'];
    approveFinancialStatement($db_con, $grossIncome, $operatingCost, $adminExpenses, $marketingExpenses, $depreciation, $otherCharges, $incomeTax, $reportId);
    $success="yes";
    $successMessage = "Financial Approved Successfully";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Investment Monitoring Software Project</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
  <body class="app sidebar-mini rtl">
  <?php include  'partials/top-header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <?php include  'partials/sidebar.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Approve Financial Status</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <?php if (isset($success) && $error == false): ?>
              <div class="alert alert-success"><?php echo $successMessage ?></div>
            <?php elseif (isset($message) && $error == true): ?>
              <div class="alert alert-danger">Sorry there was an error. <?php echo $message ?></div>
            <?php else: ?>

            <?php endif; ?>
          <form id="myform" action="" method="POST">
          <div class="tile">
            <input type="hidden" name="reportId" value="<?php echo $pendingStatement['id']; ?>" />
            <div class="tile-body">

                <div class="form-group">
                  <label class="control-label">Gross Income</label>
                  <input class="digitonly form-control" type="text" name="grossIncome" value="<?php echo $pendingStatement['grossIncome']; ?>" required />
                </div>
                <div class="form-group">
                  <label class="control-label">Direct Operating Cost</label>
                  <input class="digitonly form-control" type="text" name="operatingCost" value="<?php echo $pendingStatement['operatingCost']; ?>" required />
                </div>
                <div class="form-group">
                  <label class="control-label">Administrative Expenses</label>
                  <input class="digitonly form-control" type="text" name="adminExpenses" value="<?php echo $pendingStatement['adminExpenses']; ?>" required />
                </div>
                <div class="form-group">
                  <label class="control-label">Marketing Expenses</label>
                  <input class="digitonly form-control" type="text" name="marketingExpenses" value="<?php echo $pendingStatement['marketingExpenses']; ?>" required />
                </div>
                <div class="form-group">
                  <label class="control-label">Depreciation</label>
                  <input class="digitonly form-control" type="text" name="depreciation" value="<?php echo $pendingStatement['depreciation']; ?>" required />
                </div>
                <div class="form-group">
                  <label class="control-label">Other Charges</label>
                  <input class="digitonly form-control" type="text" name="otherCharges" value="<?php echo $pendingStatement['otherCharges']; ?>" required />
                </div>
                <div class="form-group">
                  <label class="control-label">Income Tax Expenses</label>
                  <input class="digitonly form-control" type="text" name="incomeTax" value="<?php echo $pendingStatement['incomeTax']; ?>" required />
                </div>

            </div>
              <?php if ($error == true): ?>
            <div class="tile-footer">
              <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Approve</button>

            </div>
              <?php endif; ?>
          </div>
          </form>
        </div>

        <div class="clearix"></div>

      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  <script src="js/script-validation.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {

      });
    </script>
  </body>
</html>