<?php



require_once '../lib/Repository.php';

use mysqli;

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


        $attr = '(name, password, email, ranking, isAdmin, isModerator, isActiv)';
        $value = "({$username}, {$password}, {$email}, 0, false, false, false, true)";


        if (!$this->insert($this->tableName, $attr, $value)) {
            throw new Exception("Can't create a new User");
        }

        echo 'Create user was successfully';

    }

    public function login($username, $password)
    {

        if (sha1($password) === $this->select('password', $this->tableName, 'username', $username))
        {
            echo 'Login was successfully';
        }
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
}
