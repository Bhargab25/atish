 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$model = new usermodel();


if(isset($_SESSION['userid'])){
    $getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
    if($getuserdetails->UTYPE == 'ADMIN'){
        #get all user accept admin
        $savant->alluser = usermodel::ReadAllByUtype('KEY VISITOR');
        #get all FREE DEVICES
            $savant->getquery = BoothQuery_Model::ReadAll();
        #get all events
            $savant->getAllBooth = Booth_Model::ReadAll();
        #--------------
        if(isset($_POST['ad'])){
            #add query against the booth
            $bq = new BoothQuery_Model();
            $boothlist = Utils::Array_To_CSV($_POST['booth']);
            $bq->ID = 'NULL';
            $bq->QUERY = $_POST['que'];
            $bq->BOOTHID = $boothlist;
            $bq->ISACTIVE = '1';
            BoothQuery_Model::Create($bq);
            
        }
        
        
        
    }else{
         header('location:../login/index.php');
         die('This is a restricted area');
    }
  
}else{
    header('location:../login/index.php');
}




$savant->error_u = $error_u;
$savant->error_p = $error_p;

$savant->header = $savant->fetch("header_table.tpl");
$savant->footer = $savant->fetch("footer_query.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("query.tpl");
?>
