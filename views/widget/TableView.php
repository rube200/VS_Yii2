<?php

namespace app\views\widget;

use yii\grid\GridView;
use yii\helpers\Html;

class TableView extends GridView
{
    public $footer = [];

    /**
     * Runs the widget.
     */
    public function run()
    {
        $view = $this->getView();
        $id = $this->options['id'];
        parent::run();

        //this checks if footer is array and converts it to string
        $footerContent = is_array($this->footer) ? implode("\n", $this->footer) : $this->footer;

        //create div with footer content
        $tableFooter = Html::tag('div', $footerContent, ['class' => 'd-flex justify-content-end p-2']);

        //injects table footer entry at the end of table
        $view->registerJs("jQuery('#$id').append(`$tableFooter`);");
    }
}