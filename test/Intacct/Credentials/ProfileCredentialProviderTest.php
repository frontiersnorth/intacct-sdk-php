<?php

/**
 * Copyright 2017 Intacct Corporation.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"). You may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "LICENSE" file accompanying this file. This file is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Intacct\Credentials;

use Intacct\ClientConfig;

/**
 * @coversDefaultClass \Intacct\Credentials\ProfileCredentialProvider
 */
class ProfileCredentialProviderTest extends \PHPUnit\Framework\TestCase
{

    private function clearEnv()
    {
        $dir = sys_get_temp_dir() . '/.intacct';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return $dir;
    }

    public function testGetCredentialsFromDefaultProfile()
    {
        $dir = $this->clearEnv();
        $ini = <<<EOF
[default]
sender_id = defsenderid
sender_password = defsenderpass
company_id = defcompanyid
user_id = defuserid
user_password = defuserpass
endpoint_url = https://unittest.intacct.com/ia/xmlgw.phtml

[unittest]
company_id = inicompanyid
user_id = iniuserid
user_password = iniuserpass
EOF;
        file_put_contents($dir . '/credentials.ini', $ini);
        putenv('HOME=' . dirname($dir));

        $config = new ClientConfig();
        $loginCreds = ProfileCredentialProvider::getLoginCredentials($config);

        $this->assertEquals('defcompanyid', $loginCreds->getCompanyId());
        $this->assertEquals('defuserid', $loginCreds->getUserId());
        $this->assertEquals('defuserpass', $loginCreds->getUserPassword());

        $senderCreds = ProfileCredentialProvider::getSenderCredentials($config);

        $this->assertEquals('defsenderid', $senderCreds->getSenderId());
        $this->assertEquals('defsenderpass', $senderCreds->getSenderPassword());
        $this->assertEquals('https://unittest.intacct.com/ia/xmlgw.phtml', $senderCreds->getEndpointUrl());
    }

    public function testGetLoginCredentialsFromSpecificProfile()
    {
        $dir = $this->clearEnv();
        $ini = <<<EOF
[default]
sender_id = defsenderid
sender_password = defsenderpass
company_id = defcompanyid
user_id = defuserid
user_password = defuserpass

[unittest]
company_id = inicompanyid
user_id = iniuserid
user_password = iniuserpass
EOF;
        file_put_contents($dir . '/credentials.ini', $ini);
        putenv('HOME=' . dirname($dir));

        $config = new ClientConfig();
        $config->setProfileName('unittest');

        $profileCreds = ProfileCredentialProvider::getLoginCredentials($config);

        $this->assertEquals('inicompanyid', $profileCreds->getCompanyId());
        $this->assertEquals('iniuserid', $profileCreds->getUserId());
        $this->assertEquals('iniuserpass', $profileCreds->getUserPassword());
    }

    public function testGetLoginCredentialsFromNullProfile()
    {
        $config = new ClientConfig();
        $config->setProfileName('');

        $loginCreds = ProfileCredentialProvider::getLoginCredentials($config);

        $this->assertEquals('defcompanyid', $loginCreds->getCompanyId());
        $this->assertEquals('defuserid', $loginCreds->getUserId());
        $this->assertEquals('defuserpass', $loginCreds->getUserPassword());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Cannot read credentials from file, "notarealfile.ini"
     */
    public function testGetLoginCredentialsFromMissingIni()
    {
        $config = new ClientConfig();
        $config->setProfileFile('notarealfile.ini');

        ProfileCredentialProvider::getLoginCredentials($config);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Profile Name "default" not found in credentials file
     */
    public function testGetLoginCredentialsMissingDefault()
    {
        $dir = $this->clearEnv();
        $ini = <<<EOF
[notdefault]
sender_id = testsenderid
sender_password = testsenderpass
EOF;
        file_put_contents($dir . '/credentials.ini', $ini);
        putenv('HOME=' . dirname($dir));

        $config = new ClientConfig();
        ProfileCredentialProvider::getLoginCredentials($config);
    }
}