<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/content.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new DataContent($db);
 
// set ID property of record to read
$product->master_id = isset($_GET['master_id']) ? $_GET['master_id'] : die();
 
// read the details of product to be edited
$product->readOne();
 
if($product->sku!=null){
    // create array
    $product_arr = array(
        "master_id" => $product->master_id,
        "sku" => $product->sku,
            "upc" => $product->upc,
            "manufacturer" => $product->manufacturer,
            "product_name" => html_entity_decode($product->product_name),
            "msrp" => $product->msrp,
            "length" => $product->length,
            "height" => $product->height,
            "weight" => $product->weight,
            "width" => $product->width,
            "mapping" => $product->mapping,
            "techdata_item_name" => $product->techdata_item_name,
            "techdata_qty" => $product->techdata_qty,
            "techdata_cost" => $product->techdata_cost,
            "ingram_item_name" => $product->ingram_item_name,
            "ingram_qty" => $product->ingram_qty,
            "ingram_cost" => $product->ingram_cost,
            "dandh_item_name" => $product->dandh_item_name,
            "dandh_qty" => $product->dandh_qty,
            "dandh_cost" => $product->dandh_cost,
            "imageUpdateStatus" => $product->imageUpdateStatus
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($product_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>