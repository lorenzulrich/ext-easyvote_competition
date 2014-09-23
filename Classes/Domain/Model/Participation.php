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
class Participation extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Title
	 *
	 * @var string
	 */
	protected $title = '';

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
	protected $image = NULL;

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
	 * Voting is enabled
	 *
	 * @var boolean
	 */
	protected $votingEnabled = FALSE;

	/**
	 * Votes
	 *
	 * @var \Visol\EasyvoteCompetition\Domain\Model\Vote
	 * @lazy
	 */
	protected $votes = NULL;

	/**
	 * Community User
	 *
	 * @var \Visol\Easyvote\Domain\Model\CommunityUser
	 * @lazy
	 */
	protected $communityUser = NULL;

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
		$this->image = $image;
	}

	/**
	 * Returns the media
	 *
	 * @return string $media
	 */
	public function getMedia() {
		return $this->media;
	}

	/**
	 * Sets the media
	 *
	 * @param string $media
	 * @return void
	 */
	public function setMedia($media) {
		$this->media = $media;
	}

	/**
	 * Returns the language
	 *
	 * @return integer $language
	 */
	public function getLanguage() {
		return $this->language;
	}

	/**
	 * Sets the language
	 *
	 * @param integer $language
	 * @return void
	 */
	public function setLanguage($language) {
		$this->language = $language;
	}

	/**
	 * Returns the votingEnabled
	 *
	 * @return boolean $votingEnabled
	 */
	public function getVotingEnabled() {
		return $this->votingEnabled;
	}

	/**
	 * Sets the votingEnabled
	 *
	 * @param boolean $votingEnabled
	 * @return void
	 */
	public function setVotingEnabled($votingEnabled) {
		$this->votingEnabled = $votingEnabled;
	}

	/**
	 * Returns the boolean state of votingEnabled
	 *
	 * @return boolean
	 */
	public function isVotingEnabled() {
		return $this->votingEnabled;
	}

	/**
	 * Returns the votes
	 *
	 * @return \Visol\EasyvoteCompetition\Domain\Model\Vote $votes
	 */
	public function getVotes() {
		return $this->votes;
	}

	/**
	 * Sets the votes
	 *
	 * @param \Visol\EasyvoteCompetition\Domain\Model\Vote $votes
	 * @return void
	 */
	public function setVotes(\Visol\EasyvoteCompetition\Domain\Model\Vote $votes) {
		$this->votes = $votes;
	}

	/**
	 * Returns the communityUser
	 *
	 * @return \Visol\Easyvote\Domain\Model\CommunityUser $communityUser
	 */
	public function getCommunityUser() {
		return $this->communityUser;
	}

	/**
	 * Sets the communityUser
	 *
	 * @param \Visol\Easyvote\Domain\Model\CommunityUser $communityUser
	 * @return void
	 */
	public function setCommunityUser(\Visol\Easyvote\Domain\Model\CommunityUser $communityUser) {
		$this->communityUser = $communityUser;
	}

}