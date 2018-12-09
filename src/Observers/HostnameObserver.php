<?php

namespace Tenancy\HynNova\Observers;

use Hyn\Tenancy\Contracts\Hostname;
use Hyn\Tenancy\Events\Hostnames\Attached;
use Hyn\Tenancy\Events\Hostnames\Created;
use Hyn\Tenancy\Events\Hostnames\Creating;
use Hyn\Tenancy\Events\Hostnames\Deleted;
use Hyn\Tenancy\Events\Hostnames\Deleting;
use Hyn\Tenancy\Events\Hostnames\Detached;
use Hyn\Tenancy\Events\Hostnames\Updated;
use Hyn\Tenancy\Events\Hostnames\Updating;
use Hyn\Tenancy\Traits\DispatchesEvents;

class HostnameObserver
{
	use DispatchesEvents;

    /**
     * Handle the hostname "creating" event.
     *
     * @param  Hostname  $hostname
     * @return void
     */
    public function creating(Hostname $hostname)
    {
        $this->emitEvent(new Creating($hostname));
    }

    /**
     * Handle the hostname "created" event.
     *
     * @param  Hostname  $hostname
     * @return void
     */
    public function created(Hostname $hostname)
    {
        $this->emitEvent(new Created($hostname));
    }

    /**
     * Handle the hostname "updating" event.
     *
     * @param  Hostname  $hostname
     * @return void
     */
    public function updating(Hostname $hostname)
    {
        $this->emitEvent(new Updating($hostname));
    }

    /**
     * Handle the hostname "updated" event.
     *
     * @param  Hostname  $hostname
     * @return void
     */
    public function updated(Hostname $hostname)
    {
		$dirty = collect(array_keys($hostname->getDirty()))->mapWithKeys(function ($value, $key) use ($hostname) {
			return [ $value => $hostname->getOriginal($value) ];
		});

		$this->emitEvent(new Updated($hostname, $dirty->toArray()));
    }

    /**
     * Handle the hostname "deleting" event.
     *
     * @param  Hostname  $hostname
     * @return void
     */
    public function deleting(Hostname $hostname)
    {
        $this->emitEvent(new Deleting($hostname));
    }

    /**
     * Handle the hostname "deleted" event.
     *
     * @param  Hostname  $hostname
     * @return void
     */
    public function deleted(Hostname $hostname)
    {
        $this->emitEvent(new Deleted($hostname));
    }

    /**
     * Handle the hostname "saved" event.
     *
     * @param  Hostname  $hostname
     * @return void
     */
    public function saved(Hostname $hostname)
    {
		if ($hostname->isDirty('website_id'))
		{
			if ($hostname->website_id)
			{
				$this->emitEvent(new Attached($hostname, $hostname->website));
			}
			else
			{
				$this->emitEvent(new Detached($hostname));
			}
		}
    }

    /**
     * Handle the hostname "restored" event.
     *
     * @param  Hostname  $hostname
     * @return void
     */
    public function restored(Hostname $hostname)
    {
        //
    }

    /**
     * Handle the hostname "force deleted" event.
     *
     * @param  Hostname  $hostname
     * @return void
     */
    public function forceDeleted(Hostname $hostname)
    {
        //
    }
}
