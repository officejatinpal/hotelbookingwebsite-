<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <ul class="nav side-menu">        

        <li>
          <a href="#">
            <i class="fa fa-calendar-check-o"></i><?=date('d M, Y')?>
          </a>
        </li>

        <li>
          <a>
            <i class="fa fa-users"></i>Employees
            <span class="fa fa-chevron-down"></span>
          </a>
          <ul class="nav child_menu gg">
            <li><a href="<?=base_url('employee/register')?>"> Add New Employees</a></li>
            <li><a href="<?=base_url('backend/employee_admin/all_employee')?>"> View Employees</a></li>
          </ul>
        </li>

        <li>
          <a>
            <i class="fa fa-check-square-o"></i>Employees Attendance
            <span class="fa fa-chevron-down"></span>
          </a>
          <ul class="nav child_menu gg">
            <li><a href="<?=base_url('employee/employeesAttendance')?>"> Employees Attendance</a></li>
          </ul>
        </li>

        <li>
          <a>
            <i class="fa fa-building"></i>Add BR+DEP+DES
            <span class="fa fa-chevron-down"></span>
          </a>
          <ul class="nav child_menu gg">
            <li><a href="<?=base_url('employee/add-branch-name')?>"> Add Branch</a></li>
            <li><a href="<?=base_url('employee/add-department-name')?>"> Add Department</a></li>
            <li><a href="<?=base_url('employee/add-designation-name')?>"> Add Designation</a></li>
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
