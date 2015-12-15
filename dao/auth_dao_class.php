?php

/**
 * @author marciobm
 *
 */
class AuthDAO extends PDOConnectionFactory {
	
	private $mode = null;
	private $pdo = null;
	
	public function AuthDAO($mode) {

		$this->mode = $mode;
		
		$this->pdo = new PDOConnectionFactory();

	}

	/**
	 * Retorna o objeto LoginAdmin utilizando o Id.
	 * 
	 */
	public function findById($id) {

		$conn = $this->pdo->getConnection($this->mode);
		$stmt = $conn->prepare("SELECT id_login, username, password, tipo FROM tb_login_admin WHERE id_login = ?");

		$stmt->bindValue(1, $id);
		
		$stmt->execute();
    	foreach ($stmt as $row) {
			$obj = new LoginAdminDTO();
	        $obj->setIdLogin($row[0]);
			$obj->setUsername($row[1]);
			$obj->setPassword($row[2]);
			$obj->setTipo($row[3]);
		}
		return $obj;
	}

	/**
	 * Retorna o objeto LoginAdmin utilizando o Username.
	 * 
	 */
	public function findByUsername($username) {

		$conn = $this->pdo->getConnection($this->mode);
		$stmt = $conn->prepare("SELECT id_login, username, password, tipo FROM tb_login_admin WHERE username = ?");

		$stmt->bindValue(1, $username);
		
		$stmt->execute();
    	foreach ($stmt as $row) {
			$obj = new LoginAdminDTO();
	        $obj->setIdLogin($row[0]);
			$obj->setUsername($row[1]);
			$obj->setPassword($row[2]);
			$obj->setTipo($row[3]);
		}
		return $obj;
	}

	/**
	 * Verifica se o username do LoginAdmin é único.
	 * Se for único, retorna false se não retorna true.
	 * 
	 * @Return Boolean
	 */
	public function checkUserUnique($username) {

		$conn = $this->pdo->getConnection($this->mode);
		$stmt = $conn->prepare("SELECT id_login FROM tb_login_admin WHERE username = ?");

		$stmt->bindValue(1, $username);
		
		$stmt->execute();

		if($stmt->rowCount() > 0) 
			return true;

		return false;
	}

	/**
	 * Verifica se o username do LoginAdmin é único e se o 
	 * id é diferente do LoginAdmin quando se deseja atualizar o username.
	 * Se for único, retorna false se não retorna true.
	 * 
	 * @Return Boolean
	 */
	public function checkUserUniqueBoth($username, $idLogin) {

		$conn = $this->pdo->getConnection($this->mode);
		$stmt = $conn->prepare("SELECT id_login FROM tb_login_admin WHERE username = ? AND id_login <> ?");

		$stmt->bindValue(1, $username);
		$stmt->bindValue(2, $idLogin);
		
		$stmt->execute();

		if($stmt->rowCount() > 0) 
			return true;

		return false;
	}

	/**
	 * Altera a password do LoginAdmin.
	 * 
	 * @param	$username		Nome do Usuário
	 * @param	$password		Password atual
	 * @param	$passwordNova	Nova password
	 * @param	$tipo			Tipo do LoginAdmin
	 * 
	 * @Return Boolean
	 */
    public function changePassword($username, $password, $passwordNova, $tipo) {
    	
		$conn = $this->pdo->getConnection($this->mode);
		$stmt = $conn->prepare("UPDATE tb_login_admin SET password = ? WHERE username=? AND password = ? AND tipo = ?");

		$stmt->bindValue(1, $passwordNova);
		$stmt->bindValue(2, $username);
		$stmt->bindValue(3, $password);
		$stmt->bindValue(4, $tipo);

		$stmt->execute();

		return $stmt->rowCount();
	}
}

?>