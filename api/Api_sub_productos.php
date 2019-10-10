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
		$query = "SELECT * FROM sub_productos ORDER BY id_sub;";
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
		if(isset($_POST["id_producto"]))
		{
			$form_data = array(
				':id_producto'		    =>	$_POST["id_producto"],
				':tipo'		        =>	$_POST["tipo"]
			);
			$query = "
			INSERT INTO sub_productos
			(id_producto,tipo) VALUES 
			(:id_producto,:tipo);
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
		$query = "SELECT * FROM sub_productos where id_sub='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_sub'] = $row['id_sub'];
				$data['id_producto'] = $row['id_producto'];
				$data['tipo'] = $row['tipo'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["id_producto"]))
		{
			$form_data = array(
				':id_producto'		    =>	$_POST["id_producto"],
				':tipo'		        =>	$_POST["tipo"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE sub_productos 
			SET id_producto = :id_producto 
				, tipo = :tipo
			WHERE id_sub = :id
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
		$query = "DELETE FROM sub_productos WHERE id_sub = '".$id."'";
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