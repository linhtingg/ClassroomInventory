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
    * @param array $params An array of PHP variables.
    * @return PDOStatement|null
    * @throws ValueError | PDOException
    */
   public static function execute(string $sql, array $params = [])
   {
      try {
         $query = Query::getConnection()->prepare($sql);
         if ($params != []) {
            for ($i = 0; $i < count($params); $i++) {
               $query->bindParam($i + 1, $params[$i]);
            }
         }
         $query->execute();
         return $query;
      } catch (Throwable $exception) {
         $trace = str_replace(["\\", "'", "\n"], [" \\\\ ", "\'", "\\n"], $exception->getTraceAsString());
         $message = str_replace("'", "\'", $exception->getMessage());
         Notification::echoToScreen("Trace:\\n" . $trace . "\\n" . $message);
         throw $exception;
      }
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
