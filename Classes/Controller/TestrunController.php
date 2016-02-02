<?php
namespace BGM\BgmVrt\Controller;

/**
 * Class TestrunController
 *
 * @package BGM\BgmVrt\Controller
 */
class TestrunController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

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
    public function initializeAction()
    {
        if ($this->settings['debug']) {
            $this->debugLogger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Log\LogManager::class)->getLogger(__CLASS__);
        }
    }

    /**
     * Show action
	 *
     * Shows the details for one testrun.
     *
     * @param \BGM\BgmVrt\Domain\Model\Testsuite $testsuite
     * @param string $testrunTitle
     */
    public function showAction(\BGM\BgmVrt\Domain\Model\Testsuite $testsuite, $testrunTitle)
    {
        $currentTestrun = null;
        foreach ($testsuite->getTestruns() as $testrun) {
            if ($testrun->getTitle() === $testrunTitle) {
                $currentTestrun = $testrun;
                break;
            }
        }
        $this->view->assign('testrun', $currentTestrun);
    }
}