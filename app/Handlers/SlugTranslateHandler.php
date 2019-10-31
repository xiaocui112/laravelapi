<?php

namespace App\Handlers;

use Illuminate\Support\Str;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    public function translate($text)
    {
        return $this->pinyin($text);
    }
    public function pinyin($text)
    {
        return Str::slug(app(Pinyin::class)->permalink($text));
    }
}
