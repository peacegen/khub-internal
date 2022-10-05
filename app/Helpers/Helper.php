<?php
namespace App\Helpers;

use App\Models\Tag;

class Helper
{
    public static function getSomeData()
    {
        return 'some data';
    }

    public static function getTagNameArray()
    {
        return Tag::all()->pluck('name')->toArray();
    }

    public static function getTags()
    {
        return Tag::all();
    }
}
