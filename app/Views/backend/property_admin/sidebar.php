
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">

            <!-- Date -->
            <li>
                <a href="#">
                    <i class="fa fa-calendar"></i> <?= date('d M, Y') ?>
                </a>
            </li>

            <!-- Destinations -->
            <li>
                <a><i class="fa fa-map-marker"></i> Destinations <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu gg">
                    <li><a href="<?= base_url('webmaster/add_destination') ?>">Add Destination</a></li>
                    <li><a href="<?= base_url('webmaster/all_destination') ?>">All Destinations</a></li>
                </ul>
            </li>

            <!-- Resorts -->
            <li>
                <a><i class="fa fa-building"></i> Resorts <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu gg">
                    <li><a href="<?= base_url('webmaster/add_resort') ?>">Add Resort</a></li>
                    <li><a href="<?= base_url('webmaster/all_resort') ?>">All Resorts</a></li>
                </ul>
            </li>

            <!-- Blogs -->
            <li>
                <a><i class="fa fa-pencil"></i> Blogs <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu gg">
                    <li><a href="<?= base_url('webmaster/add-blog') ?>">Blog Post</a></li>
                    <li><a href="<?= base_url('webmaster/view-blog') ?>">Blog View</a></li>
                </ul>
            </li>

            <!-- Travel Desk -->
            <li>
                <a><i class="fa fa-suitcase"></i> Travel Desk <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu gg">
                    <li><a href="<?= base_url('webmaster/add-desk') ?>">Desk Post</a></li>
                    <li><a href="<?= base_url('webmaster/view-desk') ?>">Desk View</a></li>
                </ul>
            </li>

            <!-- Page Voucher -->
            <li>
                <a><i class="fa fa-ticket"></i> Page Vouchers <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu gg">
                    <li><a href="<?= base_url('webmaster/pagevoucher') ?>">Page Voucher Post</a></li>
                </ul>
            </li>

            <!-- Packages -->
            <li>
                <a><i class="fa fa-gift"></i> Packages <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu gg">
                    <li><a href="<?= base_url('webmaster/add-package') ?>">Package Post</a></li>
                    <li><a href="<?= base_url('webmaster/view-package') ?>">Package View</a></li>
                </ul>
            </li>

            <!-- Reviews -->
            <li>
                <a><i class="fa fa-comments"></i> Reviews <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu gg">
                    <li><a href="<?= base_url('webmaster/add-testimonial') ?>">Add Review</a></li>
                       <li><a href="<?= base_url('webmaster/view-reviews') ?>">View Review</a></li>
                </ul>
            </li>

            <!-- YouTube Videos -->
            <li>
                <a><i class="fa fa-youtube-play"></i> YouTube Videos <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu gg">
                    <li><a href="<?= base_url('webmaster/add-video') ?>">Add Video</a></li>
                </ul>
            </li>

            <!-- Gallery -->
            <li>
                <a><i class="fa fa-image"></i> Gallery <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu gg">
                    <li><a href="<?= base_url('webmaster/add-gallery') ?>">Add Image</a></li>
                </ul>
            </li>

            <!-- Slide Images -->
            <li>
                <a><i class="fa fa-sliders"></i> Slide Images <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu gg">
                    <li><a href="<?= base_url('webmaster/add-slide-img') ?>">Add Slide Image</a></li>
                    <li><a href="<?= base_url('webmaster/slideviews') ?>">View Slide Images</a></li>
                </ul>
            </li>
                <li>
                <a><i class="fa fa-sliders"></i> Boat FAQ <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu gg">
                    <li><a href="<?= base_url('webmaster/chatbot/create') ?>">Add Chat FAQ</a></li>
                    <li><a href="<?= base_url('webmaster/chatbot') ?>">View Boat</a></li>
                </ul>
            </li>

        </ul>
    </div>
</div>

<style>
.left_col {
    background: #dfb56d !important;
}
</style>

