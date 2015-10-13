<?php
namespace BGM\BgmVrt\Domain\Model;

class Testsuite extends \BGM\BgmVrt\Domain\Model\AbstractEntity {

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $command;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\BGM\BgmVrt\Domain\Model\Testrun>
	 * @transient
	 */
	protected $testruns;

	/**
	 * @var bool
	 * @transient
	 */
	protected $collectedTestruns = FALSE;

	public function initializeObject(){
		parent::initializeObject();
		$this->testruns = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage');
	}

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
	 * @return string
	 */
	public function getCommand() {
		return $this->command;
	}

	/**
	 * @param string $command
	 */
	public function setCommand($command) {
		$this->command = $command;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\BGM\BgmVrt\Domain\Model\Testrun>
	 */
	public function getTestruns() {
		if (!$this->collectedTestruns) {
			$testruns = $this->sshService->getSftpConnection()->nlist($this->settings['phantomcss']['testsRootDir'] . '/' . $this->getTitle() . '/comparisonResults');
			if(is_array($testruns) && count($testruns) > 0){
				unset($testruns[array_search('..', $testruns)]);
				unset($testruns[array_search('.', $testruns)]);
				sort($testruns);
				foreach ($testruns as $testrun) {
					/** @var \BGM\BgmVrt\Domain\Model\Testrun $testrunObject */
					$testrunObject = $this->objectManager->get('BGM\\BgmVrt\\Domain\\Model\\Testrun');
					$testrunObject->setTitle($testrun);
					$testrunObject->setTestsuite($this);
					$this->addTestruns($testrunObject);
				}
			}
			$this->collectedTestruns = TRUE;
		}
		return $this->testruns;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\BGM\BgmVrt\Domain\Model\Testrun> $testruns
	 */
	public function setTestruns(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $testruns) {
		$this->testruns = $testruns;
	}

	/**
	 * @param \BGM\BgmVrt\Domain\Model\Testrun $testrun
	 */
	public function addTestruns(\BGM\BgmVrt\Domain\Model\Testrun $testrun) {
		$this->testruns->attach($testrun);
	}

}

?>