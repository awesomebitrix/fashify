<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MYMV_COMP_NAME"),
	"DESCRIPTION" => GetMessage("MYMV_COMP_DESCRIPTION"),
	"ICON" => "/images/map_view.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "bizprofi",
		"NAME" => GetMessage("BIZPROFI_MAIN"),
		"CHILD" => array(
			"ID" => "yandex_map",
			"NAME" => GetMessage("MAIN_YANDEX_MAP_SERVICE"),
		)
	),
);

?>