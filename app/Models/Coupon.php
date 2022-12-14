<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function code($code)
    {
        self::where("code", $code)->first();
    }
    public function discount($total)
    {
        if ($this->type == "fixed") {
            return $this->value;
        } elseif ($this->type = "percent") {
            return round(($this->percentage / 100) * $total);
        } else {
            return 0;
        }
    }
}
