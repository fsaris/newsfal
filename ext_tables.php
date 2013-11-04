<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

/**
 * Add extra field fal_media to News domain record
 */
$newNewsColumns = array(
	'fal_media' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:news/Resources/Private/Language/locallang_db.xml:tx_news_domain_model_news.media',
		'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'media',
			array(
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:newsfal/locallang_db.xml:media.addFileReference'
				),
				// custom configuration for displaying fields in the overlay/reference table
				// to use the newsPalette and imageoverlayPalette instead of the basicoverlayPalette
				'foreign_types' => array(
					'0' => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette'
					)
				)
			),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
		)
	),
	'fal_related_files' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:news/Resources/Private/Language/locallang_db.xml:tx_news_domain_model_news.related_files',
		'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'related_files',
			array(
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:newsfal/locallang_db.xml:related_files.addFileReference'
				),
			)
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $newNewsColumns, 1);

// add or replace the old media field?
if (TRUE) {
	foreach ($GLOBALS['TCA']['tx_news_domain_model_news']['types'] as $key => $config) {
		$GLOBALS['TCA']['tx_news_domain_model_news']['types'][$key]['showitem'] = str_replace(array(',media,', ',related_files,'), array(',fal_media,', ',fal_related_files,'), $config['showitem']);
	}
} else {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'fal_media');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'fal_related_files');
}


/**
 * Add extra field showinpreview and some special news controlls to sys_file_reference record
 */
$newSysFileReferenceColumns = array(
	'showinpreview' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:news/Resources/Private/Language/locallang_db.xml:tx_news_domain_model_media.showinpreview',
		'config' => array(
			'type' => 'check',
			'default' => 0
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference', $newSysFileReferenceColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_file_reference', 'showinpreview');

// add special news palette
$GLOBALS['TCA']['sys_file_reference']['palettes']['newsPalette'] = array(
	'showitem' => 'showinpreview',
	'canNotCollapse' => TRUE
);
