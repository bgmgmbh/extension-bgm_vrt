<?php
namespace BGM\BgmVrt\Service;

/**
 * Class SshService
 *
 * @package BGM\BgmVrt\Service
 */
class SshService
{

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $pathToLocalPrivateKey;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $port;

    /**
     * @var boolean
     */
    protected $rsaKey;

    /**
     * @var boolean
     */
    protected $sftpConnection;

    /**
     * @var boolean
     */
    protected $sshConnection;

    /**
     * @param string $pathToLocalPrivateKey
     * @param string $username
     * @param string $host
     * @param string $port
     */
    public function __construct($pathToLocalPrivateKey, $username, $host, $port)
    {
        $this->pathToLocalPrivateKey = $pathToLocalPrivateKey;
        $this->username = $username;
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @return \phpseclib\Net\SFTP
     */
    public function getSftpConnection()
    {
        if (!$this->sftpConnection) {
            $this->sftpConnection = $this->connectToRemoteServerFTP();
        }
        return $this->sftpConnection;
    }

    /**
     * @return \phpseclib\Net\SSH2
     */
    public function getSshConnection()
    {
        if (!$this->sshConnection) {
            $this->sshConnection = $this->connectToRemoteServerSSH2();
        }
        return $this->sshConnection;
    }

    /**
     * @return \phpseclib\Crypt\RSA
     */
    public function getRsaKey()
    {
        if (!$this->rsaKey) {
            $this->rsaKey = $this->createKey();
        }
        return $this->rsaKey;
    }

    /**
     * @return \phpseclib\Crypt\RSA
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception
     */
    protected function createKey()
    {
        /** @var \phpseclib\Crypt\RSA $rsaKey */
        $rsaKey = new \phpseclib\Crypt\RSA();
        $rsaKey->loadKey(file_get_contents($this->pathToLocalPrivateKey), CRYPT_RSA_PUBLIC_FORMAT_OPENSSH);

        return $rsaKey;
    }

    /**
     * @return \phpseclib\Net\SFTP
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception
     */
    protected function connectToRemoteServerFTP()
    {
        /** @var \phpseclib\Net\SFTP $sftpConnection */
        $sftpConnection = new \phpseclib\Net\SFTP($this->host, $this->port);
        $login = $sftpConnection->login($this->username, $this->getRsaKey());

        if (!$login) {
            throw new \TYPO3\CMS\Extbase\Mvc\Exception('Unable to establish sftp connection! ' . print_r($sftpConnection->getErrors(),
                    true), 1324560948);
        } else {
            return $sftpConnection;
        }
    }

    /**
     * @return \Net_SSH2
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception
     */
    protected function connectToRemoteServerSSH2()
    {
        /** @var \phpseclib\Net\SSH2 $sshConnection */
        $sshConnection = new \phpseclib\Net\SSH2($this->host, $this->port);
        $login = $sshConnection->login($this->username, $this->getRsaKey());

        if (!$login) {
            throw new \TYPO3\CMS\Extbase\Mvc\Exception('Unable to establish ssh2 connection! ' . print_r($sshConnection->getErrors(),
                    true), 1324560949);
        } else {
            return $sshConnection;
        }
    }
}