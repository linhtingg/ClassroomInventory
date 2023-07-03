<?php
class Query
{
   private static $DB_HOST = 'localhost';
   private static $DB_USER = 'root';
   private static $DB_PASS = '';
   private static $DB_NAME = 'class';
   private static $dbh = null;
   /**
    * Execute SQL query and return the query.
    * @param string $sql SQL query
    * @param array $bindParams An array of `arg`. Each `arg` have 2 element: Parameter identifier and PHP variable.
    * @return PDOStatement
    */
   public static function executeQuery(string $sql, array $bindParams = [])
   {
      $query = Query::getConnection()->prepare($sql);
      if ($bindParams != []) {
         foreach ($bindParams as $arg) {
            $query->bindParam($arg[0], $arg[1], PDO::PARAM_STR);
         }
      }
      $query->execute();
      return $query;
   }
   /**
    * Return PDO connection between PHP and MySQL server.
    * @return PDO
    */
   private static function getConnection()
   {
      if (Query::$dbh == null) {
         Query::$dbh = new PDO("mysql:host=" . Query::$DB_HOST . ";dbname=" . Query::$DB_NAME, Query::$DB_USER, Query::$DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
      }
      return Query::$dbh;
   }
}
