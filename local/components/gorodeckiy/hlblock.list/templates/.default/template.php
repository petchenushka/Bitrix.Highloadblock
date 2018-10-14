<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
$APPLICATION->SetPageProperty('title','Список товаров');
?>
<div class="hlblock-list">
    <a class="btn" target="_self" href="<?=$arResult['URLS']['ADD']?>">Добавить товар</a>
    <table>
        <thead>
            <tr>
                <?php foreach ($arResult['FIELDS'] as $KEY => $FIELD):?>
                    <th><?=$FIELD['LIST_COLUMN_LABEL']?></th>
                <?php endforeach;?>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($arResult['ITEMS'] as $ID => $arFields):?>
            <tr>
                <?php foreach ($arFields as $value):?>
                    <td><?=$value?></td>
                <?php endforeach;?>
                <td>
                    <a class="svg pencil" href="<?=$arResult['URLS'][$ID]['EDIT_PAGE_URL']?>"></a>
                    <a class="svg bin" href="<?=$arResult['URLS'][$ID]['DELETE_PAGE_URL']?>"></a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>