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
  <title>Thêm khách hàng</title>

  <style>
    button[type="submit"] {
      min-width: 120px;
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

      <div class="bg-light col-10">
        <div class="pt-4 px-3 d-flex align-items-center justify-content-between">
          <h3>Thêm khách hàng</h3>
          <button type="submit" class="btn custom-btn-purple" form="add-customer-form">Lưu</button><!-- Btn lưu -->
        </div>
        <hr />
        <form action="" id="add-customer-form" method="POST">
          <div class="row px-3">
            <div class="col">
              <div class="membership-general-info shadow-sm bg-white rounded">
                <h5 class="pt-3 px-4">Thông tin chung</h5>
                <hr class="mx-3" />
                <ul class="list-unstyled px-4 pb-3">
                  <li class="form-group row">
                    <div class="col">Mã khách hàng:</div>
                    <div class="col">KH1001</div>
                  </li>
                  <li class="form-group required-field">
                    <label for="fullname" class="form-label">Tên khách hàng</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" required>
                  </li>
                  <li class="form-group row">
                    <div class="col">
                      <label for="birthday" class="form-label">Sinh nhật</label>
                      <input class="custom-datepicker" id="birthday" type="date" name="birthday"></input>
                    </div>
                    <div class="col required-field">
                      <label for="client-update-form__gender" class="form-label">Giới tính</label>
                      <select class="form-select" id="client-update-form__gender" name="gender" required>
                        <option value="male" selected>Nam</option>
                        <option value="female">Nữ</option>
                      </select>
                    </div>
                  </li>

                  <li class="form-group">
                    <label for="note" class="form-label">Ghi chú</label>
                    <textarea name="note" id="note" class="form-control" rows="5"></textarea>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col">

              <div class="customer-contact-info shadow-sm bg-white rounded mb-3">
                <h5 class="pt-3 px-4">Thông tin liên lạc</h5>
                <hr class="mx-3" />
                <ul class="list-unstyled px-4 pb-3 mb-0">
                  <li class="row form-group">
                    <div class="col">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" id="email" class="form-control" name="email">
                    </div>

                    <div class="col required-field">
                      <label for="phonenumber" class="form-label">Số điện thoại</label>
                      <input type="tel" id="phonenumber" class="form-control" name="phonenumber" required>
                    </div>
                  </li>

                  <li class="form-group">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" id="address">
                  </li>
                </ul>
              </div>

              <div class="memebership-advance-setting shadow-sm bg-white rounded">
                <h5 class="pt-3 px-4">Cài đặt nhóm khách hàng</h5>
                <hr class="mx-3" />
                <div class="px-4 pb-3">
                  <div class="form-group required-field">
                    <label for="membership" class="form-label">Nhóm khách hàng</label>
                    <select class="form-select" name="membership" id="membership" required>
                      <option value="" selected>--Chưa chọn--</option>
                      <?php
                      foreach ($membershipList as $membership) {
                        echo '<option value="' . $membership->getId() . '">' . ($membership->getName()) . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>