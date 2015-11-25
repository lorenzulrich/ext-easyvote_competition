<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Competitiondetail',
    'easyvote Competition: Competition Detail'
);

$pluginSignature = str_replace('_', '', $_EXTKEY) . '_competitiondetail';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,
    'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForm/flexform_competitiondetail.xml');


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Participationdetail',
    'easyvote Competition: Participation Detail'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Manageparticipation',
    'easyvote Competition: Manage Participation'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Myparticipations',
    'easyvote Competition: My Participations'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Competitionarchive',
    'easyvote Competition: Competition Archive'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Competitionlist',
    'easyvote Competition: Competition List'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript',
    'Easyvote Competition');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotecompetition_domain_model_competition',
    'EXT:easyvote_competition/Resources/Private/Language/locallang_csh_tx_easyvotecompetition_domain_model_competition.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotecompetition_domain_model_competition');
$GLOBALS['TCA']['tx_easyvotecompetition_domain_model_competition'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_competition',
        'label' => 'title_short',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'sortby' => 'sorting',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'type,title_short,title_long,description,image,voting_frequency,participation_end_date,participations,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Competition.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotecompetition_domain_model_competition.gif'
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotecompetition_domain_model_participation',
    'EXT:easyvote_competition/Resources/Private/Language/locallang_csh_tx_easyvotecompetition_domain_model_participation.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotecompetition_domain_model_participation');
$GLOBALS['TCA']['tx_easyvotecompetition_domain_model_participation'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'title,description,image,media,language,voting_enabled,votes,community_user,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Participation.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotecompetition_domain_model_participation.gif'
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotecompetition_domain_model_vote',
    'EXT:easyvote_competition/Resources/Private/Language/locallang_csh_tx_easyvotecompetition_domain_model_vote.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotecompetition_domain_model_vote');
$GLOBALS['TCA']['tx_easyvotecompetition_domain_model_vote'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_vote',
        'label' => 'community_user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        //'languageField' => 'sys_language_uid',
        //'transOrigPointerField' => 'l10n_parent',
        //'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',

        ),
        'searchFields' => 'competition,participation,community_user,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Vote.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotecompetition_domain_model_vote.gif'
    ),
);
