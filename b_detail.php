<?php
include "header.php";
$db = new Database();

// yaha pa ham na pahaly user_id get ki h asession sa 


$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// yaha pa ya query ah jo live date show krti ha 
$b_date = date('Y-m-d');

// yaha pa ham na phalay table call kia ha ous ka bad ham na is pa result ma id or name
//  get kia ha jb book borrow karay ga to ous ma bd ham na is ma data

// yaha pa ham na data get ka lia query likhi ha

$tableName = "user";
$columnsToSelect = "ID, NAME";

$result = $db->select($tableName, $columnsToSelect);


// yaha pa ham na agar user_type agar admin ya librearian hoti ha to ham yaha pa ham is ko access kr saktay ha 
// ham is ka andr user id ko get kr ka ham book borrow kr saktay ha user ka id pa book borrow kr saktay ha 

if($user_type == 'admin' || $user_type == 'librarian'){

    
    if (isset($_POST['borrow'])) {
        $id_user=$_POST['id_user'];
        $bookId = $_GET['id'];
        $returnDate = $_POST['returnDate'];

        $sql = "UPDATE books SET user_id = ?, b_date = ?, r_date = ?, btn = 1 WHERE id = ?";
        $stmt = $db->getMysqli()->prepare($sql);
        $stmt->bind_param("issi", $id_user, $b_date, $returnDate, $bookId );

        if ($stmt->execute()) {
            // echo "Book borrowed successfully on $b_date. Please return by $returnDate.";
        }

    } elseif (isset($_POST['return'])) {
        $bookId = $_GET['id'];
        $sql = "UPDATE books SET user_id = NULL, b_date = NULL, r_date = NULL, btn = 0 WHERE id = $bookId";

        if ($db->getMysqli()->query($sql)) {
            // echo "Book returned successfully on $returnDate.";
        }
    }

}


// agar user_type user ha to ham na is ka andar user jo current login ho ga vo apnay id sa book brrow kr sakta ha 

if($user_type == 'user'){

    if (isset($_POST['borrow'])) {
        $newUserId = $userId;
        $bookId = $_GET['id'];
        $returnDate = $_POST['returnDate'];

        $sql = "UPDATE books SET user_id = ?, b_date = ?, r_date = ?, btn = 1 WHERE id = ?";
        $stmt = $db->getMysqli()->prepare($sql);
        $stmt->bind_param("issi", $newUserId, $b_date, $returnDate, $bookId);

        if ($stmt->execute()) {
            // echo "Book borrowed successfully on $b_date. Please return by $returnDate.";
        }

    } elseif (isset($_POST['return'])) {
        $bookId = $_GET['id'];
        $sql = "UPDATE books SET user_id = NULL, b_date = NULL, r_date = NULL, btn = 0 WHERE id = $bookId";

        if ($db->getMysqli()->query($sql)) {
            // echo "Book returned successfully on $returnDate.";
        }
    }
}


// yaha pa ham na book ki id ko get kia ha or yaha pa ham na fetch kia ha book ki detail ko 

$book = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $bookResult = $db->select("books", "*", "id = $id");

    if ($bookResult) {
        $book = $bookResult->fetch_assoc();

        if (!$book) {
            // echo "Book not found or there was an error.";
        }
    }
}

// yaha pa ham na session sa user_type ko get kia ha   

$usertype = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : '';

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
            <div class="tab-content mt-6" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                    <div class="tab-content">
                        <div class="card">
                            <div class="card-body px-6 rounded overflow-hidden">
                                <div class="overflow-x-auto -mx-6">
                                    <div class="inline-block min-w-full align-middle">
                                        <div class="overflow-hidden ">
                                            <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 ">
                                                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                                    <div class="card">
                                                        <div class="card-body flex flex-col p-6">
                                                            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                                                <div class="flex-1">
                                                                    <div class="card-title text-slate-900 dark:text-white">Book Detail</div>
                                                                </div>
                                                            </header>
                                                            <div class="card-text h-full space-y-4">
                                                                <div class="input-area">

                                                                <!-- yaha pa ham na data fetch kia ha book ka  -->
                                                                    <h3>BOOK NAME : <?php echo $book['name']?></h3><br>
                                                                    <h5>AUTHER NAME : <?php echo $book['writer']?></h5><br>
                                                                </div>
                                                                <div class="image-box mb-6">
                                                                    <!-- yaha pa ham na image ko fetch kia ha  -->
                                                                    <?php $imageUrl = "images/" . $book['image']; ?>
                                                                    <img style="width: 17%; height:100%" src="<?php echo $imageUrl; ?>" alt="" class="block w-full h-full object-cover rounded-md">
                                                                </div><br>
                                                                <h6>BOOK DESCRIPTION : </h6>
                                                                <h6><?php echo $book['desc']; ?></h6>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </tbody>
                                            </table>
                                            <div class="card-text h-full space-y-6">
                        
                                          
                                                            <div class="container">
                                                                <div class="container">
                                                                <form method="post">
                                                                    <!-- yaha pa aagar ap ki user_type admin ha ya phr librarian ha to ap ko ya drop down show ho 
                                                                    ga ya phr agar ap ka btn status == 0 ha to ap ko broow vala option show karay ga agar 1 ha to ap ko vaha pa return button show ho ga  -->
                                                                    <?php if($user_type === 'admin' || $user_type === 'librarian'){?>

                                                                        <?php if ($book['btn'] == '0') { ?>

                                                                <div class="grid md:grid-cols-2 gap-6">
                                                                    <div>
                                                                        <label for="basicSelect" class="form-label">SELECT USER NAME</label>
                                                                        <select name="id_user" id="basicSelect" name="" class="form-control w-full mt-2">
                                                                        <option  selected="Selected" disabled="disabled" value="" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Select an option</option>
                                                                            <!-- yaha pa ham na loop ma drop down ma user ka all data fetch kia ha  -->
                                                                        <?php while($rowUser = $result->fetch_assoc() ){?>
                                                                            <option id="u_id" value="<?php echo $rowUser['ID'] ?>" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600"><?php echo $rowUser['NAME'] ?></option>
                                                                        <?php }?>

                                                                        </select>
                                                                    </div>
                                                                </div><br>
                                                                <?php }?>

                                                                    <?php }?>
                                                                    <!-- yaha pa bhi agar ap ki book ka btn ki == 0 karay ga to ya borow form show ho ga agar ==1 hua to ap ko return button show karay ga   -->
                                                                        <?php if ($book['btn'] == '0') { ?>
                                                                            <label for="borrowDate" class="form-label">BORROW DATE</label>
                                                                            <input id="borrowDate" type="date" name="borrowDate" class="form-control" placeholder="Borrow Date" value="<?php echo $b_date; ?>" disabled><br>
                                                                            <label for="returnDate" class="form-label">RETURN DATE</label>
                                                                            <input id="returnDate" type="date" name="returnDate" class="form-control" placeholder="Return Date" required>
                                                                            <p style="color: red;"><?php echo @$error ?></p> <br>
                                                                            <?php } ?>

                                                                                <!-- yaha pa agar status 1 ha to yaha pa ham hamay borrow vala button show ho ga or agar 0 hua to yaha pa button show ni ho ga  -->
                                                                            <?php if($book['status'] == '1'){ ?>
                                                                                
                                                                            
                                                                                <!-- agar hamari book ka btn data 0 ha to hamay brrow ka button show ho ga agar 0 hua to return ka butoon show ho ga  -->
                                                                                <?php if ($book['btn'] == '0') { ?>
                                                                                    <input type="submit" value="borrow" ref="index.php" name="borrow" class="btn inline-flex justify-center btn-outline-success capitalize"></input>
                                                                                <?php } ?>

                                                                                <?php if ($book['btn'] == '1') { ?>
                                                                                    <input type="submit" name="return" value="Return" class="btn inline-flex justify-center btn-outline-danger capitalize"></input>
                                                                                <?php } ?>


                                                                            <br><br>
                                                                        </div>
                                                                    </div>
                                                                    <?php }
                                                                                else{
                                                                                    echo "<h2 style='text-align: center;'>Book not available at that time</h2>";
                                                                                }?><br><br><br>
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
</div>

<!-- scripts -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/rt-plugins.js"></script>
<script src="assets/js/app.js"></script>

</body>

</html>
