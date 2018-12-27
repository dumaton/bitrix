<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обновление поля");

//Обновление свойства элемента инфоблока в битриксе
//Приводим расстояние до моря к метрам 

// D7
//Подключаем модуль работы с инфоблоками
use Bitrix\Main\Loader;
Loader::includeModule("iblock"); 

//елаем выбоку элементов инфоблока
$arOrder = Array("PROPERTY_KM");
$arSelect = Array("ID", "NAME", "PROPERTY_KM");
$arF = Array("IBLOCK_ID"=>3);
$res = CIBlockElement::GetList($arOrder, $arF, false, false, $arSelect);
while($ob = $res->GetNextElement()):
	$arFields = $ob->GetFields();
	if ($arFields["PROPERTY_KM_VALUE"] != ""):
	 
		//Приводим значение свойства к числовому виду
		$toFloat = str_replace(",", ".", $arFields["PROPERTY_KM_VALUE"]);
		$recalcData = $toFloat * 1000; 
		echo $arFields["PROPERTY_KM_VALUE"]." -- ".$recalcData."<br>";
		 
		$listData = $arFields2["PROPERTY_KM_VALUE"];

		$IBLOCK_ID = 3; //Ид инфоблока
		$ELEMENT_ID = $arFields["ID"];  // код элемента
		$PROPERTY_CODE = "KM";  // код свойства
		$PROPERTY_VALUE = $recalcData;  // значение свойства

		//Обновляем свойство
		CIBlockElement::SetPropertyValues($ELEMENT_ID, $IBLOCK_ID, $PROPERTY_VALUE, $PROPERTY_CODE);
	endif; 
endwhile;

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>