<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class spaceRule implements Rule
{

  private $req;
  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct($req)
  {
    $this->req = $req;
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value)
  {
    (mb_ereg_match("^(\s|　)+$", $value)) ? true : false;
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return 'スペースのみの送信はできません';
  }
}
