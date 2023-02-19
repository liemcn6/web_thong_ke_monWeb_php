<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <link rel="stylesheet" href="public/assets/css/custom-scrollbar.css">
  <link rel="stylesheet" href="public/assets/css/variables.css">
  <link rel="stylesheet" href="public/assets/css/common.css">
  <link rel="stylesheet" href="public/assets/css/admin.css">
  <title>Thống kê khách hàng</title>
  <style>
    #statistic__top-customer table td {
      min-width: 150px;
    }

    .statistic__chart {
      position: relative;
    }

    .statistic__chart .form-group {
      position: absolute;
    }

    .statistic__chart .form-select {
      width: 80px;
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

      <!-- statistic -->
      <div class="col-10 bg-light pt-2">
        <div class="row">
          <div class="col-5">
            <div class="pt-3 ps-3">
              <h3>Tổng quan báo cáo</h3>
            </div>
            <div class="statistic__general bg-light rounded shadow mt-5">
              <ul class="list-group">
                <li class="list-group-item py-3">
                  <i class="fas fa-user fs-5 me-2"></i>
                  Tổng số khách hàng
                  <span id="statistic__total-user" class="ms-3">
                    <?php echo $customerCount; ?>
                  </span>
                </li>
                <li class="list-group-item py-3">
                  <i class="fas fa-hand-holding-usd fs-5 me-2"></i>
                  Tổng chi tiêu khách hàng
                  <span id="statistic__total-revenue" class="ms-3">
                    <?php echo number_format($totalCustomerSpending, 0, null, '.'); ?>
                    <sup>đ</sup>
                  </span>
                </li>
              </ul>
            </div>
            <div class="bg-white rounded shadow p-2 mt-4 overflow-auto" id="statistic__top-customer">
              <div class="d-flex align-items-center justify-content-between">
                <h5>Top khách hàng</h5>
                <select class="form-select form-select-sm w-25" name="top-customer__criteria" id="top-customer__criteria">
                  <option value="month" selected>Tháng</option>
                  <option value="year">Năm</option>
                </select>
              </div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">SĐT</th>
                    <th scope="col">Chi tiêu(VND)</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
          <div class="col-7">
            <div class="statistic__chart bg-white mt-3 p-3 rounded shadow">
              <div class="form-group d-flex align-items-center">
                <label class="form-label mb-0 me-2" for="new-customer-statistic-select">Năm</label>
                <select class="form-select form-select-sm" id="new-customer-statistic-select">
                  <?php
                  $currentYear = (int)date('Y');
                  for ($index = 2015; $index < $currentYear; $index++) {
                    echo '<option value="' . $index . '">' . $index . '</option>';
                  }
                  echo '<option value="' . $currentYear . '" selected>' . $currentYear . '</option>';
                  ?>
                </select>
              </div>
              <canvas id="new-customer-statistic"></canvas>
            </div>
            <div class="statistic__chart bg-white my-3 p-3 rounded shadow">
              <div class="form-group d-flex align-items-center">
                <label class="form-label mb-0 me-2" for="customer-spending-select">Năm</label>
                <select class="form-select form-select-sm" id="customer-spending-select">
                  <?php
                  $currentYear = (int)date('Y');
                  for ($index = 2015; $index < $currentYear; $index++) {
                    echo '<option value="' . $index . '">' . $index . '</option>';
                  }
                  echo '<option value="' . $currentYear . '" selected>' . $currentYear . '</option>';
                  ?>
                </select>
              </div>
              <canvas id="customer-spending"></canvas>
            </div>
          </div>
        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js" integrity="sha256-7lWo7cjrrponRJcS6bc8isfsPDwSKoaYfGIHgSheQkk=" crossorigin="anonymous"></script>

      <!-- config chartjs -->
      <script src="public/assets/js/chartjs-config.js"></script>

      <script src="public/assets/js/statistic.js"></script>
</body>

</html>