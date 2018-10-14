<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
$APPLICATION->SetPageProperty('title','Удалить товар');
?>


<?php if (isset($arResult['IS_SUCCESS']) && $arResult['IS_SUCCESS'] == 'Y'):?>
    Элемент успешно удален.
<?php elseif(isset($arResult['IS_SUCCESS']) && $arResult['IS_SUCCESS'] == 'N'):?>
    Ошибка! <?=$arResult['ERROR_MESSAGE']?>
<?php else:?>
    Вы действительно хотите удалить товар <b><?=$arResult['ITEM']['UF_NAME']?></b>?
    <form action="" method="post">
        <button type="submit" name="DEL" value="Y">Да</button>
    </form>
<?php endif;?>
<br/>
<a target="_self" href="<?=$arResult['FOLDER']?>">Вернуться к списку товаров</a>
