<?php $dept = session()->get('department_id'); ?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <ul class="nav side-menu">
         
        <li><a href="#"><i class="fa fa-calendar-check-o"></i><?=date('d M, Y')?></a></li>

        <li><a href="<?=base_url('/employee/dashboard')?>"><i class="fa fa-user"></i>Profile</a></li>

        <li>
          <a><i class="fa fa-check-square-o"></i>Attendance<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu gg">
            <li><a href="<?=base_url('employee/mark_attendance_view')?>"><i class="fa fa-pencil-square-o"></i> Mark Attendance</a></li>
            <li><a href="<?=base_url('employee/attendance')?>"><i class="fa fa-eye"></i> View Attendance</a></li>
          </ul>
        </li>
        
        <?php if ($dept == 8): ?>
         <li>
          <a>
            <i class="fa fa-users"></i>Employees
            <span class="fa fa-chevron-down"></span>
          </a>
          <ul class="nav child_menu gg">
            <li><a href="<?=base_url('/employee/register')?>"> Add New Employees</a></li>
            <li><a href="<?=base_url('backend/employee_admin/all_employee')?>"> View Employees</a></li>
          </ul>
        </li>
        
        <?php endif; ?>
        
        
       <?php if ($dept == 2 || $dept == 6): ?>
    <li>
        <a><i class="fa fa-ticket"></i>Gift Voucher<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu gg">
    
            <?php if ($dept == 2): ?>
            <li>
                <a href="<?= base_url('/generate_voucher') ?>">
                    <i class="fa fa-plus-square"></i> Generate Voucher
                </a>
            </li>
            <?php endif; ?>
    
            <li>
                <a href="<?= base_url('/search-voucher') ?>">
                    <i class="fa fa-search"></i> Search Voucher
                </a>
            </li>
    
        </ul>
    </li>
            
    <?php endif; ?>

        <?php if ($dept == 2 || $dept == 7 || $dept == 6): ?>
        <li>
            <a><i class="fa fa-users"></i>Manager Member<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu gg">
        
                <?php if ($dept == 2 || $dept == 7 || $dept == 6): ?>
                <li><a href="<?= base_url('/search_member') ?>"><i class="fa fa-search"></i> Search Member</a></li>
                <?php endif; ?>
        
                <?php if ($dept == 2): ?>
                <li><a href="<?= base_url('/add_member') ?>"><i class="fa fa-user-plus"></i> Add Member</a></li>
                <li><a href="<?= base_url('/search_invoice') ?>"><i class="fa fa-file-text-o"></i> Search Invoice</a></li>
                <?php endif; ?>
        
            </ul>
        </li>
        <?php endif; ?>

        <li><a href="<?=base_url('employee/salary')?>"><i class="fa fa-money"></i>Salary</a></li>

        <li><a href="<?=base_url('employee/change_password')?>"><i class="fa fa-lock"></i>Change Password</a></li>
       
      </ul>
    </div>
</div>


