<?php
/**
 * Created by PhpStorm.
 * User: btabik
 * Date: 20.09.2017
 * Time: 11:18
 */

require_once '../lib/Repository.php';

class ThreadRepository extends Repository
{

    protected $tableName = 'category';

    //Offensichlicher weise gibt diese alle Categorieren zurück
    public function getAllCategorys()
    {
        return $this->select('catName', $this->tableName, '1', '1');
    }

}