<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
$tempColumns = array (
	'tx_ghinfoblock_infoblock' => array (
		'exclude' => 0,
		'label' => 'LLL:EXT:gh_infoblock/locallang_db.xml:tt_content.tx_ghinfoblock_infoblock',
		'config' => array (
			'type' => 'text',
			'cols' => '30',
			'rows' => '5',
			'wizards' => array(
				'_PADDING' => 2,
				'RTE' => array(
					'notNewRecords' => 1,
					'RTEonly'       => 1,
					'type'          => 'script',
					'title'         => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
					'icon'          => 'wizard_rte2.gif',
					'script'        => 'wizard_rte.php',
				),
			),
		)
	),
);


t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('tt_content','--div--;InfoBlock, tx_ghinfoblock_infoblock;;;richtext[]:rte_transform[flag=rte_enabled|mode=ts];1-1-1, --div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access', '', 'after:text-properties,before:starttime');

if(t3lib_extMgm::isLoaded('lorem_ipsum')) {
		// Bodytext field in Content Elements:
	$wizConfig = array(
		'type' => 'userFunc',
		'userFunc' => 'EXT:lorem_ipsum/class.tx_loremipsum_wiz.php:tx_loremipsum_wiz->main',
		'params' => array()
	);

	$TCA['tt_content']['columns']['tx_ghinfoblock_infoblock']['config']['wizards']['_VERTICAL'] = 1;
	$TCA['tt_content']['columns']['tx_ghinfoblock_infoblock']['config']['wizards']['tx_loremipsum_2'] =
		array_merge($wizConfig,array('params'=>array(
			'type' => 'loremipsum',
			'endSequence' => '32',
			'add'=>TRUE
		)));
	$TCA['tt_content']['columns']['tx_ghinfoblock_infoblock']['config']['wizards']['tx_loremipsum'] =
		array_merge($wizConfig,array('params'=>array(
			'type' => 'paragraph',
			'endSequence' => '10',
			'add'=>TRUE
		)));
}



t3lib_extMgm::addStaticFile($_EXTKEY,'static/infoblock/', 'InfoBlock');
?>