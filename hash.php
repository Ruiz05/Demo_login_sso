<?php
function toordinal(){
	$a = new DateTime(strval(date("Y-m-d h:i:s")));
	$awal = new Datetime("0001-01-01");
	$d = $a->diff($awal)->days + 1;
	return strval($d)."abubakar";
}
function hash_password(string $data) {
	$x = utf8_decode(base64_encode(sha1($data,true)));
	$z = "{SHA}$x";
	$f = utf8_decode(hash('sha256',$z.toordinal()));
	return $f;
}
//hash_password("1811102441105");
//echo toordinal();
?>
