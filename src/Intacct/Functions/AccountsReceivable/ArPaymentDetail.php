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
 * Create new payment detail
 */
class ArPaymentDetail
{
    /** @var int */
    protected $recordKey;

    /** @var int */
    protected $entryKey;
    
    /** @var int */
    protected $posAdjKey;

    /** @var int */
    protected $posAdjEntryKey;

    /** @var double */
    protected $trxPaymentAmount;

    /** @var int */
    protected $adjustmentKey;

    /** @var int */
    protected $adjustmentEntryKey;

    /** @var double */
    protected $trxAdjustmentAmount;

    /** @var int */
    protected $inlineKey;

    /** @var int */
    protected $inlineEntryKey;

    /** @var double */
    protected $trxInlineAmount;

    /** @var int */
    protected $advanceKey;

    /** @var int */
    protected $advanceEntryKey;

    /** @var double */
    protected $trxPostedAdvanceAmount;

    /** @var int */
    protected $overPaymentKey;

    /** @var int */
    protected $overPaymentEntryKey;

    /** @var double */
    protected $trxPostedOverpaymentAmount;

    /** @var int */
    protected $negativeInvoiceKey;

    /** @var int */
    protected $negativeInvoiceEntryKey;

    /** @var double */
    protected $trxNegativeInvoiceAmount;

    /** @var string */
    protected $discountDate;

	/**
	 * Get the value of recordKey
	 *
	 * @return  mixed
	 */
	public function getRecordKey()
	{
		return $this->recordKey;
	}

	/**
	 * Set the value of recordKey
	 *
	 * @param   mixed  $recordKey  
	 *
	 */
	public function setRecordKey($recordKey)
	{
		$this->recordKey = $recordKey;
	}

	/**
	 * Get the value of entryKey
	 *
	 * @return  mixed
	 */
	public function getEntryKey()
	{
		return $this->entryKey;
	}

	/**
	 * Set the value of entryKey
	 *
	 * @param   mixed  $entryKey  
	 *
	 */
	public function setEntryKey($entryKey)
	{
		$this->entryKey = $entryKey;
	}

	/**
	 * Get the value of posAdjKey
	 *
	 * @return  mixed
	 */
	public function getPosAdjKey()
	{
		return $this->posAdjKey;
	}

	/**
	 * Set the value of posAdjKey
	 *
	 * @param   mixed  $posAdjKey  
	 *
	 */
	public function setPosAdjKey($posAdjKey)
	{
		$this->posAdjKey = $posAdjKey;

	}

	/**
	 * Get the value of posAdjEntryKey
	 *
	 * @return  mixed
	 */
	public function getPosAdjEntryKey()
	{
		return $this->posAdjEntryKey;
	}

	/**
	 * Set the value of posAdjEntryKey
	 *
	 * @param   mixed  $posAdjEntryKey  
	 *
	 */
	public function setPosAdjEntryKey($posAdjEntryKey)
	{
		$this->posAdjEntryKey = $posAdjEntryKey;

	}

	/**
	 * Get the value of trxPaymentAmount
	 *
	 * @return  mixed
	 */
	public function getTrxPaymentAmount()
	{
		return $this->trxPaymentAmount;
	}

	/**
	 * Set the value of trxPaymentAmount
	 *
	 * @param   mixed  $trxPaymentAmount  
	 *
	 */
	public function setTrxPaymentAmount($trxPaymentAmount)
	{
		$this->trxPaymentAmount = $trxPaymentAmount;

	}

	/**
	 * Get the value of adjustmentKey
	 *
	 * @return  mixed
	 */
	public function getAdjustmentKey()
	{
		return $this->adjustmentKey;
	}

	/**
	 * Set the value of adjustmentKey
	 *
	 * @param   mixed  $adjustmentKey  
	 *
	 */
	public function setAdjustmentKey($adjustmentKey)
	{
		$this->adjustmentKey = $adjustmentKey;

	}

	/**
	 * Get the value of adjustmentEntryKey
	 *
	 * @return  mixed
	 */
	public function getAdjustmentEntryKey()
	{
		return $this->adjustmentEntryKey;
	}

	/**
	 * Set the value of adjustmentEntryKey
	 *
	 * @param   mixed  $adjustmentEntryKey  
	 *
	 */
	public function setAdjustmentEntryKey($adjustmentEntryKey)
	{
		$this->adjustmentEntryKey = $adjustmentEntryKey;

	}

	/**
	 * Get the value of trxAdjustmentAmount
	 *
	 * @return  mixed
	 */
	public function getTrxAdjustmentAmount()
	{
		return $this->trxAdjustmentAmount;
	}

	/**
	 * Set the value of trxAdjustmentAmount
	 *
	 * @param   mixed  $trxAdjustmentAmount  
	 *
	 */
	public function setTrxAdjustmentAmount($trxAdjustmentAmount)
	{
		$this->trxAdjustmentAmount = $trxAdjustmentAmount;

	}

	/**
	 * Get the value of inlineEntryKey
	 *
	 * @return  mixed
	 */
	public function getInlineEntryKey()
	{
		return $this->inlineEntryKey;
	}

	/**
	 * Set the value of inlineEntryKey
	 *
	 * @param   mixed  $inlineEntryKey  
	 *
	 */
	public function setInlineEntryKey($inlineEntryKey)
	{
		$this->inlineEntryKey = $inlineEntryKey;

	}

	/**
	 * Get the value of trxInlineAmount
	 *
	 * @return  mixed
	 */
	public function getTrxInlineAmount()
	{
		return $this->trxInlineAmount;
	}

	/**
	 * Set the value of trxInlineAmount
	 *
	 * @param   mixed  $trxInlineAmount  
	 *
	 */
	public function setTrxInlineAmount($trxInlineAmount)
	{
		$this->trxInlineAmount = $trxInlineAmount;

	}

	/**
	 * Get the value of advanceKey
	 *
	 * @return  mixed
	 */
	public function getAdvanceKey()
	{
		return $this->advanceKey;
	}

	/**
	 * Set the value of advanceKey
	 *
	 * @param   mixed  $advanceKey  
	 *
	 */
	public function setAdvanceKey($advanceKey)
	{
		$this->advanceKey = $advanceKey;

	}

	/**
	 * Get the value of advanceEntryKey
	 *
	 * @return  mixed
	 */
	public function getAdvanceEntryKey()
	{
		return $this->advanceEntryKey;
	}

	/**
	 * Set the value of advanceEntryKey
	 *
	 * @param   mixed  $advanceEntryKey  
	 *
	 */
	public function setAdvanceEntryKey($advanceEntryKey)
	{
		$this->advanceEntryKey = $advanceEntryKey;

	}

	/**
	 * Get the value of trxPostedAdvanceAmount
	 *
	 * @return  mixed
	 */
	public function getTrxPostedAdvanceAmount()
	{
		return $this->trxPostedAdvanceAmount;
	}

	/**
	 * Set the value of trxPostedAdvanceAmount
	 *
	 * @param   mixed  $trxPostedAdvanceAmount  
	 *
	 */
	public function setTrxPostedAdvanceAmount($trxPostedAdvanceAmount)
	{
		$this->trxPostedAdvanceAmount = $trxPostedAdvanceAmount;

	}

	/**
	 * Get the value of overPaymentKey
	 *
	 * @return  mixed
	 */
	public function getOverPaymentKey()
	{
		return $this->overPaymentKey;
	}

	/**
	 * Set the value of overPaymentKey
	 *
	 * @param   mixed  $overPaymentKey  
	 *
	 */
	public function setOverPaymentKey($overPaymentKey)
	{
		$this->overPaymentKey = $overPaymentKey;

	}

	/**
	 * Get the value of trxPostedOverpaymentAmount
	 *
	 * @return  mixed
	 */
	public function getTrxPostedOverpaymentAmount()
	{
		return $this->trxPostedOverpaymentAmount;
	}

	/**
	 * Set the value of trxPostedOverpaymentAmount
	 *
	 * @param   mixed  $trxPostedOverpaymentAmount  
	 *
	 */
	public function setTrxPostedOverpaymentAmount($trxPostedOverpaymentAmount)
	{
		$this->trxPostedOverpaymentAmount = $trxPostedOverpaymentAmount;

	}

	/**
	 * Get the value of negativeInvoiceKey
	 *
	 * @return  mixed
	 */
	public function getNegativeInvoiceKey()
	{
		return $this->negativeInvoiceKey;
	}

	/**
	 * Set the value of negativeInvoiceKey
	 *
	 * @param   mixed  $negativeInvoiceKey  
	 *
	 */
	public function setNegativeInvoiceKey($negativeInvoiceKey)
	{
		$this->negativeInvoiceKey = $negativeInvoiceKey;

	}

	/**
	 * Get the value of negativeInvoiceEntryKey
	 *
	 * @return  mixed
	 */
	public function getNegativeInvoiceEntryKey()
	{
		return $this->negativeInvoiceEntryKey;
	}

	/**
	 * Set the value of negativeInvoiceEntryKey
	 *
	 * @param   mixed  $negativeInvoiceEntryKey  
	 *
	 */
	public function setNegativeInvoiceEntryKey($negativeInvoiceEntryKey)
	{
		$this->negativeInvoiceEntryKey = $negativeInvoiceEntryKey;

	}

	/**
	 * Get the value of trxNegativeInvoiceAmount
	 *
	 * @return  mixed
	 */
	public function getTrxNegativeInvoiceAmount()
	{
		return $this->trxNegativeInvoiceAmount;
	}

	/**
	 * Set the value of trxNegativeInvoiceAmount
	 *
	 * @param   mixed  $trxNegativeInvoiceAmount  
	 *
	 */
	public function setTrxNegativeInvoiceAmount($trxNegativeInvoiceAmount)
	{
		$this->trxNegativeInvoiceAmount = $trxNegativeInvoiceAmount;

	}

	/**
	 * Get the value of discountDate
	 *
	 * @return  mixed
	 */
	public function getDiscountDate()
	{
		return $this->discountDate;
	}

	/**
	 * Set the value of discountDate
	 *
	 * @param   mixed  $discountDate  
	 *
	 */
	public function setDiscountDate($discountDate)
	{
		$this->discountDate = $discountDate;

    }
    

	/**
	 * Get the value of inlineKey
	 *
	 * @return  mixed
	 */
	public function getInlineKey()
	{
		return $this->inlineKey;
	}

	/**
	 * Set the value of inlineKey
	 *
	 * @param   mixed  $inlineKey  
	 *
	 */
	public function setInlineKey($inlineKey)
	{
		$this->inlineKey = $inlineKey;

	}

	/**
	 * Get the value of overPaymentEntryKey
	 *
	 * @return  mixed
	 */
	public function getOverPaymentEntryKey()
	{
		return $this->overPaymentEntryKey;
	}

	/**
	 * Set the value of overPaymentEntryKey
	 *
	 * @param   mixed  $overPaymentEntryKey  
	 *
	 */
	public function setOverPaymentEntryKey($overPaymentEntryKey)
	{
		$this->overPaymentEntryKey = $overPaymentEntryKey;

	}

    /**
     * Write the function block XML
     *
     * @param XMLWriter $xml
     * @throw InvalidArgumentException
     */
    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('ARPYMTDETAIL');
        if (empty($this->getRecordKey())) {
            throw new InvalidArgumentException('Record Key is required for payment detail');
        }
        $xml->writeElement('RECORDKEY', $this->getRecordKey());
        $xml->writeElement('ENTRYKEY', $this->getEntryKey());
        $xml->writeElement('POSADJKEY', $this->getPosAdjKey());
        $xml->writeElement('POSADJENTRYKEY', $this->getPosAdjEntryKey());
        $xml->writeElement('TRX_PAYMENTAMOUNT', $this->getTrxPaymentAmount());
        $xml->writeElement('ADJUSTMENTKEY', $this->getAdjustmentKey());
        $xml->writeElement('ADJUSTMENTENTRYKEY', $this->getAdjustmentEntryKey());
        $xml->writeElement('TRX_ADJUSTMENTAMOUNT', $this->getTrxAdjustmentAmount());
        $xml->writeElement('INLINEKEY', $this->getInlineKey());
        $xml->writeElement('INLINEENTRYKEY', $this->getInlineEntryKey());
        $xml->writeElement('TRX_INLINEAMOUNT', $this->getTrxInlineAmount());
        $xml->writeElement('ADVANCEKEY', $this->getAdvanceKey());
        $xml->writeElement('ADVANCEENTRYKEY', $this->getAdvanceEntryKey());
        $xml->writeElement('TRX_POSTEDADVANCEAMOUNT', $this->getTrxPostedAdvanceAmount());
        $xml->writeElement('OVERPAYMENTKEY', $this->getOverPaymentKey());
        $xml->writeElement('OVERPAYMENTENTRYKEY', $this->getOverPaymentEntryKey());
        $xml->writeElement('TRX_POSTEDOVERPAYMENTAMOUNT', $this->getTrxPostedOverpaymentAmount());
        $xml->writeElement('NEGATIVEINVOICEKEY', $this->getNegativeInvoiceKey());
        $xml->writeElement('NEGATIVEINVOICEENTRYKEY', $this->getNegativeInvoiceEntryKey());
        $xml->writeElement('TRX_NEGATIVEINVOICEAMOUNT', $this->getTrxNegativeInvoiceAmount());
        $xml->writeElement('DISCOUNTDATE', $this->getDiscountDate());

        $xml->endElement(); // ARPYMTDETAIL
    }

}

