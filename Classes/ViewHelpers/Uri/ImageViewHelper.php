<?php
namespace BGM\BgmVrt\ViewHelpers\Uri;

/**
 * Class ImageViewHelper
 *
 * @package BGM\BgmVrt\ViewHelpers\Uri
 */
class ImageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @param string $src
     * @param string $baseUrl
     * @param string $testsRootDir
     * @param string $type
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     * @return string path to the image
     */
    public function render($src, $baseUrl, $testsRootDir, $type = null)
    {

        $src = $baseUrl . '/tests/' . ltrim(str_replace($testsRootDir, '', $src), '/');
        switch ($type) {
            case 'diff':
                $src = str_replace('.png', '.diff.png', $src);
                break;
            case 'fail':
                $src = str_replace('.png', '.fail.png', $src);
                break;
        }

        return $src;
    }

}