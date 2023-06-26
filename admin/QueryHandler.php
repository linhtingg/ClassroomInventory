<?php
class Query
{
   public static function executeQuery(PDO $dbh, string $sql, array ...$bindParams)
   {
      $query = $dbh->prepare($sql);
      foreach ($bindParams as $index => $arg) {
         $query->bindParam($arg[0], $arg[1], PDO::PARAM_STR);
      }
      $query->execute();
      return $query;
   }
}
