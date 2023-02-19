<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <link rel="stylesheet" href="public/assets/css/animation.css">
  <link rel="stylesheet" href="public/assets/css/variables.css">
  <link rel="stylesheet" href="public/assets/css/common.css">
  <link rel="stylesheet" href="public/assets/css/custom-scrollbar.css">
  <link rel="stylesheet" href="public/assets/css/landing.css">
  <title>JaJa với Khách Hàng</title>

</head>

<body>
  <div class="main">
    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top shadow-sm" id="navbar">
      <div class="container">
        <a class="navbar-brand fw-bolder" href="#">JAJA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbar-collaspe" aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" id="navbar-collaspe">
          <div class="offcanvas-header">
            <button class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <div class="navbar-nav ms-auto">
              <a class="nav-link" href="#about-us">Về chúng tôi</a>
              <a class="nav-link" href="#our-customer">Khách hàng</a>
              <a class="nav-link" href="#contact-us">Liên hệ</a>
              <?php
              echo ((isset($_SESSION['userid'])) ?
                '<a class="nav-link fs-6" href="logout">Đăng xuất</a>' :
                '<a class="nav-link fs-6" href="login">Đăng nhập</a>');
              ?>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- banner -->
    <div class="container-fluid text-center custom-banner">
      <h1 class="fw-lighter">
        Nền tảng quản lý khách hàng được sử dụng nhiều nhất Việt Nam
        <a href="" class="btn btn-lg rounded-pill custom-btn-purple">Dùng thử miễn phí</a>
      </h1>
      <img class="w-100" src="https://www.sapo.vn/Themes/Portal/Default/StylesV2/images/home/bg-banner.png?v=5" alt="">
    </div>

    <!-- about us -->
    <div class="container mt-5" id="about-us">
      <div class="row">
        <h2 class="text-uppercase text-center mb-5">Vì sao chọn JAJA</h2>
        <div class="col-md-7 mb-4">
          <img class="img-fluid" src="http://marketingreview.vn/wp-content/uploads/2017/03/xay-dung-hinh-anh-thuong-hieu-dep.jpg" alt="">
        </div>
        <div class="col-md-5 align-self-center">
          <ul class="why-choose-us list-unstyled">
            <li class="why-choose-us__criteria">
              <h4><i class="fas fa-check custom-purple-color me-2"></i>Quản lý khách hàng dễ dàng</h4>
              <p>Quản lý từ xa linh hoạt trên điện thoại iOS/Android hoặc trực tiếp trên máy tính, laptop,... dữ liệu
                được đồng bộ 100%</p>
            </li>
            <li class="why-choose-us__criteria">
              <h4><i class="fas fa-check custom-purple-color me-2"></i>Quản lý khách hàng chặt chẽ</h4>
              <p>
                Quản lý từ xa linh hoạt trên điện thoại iOS/Android hoặc trực tiếp trên máy tính, laptop,... dữ liệu
                được đồng bộ 100%
              </p>
            </li>
            <li class="why-choose-us__criteria">
              <h4><i class="fas fa-check custom-purple-color me-2"></i>Tự động hóa quản lý</h4>
              <p>
                Quản lý từ xa linh hoạt trên điện thoại iOS/Android hoặc trực tiếp trên máy tính, laptop,... dữ liệu
                được đồng bộ 100%
              </p>
            </li>
            <li class="why-choose-us__criteria">
              <h4><i class="fas fa-check custom-purple-color me-2"></i>Dễ dàng chuyển đổi từ các nền tảng khác</h4>
              <p>Quản lý từ xa linh hoạt trên điện thoại iOS/Android hoặc trực tiếp trên máy tính, laptop,... dữ liệu
                được đồng bộ 100%</p>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- our customer -->
    <div class="container-fluid text-center mt-5" id="our-customer">

      <!-- customer say -->
      <div class="customer-quote bg-light pb-3 pt-5">
        <h3 class="customer-quote__title text-uppercase">Khách hàng nói gì về chúng tôi</h3>
        <div id="customer-quote__slide" class="carousel slide text-center py-5" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#customer-quote__slide" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#customer-quote__slide" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#customer-quote__slide" data-bs-slide-to="2"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <h5 class="customer-quote__item">
                <blockquote class="blockquote">
                  <p class="mb-5">"Tôi đánh giá cao CRMVIET trong việc chăm sóc khách hàng. Tân Hường đã xây dựng được
                    cơ sở dữ liệu điện tử và hỗ trợ tốt việc quản lý quan hệ khách hàng"</p>
                  <footer class="blockquote-footer">
                    Ông Nguyễn Đình Dương,
                    GĐ Công ty Tân Hường</footer>
                </blockquote>
              </h5>
            </div>
            <div class="carousel-item">
              <h5 class="customer-quote__item">
                <blockquote class="blockquote">
                  <p class="mb-5">“Thao rất vui khi được làm việc với CrmViet. Đây thực sự là công cụ tuyệt vời giúp
                    quản lý khách hàng, quản lý Doanh nghiệp hiệu quả. Nếu Thao có 10 Doanh nghiệp, Thao cũng cho 10
                    Doanh nghiệp sử dụng CRM"</p>
                  <footer class="blockquote-footer">
                    Ông Lê Đình Thao
                    Chủ tịch CTCP Lê Bình
                  </footer>
                </blockquote>
              </h5>
            </div>
            <div class="carousel-item">
              <h5 class="customer-quote__item">
                <blockquote class="blockquote">
                  <p class="mb-5">
                    "Tân Trường đã 2 lần triển khai phần mềm CRM thất bại cho đến khi
                    tìm đến CrmViet. Sử dụng CRM là xu thế rồi không tránh được. Vấn đề là dùng của đơn vị nào thôi"
                  </p>
                  <footer class="blockquote-footer">
                    Ông Lê Xuân Trường
                    GĐ C.ty TNHH Quốc tế Tân Trường
                  </footer>
                </blockquote>
              </h5>
            </div>
          </div>
          <button class="carousel-control-prev customer-quote-control" type="button" data-bs-target="#customer-quote__slide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </button>
          <button class="carousel-control-next customer-quote-control" type="button" data-bs-target="#customer-quote__slide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </button>
        </div>
      </div>

      <!-- top customer card -->
      <div class="container top-spending-customer mt-5">
        <h3 class="top-spending-customer__title mb-5 text-uppercase">TOP Khách hàng nổi bật</h3>
        <div class="row">
          <?php
          $imgArr = [
            'https://sonha.com.vn/wp-content/uploads/2021/05/T%E1%BB%95ng-Gi%C3%A1m-%C4%90%E1%BB%91c-%C4%90%C3%A0o-Nam-Phong.png',
            'https://media.baodautu.vn/Images/manhcuong/2016/12/16/nguyen-hoang-anh-giam-doc-cong-ty-tnhh-dau-tu-thuy-san-nam-mien-trung-toi-muon-lam-giau-tu-nong-nghiep1481824670.jpg',
            'https://vcdn-kinhdoanh.vnecdn.net/2020/07/29/o-hoang-minh-hoan-q-tgd-159599-3590-4828-1596000869.jpg'
          ];

          $colSize = 12 / count($listCustomer);
          foreach ($listCustomer as $index => $customer) {
            echo '<div class="col-md-' . $colSize . ' need-slide">';
            echo '<div class="card">';
            echo '<img class="card-img-top" alt="customer avatar" '
              . 'src="' . ($customer->getAvatar() ? $customer->getAvatar() : $imgArr[$index])
              . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title text-capitalize">' . $customer->getFullName() . '</h5>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
          ?>
        </div>
      </div>
    </div>

    <!-- contact -->
    <div class="div bg-light">
      <div class="container mt-5 pt-5" id="contact-us">
        <h2 class="text-center mb-5 text-uppercase">Liên hệ</h2>
        <div class="row justify-content-between">
          <div class="col-sm-5 text-muted">
            <p>
              <i class="fas fa-map-marker-alt me-2"></i>
              96 – 98 Đường số 20, Khu Đô Thị Mới Him Lam, Phường Tân
              Hưng,
              Quận 7, Tp. HCM
            </p>
            <p><i class="fas fa-phone-square-alt me-2"></i> 1900 636940</p>
            <p><i class="fas fa-envelope me-2"></i> marsalesonline@gmail.com</p>
          </div>
          <div class="col-sm-6">
            <form action="" method="POST">
              <div class="row mb-2">
                <div class="col text-center">
                  <label class="form-label fw-bold" for="email">
                    <i class="fas fa-envelope-open-text me-2"></i>
                    Nhập email để được dùng thử 7 ngày miễn phí!
                  </label>
                </div>
              </div>
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <input class="form-control mb-2" id="email" name="email" placeholder="Nhập email của bạn" type="text" required>
                </div>
                <div class="col-sm-2" style="min-width: 120px;">
                  <button class="btn custom-btn-purple w-100" type="submit">Đăng ký</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <footer class="footer text-center py-3 mt-3" style="font-size: 0.85rem;">
      <div class="container">
        <div class="d-flex align-items-center">
          <a href="" class="text-decoration-none text-muted me-3">ĐIỀU KHOẢN</a>
          <a hre="" class="text-decoration-none text-muted me-3">RIÊNG TƯ</a>
          <a href="" class="text-decoration-none text-muted">BẢO MẬT</a>
        </div>
        <p>Copyright © 2021</p>
      </div>
    </footer>

  </div>

  <div id="scroll-top-btn" class="custom-bg-purple-color text-white rounded">
    <i class="fas fa-arrow-up"></i>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="public/assets/js/animate.js"></script>
  <script src="public/assets/js/scroll-top.js"></script>
</body>

</html>