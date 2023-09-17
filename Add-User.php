<?php
include("header.php");

if(isset($_POST["submit"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];;
  $password = $_POST["password"];
  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

  
  $namePattern= '/^(?=[a-zA-Z0-9._]{6,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/';
  $passwordPattern='/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+}{":;<>,.?~\\-]+$/';


  if (preg_match($namePattern, $name) &&
  filter_var($email, FILTER_VALIDATE_EMAIL) &&
  preg_match($passwordPattern, $password)) {
  
  $table = "admin";
  $data = array(
      "name" => $name,
      "email" => $email,
      "password" => $hashedPassword,
      "pass"=>$password
  );

  $db = new Database(); 
  $result = $db->insert($table, $data);

  if($result) {
      $success = "Registration successful!";

      echo"<script>
      setTimeout(function() {
                window.location.href='show-user.php';
            },  1000);
    </script>";

      
  } else {
      $failed = "Registration failed. Please try again.";
  }
} else {
  $failed = "Invalid input data. Please check your input.";
}
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




        <!-- END: BreadCrumb -->
        <div class="card">
          <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
              <div class="flex-1">
                <div class="card-title text-slate-900 dark:text-white">ADD USER IN ADMIN PANNEL</div>
              </div>
              <a href="show-user.php">
                <button class="btn inline-flex justify-center btn-outline-dark !bg-black-500 !text-white">
                  <span class="flex items-center">
                    <span>Show User</span>
                  </span>
                </button>
              </a>
            </header>
            <div class="card-text h-full ">
              <form method="post">
                <div class="from-group">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="input-area">
                      <label for="firstName" class="form-label">User Name</label>
                      <input id="firstName" type="text" name="name" class="form-control" placeholder="User Name" required>
                      <p style="color: red;"><?php echo @$nameerr ?></p>
                    </div>
                    <div class="input-area">
                      <label for="lastName" class="form-label">Email</label>
                      <input id="lastName" type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="flex justify-between items-end space-x-6">
                      <div class="input-area w-full">
                        <label for="phone" class="form-label">Password</label>
                        <input id="phone" type="password" name="password" class="form-control" placeholder="Password" required>
                        <p style="color: red;"><?php echo @$passerr ?></p>
                      </div>

                      <input class="btn flex justify-center btn-dark mt-5 ml-auto" name="submit" type="submit" value="Enter user">
                      <p style="color: green;"><?php echo @$success ?></p>

                    </div>
                  </div>
                </div>
              </form>
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
  <a href="#" class="relative bg-white bg-no-repeat backdrop-filter backdrop-blur-[40px] rounded-full footer-bg dark:bg-slate-700
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