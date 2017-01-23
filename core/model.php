<?
class Model
{

	private $connection = null;
	protected $table = '';
	private $host = 'localhost';
	private $user = 'root';
	private $pass = '';
	private $dbname = 'mcomments';
	public function __construct($_table){
		$this->connection = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
		$this->table = $_table;
	}

	public function select_item($id, $_table = null, $data = null){
		if(!$this->table || $_table != null) $this->table = $_table;

		if($data) $query = $data;
		else $query = "`id` = $id";

		$result = mysqli_fetch_assoc( mysqli_query($this->connection, "SELECT * FROM `$this->table` WHERE $query"));
		if($result){
			$item = [];
			foreach($result as $key => $value) {
				$item[$key] = $value;
			}
		}

			if(!isset($item) || !$item || count($item) == 0) return false;
			else return $item;
	}

	public function select($queryArgs = 0, $query_params = '', $_table = null){
		if($queryArgs == 0) $queryArgs = '*';
		if(!$this->table || $_table != null) $this->table = $_table;

		$Query = mysqli_query($this->connection, "SELECT $queryArgs FROM `$this->table` $query_params");
		//var_dump($this->table);
		$result = null; $indx = 0;
		if($Query){
			while ($Row = mysqli_fetch_assoc($Query)){
				if($Row) {
					foreach ($Row as $key => $value) {
						$result[$indx][$key] = $value; // = ['id' => $Row['id'], 'author' => $Row['author'], 'text' => $Row['text'] ];
					}
				}
				++$indx;
			}
		}


		if($result == null ) return false;
		else return $result;
	}

	public function insert($data = '', $query_params = '', $_table = null){
		if(!$data) return false;
		if(!$this->table || $_table != null) $this->table = $_table;
		//var_dump($data);
		mysqli_query($this->connection, "INSERT INTO $this->table VALUES ($data) $query_params");
		return mysqli_insert_id($this->connection);
	}

	public function delete($id, $_table = null){
		if(!$this->table || $_table != null) $this->table = $_table;

		if (mysqli_query($this->connection, "DELETE FROM $this->table WHERE id=$id")) return true;
		else return false;
	}

	public function update($id, $data = '', $query_params = '', $_table = null){
		if(!$this->table || $_table != null) $this->table = $_table;
		if(!$data || $data == '') return false;
		if(!$id || $id == 0) return false;

		if (mysqli_query($this->connection, "UPDATE $this->table SET $data WHERE id = $id $query_params")) return true;
		else return false;
	}

	public function pek($a){
		print($a);
	}





}