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

use Intacct\Functions\AbstractFunction;
use InvalidArgumentException;

abstract class AbstractArPayment extends AbstractFunction
{

    /** @var string */
    const PAYMENT_METHOD_CHECK = 'Printed Check';

    /** @var string */
    const PAYMENT_METHOD_CASH = 'Cash';

    /** @var string */
    const PAYMENT_METHOD_RECORD_TRANSFER = 'EFT';

    /** @var string */
    const PAYMENT_METHOD_CREDIT_CARD = 'Credit Card';

    /** @var string */
    const PAYMENT_METHOD_ONLINE = 'Online';

    /** @var string */
    const PAYMENT_METHOD_ONLINE_CREDIT_CARD = 'Online Charge Card';

    /** @var string */
    const PAYMENT_METHOD_ONLINE_ACH_DEBIT = 'Online ACH Debit';

    /** @var array */
    const PAYMENT_METHODS = [
        'Printed Check',
        'Cash',
        'EFT',
        'Credit Card',
        'Online',
        //'Online Charge Card',
        //'Online ACH Debit',
    ];

    /** @var string */
    protected $financialEntity;

    /** @var int|string */
    protected $docNumber;

    /** @var string */
    protected $paymentMethod;

    /** @var string */
    protected $currency;

    /** @var string */
    protected $customerId;

    /** @var string */
    protected $description;

    /** @var string */
    protected $receiptDate;

    /** @var string */
    protected $exchangeRateTypeId;

    /** @var string */
    protected $exchangeRate;

    /** @var string */
    protected $paymentDate;

    /** @var double */
    protected $amountToPay;
    
    /** @var double */
    protected $transactionAmountToPay;

    /** @var string */
    protected $prBatch;

    /** @var string */
    protected $whenPaid;

    /** @var string */
    protected $baseCurrency;

    /** @var string */
    protected $undepositedFundsGlAccountNo;

    /** @var string */
    protected $overpaymentDepartmentId;

    /** @var string */
    protected $overpaymentLocationId;

    /** @var string */
    protected $overpaymentAmount;

    /** @var string */
    protected $billToPayName;
    
    /** @var ArPaymentDetail[] */
    protected $paymentDetail = [];

    /**
     * Get financial entity
     *
     * @return string
     */
    public function getFinancialEntity()
    {
        return $this->financialEntity;
    }

    /**
     * Set financial entity
     *
     * @param string $financialEntity
     */
    public function setFinancialEntity($financialEntity)
    {
        $this->financialEntity = $financialEntity;
    }

    /**
     * Get record number
     *
     * @return int|string
     */
    public function getDocNumber()
    {
        return $this->docNumber;
    }

    /**
     * Set record number
     *
     * @param string $docNumber
     */
    public function setDocNumber($docNumber)
    {
        $this->docNumber = $docNumber;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * Get payment method
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set payment method
     *
     * @param string $paymentMethod
     * @throws InvalidArgumentException
     */
    public function setPaymentMethod($paymentMethod)
    {
        if (!in_array($paymentMethod, static::PAYMENT_METHODS)) {
            throw new InvalidArgumentException('Payment method is not valid');
        }
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Get bank account ID
     *
     * @return string
     */
    public function getAmountToPay()
    {
        return $this->amountToPay;
    }

    /**
     * Set bank account ID
     *
     * @param string $bankAccountId
     */
    public function setAmountToPay($amountToPay)
    {
        $this->amountToPay = $amountToPay;
    }

    /**
     * Set bill to pay name
     *
     * @return string
     */
    public function getBillToPayName()
    {
        return $this->billToPayName;
    }

    /**
     * Get bill to pay name
     *
     * @param string $billToPayName
     */
    public function setBillToPayName($billToPayName)
    {
        $this->billToPayName = $billToPayName;
    }    

    /**
     * Get undeposited funds GL account number
     *
     * @return string
     */
    public function getUndepositedFundsGlAccountNo()
    {
        return $this->undepositedFundsGlAccountNo;
    }

    /**
     * Set undeposited funds GL account number
     *
     * @param string $undepositedFundsGlAccountNo
     */
    public function setUndepositedFundsGlAccountNo($undepositedFundsGlAccountNo)
    {
        $this->undepositedFundsGlAccountNo = $undepositedFundsGlAccountNo;
    }

    /**
     * Get transaction currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set transaction currency
     *
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * Get base currency
     *
     * @return string
     */
    public function getBaseCurrency()
    {
        return $this->baseCurrency;
    }

    /**
     * Set base currency
     *
     * @param string $baseCurrency
     */
    public function setBaseCurrency($baseCurrency)
    {
        $this->baseCurrency = $baseCurrency;
    }

    /**
     * Get customer ID
     *
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set customer ID
     *
     * @param string $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * Get received date
     *
     * @return \DateTime
     */
    public function getReceiptDate()
    {
        return $this->receiptDate;
    }

    /**
     * Set received date
     *
     * @param \DateTime $receivedDate
     */
    public function setReceiptDate($receiptDate)
    {
        $this->receiptDate = $receiptDate;
    }

    /**
     * Get paid date
     *
     * @return string
     */
    public function getWhenPaid()
    {
        return $this->whenPaid;
    }

    /**
     * Set paid date
     *
     * @param string $whenPaid
     */
    public function setWhenPaid($whenPaid)
    {
        $this->whenPaid = $whenPaid;
    }

    /**
     * Get transaction payment amount
     *
     * @return float|string
     */
    public function getTransactionAmountToPay()
    {
        return $this->transactionAmountToPay;
    }

    /**
     * Set transaction payment amount
     *
     * @param float|string $transactionAmountToPay
     */
    public function setTransactionAmountToPay($transactionAmountToPay)
    {
        $this->transactionAmountToPay = $transactionAmountToPay;
    }

    /**
     * Get PR Batch
     *
     * @return float|string
     */
    public function getPrBatch()
    {
        return $this->prBatch;
    }

    /**
     * Set PR Batch
     *
     * @param string $prBatch
     */
    public function setPrBatch($prBatch)
    {
        $this->prBatch = $prBatch;
    }

    /**
     * Get exchange rate value
     *
     * @return float
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * Set exchange rate value
     *
     * @param float $exchangeRate
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * Get exchange rate type ID
     *
     * @return string
     */
    public function getExchangeRateTypeId()
    {
        return $this->exchangeRateTypeId;
    }

    /**
     * Set exchange rate type
     *
     * @param string $exchangeRateType
     */
    public function setExchangeRateTypeId($exchangeRateTypeId)
    {
        $this->exchangeRateTypeId = $exchangeRateTypeId;
    }

    /**
     * Get overpayment location ID
     *
     * @return string
     */
    public function getOverpaymentLocationId()
    {
        return $this->overpaymentLocationId;
    }

    /**
     * Set overpayment location ID
     *
     * @param string $overpaymentLocationId
     */
    public function setOverpaymentLocationId($overpaymentLocationId)
    {
        $this->overpaymentLocationId = $overpaymentLocationId;
    }

    /**
     * Get overpayment department ID
     *
     * @return string
     */
    public function getOverpaymentDepartmentId()
    {
        return $this->overpaymentDepartmentId;
    }

    /**
     * Set overpayment department ID
     *
     * @param string $overpaymentDepartmentId
     */
    public function setOverpaymentDepartmentId($overpaymentDepartmentId)
    {
        $this->overpaymentDepartmentId = $overpaymentDepartmentId;
    }

    /**
     * Get overpayment amount
     *
     * @return string
     */
    public function getOverpaymentAmount()
    {
        return $this->overpaymentAmount;
    }

    /**
     * Set overpayment amount
     *
     * @param string $overpaymentAmount
     */
    public function setOverpaymentAmount($overpaymentAmount)
    {
        $this->overpaymentAmount = $overpaymentAmount;
    }

    /**
     * Get payment date
     *
     * @return string
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * Set payment date
     *
     * @param string $paymentDate
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;
    }

    /**
     * Get payment detail
     *
     * @return ArPaymentDetail[]
     */
    public function getPaymentDetail()
    {
        return $this->paymentDetail;
    }

    /**
     * Set payment detail
     *
     * @param ArPaymentDetail $paymentDetail
     */
    public function setPaymentDetail(ArPaymentDetail $paymentDetail)
    {
        $this->paymentDetail = $paymentDetail;
    }
}
