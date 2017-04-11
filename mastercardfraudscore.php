<?php
namespace MasterCard\Api\FraudScoring;

//import the php autoloader
require_once './vendor/autoload.php';

use MasterCard\Core\Model\RequestMap;
use MasterCard\Core\ApiConfig;
use MasterCard\Core\Security\OAuth\OAuthAuthentication;


$consumerKey = "your consumer key";   // You should copy this from "My Keys" on your project page e.g. UTfbhDCSeNYvJpLL5l028sWL9it739PYh6LU5lZja15xcRpY!fd209e6c579dc9d7be52da93d35ae6b6c167c174690b72fa
$keyAlias = "keyalias";   // For production: change this to the key alias you chose when you created your production key
$keyPassword = "keystorepassword";   // For production: change this to the key alias you chose when you created your production key
$privateKey = file_get_contents(getcwd()."Your P12 Certificate.p12"); // e.g. /Users/yourname/project/sandbox.p12 | C:\Users\yourname\project\sandbox.p12
ApiConfig::setAuthentication(new OAuthAuthentication($consumerKey, $privateKey, $keyAlias, $keyPassword));
ApiConfig::setDebug(true);
ApiConfig::setSandbox(true);   // For production: use ApiConfig::setSandbox(false)

$map = new RequestMap();
$map->set("ScoreLookupRequest.TransactionDetail.CustomerIdentifier", "1996");
$map->set("ScoreLookupRequest.TransactionDetail.MerchantIdentifier", "12345");
$map->set("ScoreLookupRequest.TransactionDetail.AccountNumber", "5555555555555555");
$map->set("ScoreLookupRequest.TransactionDetail.AccountPrefix", "555555");
$map->set("ScoreLookupRequest.TransactionDetail.AccountSuffix", "5555");
$map->set("ScoreLookupRequest.TransactionDetail.TransactionAmount", "12500");
$map->set("ScoreLookupRequest.TransactionDetail.TransactionDate", "1231");
$map->set("ScoreLookupRequest.TransactionDetail.TransactionTime", "035931");
$map->set("ScoreLookupRequest.TransactionDetail.BankNetReferenceNumber", "abc123hij");
$map->set("ScoreLookupRequest.TransactionDetail.Stan", "123456");
$request = new ScoreLookup($map);
$response = $request->update();
echo "ScoreLookup.CustomerIdentifier-->{$response->get("ScoreLookup.CustomerIdentifier")}\n"; //ScoreLookup.CustomerIdentifier-->L5BsiPgaF-O3qA36znUATgQXwJB6MRoMSdhjd7wt50c97279
echo "ScoreLookup.TransactionDetail.CustomerIdentifier-->{$response->get("ScoreLookup.TransactionDetail.CustomerIdentifier")}\n"; //ScoreLookup.TransactionDetail.CustomerIdentifier-->1996
echo "ScoreLookup.TransactionDetail.MerchantIdentifier-->{$response->get("ScoreLookup.TransactionDetail.MerchantIdentifier")}\n"; //ScoreLookup.TransactionDetail.MerchantIdentifier-->12345
echo "ScoreLookup.TransactionDetail.AccountNumber-->{$response->get("ScoreLookup.TransactionDetail.AccountNumber")}\n"; //ScoreLookup.TransactionDetail.AccountNumber-->5555555555555555
echo "ScoreLookup.TransactionDetail.AccountPrefix-->{$response->get("ScoreLookup.TransactionDetail.AccountPrefix")}\n"; //ScoreLookup.TransactionDetail.AccountPrefix-->555555
echo "ScoreLookup.TransactionDetail.AccountSuffix-->{$response->get("ScoreLookup.TransactionDetail.AccountSuffix")}\n"; //ScoreLookup.TransactionDetail.AccountSuffix-->5555
echo "ScoreLookup.TransactionDetail.TransactionAmount-->{$response->get("ScoreLookup.TransactionDetail.TransactionAmount")}\n"; //ScoreLookup.TransactionDetail.TransactionAmount-->12500
echo "ScoreLookup.TransactionDetail.TransactionDate-->{$response->get("ScoreLookup.TransactionDetail.TransactionDate")}\n"; //ScoreLookup.TransactionDetail.TransactionDate-->1231
echo "ScoreLookup.TransactionDetail.TransactionTime-->{$response->get("ScoreLookup.TransactionDetail.TransactionTime")}\n"; //ScoreLookup.TransactionDetail.TransactionTime-->035931
echo "ScoreLookup.TransactionDetail.BankNetReferenceNumber-->{$response->get("ScoreLookup.TransactionDetail.BankNetReferenceNumber")}\n"; //ScoreLookup.TransactionDetail.BankNetReferenceNumber-->abc123hij
echo "ScoreLookup.TransactionDetail.Stan-->{$response->get("ScoreLookup.TransactionDetail.Stan")}\n"; //ScoreLookup.TransactionDetail.Stan-->123456
echo "ScoreLookup.ScoreResponse.MatchIndicator-->{$response->get("ScoreLookup.ScoreResponse.MatchIndicator")}\n"; //ScoreLookup.ScoreResponse.MatchIndicator-->2
echo "ScoreLookup.ScoreResponse.FraudScore-->{$response->get("ScoreLookup.ScoreResponse.FraudScore")}\n"; //ScoreLookup.ScoreResponse.FraudScore-->681
echo "ScoreLookup.ScoreResponse.ReasonCode-->{$response->get("ScoreLookup.ScoreResponse.ReasonCode")}\n"; //ScoreLookup.ScoreResponse.ReasonCode-->A5
echo "ScoreLookup.ScoreResponse.RulesAdjustedScore-->{$response->get("ScoreLookup.ScoreResponse.RulesAdjustedScore")}\n"; //ScoreLookup.ScoreResponse.RulesAdjustedScore-->701
echo "ScoreLookup.ScoreResponse.RulesAdjustedReasonCode-->{$response->get("ScoreLookup.ScoreResponse.RulesAdjustedReasonCode")}\n"; //ScoreLookup.ScoreResponse.RulesAdjustedReasonCode-->19
echo "ScoreLookup.ScoreResponse.RulesAdjustedReasonCodeSecondary-->{$response->get("ScoreLookup.ScoreResponse.RulesAdjustedReasonCodeSecondary")}\n"; //ScoreLookup.ScoreResponse.RulesAdjustedReasonCodeSecondary-->A9


