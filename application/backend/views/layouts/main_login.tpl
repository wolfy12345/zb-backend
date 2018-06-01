<?php
use app\app\backend\components\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?php echo Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>">
        <?php Html::csrfMetaTags(); ?>
        <title><?php echo '微信后台管理系统-'.Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="login">
        <?php $this->beginBody();?>

        <div class="content">
            <?php echo Html::csrfMetaTags() ?>
            <?php echo $content;?>
        </div>
        <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>