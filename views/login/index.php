<?php include_once("views/layouts/head.php"); ?>

<section class="pt-5 p-login">
  <div class="container">
    <div class="row">
      <div class="offset-4 col-4">
        <img src="assets/img/user_avatar.png" class="d-block u-w-40 u-center" align="center" />

        <form action="<?= vendor_url_util::makeURL(['action' => 'check']) ?>" method="post" class="form">
          <div>
            <label>Username(<span style="color: red">*</span>)</label>
            <input placeholder="Tên đăng nhập" name="username" type="text" required="">
          </div>
          <div>
            <label>Password(<span style="color: red">*</span>)</label>
            <input placeholder="Password" name="password" type="password" required="">
          </div>
          <div>
            <input type="checkbox" name="" value="">Save your password</input>
          </div>
          <div style="margin-top: 10px;">
            <button type="submit">Login</button>
          </div>
            <div style="padding-top: 15px">
            <a href="#">Forgot your password?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php  include_once("views/layouts/foot.php"); ?>