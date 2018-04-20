<?php require_once("views/layouts/head.php"); ?>

<section class="o-grid">
  <form action="<?php echo vendor_url_util::makeURL(["controller" => "login", "action" => "check"]) ?>" method="POST">
    <div>
      Username
      <input type="text" name="username" />
    </div>

    <div>
      Password
      <input type="password" name="password" />
    </div>

    <div>
      <button type="submit">Login</button>
    </div>
  </form>
</section>

<?php require_once("views/layouts/foot.php"); ?>