<?php
include "header.php";
// include "config.php";
// session_start();
$db = new Database();

$recordsPerPage = 12;

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$searchKeyword = '';
$searchCondition = '';

if (isset($_GET['search'])) {
    $searchKeyword = trim($_GET['data_enter']);
    $searchCondition = "name LIKE '%$searchKeyword%'";
}

$offset = ($currentPage - 1) * $recordsPerPage;
$limit = $recordsPerPage;
$orderBy = 'ID ASC';

if (!empty($searchCondition)) {
    $books = $db->select("books", "*", $searchCondition, "$offset, $limit");
    $totalRecords = $db->executeQuery("SELECT COUNT(*) as total FROM books WHERE $searchCondition")->fetch_assoc()['total'];
} else {
    $books = $db->select("books", "*", null, "$offset, $limit");
    $totalRecords = $db->executeQuery("SELECT COUNT(*) as total FROM books")->fetch_assoc()['total'];
}

$totalPages = ceil($totalRecords / $recordsPerPage);
?>


<button class="smallDeviceMenuController md:hidden block leading-0">
    <iconify-icon class="cursor-pointer text-slate-900 dark:text-white text-2xl" icon="heroicons-outline:menu-alt-3"></iconify-icon>
</button>
<!-- end mobile menu -->
</div>
<!-- end nav tools -->
</div>
</div>
</div>

<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
    <div class="page-content">
        <div class="transition-all duration-150 container-fluid" id="page_layout">
            <div id="content_layout">

                <div class=" md:flex justify-between items-center">
                    <div>
                        <!-- BEGIN: Breadcrumb -->
                        <div class="mb-5">
                            <form method="get">
                                <ul class="m-0 p-0 list-none">

                                    <li>
                                        <input name="data_enter" class="search_pat" type="text" placeholder="Enter Book Name"  >

                                        <button name="search" type="submit" class="search_btn">Search</button>
                                        <button name="reset" type="submit" class="search_btn">Table Reset</button>
                                    </li>

                                    <p style="color: red;">
                                        <?php echo @$error ?>
                                    </p>
                                </ul>
                            </form>
                        </div>
                        <!-- END: BreadCrumb -->
                    </div>

                </div>

                <div class="tab-content mt-6" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                        <div class="tab-content">
                            <div class="card">
                                <div class="card-body px-6 rounded overflow-hidden">
                                    <div class="overflow-x-auto -mx-6">
                                        <div class="inline-block min-w-full align-middle">
                                            <div class="overflow-hidden ">
                                                <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 ">
                                                    <thead class="bg-slate-200 dark:bg-slate-700">
                                                        <tr>
                                                            <th scope="col" class="table-th ">
                                                                BOOKS
                                                            </th>


                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">



                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-x-2 py-4">




                                        <div class='space-y-6'>
                                            <div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
                      <?php foreach ($books as $book) {?>
                    <div class="card rounded-md bg-white dark:bg-slate-800 lg:h-full  shadow-base">
                      <div class="card-body flex flex-col p-6">
                        <header class="flex mb-5 items-center">
                          <div class="flex-1">
                            <div class="card-title font-Inter text-slate-900 dark:text-white"><?php echo $book['writer']; ?></div>
                            <!-- <div class="card-subtitle font-Inter">This is a subtitle</div> -->
                          </div>
                        </header>
                        <div class="image-box mb-6">
                        <?php $imageUrl = "images/" . $book['image'];?>
                          <img style="width: 100%; height:400px" src="<?php echo $imageUrl; ?>" alt="" class="block w-full h-full object-cover rounded-md">
                        </div>
                        <div class="card-text h-full">
                        <h3><?php echo $book['name']; ?></h3><br>
                          <p><?php echo $book['desc']; ?></p>
                          <br>
                          <td class="table-td">
                                       <?php
$status = $book['status']; // Assuming 'STATUS' is the correct column name

    if ($status == '1') {
        $status = "Available";
        $class = "inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500 bg-success-500";
    } else {
        $status = "NOT Available";
        $class = "inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500 bg-danger-500";
    }
    ?>

                                     <div class="<?php echo $class ?>">
                                <?php echo $status; ?>
                             </div>
                             </td>
                          <div class="mt-4 space-x-4 rtl:space-x-reverse">


                                <a class="btn inline-flex justify-center btn-outline-dark capitalize" href="b_detail.php?id=<?php echo $book['id']; ?>">Book Detail</a>


                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }?>

                    </div>




                     <div class="space-x-2 py-4">

                    <ul class="pagination">
                    <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>"><iconify-icon icon="material-symbols:arrow-back-ios-rounded"></iconify-icon></a>
                                </li>
                            <?php endif;?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo ($i === $currentPage) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor;?>

                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>"><iconify-icon icon="material-symbols:arrow-forward-ios-rounded"></iconify-icon></a>
                                </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</main>
<!-- scripts -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/rt-plugins.js"></script>
<script src="assets/js/app.js"></script>


</body>

</html>