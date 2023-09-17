<?php
include("header.php");


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
<!-- END: Search Modal -->
<!-- END: Header -->
<!-- END: Header -->
<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
  <div class="page-content">
    <div class="transition-all duration-150 container-fluid" id="page_layout">
      <div id="content_layout">




        <!-- END: BreadCrumb -->
        <div class="card">
          <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
              <div class="flex-1">
                <div class="card-title text-slate-900 dark:text-white">ADD BOOKS</div>
              </div>
              <a href="book-detail.php">
                <button class="btn inline-flex justify-center btn-outline-dark !bg-black-500 !text-white">
                  <span class="flex items-center">
                    <span>Show books</span>
                  </span>
                </button>
              </a>
            </header>
            <div class="card-text h-full ">
              <form id="add-data" method="post" enctype="multipart/form-data">
                <div class="from-group">
                <div class="grid grid-cols-1  gap-6">
                    <div class="input-area">
                      <label for="firstName" class="form-label">Auther Name</label>
                      <input id="firstName" type="text" name="writer" class="form-control" placeholder="auther Name" required>
                    </div>
                  <div class="grid grid-cols-1  gap-6">
                    <div class="input-area">
                      <label for="firstName" class="form-label">Book Name</label>
                      <input id="firstName" type="text" name="name" class="form-control" placeholder="Book Name" required>
                    </div>
                    <div class="input-area">
                      <label for="lastName" class="form-label">Description</label>
                      <input id="lastName" type="text" name="description" class="form-control" placeholder="Description" required>
                    </div>
                    <div class="flex justify-between items-end space-x-6">
                      <div class="input-area w-full">
                        <label for="phone" class="form-label">Book Image</label>
                        <input id="phone" type="file" name="image" class="form-control" placeholder="Iaage" required>
                    
                      </div>

                      <input class="btn flex justify-center btn-dark mt-5 ml-auto" name="send" type="submit" value="Enter Book">
                      <div id="image-preview"></div>
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
<<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
      
$(document).ready(function() {
    $('#image').change(function() {
        var input = this;   
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').html('<img style="width: 100px;" src="' + e.target.result + '" alt="img">');
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    $('#add-data').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        console.log(formData)

        $.ajax({
            url: 'upload_book.php', 
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(insert_result) {
              console.log(insert_result);

                $(document).ready(function() {
                    var message = "Add Data successfully";
                    $("#content").before("<div class='message'>" + message + "</div>");
                });
                
                setTimeout(()=>{
                window.location.href='book-detail.php'
                },2000)
                
                if (insert_result.success) {
                    $('#success-message').text(insert_result.message).css('color', 'green');
                    
                } else {
                    $('#error-message').text(insert_result.message).css('color', 'red');
                }
            },
            error: function( status, error) {
                $('#error-message').text("An error occurred: " + error).css('color', 'red');
            }

        });
    });
});
</script>
</body>

</html>