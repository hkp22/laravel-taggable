# Laravel Taggable

Laravel Eloquent model tagging package.

## Installation

You can install the package via composer:

```bash
composer require hkp22/laravel-taggable
```

## Usage

### Prepare Taggable model

```php
use Hkp22\LaravelTaggable\Traits\Taggable;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Lesson extends Eloquent
{
    use Taggable;
}
```

### Registering package

Include the service provider within `app/config/app.php`:

```php
'providers' => [
    Hkp22\LaravelTaggable\TaggableServiceProvider::class,
],
```

### Tag Eloquent model
Eg: Tagging a lesson Model.

```php
$lesson->tag(['laravel', 'php']);
```
or

```php
$tags = $tags = Tag::whereIn('slug', ['laravel', 'testing'])->get();

$lesson->tag($tags);
```

### Un-tag eloquent model
Eg: Un-tagging lesson model.

```php
// Un-tag single tag.
$lesson->untag(['laravel']);

// Un-tag all tags.
$lesson->untag();    
```

### Re-tag eloquent model
```php
// Tag
$lesson->tag(['laravel', 'testing']);

// Re-tag
$lesson->retag(['laravel', 'postgres', 'redis']);
```

### Total tagged entities count.

```php
$tag = Tag::first();

$tag->count;
```

### Get model with any given tag

```php
$lessons = Lesson::withAnyTag(['php'])->get();
```

### Get model with only given tag

```php
$lessons = Lesson::withAllTags(['php', 'laravel', 'testing'])->get();
```

