<aside class="app-sidebar">
    <ul class="app-menu">
      <?php if($_SESSION['user_role']=='APPROVER') {?>
      <li><a class="app-menu__item active" href="home.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Inbox</span></a></li>
      <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Financial Monitoring</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="view-report.php"><i class="icon fa fa-circle-o"></i> View Financial Report</a></li>
        </ul>
      </li>
        <?php } ?>
        <?php if($_SESSION['user_role']=='INITIATOR') {?>
        <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Financial Monitoring</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item " href="add-status.php"><i class="icon fa fa-circle-o"></i> Add New Status</a></li>
              <li><a class="treeview-item" href="view-report.php"><i class="icon fa fa-circle-o"></i> View Financial Report</a></li>

            </ul>
              <?php } ?>

        </li>
        <li><a class="app-menu__item" href="logout.php"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Logout</span></a></li>

</aside>