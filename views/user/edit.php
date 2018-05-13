<?php include_once("views/layouts/head.php"); ?>

<section>
  <div class="container">
    <div class="o-d-table">
      <?php
        include_once("views/layouts/sidebar.php");
        include_once("views/layouts/header.php");
      ?>
        <h3 class="text-center">Sửa thông tin cá nhân</h3>

        <div class="mt-4 pl-4 pr-4 pb-5">
          <div class="u-bd p-3">
            <?php if ($this->success) { ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong><?= $this->success ?></strong>
                </div>
            <?php } ?>

            <form
              action="<?= vendor_url_util::makeURL(['action' => 'update', 'params' => ['id' => $this->data['id']]]) ?>"
              method="POST"
              class="form"
             >
              <div class="form-group row">
                <div class="col-3">
                  <div class="o-d-table u-h-100">
                    <div class="o-d-table__cell o-d-table__cell--middle">
                      <h4>Ảnh đại diện</h4>
                    </div>
                  </div>
                </div>
                <div class="col-9">
                  <label class="o-replace">
                    <input type="file" class="o-replace__input" />
                    <img src="assets/img/upload.png" class="o-replace__object p-user-upload-img">
                  </label>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-3"><h4>Họ và tên: *</h4></div>
                <div class="col-4">
                  <input type="text" name="fullname" class="form-control" value="<?= $this->data['fullname'] ?>" />
                </div>
                <div class="col-4"><h5 class="text-danger"><?= $this->error['fullname'] ?></h5></div>
              </div>

              <div class="form-group row">
                <div class="col-3"><h4>Ngày sinh<h4></div>
                <div class="col-4">
                  <input type="date" name="date_of_birth" class="form-control" value="<?= $this->data['date_of_birth'] ?>" />
                </div>
                <div class="col-4"><h5 class="text-danger"><?= $this->error['date_of_birth'] ?></h5></div>
              </div>

              <div class="form-group row">
                <div class="col-3"><h4>Email: *</h4></div>
                <div class="col-4">
                  <input type="text" name="email" class="form-control" value="<?= $this->data['email'] ?>" />
                </div>
                <div class="col-4"><h5 class="text-danger"><?= $this->error['email'] ?></h5></div>
              </div>

              <div class="form-group row">
                <div class="col-3"><h4>Số điện thoại</h4></div>
                <div class="col-4">
                  <input type="text" name="phone" class="form-control" value="<?= $this->data['phone'] ?>" />
                </div>
                <div class="col-4"><h5 class="text-danger"><?= $this->error['phone'] ?></h5></div>
              </div>

              <div class="form-group row">
                <div class="col-3"><h4>Địa chỉ</h4></div>
                <div class="col-4">
                  <input type="text" name="address" class="form-control" value="<?= $this->data['address'] ?>" />
                </div>
                <div class="col-4"><h5 class="text-danger"><?= $this->error['address'] ?></h5></div>
              </div>

              <div class="form-group row">
                <div class="col-3"><h4>Số chứng minh: *</h4></div>
                <div class="col-4">
                  <input type="text" name="identity_card" class="form-control" value="<?= $this->data['identity_card'] ?>" />
                </div>
                <div class="col-4"><h5 class="text-danger"><?= $this->error['identity_card'] ?></h5></div>
              </div>

              <div class="form-group row">
                <div class="col-3"><h4>Giới tính</h4></div>
                <div class="col-4">
                  <label class="form-check-label">
                    <input type="radio" name="gender" value="1" class="form-check-input" <?php if ($this->data['gender'] == 1) echo 'checked'; ?> />
                    Nam
                  </label>
                  <label class="form-check-label ml-3">
                    <input type="radio" name="gender" value="0" class="form-check-input" <?php if ($this->data['gender'] == 0) echo 'checked'; ?> />
                    Nữ
                  </label>
                </div>
                <div class="col-4"><h5 class="text-danger"><?= $this->error['gender'] ?></h5></div>
              </div>

              <div class="form-group text-right pr-5">
                <button class="btn u-cursor-pointer mr-3">Trở về</button>
                <button class="btn u-cursor-pointer">Cập nhật</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include_once("views/layouts/foot.php"); ?>