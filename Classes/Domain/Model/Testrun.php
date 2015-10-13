<?php
namespace BGM\BgmVrt\Domain\Model;

class Testrun extends \BGM\BgmVrt\Domain\Model\AbstractEntity {

	/**
	 * @var string
	 * @transient
	 */
	protected $title;

	/**
	 * @var \BGM\BgmVrt\Domain\Model\Testsuite
	 * @transient
	 */
	protected $testsuite;

	/**
	 * @var array
	 * @transient
	 */
	protected $executedComparisons;

	/**
	 * @var bool
	 * @transient
	 */
	protected $collectedExecutedComparisons = FALSE;

	/**
	 * @var array
	 * @transient
	 */
	protected $executedComparisonsCounter;

	/**
	 * @var bool
	 * @transient
	 */
	protected $collectedExecutedComparisonsCounter = FALSE;

	/**
	 * @var array
	 * @transient
	 */
	protected $newComparisons;

	/**
	 * @var bool
	 * @transient
	 */
	protected $collectedNewComparisons = FALSE;

	/**
	 * @var array
	 * @transient
	 */
	protected $passedComparisons;

	/**
	 * @var bool
	 * @transient
	 */
	protected $collectedPassedComparisons = FALSE;

	/**
	 * @var array
	 * @transient
	 */
	protected $failedComparisons;

	/**
	 * @var bool
	 * @transient
	 */
	protected $collectedFailedComparisons = FALSE;

	/**
	 * @var array
	 * @transient
	 */
	protected $timedoutComparisons;

	/**
	 * @var bool
	 * @transient
	 */
	protected $collectedTimedoutComparisons = FALSE;

	/**
	 * @var array
	 * @transient
	 */
	protected $casperTimedout;

	/**
	 * @var bool
	 * @transient
	 */
	protected $collectedCasperTimedout = FALSE;

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return Testsuite
	 */
	public function getTestsuite() {
		return $this->testsuite;
	}

	/**
	 * @param Testsuite $testsuite
	 */
	public function setTestsuite($testsuite) {
		$this->testsuite = $testsuite;
	}

	/**
	 * @return array
	 */
	public function getExecutedComparisons() {
		if (!$this->collectedExecutedComparisons) {
			$executedComparisons = $this->sshService->getSftpConnection()->get($this->settings['phantomcss']['testsRootDir'] . '/' . $this->getTestsuite()->getTitle() . '/comparisonResults/' . $this->getTitle() . '/executedComparisons.log');
			if ($executedComparisons) {
				$this->executedComparisons = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode("\n", $executedComparisons);
			}
			$this->collectedExecutedComparisons = TRUE;
		}
		return $this->executedComparisons;
	}

	/**
	 * @param array $executedComparisons
	 */
	public function setExecutedComparisons($executedComparisons) {
		$this->executedComparisons = $executedComparisons;
	}

	/**
	 * @return array
	 */
	public function getExecutedComparisonsCounter() {
		if (!$this->collectedExecutedComparisonsCounter) {
			$executedComparisonsCounter = $this->sshService->getSftpConnection()->get($this->settings['phantomcss']['testsRootDir'] . '/' . $this->getTestsuite()->getTitle() . '/comparisonResults/' . $this->getTitle() . '/executedComparisonsCounter.log');
			if ($executedComparisonsCounter) {
				$this->executedComparisonsCounter = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('/', $executedComparisonsCounter);
			}
			$this->collectedExecutedComparisonsCounter = TRUE;
		}
		return $this->executedComparisonsCounter;
	}

	/**
	 * @param array $executedComparisonsCounter
	 */
	public function setExecutedComparisonsCounter($executedComparisonsCounter) {
		$this->executedComparisonsCounter = $executedComparisonsCounter;
	}

	/**
	 * @return array
	 */
	public function getNewComparisons() {
		if (!$this->collectedNewComparisons) {
			$newComparisons = $this->sshService->getSftpConnection()->get($this->settings['phantomcss']['testsRootDir'] . '/' . $this->getTestsuite()->getTitle() . '/comparisonResults/' . $this->getTitle() . '/newComparisons.log');
			if ($newComparisons) {
				$this->newComparisons = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode("\n", $newComparisons);
			}
			$this->collectedNewComparisons = TRUE;
		}
		return $this->newComparisons;
	}

	/**
	 * @param array $newComparisons
	 */
	public function setNewComparisons($newComparisons) {
		$this->newComparisons = $newComparisons;
	}

	/**
	 * @return array
	 */
	public function getPassedComparisons() {
		if (!$this->collectedPassedComparisons) {
			$passedComparisons = $this->sshService->getSftpConnection()->get($this->settings['phantomcss']['testsRootDir'] . '/' . $this->getTestsuite()->getTitle() . '/comparisonResults/' . $this->getTitle() . '/passedComparisons.log');
			if ($passedComparisons) {
				$this->passedComparisons = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode("\n", $passedComparisons);
			}
			$this->collectedPassedComparisons = TRUE;
		}
		return $this->passedComparisons;
	}

	/**
	 * @param array $passedComparisons
	 */
	public function setPassedComparisons($passedComparisons) {
		$this->passedComparisons = $passedComparisons;
	}

	/**
	 * @return array
	 */
	public function getFailedComparisons() {
		if (!$this->collectedFailedComparisons) {
			$failedComparisons = $this->sshService->getSftpConnection()->get($this->settings['phantomcss']['testsRootDir'] . '/' . $this->getTestsuite()->getTitle() . '/comparisonResults/' . $this->getTitle() . '/failedComparisons.log');
			if($failedComparisons){
				$this->failedComparisons = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode("\n", $failedComparisons);
			}
			$this->collectedFailedComparisons = TRUE;
		}
		return $this->failedComparisons;
	}

	/**
	 * @param array $failedComparisons
	 */
	public function setFailedComparisons($failedComparisons) {
		$this->failedComparisons = $failedComparisons;
	}

	/**
	 * @return array
	 */
	public function getTimedoutComparisons() {
		if (!$this->collectedTimedoutComparisons) {
			$timedoutComparisons = $this->sshService->getSftpConnection()->get($this->settings['phantomcss']['testsRootDir'] . '/' . $this->getTestsuite()->getTitle() . '/comparisonResults/' . $this->getTitle() . '/timedoutComparisons.log');
			if ($timedoutComparisons) {
				$this->timedoutComparisons = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode("\n", $timedoutComparisons);
			}
			$this->collectedTimedoutComparisons = TRUE;
		}
		return $this->timedoutComparisons;
	}

	/**
	 * @param array $timedoutComparisons
	 */
	public function setTimedoutComparisons($timedoutComparisons) {
		$this->timedoutComparisons = $timedoutComparisons;
	}

	/**
	 * @return array
	 */
	public function getCasperTimedout() {
		if (!$this->collectedCasperTimedout) {
			$casperTimedout = $this->sshService->getSftpConnection()->get($this->settings['phantomcss']['testsRootDir'] . '/' . $this->getTestsuite()->getTitle() . '/comparisonResults/' . $this->getTitle() . '/casperTimedout.log');
			if ($casperTimedout) {
				$this->casperTimedout = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode("\n", $casperTimedout);
			}
			$this->collectedCasperTimedout = TRUE;
		}
		return $this->casperTimedout;
	}

	/**
	 * @param array $casperTimedout
	 */
	public function setCasperTimedout($casperTimedout) {
		$this->casperTimedout = $casperTimedout;
	}
	
}

?>