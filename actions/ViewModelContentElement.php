<?php
/**
 * ViewModelActionSeo
 *
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010-2014 SkeekS (Sx)
 * @date 20.11.2014
 * @since 1.0.0
 */
namespace skeeks\cms\actions;


use skeeks\cms\models\CmsContentElement;
use Yii;

/**
 * Class ViewModelActionSeo
 * @package skeeks\cms\actions
 */
class ViewModelContentElement extends ViewModelAction
{
    /**
     * @var CmsContentElement
     */
    public $model;

    /**
     * @param $id
     * @return string
     * @throws InvalidConfigException
     * @throws \yii\web\HttpException
     */
    public function run($id)
    {
        $this->model   = CmsContentElement::findOne(['id' => $id]);

        //Пробуем рендерить view для текущего типа страницы
        if ($this->model)
        {
            if ($this->model->cmsContent)
            {
                if ($this->model->cmsContent->viewFile)
                {
                    $this->view = $this->model->cmsContent->viewFile;
                } else
                {
                    $this->view = $this->model->cmsContent->code;
                }
            }
        }

        return $this->_go();
    }

}