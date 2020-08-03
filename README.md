# Moving migrations to project root 
Example: Yii2 => basic/migrations

# Start migration 
yii migrate (yii migrate/fresh)

# Bootstrap connection
basic/config/web: 'bootstrap' => ['log', 'photo']

# Module installer
basic/config/web: 'modules' => ['photo' => ['class' => 'app\modules\photo\Module']]
