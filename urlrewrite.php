<?php
$arUrlRewrite = array(
    array(
        'CONDITION' => '#^/rest/#',
        'RULE' => '',
        'ID' => NULL,
        'PATH' => '/bitrix/services/rest/index.php',
        'SORT' => 100,
    ),
    array(
        'CONDITION' => '#^/hlblock/#',
        'RULE' => '',
        'ID' => 'gorodeckiy:hlblock',
        'PATH' => '/hlblock/index.php',
        'SORT' => 110,
    )
);
