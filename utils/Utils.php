<?php

class Utils
{
  public static function getFieldWithFallback($array, $key)
  {
    return isset($array[$key]) ? $array[$key] : null;
  }

  public static function jsonEncodeObjectArray($array)
  {
    $encodedArray = [];
    foreach ($array as $item) {
      $encodedItem = $item->jsonSerialize();

      // check if object contain property is a object 
      // and that property object contain jsonSerialize method
      foreach($encodedItem as $key => $value) {
        if(is_object($value) && method_exists($value, 'jsonSerialize')) {
          $encodedItem[$key] = $value->jsonSerialize();
        }
      }

      array_push($encodedArray, $encodedItem);
    }

    return $encodedArray;
  }
}
