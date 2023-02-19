<div class="sidebar overflow-hidden text-nowrap">

  <!-- user control -->
  <div class="user mt-4 mb-5 d-flex justify-content-between dropdown text-white">
    <div class="dropdown-toggle user-info ms-2 flex-grow-1 d-flex justify-content-between align-items-center" id="user-control-toggler-1" data-bs-toggle="dropdown">
      <span class="user-info__main d-inline-block">
        <img class="user-avatar" src="<?php echo 'https://tapchianhdep.com/wp-content/uploads/2021/05/hinh-avatar-hai-huoc-ngau.jpg'; ?>" alt="cool duck">
        <span class="user-name"><?php echo $_SESSION['username']; ?></span>
      </span>
      <i class="fas fa-chevron-down"></i>
    </div>
    <ul class="dropdown-menu w-100 user-select-none" aria-labelledby="user-control-toggler-1">
      <li><a href="#" class="dropdown-item">Đổi mật khẩu</a></li>
      <li><a href="http://localhost/ltw-customer-management/logout" class="dropdown-item">Đăng xuất</a></li>
    </ul>
  </div>

  <!-- navigation -->
  <ul class="nav-list">
    <li class="nav-list__item">
      <a href="http://localhost/ltw-customer-management/admin">
        <i class="fas fa-chart-line"></i>
        Tổng quan
      </a>
    </li>
    <li class="nav-list__item">
      <a href="http://localhost/ltw-customer-management/admin/customer">
        <i class="fas fa-id-card"></i>
        Khách hàng
      </a>
    </li>
    <li class="nav-list__item">
      <a href="http://localhost/ltw-customer-management/admin/membership">
        <i class="fas fa-users"></i>
        Nhóm khách hàng
      </a>
    </li>
  </ul>
</div>