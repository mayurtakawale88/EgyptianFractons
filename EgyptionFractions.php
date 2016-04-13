<?php
/**
 * Description of EgyptionFractions
 *
 * @author mayur
 */
class EgyptionFractions {
    /**
    * Define instanse variable to return result of fraction to user.
    */
    private $_fractions = '';
    
    /**
     * Get Fraction of given number
     * 
     * @return string
     */
    public function getFractions() {
        return $this->_fractions;
    }
    
    /**
     * Set Fractions in instans variable
     * 
     * @param int $denominator
     */
    private function setFractions( $denominator ) {
        if(empty($this->_fractions)) {
            $this->_fractions = "1/" . $denominator; 
        } else {
            $this->_fractions .= " + 1/" . $denominator;
        }
    }
   
    /**
     * Calculate Egyption fractions of given fraction number
     * 
     * @param int $numerator
     * @param int $denominator
     * 
     * @throws OutOfRangeException
     * 
     */
    public function calculateFractions( $numerator, $denominator ) {
        $subDenominator = 2;
        
        if ($numerator >= $denominator) {
            throw new OutOfRangeException("denominator out of range");
        }
        if ($numerator <= 0) {
            throw new OutOfRangeException("numerator out of range");
        }
 
 
        do {
            $leftNumerator = $numerator * $subDenominator;
            while ($leftNumerator < $denominator) {
                $subDenominator++;
                $leftNumerator += $numerator;
            }
            
            while (true) {
                $remainingNumerator = $leftNumerator - $denominator;
                if($remainingNumerator == 0) {
                    // The fractions are the same
                    $numerator = 0;
                    $this->setFractions($subDenominator);
                    break;
                }
                $remainingDenominator = $denominator * $subDenominator;
                $commonDivisor = $this->getGreatestCommonDivisor($remainingNumerator, $remainingDenominator);
                if ($commonDivisor > 1 || $remainingNumerator == 1) {
                    $numerator = $remainingNumerator / $commonDivisor;
                    $denominator = $remainingDenominator / $commonDivisor;
                    $this->setFractions($subDenominator);
 
                    if($numerator == 1) {
                        $this->setFractions($denominator);
                    }
                    break;
                }
                
                $subDenominator++;
                $leftNumerator += $numerator;
            }
 
            $subDenominator++;
        } while ($numerator > 1);
    }
 
    /**
     * Calculate gratest common divisor of two numbers
     * 
     * @param int $divisor
     * @param int $reminder
     * 
     * @return int
     */
    private function getGreatestCommonDivisor( $divisor, $reminder ) {
        if ($reminder == 0)
            return $divisor;
        return $this->getGreatestCommonDivisor( $reminder, $divisor % $reminder );
    }
}