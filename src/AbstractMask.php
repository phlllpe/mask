<?php

namespace Mask;

use Mask\Exception\InvalidArgumentException;

abstract class AbstractMask 
{

    protected $mask;
    private $value;
    private $total;
    private $completeWith;
    private $strPad;
    private $return;

    /**
     * 
     */
    const REPLACE_ELEMENT = '#';
    const DEFAULT_COMPLETE_WITH = ' ';
    const TRIM_IN_THE_END = true;

    /**
     * 
     * @param string $value Value to be masked
     * @param string $completeWith String to repeat to complete the mask
     * @param integer $strPad STR_PAD Constants
     * @return type
     */
    public final function mask($value, $completeWith = null, $strPad = STR_PAD_BOTH) 
    {
        $this->value = $value;
        $this->total = strlen($this->mask);
        $this->completeWith = $completeWith;
        $this->strPad = $strPad;
        return $this
            ->pad()
            ->dispatch();
    }
    /**
     * @example return ###-#.##,##
     * 
     * @return string
     */
    abstract function getStringMask();
    
    /**
     * 
     * @return string
     * @throws InvalidArgumentException
     */
    private final function dispatch() 
    {
        $this->mask = $this->getStringMask();
        if (is_null($this->mask) && !$this->mask) {
            throw new InvalidArgumentException('Sorry, mask is not set.');
        }

        $this->return = $this->mask;
        for ($i = 0, $j = 0; $j < $this->total; $i++, $j++) {
            if ($this->mask[$j] != self::REPLACE_ELEMENT) {
                $i--;
                continue;
            }
            if (isset($this->value[$i])) {
                $this->return[$j] = $this->value[$i];
            }
        }
        return $this->return;
    }

    /**
     * 
     * @return \Mask\AbstractMask
     */
    private final function pad() 
    {
        $totalMask = substr_count($this->mask, static::REPLACE_ELEMENT);
        $totalValue = strlen($this->value);
        if (($totalMask > $totalValue)) {
            if (is_null($this->completeWith) && !$this->completeWith) {
                $this->completeWith = static::DEFAULT_COMPLETE_WITH;
            }
            $this->value = str_pad($this->value, $totalMask, $this->completeWith, $this->strPad);
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
