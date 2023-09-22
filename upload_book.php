<!-- yaha pa ham na phalay data yaha pa phlay call kia phe is ma na yaha pa get kia server sa phr 
ham na data get kia phr ham na ous ma data dal ka vapis ousi page pa bhaj dia -->

<!-- $_SERVER[]  (to know about the request method (for example GET, POST, PUT, etc) that is used to access the page) -->
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

        // yaha pa agar hamri query seccesfuly run krti ha to yaha pa hamay msg show ho jay ga

        if ($insert_result) {
            $response['success'] = true;
            $response['message'] = 'Data inserted successfully.';
        } else {
            $response['message'] = 'Error inserting data.';
        }
    } else {
        $response['message'] = 'Image upload error.';
    }

    // yaha json_encode hamaray data ko agar array ma ha ya object ya isa json ma convert kr k a bhj raha ha

    // json_encode  (to convert PHP array or object into JSON representation)

    echo json_encode($response);
    // var_dump($insert_result);
}
?>


