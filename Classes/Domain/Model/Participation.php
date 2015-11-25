<?php
namespace Visol\EasyvoteCompetition\Domain\Model;


    /***************************************************************
     *
     *  Copyright notice
     *
     *  (c) 2014 Lorenz Ulrich <lorenz.ulrich@visol.ch>, visol digitale Dienstleistungen GmbH
     *           Jonas Renggli <jonas.renggli@visol.ch>, visol digitale Dienstleistungen GmbH
     *
     *  All rights reserved
     *
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 3 of the License, or
     *  (at your option) any later version.
     *
     *  The GNU General Public License can be found at
     *  http://www.gnu.org/copyleft/gpl.html.
     *
     *  This script is distributed in the hope that it will be useful,
     *  but WITHOUT ANY WARRANTY; without even the implied warranty of
     *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *  GNU General Public License for more details.
     *
     *  This copyright notice MUST APPEAR in all copies of the script!
     ***************************************************************/

/**
 * Participation
 */
class Participation extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var \Visol\EasyvoteCompetition\Service\CompetitionService
     * @inject
     */
    protected $competitionService;

    /**
     * Title
     *
     * @var string
     */
    protected $title;

    /**
     * Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * Additional content
     *
     * @var string
     */
    protected $additionalContent = '';

    /**
     * Image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image = null;

    /**
     * Media (Video/Audio)
     *
     * @var string
     */
    protected $media = '';

    /**
     * Language of Community User
     *
     * @var integer
     */
    protected $language = 0;

    /**
     * Disabled
     *
     * @var bool
     */
    protected $disabled = false;

    /**
     * Voting enabled
     *
     * @var integer
     */
    protected $votingEnabled = 0;

    /**
     * Votes
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteCompetition\Domain\Model\Vote>
     * @cascade remove
     */
    protected $votes = null;

    /**
     * Current number of votes (cached)
     *
     * @var integer
     */
    protected $cachedVotes = 0;

    /**
     * Current rank (cached)
     *
     * @var integer
     */
    protected $cachedRank = 0;


    /**
     * Community User
     *
     * @var \Visol\Easyvote\Domain\Model\CommunityUser
     * @lazy
     */
    protected $communityUser = null;

    /**
     * Competition
     *
     * @var \Visol\EasyvoteCompetition\Domain\Model\Competition
     * @lazy
     */
    protected $competition;

    /**
     * @var bool
     * @transient
     */
    protected $userCanVote = false;

    /**
     * @var string
     * @transient
     */
    protected $socialSharingText;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->votes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getAdditionalContent()
    {
        return $this->additionalContent;
    }

    /**
     * @param string $additionalContent
     */
    public function setAdditionalContent($additionalContent)
    {
        $this->additionalContent = $additionalContent;
    }

    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * Returns the media
     *
     * @return string $media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Sets the media
     *
     * @param string $media
     * @return void
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * Returns the language
     *
     * @return integer $language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the language
     *
     * @param integer $language
     * @return void
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param boolean $disabled
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    }

    /**
     * Returns the votingEnabled
     *
     * @return integer $votingEnabled
     */
    public function getVotingEnabled()
    {
        return $this->votingEnabled;
    }

    /**
     * Sets the votingEnabled
     *
     * @param integer $votingEnabled
     * @return void
     */
    public function setVotingEnabled($votingEnabled)
    {
        $this->votingEnabled = $votingEnabled;
    }

    /**
     * Adds a Vote
     *
     * @param \Visol\EasyvoteCompetition\Domain\Model\Vote $vote
     * @return void
     */
    public function addVote(\Visol\EasyvoteCompetition\Domain\Model\Vote $vote)
    {
        $this->votes->attach($vote);
    }

    /**
     * Removes a Vote
     *
     * @param \Visol\EasyvoteCompetition\Domain\Model\Vote $voteToRemove The Vote to be removed
     * @return void
     */
    public function removeVote(\Visol\EasyvoteCompetition\Domain\Model\Vote $voteToRemove)
    {
        $this->votes->detach($voteToRemove);
    }

    /**
     * Returns the votes
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteCompetition\Domain\Model\Vote> $votes
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * Sets the votes
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteCompetition\Domain\Model\Vote> $votes
     * @return void
     */
    public function setVotes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $votes)
    {
        $this->votes = $votes;
    }

    /**
     * Returns the communityUser
     *
     * @return \Visol\Easyvote\Domain\Model\CommunityUser $communityUser
     */
    public function getCommunityUser()
    {
        return $this->communityUser;
    }

    /**
     * Sets the communityUser
     *
     * @param \Visol\Easyvote\Domain\Model\CommunityUser $communityUser
     * @return void
     */
    public function setCommunityUser(\Visol\Easyvote\Domain\Model\CommunityUser $communityUser)
    {
        $this->communityUser = $communityUser;
    }

    /**
     * @return \Visol\EasyvoteCompetition\Domain\Model\Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * @param \Visol\EasyvoteCompetition\Domain\Model\Competition $competition
     */
    public function setCompetition($competition)
    {
        $this->competition = $competition;
    }

    /**
     * @return boolean
     */
    public function getUserCanVote()
    {
        return $this->competitionService->userCanVoteForParticiation($this->uid);
    }

    /**
     * @return int
     */
    public function getCachedVotes()
    {
        return $this->cachedVotes;
    }

    /**
     * @param int $cachedVotes
     */
    public function setCachedVotes($cachedVotes)
    {
        $this->cachedVotes = $cachedVotes;
    }

    /**
     * @return int
     */
    public function getCachedRank()
    {
        return $this->cachedRank;
    }

    /**
     * @param int $cachedRank
     */
    public function setCachedRank($cachedRank)
    {
        $this->cachedRank = $cachedRank;
    }

    /**
     * @return string
     */
    public function getSocialSharingText()
    {
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $standaloneView */
        $standaloneView = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Fluid\View\StandaloneView');
        $standaloneView->setTemplateSource($this->getCompetition()->getSocialSharingText());
        $standaloneView->assign('communityUser', $this->communityUser);
        $standaloneView->assign('participation', $this);
        return $standaloneView->render();
    }

}