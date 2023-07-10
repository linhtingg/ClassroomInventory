<?php
// ROOMS
function printRooms()
{
   $rooms = [];
   for ($buildingNum = 3; $buildingNum <= 9; $buildingNum += 2) {
      $building = "D" . $buildingNum;
      for ($floor = 1; $floor <= 5; $floor++) {
         for ($roomNum = 1; $roomNum <= 6; $roomNum++) {
            $roomID = $building . "_" . $floor . "0" . $roomNum;
            array_push($rooms, $roomID);
            // echo "INSERT INTO room VALUES ('" . $roomID . "',150,1,'Phòng trống','Morning,Afternoon,Evening');\n";
         }
      }
   }
   return $rooms;
}
// EQUIPMENTS
function printEquipments()
{
   $equipments = [];
   $equipmentInfo = [['Oscilloscope', 'OSC'], ['Biến áp', 'TRA'], ['Bảng mạch', 'CIR'], ['Microphone', 'MIC']];
   for ($i = 0; $i < count($equipmentInfo); $i++) {
      $eType = $equipmentInfo[$i][0];
      $id = $equipmentInfo[$i][1];
      for ($j = 0; $j < 10; $j++) {
         for ($k = 0; $k < 10; $k++) {
            $equipmentID =  $id . "_0" . $j . $k;
            array_push($equipments, $equipmentID);
            // echo "INSERT INTO equipment VALUES (" . "'" . $eType . "','"  . $equipmentID . "', 0, 2023, 'OK', NULL, NULL, NULL, 1);\n";
         }
      }
   }
   return $equipments;
}

// for ($i = 10; $i <= 390; $i += 10) {
//    getAvailableEquipments(printEquipments(), $i);
// }

function getAvailableEquipments(array $arr, int $length)
{
   shuffle($arr);
   $result = $arr[0][1];
   echo "[[['" . $arr[0][0] . "', " . $arr[0][1] . "]";
   for ($i = 1; $i < $length; $i++) {
      echo ", ['" . $arr[$i][0] . "', " . $arr[$i][1] . "]";
      if ($arr[$i][1] == 1)
         $result++;
   }
   echo "], " . $result . "],\n";
}






function get(array $arr, int $length)
{
   shuffle($arr);
   echo "[['" . $arr[0] . "'";
   for ($i = 1; $i < $length; $i++) {
      echo ", '" . $arr[$i] . "'";
   }
   echo "], " . $length . "],\n";
}
function findRooms(array $rooms, int $length)
{
   $random = rand(0, 1) == 1 ? true : false;
   shuffle($rooms);
   echo "[['" . $rooms[0] . "'";
   for ($i = 1; $i < $length; $i++) {
      echo ", '" . $rooms[$i] . "'";
   }
   $needFind = $rooms[$random ? rand(0, $length - 1) : $length];
   echo "], '" . $needFind . "', " . ($random ? "true" : "false") . "],\n";
}

// $rooms = printEquipments();

// for ($i = 10; $i <= 90; $i += 10) {
//    findRooms($rooms, $i);
// }
include_once '/xampp/htdocs/class/helper/NotificationHandler.php';
include_once '/xampp/htdocs/class/helper/QueryHandler.php';
$query = Query::execute("SELECT * FROM room where ");
if ($query != null) {
   Notification::echoToScreen("PASS");
}
