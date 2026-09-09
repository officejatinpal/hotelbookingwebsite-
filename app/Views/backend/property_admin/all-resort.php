<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Destinations</title>

    <!-- Include CSS Links -->
    <?= $this->include("backend/common_links/css_links"); ?>

    <style>
      .modal-body,
      .modal-footer,
      .modal-content {
        width: 100%;
        float: left;
      }

      .list-inline {
        width: 100%;
        text-align: center;
      }

      ul.count2 li {
        margin-bottom: 20px !important;
      }

      ul.widget_profile_box li:last-child {
        width: 100% !important;
        text-align: center;
      }

      ul.widget_profile_box li .profile_img {
        margin: 0px;
      }

      .modal-title {
        float: left;
      }

      .mb-2 {
        margin-bottom: 10px !important;
      }

      .mt-2 {
        margin-top: 10px !important;
      }

      .brdr {
        border-bottom: 1px solid #ccc;
        margin-bottom: 20px;
        padding-bottom: 20px;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        <!-- Sidebar -->
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><span>Property Admin</span></a>
            </div>
            <div class="clearfix"></div>

            <!-- Sidebar Menu -->
            <?php include("sidebar.php"); ?>
          </div>
        </div>
        <!-- Top Navigation -->
        <?php include("header.php"); ?>
        <!-- Page Content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Destinations</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
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
                                    <input type="text" name="search" placeholder="Search by Property Name" value="<?= esc($search); ?>" />
                                    <button type="submit">Search</button>
                                </form>
                            </div>
                            <!-- Table Data Section -->
                            <form method="get" id="filter-form">
                            <label for="category">Filter by Category:</label>
                            <select name="category" id="category" onchange="document.getElementById('filter-form').submit();">
                              <option value="">All Categories</option>
                              <?php foreach ($categories as $cat): ?>
                                  <option value="<?= $cat['desti_category']; ?>" <?= ($selectedCategory == $cat['desti_category']) ? 'selected' : '' ?>>
                                      <?= $cat['desti_category']; ?>
                                  </option>
                              <?php endforeach; ?>
                          </select>
                        </form>

                            <div id="table-data">
                                
                                <?php include("all_resorts_table.php"); ?>
                            </div>

                            <!-- Pagination Info -->
                            <span>
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
                                    // Event handler for pagination buttons
                                    $('#go, #next, #prev').on('click', function() {
                                        var page = parseInt($('#in_page').val());
                                        var totalPages = parseInt($('#in_page').attr('max'));

                                        if (this.id === 'next' && page < totalPages) {
                                            page++;
                                        } else if (this.id === 'prev' && page > 1) {
                                            page--;
                                        }
                                        $('#in_page').val(page); // Update the page input
                                        loadPage(page);
                                    });

                                    // Event handler for entries dropdown
                                    $('#entries').on('change', function() {
                                        $('#in_page').val(1); // Reset to first page
                                        loadPage(1);
                                    });

                                    // Event handler for search form
                                    $('#searchForm').on('submit', function(e) {
                                        e.preventDefault();
                                        loadPage(1); // Start search from first page
                                    });

                                    function loadPage(page) {
                                        var selectedLimit = $('#entries').val();
                                        var searchQuery = $('input[name="search"]').val();  // Capture search query
                                        $.ajax({
                                          url: '<?= site_url("webmaster/all_resort") ?>',
                                          type: 'GET',
                                          data: { 
                                              page: page,
                                              limit: selectedLimit,
                                              search: searchQuery,
                                              category: $('#category').val() // Include selected category
                                          },
                                          success: function(response) {
                                              $('#table-data').html(response);
                                              updatePaginationInfo(page);
                                          },
                                          error: function() {
                                              alert('Error loading data');
                                          }
                                      });
                                    }

                                    function updatePaginationInfo(page) {
                                        var totalPages = parseInt($('#in_page').attr('max'));
                                        $('#prev').toggleClass('disabled', page <= 1);
                                        $('#next').toggleClass('disabled', page >= totalPages);
                                    }

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
