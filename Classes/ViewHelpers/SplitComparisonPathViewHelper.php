<?php
namespace BGM\BgmVrt\ViewHelpers;

class SplitComparisonPathViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @param \BGM\BgmVrt\Domain\Model\Testrun $testrun
	 * @param string $baseUrl
	 * @param string $testsRootDir
	 * @param string $part
	 * @param string $path
	 * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
	 * @return string
	 */
	public function render(\BGM\BgmVrt\Domain\Model\Testrun $testrun, $baseUrl, $testsRootDir, $part, $path = NULL) {
		if ($path == NULL) {
			$path = $this->renderChildren();
		}
		$path = str_replace($testsRootDir . '/' . $testrun->getTestsuite()->getTitle() . '/comparisonResults/' . $testrun->getTitle(), '', $path);
		$pathArray = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('/', $path);

		$test = $pathArray[count($pathArray) - 1];
		unset($pathArray[count($pathArray) - 1]);

		$url = $baseUrl . implode('/', $pathArray);

		if ($part === 'url') {
			return $url;
		} elseif ($part === 'test') {
			return $test;
		}
		return '';
	}

}
