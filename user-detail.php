<?php
include "header.php";

// user detail if user detail same as a librarian detail

$db = new Database();

$recordsPerPage = 5; 

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = intval($_GET['page']);
} else {
    $currentPage = 1; 
}

$offset = ($currentPage - 1) * $recordsPerPage;

$tableName = "user";
$columnsToSelect = "ID, NAME, EMAIL, PHONE, CNIC ,STATUS";

$limit = "$offset, $recordsPerPage"; 
$result = $db->select($tableName, $columnsToSelect, null, $limit);

$totalRecordsQuery = "SELECT COUNT(*) AS total FROM $tableName";
$totalRecordsResult = $db->select($tableName, "COUNT(*) AS total", null);

$row = $totalRecordsResult->fetch_assoc();
$totalRecords = $row['total'];

$totalPages = ceil($totalRecords / $recordsPerPage);

$prevPage = ($currentPage > 1) ? $currentPage - 1 : 1;
$nextPage = ($currentPage < $totalPages) ? $currentPage + 1 : $totalPages;


if (isset($_GET['search'])) {
    $searchTerm = $_GET['data_enter'];

    $searchQuery = "SELECT ID, NAME, EMAIL, PHONE, CNIC, STATUS FROM $tableName 
                    WHERE NAME LIKE '%$searchTerm%' OR EMAIL LIKE '%$searchTerm%' OR PHONE LIKE '%$searchTerm%' OR CNIC LIKE '%$searchTerm%'";
    $result = $db->executeQuery($searchQuery);
} elseif (isset($_GET['reset'])) {
    $result = $db->select($tableName, $columnsToSelect, null, $limit);
}

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

<!-- BEGIN: Search Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none top-1/4">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
            <form>
                <div class="relative">
                    <input type="text" class="form-control !py-3 !pr-12" placeholder="Search">
                    <button class="absolute right-0 top-1/2 -translate-y-1/2 w-9 h-full border-l text-xl border-l-slate-200 dark:border-l-slate-600 dark:text-slate-300 flex items-center justify-center">
                        <iconify-icon icon="heroicons-solid:search"></iconify-icon>
                    </button>
                </div>
            </form>
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
                                        <input name="data_enter" class="search_pat" type="text" placeholder="Enter Data To Search "  >

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
                                                                ID
                                                            </th>
                                                            <th scope="col" class="table-th ">
                                                                NAME
                                                            </th>
                                                            <th scope="col" class="table-th ">
                                                                EMAIL
                                                            </th>
                                                            <th scope="col" class="table-th ">
                                                                PHONE
                                                            </th>
                                                            <th scope="col" class="table-th ">
                                                               CNIC
                                                            </th>
                                                            <th scope="col" class="table-th ">
                                                               STATUS
                                                            </th>
                                                            <th scope="col" class="table-th ">
                                                               ACTION
                                                            </th>

                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">

                                                        <?php
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                    <tr>
                                                                        <td class="table-td"><?php echo $row['ID']; ?></td>
                                                                        <td class="table-td"><?php echo $row['NAME']; ?></td>
                                                                        <td class="table-td"><?php echo $row['EMAIL']; ?></td>
                                                                        <td class="table-td"><?php echo $row['PHONE']; ?></td>
                                                                        <td class="table-td"><?php echo $row['CNIC']; ?></td>
                                                                        <td class="table-td">
                                                                        <?php
                                                                        $status = $row['STATUS']; // Assuming 'STATUS' is the correct column name

                                                                        if ($status == '') {
                                                                            $status = "Not Approved";
                                                                            $class = "inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-warning-500 bg-warning-500";
                                                                        } elseif ($status == '1') {
                                                                            $status = "Approved";
                                                                            $class = "inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500 bg-success-500";
                                                                        } else {
                                                                            $status = "Reject";
                                                                            $class = "inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500 bg-danger-500";
                                                                        }
                                                                        ?>

                                                                        <div class="<?php echo $class ?>">
                                                                            <?php echo $status; ?>
                                                                        </div>
                                                                        </td>
                                                                        <td class="table-td">
                                                                            <div class="dropstart relative">
                                                                                <button class="inline-flex justify-center items-center" type="button" id="tableDropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                    <iconify-icon class="text-xl ltr:ml-2 rtl:mr-2" icon="heroicons-outline:dots-vertical"></iconify-icon>
                                                                                </button>
                                                                                <ul class="dropdown-menu min-w-max absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                                                                    <li>
                                                                                        <a href="user-approve.php?id=<?php echo $row['ID']; ?>" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                                                            <span>Approve</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="user-reject.php?id=<?php echo $row['ID']; ?>" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                                                            <span>Reject</span>
                                                                                        </a>
                                                                                    </li>
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
                                    <div class="space-x-2 py-4">
                                        <div>

                                        </div>



        

                    <div class="space-x-2 py-4">


                    <?php if ($currentPage > 1): ?>
                      <div class="card-text h-full space-y-10">
                        <ul class="list-none">
                          <li class="inline-block">
                            <a href="?page=<?php echo $prevPage; ?>" class="flex items-center justify-center w-6 h-6 bg-slate-100 dark:bg-slate-700 dark:hover:bg-black-500 text-slate-800
                                      dark:text-white rounded mx-1 hover:bg-black-500 hover:text-white text-sm font-Inter font-medium transition-all
                                      duration-300 relative top-[2px] pl-2">
                              <iconify-icon icon="material-symbols:arrow-back-ios-rounded"></iconify-icon>
                            </a>
                          </li>
                          <?php endif;?>



                          <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                          <li class="inline-block">
                            <a href="?page=<?php echo $i; ?>" class="flex items-center justify-center w-6 h-6 bg-slate-100 dark:bg-slate-700 dark:hover:bg-black-500 text-slate-800
                                      dark:text-white rounded mx-1 hover:bg-black-500 hover:text-white text-sm font-Inter font-medium transition-all
                                      duration-300 <?php echo ($i == $currentPage) ? 'p-active"' : ''; ?> "> <?php echo $i; ?>
                            </a>
                          </li>
                          <?php endfor;?>



                          <?php if ($currentPage < $totalPages): ?>
                          <li class="inline-block">
                            <a href="?page=<?php echo $nextPage; ?>" class="flex items-center justify-center w-6 h-6 bg-slate-100 dark:bg-slate-700 dark:hover:bg-black-500 text-slate-800
                                      dark:text-white rounded mx-1 hover:bg-black-500 hover:text-white text-sm font-Inter font-medium transition-all
                                      duration-300 relative top-[2px]">
                              <iconify-icon icon="material-symbols:arrow-forward-ios-rounded"></iconify-icon>
                            </a>
                            <?php endif;?>
                          </li>
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