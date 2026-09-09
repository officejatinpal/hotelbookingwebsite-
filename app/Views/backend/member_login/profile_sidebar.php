<div class="dashboard-wrap">

    <!-- SIDEBAR -->
    <div class="db-l-2" id="sidebar">
        <div id="menuClose" class="menu-close">✖</div>
        <ul class="pro_side">
            <li class="<?= current_url()==base_url('member/profile')?'active':'' ?>">
                <a href="<?=base_url('member/profile')?>">Profile</a>
            </li>
            <li class="<?= current_url()==base_url('member/holidays')?'active':'' ?>">
                <a href="<?=base_url('member/holidays')?>">Holidays</a>
            </li>
            <li class="<?= current_url()==base_url('member/amc')?'active':'' ?>">
                <a href="<?=base_url('member/amc')?>">AMC Fee</a>
            </li>
            <li class="<?= current_url()==base_url('member/fee')?'active':'' ?>">
                <a href="<?=base_url('member/fee')?>">Membership Fee</a>
            </li>
            <li class="<?= current_url()==base_url('member/offers')?'active':'' ?>">
                <a href="<?=base_url('member/offers')?>">Offers</a>
            </li>
              <li class="<?= current_url()==base_url('member/documents')?'active':'' ?>">
                <a href="<?=base_url('member/documents')?>">Document</a>
            </li>
             <li><a href="change_password">Change Password</a></li>
            <li>
                <a href="<?=base_url('member/logout')?>">Logout</a>
            </li>
        </ul>
    </div>


<!-- MOBILE HEADER -->
<div class="profile-menu">
    Profile Menu <span id="menuOpen" class="menu-toggle">☰</span>
</div>

<style>
.dashboard-wrap{
    display: flex;
}

/* SIDEBAR */
.db-l-2{
    width: 260px;
    background: #fff;
    min-height: 100vh;
    transition: 0.3s ease;
}

/* MOBILE + TABLET */
@media(max-width: 768px){
    .dashboard-wrap{
        display: block;
    }

    .db-l-2{
        position: fixed;
        top: 0;
        left: -280px;
        height: 100vh;
        z-index: 9999;
    }

    .db-l-2.show{
        left: 0;
    }

    .profile-menu{
        display: flex;
        justify-content: space-between; 
        align-items: center;
        padding: 12px 15px;
        background: #191919;
        color: #cb9131;
    }

    .menu-toggle{
        font-size: 22px;
        cursor: pointer;
    }
}

/* DESKTOP */
@media(min-width: 769px){
    .profile-menu,
    .menu-toggle,
    .menu-close{
        display: none;
    }

    .db-l-2{
        position: relative;
        left: 0;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const openBtn  = document.getElementById("menuOpen");
    const closeBtn = document.getElementById("menuClose");
    const sidebar  = document.getElementById("sidebar");

    if(openBtn){
        openBtn.addEventListener("click", () => {
            sidebar.classList.add("show");
        });
    }

    if(closeBtn){
        closeBtn.addEventListener("click", () => {
            sidebar.classList.remove("show");
        });
    }
});
</script>
