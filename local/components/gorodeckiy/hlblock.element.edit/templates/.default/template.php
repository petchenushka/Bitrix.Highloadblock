<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
$APPLICATION->SetPageProperty('title','Редактировать товар');
?>


<?php if (isset($arResult['IS_SUCCESS']) && $arResult['IS_SUCCESS'] == 'Y'):?>
    Элемент успешно обновлен.
<?php elseif (isset($arResult['IS_SUCCESS']) && $arResult['IS_SUCCESS'] == 'N'):?>
    Ошибка! <?=$arResult["ERROR_MESSAGE"]?>
<?php endif;?>
<br/>
<a target="_self" href="<?=$arResult['FOLDER']?>">Вернуться к списку товаров</a>
<br/>
<form action="" method="post">
    <?php foreach ($arResult['ITEM'] as $KEY => $FIELD):?>
        <?=$arResult['FIELDS'][$KEY]['EDIT_FORM_LABEL']?>: <input type="text" name="FIELDS[<?=$KEY?>]" value="<?=$FIELD?>">
        <br/>
    <?php endforeach;?>
    <input type="submit" value="Сохранить">
</form>