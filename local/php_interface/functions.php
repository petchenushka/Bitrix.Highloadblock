<?php

function prepareProductsUrls($FOLDER, $URL_TEMPLATES, $arItems)
{
    $result = array();
    foreach ($arItems as $ID => $ITEM) {
        $edit = $URL_TEMPLATES['edit'];
        $edit = $FOLDER.preg_replace('/#ELEMENT_ID#/', $ID, $edit);

        $delete = $URL_TEMPLATES['delete'];
        $delete = $FOLDER.preg_replace('/#ELEMENT_ID#/', $ID, $delete);

        $result[$ID] = array(
            'EDIT_PAGE_URL' => $edit,
            'DELETE_PAGE_URL' => $delete,
        );
    }
    return $result;
}