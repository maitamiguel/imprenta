<?php

//action.php

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'insert')
	{
		echo "insert"; 
		$form_data = array(
			'id_user'		    =>	$_POST['id_user'],
			'descripcion'				=>	$_POST['descripcion'],
			'fecha_pedido'			=>	$_POST['fecha_pedido'],
			'fecha_entrega'			=>	$_POST['fecha_entrega'],
            'observacion'	=>	$_POST['observacion'],
			'id_detalle'				=>	$_POST['id_detalle']
		);
		$api_url = "http://localhost/imprenta/api/test_api_venta.php?action=insert";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'insert';
			}
			else
			{
				echo 'error';
			}
		}
	}

	if($_POST["action"] == 'fetch_single')
	{
		$id = $_POST["id"];
		$api_url = "http://localhost/imprenta/api/test_api_venta.php?action=fetch_single&id=".$id."";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
	if($_POST["action"] == 'update')
	{
		$form_data = array(
			'id_user'		=>	$_POST['id_user'],
			'descripcion'				=>	$_POST['descripcion'],
			'fecha_pedido'			=>	$_POST['fecha_pedido'],
			'fecha_entrega'			=>	$_POST['fecha_entrega'],
            'observacion'	=>	$_POST['observacion'],
			'id_detalle'				=>	$_POST['id_detalle'],
			'hidden_id'				=>	$_POST['hidden_id']
		);
		$api_url = "http://localhost/imprenta/api/test_api_venta.php?action=update";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'update';
			}
			else
			{
				echo 'error';
			}
		}
	}
	if($_POST["action"] == 'delete')
	{
		$id = $_POST['id'];
		$api_url = "http://localhost/imprenta/api/test_api_venta.php?action=delete&id=".$id.""; //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
}


?>