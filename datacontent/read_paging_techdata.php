<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/content.php';
 
// utilities
$utilities = new Utilities();
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new DataContent($db);
 
// query products
$stmt = $product->readTechdataPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $products_arr=array();
    $products_arr["records"]=array();
    $products_arr["paging"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $product_item=array(
            "matnr" => $matnr, 
            "shortdescription" => $shortdescription, 
            "longdescription" => $longdescription, 
            "manufpartNo" => $manufpartNo, 
            "manufacturer" => $manufacturer, 
            "manufacturerglobaldescr" => $manufacturerglobaldescr, 
            "gtin" => $gtin, 
            "prodfamilyid" => $prodfamilyid, 
            "prodfamily" => $prodfamily, 
            "prodclassid" => $prodclassid, 
            "prodclass" => $prodclass, 
            "prodsubclassid" => $prodsubclassid, 
            "prodsubclass" => $prodsubclass, 
            "articlecreationdate" => $articlecreationdate, 
            "cnetavailable" => $cnetavailable, 
            "cnetid" => $cnetid, 
            "listprice" => $listprice, 
            "weight" => $weight, 
            "length" => $length, 
            "width" => $width, 
            "heigth" => $heigth, 
            "noreturn" => $noreturn, 
            "enduserinformation" => $enduserinformation, 
            "freightpolicyexception" => $freightpolicyexception,
            "mat_grp" => $mat_grp, 
            "prodhierdescr" => $prodhierdescr, 
            "country_origin" => $country_origin, 
            "sale_status" => $sale_status, 
            "sale_status_decr" => $sale_status_decr, 
            "qty" => $qty, 
            "vsiqty" => $vsiqty, 
            "custbestprice" => $custbestprice, 
            "promotion" => $promotion, 
            "unpromotedprice" => $unpromotedprice, 
            "validto" => $validto
           /* "id" => $td_id,
            "matnr" => $td_matnr,*/
            /*"td_product_details" => str_replace("\r\n", "<br/>", $td_product_details)*/
        );
 
        array_push($products_arr["records"], $product_item);
    }
 
 
    // include paging
    $total_rows=$product->count();
    $page_url="http://localhost:999/datamanagement/product/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $products_arr["paging"]=$paging;
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($products_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user products does not exist
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>