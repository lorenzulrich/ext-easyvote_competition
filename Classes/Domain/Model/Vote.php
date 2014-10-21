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
 * Vote
 */
class Vote extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Competition
	 *
	 * @var \Visol\EasyvoteCompetition\Domain\Model\Competition
	 */
	protected $competition = NULL;

	/**
	 * Participation
	 *
	 * @var \Visol\EasyvoteCompetition\Domain\Model\Participation
	 */
	protected $participation = NULL;

	/**
	 * Community User
	 *
	 * @var \Visol\Easyvote\Domain\Model\CommunityUser
	 * @lazy
	 */
	protected $communityUser = NULL;

	/**
	 * Creation date of vote
	 *
	 * @var \DateTime
	 */
	protected $crdate;

	/**
	 * Returns the competition
	 *
	 * @return \Visol\EasyvoteCompetition\Domain\Model\Competition $competition
	 */
	public function getCompetition() {
		return $this->competition;
	}

	/**
	 * Sets the competition
	 *
	 * @param \Visol\EasyvoteCompetition\Domain\Model\Competition $competition
	 * @return void
	 */
	public function setCompetition(\Visol\EasyvoteCompetition\Domain\Model\Competition $competition) {
		$this->competition = $competition;
	}

	/**
	 * Returns the participation
	 *
	 * @return \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
	 */
	public function getParticipation() {
		return $this->participation;
	}

	/**
	 * Sets the participation
	 *
	 * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
	 * @return void
	 */
	public function setParticipation(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation) {
		$this->participation = $participation;
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

	/**
	 * @return \DateTime
	 */
	public function getCrdate() {
		return $this->crdate;
	}

	/**
	 * @param \DateTime $crdate
	 */
	public function setCrdate($crdate) {
		$this->crdate = $crdate;
	}

}