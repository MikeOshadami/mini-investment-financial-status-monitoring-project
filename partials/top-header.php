    <header class="app-header">
      <a class="app-header__logo" href="home.php"><?php echo $userDetails['company_name']; ?> - <span class="zone"><?php echo $userDetails['zone']; ?><span</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><?php echo $userDetails['fname']; ?> <?php echo $userDetails['lname']; ?>&nbsp;&nbsp;<i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>