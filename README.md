# Laravel Taggable

Laravel Eloquent model tagging package.

## Installation

You can install the package via composer:

```bash
composer require hkp22/laravel-taggable
```

## Usage

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
$this->lesson->untag(['laravel']);

// Un-tag all tags.
$this->lesson->untag();    
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

