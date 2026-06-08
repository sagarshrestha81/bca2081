<?php
// $gateway = "khalti";

// switch ($gateway):
//     case "esewa":
//         echo "Processing payment via Esewa...";
//         break;
//     case "khalti":
//         echo "Processing payment via Khalti...";
//         break;
//     case "fonepay":
//         echo "Processing payment via Fonepay...";
//         break;
//     default:
//         echo "Invalid gateway";
//     endswitch;

// $age = 6;

// if ($age >= 18):
//     echo "Eligible for vote";
// else:
//     echo "Not Eligible for vote";
// endif;


// for ($i = 1; $i <= 10; $i++) {
//     echo "hello$i<br>" . '$rs$pr$tk';
// }
// $i = 1;
// while ($i < 10) {
//     echo "2 X $i = " . 2 * $i . "<br>";
//     $i++;
// }
// $i = 0;
// do {
//     echo "2 X $i = " . 2 * $i . "<br>";
//     $i++;
// } while ($i < 10);

// try {
//     echo "my code ";
//     throw new Exception("code error");

// } catch (Exception $e) {
//     echo "error:" . $e->getMessage();
// }
// finally{
//     echo "thank you";
// }

$balance = 10000;
$withdraw = 10000;

function bank_connect($withdraw,$balance){
    if($withdraw>$balance){
        throw new Exception("Insufficient balance");
    }
   $amount = $balance - $withdraw;
   echo "withdraw successful $withdraw <br>
   now your balance is $amount <br>";   
}
try{
    bank_connect($withdraw,$balance);
}catch(Exception $e){
    echo "error: " . $e->getMessage();
}finally{
    echo "thank you";
}





