<?php
 
namespace App\Models;
 
use Core\Model;
use PDO;
use PDOException;
 
class sumbangan extends Model
{
 
    public static function getName()
    {

        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT `name` FROM `jenis_sumbangan` ORDER BY `name`');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
            return $results;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function setUser($name, $gender)
    {

        try {
            $db = static::getDB();
            $stmt = $db->query("INSERT INTO `user`(`name`, `gender`) VALUES ('". $name ."', ". $gender .")");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $db->lastinsertId();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function isThere($tipedonasi)
    {

        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT `id` FROM `jenis_sumbangan` WHERE `name`='".$tipedonasi."' LIMIT 1");
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            if($results < 1) return FALSE;
            return $results["id"];

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function setJS($tipedonasi)
    {

        try {
            $db = static::getDB();
            $stmt = $db->query("INSERT INTO `jenis_sumbangan`(`name`) VALUES ('". $tipedonasi ."')");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $db->lastinsertId();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function setSumbangan($userid,$jenisid,$total)
    {

        try {
            $db = static::getDB();
            $stmt = $db->query("INSERT INTO `sumbangan`(`userid`, `jenis`, `jumlah`) VALUES ('".$userid."' ,'".$jenisid."','".$total."')");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function getSumbangan()
    {

        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT (@cnt := @cnt + 1) AS nomer, b.name, c.name jenis, a.jumlah, b.gender 
            FROM `sumbangan` a
            CROSS JOIN (SELECT @cnt := 0) AS dummy
            INNER JOIN user b ON b.id = a.userid
            INNER JOIN jenis_sumbangan c ON c.id=a.jenis
            WHERE 1");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function getFilterSumbangan($name)
    {

        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT (@cnt := @cnt + 1) AS nomer, b.name, c.name jenis, a.jumlah, b.gender
            FROM `sumbangan` a
            CROSS JOIN (SELECT @cnt := 0) AS dummy
            INNER JOIN user b ON b.id = a.userid
            INNER JOIN jenis_sumbangan c ON c.id=a.jenis
            WHERE c.name= '".$name."'");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
