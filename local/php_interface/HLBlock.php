<?php

namespace Gorodeckiy;

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\UserFieldTable;


class HLBlock
{
    protected static $_instance;

    private function __construct()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new Exception('Highloadblock is not found');
        }
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    private function __clone()
    {
    }

    public function getFields($id)
    {
        if ($id > 0) {
            $arFields = array(
                'ID' => array(
                    'EDIT_FORM_LABEL' => 'Ид',
                    'LIST_COLUMN_LABEL' => 'Ид',
                    'LIST_FILTER_LABEL' => 'Ид'
                )
            );
            $arFields = array_merge(
                $arFields,
                $GLOBALS['USER_FIELD_MANAGER']->GetUserFields('HLBLOCK_'.$id, 0, LANGUAGE_ID)
            );
            return $arFields;
        }

        return false;
    }

    public function getList($id, $params)
    {
        if ($id > 0 && is_array($params)) {
            $hlblock = HL\HighloadBlockTable::getById($id)->fetch();
            if ($hlblock) {
                $entity = HL\HighloadBlockTable::compileEntity($hlblock);
                $entity_data_class = $entity->getDataClass();

                $rsData = $entity_data_class::getList($params);
                $arFields = self::getFields($id);

                $arItems = array();
                while($arData = $rsData->Fetch()){
                    $arItems[$arData['ID']] = $arData;
                }
                return array('FIELDS' => $arFields, 'ITEMS' => $arItems);
            }
        }

        return false;
    }

    public function add($id, $params)
    {
        $result = array('IS_SUCCESS' => 'N');
        if ($id > 0 && is_array($params)) {
            $hlblock = HL\HighloadBlockTable::getById($id)->fetch();

            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();

            $obResult = $entity_data_class::add($params);
            $entity->cleanCache();

            if (!$obResult->isSuccess()) {
                $result['ERROR_MESSAGE'] = current($obResult->getErrorMessages());
            } else {
                $result['IS_SUCCESS'] = 'Y';
            }
        }

        return $result;
    }

    public function update($id, $element_id, $params)
    {
        $result = array('IS_SUCCESS' => 'N');
        if ($id > 0 && $element_id > 0 && is_array($params)) {
            $hlblock = HL\HighloadBlockTable::getById($id)->fetch();

            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();

            $obResult = $entity_data_class::update($element_id, $params);
            $entity->cleanCache();

            if (!$obResult->isSuccess()) {
                $result['ERROR_MESSAGE'] = current($obResult->getErrorMessages());
            } else {
                $result['IS_SUCCESS'] = 'Y';
            }
        }

        return $result;
    }

    public function delete($id, $element_id)
    {
        $result = array('IS_SUCCESS' => 'N');
        if ($id > 0 && $element_id > 0) {
            $hlblock = HL\HighloadBlockTable::getById($id)->fetch();

            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();

            $obResult = $entity_data_class::Delete($element_id);
            $entity->cleanCache();

            if (!$obResult->isSuccess()) {
                $result['ERROR_MESSAGE'] = current($obResult->getErrorMessages());
            } else {
                $result['IS_SUCCESS'] = 'Y';
            }
        }

        return $result;
    }
}