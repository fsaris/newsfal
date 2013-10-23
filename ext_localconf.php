<?php

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tceforms_inline.php']['tceformsInlineHook'][$_EXTKEY] =
	'EXT:' . $_EXTKEY . '/Classes/Hooks/InlineElementHook.php:Tx_Newsfal_InlineElementHook';