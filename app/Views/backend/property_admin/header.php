
<!-- top navigation -->
<div class="top_nav">
          <div class="nav_menu left_col">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
               </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                  
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
 
                    <li><a href="<?php echo base_url('/official/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
         <script>
document.addEventListener("DOMContentLoaded", function () {

    const menuToggle = document.getElementById("menu_toggle");
    const sidebar = document.querySelector(".main_menu_side");

    if (!menuToggle || !sidebar) {
        return;
    }

    /* Create mobile overlay */
    let overlay = document.querySelector(".mobile-menu-overlay");

    if (!overlay) {
        overlay = document.createElement("div");
        overlay.className = "mobile-menu-overlay";
        document.body.appendChild(overlay);
    }


    /* Open / Close Mobile Sidebar */
    menuToggle.addEventListener("click", function (e) {

        if (window.innerWidth <= 991) {

            e.preventDefault();
            e.stopPropagation();

            document.body.classList.toggle("mobile-menu-open");

        }

    });


    /* Overlay click = close */
    overlay.addEventListener("click", function () {

        document.body.classList.remove("mobile-menu-open");

    });


    /* Close sidebar when clicking a child link */
    sidebar.querySelectorAll(".child_menu a").forEach(function (link) {

        link.addEventListener("click", function () {

            if (window.innerWidth <= 991) {

                document.body.classList.remove(
                    "mobile-menu-open"
                );

            }

        });

    });


    /* Close when window becomes desktop */
    window.addEventListener("resize", function () {

        if (window.innerWidth > 991) {

            document.body.classList.remove(
                "mobile-menu-open"
            );

        }

    });

});
</script>