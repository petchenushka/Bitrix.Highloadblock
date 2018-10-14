<?php

use Bitrix\Main\Loader;
use Gorodeckiy\HLBlock;

class hlblockListComponent extends CBitrixComponent
{
    const DEFAULT_CACHE_TIME = 86400;

    public function executeComponent()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new Exception('Highloadblock is not found');
        }

        if (isset($this->arParams['HLBLOCK_ID']) && (int)$this->arParams['HLBLOCK_ID'] > 0) {
            $ID = (int)$this->arParams['HLBLOCK_ID'];
        } else {
            throw new Exception("Hight load block ID must be set.");
        }

        if (isset($this->arParams['CACHE_TIME']) && (int)$this->arParams['CACHE_TIME'] > 0) {
            $TTL = (int)$this->arParams['CACHE_TIME'];
        } else {
            $TTL = self::DEFAULT_CACHE_TIME;
        }

        $hlblock = HLBlock::getInstance();
        $params = array(
            'cache' => array(
                'ttl' => $TTL
            )
        );
        $this->arResult = $hlblock->getList($ID, $params);
        $this->arResult['URLS'] = prepareProductsUrls(
            $this->arParams['FOLDER'],
            $this->arParams['URL_TEMPLATES'],
            $this->arResult['ITEMS']
        );
        $this->arResult['URLS']['ADD'] = $this->arParams['FOLDER'].$this->arParams['URL_TEMPLATES']['add'];

        $this->includeComponentTemplate();
    }
}