<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Management</title>
    <?= $this->include('backend/common_links/css_links') ?>

        <?php 
$isAdmin    = session()->get('role') === 'employee';
$isEmployee = session()->get('isEmployeeLoggedIn') === true;
?>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><span>Employee Admin</span></a>
                    </div>
                    <div class="clearfix"></div>
                                        
                               <?php if ($isAdmin): ?>
            <?= $this->include('backend/employee_admin/sidebar.php') ?>
            
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/sidebar.php') ?>
        <?php endif; ?>
        
                </div>
            </div>

              <?php if ($isAdmin): ?>
        <?= $this->include('backend/employee_admin/header.php') ?>
            
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/header.php') ?>
        <?php endif; ?>

            <div class="right_col" role="main">
                <div class="">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>All Employees</h3>
                            <div class="btn-group" id="buttonlist">
                                <a class="btn btn-warning topbtn" href="<?= base_url('employee/register') ?>">
                                    <span class="fa fa-plus" aria-hidden="true"></span> Add Employee
                                </a>
                            </div>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row brdr">
                                <div class="col-md-8 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Shows:</label>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <select id="entries" class="form-control">
                                                <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25</option>
                                                <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                                                <option value="75" <?= $limit == 75 ? 'selected' : '' ?>>75</option>
                                                <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Search Form -->
                                <form method="get" id="searchForm">
                                    <input type="text" name="search" placeholder="Search by Name or Employee ID" value="<?= esc($search); ?>" />
                                    <button type="submit">Search</button>
                                </form>
                            </div>

                            <!-- Table Data Section -->

                            <div id="table-data">
                                <?php include("employee_table_rows.php"); ?>
                            </div>
                            

                            <!-- Pagination Info -->
                            <span id="pagination-info">
                                <b>Total Records: <?= $totalRecords ?></b>
                                <p>Showing: <?= ($currentPage - 1) * $limit + 1 ?> - <?= min($currentPage * $limit, $totalRecords) ?> of <?= $totalRecords ?> Total</p>
                            </span>

                            <!-- Pagination Controls -->
                            <div id="pagination">
                                <input type="number" min="1" max="<?= ceil($totalRecords / $limit) ?>" id="in_page" value="<?= $currentPage ?>" class="form-control d-inline-block" style="width: 60px;">
                                <button type="button" id="go" class="btn btn-warning">Go</button>
                                <button type="button" id="prev" class="btn btn-primary <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                    <i class="fa fa-arrow-left"></i> Previous
                                </button>
                                <button type="button" id="next" class="btn btn-primary <?= $currentPage >= ceil($totalRecords / $limit) ? 'disabled' : '' ?>">
                                    Next <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>

                            <div class="loader-chart" style="display: none;">
                                <img src="<?= base_url('assets/images/dark-loader.gif') ?>">
                            </div>
                            <?= $this->include('backend/common_links/js_links') ?>

                            <!-- JavaScript -->
                            <script>
                                $(document).ready(function() {
                                    function loadPage(page) {
                                        var selectedLimit = $('#entries').val();
                                        var searchQuery = $('input[name="search"]').val();
                                        $.ajax({
                                            url: '<?= site_url("backend/employee_admin/all_employee") ?>',
                                            type: 'GET',
                                            data: {
                                                page: page,
                                                limit: selectedLimit,
                                                search: searchQuery
                                            },
                                            success: function(response) {
                                                $('#table-data').html(response.html);

                                                // Update pagination info
                                                $('#pagination-info').html(
                                                    `<b>Total Records: ${response.totalRecords}</b>
                                                    <p>Showing: ${response.startRecord} - ${response.endRecord} of ${response.totalRecords} Total</p>`
                                                );

                                                // Update page number and max
                                                $('#in_page').val(response.currentPage);
                                                $('#in_page').attr('max', response.totalPages);

                                                // Enable/disable buttons
                                                $('#prev').toggleClass('disabled', response.currentPage <= 1);
                                                $('#next').toggleClass('disabled', response.currentPage >= response.totalPages);
                                            },
                                            error: function() {
                                                alert('Error loading data');
                                            }
                                        });
                                    }

                                    // Pagination buttons
                                    $('#go, #next, #prev').on('click', function() {
                                        var page = parseInt($('#in_page').val());
                                        var maxPage = parseInt($('#in_page').attr('max'));

                                        if (this.id === 'next' && page < maxPage) page++;
                                        else if (this.id === 'prev' && page > 1) page--;

                                        $('#in_page').val(page);
                                        loadPage(page);
                                    });

                                    // On limit change
                                    $('#entries').on('change', function() {
                                        $('#in_page').val(1);
                                        loadPage(1);
                                    });

                                    // Search form
                                    $('#searchForm').on('submit', function(e) {
                                        e.preventDefault();
                                        $('#in_page').val(1);
                                        loadPage(1);
                                    });

                                    // Initial load
                                    loadPage($('#in_page').val());
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
