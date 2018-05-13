<?php include_once("views/layouts/head.php"); ?>

<section>
  <div class="container">
    <div class="o-d-table">
      <?php
        include_once("views/layouts/sidebar.php");
        include_once("views/layouts/header.php");
      ?>
        <div class="p-5">
          <form action="" class="form">
            <div class="form-group row">
              <div class="col-6">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"><i class="fas fa-search"></i></span>
                  <input type="text" name="search" class="form-control" placeholder="Search..." aria-describedby="basic-addon1">
                </div>
              </div>

              <div class="col-3">
                <select class="form-control" name="type">
                  <option value="name">Theo tên</option>
                  <option value="name">Theo trạng thái</option>
                </select>
              </div>

              <div class="col-3">
                <button type="submit" class="btn u-cursor-pointer">Tìm kiếm</button>
              </div>
            </div>
          </form>
        </div>

        <div class="pr-5 pl-5">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Khách Hàng</th>
                <th>Trạng Thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($this->data['data'] as $key => $value) { ?>
                <tr>
                  <td><?= $value['id'] ?></td>
                  <td><?= $value['fullname'] ?></td>
                  <td><?php echo $value['state'] == 1 ? 'Còn hạn' : 'Hết hạn'; ?></td>
                  <td align="center"><a href="<?= vendor_url_util::makeURL(['action' => 'show', 'params' => ['id' => $value['id']]]) ?>" class="btn btn-secondary">Xem</a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

          <div class="text-center mt-5">
            <div class="o-pagination">
              <?php if ($this->data['pagination']['page'] > 1) { ?>
                <div class="o-pagination__item">
                  <a href="<?= vendor_url_util::makeURL(['params' => ['page' => $this->data['pagination']['page'] - 1]]) ?>" class="o-pagination__link">Prev</a>
                </div>
              <?php } ?>

              <?php for ($i=$this->data['pagination']['min']; $i<=$this->data['pagination']['max']; $i++) { ?>
                <div class="o-pagination__item">
                  <?php if ($i == $this->data['pagination']['page']) { ?>
                    <span class="o-pagination__current"><?= $i ?></span>
                  <?php } else { ?>
                    <a href="<?= vendor_url_util::makeURL(['params' => ['page' => $i]]) ?>" class="o-pagination__link"><?= $i ?></a>
                  <?php } ?>
                 </div>
              <?php } ?>


              <?php if ($this->data['pagination']['page'] < $this->data['pagination']['total_page']) { ?>
                <div class="o-pagination__item">
                  <a href="<?= vendor_url_util::makeURL(['params' => ['page' => $this->data['pagination']['page'] + 1]]) ?>" class="o-pagination__link">Next</a>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include_once("views/layouts/foot.php"); ?>