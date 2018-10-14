<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Товары');
?>
<h1><?=$APPLICATION->ShowTitle()?></h1>
<?php
$APPLICATION->IncludeComponent(
    'gorodeckiy:hlblock',
    '',
    array(
        'HLBLOCK_ID' => 1,
        'CACHE_TIME' => 86400,
        'SEF_MODE' => 'Y',
        'SEF_FOLDER' => '/hlblock/',
        'SEF_URL_TEMPLATES' => array(
            'list' => '',
            'add' => 'add/',
            'edit' => 'edit/#ELEMENT_ID#/',
            'delete' => 'delete/#ELEMENT_ID#/',
        ),
    )
);
?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>