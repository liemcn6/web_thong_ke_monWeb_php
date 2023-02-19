<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <link rel="stylesheet" href="public/assets/css/variables.css">
  <link rel="stylesheet" href="public/assets/css/common.css">
  <link rel="stylesheet" href="public/assets/css/login.css">
  <title> | Login</title>
</head>

<body>
  <div class="vh-100 bg-light d-flex align-items-center">
    <div class="mx-auto shadow-sm rounded login">
      <h3 class="mb-4 text-center login-title">Đăng nhập</h3>
      <form action="login" class="login-form needs-validation" id="login-form" method="POST" novalidate>
        <div class="form-floating mb-3">
          <input type="text" class="form-control login-form__input" id="username" name="username"
            placeholder="Tên đăng nhập" required>
          <label for="username" class="form-label login-form__label">Tên đăng nhập</label>
          <div class="invalid-feedback username-feedback"></div>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control login-form__input" id="password" name="password"
            placeholder="Mật khẩu" required>
          <label for="password" class="form-label login-form__label">Mật khẩu</label>
          <div class="invalid-feedback password-feedback"></div>
        </div>
        <div class="form-check password-toggler mt-4">
          <input type="checkbox" id="password-toggler" class="form-check-input">
          <label for="password-toggler" class="form-check-label user-select-none">
            Hiển thị mật khẩu
          </label>
        </div>

        <div class="forgot-password text-end mb-4">
          <a href="forgot-pass.html" class="text-decoration-none">Quên mật khẩu?</a>
        </div>

        <button class="btn custom-btn-purple w-100 py-2" type="submit">Đăng nhập</button>
      </form>

      <!-- separator -->
      <div class="separator my-3 d-flex justify-content-center align-items-center text-muted">
        <hr class="w-25" />
        <span class="mx-3">Hoặc đăng nhập với</span>
        <hr class="w-25" />
      </div>

      <!-- social login -->
      <div class="text-white row">
        <div class="col-sm-6">
          <div class="social-login social-login__facebook rounded py-2 text-center" style="background-color: #4267b2;">
            <i class="fab fa-facebook-square me-3 fs-5"></i>
            Facebook
          </div>
        </div>
        <div class="col-sm-6">
          <div class="social-login social-login__google rounded py-2 text-center" style="background-color: #d93025;">
            <i class="fab fa-google me-3 fs-6"></i>
            Google
          </div>
        </div>
      </div>

      <!-- register -->
      <div class="register-now mt-4 text-center">
        Bạn chưa có tài khoản, 
        <a href="register" class="fw-bold text-decoration-none text-black">Đăng ký ngay</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="public/assets/js/validator.js"></script>
  <script>
    document.querySelector('#password-toggler').addEventListener('change', (event) => {
      const passwordInputEle = document.querySelector('#password');

      if (event.currentTarget.checked) {
        passwordInputEle.setAttribute('type', 'text');
      }
      else {
        passwordInputEle.setAttribute('type', 'password');
      }
    });
  </script>
</body>

</html>