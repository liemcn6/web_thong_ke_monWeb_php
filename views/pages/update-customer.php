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
  <title>Cập nhật khách hàng</title>
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
          <h3>Chi tiết khách hàng</h3>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-membership-modal">
            Xóa khách hàng
          </button>
        </div>
        <hr />
        <div class="row px-3">
          <div class="col">
            <div class="membership-general-info shadow-sm bg-white rounded">
              <form action="<?php echo $customer->getId(); ?>/update/general" method="POST">
                <h5 class="pt-3 px-4">Thông tin chung</h5>
                <hr class="mx-3" />
                <ul class="list-unstyled px-4 pb-3">
                  <li class="form-group row">
                    <div class="col">Mã khách hàng:</div>
                    <div class="col"><?php echo $customer->getId(); ?></div>
                    <input type="hidden" id="customerid" value="<?php echo $customer->getId(); ?>">
                  </li>
                  <li class="form-group required-field">
                    <label for="fullname" class="form-label">Tên khách hàng</label>
                    <input value="<?php echo $customer->getFullName(); ?>" type="text" class="form-control" name="fullname" id="fullname" required>
                  </li>
                  <li class="form-group row">
                    <div class="col">
                      <label for="birthday" class="form-label">Ngày sinh</label>
                      <input value="<?php echo $customer->getDateOfBirth(); ?>" class="custom-datepicker" id="birthday" type="date" name="birthday"></input>
                    </div>
                    <div class="col required-field">
                      <label for="client-update-form__gender" class="form-label">Giới tính</label>
                      <select class="form-select" id="client-update-form__gender" name="gender" required>
                        <option value="male" <?php echo strcasecmp($customer->getGender(), 'male') == 0 ? 'selected' : ''; ?>>Nam</option>
                        <option value="female" <?php echo strcasecmp($customer->getGender(), 'female') == 0 ? 'selected' : ''; ?>>Nữ</option>
                      </select>
                    </div>
                  </li>

                  <li class="form-group">
                    <label for="note" class="form-label">Ghi chú</label>
                    <textarea name="note" id="note" class="form-control" rows="5"><?php echo $customer->getNote(); ?></textarea>
                  </li>
                </ul>
                <div class="text-end mx-3 pb-3">
                  <button type="submit" class="btn custom-btn-purple">Lưu</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col">

            <div class="customer-contact-info shadow-sm bg-white rounded mb-3">
              <form action="<?php echo $customer->getId(); ?>/update/contact" method="POST">
                <h5 class="pt-3 px-4">Thông tin liên lạc</h5>
                <hr class="mx-3" />
                <ul class="list-unstyled px-4 pb-3 mb-0">
                  <li class="row form-group">
                    <div class="col">
                      <label for="email" class="form-label">Email</label>
                      <input value="<?php echo $customer->getEmail(); ?>" type="email" id="email" class="form-control" name="email">
                    </div>

                    <div class="col required-field">
                      <label for="phonenumber" class="form-label">Số điện thoại</label>
                      <input value="<?php echo $customer->getPhoneNumber(); ?>" type="tel" id="phonenumber" class="form-control" name="phonenumber" required>
                    </div>
                  </li>

                  <li class="form-group">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input value="<?php echo $customer->getAddress(); ?>" type="text" class="form-control" name="address" id="address">
                  </li>
                </ul>
                <div class="text-end mx-3 pb-3">
                  <button type="submit" class="btn custom-btn-purple">Lưu</button>
                </div>
              </form>
            </div>

            <div class="memebership-advance-setting shadow-sm bg-white rounded">
              <form action="<?php echo $customer->getId(); ?>/update/membership" method="POST">
                <h5 class="pt-3 px-4">Cài đặt nhóm khách hàng</h5>
                <hr class="mx-3" />
                <div class="px-4 pb-3">
                  <div class="row mb-3">
                    <div class="col">
                      Nhóm hiện tại:
                    </div>
                    <div class="col">
                      <div class="membership-current">
                        <?php echo $customer->getMembership()->getId() == 1
                          ? 'Chưa có nhóm'
                          : $customer->getMembership()->getName();
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-group required-field">
                    <label for="membership-new" class="form-label">Nhóm mới</label>
                    <select class="form-select" name="membership" id="membership-new" required>
                      <option value="" selected>--Chưa chọn--</option>
                      <?php
                      foreach ($membershipList as $membership) {
                        if ($membership->getId() == $customer->getMembership()->getId()) continue;
                        echo '<option value="' . $membership->getId() . '">' . ($membership->getName()) . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="text-end mx-3 pb-3">
                  <button type="submit" class="btn custom-btn-purple">Lưu</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="delete-membership-modal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body text-danger pb-4 pt-5">
          <h5 class="text-center">Bạn có chắc chắn muốn xóa?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm me-4 px-3" id="delete-customer-btn">Đồng ý</button>
          <button type="button" class="btn custom-btn-purple btn-sm px-4" data-bs-dismiss="modal">Hủy</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const deleteCustomerBtn = document.getElementById('delete-customer-btn');
    deleteCustomerBtn.addEventListener('click', async function() {
      const response = await fetch('http://localhost/ltw-customer-management/admin/customer/delete', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
          'customerid': document.getElementById('customerid').value
        })
      });

      const res = await response.json();
      if (res.statusCode === '201') {
        setTimeout(() => {
          document.location.href = "http://localhost/ltw-customer-management/admin/customer";
        }, 1800);
        Swal.fire({
          icon: 'success',
          title: 'Xóa thành công',
          showCancelButton: false,
          showConfirmButton: false,
          timer: 1500,
        });
      }
    });
  </script>
</body>

</html>