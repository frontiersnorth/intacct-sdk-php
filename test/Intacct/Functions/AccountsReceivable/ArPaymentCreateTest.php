<?php

/**
 * Copyright 2020 Sage Intacct, Inc.
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

namespace Intacct\Functions\AccountsReceivable;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * @coversDefaultClass \Intacct\Functions\AccountsReceivable\ArPaymentCreate
 */
class ArPaymentCreateTest extends \PHPUnit\Framework\TestCase
{

    public function getXml()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();
        return $xml;
    }

    public function testDefaultParams()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <create>
        <ARPYMT>
            <PAYMENTMETHOD>Printed Check</PAYMENTMETHOD>
            <CUSTOMERID>C0020</CUSTOMERID>
            <RECEIPTDATE>05/15/2019</RECEIPTDATE>
            <CURRENCY>CAD</CURRENCY>
        </ARPYMT>
    </create>
</function>
EOF;

        $xml = $this->getXml();
    
        $payment = new ArPaymentCreate('unittest');
        $payment->setCustomerId('C0020');
        $payment->setReceiptDate('05/15/2019');
        $payment->setCurrency('CAD');
        $payment->setPaymentMethod($payment::PAYMENT_METHOD_CHECK);

        $payment->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Customer ID is required for create
     */
    public function testRequiredCustomerId()
    {
        $xml = $this->getXml();

        $payment = new ArPaymentCreate('unittest');
        //$payment->setCustomerId('C0020');
        $payment->setReceiptDate('05/15/2019');
        $payment->setCurrency('CAD');
        $payment->setPaymentMethod($payment::PAYMENT_METHOD_CHECK);

        $payment->writeXml($xml);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Receipt Date is required for create
     */
    public function testRequiredReceivedDate()
    {
        $xml = $this->getXml();

        $payment = new ArPaymentCreate('unittest');
        $payment->setCustomerId('C0020');
        //$payment->setReceiptDate('05/15/2019');
        $payment->setCurrency('CAD');
        $payment->setPaymentMethod($payment::PAYMENT_METHOD_CHECK);

        $payment->writeXml($xml);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Payment Method is required for create
     */
    public function testRequiredPaymentMethod()
    {
        $xml = $this->getXml();

        $payment = new ArPaymentCreate('unittest');
        $payment->setCustomerId('C0020');
        $payment->setReceiptDate('05/15/2019');
        $payment->setCurrency('CAD');
        //$payment->setPaymentMethod($payment::PAYMENT_METHOD_CHECK);

        $payment->writeXml($xml);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Currency is required for create
     */
    public function testRequiredCurrencyMethod()
    {
        $xml = $this->getXml();

        $payment = new ArPaymentCreate('unittest');
        $payment->setCustomerId('C0020');
        $payment->setReceiptDate('05/15/2019');
        //$payment->setCurrency('CAD');
        $payment->setPaymentMethod($payment::PAYMENT_METHOD_CHECK);

        $payment->writeXml($xml);
    }

    public function testPaymentDetailOnCreate()
    {
        $xml = $this->getXml();

        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <create>
        <ARPYMT>
            <PAYMENTMETHOD>Printed Check</PAYMENTMETHOD>
            <CUSTOMERID>C0020</CUSTOMERID>
            <RECEIPTDATE>05/15/2019</RECEIPTDATE>
            <CURRENCY>CAD</CURRENCY>
            <ARPYMTDETAILS>
                <ARPYMTDETAIL>
                    <RECORDKEY>1</RECORDKEY>
                    <TRX_PAYMENTAMOUNT>10</TRX_PAYMENTAMOUNT>
                </ARPYMTDETAIL>
            </ARPYMTDETAILS>
        </ARPYMT>
    </create>
</function>
EOF;

        $payment = new ArPaymentCreate('unittest');
        $payment->setCustomerId('C0020');
        $payment->setReceiptDate('05/15/2019');
        $payment->setCurrency('CAD');
        $payment->setPaymentMethod($payment::PAYMENT_METHOD_CHECK);
        
        $detail = new ArPaymentDetail();
        $detail->setRecordKey(1);
        $detail->setTrxPaymentAmount(10);

        $payment->setPaymentDetail($detail);

        $payment->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());

    }
}
