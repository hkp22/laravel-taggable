<?php

namespace Hkp22\LaravelTaggable\Models;

use Illuminate\Database\Eloquent\Model;
use Hkp22\LaravelTaggable\Traits\TagOrderableScopes;

class Tag extends Model
{
    use TagOrderableScopes;
}
