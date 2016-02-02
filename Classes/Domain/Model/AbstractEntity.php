<?php
namespace BGM\BgmVrt\Domain\Model;

/**
 * Class AbstractEntity
 *
 * @package BGM\BgmVrt\Domain\Model
 */
class AbstractEntity extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     */
    protected $configurationManager;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @var \BGM\BgmVrt\Service\SshService
     */
    protected $sshService;

    public function initializeObject()
    {
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        $this->configurationManager = $this->objectManager->get(\TYPO3\CMS\Extbase\Configuration\ConfigurationManager::class);
        $this->settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
        $this->sshService = $this->objectManager->get(\BGM\BgmVrt\Service\SshService::class,
            $this->settings['phantomcss']['pathToLocalPrivateKey'], $this->settings['phantomcss']['username'],
            $this->settings['phantomcss']['host'], $this->settings['phantomcss']['port']);
    }

}