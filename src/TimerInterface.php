<?php
/**
 * Timer - A delay dispatcher library
 *
 * @author  panlatent@gmail.com
 * @link    https://github.com/panlatent/timer
 * @license https://opensource.org/licenses/MIT
 */

namespace Panlatent\Timer;

interface TimerInterface
{
    /**
     * Gets the timer delay microsecond value.
     *
     * @return int microsecond
     */
    public function getDelay();

    /**
     * Get the timer was added to dispatcher time.
     *
     * @return int microsecond
     */
    public function getBorn();

    /**
     * Sets the timer was added to dispatcher time.
     *
     * @param int $time microsecond
     */
    public function setBorn($time);

    /**
     * Dispatcher executes code.
     *
     * @return void
     */
    public function run();
}