
<?php 

include 'config.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image'];
    $writer = $_POST['writer'];

    if ($image['error'] === UPLOAD_ERR_OK) {
        $img_name = $image['name'];
        $img_tmp = $image['tmp_name'];

        $upload_path = 'images/' . $img_name;
        move_uploaded_file($img_tmp, $upload_path);

        $insert_result = $db->insert('books', [
            'name' => $name,
            'writer'=>$writer,
            '`desc`' => $description, 
            'image' => $img_name
        ]);

        $response = array();

        if ($insert_result) {
            $response['success'] = true;
            $response['message'] = 'Data inserted successfully.';
        } else {
            $response['message'] = 'Error inserting data.';
        }
    } else {
        $response['message'] = 'Image upload error.';
    }

    echo json_encode($response);
    // var_dump($insert_result);
}
?>


