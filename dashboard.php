<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Pharmacy - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <i class="fa-solid fa-prescription-bottle-medical"></i>
                <h1> Master Pharmacy </h1>
            </div>

            <ul class="sidebar-menu">
                <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="medicine.php"><i class="fas fa-pills"></i> Medicine</a></li>
                <li><a href="suppliers.php"><i class="fas fa-truck"></i> Suppliers</a></li>
                <li><a href="purchase.php"><i class="fas fa-boxes"></i> Purchase</a></li>
                <li><a href="employees.php"><i class="fas fa-user-md"></i> Employees</a></li>
                <li><a href="customers.php"><i class="fas fa-user"></i> Customers</a></li>
                <li><a href="sales.php"><i class="fas fa-cash-register"></i> Sales</a></li>
                <li><a href="payment_history.php"><i class="fas fa-credit-card"></i> Payment History</a></li>
                <li><a href="sales_report.php"><i class="fas fa-chart-line"></i> Sales Report</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="welcome">
                    <h2>Dashboard</h2>
                    <p>Welcome Sir, Here's what's happening today.</p>
                </div>

                <div class="user-info">

                    <a href="logout.php" class="btn btn-danger logout-btn"><i class="fas fa-sign-out-alt"></i>Logout</a>

                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="dashboard-cards">

            <div class="card">
                    <div class="card-header">
                        <div class="card-title"><a href="medicine.php" style="text-decoration: none">Total Medicine</a></div>
                        <div class="card-icon" style="background: rgba(56, 176, 0, 0.1);">
                            <a href="medicine.php"><i class="fas fa-pills" style="color: #38b000;"></i></a>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-value">140</div>
                        <div class="card-footer">+5 from last week</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><a href="customers.php" style="text-decoration: none">Total Customers</a></div>
                        <div class="card-icon" style="background: rgba(44, 125, 160, 0.1);">
                            <a href="customers.php"><i class="fas fa-users" style="color: #2c7da0;"></i></a>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-value">45</div>
                        <div class="card-footer">+2 from last week</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><a href="suppliers.php" style="text-decoration: none">Total Supplier</a></div>
                        <div class="card-icon" style="background: rgba(255, 193, 7, 0.1);">
                            <a href="suppliers.php"><i class="fas fa-truck" style="color: #ffc107;"></i></a>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-value">15</div>
                        <div class="card-footer">+4 from last week</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><a href="sales_report.php" style="text-decoration: none">Total Sales</a></div>
                        <div class="card-icon" style="background: rgba(220, 53, 69, 0.1);">
                            <a href="sales_report.php"><i class="fas fa-file-invoice" style="color: #dc3545;"></i></a>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-value">75</div>
                        <div class="card-footer">+3 from last week</div>
                    </div>
                </div>
            </div>

            <!-- POS Section -->
            <div class="pos-section">
                <h2 class="section-title">Add New Data</h2>

                <div class="pos-actions">
                    <div class="pos-action">
                        <a href="sales.php"><i class="fas fa-plus-circle"></i></a>
                        <h3> <a href="sales.php" style="text-decoration: none; color: black">Add New Sale</a></h3>
                        <p>Adding new sale transaction</p>
                    </div>

                    <div class="pos-action">
                        <a href="medicine.php"><i class="fas fa-pills"></i></a>
                        <h3> <a href="medicine.php" style="text-decoration: none; color: black">Add Medicine</a></h3>
                        <p>Add new medicine to inventory</p>
                    </div>

                    <div class="pos-action">
                        <a href="employees.php"><i class="fas fa-user-plus"></i></a>
                        <h3> <a href="employees.php" style="text-decoration: none; color: black">Add Employee</a></h3>
                        <p>Register a new employee</p>
                    </div>
                </div>
            </div>

            <!-- Reports Section -->
            <div class="reports-section">
                <h2 class="section-title">Reports</h2>

                <div class="report-items">
                    <div class="report-item">
                        <a href="sales_report.php"><i class="fas fa-chart-line"></i></a>
                        <div>
                            <h3> <a href="sales_report.php" style="text-decoration: none; color: black">Sales Report</a></h3>
                            <p>View sales analytics</p>
                        </div>
                    </div>

                    <div class="report-item">
                        <a href="purchase.php"><i class="fas fa-shopping-cart"></i></a>
                        <div>
                            <h3> <a href="purchase.php" style="text-decoration: none; color: black">Purchase Report</a></h3>
                            <p>View purchases </p>
                        </div>
                    </div>

                    <div class="report-item">
                        <a href="medicine.php"><i class="fas fa-boxes"></i></a>
                        <div>
                            <h3> <a href="medicine.php" style="text-decoration: none; color: black">Medicine Report</a> </h3>
                            <p>Inventory status</p>
                        </div>
                    </div>

                    <div class="report-item">
                        <a href="suppliers.php"><i class="fas fa-truck"></i></a>
                        <div>
                            <h3> <a href="suppliers.php" style="text-decoration: none; color: black"> Supplier Report</a> </h3>
                            <p>Suppliers Overview</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
</body>

</html>