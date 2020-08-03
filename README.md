### Moving migrations to project root 

```php
Example: Yii2 => basic/migrations
```

### Start migration 
yii migrate (yii migrate/fresh)

### Bootstrap connection
basic/config/web:
```php
'bootstrap' => ['log', 'photo']
```
### Module installer
basic/config/web: 
```php
'modules' => 
  [
    'photo' => [
      'class' => 'app\modules\photo\Module'
      ]
  ]
```
