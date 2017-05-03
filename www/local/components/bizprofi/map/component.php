<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if(!CModule::IncludeModule("iblock")){
	return;
}

$arOrder = array();
$arFilter = Array(
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"ACTIVE" => "Y"
);

// get elements from infoblock company_offices
$iBblockElemCompanyOffices = CIBlockElement::GetList($arOrder, $arFilter);

while($ob = $iBblockElemCompanyOffices->GetNextElement()) { 

	$arProps = $ob->GetProperties();
	$arOffice = array(
 		"TEXT" => $arProps["name"]["VALUE"],
 		"LAT" => $arProps["lat"]["VALUE"],
 		"LON" => $arProps["lon"]["VALUE"]
 	);

 	$arResult["COMPANY_OFFICES"][] = $arOffice;
}

//if ($this->startResultCache()) {
	$arParams['MAP_ID'] =
		(strlen($arParams["MAP_ID"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["MAP_ID"])) ? 
		'MAP_'.RandString() : $arParams['MAP_ID']; 

	if (($strPositionInfo = $arParams['~MAP_DATA']) && CheckSerializedData($strPositionInfo) && ($arResult['POSITION'] = unserialize($strPositionInfo)))
	{
		if (is_array($arResult['POSITION']) && is_array($arResult['POSITION']['PLACEMARKS']) && ($cnt = count($arResult['POSITION']['PLACEMARKS'])))
		{
			for ($i = 0; $i < $cnt; $i++)
			{
				$arResult['POSITION']['PLACEMARKS'][$i]['TEXT'] = str_replace('###RN###', "\r\n", $arResult['POSITION']['PLACEMARKS'][$i]['TEXT']);
			}
		}

		if (is_array($arResult['POSITION']) && is_array($arResult['POSITION']['POLYLINES']) && ($cnt = count($arResult['POSITION']['POLYLINES'])))
		{
			for ($i = 0; $i < $cnt; $i++)
			{
				$arResult['POSITION']['POLYLINES'][$i]['TITLE'] = str_replace('###RN###', "\r\n", $arResult['POSITION']['POLYLINES'][$i]['TITLE']);
			}
		}
	}

	
//}
$this->IncludeComponentTemplate();
?>