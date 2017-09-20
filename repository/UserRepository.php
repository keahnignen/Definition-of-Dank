<?php



require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'user';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function addUser($username, $email, $password)
    {
        $password = sha1($password);

        $attr = '(name, password, email)';

        $query = "INSERT INTO {$this->tableName} {$attr} VALUES (?, ?, ?)";


        $stmt = ConnectionHandler::getConnection()->prepare($query);

        if ($stmt == false)
        {
            throw new Exception("Statement prepare Error");
        }
        else
        {
            $stmt->bind_param('sss', $username,  $password, $email);

            if (!$stmt->execute())
            {
                throw new Exception("Exicution error");
            }

            return true;
        }

    }

    public function loginSuccesfully($username, $password)
    {
        foreach ( $this->select('password', $this->tableName, 'name', $username) as $pw)
        {
            return (sha1($password) == $pw) ? true : false;
        }
        return false;
    }

    public function getUserById($id)
    {
        if (is_numeric($id)) return null;
        return $this->select('*', $this->tableName, 'id', $id);
    }

    public function deleteUser($id)
    {
        if (is_numeric($id)) return null;
        return $this->delete($this->tableName, 'id', $id);
    }

    public function getUserIdByUsername($username)
    {
        return $this->select('id', $this->tableName, 'name', $username);
    }

    public function isUsernameTaken($username)
    {
        return ($this->select('name', $this->tableName, 'name', $username) == null) ? false : true;
    }

    public function isEmailTaken($email)
    {
        return ($this->select('email', $this->tableName, 'email', $email) == null) ? false : true;
    }

    public function usernameById($id)
    {
        return $this->select('name', $this->tableName, 'id', $id);
    }
}
