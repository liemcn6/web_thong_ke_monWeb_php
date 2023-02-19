<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <link rel="stylesheet" href="http://localhost/ltw-customer-management/public/assets/css/variables.css">
  <link rel="stylesheet" href="http://localhost/ltw-customer-management/public/assets/css/animation.css">
  <link rel="stylesheet" href="http://localhost/ltw-customer-management/public/assets/css/common.css">
  <link rel="stylesheet" href="http://localhost/ltw-customer-management/public/assets/css/custom-scrollbar.css">
  <link rel="stylesheet" href="http://localhost/ltw-customer-management/public/assets/css/admin.css">
  <title>Quản lý khách hàng</title>

  <style>
    table tr th:first-child {
      width: 15%;
    }

    textarea {
      resize: none;
    }

    #current-page {
      max-width: 40px;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row vh-100">

      <div class="bg-dark pe-3 col-2">
        <!-- sidebar -->
        <?php include __DIR__ . '/../components/sidebar.php'; ?>
      </div>

      <!-- client search -->
      <div class="col-10 bg-light">

        <!-- filter -->
        <div class="client-filter offcanvas offcanvas-end p-3" tabindex="-1" id="client-filter-offcanvas">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title fs-4">Bộ lọc</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
          </div>
          <div class="offcanvas-body">
            <div class="filter-criteria py-4">
              <div class="d-flex justify-content-between" data-bs-toggle="collapse" data-bs-target="#email-criteria-collapse">
                <h6 class="filter-title m-0 text-capitalize fw-normal">Email</h6>
                <i class="fas fa-chevron-down text-muted"></i>
              </div>
              <div class="collapse" id="email-criteria-collapse">
                <input type="text" class="form-control form-control-sm mt-3" id="filter-email" name="email" placeholder="Nhập email">
              </div>
            </div>
            <div class="filter-criteria py-4">
              <div class="d-flex justify-content-between" data-bs-toggle="collapse" data-bs-target="#name-criteria-collapse">
                <h6 class="filter-title m-0 text-capitalize fw-normal">Tên khách hàng</h6>
                <i class="fas fa-chevron-down text-muted"></i>
              </div>
              <div class="collapse" id="name-criteria-collapse">
                <input type="text" class="form-control form-control-sm mt-3" id="filter-fullname" name="fullname" placeholder="Nhập tên">
              </div>
            </div>
            <div class="filter-criteria py-4">
              <div class="d-flex justify-content-between" data-bs-toggle="collapse" data-bs-target="#membership-criteria-collapse">
                <h6 class="filter-title m-0 text-capitalize fw-normal">Nhóm khách hàng</h6>
                <i class="fas fa-chevron-down text-muted"></i>
              </div>
              <div class="collapse" id="membership-criteria-collapse">
                <select class="form-select form-select-sm mt-3" id="filter-membership" name="membership">
                  <option value="" selected>--Chưa chọn--</option>
                </select>
              </div>
            </div>
            <div class="filter-criteria py-4">
              <div class="d-flex justify-content-between" data-bs-toggle="collapse" data-bs-target="#id-criteria-collapse">
                <h6 class="filter-title m-0 text-capitalize fw-normal">Mã khách hàng</h6>
                <i class="fas fa-chevron-down text-muted"></i>
              </div>
              <div class="collapse" id="id-criteria-collapse">
                <input type="text" class="form-control form-control-sm mt-3" id="filter-customerid" name="customerid" placeholder="Nhập mã khách hàng">
              </div>
            </div>
            <div class="filter-criteria py-4">
              <div class="d-flex justify-content-between" data-bs-toggle="collapse" data-bs-target="#sort-criteria-collapse">
                <h6 class="filter-title m-0 text-capitalize fw-normal">Sắp xếp theo</h6>
                <i class="fas fa-chevron-down text-muted"></i>
              </div>
              <div class="collapse" id="sort-criteria-collapse">
                <select class="form-select form-select-sm mt-3" id="sort-select" name="orderby">
                  <option value="customer_id" selected>Mã khách hàng</option>
                  <option value="full_name">Tên khách hàng</option>
                  <option value="total_spending">Tổng chi tiêu</option>
                </select>
                <select class="form-select form-select-sm mt-3" id="sort-type-select" name="ordertype">
                  <option value="ASC" selected>--Thứ tự--</option>
                  <option value="ASC">Tăng dần</option>
                  <option value="DESC">Giảm dần</option>
                </select>
              </div>
            </div>
          </div>
          <div class="offcanvas-footer border-top text-end">
            <button class="btn btn-secondary mt-3 me-3" id="clear-filter-btn">Bỏ lọc</button>
            <button class="btn custom-btn-purple mt-3" id="apply-filter-btn">Áp dụng</button>
          </div>
        </div>

        <div class="client-list pt-4 px-3">
          <div class=" client-list__header mb-4 d-flex justify-content-between align-items-center">
            <h3 class="client-list__title">Khách hàng</h3>

            <!-- add customer link- Thêm khách hàng -->
            <a href="customer/add" class="btn custom-btn-purple">
              Thêm khách hàng
            </a>
          </div>

          <hr class="mb-5" />

          <div class="row filter-control justify-content-between">
            <div class="col-md-8">
              <div class="d-flex">
                <div class="position-relative w-75"> 
                  <!-- search btn -->
                  <input type="text" id="quick-search-input" class="form-control form-control-sm rounded-pill ps-3 pe-5" placeholder="Tìm kiếm nhanh">
                  <i class="fas fa-search text-muted"></i>
                </div>

                <div class="ms-4">
                  Bộ lọc
                  <button class="bg-white ms-2 border-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#client-filter-offcanvas">
                    <i class="fas fa-filter"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- table result -->
          <div class="search-result table-responsive mt-3">
            <table class="table table-hover table-bordered mb-0 shadow-sm bg-white">
              <thead class="table-light position-sticky top-0 start-0 align-middle">
                <tr>
                  <th scope="col">Mã khách hàng</th>
                  <th scope="col">Tên khách hàng</th>
                  <th scope="col">Giới tính</th>
                  <th scope="col">Nhóm khách hàng</th>
                  <th class="col">Tổng chi tiêu</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                <?php
                foreach ($listCustomer as $customer) {
                  echo '<tr class="search-result__item" onclick="window.location.href=\'customer/' . ($customer->getId()) . '\'">';
                  echo '<td class="client-id">' . ($customer->getId()) . '</td>';
                  echo '<td class="client-name">' . ($customer->getFullName()) . '</td>';
                  echo '<td class="client-gender">'
                    . (strcasecmp($customer->getGender(), 'male') == 0 ? 'Nam' : 'Nữ')
                    . '</td>';
                  echo '<td><span class="client-membership">'
                    . ($customer->getMembership()->getId() == 1
                      ? 'Chưa có nhóm'
                      : $customer->getMembership()->getName())
                    . '</span></td>';
                  echo '<td class="client-spending">'
                    . number_format($customer->getTotalSpending(), 0, ',', '.')
                    . ' <sup>đ</sup>'
                    . '</td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
            <div class="pagination mt-3 p-1 justify-content-end align-items-center">
              <i class="fas fa-chevron-left text-muted fs-5" id="pagination-prev"></i>
              <input type="text" class="form-control-plaintext" id="current-page" readonly>
              <i class="fas fa-chevron-right text-muted fs-5" id="pagination-next"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- modals -->

  <!-- edit column modal -->
  <div class="modal fade" id="edit-display-column-modal" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"></div>
        <div class="modal-body"></div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- init bootstrap tooltip -->
  <script>
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  </script>

  <script src="http://localhost/ltw-customer-management/public/assets/js/customer.js"></script>

</body>

</html>