<?php

//fetch.php

$api_url = "http://localhost/imprenta/api/test_api_venta.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if(count($result) > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row->id_user.'</td>
			<td>'.$row->descripcion.'</td>
			<td>'.$row->fecha_pedido.'</td>
			<td>'.$row->fecha_entrega.'</td>
			<td>'.$row->observacion.'</td>
			<td>'.$row->id_detalle.'</td>
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_venta.'">Edit</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_venta.'">Delete</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="7" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;

?>