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
$stmt = $product->dandhSearch($keywords);
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
            "dh_item_number" => $dh_dh_item_number, 
            "short_description" => $dh_short_description, 
            "long_description" => $dh_long_description, 
            "vendor_name" => $dh_vendor_name, 
            "manuF_item_number" => $dh_manuF_item_number, 
            "freight" => $dh_freight, 
            "weight" => $dh_weight, 
            "qty_avail_all_aranches" => $dh_qty_avail_all_aranches, 
            "unit_cost" => $dh_unit_cost, 
            "est_retail_price" => $dh_est_retail_price, 
            "map_price" => $dh_map_price, 
            "rebatea_mount" => $dh_rebatea_mount, 
            "upc" => $dh_upc
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