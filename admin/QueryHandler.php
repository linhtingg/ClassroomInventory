<?php
class Query
{
   public static function executeQuery()
   {
      $dbh = func_get_arg(0);
      $sql = func_get_arg(1);
      $query = $dbh->prepare($sql);
      $args = func_get_args();
      foreach ($args as $index => $arg) {
         if ($index >= 2) {
            $query->bindParam($arg[0], $arg[1], PDO::PARAM_STR);
         }
      }
      $query->execute();
      return $query;
   }
}
