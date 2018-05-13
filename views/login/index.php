<?php include_once("views/layouts/head.php"); ?>

<section class="u-pdt-15 p-login">
  <div class="container">
    <div class="row">
      <div class="offset-2 col-8">
        <img src="assets/img/user_avatar.png" class="d-block u-centered mb-5 p-login-img" align="center" />

        <form action="<?= vendor_url_util::makeURL(['action' => 'check']) ?>" method="post" class="form">
          <div class="form-group row">
              <label for="l-username" class="col-4 col-form-label text-right u-color-black u-text-bold">Tên đăng nhập (<span class="text-danger">*</span>)</label>
              <div class="col-4">
                <input class="form-control" name="username" value="<?= $this->remember['username'] ?>" type="text" id="l-username" require>
              </div>
              <label for="" class="col-34 col-form-label text-danger"><?= $this->error['username'] ?></label>
          </div>

          <div class="form-group row">
              <label for="l-password" class="col-4 col-form-label text-right u-color-black u-text-bold">Mật khẩu (<span class="text-danger">*</span>)</label>
              <div class="col-4">
                <input class="form-control" name="password" type="password" id="l-password" require>
              </div>
              <label for="" class="col-4 col-form-label text-danger"><?= $this->error['password'] ?></label>
          </div>

          <div class="form-check text-center mt-4">
            <label class="form-check-label u-color-white">
              <input type="checkbox" class="form-check-input" name="remember">
              Save your password
            </label>
          </div>

          <div class="form-group text-center mt-4">
            <button type="submit" class="btn">Login</button>
          </div>

          <div class="form-group text-center mt-4">
            <a href="">Forgot your password?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php  include_once("views/layouts/foot.php"); ?>