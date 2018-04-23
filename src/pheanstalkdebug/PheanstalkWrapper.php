<?php
/**
 * https://github.com/pda/pheanstalk/blob/master/src/PheanstalkInterface.php
 */
namespace razielsd\pheanstalkdebug;


use Pheanstalk\PheanstalkInterface;
use Pheanstalk\Connection;


class PheanstalkWrapper implements PheanstalkInterface
{
    /** @var PheanstalkInterface */
    protected $pheanstalk = null;

    /** @var DebugInterface  */
    protected $debugger = null;


    public function __construct(PheanstalkInterface $pheanstalk, DebugInterface $debugger)
    {
        $this->pheanstalk = $pheanstalk;
        $this->debugger = $debugger;
    }


    public function getDebugger(): DebugInterface
    {
        return $this->debugger;
    }


    /**
     * @param Connection $connection
     *
     * @return $this
     */
    public function setConnection(Connection $connection)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->pheanstalk->setConnection($connection);
        return $this;
    }


    /**
     * The internal connection object.
     * Not required for general usage.
     *
     * @return Connection
     */
    public function getConnection()
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->getConnection();
    }


    /**
     * Puts a job into a 'buried' state, revived only by 'kick' command.
     *
     * @param Job $job
     * @param int $priority
     */
    public function bury($job, $priority = self::DEFAULT_PRIORITY)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->pheanstalk->bury($job, $priority);
    }


    /**
     * Permanently deletes a job.
     *
     * @param object $job Job
     *
     * @return $this
     */
    public function delete($job)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->pheanstalk->delete($job);
        return $this;
    }


    /**
     * Remove the specified tube from the watchlist.
     *
     * Does not execute an IGNORE command if the specified tube is not in the
     * cached watchlist.
     *
     * @param string $tube
     *
     * @return $this
     */
    public function ignore($tube)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->pheanstalk->ignore($tube);
        return $this;
    }


    /**
     * Kicks buried or delayed jobs into a 'ready' state.
     * If there are buried jobs, it will kick up to $max of them.
     * Otherwise, it will kick up to $max delayed jobs.
     *
     * @param int $max The maximum jobs to kick
     *
     * @return int Number of jobs kicked
     */
    public function kick($max)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->kick($max);
    }


    /**
     * A variant of kick that operates with a single job. If the given job
     * exists and is in a buried or delayed state, it will be moved to the
     * ready queue of the the same tube where it currently belongs.
     *
     * @param Job $job Job
     *
     * @return $this
     */
    public function kickJob($job)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->pheanstalk->kickJob($job);
        return $this;
    }


    /**
     * The names of all tubes on the server.
     *
     * @return array
     */
    public function listTubes()
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->listTubes();
    }


    /**
     * The names of the tubes being watched, to reserve jobs from.
     *
     * Returns the cached watchlist if $askServer is false (the default),
     * or queries the server for the watchlist if $askServer is true.
     *
     * @param bool $askServer
     *
     * @return array
     */
    public function listTubesWatched($askServer = false)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->listTubesWatched($askServer);
    }


    /**
     * The name of the current tube used for publishing jobs to.
     *
     * Returns the cached value if $askServer is false (the default),
     * or queries the server for the currently used tube if $askServer
     * is true.
     *
     * @param bool $askServer
     *
     * @return string
     */
    public function listTubeUsed($askServer = false)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->listTubeUsed($askServer);
    }


    /**
     * Temporarily prevent jobs being reserved from the given tube.
     *
     * @param string $tube  The tube to pause
     * @param int    $delay Seconds before jobs may be reserved from this queue.
     *
     * @return $this
     */
    public function pauseTube($tube, $delay)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->pheanstalk->pauseTube($tube, $delay);
        return $this;
    }


    /**
     * Resume jobs for a given paused tube.
     *
     * @param string $tube The tube to resume
     *
     * @return $this
     */
    public function resumeTube($tube)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->resumeTube($tube);
        return $this;
    }


    /**
     * Inspect a job in the system, regardless of what tube it is in.
     *
     * @param int $jobId
     *
     * @return object Job
     */
    public function peek($jobId)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->peek($jobId);
    }
    /**
     * Inspect the next ready job in the specified tube. If no tube is
     * specified, the currently used tube in used.
     *
     * @param string $tube
     *
     * @return object Job
     */
    public function peekReady($tube = null)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->peekReady($tube);
    }


    /**
     * Inspect the shortest-remaining-delayed job in the specified tube. If no
     * tube is specified, the currently used tube in used.
     *
     * @param string $tube
     *
     * @return object Job
     */
    public function peekDelayed($tube = null)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->peekDelayed($tube);
    }


    /**
     * Inspect the next job in the list of buried jobs of the specified tube.
     * If no tube is specified, the currently used tube in used.
     *
     * @param string $tube
     *
     * @return object Job
     */
    public function peekBuried($tube = null)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->peekBuried($tube);
    }


    /**
     * Puts a job on the queue.
     *
     * @param string $data     The job data
     * @param int    $priority From 0 (most urgent) to 0xFFFFFFFF (least urgent)
     * @param int    $delay    Seconds to wait before job becomes ready
     * @param int    $ttr      Time To Run: seconds a job can be reserved for
     *
     * @return int The new job ID
     */
    public function put($data, $priority = self::DEFAULT_PRIORITY, $delay = self::DEFAULT_DELAY, $ttr = self::DEFAULT_TTR)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->put($data, $priority, $delay, $ttr);
    }


    /**
     * Puts a job on the queue using specified tube.
     *
     * Using this method is equivalent to calling useTube() then put(), with
     * the added benefit that it will not execute the USE command if the client
     * is already using the specified tube.
     *
     * @param string $tube     The tube to use
     * @param string $data     The job data
     * @param int    $priority From 0 (most urgent) to 0xFFFFFFFF (least urgent)
     * @param int    $delay    Seconds to wait before job becomes ready
     * @param int    $ttr      Time To Run: seconds a job can be reserved for
     *
     * @return int The new job ID
     */
    public function putInTube($tube, $data, $priority = self::DEFAULT_PRIORITY, $delay = self::DEFAULT_DELAY, $ttr = self::DEFAULT_TTR)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->putInTube($tube, $data, $priority, $delay, $ttr);
    }


    /**
     * Puts a reserved job back into the ready queue.
     *
     * Marks the jobs state as "ready" to be run by any client.
     * It is normally used when the job fails because of a transitory error.
     *
     * @param object $job      Job
     * @param int    $priority From 0 (most urgent) to 0xFFFFFFFF (least urgent)
     * @param int    $delay    Seconds to wait before job becomes ready
     *
     * @return $this
     */
    public function release($job, $priority = self::DEFAULT_PRIORITY, $delay = self::DEFAULT_DELAY)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->pheanstalk->release($job, $priority, $delay);
        return $this;
    }


    /**
     * Reserves/locks a ready job in a watched tube.
     *
     * A non-null timeout uses the 'reserve-with-timeout' instead of 'reserve'.
     *
     * A timeout value of 0 will cause the server to immediately return either a
     * response or TIMED_OUT.  A positive value of timeout will limit the amount of
     * time the client will block on the reserve request until a job becomes
     * available.
     *
     * @param int $timeout
     *
     * @return object Job
     */
    public function reserve($timeout = null)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->reserve($timeout);
    }


    /**
     * Reserves/locks a ready job from the specified tube.
     *
     * A non-null timeout uses the 'reserve-with-timeout' instead of 'reserve'.
     *
     * A timeout value of 0 will cause the server to immediately return either a
     * response or TIMED_OUT.  A positive value of timeout will limit the amount of
     * time the client will block on the reserve request until a job becomes
     * available.
     *
     * Using this method is equivalent to calling watch(), ignore() then
     * reserve(), with the added benefit that it will not execute uneccessary
     * WATCH or IGNORE commands if the client is already watching the
     * specified tube.
     *
     * @param string $tube
     * @param int    $timeout
     *
     * @return object Job
     */
    public function reserveFromTube($tube, $timeout = null)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->reserveFromTube($tube, $timeout);
    }


    /**
     * Gives statistical information about the specified job if it exists.
     *
     * @param Job|int $job
     *
     * @return object
     */
    public function statsJob($job)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->statsJob($job);
    }


    /**
     * Gives statistical information about the specified tube if it exists.
     *
     * @param string $tube
     *
     * @return object
     */
    public function statsTube($tube)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->statsTube($tube);
    }


    /**
     * Gives statistical information about the beanstalkd system as a whole.
     *
     * @return object
     */
    public function stats()
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        return $this->pheanstalk->stats();
    }


    /**
     * Allows a worker to request more time to work on a job.
     *
     * This is useful for jobs that potentially take a long time, but you still want
     * the benefits of a TTR pulling a job away from an unresponsive worker.  A worker
     * may periodically tell the server that it's still alive and processing a job
     * (e.g. it may do this on DEADLINE_SOON).
     *
     * @param Job $job
     *
     * @return $this
     */
    public function touch($job)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->pheanstalk->touch($job);
        return $this;
    }


    /**
     * Change to the specified tube name for publishing jobs to.
     * This method would be called 'use' if it were not a PHP reserved word.
     *
     * Does not execute a USE command if the client is already using the
     * specified tube.
     *
     * @param string $tube
     *
     * @return $this
     */
    public function useTube($tube)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->pheanstalk->useTube($tube);
        return $this;
    }


    /**
     * Add the specified tube to the watchlist, to reserve jobs from.
     *
     * Does not execute a WATCH command if the client is already watching the
     * specified tube.
     *
     * @param string $tube
     *
     * @return $this
     */
    public function watch($tube)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->pheanstalk->watch($tube);
        return $this;
    }


    /**
     * Adds the specified tube to the watchlist, to reserve jobs from, and
     * ignores any other tubes remaining on the watchlist.
     *
     * @param string $tube
     *
     * @return $this
     */
    public function watchOnly($tube)
    {
        $this->debugger->log(__FUNCTION__, func_get_args());
        $this->pheanstalk->watchOnly($tube);
        return $this;
    }

}
