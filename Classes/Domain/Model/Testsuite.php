<?php
namespace BGM\BgmVrt\Domain\Model;

class Testsuite extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $command;

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

}

?>