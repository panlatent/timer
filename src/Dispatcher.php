<?php
/**
 * Timer - A delay dispatcher library
 *
 * @author  panlatent@gmail.com
 * @link    https://github.com/panlatent/timer
 * @license https://opensource.org/licenses/MIT
 */

namespace Panlatent\Timer;

class Dispatcher implements Dispatchable
{
    /**
     * @var bool
     */
    protected $done = true;

    /**
     * @var \Panlatent\Timer\TimeMinHeap
     */
    protected $timers;

    /**
     * Dispatcher constructor.
     */
    public function __construct()
    {
        $this->timers = new TimeMinHeap();
    }

    /**
     * Add a timer to dispatcher.
     *
     * @param \Panlatent\Timer\TimerInterface $timer
     */
    public function addTimer(TimerInterface $timer)
    {
        $this->timers->insert($timer);
    }

    /**
     * Run dispatcher Until all timers are removed.
     */
    public function dispatch()
    {
        $this->done = false;
        while ( ! $this->done && ! $this->timers->isEmpty()) {
            $timer = $this->timers->top();

            $beforeDelay = (int)(microtime(true) * 1000);
            $elapsed = $beforeDelay - $timer->getBorn();

            $delay = $timer->getDelay();
            if ($delay >= $elapsed) { // 5ms - 5
                $delay -= $elapsed;

                $sec = (int)($delay / 1000);
                $micro = $delay % 1000;

                $beforeSleep = microtime(true);
                if (time_nanosleep($sec, $micro * 1000)) {

                }
                $sleep = (microtime(true) - $beforeSleep) * 1000;

                if ($sleep >= $delay) {
                    $timer->run();
                    $this->timers->extract();
                }
            } else {
                $timer->run();
                $this->timers->extract();
            }
        }
    }

    /**
     * Stop run in next dispatcher period.
     */
    public function clear()
    {
        $this->done = true;
    }
}