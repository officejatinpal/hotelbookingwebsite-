<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      <li>
        <a href="#"><i class="fa fa-calendar-check-o"></i><?=date('d M, Y')?></a>
      </li>
      <li>
        <a><i class="fa fa-users"></i>Manage Members<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu gg">
          <li><a href="<?=base_url('/add_member')?>"> Add New Member</a></li>
          <li><a href="<?=base_url('/search_member')?>"></i> Search Member</a></li>
          <li><a href="<?=base_url('/all-member')?>"> All Members</a></li>
        </ul>
      </li>
      <li>
        <a><i class="fa fa-file-text-o"></i>Manage Invoice<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu gg">
         <li><a href="<?=base_url('/search_invoice')?>"> Search Invoice</a></li>
        </ul>
      </li>
      <li>
        <a><i class="fa fa-ticket"></i>Manage Gift Voucher<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu gg">
          <li><a href="<?=base_url('/generate_voucher')?>"> Generate Voucher</a></li>
          <li><a href="<?=base_url('/search-voucher')?>"> Search Voucher</a></li>
        </ul>
      </li>

    </ul>
  </div>
</div>


