<?php
class Query
{
   public static function executeQuery(PDO $dbh, string $sql, string $username, string $password)
   {
      $query = $dbh->prepare($sql);
      $query->bindParam(':username', $username, PDO::PARAM_STR);
      $query->bindParam(':password', $password, PDO::PARAM_STR);
      $query->execute();
      return $query;
   }
}
