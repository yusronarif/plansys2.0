<?php

class DataGridListForm extends Form {

    public $name        = '';
    public $label       = '';
    public $options     = [];
    public $typeOptions = [
        'string' => ['inputMask', 'options', 'stringAlias'],
        'buttons' => ['buttonCollapsed', 'buttons', 'options'],
        'dropdown' => ['listType', 'listExpr', 'listMustChoose', 'options'],
        'relation' => ['relParams', 'relCriteria', 'relModelClass', 'relIdField', 'relLabelField', 'options']
    ];
    public $inputMask   = '';
    public $stringAlias = [];

    ### string options
    public $buttonCollapsed = 'Yes';
    public $buttons         = null;

    ### button Options
    public $listType       = 'php';
    public $listExpr       = '';

    ### dropdown Options
    public $listMustChoose = 'No';
    public $relParams     = [];
    public $relCriteria   = [
        'select' => '',
        'distinct' => 'false',
        'alias' => 't',
        'condition' => '{[search]}',
        'order' => '',
        'group' => '',
        'having' => '',
        'join' => ''
    ];

    ### relation Options
    public $relModelClass = '';
    public $relIdField    = '';
    public $relLabelField = '';
    public $columnType = 'string';

    public function getFields() {
        return array (
            array (
                'type' => 'Text',
                'value' => '<div ng-init=\"value[$index].show = false\" style=\"cursor:pointer;padding-bottom:1px;\" ng-click=\"value[$index].show = !value[$index].show\">
<div class=\"label data-filter-name pull-right\">
{{value[$index].columnType}}</div>
{{value[$index].label}}
<div class=\"clearfix\"></div>
</div>',
            ),
            array (
                'type' => 'Text',
                'value' => '<hr ng-if=\"value[$index].show\"
style=\"margin:4px -12px 6px -4px;float:left;width:100%;padding:0px 4px;\" />',
            ),
            array (
                'type' => 'Text',
                'value' => '<div ng-if=\'value[$index].show\'>',
            ),
            array (
                'type' => 'Text',
            ),
            array (
                'label' => 'Type',
                'name' => 'columnType',
                'options' => array (
                    'ng-model' => 'value[$index].columnType',
                    'ng-change' => 'updateListView()',
                ),
                'labelOptions' => array (
                    'style' => 'text-align:left;',
                ),
                'list' => array (
                    'string' => 'String',
                    'buttons' => 'Buttons',
                    'dropdown' => 'Dropdown',
                    'relation' => 'Relation',
                ),
                'labelWidth' => '3',
                'fieldWidth' => '9',
                'type' => 'DropDownList',
            ),
            array (
                'label' => 'Col. Name',
                'name' => 'name',
                'options' => array (
                    'ng-model' => 'value[$index].name',
                    'ng-change' => 'updateListView()',
                    'ng-delay' => '500',
                    'ng-if' => 'value[$index].columnType != \'buttons\'',
                ),
                'labelOptions' => array (
                    'style' => 'text-align:left;',
                ),
                'fieldOptions' => array (
                    'class' => 'list-view-item-text',
                ),
                'type' => 'TextField',
            ),
            array (
                'label' => 'Header',
                'name' => 'label',
                'options' => array (
                    'ng-model' => 'value[$index].label',
                    'ng-change' => 'updateListView()',
                    'ng-delay' => '500',
                ),
                'labelOptions' => array (
                    'style' => 'text-align:left;',
                ),
                'type' => 'TextField',
            ),
            array (
                'name' => 'TypeString',
                'subForm' => 'application.components.ui.FormFields.DataGridListFormString',
                'options' => array (
                    'ng-if' => 'value[$index].columnType == \'string\'',
                ),
                'inlineJS' => 'DataGrid/inlinejs/dg-type.js',
                'type' => 'SubForm',
            ),
            array (
                'name' => 'TypeDropDown',
                'subForm' => 'application.components.ui.FormFields.DataGridListFormDropdown',
                'options' => array (
                    'ng-if' => 'value[$index].columnType == \'dropdown\'',
                ),
                'inlineJS' => 'DataGrid/inlinejs/dg-type.js',
                'type' => 'SubForm',
            ),
            array (
                'name' => 'TypeButton',
                'subForm' => 'application.components.ui.FormFields.DataGridListFormButton',
                'options' => array (
                    'ng-if' => 'value[$index].columnType == \'buttons\'',
                ),
                'inlineJS' => 'DataGrid/inlinejs/dg-type.js',
                'type' => 'SubForm',
            ),
            array (
                'name' => 'TypeRelation',
                'subForm' => 'application.components.ui.FormFields.DataGridListFormRelation',
                'options' => array (
                    'ng-if' => 'value[$index].columnType == \'relation\'',
                ),
                'inlineJS' => 'DataGrid/inlinejs/dg-type.js',
                'type' => 'SubForm',
            ),
            array (
                'label' => 'Options',
                'name' => 'options',
                'show' => 'Show',
                'options' => array (
                    'ng-model' => 'value[$index].options',
                    'ng-change' => 'updateListView()',
                ),
                'type' => 'KeyValueGrid',
            ),
            array (
                'type' => 'Text',
                'value' => '<div style=\'margin-bottom:-3px;\'></div>',
            ),
            array (
                'type' => 'Text',
                'value' => '</div>',
            ),
        );
    }

    ### columnType

    public function getForm() {
        return [
            'formTitle' => 'DataFilterListForm',
            'layout' => [
                'name' => 'full-width',
                'data' => [
                    'col1' => [
                        'type' => 'mainform',
                    ],
                ],
            ],
        ];
    }

}