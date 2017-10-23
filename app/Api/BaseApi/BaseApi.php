<?php

namespace T4C\Api;

interface BaseApi
{
  public static function find($id);
  public static function findAll();
  public static function create($data);
  public static function update(array $data);
  public static function delete($id);
}
