<?php
class RoomController
{
   public static $allRoomsQuery = 'SELECT * from room where capacity !=0';
   public static $findRoomByID = "SELECT * FROM `room` WHERE id=?";

   /**
    * Return all rooms in database.
    */
   public static function getAllRooms(): PDOStatement
   {
      return Query::execute(RoomController::$allRoomsQuery);
   }

   /**
    * Find a room by ID.
    */
   public static function getRoomByID(string $roomID)
   {
      return Query::execute(RoomController::$findRoomByID, [$roomID]);
   }
}
class EquipmentController
{
   public static $allEquipmentsQuery = "SELECT * from equipment where id!='1'";
   public static $allAvailableEquipmentsQuery = "SELECT * from equipment where id!='1' and usability=1";
   public static $findEquipmentByID = "SELECT * FROM `equipment` WHERE id = ?";

   /**
    * Return all equipments in database.
    */
   public static function getAllEquipments(): PDOStatement
   {
      return Query::execute(EquipmentController::$allEquipmentsQuery);
   }

   /**
    * Return all available equipments
    */
   public static function getAllAvailableEquipments(): PDOStatement
   {
      return Query::execute(EquipmentController::$allAvailableEquipmentsQuery);
   }

   /**
    * Find equipment by ID
    */
   public static function getEquipmentByID(string $equipmentID)
   {
      return Query::execute(EquipmentController::$findEquipmentByID, [$equipmentID]);
   }
}
