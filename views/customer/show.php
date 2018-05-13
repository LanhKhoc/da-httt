<?php include_once("views/layouts/head.php"); ?>

<section>
  <div class="container">
    <div class="o-d-table">
      <?php
        include_once("views/layouts/sidebar.php");
        include_once("views/layouts/header.php");
      ?>
        <div class="p-5">
          <div class="u-bd p-customer-wrapper-info">
            <div class="row">
              <div class="col-4">
                <img src="assets/img/user_avatar.png" alt="" class="p-customer-avatar">
                <h3 class="text-center"><?= $this->data['fullname'] ?></h3>
                <h4 class="text-center">
                  <?= $this->data['gender'] ?>
                  <span class="ml-3"><i class="fas fa-transgender-alt"></i></span>
                </h4>
                <h4 class="text-center">
                  <?= explode(' ', $this->data['date_of_birth'])[0] ?>
                  <span class="ml-3"><i class="fas fa-birthday-cake"></i></span>
                </h4>
              </div>

              <div class="col-8">
                <h4 class="pt-1 pb-1">
                  <span class="mr-4"><i class="fas fa-envelope"></i></span>
                  <?= $this->data['email'] ?>
                </h4>
                <h4 class="pt-1 pb-1">
                  <span class="mr-4"><i class="fas fa-phone"></i></span>
                  <?= $this->data['phone'] ?>
                </h4>
                <h4 class="pt-1 pb-1">
                  <span class="mr-4"><i class="fas fa-home"></i></span>
                  <?= $this->data['address'] ?>
                </h4>
                <h4 class="pt-1 pb-1">
                  <span class="mr-4"><i class="fas fa-clock"></i></span>
                  <?= $this->data['state'] ?>
                </h4>

                <div class="pt-3 pb-2">
                  <a href="" class="btn btn-primary">Gia hạn</a>
                  <a href="" class="btn btn-danger mr-4 ml-4 js-delete-action">Xóa</a>
                  <a href="" class="btn btn-warning">Khóa</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- <div class="o-modal">
  <div class="o-modal__wrapper">
    <div class="o-modal__backdrop"></div>
    <div class="o-modal__main">
      <p class="o-modal__message">Bạn có muốn <strong>Xóa</strong> khách hàng này không?</p>
      <div class="o-modal__control">
        <button class="btn">Không</button>
        <button class="btn btn-primary">Có</button>
      </div>
    </div>
  </div>
</div> -->

<?php include_once("views/layouts/foot.php"); ?>