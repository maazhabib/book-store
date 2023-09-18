<?php
include "header.php";
// include "config.php";
// session_start();
$db = new Database();

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$b_date = date('Y-m-d');

$checkColumnQuery = "SHOW COLUMNS FROM books LIKE 'borrow_date'";
$columnResult = $db->getMysqli()->query($checkColumnQuery);

if ($columnResult->num_rows === 0) {
    $addColumnQuery = "ALTER TABLE books ADD borrow_date DATE";
    $db->getMysqli()->query($addColumnQuery);
}

if (isset($_POST['borrow'])) {
    $newUserId = $userId;
    $bookId = $_GET['id'];
    $returnDate = $_POST['returnDate'];

    $sql = "UPDATE books SET user_id = ?, b_date = ?, r_date = ?, btn = 1 WHERE id = ?";
    $stmt = $db->getMysqli()->prepare($sql);
    $stmt->bind_param("issi", $newUserId, $b_date, $returnDate, $bookId);

    if ($stmt->execute()) {
        // echo "Book borrowed successfully on $b_date. Please return by $returnDate.";
    } else {
        // echo "Error updating the table for borrowing: " . $db->getMysqli()->error;
    }
} elseif (isset($_POST['return'])) {
    $bookId = $_GET['id'];
    $sql = "UPDATE books SET user_id = NULL, b_date = NULL, r_date = NULL, btn = 0 WHERE id = $bookId";

    if ($db->getMysqli()->query($sql)) {
        // echo "Book returned successfully on $returnDate.";
    } else {
        // echo "Error updating the table for returning: " . $db->getMysqli()->error;
    }
}

$book = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $bookResult = $db->select("books", "*", "id = $id");

    if ($bookResult) {
        $book = $bookResult->fetch_assoc();

        if (!$book) {
            // echo "Book not found or there was an error.";
        }
    } else {
        // echo "Error fetching book details from the database.";
    }
}

// Check if the user is an admin, librarian, or regular user
$userRole = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : '';

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
                                                                    <h3>BOOK NAME : <?php echo $book['name']?></h3><br>
                                                                    <h5>AUTHER NAME : <?php echo $book['writer']?></h5><br>
                                                                </div>
                                                                <div class="image-box mb-6">
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
                                            <?php
                                                if ($userRole === 'user' ) {
                                                    if($book['status'] == '1'){
                                                    // echo "<h2 style='text-align: center;'>BORROW BOOK</h2><br>";
                                            ?>
                                            <div class="container">
                                                <div class="container">
                                                    <form method="post">
                                                        <?php if ($book['btn'] == '0') { ?>
                                                            <label for="borrowDate" class="form-label">BORROW DATE</label>
                                                            <input id="borrowDate" type="date" name="borrowDate" class="form-control" placeholder="Borrow Date" value="<?php echo $b_date; ?>" disabled><br>
                                                            <label for="returnDate" class="form-label">RETURN DATE</label>
                                                            <input id="returnDate" type="date" name="returnDate" class="form-control" placeholder="Return Date" required>
                                                            <p style="color: red;"><?php echo @$error ?></p> <br>
                                                        <?php } ?>

                                                        <?php if ($book['status'] == '1') { ?>

                                                            <?php if ($book['btn'] == '0') { ?>
                                                                <input type="submit" value="borrow" ref="index.php" name="borrow" class="btn inline-flex justify-center btn-outline-success capitalize"></input>
                                                            <?php } ?>

                                                            <?php if ($book['btn'] == '1') { ?>
                                                                <input type="submit" name="return" value="Return" class="btn inline-flex justify-center btn-outline-danger capitalize"></input>
                                                            <?php } ?>

                                                        <?php } ?>

                                                        <br><br>
                                                    </form>
                                                </div>
                                            </div>
                                            <?php }
                                            else{
                                                echo "<h2 style='text-align: center;'>Book not available</h2>";
                                                
                                            }} else {
                                                echo "<h2 style='text-align: center;'>Book borrowing is only available to users.</h2>";
                                            } ?><br><br><br>
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
