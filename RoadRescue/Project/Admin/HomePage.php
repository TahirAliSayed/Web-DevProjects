<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php"); // Include the database connection

// Fetch all workshops for the dropdown
$workshopQuery = "SELECT workshop_id, workshop_name FROM tbl_workshop";
$workshopResult = $conn->query($workshopQuery);

$workshops = [];
while ($row = $workshopResult->fetch_assoc()) {
    $workshops[] = $row;
}

$insightsQuery = 
        "SELECT
        SUM(CASE WHEN r.request_status = 1 THEN 1 ELSE 0 END) AS accepted,
        SUM(CASE WHEN r.request_status = 2 THEN 1 ELSE 0 END) AS rejected,
        SUM(CASE WHEN r.request_status = 6 THEN 1 ELSE 0 END) AS in_progress,
        SUM(CASE WHEN r.request_status = 7 THEN 1 ELSE 0 END) AS completed
        FROM tbl_request r
        INNER JOIN tbl_workshop w ON r.workshop_id = w.workshop_id
";

$insightsResult = $conn->query($insightsQuery);
$row = $insightsResult->fetch_assoc();

$accepted = $row['accepted'];
$rejected = $row['rejected'];
$in_progress = $row['in_progress'];
$completed = $row['completed'];
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../Assets/Templates/Admin/assets/images/favicon.png">
    <title>Admin Page</title>
    <!-- Custom CSS -->
    <link href="../Assets/Templates/Admin/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../Assets/Templates/Admin/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../Assets/Templates/Admin/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../Assets/Templates/Admin/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
        /* From Uiverse.io by 3bdel3ziz-T */
        .select {
            width: fit-content;
            cursor: pointer;
            position: relative;
            transition: 300ms;
            color: white;
            overflow: hidden;
            margin-right: 15px;
        }

        .selected {
            background-color: #5872b1;
            padding: 5px;
            margin-bottom: 3px;
            border-radius: 5px;
            position: relative;
            z-index: 100000;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .arrow {
            position: relative;
            right: 0px;
            height: 10px;
            transform: rotate(-90deg);
            width: 25px;
            fill: white;
            z-index: 100000;
            transition: 300ms;
        }

        .options {
            display: flex;
            flex-direction: column;
            border-radius: 5px;
            padding: 5px;
            background-color: #2a2f3b;
            position: relative;
            top: -100px;
            opacity: 0;
            transition: 300ms;
        }

        .select:hover > .options {
            opacity: 1;
            top: 0;
        }

        .select:hover > .selected .arrow {
            transform: rotate(0deg);
        }

        .option {
            border-radius: 5px;
            padding: 5px;
            transition: 300ms;
            background-color: #2a2f3b;
            width: 150px;
            font-size: 15px;
        }

        .option:hover {
            background-color: #323741;
        }

        .options input[type="radio"] {
            display: none;
        }

        .options label {
            display: inline-block;
        }

        .options label::before {
            content: attr(data-txt);
        }

        .options input[type="radio"]:checked + label {
            display: none;
        }

        .options input[type="radio"]#all:checked + label {
            display: none;
        }

        .select:has(.options input[type="radio"]#all:checked) .selected::before {
            content: attr(data-default);
        }

        .select:has(.options input[type="radio"]#option-1:checked) .selected::before {
            content: attr(data-one);
        }

        .select:has(.options input[type="radio"]#option-2:checked) .selected::before {
            content: attr(data-two);
        }

        .select:has(.options input[type="radio"]#option-3:checked) .selected::before {
            content: attr(data-three);
        }

        /* Chart container styles */
        .chart-container {
            height: 400px;
            width: 100%;
            margin-top: 20px;
        }
        
        /* Flex container for dropdowns */
        .dropdown-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $_SESSION["aname"]; ?></h3>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span
                                        class="text-dark"><?php echo $_SESSION["aname"]; ?></span></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li align="center" style="font-size: 30px;"> Admin </li><br><br>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="HomePage.php"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Components</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="#"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">Location </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="DistrictDetails.php" class="sidebar-link"><span
                                            class="hide-menu"> District </span></a></li>
                                <li class="sidebar-item"><a href="PlaceDetails.php" class="sidebar-link"><span
                                            class="hide-menu"> Place </span></a></li>
                                <li class="sidebar-item"><a href="Location.php" class="sidebar-link"><span
                                            class="hide-menu"> Location </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="#"
                                aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                    class="hide-menu">Types </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="Type.php" class="sidebar-link"><span
                                            class="hide-menu"> Type </span></a></li>
                                <li class="sidebar-item"><a href="WorkshopType.php" class="sidebar-link"><span
                                            class="hide-menu"> WorkshopType </span></a></li>
                                <li class="sidebar-item"><a href="ComplaintType.php" class="sidebar-link"><span
                                            class="hide-menu"> ComplaintType </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="box" class="feather-icon"></i><span
                                    class="hide-menu">Workshop Verification </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="WorkshopVerification.php" class="sidebar-link"><span
                                            class="hide-menu"> Workshop list </span></a></li>
                                <li class="sidebar-item"><a href="WorkshopAcceptedList.php" class="sidebar-link"><span
                                            class="hide-menu"> Accepted </span></a></li>
                                <li class="sidebar-item"><a href="WorkshopRejectedList.php" class="sidebar-link"><span
                                            class="hide-menu"> Rejected </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ViewComplaint.php"
                                aria-expanded="false"><i data-feather="box" class="feather-icon"></i><span
                                    class="hide-menu">Complaint</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ViewFeedback.php"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">View Feedback</span></a></li>
                        <li class="list-divider"></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="Logout.php"
                                aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                    class="hide-menu">Logout</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Insights Chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Workshop Request Insights</h4>
                                
                                <!-- Dropdown Container -->
                                <div class="dropdown-container">
                                    <!-- Workshop Dropdown -->
                                    <div class="select">
                                        <div class="selected" data-default="All Workshops">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                                            </svg>
                                        </div>
                                        <div class="options">
                                            <div title="all">
                                                <input id="all" name="option" type="radio" checked />
                                                <label class="option" for="all" data-txt="All Workshops"></label>
                                            </div>
                                            <?php foreach ($workshops as $index => $workshop): ?>
                                                <div title="option-<?php echo $index + 1; ?>">
                                                    <input id="option-<?php echo $index + 1; ?>" name="option" type="radio" value="<?php echo $workshop['workshop_id']; ?>" />
                                                    <label class="option" for="option-<?php echo $index + 1; ?>" data-txt="<?php echo $workshop['workshop_name']; ?>"></label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Chart Type Dropdown -->
                                    <div class="select">
                                        <div class="selected" data-default="Pie Chart" data-one="Bar Chart" data-two="Line Chart">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                                            </svg>
                                        </div>
                                        <div class="options">
                                            <div title="chart-type-1">
                                                <input id="chart-type-1" name="chart-type" type="radio" value="pie" checked />
                                                <label class="option" for="chart-type-1" data-txt="Pie Chart"></label>
                                            </div>
                                            <div title="chart-type-2">
                                                <input id="chart-type-2" name="chart-type" type="radio" value="bar" />
                                                <label class="option" for="chart-type-2" data-txt="Bar Chart"></label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Selected Workshop Name -->
                                <h5 id="selected-workshop-name" class="text-center font-weight-bold" style="display: none;"></h5>
                                
                                <!-- Chart Container -->
                                <div id="chart-container" class="chart-container"></div>
                                
                                <div id="chart-details" class="mt-4 text-center"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Insights Chart -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
                Designed and Developed by RoadRescue.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../Assets/Templates/Admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="../Assets/Templates/Admin/dist/js/app-style-switcher.js"></script>
    <script src="../Assets/Templates/Admin/dist/js/feather.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../Assets/Templates/Admin/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../Assets/Templates/Admin/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../Assets/Templates/Admin/assets/extra-libs/c3/d3.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/extra-libs/c3/c3.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let chart; // Store the chart instance
            let currentWorkshopId = 'all'; // Store current workshop ID
            let currentWorkshopName = 'All Workshops'; // Store current workshop name
            let currentChartType = 'pie'; // Store current chart type

            // Function to initialize a chart
            function initChart(type, columns, colors) {
                // Destroy previous chart if exists
                if (chart) {
                    chart.destroy();
                }
                
                const chartContainer = document.getElementById('chart-container');
                chartContainer.innerHTML = ''; // Clear previous chart
                
                // Create new chart based on type
                if (type === 'pie') {
                    chart = c3.generate({
                        bindto: '#chart-container',
                        data: {
                            columns: columns,
                            type: type,
                            colors: colors,
                            onclick: function(d, element) {
                                // Display the number of requests when a section is clicked
                                const details = document.getElementById('chart-details');
                                details.innerHTML = `<strong>${d.id}:</strong> ${d.value} requests`;
                            }
                        },
                        pie: {
                            label: {
                                format: function(value, ratio, id) {
                                    return `${id}: ${value}`;
                                }
                            }
                        }
                    });
                } else if (type === 'bar' || type === 'line') {
                    chart = c3.generate({
                        bindto: '#chart-container',
                        data: {
                            columns: columns,
                            type: type,
                            colors: colors,
                            onclick: function(d, element) {
                                // Display the number of requests when a section is clicked
                                const details = document.getElementById('chart-details');
                                details.innerHTML = `<strong>${d.id}:</strong> ${d.value} requests`;
                            }
                        },
                        axis: {
                            x: {
                                type: 'category',
                                categories: ['Status']
                            }
                        },
                        bar: {
                            width: {
                                ratio: 0.5 // Adjust bar width
                            }
                        }
                    });
                }
            }

            // Function to load chart data
            function loadChartData(workshopId, workshopName, chartType) {
                fetch(`getInsightsData.php?workshop_id=${workshopId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Prepare data columns
                        const columns = [
                            ['Accepted', data.accepted],
                            ['Rejected', data.rejected],
                            ['In Progress', data.in_progress],
                            ['Completed', data.completed]
                        ];
                        
                        // Define colors
                        const colors = {
                            Accepted: '#36a2eb', // Blue
                            Rejected: '#ff6384', // Red
                            'In Progress': '#ffce56', // Yellow for In Progress
                            Completed: '#4bc0c0' // Teal
                        };
                        
                        // Initialize the chart with new data
                        initChart(chartType, columns, colors);

                        // Update the workshop name above the chart
                        const workshopNameElement = document.getElementById('selected-workshop-name');
                        if (workshopId === 'all') {
                            workshopNameElement.style.display = 'none'; // Hide if "All Workshops" is selected
                        } else {
                            workshopNameElement.style.display = 'block'; // Show the workshop name
                            workshopNameElement.textContent = `Workshop: ${workshopName}`;
                        }
                    });
            }

            // Initialize the default pie chart on page load
            const initialColumns = [
                ['Accepted', <?php echo $accepted; ?>],
                ['Rejected', <?php echo $rejected; ?>],
                ['In Progress', <?php echo $in_progress; ?>],
                ['Completed', <?php echo $completed; ?>]
            ];
            
            const initialColors = {
                Accepted: '#36a2eb',
                Rejected: '#ff6384',
                'In Progress': '#ffce56',
                Completed: '#4bc0c0'
            };
            
            initChart('pie', initialColumns, initialColors);

            // Handle workshop dropdown change
            document.querySelectorAll('.options input[name="option"]').forEach(input => {
                input.addEventListener('change', function() {
                    currentWorkshopId = this.value || 'all';
                    currentWorkshopName = this.nextElementSibling.getAttribute('data-txt');
                    loadChartData(currentWorkshopId, currentWorkshopName, currentChartType);
                });
            });

            // Handle chart type dropdown change
            document.querySelectorAll('.options input[name="chart-type"]').forEach(input => {
                input.addEventListener('change', function() {
                    currentChartType = this.value;
                    loadChartData(currentWorkshopId, currentWorkshopName, currentChartType);
                });
            });
        });
    </script>
</body>

</html>