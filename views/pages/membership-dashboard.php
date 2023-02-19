<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <link rel="stylesheet" href="http://localhost/ltw-customer-management/public/assets/css/custom-scrollbar.css">
  <link rel="stylesheet" href="http://localhost/ltw-customer-management/public/assets/css/variables.css">
  <link rel="stylesheet" href="http://localhost/ltw-customer-management/public/assets/css/common.css">
  <link rel="stylesheet" href="http://localhost/ltw-customer-management/public/assets/css/admin.css">
  <link rel="stylesheet" href="http://localhost/ltw-customer-management/public/assets/css/membership-dashboard.css">
  <title>Membership</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row vh-100">

      <div class="bg-dark pe-3 col-2">
        <!-- sidebar -->
        <?php include __DIR__ . '/../components/sidebar.php'; ?>
      </div>

      <div class="col-10 bg-light">
        <div class="client-list pt-4 px-3">
          <div class=" client-list__header mb-4 d-flex justify-content-between align-items-center">
            <h3 class="client-list__title">Khách hàng</h3>

            <!-- button trigger modal add membership group -->
            <button class="btn custom-btn-purple" data-bs-toggle="modal" data-bs-target="#membership-group-add" type="button">
              Thêm nhóm khách hàng
            </button>
          </div>

          <hr class="mb-5" />

          <!-- membership group list -->
          <div class="memebership-group table-responsive">
            <table class="table table-hover table-bordered mb-0 shadow-sm bg-white">
              <thead class="table-light position-sticky top-0 start-0 align-middle">
                <tr>
                  <th scope="col">Mã nhóm</th>
                  <th scope="col">Tên nhóm</th>
                  <th scope="col">Số lượng khách hàng</th>
                  <th scope="col">Ngày tạo</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                <?php
                foreach ($listMembership as $membership) {
                  echo '<tr class="memebership-group-item" 
                    onclick="window.location.href=\'membership/update/' . $membership->getId() . '\'">';
                  echo '<td class="membership-group-id">' . ($membership->getId()) . '</td>';
                  echo '<td class="membership-group-name">' . ($membership->getName()) . '</td>';
                  echo '<td class="membership-group-member-count">' . ($membership->getTotalMember()) . '</td>';
                  echo '<td class="membership-group-createdDate">' . ($membership->getCreatedDate()) . '</td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
            <div class="loading-more my-1 text-center">
              <i class="fas fa-spinner"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- modal -->

  <div class="modal fade" id="membership-group-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm nhóm khách hàng</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4">
          <form action="membership/add" id="add-membership-group" method="POST">

            <div class="form-group">
              <label for="membership-group-add__name" class="form-label">Tên nhóm</label>
              <input type="text" id="membership-group-add__name" class="form-control" name="name" required>
            </div>

            <div class="row form-group">
              <div class="col">
                <label for="membership-group-add__discount" class="form-label">Chiết khấu (%)(Trên mỗi đơn hàng)</label>
                <input type="number" value="0" min="0" max="100" class="form-control" id="membership-group-add__discount" name="discount" required>
              </div>
            </div>

            <div class="form-group">
              <label for="membership-group-add__promotion" class="form-label">Ưu đãi khác</label>
              <textarea name="otherspromotion" id="membership-group-add__promotion" class="form-control" rows="5"></textarea>
            </div>

            <div class="form-group">
              <label for="membership-group-add__description" class="form-label">Mô tả</label>
              <textarea name="description" id="membership-group-add__description" class="form-control" rows="5"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="add-membership-group" class="btn custom-btn-purple">Lưu</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>