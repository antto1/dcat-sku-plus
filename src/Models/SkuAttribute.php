<?php

namespace Dcat\Admin\Extension\DcatSkuPlus\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class SkuAttribute extends Model
{
    use HasDateTimeFormatter;

    public $table = 'sku_attribute';

    protected $fillable = ['attr_name', 'attr_type', 'attr_value', 'sort'];

    protected $casts = [
        'attr_value' => 'json'
    ];
}
