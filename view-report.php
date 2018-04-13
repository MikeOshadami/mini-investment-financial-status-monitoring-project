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
$companyId = $userDetails['company_id'];
$fStatements = getFinancialStatementByCompanyId($db_con, $companyId);
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
          <h1><i class="fa fa-eye"></i> View Financial Report</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
            <tr class="table-warning">
              <center><?php echo $userDetails['company_name']; ?> - <span class="zone"><?php echo $userDetails['zone']; ?><span</center>
              <center>INCOME STATEMENT FOR THE PERIOD ENDED</center>
            </tr>
            </thead>

            <tr class="table-warning">
              <th></th>
                <?php foreach ($fStatements as $statement) { ?>
              <th><?php echo $statement['month_name']; ?></th>
                <?php } ?>
            </tr>

            <tbody>
            <tr class="table-danger">
              <td><b>Turnover (N)</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><?php echo number_format($statement['grossIncome'], 2); ?></td>
                <?php } ?>
            </tr>
            <tr class="table-danger">
              <td><b>Gross Income</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><b><?php echo number_format($statement['grossIncome'],2); ?></b></td>
                <?php } ?>

            </tr>
            <tr class="table-danger">
              <td><b>Direct Operating Cost</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><?php echo number_format($statement['operatingCost'],2); ?></td>
                <?php } ?>
            </tr>
            <tr class="table-danger">
              <td><b>Gross Profit /(Loss)</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><b><?php echo number_format($statement['grossProfitLoss'],2); ?></b></td>
                <?php } ?>
            </tr>
            <tr class="table-danger">
              <td><b>Administrative Expenses</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><?php echo number_format($statement['adminExpenses'],2); ?></td>
                <?php } ?>
            </tr>
            <tr class="table-danger">
              <td><b>Marketing Expenses</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><?php echo number_format($statement['marketingExpenses'],2); ?></td>
                <?php } ?>
            </tr>
            <tr class="table-danger">
              <td><b>EBITDA</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><b><?php echo number_format($statement['eBITDA'],2); ?></b></td>
                <?php } ?>
            </tr>
            <tr class="table-danger">
              <td><b>Ordinary Depreciation</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><?php echo number_format($statement['depreciation'],2); ?></td>
                <?php } ?>
            </tr>
            <tr class="table-danger">
              <td><b>Finance Charges</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><?php echo number_format($statement['operatingCost'],2); ?></td>
                <?php } ?>
            </tr>
            <tr class="table-danger">
              <td><b>EBT</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><b><?php echo number_format($statement['operatingCost'],2); ?></b></td>
                <?php } ?>
            </tr>
            <tr class="table-danger">
              <td><b>Income Tax Expenses</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><?php echo number_format($statement['incomeTax'],2); ?></td>
                <?php } ?>
            </tr>
            <tr class="table-danger">
              <td><b>Profit (Loss) After Tax</b></td>
                <?php foreach ($fStatements as $statement) { ?>
                  <td><b><?php echo number_format($statement['operatingCost'],2); ?></b></td>
                <?php } ?>
            </tr>
            </tbody>
          </table>
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