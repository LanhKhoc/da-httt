<?php

class vendor_validator_util {
  private function requiredField($value) {
    if(!strlen(trim($value))) { return ['status' => false, 'message' => "This field can not blank!"]; }
    return ['status' => true];
  }

  private function regexField($value, $regex) {
    if (!!preg_match($regex, $value)) { return ['status' => false, 'message' => 'Invalid format!']; }
    return ['status' => true];
  }

  private function dateField($value) {
    try {
      $dt = new DateTime(trim($value));
    } catch (Exception $e) {
      return ['status' => false, 'message' => 'Invalid date format!'];
    }

    $month = $dt->format('m');
    $day = $dt->format('d');
    $year = $dt->format('Y');

    if (checkdate($month, $day, $year)) { return ['status' => true]; }
    return ['status' => false, 'message' => 'Invalid date format!'];
  }

  private function emailField($value) {
    if (filter_var($value, FILTER_VALIDATE_EMAIL)) { return ['status' => true]; }
    return ['status' => false, 'message' => "Invalid email format!"];
  }

  public function numberField($value) {
    if (is_numeric($value)) { return ['status' => true]; }
		return ['status' => false, 'message' => "The type of this field should be number!"];
  }

  public function maxField($value, $length) {
    if(strlen($value) > $length) { return ['status' => false, 'message' => "This field can not more than $length character!"]; }
		return ['status' => true];
  }

  public function minField($value, $length) {
    if(strlen($value) < $length) { return ['status' => false, 'message' => "This field can not less than $length character!"]; }
		return ['status' => true];
  }

  public function inField($value, $in) {
    $arr = explode(',', $in);
    if (in_array($value, $arr)) { return ['status' => true]; }
    return ['status' => false, 'message' => "Value of this field should in " . implode(", ", $arr)];
  }

  public function validate($rules, $data) {
    $res = ['status' => true, 'message' => []];

    foreach ($data as $key => $value) {
      if (isset($rules[$key])) {
        foreach (explode('|', $rules[$key]) as $rule) {
          $nameRule = explode(':', $rule)[0];
          $valueRule = isset(explode(':', $rule)[1]) ? explode(':', $rule)[1] : '';

          if ($valueRule == '') { $result = $this->{$nameRule.'Field'}($value); }
          else { $result = $this->{$nameRule.'Field'}($value, $valueRule); }

          if ($result['status'] == false) {
            $res['status'] = false;
            $res['message'][$key] = $result['message'];
          }
        }
      }
    }

    return $res;
  }
}