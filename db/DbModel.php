<?php
/**
 * User: sh_abdurasulov
 * @package app\core
 */

namespace app\core\db;


use app\core\Application;
use app\core\Model;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function primaryKey():string;

    abstract public function attributes();

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("Insert into $tableName (" . implode(',', $attributes) . ")
        VALUES(" . implode(',', $params) . ")");

        foreach ($attributes as $attribute) {
            $statement->bindParam(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);

        $sql = implode("AND ", array_map(fn($attribute) => "$attribute = :$attribute", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $item) {
            $statement->bindParam(":$key", $item);
        }
        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

}