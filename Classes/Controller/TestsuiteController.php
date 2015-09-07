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
			/** @var \TYPO3\CMS\Core\Log\LogManager $loggerManager */
			$loggerManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Log\\LogManager');
			$this->debugLogger = $loggerManager->getLogger('syncserver');
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

		/** @var \BGM\BgmVrt\Service\SshService $sshService */
		$sshService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('BGM\\BgmVrt\\Service\\SshService', $this->settings['phantomcss']['pathToLocalPrivateKey'], $this->settings['phantomcss']['username'], $this->settings['phantomcss']['host'], $this->settings['phantomcss']['port']);
	}
}

?>
