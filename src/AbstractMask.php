<?php

namespace Mask;

use Mask\Exception\InvalidArgumentException;

/**
 * 
 */
abstract class AbstractMask 
{

    /**
     *
     * @var string 
     */
    protected $mask;
    
    /**
     *
     * @var string 
     */
    protected $value;
    
    /**
     *
     * @var integer
     */
    protected $total;
    
    /**
     *
     * @var string 
     */
    protected $completeWith;
    
    /**
     *
     * @var integer 
     */
    protected $strPad;
    
    /**
     *
     * @var string 
     */
    protected $return;

    /**
     *
     * @var string 
     */
    const REPLACE_ELEMENT = '#';
    
    /**
     *
     * @var string 
     */
    const DEFAULT_COMPLETE_WITH = ' ';
    
    /**
     *
     * @var boolean
     */
    const TRIM_IN_THE_END = true;

    /**
     * 
     * @param string $value Value to be masked
     * @param string $completeWith String to repeat to complete the mask
     * @param integer $strPad STR_PAD Constants
     * @return \Mask\AbstractMask
     */
    public function mask($value, $completeWith = null, $strPad = STR_PAD_LEFT) 
    {
        $this->mask = $this->getStringMask();
        $this->value = $value;
        $this->total = strlen($this->getStringMask());
        $this->completeWith = $completeWith;
        $this->strPad = $strPad;
        return $this
            ->pad()
            ->isValid()
            ->result();
    }
    /**
     * @example return ###-#.##,##
     * 
     * @return string
     */
    abstract public function getStringMask();
    
    /**
     * 
     * @return \Mask\AbstractMask
     * @throws InvalidArgumentException
     */
    protected function isValid()
    {
        if (is_null($this->mask) && !$this->mask) {
            throw new InvalidArgumentException('Sorry, mask is not set.');
        }
        return $this;
    }
    
    /**
     * 
     * @return \Mask\AbstractMask
     */
    protected function result()
    {
        $this->return = $this->mask;
        for ($i = 0, $j = 0; $j < $this->total; $i++, $j++) {
            if ($this->mask[$j] != static::REPLACE_ELEMENT) {
                $i--;
                continue;
            }
            if (isset($this->value[$i])) {
                $this->return[$j] = $this->value[$i];
            }
        }
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function toString()
    {
        return $this->__toString();
    }

    /**
     * 
     * @return \Mask\AbstractMask
     */
    protected function pad() 
    {
        $totalMask = substr_count($this->mask, static::REPLACE_ELEMENT);
        $tmpValue = str_replace(static::REPLACE_ELEMENT, '', $this->value);
        $totalValue = strlen($tmpValue);
        if (($totalMask > $totalValue)) {
            if (is_null($this->completeWith) && !$this->completeWith) {
                $this->completeWith = static::DEFAULT_COMPLETE_WITH;
            }
            $this->value = str_pad($tmpValue, $totalMask, $this->completeWith, $this->strPad);
        }
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function __toString() 
    {
        if (static::TRIM_IN_THE_END) {
            return trim($this->return);
        }
        return $this->return;
    }

}
