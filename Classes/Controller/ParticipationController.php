<?php
namespace Visol\EasyvoteCompetition\Controller;

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
 * ParticipationController
 */
class ParticipationController extends AbstractController
{

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $participations = $this->participationRepository->findAll();
        $this->view->assign('participations', $participations);
    }

    /**
     * @param \Visol\EasyvoteCompetition\Domain\Model\Competition $competition
     */
    public function listByCompetitionAction(\Visol\EasyvoteCompetition\Domain\Model\Competition $competition)
    {
        $participations = $this->participationRepository->findByCompetition($competition);
        $this->view->assign('participations', $participations);

        $communityUser = $this->competitionService->getCurrentCommunityUser();
        $this->view->assign('communityUser', $communityUser);
    }

    /**
     * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
     * @return bool
     */
    public function addVoteAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation)
    {
        // todo check if participationEndDate is reached
        $communityUser = $this->competitionService->getCurrentCommunityUser();
        if ($communityUser instanceof \Visol\Easyvote\Domain\Model\CommunityUser) {
            if ($this->competitionService->userCanVoteForParticiation($participation->getUid())) {
                /** @var \Visol\EasyvoteCompetition\Domain\Model\Vote $vote */
                $vote = $this->objectManager->get('Visol\EasyvoteCompetition\Domain\Model\Vote');
                $vote->setParticipation($participation);
                $vote->setCommunityUser($communityUser);
                $vote->setCompetition($participation->getCompetition());
                $this->voteRepository->add($vote);
                $participation->addVote($vote);
                $this->participationRepository->update($participation);
                $this->persistenceManager->persistAll();
                // update cached votes and cached rank
                $this->participationRepository->updateCachedVotesAndCachedRankForCompetition($participation->getCompetition());
                return true;
            } else {
                // @todo access denied
                return false;
            }
        }
        return false;
    }

    /**
     * action show
     *
     * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
     * @return void
     */
    public function showAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation)
    {
        $this->view->assign('participation', $participation);
    }

    /**
     * action edit
     *
     * @param \Visol\EasyvoteCompetition\Domain\Model\Competition $competition
     * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
     * @ignorevalidation $participation
     * @return void
     */
    public function editAction(
        \Visol\EasyvoteCompetition\Domain\Model\Competition $competition = null,
        \Visol\EasyvoteCompetition\Domain\Model\Participation $participation = null
    ) {
        // TODO check participationEndDate
        // @TODO check for passed optional participation and if it is allowed to edit it --> possible admin functionality
        if ($communityUser = $this->getLoggedInUser()) {
            $mayBeEdited = true;
            $isNewParticipation = false;
            $existingParticipation = $this->participationRepository->findOneByCompetitionAndCommunityUser($competition,
                $communityUser);
            if (count($existingParticipation)) {
                // edit the existing participation
                $participation = $existingParticipation;
                if (count($participation->getVotes()) > 0) {
                    // participation already has votes --> may not be edited
                    $mayBeEdited = false;
                }
                if ($participation->getVotingEnabled() === 2) {
                    // participation was verified
                    $mayBeEdited = false;
                }
            } else {
                // generate an empty new participation that is disabled and save it
                $isNewParticipation = true;
                /** @var \Visol\EasyvoteCompetition\Domain\Model\Participation $participation */
                $participation = $this->objectManager->get('\Visol\EasyvoteCompetition\Domain\Model\Participation');
                $participation->setCompetition($competition);
                $participation->setCommunityUser($communityUser);
                $participation->setDisabled(true);
                $participation->setVotingEnabled(false);
                $this->participationRepository->add($participation);
                $this->persistenceManager->persistAll();
            }
            $this->view->assign('isNewParticipation', $isNewParticipation);
            $this->view->assign('mayBeEdited', $mayBeEdited);
            $this->view->assign('participation', $participation);
        } else {
            // @todo access denied
        }
    }

    /**
     * action update
     *
     * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
     * @return void
     */
    public function updatePreviewAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation)
    {
        // TODO check participationEndDate
        if ($communityUser = $this->getLoggedInUser()) {
            if ($communityUser === $participation->getCommunityUser()) {
                $this->participationRepository->update($participation);
                $this->view->assign('participation', $participation);
                $this->participationRepository->updateCachedVotesAndCachedRankForCompetition($participation->getCompetition());
            } else {
                // @todo access denied
            }
        } else {
            // @todo access denied
        }
    }

    /**
     * action update
     *
     * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
     * @return void
     */
    public function updateAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation)
    {
        // todo check participationEndDate
        $this->participationRepository->update($participation);
        $this->redirect('list');
    }

    /**
     * action publish
     *
     * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
     * @return void
     */
    public function publishAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation)
    {
        // todo check participationEndDate
        if ($communityUser = $this->getLoggedInUser()) {
            if ($communityUser === $participation->getCommunityUser()) {
                $participation->setVotingEnabled(true);
                $participation->setDisabled(false);
                $this->participationRepository->update($participation);
                $this->persistenceManager->persistAll();
                $this->participationRepository->updateCachedVotesAndCachedRankForCompetition($participation->getCompetition());
                $this->redirect('show', 'Competition', $this->request->getControllerExtensionName(), array(
                        'competition' => $participation->getCompetition(),
                        'participation' => $participation,
                        'openSharer' => 1,
                        'no_cache' => 1
                    ), $this->settings['competitionHomePid']);
            } else {
                // @todo access denied
            }
        } else {
            // @todo access denied
        }
    }

    /**
     * action delete
     *
     * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
     * @return void
     */
    public function deleteAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation)
    {
        // todo check participationEndDate
        if ($communityUser = $this->getLoggedInUser()) {
            if ($communityUser === $participation->getCommunityUser()) {
                $competition = $participation->getCompetition();
                $this->participationRepository->remove($participation);
                $this->persistenceManager->persistAll();
                $this->participationRepository->updateCachedVotesAndCachedRankForCompetition($participation->getCompetition());
                $this->redirect('show', 'Competition', $this->request->getControllerExtensionName(),
                    array('competition' => $competition), $this->settings['competitionHomePid']);
            } else {
                // @todo access denied
            }
        } else {
            // @todo access denied
        }
    }

    /**
     * action listForCommunityUser
     *
     * @return void
     */
    public function listForCommunityUserAction()
    {
    }

}