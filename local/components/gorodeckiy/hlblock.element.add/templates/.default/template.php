<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
$APPLICATION->SetPageProperty('title','Добавить товар');
?>

<?php if (isset($arResult['FIELDS'])):?>
    <form action="" method="post">
        <?php foreach ($arResult['FIELDS'] as $KEY => $FIELD):?>
            <input type="text" name="FIELDS[<?=$KEY?>]" required placeholder="<?=$FIELD['EDIT_FORM_LABEL']?>">
            <br/>
        <?php endforeach;?>

        <input type="submit" value="Добавить товар">
    </form>
<?php elseif (isset($arResult['IS_SUCCESS']) && $arResult['IS_SUCCESS'] == 'Y'):?>
    Элемент успешно добавлен.
<?php else:?>
    Ошибка! <?=$arResult['ERROR_MESSAGE']?>
<?php endif;?>
<br/>
<a target="_self" href="<?=$arResult['FOLDER']?>">Вернуться к списку товаров</a>
