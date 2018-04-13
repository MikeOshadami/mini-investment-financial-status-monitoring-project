<?php
session_start();
if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");

}
if($_SESSION['user_role']=='INITIATOR'){
    header("Location: add-status.php");
}
include_once 'dbconfig.php';
include_once 'scripts/functions.php';
include_once 'scripts/app.php';
$userId = $_SESSION['user_session'];
$userDetails = getUserDetails($db_con, $userId);
$companyId = $userDetails['company_id'];
$pendingStatement = getAllPendingFinancialStatement($db_con, $companyId, $userId);
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
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min">
  </head>
  <body class="app sidebar-mini rtl">
  <?php include  'partials/top-header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <?php include  'partials/sidebar.php'; ?>
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Inbox</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
          <tr>
            <th>Initiator</th>
            <th>Financial Month</th>
            <th>Action</th>
            <th>Transaction Date</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($pendingStatement as $statement) { ?>
          <tr>
            <td><?php echo $statement['lname']; ?> <?php echo $statement['fname']; ?></td>
            <td><?php echo $statement['month_name']; ?></td>
            <td><a href="approve-report.php?reportId=<?php echo $statement['id']; ?>">Click to View & Approve</a></td>
            <td><?php echo  date("m/d/y g:i A",strtotime(str_replace('/','-',$statement['transactiondate']))); ?></td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>