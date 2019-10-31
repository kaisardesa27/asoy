<?php
error_reporting(0);
include 'header.php';

function curl($url, $fields = null, $headers = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($fields !== null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }
        if ($headers !== null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $result   = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return array(
            $result,
            $httpcode
        );
	}
{
$secret = 'a520b86d-c416-40b9-9f9f-f753d9899dd6'; //BEARERTOKENAKUNUTAMA
$pin = "122131"; //PINGOPAY
$headers = array();
$header[] = 'Content-Type: application/json';
$header[] = 'X-AppVersion: 3.40.0';
$header[] = "X-Uniqueid: ac94e5d0e7f3f".rand(111,999);
$header[] = 'X-Location: -6.405821,106.064193';
$header[] ='Authorization: Bearer '.$secret;
$header[] = 'pin:'.$pin.'';

$amountt = $_POST['amount'];
$number = $_POST['phone'];
		$numbers = $number[0].$number[1];
		$numberx = $number[5];
		if($numbers == "08") { 
			$number = str_replace("08","628",$number);
		} elseif ($numberx == " ") {
			$number = preg_replace("/[^0-9]/", "",$number);
			$number = "1".$number;
		}
}
    if(isset($_POST['submit']))
    {

$getqrid = curl('https://api.gojekapi.com/wallet/qr-code?phone_number=%2B'.$number.'', null, $header);
					$jsqrid = json_decode($getqrid[0]);
					$qrid = $jsqrid->data->qr_id;
					
$tf = curl('https://api.gojekapi.com/v2/fund/transfer', '{"amount":"'.$amountt.'","description":"ZAL ","qr_id":"'.$qrid.'"}', $header);
$jstf = json_decode($tf[0]);
$tfref = $jstf->data->transaction_ref;
if ($jstf && true === $jstf->success) {
                        echo '
                        <div class="alert alert-success">
  <strong>Success!</strong> Berhasil Transfer Gopay <b>Rp.'.$amountt.'</b> Ke <b>'.$number.'</b> . Trx ID: <b>'.$tfref.'</b>
</div>
';
                    } else {
                        echo '
<div class="alert alert-warning">
  <strong>Failed!</strong> Gagal Transfer Gopay.
</div>
';
}

}
	{

$detail = curl('https://api.gojekapi.com/wallet/profile/detailed', null, $header);
					$saldoo = json_decode($detail[0]);
					$saldo = $saldoo->data->balance;
					echo '
      <button type="button" class="btn btn-default">Saldo: <b>Rp. '.$saldo.'</b></button>
      
      <br><br>
                            <form action="" method="POST">
              <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
      <input id="phone" type="text" class="form-control" name="phone" placeholder="62 or 1">
      </div>
      <br>
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
      <input id="amount" type="text" class="form-control" name="amount" placeholder="1 - 99999">
    </div>
    <br>
          <center>     
          <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
          <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-paper-plane-o"></i> Submit</button></center>
      </div>
    </div>
</form>
</body>
</html>';
	}

?>
