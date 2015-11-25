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
 * Competition
 */
class Competition extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    const VOTINGFREQUENCY_ONCEPERPARTICIPATION = 1;
    const VOTINGFREQUENCY_EVERY24HOURSPERPARTICIPATION = 2;

    /**
     * Type
     *
     * @var integer
     */
    protected $type = 0;

    /**
     * Short Title
     *
     * @var string
     */
    protected $titleShort = '';

    /**
     * Long Title
     *
     * @var string
     */
    protected $titleLong = '';

    /**
     * Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * Image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image = null;

    /**
     * @var string
     */
    protected $socialSharingText;

    /**
     * @var string
     */
    protected $participationButtonText;

    /**
     * @var string
     */
    protected $participationExplanation;

    /**
     * @var string
     */
    protected $participationInputLabel;

    /**
     * @var string
     */
    protected $participationTerms;

    /**
     * Voting Frequency
     *
     * @var integer
     */
    protected $votingFrequency = 0;

    /**
     * Participation allowed until
     *
     * @var \DateTime
     */
    protected $participationEndDate = null;

    /**
     * Participations
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteCompetition\Domain\Model\Participation>
     * @cascade remove
     */
    protected $participations = null;

    /**
     * @var bool
     * @transient
     */
    protected $votingPeriodIsActive = false;

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
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->participations = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the type
     *
     * @return integer $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param integer $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Returns the titleShort
     *
     * @return string $titleShort
     */
    public function getTitleShort()
    {
        return $this->titleShort;
    }

    /**
     * Sets the titleShort
     *
     * @param string $titleShort
     * @return void
     */
    public function setTitleShort($titleShort)
    {
        $this->titleShort = $titleShort;
    }

    /**
     * Returns the titleLong
     *
     * @return string $titleLong
     */
    public function getTitleLong()
    {
        return $this->titleLong;
    }

    /**
     * Sets the titleLong
     *
     * @param string $titleLong
     * @return void
     */
    public function setTitleLong($titleLong)
    {
        $this->titleLong = $titleLong;
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
     * Returns the votingFrequency
     *
     * @return integer $votingFrequency
     */
    public function getVotingFrequency()
    {
        return $this->votingFrequency;
    }

    /**
     * Sets the votingFrequency
     *
     * @param integer $votingFrequency
     * @return void
     */
    public function setVotingFrequency($votingFrequency)
    {
        $this->votingFrequency = $votingFrequency;
    }

    /**
     * Returns the participationEndDate
     *
     * @return \DateTime $participationEndDate
     */
    public function getParticipationEndDate()
    {
        return $this->participationEndDate;
    }

    /**
     * Sets the participationEndDate
     *
     * @param \DateTime $participationEndDate
     * @return void
     */
    public function setParticipationEndDate(\DateTime $participationEndDate)
    {
        $this->participationEndDate = $participationEndDate;
    }

    /**
     * Adds a Participation
     *
     * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
     * @return void
     */
    public function addParticipation(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation)
    {
        $this->participations->attach($participation);
    }

    /**
     * Removes a Participation
     *
     * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participationToRemove The Participation to be removed
     * @return void
     */
    public function removeParticipation(\Visol\EasyvoteCompetition\Domain\Model\Participation $participationToRemove)
    {
        $this->participations->detach($participationToRemove);
    }

    /**
     * Returns the participations
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteCompetition\Domain\Model\Participation> $participations
     */
    public function getParticipations()
    {
        return $this->participations;
    }

    /**
     * Sets the participations
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteCompetition\Domain\Model\Participation> $participations
     * @return void
     */
    public function setParticipations(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $participations)
    {
        $this->participations = $participations;
    }

    /**
     * @return string
     */
    public function getSocialSharingText()
    {
        return $this->socialSharingText;
    }

    /**
     * @param string $socialSharingText
     */
    public function setSocialSharingText($socialSharingText)
    {
        $this->socialSharingText = $socialSharingText;
    }

    /**
     * @return mixed
     */
    public function getParticipationButtonText()
    {
        return $this->participationButtonText;
    }

    /**
     * @param mixed $participationButtonText
     */
    public function setParticipationButtonText($participationButtonText)
    {
        $this->participationButtonText = $participationButtonText;
    }

    /**
     * @return string
     */
    public function getParticipationTerms()
    {
        return $this->participationTerms;
    }

    /**
     * @param string $participationTerms
     */
    public function setParticipationTerms($participationTerms)
    {
        $this->participationTerms = $participationTerms;
    }

    /**
     * @return string
     */
    public function getParticipationExplanation()
    {
        return $this->participationExplanation;
    }

    /**
     * @param string $participationExplanation
     */
    public function setParticipationExplanation($participationExplanation)
    {
        $this->participationExplanation = $participationExplanation;
    }

    /**
     * @return string
     */
    public function getParticipationInputLabel()
    {
        return $this->participationInputLabel;
    }

    /**
     * @param string $participationInputLabel
     */
    public function setParticipationInputLabel($participationInputLabel)
    {
        $this->participationInputLabel = $participationInputLabel;
    }

    /**
     * @return bool
     */
    public function getVotingPeriodIsActive()
    {
        if (time() > $this->getParticipationEndDate()->getTimestamp()) {
            // if participation period expired, voting is inactive
            return false;
        }
        return true;
    }

}