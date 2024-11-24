<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include_once('../../include_commons.php'); 
// require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$total_due= 0;
$storage = 0;
$it_resources = 0;
$total_users = 0;

if(isset($_SESSION['userid'])){

  $role = usermodel::ReadSingle($_SESSION['userid'])->role;

  // Get Total SD Due 
  $total_due = Dashboard::DueCount();
  $sc_total_due = Dashboard::ScDueCount();
  $total_sell = Dashboard::SellCount();
  $total_buy = Dashboard::BuyCount();
  $invoices = invoiceModel::ReadFive();
  $scDue = scentityModel::ReadByDue();
  $sdDue = sdentityModel::ReadByDue();
  $buy_list = Dashboard::BuyLast();
  $recentSell = Stock::RecentSell();
    #know the user role 
    // $getrole = ROLEMODEL::ReadSingleByUser($_SESSION['userid']);
    
  //   if(empty($getrole)){
  //       #user have only access to there timeline
  //       header('location:../user/user_info.php');
  //   }else{
  //       #show the dashboard reports all other access
  //  if($getrole->ROLE == 'admin'){
  //           $_SESSION['access']='all';
            #get all the details
   // $getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
//	$getCompany = companymodel::ReadSingle($getuserdetails->CID);
//	$getEmployement = EMPLOYEMENT_MODEL::ReadSingleByCompany($getCompany->CNAME);
	//$get_lockers = COMP_FADO_DETAILS::ReadAllComp($getuserdetails->CID);
	//$total_number_of_fado_occupied = count(BOOKING_HISTORY::Occupied($getuserdetails->CID));
	///$all_members = usermodel::ReadAllByCompany($getuserdetails->CID);
	//$storage = FADO_CAPACITY::ReadAllByCOMPID($getuserdetails->CID);
	//$it_resources = ITRESOURCE_CAPACITY::ReadAllByCID($getuserdetails->CID);	
	// $savant->total_fado = count($storage);
//	 $savant->totalfado_occupied = $total_number_of_fado_occupied;
//	$savant->totalfado_free = $savant->total_fado - $total_number_of_fado_occupied;
//	$savant->num_members = count($all_members);
//	$savant->latestmembers = usermodel::ReadAllByCompany_last8($getuserdetails->CID);
	
	/*$savant->getLatestBookings = BOOKING_HISTORY::ReadAll_Latest_Booking_CID($getuserdetails->CID);
	$savant->it_space = $storage;*/
    #get total number of assets
    // $savant->totalAssets = ASSET_MODEL::ReadAll_active();  
    
    #get total number of asset occupied
    // $savant->TotalOccu = BOOKING_HISTORY::Occupied($getuserdetails->CID);        
      
    #get latest 10 asset added
  //  $savant->latest_asset = ASSET_MODEL::latest5_assets();        
     
    #get latest Booking
  //  $savant->latestBooking = BOOKING_HISTORY::ReadAll_Latest_Booking_CID($getuserdetails->CID);        
    #get current month booking
   // $savant->currentBooking = BOOKING_HISTORY::CurrentMonth();        
    //     }
    // }
	
	
}else{
	header('location: ../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->sd_total = $total_due;
$savant->sc_total = $sc_total_due;
$savant->sellCount = $total_sell;
$savant->buyCount = $total_buy;
$savant->invoices = $invoices;
$savant->scDue = $scDue;
$savant->sdDue = $sdDue;
$savant->buy_list = $buy_list;
$savant->recentSell = $recentSell;
$savant->role = $role;


$savant->header = $savant->fetch("header.tpl");
$savant->script = $savant->fetch("script.tpl");
$savant->footer = $savant->fetch("footer.tpl");
// $savant->logo = $savant->fetch("inner_logo.tpl");
$savant->topbar = $savant->fetch("topbar.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("index.tpl");
?>
