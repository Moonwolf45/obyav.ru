<?php

namespace app\module;


use yii\base\Module;
use yii\filters\AccessControl;

/**
 * admin module definition class
 */
class admin extends Module {
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\module\controllers';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();

        // custom initialization code goes here
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
}
