<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обновление поля");

//Обновление свойства элемента инфоблока в битриксе
//Объединение нескольких свойств типа список с одним чекбоксом в одно свойство с несколькими чекбоксами

// D7
//Подключаем модуль работы с инфоблоками
use Bitrix\Main\Loader;
Loader::includeModule("iblock"); 

//Делаем выбоку элементов инфоблока
$arOrder = Array("PROPERTY_FEATURES");
$arSelect = Array("ID", "NAME", "PROPERTY_FEATURES", "PROPERTY_POOL", "PROPERTY_CONCIERGE", "PROPERTY_REPAIR", "PROPERTY_BALCONY", "PROPERTY_PARKING");
$arF = Array("IBLOCK_ID"=>3);
$res = CIBlockElement::GetList($arOrder, $arF, false, false, $arSelect);
while($ob = $res->GetNextElement()):
	$arFields = $ob->GetFields();

	$setProperty = array();
	//print_r($arFields);
	if ($arFields["PROPERTY_POOL_VALUE"] == "да") $setProperty[] = 60;
	if ($arFields["PROPERTY_CONCIERGE_VALUE"] == "да") $setProperty[] = 61;
	if ($arFields["PROPERTY_REPAIR_VALUE"] == "да") $setProperty[] = 62;
	if ($arFields["PROPERTY_BALCONY_VALUE"] == "да") $setProperty[] = 63;
	if ($arFields["PROPERTY_PARKING_VALUE"] == "да") $setProperty[] = 64;
	
	print_r($setProperty);
	 	 
		$IBLOCK_ID = 3; //Ид инфоблока
		$ELEMENT_ID = $arFields["ID"];  // код элемента
		$PROPERTY_CODE = "FEATURES";  // код свойства
		$PROPERTY_VALUE = $setProperty;  // значение свойства

		//Обновляем свойство
		CIBlockElement::SetPropertyValues($ELEMENT_ID, $IBLOCK_ID, $PROPERTY_VALUE, $PROPERTY_CODE);
endwhile;

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>