<?php
/**
 * Timer - A delay dispatcher library
 *
 * @author  panlatent@gmail.com
 * @link    https://github.com/panlatent/timer
 * @license https://opensource.org/licenses/MIT
 */

namespace Panlatent\Timer;

class Interval extends IntervalTimer
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * Interval constructor.
     *
     * @param \Panlatent\Timer\Dispatcher $dispatcher
     * @param int                         $delay microsecond
     * @param                             $callback
     */
    public function __construct(Dispatcher $dispatcher, $delay, $callback)
    {
        parent::__construct($dispatcher, $delay);

        $this->callback = $callback;
    }

    /**
     * Run callback at each dispatcher period.
     */
    public function interval()
    {
        call_user_func($this->callback);
    }
}