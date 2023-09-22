<?php
// yaha pa ham na db ka nam sa veriable banaya ha or jo class ham na config ka page pa di thi ous sa
//  call kia ha new Database ka nam sa 

include "header.php";
$db = new Database();

// yaha pa ma na pagination ka recordsPerPage sa jo ma na per page banaya ha ka ak page pa mujy kitni 
// book show ho gi ous la bd aglay page pa 12 books show ho gi 

$recordsPerPage = 12;

// yaha pa han ma current page get kia ha page ko

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$searchKeyword = '';
$searchCondition = '';

// yaha pa ham na search bar vala kam kia ha is ma ham na phaly data get kia or phr ya data show kara da ga 

if (isset($_GET['search'])) {
    $searchKeyword = trim($_GET['data_enter']);
    $searchCondition = "name LIKE '%$searchKeyword%'";
}

// yaha  pa ham na pagination one page back vala kam kia ha is ma ham phalay current page ma sa -1 kia or multiply records page sa kr dia
$offset = ($currentPage - 1) * $recordsPerPage;
$limit = $recordsPerPage;
// $orderBy = 'ID ASC';

// yaha pa ham na search vala kam kia ha is ma agar searchCondition khali nai ha to is ma ya condition
//  chal jay gi is ma ham na phalay book ka data fetch kia ha ous ka bd ham na condition lagai ha is ma
//  phr is fetch accoc kia or phr is ma array ma total ko call kara lia 

// COUNT(*) (to count all the total rows in the table.)

if (!empty($searchCondition)) {
    $books = $db->select("books", "*", $searchCondition, "$offset, $limit");
    $totalRecords = $db->executeQuery("SELECT COUNT(*) as total FROM books WHERE $searchCondition")->fetch_assoc()['total'];
} else {
    $books = $db->select("books", "*", null, "$offset, $limit");
    $totalRecords = $db->executeQuery("SELECT COUNT(*) as total FROM books")->fetch_assoc()['total'];
}

$totalPages = ceil($totalRecords / $recordsPerPage);

// yaha pa ma na inner join vala work kia ha ma na is ma config ma jo function banaya tha vaha
//  sa call ni kia ma na is ko direct query likh ka call kia ha user ka table ki id, book ka 
// table ka user_id sa jorni thi to is lia ma na inner join us kia


$sql = "SELECT user.* FROM user INNER JOIN books ON user.id = books.user_id";

$result = $db->executeQuery($sql);

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
                                <td class="table-td">

<!-- yaha pa ham na user_type ko admin ya librarian ka brabar rakhi ha k agar user ya librian
 login krta ha to ya button show ho ga agar user login karay ga to ousay ya button show ni ho ga -->

                                 <?php if ($user_type == 'admin' || $user_type == 'librarian') {?>
                                       <td class="table-td">
                                           <div class="dropstart relative">
                                                <button class="inline-flex justify-center items-center" type="button" id="tableDropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <iconify-icon class="text-xl ltr:ml-2 rtl:mr-2" icon="heroicons-outline:dots-vertical"></iconify-icon>
                                                </button>

                                       <ul class="dropdown-menu min-w-max absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                           <li>
                                               <a href="book-edt.php?id=<?php echo $book['id']; ?>" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                   <span>EDIT</span>
                                               </a>
                                           </li>
                                           <li>
                                               <a href="book_delete.php?id=<?php echo $book['id']; ?>" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                   <span>DELETE</span>
                                               </a>
                                           </li>
                                           <?php if ($book['status'] == '0') {?>
                                           <li>
                                               <a href="book_approve.php?id=<?php echo $book['id']; ?>" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                   <span>AVARIABLE</span>
                                               </a>
                                           </li>
                                           <?php }?>

                                           <?php if ($book['status'] == '1') {?> 
                                           <li>
                                               <a href="book_reject.php?id=<?php echo $book['id']; ?>" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                   <span>NOT AVARIABLE</span>
                                               </a>
                                           </li>
                                           <?php }?>
                                       </ul>
                                   </div>
                               </td>
                               <?php }?>
                               </td>

                                </td>
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
                                    <?php

                                    
                                    $user_id = $book['user_id'];
                                    $status = $book['status'];

                                    if ($status == 0) {
                                        $statusValue = "Not Available";
                                        $class = "inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500 bg-danger-500";
                                    } else if ($status == 1 && $user_id != null) {
                                        $row= $result->fetch_assoc();
                                        $statusValue = "Not Available (Borrow BY $row[name])";
                                        
                                        $class = "inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500 bg-danger-500";
                                        
                                    } else {
                                        $statusValue = "Book Available";
                                        $class = "inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500 bg-success-500";
                                    }
                                
                                    ?> 

                                    <div class="<?php echo $class ?>">
                                    <?php echo $statusValue; ?>
                                    </div>

                                    <div class="mt-4 space-x-4 rtl:space-x-reverse">
                                        <a class="btn inline-flex justify-center btn-outline-dark capitalize" href="b_detail.php?id=<?php echo $book['id']; ?>">Book Detail</a>
                                    </div><br>
                        </div>
                      </div>
                    </div>

                    <?php }?>

                    </div>

                    <?php if ($currentPage > 1) {?>
                     <div class="space-x-2 py-4">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>"><iconify-icon icon="material-symbols:arrow-back-ios-rounded"></iconify-icon></a>
                            </li>

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
                    <?php }?>
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