<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?foreach($arResult["ITEMS"] as $key => $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<article id="<?=$this->GetEditAreaId($arItem['ID']);?>"
		class="<? if($key > 0) echo 'post-grid'; ?> post-50 post type-post status-publish format-standard has-post-thumbnail hentry category-design category-mobile category-photo category-video tag-design">
	    <!-- begin .featured-image -->
	    <div class="featured-image">
	        <a href="<?= $arItem["DETAIL_PAGE_URL"]?>">
	        	<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
		        class="attachment-fashify-thumb-default size-fashify-thumb-default wp-post-image" 
		        alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" 
		        srcset="" 
		        sizes="(max-width: 676px) 100vw, 676px" 
		        width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" 
	        	height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>">
	        </a>    
	    </div>
	        <!-- end .featured-image -->

	    <div class="entry-info">
	            <!-- begin .entry-header -->
	            <div class="entry-header">
				    <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
						<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
							<h2 class="entry-title">
			                	<a href="<?= $arItem["DETAIL_PAGE_URL"]?>" rel="bookmark"><?= $arItem["NAME"]?>
			                	</a>
			                </h2>
						<?else:?>
						<?endif;?>
					<?endif;?>

	                <div class="entry-meta">
	                    <span class="byline"> Автор
	                    	<span class="author vcard">
	                    		<span class="decor url fn n">
	                    		<?= $arItem["CREATED_USER_NAME"], $arItem["CREATED_USER_LAST_NAME"]?>
	                    		</span>
	                    	</span>
	                    </span>
	                    <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
							<span class="posted-on"> размещено 
	                    	<span rel="bookmark">
	                    	<time class="decor entry-date published" datetime="<?= $arItem["DISPLAY_ACTIVE_FROM"]?>"><?= $arItem["DISPLAY_ACTIVE_FROM"]?>
	                    	</time>
	                    	</span>
	                    </span>
						<?endif?>
						<?if(count($arItem["CATEGORIES"])):?>
	                    <span class="posted-in"> в категориях 
	                    	<?php foreach ($arItem["CATEGORIES"] as $category): ?>
	                    		<a href="<?=$category["SECTION_PAGE_URL"]?>/" rel="category tag"><?=$category["NAME"]?></a> 
	                    	<?php endforeach ?>
	                    </span>
	                    <?endif;?>
	                </div>

	            </div>
	            <!-- end .entry-header -->

				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
		            <div class="entry-content">
		                <p><?= $arItem["PREVIEW_TEXT"];?></p>
		            </div><!-- .entry-content -->
	            <?endif;?>

	            <?/*foreach($arItem["FIELDS"] as $code=>$value):?>
					<small>
					<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
					</small><br />
				<?endforeach;*/?>
				
				<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
					<small>
					<?=$arProperty["NAME"]?>:&nbsp;
					<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
						<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
					<?else:?>
						<?=$arProperty["DISPLAY_VALUE"];?>
					<?endif?>
					</small><br />
				<?endforeach;?>
	    </div>
	</article>
<?endforeach;?>

<div class="clear-both" "></div>
<!-- <?   
echo "<pre>";
	//var_dump($arResult);
	print_r($arResult["NAV_STRING"]);
echo "</pre>";
?> -->
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>