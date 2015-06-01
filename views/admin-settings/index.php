<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 27.03.2015
 *
 * @var $loadedComponents
 * @var $component \skeeks\cms\base\Component
 */
/* @var $this yii\web\View */

?>

<?/* \skeeks\cms\modules\admin\widgets\Pjax::begin([
    'id' => 'widget-select-component'
]) */?>
<form id="selector-component" action="" method="get" data-pjax>
    <label>Компонент или модуль</label>
    <?=
    \skeeks\widget\chosen\Chosen::widget([
        'name' => 'component',
        'items' => $loadedForSelect,
        'value' => $component->className()
    ])
    ?>
</form>
<iframe data-src="<?= $component->getEditUrl(); ?>" width="100%;" height="200px;" id="sx-test">

</iframe>

<?
$this->registerJs(<<<JS
(function(sx, $, _)
{
    sx.classes.SelectorComponent = sx.classes.Component.extend({

        _init: function()
        {
            this.Iframe = new sx.classes.Iframe('sx-test', {
                'autoHeight'        : true,
                'heightSelector'    : '.sx-panel-content'
            });
        },

        _onDomReady: function()
        {
            $("#selector-component select").on('change', function()
            {
                $("#selector-component").submit();
            });

            _.delay(function()
            {
                $('#sx-test').attr('src', $('#sx-test').data('src'));
            }, 200);
        },

        _onWindowReady: function()
        {}
    });

    new sx.classes.SelectorComponent();
})(sx, sx.$, sx._);
JS
)
?>

<?/* \skeeks\cms\modules\admin\widgets\Pjax::end(); */?>