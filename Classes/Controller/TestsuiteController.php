<?php
namespace BGM\BgmVrt\Controller;

class TestsuiteController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \BGM\BgmVrt\Domain\Repository\TestsuiteRepository
	 * @inject
	 */
	protected $testsuiteRepository;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
	 * @inject
	 */
	protected $persistenceManager;

	/**
	 * @var \TYPO3\CMS\Core\Log\Logger
	 */
	protected $debugLogger;

	/**
	 * Initialize action
	 *
	 * Executed before the requested action is executed.
	 */
	public function initializeAction() {
		if ($this->settings['debug']) {
			$this->debugLogger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Log\LogManager::class)->getLogger(__CLASS__);
		}
	}

	/**
	 * List action
	 *
	 * Lists all testsuites.
	 */
	public function listAction() {
		$testsuites = $this->testsuiteRepository->findAll();
		$this->view->assign('testsuites', $testsuites);
	}

	/**
	 * Show action
	 *
	 * Shows the details for one testsuite.
	 *
	 * @param \BGM\BgmVrt\Domain\Model\Testsuite $testsuite
	 */
	public function showAction(\BGM\BgmVrt\Domain\Model\Testsuite $testsuite) {
		$this->view->assign('testsuite', $testsuite);
	}
}

?>
