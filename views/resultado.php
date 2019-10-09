<?php
require("conexao.php");

function parseToXML($htmlStr){
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}

$tipo_pet = mysqli_real_escape_string($conn, $_POST['tipo_pet']);

// Select all the rows in the markers table
//$result_markers = "SELECT * FROM markers";
$result_markers = "SELECT * FROM markers WHERE tipo_pet = '$tipo_pet'";
$resultado_markers = mysqli_query($conn, $result_markers);

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row_markers = mysqli_fetch_assoc($resultado_markers)){
  // Add to XML document node
  echo '<marker ';
  echo 'name="' . parseToXML($row_markers['name']) . '" ';
  echo 'address="' . parseToXML($row_markers['address']) . '" ';
  echo 'lat="' . $row_markers['lat'] . '" ';
  echo 'lng="' . $row_markers['lng'] . '" ';
  echo 'tipo_pet="' . $row_markers['tipo_pet'] . '" ';
  echo 'dt_inicio="' . $row_markers['dt_inicio'] . '" ';
  echo 'dt_fim="' . $row_markers['dt_fim'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';



