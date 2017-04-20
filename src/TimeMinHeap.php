<?php
/**
 * Timer - A delay dispatcher library
 *
 * @author  panlatent@gmail.com
 * @link    https://github.com/panlatent/timer
 * @license https://opensource.org/licenses/MIT
 */

namespace Panlatent\Timer;

use SplMinHeap;

/**
 * Class TimeMinHeap
 *
 * @package Panlatent\Timer\Timer
 * @method TimerInterface top();
 * @method TimerInterface extract();
 */
class TimeMinHeap extends SplMinHeap
{
    /**
     * @param \Panlatent\Timer\TimerInterface $timer
     */
    public function insert($timer)
    {
        $timer->setBorn((int)(microtime(true) * 1000));
        parent::insert($timer);
    }

    /**
     * @param \Panlatent\Timer\TimerInterface $timer1
     * @param \Panlatent\Timer\TimerInterface $timer2
     * @return int
     */
    protected function compare($timer1, $timer2)
    {
        return ($timer2->getBorn() + $timer2->getDelay()) - ($timer1->getBorn() + $timer1->getDelay());
    }
}