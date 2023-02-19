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
  <title>Update Member</title>
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
          <h3>Chi tiết nhóm khách hàng</h3>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-membership-modal">Xóa nhóm khách hàng</button>
        </div>
        <hr />
        <div class="row px-3">
          <div class="col">
            <div class="membership-general-info shadow-sm bg-white rounded">
              <form action="<?php echo ($membership->getId()) . '/general'; ?>" method="POST">
                <h5 class="pt-3 px-4">Thông tin chung</h5>
                <hr class="mx-3" />
                <ul class="list-unstyled px-4 pb-3">
                  <li class="form-group row">
                    <div class="col">Mã nhóm:</div>
                    <div class="col"><?php echo $membership->getId(); ?></div>
                    <input type="hidden" id="membershipid" value="<?php echo $membership->getId(); ?>">
                  </li>
                  <li class="form-group row">
                    <div class="col">Tổng số thành viên:</div>
                    <div class="col"><?php echo $membership->getTotalMember(); ?></div>
                  </li>
                  <li class="form-group required-field">
                    <label for="membership-name" class="form-label">Tên nhóm khách hàng</label>
                    <input type="text" class="form-control mt-2" name="name" id="membership-name" value="<?php echo $membership->getName(); ?>" required>
                  </li>
                  <li class="form-group">
                    <label for="membership-total-member" class="form-label">Mô tả</label>
                    <textarea type="text" class="form-control mt-2" name="description" id="membership-description"><?php echo $membership->getDescription(); ?></textarea>
                  </li>
                </ul>
                <div class="text-end mx-3 pb-3">
                  <button type="submit" class="btn custom-btn-purple">Lưu</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col">
            <div class="memebership-advance-setting shadow-sm bg-white rounded">
              <form action="<?php echo ($membership->getId()) . '/advance'; ?>" method="POST">
                <h5 class="pt-3 px-4">Cài đặt nâng cao</h5>
                <hr class="mx-3" />
                <ul class="list-unstyled px-4 pb-3">
                  <li class="form-group">
                    <label for="membership-discount" class="form-label">Chiết khấu (%)(Trên mỗi đơn hàng)</label>
                    <input value="<?php echo $membership->getDiscount(); ?>" type="number" value="0" min="0" max="100" class="form-control mt-2" name="discount" id="membership-discount" required>
                  </li>
                  <li class="form-group">
                    <label for="membership-others-promotion" class="form-label">Ưu đãi khác</label>
                    <textarea class="form-control mt-2" name="otherspromotion" id="membership-others-promotion" rows="5" required><?php echo $membership->getOtherPromotion(); ?></textarea>
                  </li>
                </ul>
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
          <button type="button" id="delete-membership-btn" class="btn btn-danger btn-sm me-4 px-3" data-bs-dismiss="modal">Đồng ý</button>
          <button type="button" class="btn custom-btn-purple btn-sm px-4">Hủy</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    const deleteMembershipBtn = document.getElementById('delete-membership-btn');
    deleteMembershipBtn.addEventListener('click', async function() {
      const response = await fetch('http://localhost/ltw-customer-management/api/admin/membership/delete', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
          'membershipid': document.getElementById('membershipid').value
        })
      });

      const res = await response.json();
      if (res.statusCode === '201') {
        setTimeout(() => {
          document.location.href = "http://localhost/ltw-customer-management/admin/membership";
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