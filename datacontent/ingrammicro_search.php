<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/content.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new DataContent($db);
 
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
 
// query products
$stmt = $product->ingramMicroSearch($keywords);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $products_arr=array();
    $products_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $product_item=array(
            "product_name" => $product_name, 
            "product_desc" => $product_desc, 
            "manufacturer" => $manufacturer, 
            "ingram_item_number" => $ingram_item_number, 
            "weight" => $weight, 
            "length" => $length, 
            "width" => $width, 
            "height" => $height, 
            "msrp" => substr($msrp, -9), 
            "ingram_cost" => substr($ingram_cost, -9), 
            "sku" => $sku, 
            "upc" => $upc
        );
 
        array_push($products_arr["records"], $product_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data
    echo json_encode($products_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>