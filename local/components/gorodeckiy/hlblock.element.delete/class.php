<?php

use Gorodeckiy\HLBlock;
use Bitrix\Main\Context;

class hlblockElementDeleteComponent extends CBitrixComponent
{
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

        $DEL = $request->get('DEL');
        if (isset($DEL) && $DEL == 'Y') {
            $this->arResult = array_merge($this->arResult, $hlblock->delete($ID, $ELEMENT_ID));
        } else {
            $fields = array(
                "select" => array("UF_NAME"),
                "filter" => array("ID" => $ELEMENT_ID)
            );
            $result = $hlblock->getList($ID, $fields);
            $this->arResult['FIELDS'] = $result['FIELDS'];
            $this->arResult['ITEM'] = current($result['ITEMS']);
        }

        $this->includeComponentTemplate();
    }
}