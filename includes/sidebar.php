<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="img/LOGO.PNG">
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap"
      rel="stylesheet"
    />
	<title>Results Management System</title>
    
    <link rel="stylesheet" href="css-font/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <script defer src="js/dashboard.js"></script>
</head>
<body>

<nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="img/LOGO.PNG" alt="">
            </div>
            <span class="logo_name">ES-Muhororo</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="dashboard.php">
                    <i class="fa fa-dashboard" title="Dashboard"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a class="sub-btn">
                    <i class="fa fa-bank"></i>
                    <span class="link-name">Classes<i class="fa fa-angle-right arrow dropdown"></i></span>
                </a>
                    <span class="sub-menu">
                        <a href="create-class.php" class="sub-item"><i class="fa fa-plus"></i>Create Class</a>
                        <a href="manage-classes.php" class="sub-item"><i class="fa fa-bars"></i>Manage Classes</a>
                </span>
            </li>
                <li><a class="sub-btn">
                    <i class="fa fa-book"></i>
                    <span class="link-name">Subjects<i class="fa fa-angle-right arrow dropdown"></i></span>
                </a>
                    <span class="sub-menu">
                        <a href="create-subject.php" class="sub-item"><i class="fa fa-plus"></i>Create Subject</a>
                        <a href="manage-subjects.php" class="sub-item"><i class="fa fa-bars"></i>Manage Subject</a>
                        <a href="add-subjectcombination.php" class="sub-item"><i class="fa fa-plus"></i>Add Subject Combination</a>
                        <a href="manage-subjectcombination.php" class="sub-item"><i class="fa fa-bars"></i>Manage Subject Combination</a>
                    </span>
                </li>
                <li><a class="sub-btn">
                    <i class="fa fa-users"></i>
                    <span class="link-name">Students<i class="fa fa-angle-right arrow dropdown"></i></span>
                </a>
                    <span class="sub-menu">
                        <a href="add-students.php" class="sub-item"><i class="fa fa-plus"></i>Add Students</a>
                        <a href="manage-students.php" class="sub-item"><i class="fa fa-bars"></i>Manage Students</a>
                    </span>
                </li>
                <li><a class="sub-btn">
                    <i class="fa fa-file-text"></i>
                    <span class="link-name">Result<i class="fa fa-angle-right arrow dropdown"></i></span>
                </a>
                    <span class="sub-menu">
                        <a href="add-result.php" class="sub-item"><i class="fa fa-plus"></i>Add Result</a>
                        <a href="manage-results.php" class="sub-item"><i class="fa fa-bars"></i>Manage Result</a>
                    </span>
                </li>
                <li><a class="sub-btn">
                    <i class="fa fa-bell"></i>
                    <span class="link-name">Notices<i class="fa fa-angle-right arrow dropdown"></i></span>
                </a>
                    <span class="sub-menu">
                        <a href="add-notice.php" class="sub-item"><i class="fa fa-plus"></i>Add Notice</a>
                        <a href="manage-notices.php" class="sub-item"><i class="fa fa-bars"></i>Manage Notices</a>
                    </span>
                </a></li>
                <li><a href="change-password.php">
                    <i class="fa fa-key"></i>
                    <span class="link-name">Change Password</span>
                </a></li>
            </ul>
            <ul class="logout-mode">
                <li><a href="logout.php">
                    <i class="fa fa-sign-out"></i>
                    <span class="link-name">Logout</span>
                </a></li>
                <li class="mode">
                    <a href="#">
                    <i class="fa-regular fa-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>
                <div class="mode-toggle">
                <span class="switch"></span>
            </div>
            </li>
            </ul>
        </div>
    </nav>