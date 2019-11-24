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
$stmt = $product->techdataSearch($keywords);
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