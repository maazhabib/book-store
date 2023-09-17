<?php
include("header.php");
// include("config.php");

if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$perpage = 5;
$start = ($page - 1) * $perpage;
$pat = "SELECT * FROM `patient_signup` LIMIT $start,$perpage";


if (isset($_POST['search'])) {
  $cnic = $_POST['data_enter'];
  $cnicRegix="/^(4)[0-9]{12}$/";

  if(preg_match($cnicRegix,$cnic)){

    $pat = "SELECT * FROM `patient_signup` WHERE cnic = $cnic";
  }else{
    $error= "invalid CNIC NO";
  }
}
$patRes = mysqli_query($conn, $pat);
?>

<head>

</head>

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
<!-- END: Search Modal -->
<!-- END: Header -->
<!-- END: Header -->
<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
  <div class="page-content">
    <div class="transition-all duration-150 container-fluid" id="page_layout">
      <div id="content_layout">

        <div class=" md:flex justify-between items-center">
          <div>



            <!-- BEGIN: Breadcrumb -->
            <div class="mb-5">
              <form method="post">
                <ul class="m-0 p-0 list-none">

                  <li>
                    <input name="data_enter" class="search_pat" type="text" placeholder="Enter Your Cnic Number " required>
                    
                    <button name="search" type="submit
                    " class="search_btn">Search</button>
                  </li>
                  
                  <p style="color: red;">
                  <?php echo @$error?>
                  </p>
                </ul>
              </form>
            </div>
            <!-- END: BreadCrumb -->
          </div>
          <div class="flex flex-wrap ">

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
                                ADDRESS
                              </th>
                              <th scope="col" class="table-th ">
                                PHONE_NO
                              </th>
                              <th scope="col" class="table-th ">
                                CNIC
                              </th>
                              
                            </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                            <tr class="even:bg-slate-50 dark:even:bg-slate-700">
                              <?php

                              while ($row = mysqli_fetch_array($patRes)) {

                              ?>
                                <td class="table-td">

                                  <div class="flex space-x-3 items-center text-left rtl:space-x-reverse">
                                    <div class="flex-none">
                                      <?php echo $row['0'] ?>
                                    </div>

                                  </div>
                                </td>
                                <td class="table-td">
                                  <?php echo $row['1'] ?>

                                </td>
                                <td class="table-td">
                                  <?php echo $row['6'] ?>

                                </td>

                                <td class="table-td">
                                  <?php echo $row['2'] ?>

                                </td>



                                <td class="table-td">
                                  <div class="flex justify-start -space-x-1.5 rtl:space-x-reverse">
                                    <?php echo $row['3'] ?>

                                  </div>
                                </td>

                                <td class="table-td">
                                  <div class="">
                                    <?php echo $row['4'] ?>

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
                    

                    <?php
                    if ($page > 1) {

                    ?>

                      <div class="card-text h-full space-y-10">
                        <ul class="list-none">
                          <li class="inline-block">
                            <a href="patient_detail.php?page=<?php echo ($page - 1) ?>" class="flex items-center justify-center w-6 h-6 bg-slate-100 dark:bg-slate-700 dark:hover:bg-black-500 text-slate-800
                                      dark:text-white rounded mx-1 hover:bg-black-500 hover:text-white text-sm font-Inter font-medium transition-all
                                      duration-300 relative top-[2px] pl-2">
                              <iconify-icon icon="material-symbols:arrow-back-ios-rounded"></iconify-icon>
                            </a>
                          </li>

                        <?php
                      }

                      $fetch = "SELECT * FROM `patient_signup`";
                      $result = mysqli_query($conn, $fetch);
                      $analyic = mysqli_num_rows($result);

                      $total_pages = Ceil($analyic / $perpage);

                      for ($i = 1; $i <= $total_pages; $i++) {


                        ?>

                          <li class="inline-block">
                            <a href="patient_detail.php?page=<?php echo $i ?>" class="flex items-center justify-center w-6 h-6 bg-slate-100 dark:bg-slate-700 dark:hover:bg-black-500 text-slate-800
                                      dark:text-white rounded mx-1 hover:bg-black-500 hover:text-white text-sm font-Inter font-medium transition-all
                                      duration-300 p-active"><?php echo $i ?>
                            </a>
                          </li>

                        <?php }

                      if ($page < $total_pages) {

                        ?>

                          <li class="inline-block">
                            <a href="patient_detail.php?page=<?php echo ($page + 1) ?>" class="flex items-center justify-center w-6 h-6 bg-slate-100 dark:bg-slate-700 dark:hover:bg-black-500 text-slate-800
                                      dark:text-white rounded mx-1 hover:bg-black-500 hover:text-white text-sm font-Inter font-medium transition-all
                                      duration-300 relative top-[2px]">
                              <iconify-icon icon="material-symbols:arrow-forward-ios-rounded"></iconify-icon>
                            </a>
                          <?php } ?>
                          </li>
                        </ul>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade " id="pills-grid" role="tabpanel" aria-labelledby="pills-grid-tab">
            <div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5 ">
              <div class="card rounded-md bg-white dark:bg-slate-800 shadow-base custom-class card-body p-6">
                <header class="flex justify-between items-end">
                  <div class="flex space-x-4 items-center rtl:space-x-reverse">
                    <div class="flex-none">
                      <div class="h-10 w-10 rounded-md text-lg bg-slate-100 text-slate-900 dark:bg-slate-600 dark:text-slate-200 flex flex-col items-center justify-center font-normal capitalize">
                        Bu
                      </div>
                    </div>
                    <div class="font-medium text-base leading-6">
                      <div class="dark:text-slate-200 text-slate-900 max-w-[160px] truncate">
                        Business Dashboard
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="dropstart relative">
                      <button class="inline-flex justify-center items-center" type="button" id="tableDropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                        <iconify-icon class="text-xl ltr:ml-2 rtl:mr-2" icon="heroicons-outline:dots-vertical"></iconify-icon>
                      </button>
                      <ul class="dropdown-menu min-w-max absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                        <li>
                          <a href="project-details.html" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white
                   w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300  last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize  rtl:space-x-reverse">
                            <iconify-icon icon="heroicons-outline:eye"></iconify-icon>
                            <span>View</span></a>
                        </li>
                        <li>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#editModal" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                            <iconify-icon icon="clarity:note-edit-line"></iconify-icon>
                            <span>Edit</span></a>
                        </li>
                        <li>
                          <a href="#" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                            <iconify-icon icon="fluent:delete-28-regular"></iconify-icon>
                            <span>Delete</span></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </header>
                <div class="text-slate-600 dark:text-slate-400 text-sm pt-4 pb-8"></div>
                <div class="flex space-x-4 rtl:space-x-reverse">
                  <div>
                    <span class="block date-label">Start date</span>
                    <span class="block date-text">2022-10-03</span>
                  </div>
                  <div>
                    <span class="block date-label">Start date</span>
                    <span class="block date-text">2023-03-08</span>
                  </div>
                </div>
                <div class="ltr:text-right rtl:text-left text-xs text-slate-600 dark:text-slate-300 mb-1 font-medium">
                  50%
                </div>
                <div class="w-full bg-slate-200 h-2 rounded-xl overflow-hidden">
                  <div class="bg-primary-500 progress-bar h-full rounded-xl" style="width: 0%"></div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-6">
                  <div>
                    <div class="text-slate-400 dark:text-slate-400 text-sm font-normal mb-3">
                      Assigned to
                    </div>
                    <div class="flex justify-start -space-x-1.5 rtl:space-x-reverse">
                      <div class="h-6 w-6 rounded-full ring-1 ring-slate-100">
                        <img src="assets/images/post/c1.png" alt="Image" class="w-full h-full rounded-full">
                      </div>
                      <div class="h-6 w-6 rounded-full ring-1 ring-slate-100">
                        <img src="assets/images/post/c2.png" alt="Image" class="w-full h-full rounded-full">
                      </div>
                      <div class="h-6 w-6 rounded-full ring-1 ring-slate-100">
                        <img src="assets/images/post/c3.png" alt="Image" class="w-full h-full rounded-full">
                      </div>
                      <div class="bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-300 text-xs ring-2 ring-slate-100 dark:ring-slate-700 rounded-full h-6 w-6 flex flex-col justify-center items-center">
                        +2
                      </div>
                    </div>
                  </div>

                  <div class="ltr:text-right rtl:text-left">
                    <span class="inline-flex items-center space-x-1 bg-danger-500 bg-opacity-[0.16] text-danger-500 text-xs font-normal px-2 py-1 rounded-full rtl:space-x-reverse">
                      <span>
                        <iconify-icon icon="heroicons-outline:clipboard-list"></iconify-icon>
                      </span>
                      <span>2</span>
                      <span>days left</span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="card rounded-md bg-white dark:bg-slate-800 shadow-base custom-class card-body p-6">
                <header class="flex justify-between items-end">
                  <div class="flex space-x-4 items-center rtl:space-x-reverse">
                    <div class="flex-none">
                      <div class="h-10 w-10 rounded-md text-lg bg-slate-100 text-slate-900 dark:bg-slate-600 dark:text-slate-200 flex flex-col items-center justify-center font-normal capitalize">
                        Ma
                      </div>
                    </div>
                    <div class="font-medium text-base leading-6">
                      <div class="dark:text-slate-200 text-slate-900 max-w-[160px] truncate">
                        Management Dashboard
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="dropstart relative">
                      <button class="inline-flex justify-center items-center" type="button" id="tableDropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                        <iconify-icon class="text-xl ltr:ml-2 rtl:mr-2" icon="heroicons-outline:dots-vertical"></iconify-icon>
                      </button>
                      <ul class="dropdown-menu min-w-max absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                        <li>
                          <a href="project-details.html" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white
                   w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300  last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize  rtl:space-x-reverse">
                            <iconify-icon icon="heroicons-outline:eye"></iconify-icon>
                            <span>View</span></a>
                        </li>
                        <li>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#editModal" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                            <iconify-icon icon="clarity:note-edit-line"></iconify-icon>
                            <span>Edit</span></a>
                        </li>
                        <li>
                          <a href="#" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                            <iconify-icon icon="fluent:delete-28-regular"></iconify-icon>
                            <span>Delete</span></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </header>
                <div class="text-slate-600 dark:text-slate-400 text-sm pt-4 pb-8"></div>
                <div class="flex space-x-4 rtl:space-x-reverse">
                  <div>
                    <span class="block date-label">Start date</span>
                    <span class="block date-text">2022-10-03</span>
                  </div>
                  <div>
                    <span class="block date-label">Start date</span>
                    <span class="block date-text">2023-03-08</span>
                  </div>
                </div>
                <div class="ltr:text-right rtl:text-left text-xs text-slate-600 dark:text-slate-300 mb-1 font-medium">
                  50%
                </div>
                <div class="w-full bg-slate-200 h-2 rounded-xl overflow-hidden">
                  <div class="bg-primary-500 progress-bar h-full rounded-xl" style="width: 0%"></div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-6">
                  <div>
                    <div class="text-slate-400 dark:text-slate-400 text-sm font-normal mb-3">
                      Assigned to
                    </div>
                    <div class="flex justify-start -space-x-1.5 rtl:space-x-reverse">
                      <div class="h-6 w-6 rounded-full ring-1 ring-slate-100">
                        <img src="assets/images/post/c1.png" alt="Image" class="w-full h-full rounded-full">
                      </div>
                      <div class="h-6 w-6 rounded-full ring-1 ring-slate-100">
                        <img src="assets/images/post/c2.png" alt="Image" class="w-full h-full rounded-full">
                      </div>
                      <div class="h-6 w-6 rounded-full ring-1 ring-slate-100">
                        <img src="assets/images/post/c3.png" alt="Image" class="w-full h-full rounded-full">
                      </div>
                      <div class="bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-300 text-xs ring-2 ring-slate-100 dark:ring-slate-700 rounded-full h-6 w-6 flex flex-col justify-center items-center">
                        +2
                      </div>
                    </div>
                  </div>

                  <div class="ltr:text-right rtl:text-left">
                    <span class="inline-flex items-center space-x-1 bg-danger-500 bg-opacity-[0.16] text-danger-500 text-xs font-normal px-2 py-1 rounded-full rtl:space-x-reverse">
                      <span>
                        <iconify-icon icon="heroicons-outline:clipboard-list"></iconify-icon>
                      </span>
                      <span>2</span>
                      <span>days left</span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col lg:w-[576px] w-full pointer-events-auto bg-white bg-clip-padding
                                            rounded-md outline-none text-current">
              <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                  <h3 class="text-base font-medium text-white dark:text-white capitalize">
                    Patient data Update
                  </h3>
                  <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                                                        dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                  </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                  <form class="flex flex-col space-y-3">
                    <div class="input-area">
                      <div class="relative">
                        <input id="name" type="text" class="form-control pr-9" placeholder="Username">
                      </div>
                      <span id="nameErrorMsg" class="font-Inter text-sm text-danger-500 pt-2 hidden mt-1">This is valid state.</span>
                    </div>
                    <div class="flex items-center justify-between space-x-4">
                      <div class="w-full">
                        <label for="default-picker" class=" form-label">Start Date</label>
                        <input class="form-control py-2 flatpickr flatpickr-input active" id="default-picker" value="" type="text" readonly="readonly">
                      </div>
                      <div class="w-full">
                        <label for="default-picker" class=" form-label">End Date</label>
                        <input class="form-control py-2 flatpickr flatpickr-input active" id="default-picker" value="" type="text" readonly="readonly">
                      </div>
                    </div>
                    <div>
                      <label for="basicSelect" class="form-label">Assignee</label>
                      <select name="basicSelect" id="basicSelect" class="form-control w-full mt-2">
                        <option selected="Selected" disabled="disabled" value="none" class="select2 py-1 inline-block font-Inter font-normal text-sm text-slate-600">Select an option</option>
                        <option value="option1" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Jhon Doe</option>
                        <option value="option2" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Jhon Smith</option>
                        <option value="option3" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Grane Smith</option>
                      </select>
                    </div>
                    <div>
                      <label for="basicSelect" class="form-label">Tag</label>
                      <select name="basicSelect" id="basicSelect" class="form-control w-full mt-2">
                        <option selected="Selected" disabled="disabled" value="none" class="select2 py-1 inline-block font-Inter font-normal text-sm text-slate-600">Select an option</option>
                        <option value="option1" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Admin</option>
                        <option value="option2" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Dashboard</option>
                        <option value="option3" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">User Friendly</option>
                      </select>
                    </div>
                    <div>
                      <label for="description" class="form-label">Description</label>
                      <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="flex items-center justify-end rounded-b dark:border-slate-600">
                      <button data-bs-dismiss="modal" class="btn inline-flex justify-center text-white bg-black-500">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>
</div>




<div class="bg-white bg-no-repeat custom-dropshadow footer-bg dark:bg-slate-700 flex justify-around items-center
    backdrop-filter backdrop-blur-[40px] fixed left-0 bottom-0 w-full z-[9999] bothrefm-0 py-[12px] px-4 md:hidden">
  <a href="chat.html">
    <div>
      <span class="relative cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center mb-1 dark:text-white
          text-slate-900 ">
        <iconify-icon icon="heroicons-outline:mail"></iconify-icon>
        <span class="absolute right-[5px] lg:hrefp-0 -hrefp-2 h-4 w-4 bg-red-500 text-[8px] font-semibold flex flex-col items-center
            justify-center rounded-full text-white z-[99]">
          10
        </span>
      </span>
      <span class="block text-[11px] text-slate-600 dark:text-slate-300">
        Messages
      </span>
    </div>
  </a>
  <a href="profile.html" class="relative bg-white bg-no-repeat backdrop-filter backdrop-blur-[40px] rounded-full footer-bg dark:bg-slate-700
      h-[65px] w-[65px] z-[-1] -mt-[40px] flex justify-center items-center">
    <div class="h-[50px] w-[50px] rounded-full relative left-[0px] hrefp-[0px] custom-dropshadow">
      <img src="assets/images/users/user-1.jpg" alt="" class="w-full h-full rounded-full border-2 border-slate-100">
    </div>
  </a>
  <a href="#">
    <div>
      <span class=" relative cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center mb-1 dark:text-white
          text-slate-900">
        <iconify-icon icon="heroicons-outline:bell"></iconify-icon>
        <span class="absolute right-[17px] lg:hrefp-0 -hrefp-2 h-4 w-4 bg-red-500 text-[8px] font-semibold flex flex-col items-center
            justify-center rounded-full text-white z-[99]">
          2
        </span>
      </span>
      <span class=" block text-[11px] text-slate-600 dark:text-slate-300">
        Notifications
      </span>
    </div>
  </a>
</div>
</div>
</main>
<!-- scripts -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/rt-plugins.js"></script>
<script src="assets/js/app.js"></script>
</body>

</html>