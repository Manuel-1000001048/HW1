<?php
/*
$curl = curl_init();

$String=$_GET['q'];
$url="https://wger.de/api/v2/$String/";
//https://www.bulk.com/it/catalogsearch/result/?q=proteine
//https://www.amazon.com/s?k=$String

curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

//https://m.media-amazon.com/images/I/51xwh7isB4L._AC_UY218_.jpg
//immagine

$result = curl_exec($curl);
echo $result;

curl_close($curl);*/
/*

for($i=0; $i<count($images); $i++){
    echo "<img src='$images[$i]'>";
}*/

//print_r($images);


$curl = curl_init();
$String=$_GET['q'];
curl_setopt_array($curl, [
	CURLOPT_URL => "https://edamam-food-and-grocery-database.p.rapidapi.com/parser?ingr=$String",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: edamam-food-and-grocery-database.p.rapidapi.com",
		"X-RapidAPI-Key: 857553cdc4mshfe9d2a532c83a6fp1737a6jsn616560f71ded"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
?>