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
		$query = "SELECT * FROM login_user ORDER BY id_login;";
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
		if(isset($_POST["cargo_log"]))
		{
			$form_data = array(
				':cargo_log'		    =>	$_POST["cargo_log"],
				':password_log'		        =>	$_POST["password_log"]
			);
			$query = "
			INSERT INTO login_user
			(cargo_log,password_log) VALUES 
			(:cargo_log,:password_log);
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
		$query = "SELECT * FROM login_user where id_login='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_login'] = $row['id_login'];
				$data['cargo_log'] = $row['cargo_log'];
				$data['password_log'] = $row['password_log'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["cargo_log"]))
		{
			$form_data = array(
				':cargo_log'		    =>	$_POST["cargo_log"],
				':password_log'		        =>	$_POST["password_log"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE login_user 
			SET cargo_log = :cargo_log 
				, password_log = :password_log
			WHERE id_login = :id
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
		$query = "DELETE FROM login_user WHERE id_login = '".$id."'";
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