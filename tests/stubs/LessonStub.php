<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use Hkp22\LaravelTaggable\Traits\Taggable;

class LessonStub extends Eloquent
{
    use Taggable;

    protected $connection = 'testbench';

    public $table = 'lessons';

}