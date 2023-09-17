<?php
include 'header.php';

if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$perpage = 3;
$start = ($page - 1) * $perpage;

?>

<!--start main content-->
<main class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">eCommerce</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <div class="btn-group">
        <button type="button" class="btn btn-primary">Settings</button>
        <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
          <a class="dropdown-item" href="javascript:;">Action</a>
          <a class="dropdown-item" href="javascript:;">Another action</a>
          <a class="dropdown-item" href="javascript:;">Something else here</a>
          <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
        </div>
      </div>
    </div>
  </div>
  <!--end breadcrumb-->


  <div class="product-count d-flex align-items-center gap-3 gap-lg-4 mb-4 fw-bold flex-wrap font-text1">
    <a href="javascript:;"><span class="me-1">All</span><span class="text-secondary">(88754)</span></a>
    <a href="javascript:;"><span class="me-1">Published</span><span class="text-secondary">(56242)</span></a>
    <a href="javascript:;"><span class="me-1">Drafts</span><span class="text-secondary">(17)</span></a>
    <a href="javascript:;"><span class="me-1">On Discount</span><span class="text-secondary">(88754)</span></a>
  </div>

  <div class="row g-3">
    <div class="col-auto">
      <div class="position-relative">
        <input class="form-control px-5" type="search" placeholder="Search Products">
        <span class="material-symbols-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
      </div>
    </div>
    <div class="col-auto flex-grow-1 overflow-auto">
      <div class="btn-group position-static">
        <div class="btn-group position-static">
          <button type="button" class="btn border btn-light dropdown-toggle px-4" data-bs-toggle="dropdown" aria-expanded="false">
            Category
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:;">Action</a></li>
            <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
          </ul>
        </div>
        <div class="btn-group position-static">
          <button type="button" class="btn border btn-light dropdown-toggle px-4" data-bs-toggle="dropdown" aria-expanded="false">
            Vendor
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:;">Action</a></li>
            <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
          </ul>
        </div>
        <div class="btn-group position-static">
          <button type="button" class="btn border btn-light dropdown-toggle px-4" data-bs-toggle="dropdown" aria-expanded="false">
            Collection
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:;">Action</a></li>
            <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="d-flex align-items-center gap-2 justify-content-lg-end">
        <button class="btn btn-light px-4"><i class="bi bi-box-arrow-right me-2"></i>Export</button>
        <button class="btn btn-primary px-4"><i class="bi bi-plus-lg me-2"></i>Add Product</button>
      </div>
    </div>
  </div><!--end row-->

  <div class="card mt-4">
    <div class="card-body">
      <div class="product-table">
        <div class="table-responsive white-space-nowrap">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>

                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $query = "SELECT * FROM `products` AS p INNER JOIN `category` AS c ON p.category = c.cid LIMIT $start, $perpage";
              $result = mysqli_query($conn, $query);

              while ($row = mysqli_fetch_array($result)) {


              ?>
                <tr>

                  <td>
                    <div class="d-flex align-items-center gap-3">
                      <div class="product-box">
                        <img src="../web/assets/images/product-image/<?php echo $row['img1'] ?>" alt="">
                      </div>

                    </div>
                  </td>
                  <td><?php echo $row['title'] ?></td>
                  <td><?php echo $row['price'] ?></td>
                  <td><?php echo $row['cname'] ?></td>
                  <td><?php echo $row['description'] ?></td>



                  <td>
                    <div class="dropdown">
                      <button class="btn btn-sm btn-light border dropdown-toggle dropdown-toggle-nocaret" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>

                      </ul>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-center">
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <?php

        if ($page > 1) {

        ?>
          <li class="page-item"><a class="page-link" href="products.php?page=<?php echo ($page - 1) ?>">Previous</a>
          </li>

        <?php
        }

        $fetch = "SELECT * FROM `products`";
        $result = mysqli_query($conn, $fetch);
        $products = mysqli_num_rows($result);

        $total_pages = Ceil($products / $perpage);

        for ($i = 1; $i <= $total_pages; $i++) {

        ?>

          <li class="page-item"><a class="page-link" href="products.php?page=<?php echo $i ?>"><?php echo $i ?></a>
          </li>

        <?php }

        if ($page < $total_pages) {

        ?>


          <li class="page-item"><a class="page-link" href="products.php?page=<?php echo ($page + 1) ?>">Next</a>
          </li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</main>
<!--end main content-->


<!--start overlay-->
<div class="overlay btn-toggle-menu"></div>
<!--end overlay-->

<!-- Search Modal -->
<div class="modal" id="exampleModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header gap-2">
        <div class="position-relative popup-search w-100">
          <input class="form-control form-control-lg ps-5 border border-3 border-primary" type="search" placeholder="Search">
          <span class="material-symbols-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
        </div>
        <button type="button" class="btn-close d-xl-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="search-list">
          <p class="mb-1">Html Templates</p>
          <div class="list-group">
            <a href="javascript:;" class="list-group-item list-group-item-action active align-items-center d-flex gap-2"><i class="bi bi-filetype-html fs-5"></i>Best Html Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-award fs-5"></i>Html5 Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-box2-heart fs-5"></i>Responsive Html5 Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-camera-video fs-5"></i>eCommerce Html Templates</a>
          </div>
          <p class="mb-1 mt-3">Web Designe Company</p>
          <div class="list-group">
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-chat-right-text fs-5"></i>Best Html Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-cloud-arrow-down fs-5"></i>Html5 Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-columns-gap fs-5"></i>Responsive Html5 Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-collection-play fs-5"></i>eCommerce Html Templates</a>
          </div>
          <p class="mb-1 mt-3">Software Development</p>
          <div class="list-group">
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-cup-hot fs-5"></i>Best Html Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-droplet fs-5"></i>Html5 Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-exclamation-triangle fs-5"></i>Responsive Html5 Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-eye fs-5"></i>eCommerce Html Templates</a>
          </div>
          <p class="mb-1 mt-3">Online Shoping Portals</p>
          <div class="list-group">
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-facebook fs-5"></i>Best Html Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-flower2 fs-5"></i>Html5 Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-geo-alt fs-5"></i>Responsive Html5 Templates</a>
            <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-github fs-5"></i>eCommerce Html Templates</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!--start theme customization-->
<div class="offcanvas offcanvas-end" tabindex="-1" id="ThemeCustomizer" aria-labelledby="ThemeCustomizerLable">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="ThemeCustomizerLable">Theme Customizer</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <h6 class="mb-0">Theme Variation</h6>
    <hr>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme" value="option1">
      <label class="form-check-label" for="LightTheme">Light</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme" value="option2" checked="">
      <label class="form-check-label" for="DarkTheme">Dark</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme" value="option3">
      <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
    </div>
    <hr>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme" value="option3">
      <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="ShadowTheme" value="option4">
      <label class="form-check-label" for="ShadowTheme">Shadow Theme</label>
    </div>

  </div>
</div>
<!--end theme customization-->
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>

<!--BS Scripts-->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>

</html>