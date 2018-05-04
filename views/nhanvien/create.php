<?php
  include_once("views/layouts/head.php");
  include_once("views/layouts/header.php");
?>

<section>
  <div class="container">
    <form action="<?php echo vendor_url_util::makeURL(['action' => 'store']) ?>" method="POST" class="form mt-5">
      <div class="form-group row">
        <label for="example-text-input" class="offset-2 col-2 col-form-label text-center">Mã nhân viên</label>
        <div class="col-6">
          <input class="form-control" type="text" name="idnv" value="<?php echo $this->data['remember']['idnv'] ?>" required />
          <div class="form-text text-danger"><?php echo $this->data['error']['idnv'] ?></div>
        </div>
      </div>
      <div class="form-group row">
        <label for="example-text-input" class="offset-2 col-2 col-form-label text-center">Họ tên</label>
        <div class="col-6">
          <input class="form-control" type="text" name="hoten" value="<?php echo $this->data['remember']['hoten'] ?>" required />
          <div class="form-text text-danger"><?php echo $this->data['error']['hoten'] ?></div>
        </div>
      </div>
      <div class="form-group row">
        <label for="example-text-input" class="offset-2 col-2 col-form-label text-center">Địa chỉ</label>
        <div class="col-6">
          <input class="form-control" type="text" name="diachi" value="<?= $this->data['remember']['diachi'] ?>" required
          />
          <div class="form-text text-danger"><?php echo $this->data['error']['diachi'] ?></div>
        </div>
      </div>
      <div class="form-group row">
        <label for="example-text-input" class="offset-2 col-2 col-form-label text-center">Phòng ban</label>
        <div class="col-6">
          <select class="form-control" name="phongban">
            <?php foreach ($this->data['list_phongban'] as $item) { ?>
              <option value="<?= $item['idpb'] ?>"><?= $item['mota'] ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group row text-center">
        <div class="offset-4 col-6">
          <input type="submit" value="Save" name="submit" class="btn btn-primary u-cur-pointer" />
          <input type="reset" value="Reset" class="btn btn-danger u-cur-pointer" />
          <a href="<?php echo vendor_url_util::makeURL(['action' => 'index']); ?>" class="btn btn-success">Back To Home</a>
        </div>
      </div>
    </form>
  </div>
</section>

<?php include_once("views/layouts/foot.php"); ?>