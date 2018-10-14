<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

$APPLICATION->IncludeComponent(
    'gorodeckiy:hlblock.list',
    '',
    array(
        "HLBLOCK_ID" => $arParams["HLBLOCK_ID"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "FOLDER" => $arResult["FOLDER"],
        "URL_TEMPLATES" => $arResult["URL_TEMPLATES"]
    ),
    $component
);