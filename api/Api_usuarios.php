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
		$query = "SELECT * FROM usuarios ORDER BY id_user;";
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
		if(isset($_POST["nombre"]))
		{
			$form_data = array(
				':nombre'		    =>	$_POST["nombre"],
				':apellido_p'		        =>	$_POST["apellido_p"],
				':apellido_m'		=>	$_POST["apellido_m"],
				':fecha_nac'		=>	$_POST["fecha_nac"],
				':email'	=>	$_POST["email"],
				':telefono'		        =>	$_POST["telefono"]
			);
			$query = "
			INSERT INTO usuarios
			(nombre,apellido_p,apellido_m,fecha_nac,email,telefono) VALUES 
			(:nombre,:apellido_p,:apellido_m,:fecha_nac,:email,:telefono);
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
		$query = "SELECT * FROM usuarios where id_user='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_user'] = $row['id_user'];
				$data['nombre'] = $row['nombre'];
				$data['apellido_p'] = $row['apellido_p'];
				$data['apellido_m'] = $row['apellido_m'];
				$data['fecha_nac'] = $row['fecha_nac'];
				$data['email'] = $row['email'];
				$data['telefono'] = $row['telefono'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["nombre"]))
		{
			$form_data = array(
				':nombre'		    =>	$_POST["nombre"],
				':apellido_p'		        =>	$_POST["apellido_p"],
				':apellido_m'		=>	$_POST["apellido_m"],
				':fecha_nac'		=>	$_POST["fecha_nac"],
				':email'	=>	$_POST["email"],
				':telefono'		        =>	$_POST["telefono"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE usuarios 
			SET nombre = :nombre 
				, apellido_p = :apellido_p
				, apellido_m = :apellido_m 
				, fecha_nac = :fecha_nac 
				, email = :email
				, telefono = :telefono 
			WHERE id_user = :id
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
		$query = "DELETE FROM usuarios WHERE id_user = '".$id."'";
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