<?php

use Bitrix\Main\Context;
use Gorodeckiy\HLBlock;

class hlblockElementAddComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        if (isset($this->arParams['HLBLOCK_ID']) && (int)$this->arParams['HLBLOCK_ID'] > 0) {
            $ID = (int)$this->arParams['HLBLOCK_ID'];
        } else {
            throw new Exception("Hight load block ID must be set.");
        }
        $this->arResult['FOLDER'] = $this->arParams['FOLDER'];

        $hlblock = HLBlock::getInstance();
        $request = Context::getCurrent()->getRequest();
        $arFields = $request->get('FIELDS');
        if (isset($arFields) && is_array($arFields)) {
            $this->arResult = array_merge($this->arResult, $hlblock->add($ID, $arFields));
        } else {
            $arFields = $hlblock->getFields($ID);
            unset($arFields['ID']);
            $this->arResult['FIELDS'] = $arFields;
        }

        $this->includeComponentTemplate();
    }
}