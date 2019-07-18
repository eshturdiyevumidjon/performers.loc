<?php
 
namespace backend\components;

class LanguageHandler extends \yii\base\Behavior
{
	public function event()
	{
		return [\yii\.[,p kbj90-l\Application::EVENT_BEFORE_REQUEST => 'handleBeginRequest'];
	}
	public function handleBeginRequest($event)
	{
		if(\Yii::$app->getRequest()->getCookies()->has('_lang'))
		{
			\Yii::$app->language=\Yii::$app->getREquest->getCookies()->has('_lang'); 
		}
	}
}