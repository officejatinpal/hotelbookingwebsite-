<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Members</title>
    <?= $this->include('backend/common_links/css_links') ?>
    <style>
        .modal-body, .modal-footer, .modal-content { width: 100%; float: left; }
        .list-inline { width: 100%; text-align: center; }
        ul.count2 li { margin-bottom: 20px !important; }
        ul.widget_profile_box li:last-child { width: 100% !important; text-align: center; }
        ul.widget_profile_box li .profile_img { margin: 0; }
        .modal-title { float: left; }
        .mb-2 { margin-bottom: 10px !important; }
        .mt-2 { margin-top: 10px !important; }
        .brdr { border-bottom: 1px solid #ccc; margin-bottom: 20px; padding-bottom: 20px; }
    </style>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <!-- Sidebar -->
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><span>Member Admin</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <br />
                    <?php include("sidebar.php"); ?>
                </div>
            </div>

            <!-- Header -->
            <?php include("header.php"); ?>

            <!-- Main Content -->
            <div class="right_col" role="main">
                <div class="x_panel">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>All Members</h3>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="row brdr">
                        <div class="col-md-8 col-sm-6">
                            <form method="get" id="entriesForm" class="form-inline">
                                <label for="entries">Show:</label>
                                <select name="limit" onchange="document.getElementById('entriesForm').submit()" class="form-control mx-2">
                                    <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25</option>
                                    <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                                    <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
                                    <option value="500" <?= $limit == 500 ? 'selected' : '' ?>>500</option>
                                </select>
                                <input type="hidden" name="search" value="<?= esc($search) ?>">
                            </form>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <form method="get" class="form-inline text-right">
                                <input type="hidden" name="limit" value="<?= $limit ?>">
                                <input type="text" name="search" class="form-control" placeholder="Search by name or mem no." value="<?= esc($search) ?>">
                                <button type="submit" class="btn btn-info ml-2">Search</button>
                            </form>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="container">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered export_table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Membership Detail</th>
                                        <th>Member Detail</th>
                                        <th>Family Detail</th>
                                        <th>Payment Detail</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?= $this->include('backend/member_admin/all-member-view-table'); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination Info -->
                    <div class="text-center mt-3">
                        <b>Total Records: <?= $totalRecords ?></b>
                        <p>Showing: <?= ($currentPage - 1) * $limit + 1 ?> - <?= min($currentPage * $limit, $totalRecords) ?> of <?= $totalRecords ?> Total</p>
                    </div>

                    <!-- Pagination -->
                    <div class="text-center">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $currentPage - 1 ?>&limit=<?= $limit ?>&search=<?= urlencode($search) ?>">Previous</a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>&limit=<?= $limit ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $currentPage + 1 ?>&limit=<?= $limit ?>&search=<?= urlencode($search) ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?= $this->include('backend/common_links/js_links') ?>
</body>
</html>
