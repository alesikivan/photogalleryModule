### Moving migrations to project root 
```php
basic/modules/photo/migrations => basic/migrations
```

### Start migration 
```php
yii migrate
```

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
