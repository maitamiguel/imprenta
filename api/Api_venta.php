 <?php

//Api.php

class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=print", "root", "");
	}

	function fetch_all()
	{
		$query = "SELECT * FROM venta ORDER BY id_venta;";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert()
	{
		if(isset($_POST["id_user"]))
		{
			$form_data = array(
				':id_user'		    =>	$_POST["id_user"],
				':descripcion'		        =>	$_POST["descripcion"],
				':fecha_pedido'		=>	$_POST["fecha_pedido"],
				':fecha_entrega'		=>	$_POST["fecha_entrega"],
				':observacion'	=>	$_POST["observacion"],
				':id_detalle'		        =>	$_POST["id_detalle"]
			);
			$query = "
			INSERT INTO venta
			(id_user,descripcion,fecha_pedido,fecha_entrega,observacion,id_detalle) VALUES 
			(:id_user,:descripcion,:fecha_pedido,:fecha_entrega,:observacion,:id_detalle);
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function fetch_single($id)
	{
		$query = "SELECT * FROM venta where id_venta='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_venta'] = $row['id_venta'];
				$data['id_user'] = $row['id_user'];
				$data['descripcion'] = $row['descripcion'];
				$data['fecha_pedido'] = $row['fecha_pedido'];
				$data['fecha_entrega'] = $row['fecha_entrega'];
				$data['observacion'] = $row['observacion'];
				$data['id_detalle'] = $row['id_detalle'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["id_user"]))
		{
			$form_data = array(
				':id_user'		    =>	$_POST["id_user"],
				':descripcion'		        =>	$_POST["descripcion"],
				':fecha_pedido'		=>	$_POST["fecha_pedido"],
				':fecha_entrega'		=>	$_POST["fecha_entrega"],
				':observacion'	=>	$_POST["observacion"],
				':id_detalle'		        =>	$_POST["id_detalle"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE venta 
			SET id_user = :id_user 
				, descripcion = :descripcion
				, fecha_pedido = :fecha_pedido 
				, fecha_entrega = :fecha_entrega 
				, observacion = :observacion
				, id_detalle = :id_detalle 
			WHERE id_venta = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM venta WHERE id_venta = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>