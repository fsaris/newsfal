<?php
/*
 * This source file is proprietary property of Beech Applications B.V.
 * Date: 23-10-2013 11:25
 * All code (c) Beech Applications B.V. all rights reserved
 */

class Tx_Newsfal_InlineElementHook implements \TYPO3\CMS\Backend\Form\Element\InlineElementHookInterface {

	/**
	 * Initializes this hook object.
	 *
	 * @param \TYPO3\CMS\Backend\Form\Element\InlineElement $parentObject
	 * @return void
	 */
	public function init(&$parentObject) {}

	/**
	 * Pre-processing to define which control items are enabled or disabled.
	 *
	 * @param string $parentUid The uid of the parent (embedding) record (uid or NEW...)
	 * @param string $foreignTable The table (foreign_table) we create control-icons for
	 * @param array $childRecord The current record of that foreign_table
	 * @param array $childConfig TCA configuration of the current field of the child record
	 * @param boolean $isVirtual Defines whether the current records is only virtually shown and not physically part of the parent record
	 * @param array &$enabledControls (reference) Associative array with the enabled control items
	 * @return void
	 */
	public function renderForeignRecordHeaderControl_preProcess($parentUid, $foreignTable, array $childRecord, array $childConfig, $isVirtual, array &$enabledControls) {

	}

	/**
	 * Post-processing to define which control items to show. Possibly own icons can be added here.
	 *
	 * @param string $parentUid The uid of the parent (embedding) record (uid or NEW...)
	 * @param string $foreignTable The table (foreign_table) we create control-icons for
	 * @param array $childRecord The current record of that foreign_table
	 * @param array $childConfig TCA configuration of the current field of the child record
	 * @param boolean $isVirtual Defines whether the current records is only virtually shown and not physically part of the parent record
	 * @param array &$controlItems (reference) Associative array with the currently available control items
	 * @return void
	 */
	public function renderForeignRecordHeaderControl_postProcess($parentUid, $foreignTable, array $childRecord, array $childConfig, $isVirtual, array &$controlItems) {
		if ($foreignTable === 'sys_file_reference' && !empty($childRecord['showinpreview'])) {
				$ll = 'LLL:EXT:news/Resources/Private/Language/locallang_db.xml:';
				$label = htmlspecialchars($GLOBALS['LANG']->sL($ll . 'tx_news_domain_model_media.showinpreview'));
				$icon = '../' . t3lib_extMgm::siteRelPath('news') . 'Resources/Public/Icons/preview.gif';
				$extraItem['showinpreview'] = ' <img title="' . $label . '" src="' . $icon . '" />';
				$controlItems = $extraItem+$controlItems;
		}
	}

}