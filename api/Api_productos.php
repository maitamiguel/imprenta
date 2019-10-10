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
		$query = "SELECT * FROM productos ORDER BY id_producto;";
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
		if(isset($_POST["img_pro"]))
		{
			$form_data = array(
				':img_pro'		    =>	$_POST["img_pro"],
				':nom_producto'		        =>	$_POST["nom_producto"]
			);
			$query = "
			INSERT INTO productos
			(img_pro,nom_producto) VALUES 
			(:img_pro,:nom_producto);
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
		$query = "SELECT * FROM productos where id_producto='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_producto'] = $row['id_producto'];
				$data['img_pro'] = $row['img_pro'];
				$data['nom_producto'] = $row['nom_producto'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["img_pro"]))
		{
			$form_data = array(
				':img_pro'		    =>	$_POST["img_pro"],
				':nom_producto'		        =>	$_POST["nom_producto"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE productos 
			SET img_pro = :img_pro 
				, nom_producto = :nom_producto
			WHERE id_producto = :id
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
		$query = "DELETE FROM productos WHERE id_producto = '".$id."'";
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