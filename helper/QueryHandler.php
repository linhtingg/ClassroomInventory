<?php
class Query
{
   /**
    * Execute SQL query.
    */
   public static function executeQuery(PDO $dbh, string $sql, array $bindParams = []): PDOStatement
   {
      $query = $dbh->prepare($sql);
      if ($bindParams != []) {
         foreach ($bindParams as $arg) {
            $query->bindParam($arg[0], $arg[1], PDO::PARAM_STR);
         }
      }
      $query->execute();
      return $query;
   }
}
