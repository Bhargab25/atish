<?php
include_once 'lib/savant/Savant3.php';
include_once 'lib/CurlManager.php';
include_once 'lib/UIHelper.php';
include_once 'lib/CSSManager.php';
include_once 'lib/MenuManager.php';
include_once 'lib/StateHolder.php';
include_once 'lib/Layout.php';
include_once 'lib/UIHelper.php';
include_once 'lib/Utils.php';
include_once 'lib/Validator.php';
include_once 'lib/Config.php';
include_once 'lib/StaticList.php';
include_once 'lib/Misc.php';
include_once 'lib/SmsHandler.php';
include_once 'lib/FaxHandler.php';
include_once 'lib/EmailHandler.php';
include_once 'lib/Actions.php';
include_once 'lib/CustomGrid.php';
include_once 'lib/Widgets.php';
include_once 'lib/WebPage.php';
include_once 'lib/FileManager.php';
include_once 'lib/Templates.php';
include_once 'lib/Forms.php';
include_once 'lib/Security.php';
include_once 'lib/Password.php';
include_once 'lib/CardHandler.php';
include_once 'lib/FindLocation.php';

/* * ********************MODEL************************************** */
include_once 'model/BaseModel.php';
include_once 'model/KeyVal.php';
include_once 'model/StaticModel.php';
include_once 'model/dbmodel.php';
include_once 'model/Pair.php';
//-------------------------//
include_once 'model/usermodel.php';
include_once 'model/user_log_history.php';
include_once 'model/events.php';
include_once 'model/service.php';
include_once 'model/devices.php';
include_once 'model/device_assign.php';
include_once 'model/invities.php';
include_once 'model/booth.php';
include_once 'model/push_model.php';
include_once 'model/ApiModel.php';
include_once 'model/alert_model.php';
include_once 'aws/aws-autoloader.php';
use Aws\Sns\SnsClient; 
use Aws\Exception\AwsException;

$sns = new Aws\Sns\SnsClient([
    'version' => '2010-03-31',
    'region' => 'us-east-1',
    'credentials' => [
                    'key'    => 'AKIAUELJWMPPOO5ACHER',
                    'secret' => '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',
                ],
]);

define("TOPIC",'arn:aws:sns:us-east-1:284226380766:Eegrab_ihub');
define('LOCATION','5488513526792192');
define('TOKEN','eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0IjoxNTczNzk3OTk2LCJ2YWx1ZSI6ImFkNzdiZTdkMzU2Mzk1ZDY3ZWU4YmUyYzIyYTgyN2Y2ZWQxYWYyZjIifQ.DPzzyMHv1oAFVJiLdd8lsdGjj8w_1Ds-mTTHSVGX22I');
ini_set('date.timezone', 'Asia/Calcutta');
error_reporting(0);
session_start();
?>