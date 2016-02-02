<?php
namespace BGM\BgmVrt\ViewHelpers;

/**
 * Class SplitComparisonPathViewHelper
 *
 * @package BGM\BgmVrt\ViewHelpers
 */
class SplitComparisonPathViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @param \BGM\BgmVrt\Domain\Model\Testrun $testrun
     * @param string $testsRootDir
     * @param string $part
     * @param string $path
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     * @return string
     */
    public function render(\BGM\BgmVrt\Domain\Model\Testrun $testrun, $testsRootDir, $part, $path = null)
    {
        if ($path == null) {
            $path = $this->renderChildren();
        }

        list($path, $moreInfo, $accepted) = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('|', $path);

        $path = str_replace($testsRootDir . '/' . $testrun->getTestsuite()->getIdentifier() . '/comparisonResults/' . $testrun->getTitle(),
            '', $path);
        $pathArray = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('/', $path);

        $test = $pathArray[count($pathArray) - 1];
        unset($pathArray[count($pathArray) - 1]);

        $url = implode('/', $pathArray);

        if ($part === 'url') {
            return $url;
        } elseif ($part === 'test') {
            return $test;
        } elseif ($part === 'moreInfo') {
            return $moreInfo;
        } elseif ($part === 'accepted') {
            return $accepted;
        }
        return '';
    }

}