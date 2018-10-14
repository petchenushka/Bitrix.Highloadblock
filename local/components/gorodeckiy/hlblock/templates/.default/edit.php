<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

$APPLICATION->IncludeComponent(
    'gorodeckiy:hlblock.element.edit',
    '',
    array(
        "HLBLOCK_ID" => $arParams["HLBLOCK_ID"],
        "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
        "FOLDER" => $arResult["FOLDER"],
    ),
    $component
);