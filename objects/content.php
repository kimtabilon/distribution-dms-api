<?php
class DataContent{
 
    // database connection and table name
    private $conn;
    private $table_name = "dm_distribution_data_content";
 
    // object properties
    //data content
    public $id;
    public $master_id;
    public $sku;
    public $upc;
    public $manufacturer;
    public $product_name;
    public $msrp;
    public $techdata_item_name;
    public $techdata_qty;
    public $techdata_cost;
    public $ingram_item_name;
    public $ingram_qty;
    public $ingram_cost;
    public $dandh_item_name;
    public $dandh_qty;
    public $dandh_cost;
    public $length;
    public $height;
    public $weight;
    public $width;
    public $mapping;
    public $prd;
    public $techdata_info;
    public $ingram_info;
    public $dandh_info;
    public $imageUpdateStatus;

// test
    public $name;
    public $short_description;
    public $information;
    public $specification;
    public $description;
    public $category_id;
    public $category_name;
    public $image;

    // techdata
    public $td_id;
    public $td_matnr;
    public $td_shortdescription;
    public $td_longdescription;
    public $td_manufpartNo;
    public $td_manufacturer;
    public $td_manufacturerglobaldescr;
    public $td_gtin;
    public $td_prodfamilyid;
    public $td_prodfamily;
    public $td_prodclassid;
    public $td_prodclass;
    public $td_prodsubclassid;
    public $td_prodsubclass;
    public $td_articlecreationdate;
    public $td_cnetavailable;
    public $td_cnetid;
    public $td_listprice;
    public $td_weight;
    public $td_length;
    public $td_width;
    public $td_heigth;
    public $td_noreturn;
    public $td_mayrequireauthorization;
    public $td_enduserinformation;
    public $td_freightpolicyexception;
    public $td_mat_grp;
    public $td_prodhierdescr;
    public $td_country_origin;
    public $td_sale_status;
    public $td_sale_status_decr;
    public $td_manufPartNo;
    public $td_qty;
    public $td_vsiqty;
    public $td_custbestprice;
    public $td_promotion;
    public $td_unpromotedprice;
    public $td_validto;
    public $td_product_details;

    //IngramMicro
    public $im_id;
    public $im_column_dc;
    public $im_ingram_item_number;
    public $im_column_fourchar;
    public $im_manufacturer;
    public $im_product_name;
    public $im_product_desc;
    public $im_msrp;
    public $im_sku;
    public $im_weight;
    public $im_upc;
    public $im_length;
    public $im_width;
    public $im_height;
    public $im_column_one;
    public $im_ingram_cost;
    public $im_column_two;
    public $im_ingram_qty;
    public $im_column_three;
    public $im_column_four;
    public $im_column_five;
    public $im_column_six;
    public $im_column_seven;
    public $im_column_eight;
    public $im_column_nine;
    public $im_product_details;

    //Dandh
    public $dh_id;
    public $dh_stock_status;
    public $dh_qty_avail_all_aranches;
    public $dh_rebate_flag;
    public $dh_rebate_end_date;
    public $dh_dh_item_number;
    public $dh_manuF_item_number;
    public $dh_upc;
    public $dh_subcategory_code;
    public $dh_vendor_name;
    public $dh_unit_cost;
    public $dh_rebatea_mount;
    public $dh_handling_charge;
    public $dh_freight;
    public $dh_ship_via;
    public $dh_weight;
    public $dh_short_description;
    public $dh_long_description;
    public $dh_est_retail_price;
    public $dh_map_price;
    public $dh_ca_proposition_warning_type;
    public $dh_ca_proposition_abel_type;
    public $dh_ca_proposition_message_text;
    public $dh_product_details;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


// used when filling up the update product form
function readOne(){
 
    // query to read single record
    $query = "SELECT
                master_id, sku, upc, manufacturer, product_name, length, width, height, weight, mapping, msrp, techdata_item_name, techdata_qty, techdata_cost, ingram_item_name, ingram_qty, ingram_cost, dandh_item_name, dandh_qty, dandh_cost, imageUpdateStatus
            FROM
                " . $this->table_name . "
            WHERE
                master_id = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->master_id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->sku = $row['sku'];
    $this->upc = $row['upc'];
    $this->manufacturer = $row['manufacturer'];
    $this->product_name = $row['product_name'];
    $this->msrp = $row['msrp'];
    $this->length = $row['length'];
    $this->height = $row['height'];
    $this->weight = $row['weight'];
    $this->width = $row['width'];
    $this->mapping = $row['mapping'];
    $this->techdata_item_name = $row['techdata_item_name'];
    $this->techdata_qty = $row['techdata_qty'];
    $this->techdata_cost = $row['techdata_cost'];
    $this->ingram_item_name = $row['ingram_item_name'];
    $this->ingram_qty = $row['ingram_qty'];
    $this->ingram_cost = $row['ingram_cost'];
    $this->dandh_item_name = $row['dandh_item_name'];
    $this->dandh_qty = $row['dandh_qty'];
    $this->dandh_cost = $row['dandh_cost'];
    $this->imageUpdateStatus = $row['imageUpdateStatus'];
}

// update the product
function update(){
 
    // update query
   /* $query = "UPDATE
                " . $this->table_name . "
            SET
                sku = :sku,
                upc = :upc
            WHERE
                master_id = :master_id";*/

      $query = "UPDATE
                " . $this->table_name . "
            SET
                isManualUpdate = '1',
                imageUpdateStatus = 'On Process',
                mapping = :mapping
            WHERE
                master_id = :master_id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->sku=htmlspecialchars(strip_tags($this->sku));
    $this->upc=htmlspecialchars(strip_tags($this->upc));
    $this->master_id=htmlspecialchars(strip_tags($this->master_id));
 
    // bind new values
  /*  $stmt->bindParam(':sku', $this->sku);
    $stmt->bindParam(':upc', $this->upc);*/
    $stmt->bindParam(':mapping', $this->mapping);
    $stmt->bindParam(':master_id', $this->master_id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

// search products
function search($keywords){
 
    // select all query
    $query = "SELECT 
                master_id, sku, upc, manufacturer, product_name, concat('$',msrp)msrp, concat('Techdata #: ', techdata_item_name, '| QTY: ', techdata_qty, '| $', techdata_cost)techdata_info, concat('Ingrammicro #: ', ingram_item_name, '| QTY: ', ingram_qty, '| $', ingram_cost)ingram_info, concat('Dandh #: ', dandh_item_name, '| QTY: ', dandh_qty, '| $', dandh_cost)dandh_info, length, width, height, weight, mapping, imageUpdateStatus
            FROM
                " . $this->table_name . "
            WHERE
                sku LIKE ?
            ORDER BY
                sku DESC LIMIT 0, 10";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
/*    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);*/
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

// read products with pagination
public function readPaging($from_record_num, $records_per_page){
 
    // select query
    $query = "SELECT 
                master_id, sku, upc, manufacturer, product_name, concat('$',msrp)msrp, concat('Techdata #: ', techdata_item_name, '\r\n', 'QTY: ', techdata_qty, '\r\n', '$', techdata_cost)techdata_info, concat('Ingrammicro #: ', ingram_item_name, '\r\n', 'QTY: ', ingram_qty, '\r\n', '$', ingram_cost)ingram_info, concat('Dandh #: ', dandh_item_name, '\r\n', 'QTY: ', dandh_qty, '\r\n', '$', dandh_cost)dandh_info, length, width, height, weight, mapping, imageUpdateStatus
            FROM
                " . $this->table_name . "
            ORDER BY master_id DESC
            LIMIT 0, 10";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values from database
    return $stmt;
}

// used for paging products
public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    return $row['total_rows'];
}

// read techdata products with pagination
public function readTechdataPaging($from_record_num, $records_per_page){
 
    // select query
    $query = "SELECT mtr.matnr, shortdescription, longdescription, mtr.manufpartNo, manufacturer, manufacturerglobaldescr, mtr.gtin, prodfamilyid, prodfamily, prodclassid, prodclass, prodsubclassid, prodsubclass, articlecreationdate, cnetavailable, cnetid, listprice, weight, length, width, heigth, noreturn, enduserinformation, freightpolicyexception, mat_grp, prodhierdescr, country_origin, sale_status, sale_status_decr, avl.qty, avl.vsiqty, prc.custbestprice, prc.promotion, prc.unpromotedprice, prc.validto
        FROM dm_distribution_techdata_material mtr 
        inner join dm_distribution_techdata_availability avl on mtr.matnr = avl.matnr 
        inner join dm_distribution_techdata_price prc on mtr.matnr = prc.matnr LIMIT 0, 10";

        /*$query = "SELECT concat(longdescription, '\r\n', 'Short Desc: ', shortdescription, '\r\n', 'Manu #: ', mtr.manufpartNo, '| Manufacturer: ', manufacturer, '| Manu Global Desc: ', manufacturerglobaldescr, '| GTIN: ', mtr.gtin, '\r\n', 'Product Family ID: ', prodfamilyid, '| Product family: ', prodfamily, '\r\n', 'Product Class ID: ', prodclassid, '| Product Class: ', prodclass, '\r\n', 'Product SubClass ID: ', prodsubclassid, '| Product SubClass: ', prodsubclass, '\r\n', 'Article Creation Date: ', articlecreationdate, '\r\n', 'CNET Available: ', cnetavailable, '| CNET ID: ', cnetid, '| List Price: ', listprice, '\r\n', 'Weight: ', weight, '| Lenght: ', length, '| Width: ',width,'| Height: ', heigth, '| No Return: ', noreturn, '\r\n', 'End User Info: ', enduserinformation, '| Freight Policy Exception: ', freightpolicyexception, '| Mat GRP: ', mat_grp, '\r\n', 'Prod Hier Descr: ', prodhierdescr, '| Country Origin: ', country_origin, '\r\n', 'Sale Status: ', sale_status, '| Sale Status Descr: ', sale_status_decr, '\r\n', 'QTY: ', avl.qty, '| VSI QTY: ', avl.vsiqty, '| Customer Best Price: ', prc.custbestprice, '\r\n', 'Promotion: ', prc.promotion, '| Unpromoted Price: ', prc.unpromotedprice, '| Valid To: ', prc.validto, '\r\n', '\r\n', 'SKU: ', mtr.matnr)td_product_details
        FROM dm_distribution_techdata_material mtr 
        inner join dm_distribution_techdata_availability avl on mtr.matnr = avl.matnr 
        inner join dm_distribution_techdata_price prc on mtr.matnr = prc.matnr LIMIT 0, 5";*/
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values from database
    return $stmt;
}

// search products
function techdataSearch($keywords){
 
    // select all query
    $query = "SELECT mtr.matnr, shortdescription, longdescription, mtr.manufpartNo, manufacturer, manufacturerglobaldescr, mtr.gtin, prodfamilyid, prodfamily, prodclassid, prodclass, prodsubclassid, prodsubclass, articlecreationdate, cnetavailable, cnetid, listprice, weight, length, width, heigth, noreturn, enduserinformation, freightpolicyexception, mat_grp, prodhierdescr, country_origin, sale_status, sale_status_decr, avl.qty, avl.vsiqty, prc.custbestprice, prc.promotion, prc.unpromotedprice, prc.validto
        FROM dm_distribution_techdata_material mtr 
        inner join dm_distribution_techdata_availability avl on mtr.matnr = avl.matnr 
        inner join dm_distribution_techdata_price prc on mtr.matnr = prc.matnr
            WHERE
                mtr.matnr LIKE ?
            ORDER BY
                mtr.matnr DESC LIMIT 0, 10";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
/*    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);*/
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}


// read ingrammicro products with pagination
public function readIngramMicroPaging($from_record_num, $records_per_page){
 
    // select query
    $query = "SELECT product_name, product_desc, manufacturer, ingram_item_number, weight, length, width, height, msrp, ingram_cost, sku, upc
        FROM dm_distribution_ingram_micro 
        LIMIT 0, 10";

        /*$query = "SELECT concat(product_name, '\r\n', product_desc, '\r\n', 'Manufacturer: ', manufacturer, '\r\n', 'Ingrammicro Item #: ', ingram_item_number, ' | ', column_fourchar, '\r\n', 'Weight: ', weight, ' | Length: ', length, ' | Width: ', width, ' | Height', height, '\r\n', 'MSRP: ', msrp, ' | Cost: ', ingram_cost, '\r\n', '\r\n', 'SKU: ', sku, ' | UPC: ', upc)im_product_details
        FROM dm_distribution_ingram_micro 
        LIMIT 0, 10";*/
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values from database
    return $stmt;
}   

// ingram search products
function ingramMicroSearch($keywords){
 
    // select all query
    $query = "SELECT product_name, product_desc, manufacturer, ingram_item_number, weight, length, width, height, msrp, ingram_cost, sku, upc
        FROM dm_distribution_ingram_micro 
            WHERE
                sku LIKE ?
            ORDER BY
                sku DESC LIMIT 0, 10";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
/*    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);*/
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

// read dandh products with pagination
public function readDandhPaging($from_record_num, $records_per_page){
 
    // select query
    $query = "SELECT dh_item_number dh_dh_item_number, short_description dh_short_description, long_description dh_long_description, vendor_name dh_vendor_name, manuF_item_number dh_manuF_item_number, freight dh_freight, weight dh_weight, qty_avail_all_aranches dh_qty_avail_all_aranches, unit_cost dh_unit_cost, est_retail_price dh_est_retail_price, map_price dh_map_price, rebatea_mount dh_rebatea_mount, handling_charge, upc dh_upc
        FROM dm_distribution_dandh 
        LIMIT 0, 10";

    /*$query = "SELECT short_description, concat(short_description, '\r\n', 'Description: ', long_description, '\r\n', 'Vendor Name: ', vendor_name, ' | Manufacturer Item #: ', manuF_item_number, '\r\n', 'Freight: ', freight, ' | Weight: ', weight, '\r\n', 'QTY: ', qty_avail_all_aranches, ' | Unit Cost; ', unit_cost, ' | EST Retail Price: ', est_retail_price, ' | Map Price: ', map_price, '\r\n', '\r\n', 'Dandh Item #: : ', dh_item_number, ' | UPC: ', upc)dh_product_details
        FROM dm_distribution_dandh 
        LIMIT 0, 10";*/
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values from database
    return $stmt;
}

// ingram search products
function dandhSearch($keywords){
 
    // select all query
    $query = "SELECT dh_item_number dh_dh_item_number, short_description dh_short_description, long_description dh_long_description, vendor_name dh_vendor_name, manuF_item_number dh_manuF_item_number, freight dh_freight, weight dh_weight, qty_avail_all_aranches dh_qty_avail_all_aranches, unit_cost dh_unit_cost, est_retail_price dh_est_retail_price, map_price dh_map_price, rebatea_mount dh_rebatea_mount, handling_charge, upc dh_upc
        FROM dm_distribution_dandh 
            WHERE
                dh_item_number LIKE ?
            ORDER BY
                dh_item_number DESC LIMIT 0, 10";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
/*    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);*/
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

}