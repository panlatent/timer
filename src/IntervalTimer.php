<?php
/**
 * Timer - A delay dispatcher library
 *
 * @author  panlatent@gmail.com
 * @link    https://github.com/panlatent/timer
 * @license https://opensource.org/licenses/MIT
 */

namespace Panlatent\Timer;

abstract class IntervalTimer extends TimerAbstract
{
    /**
     * @var \Panlatent\Timer\Dispatcher
     */
    protected $dispatcher;

    /**
     * @var bool
     */
    protected $running;

    /**
     * IntervalTimer constructor.
     *
     * @param \Panlatent\Timer\Dispatcher $dispatcher
     * @param int                         $delay microsecond
     */
    public function __construct(Dispatcher $dispatcher, $delay)
    {
        $this->dispatcher = $dispatcher;
        $this->delay = $delay;
        $this->running = true;
    }

    abstract public function interval();

    /**
     * Continuous call interval method.
     */
    final public function run()
    {
        $this->interval();
        if ($this->running) {
            $this->dispatcher->addTimer($this);
        }
    }

    /**
     * Stop the timer loop。
     */
    public function clear()
    {
        $this->running = false;
    }
}