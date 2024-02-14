<?php 
/**
 * Abstract class that every type of field includes.
 * It contains usefull methods avaiable to all fields and 
 * describe what properties all fields will have
 * 
 * 
 */
abstract class Field {
  
  private string $isNullable;

  function __to_Array() {}

  /**
   * @param string $name column/field name
   * @param string $type MySQL column data type
   * @param int $length length of the field
   * @param bool $null is the field nullable or not
   */
  function __construct(
    public string $name,
    public string $type,
    public int    $length,
    public bool   $null,
  ) 
  {
    $this->isNullable = $null ? "NULL" : "NOT NULL";
  }

  /**
   * Magic method overload. 
   * Prints the name, type, length and nullable properties of given field
   * 
   * @return string A string with given format: `fieldName fieldType(fieldLength) fieldNullability` so for example `name VARCHAR(100) NOT NULL`
   */
  public function __toString() :string
  {
    $name = "'\033[1;32m$this->name\033[0m' ";
    $type = "\033[36m$this->type\033[0m";
    $length = "(\033[31m$this->length\033[0m) ";
    $null = "$this->isNullable";

    return $name . $type . $length . $null;
  }
} 

?>