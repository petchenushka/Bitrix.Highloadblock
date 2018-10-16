<?php

use Gorodeckiy\HLBlock;
use Bitrix\Main\Context;

class hlblockElementEditComponent extends CBitrixComponent
{
    const DEFAULT_CACHE_TIME = 86400;

    public function executeComponent()
    {
        $hlblock = HLBlock::getInstance();
        $request = Context::getCurrent()->getRequest();

        if (isset($this->arParams['HLBLOCK_ID']) && (int)$this->arParams['HLBLOCK_ID'] > 0) {
            $ID = (int)$this->arParams['HLBLOCK_ID'];
        } else {
            throw new Exception("Hight load block ID must be set.");
        }

        if (isset($this->arParams['ELEMENT_ID']) && (int)$this->arParams['ELEMENT_ID'] > 0) {
            $ELEMENT_ID = (int)$this->arParams['ELEMENT_ID'];
        } else {
            throw new Exception("ELEMENT_ID must be set.");
        }

        $this->arResult['FOLDER'] = $this->arParams['FOLDER'];

        $fields = $request->get('FIELDS');
        if (isset($fields) && is_array($fields)) {
            $this->arResult = array_merge($this->arResult, $hlblock->update($ID, $ELEMENT_ID, $fields));
        }

        $fields = array(
            "select" => array("UF_*"),
            "filter" => array("ID" => $ELEMENT_ID)
        );
        $result = $hlblock->getList($ID, $fields);
        $this->arResult['FIELDS'] = $result['FIELDS'];
        $this->arResult['ITEM'] = current($result['ITEMS']);

        $this->includeComponentTemplate();
    }
}