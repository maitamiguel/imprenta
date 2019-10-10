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
		$query = "SELECT * FROM detalle_pro ORDER BY id_detalle;";
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
		if(isset($_POST["id_sub"]))
		{
			$form_data = array(
				':id_sub'		    =>	$_POST["id_sub"],
				':img_detalle'		        =>	$_POST["img_detalle"],
				':precio'		=>	$_POST["precio"],
				':cantidad_min'		=>	$_POST["cantidad_min"],
				':cantidad_max'	=>	$_POST["cantidad_max"]
			);
			$query = "
			INSERT INTO detalle_pro
			(id_sub,img_detalle,precio,cantidad_min,cantidad_max) VALUES 
			(:id_sub,:img_detalle,:precio,:cantidad_min,:cantidad_max);
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
		$query = "SELECT * FROM detalle_pro where id_detalle='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_detalle'] = $row['id_detalle'];
				$data['id_sub'] = $row['id_sub'];
				$data['img_detalle'] = $row['img_detalle'];
				$data['precio'] = $row['precio'];
				$data['cantidad_min'] = $row['cantidad_min'];
				$data['cantidad_max'] = $row['cantidad_max'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["id_sub"]))
		{
			$form_data = array(
				':id_sub'		    =>	$_POST["id_sub"],
				':img_detalle'		        =>	$_POST["img_detalle"],
				':precio'		=>	$_POST["precio"],
				':cantidad_min'		=>	$_POST["cantidad_min"],
				':cantidad_max'	=>	$_POST["cantidad_max"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE detalle_pro 
			SET id_sub = :id_sub 
				, img_detalle = :img_detalle
				, precio = :precio 
				, cantidad_min = :cantidad_min 
				, cantidad_max = :cantidad_max
			WHERE id_detalle = :id
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
		$query = "DELETE FROM detalle_pro WHERE id_detalle = '".$id."'";
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