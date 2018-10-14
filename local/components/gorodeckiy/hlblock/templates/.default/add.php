<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

$APPLICATION->IncludeComponent(
    'gorodeckiy:hlblock.element.add',
    '',
    array(
        "HLBLOCK_ID" => $arParams["HLBLOCK_ID"],
        "FOLDER" => $arResult["FOLDER"],
    ),
    $component
);