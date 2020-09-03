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
 * Create a new payments
 */
class ArPaymentCreate extends AbstractArPayment
{

    /**
     * Write the function block XML
     *
     * @param XMLWriter $xml
     * @throw InvalidArgumentException
     */
    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->getControlId());

        $xml->startElement('create');
        $xml->startElement('ARPYMT');

        $xml->writeElement('FINANCIALENTITY', $this->getFinancialEntity());

        if (empty($this->getPaymentMethod())) {
            throw new InvalidArgumentException('Payment Method is required for create');
        }
        $xml->writeElement('PAYMENTMETHOD', $this->getPaymentMethod());

        if (empty($this->getCustomerId())) {
            throw new InvalidArgumentException('Customer ID is required for create');
        }
        $xml->writeElement('CUSTOMERID', $this->getCustomerId());

        $xml->writeElement('DOCNUMBER', $this->getDocNumber());
        $xml->writeElement('DESCRIPTION', $this->getDescription());
        $xml->writeElement('EXCH_RATE_TYPE_ID', $this->getExchangeRateTypeId());
        $xml->writeElement('EXCHANGE_RATE', $this->getExchangeRate());
        
        if (empty($this->getReceiptDate())) {
            throw new InvalidArgumentException('Receipt Date is required for create');
        }
        $xml->writeElement('RECEIPTDATE', $this->getReceiptDate());
        $xml->writeElement('PAYMENTDATE', $this->getPaymentDate());
        $xml->writeElement('AMOUNTOPAY', $this->getAmountToPay());
        $xml->writeElement('TRX_AMOUNTTOPAY', $this->getTransactionAmountToPay());
        $xml->writeElement('PRBATCH', $this->getPrBatch());
        $xml->writeElement('WHENPAID', $this->getWhenPaid());
        
        if (empty($this->getCurrency())) {
            throw new InvalidArgumentException('Currency is required for create');
        }
        $xml->writeElement('CURRENCY', $this->getCurrency());

        $xml->writeElement('BASECURR', $this->getBaseCurrency());
        $xml->writeElement('UNDEPOSITEDACCOUNTNO', $this->getUndepositedFundsGlAccountNo());
        $xml->writeElement('OVERPAYMENTAMOUNT', $this->getOverpaymentAmount());
        $xml->writeElement('OVERPAYMENTLOCATIONID', $this->getOverpaymentLocationId());
        $xml->writeElement('OVERPAYMENTDEPARTMENTID', $this->getOverpaymentDepartmentId());
        $xml->writeElement('BILLTOPAYNAME', $this->getBillToPayName());

        if (!empty($this->getPaymentDetail())) {
            $xml->startElement('ARPYMTDETAILS');
            $this->getPaymentDetail()->writeXml($xml);
            $xml->endElement(); // ARPYMTDETAILS
        }

        //$xml->writeElement('ONLINECARDPAYMENT', $this->getOnlineCardPayment(), true);
        
        $xml->endElement(); //ARPYMT
        $xml->endElement(); //create

        $xml->endElement(); //function
    }
}
