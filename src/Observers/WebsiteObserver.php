<?php

namespace Tenancy\HynNova\Observers;

use Hyn\Tenancy\Contracts\Website;
use Hyn\Tenancy\Events\Websites\Created;
use Hyn\Tenancy\Events\Websites\Creating;
use Hyn\Tenancy\Events\Websites\Deleted;
use Hyn\Tenancy\Events\Websites\Deleting;
use Hyn\Tenancy\Events\Websites\Updated;
use Hyn\Tenancy\Events\Websites\Updating;
use Hyn\Tenancy\Traits\DispatchesEvents;

class WebsiteObserver
{
	use DispatchesEvents;

	/**
	 * Handle the models system website "creating" event.
	 *
	 * @param  Website  $website
	 * @return void
	 */
	public function creating(Website $website)
	{
		$this->emitEvent(new Creating($website));
	}

    /**
     * Handle the models system website "created" event.
     *
     * @param  Website  $website
     * @return void
     */
    public function created(Website $website)
    {
		$this->emitEvent(new Created($website));
    }

    /**
     * Handle the models system website "updating" event.
     *
     * @param  Website  $website
     * @return void
     */
    public function updating(Website $website)
    {
        $this->emitEvent(new Updating($website));
    }

    /**
     * Handle the models system website "updated" event.
     *
     * @param  Website  $website
     * @return void
     */
    public function updated(Website $website)
    {
		$dirty = collect(array_keys($website->getDirty()))->mapWithKeys(function ($value, $key) use ($website) {
			return [ $value => $website->getOriginal($value) ];
		});

		$this->emitEvent(new Updated($website, $dirty->toArray()));
    }

    /**
     * Handle the models system website "deleting" event.
     *
     * @param  Website  $website
     * @return void
     */
    public function deleting(Website $website)
    {
        $this->emitEvent(new Deleting($website));
    }

    /**
     * Handle the models system website "deleted" event.
     *
     * @param  Website  $website
     * @return void
     */
    public function deleted(Website $website)
    {
        $this->emitEvent(new Deleted($website));
    }

    /**
     * Handle the models system website "restored" event.
     *
     * @param  Website  $website
     * @return void
     */
    public function restored(Website $website)
    {
        //
    }

    /**
     * Handle the models system website "force deleted" event.
     *
     * @param  Website  $website
     * @return void
     */
    public function forceDeleted(Website $website)
    {
        //
    }
}
