<?php
class RoomController
{
   public static $allRoomsQuery = 'SELECT * from room where capacity !=0';
   public static $findRoomByID = "SELECT * FROM `room` WHERE id=:roomID";

   /**
    * Return all rooms in database.
    */
   public static function getAllRooms(): PDOStatement
   {
      return Query::executeQuery(RoomController::$allRoomsQuery);
   }

   /**
    * Find a room by ID.
    */
   public static function getRoomByID(string $roomID)
   {
      return Query::executeQuery(RoomController::$findRoomByID, [[':roomID', $roomID]]);
   }
}
class EquipmentController
{
   public static $allEquipmentsQuery = "SELECT * from equipment where id!='1'";
   public static $allAvailableEquipmentsQuery = "SELECT * from equipment where id!='1' and usability=1";
   public static $findEquipmentByID = "SELECT * FROM `equipment` WHERE id = :equipmentID";

   /**
    * Return all equipments in database.
    */
   public static function getAllEquipments(): PDOStatement
   {
      return Query::executeQuery(EquipmentController::$allEquipmentsQuery);
   }

   /**
    * Return all available equipments
    */
   public static function getAllAvailableEquipments(): PDOStatement
   {
      return Query::executeQuery(EquipmentController::$allAvailableEquipmentsQuery);
   }
   
   /**
    * Find equipment by ID
    */
   public static function getEquipmentByID(string $equipmentID)
   {
      return Query::executeQuery(EquipmentController::$findEquipmentByID, [[':equipmentID', $equipmentID]]);
   }
}
