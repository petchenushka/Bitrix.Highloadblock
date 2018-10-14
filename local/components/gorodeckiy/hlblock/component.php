<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

$arDefaultUrlTemplates404 = array(
    "list" => "",
    "add"  => "add/#ELEMENT_ID#/",
    "edit" => "edit/#ELEMENT_ID#/"
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array("ELEMENT_ID", "ADD", "DELETE");


$SEF_FOLDER = "";
$arUrlTemplates = array();

if ($arParams["SEF_MODE"] == "Y")
{
    $arVariables = array();

    $arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates(
        $arDefaultUrlTemplates404,
        $arParams["SEF_URL_TEMPLATES"]
    );

    $arVariableAliases = CComponentEngine::MakeComponentVariableAliases(
        $arDefaultVariableAliases404,
        $arParams["VARIABLE_ALIASES"]
    );

    $componentPage = CComponentEngine::ParseComponentPath(
        $arParams["SEF_FOLDER"],
        $arUrlTemplates,
        $arVariables
    );

    if (strlen($componentPage) <= 0) {
        $componentPage = "list";
    }

    CComponentEngine::InitComponentVariables(
        $componentPage,
        $arComponentVariables,
        $arVariableAliases,
        $arVariables
    );

    $SEF_FOLDER = $arParams["SEF_FOLDER"];
}
else
{
    $arVariables = array();

    $arVariableAliases = CComponentEngine::MakeComponentVariableAliases(
        $arDefaultVariableAliases,
        $arParams["VARIABLE_ALIASES"]
    );
    CComponentEngine::InitComponentVariables(
        false,
        $arComponentVariables,
        $arVariableAliases,
        $arVariables
    );

    $componentPage = "";
    if (intval($arVariables["ELEMENT_ID"]) > 0){
        if ($arVariables['DELETE'] == 'Y') {
            $componentPage = "delete";
        } else {
            $componentPage = "edit";
        }
    } elseif ($arVariables['ADD'] == 'Y') {
        $componentPage = "add";
    } else {
        $componentPage = "list";
    }

    $SEF_FOLDER = '/';
    $arUrlTemplates = array(
        'add' => '?ADD=Y',
        'edit' => '?ELEMENT_ID=#ELEMENT_ID#',
        'delete' => '?ELEMENT_ID=#ELEMENT_ID#&DELETE=Y',
    );
}

$arResult = array(
    "FOLDER" => $SEF_FOLDER,
    "URL_TEMPLATES" => $arUrlTemplates,
    "VARIABLES" => $arVariables,
    "ALIASES" => $arVariableAliases
);

$this->IncludeComponentTemplate($componentPage);