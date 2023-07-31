<?php

namespace Modules\User\Traits;

use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
// use Laravel\Jetstream\HasTeams;
use App\Traits\Jetstream\HasTeams;
use Laravel\Jetstream\Jetstream;

use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\Features;

trait UserTrait
{
    use HasProfilePhoto;
    use HasTeams;
    use TwoFactorAuthenticatable;

    /**
     * Update Related Entities.
     *
     * @var array
     */
    public function updateRelatedEntities($request)
    {
        $data = $request->all();
        
        if (method_exists($this, 'syncRoles') && isset($data['roles'])) {
            $this->syncRoles($data['roles']);
        }
        
        if ( method_exists($this, 'uploadOrAttachMedia') ) {
            $this->uploadOrAttachMedia($request);
        }
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function profilePhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public');
    }






    /**
     * Determine if the user belongs to any team.
     *
     * @return bool
     */
    public function hasTeams()
    {
        return $this->allTeams()->isNotEmpty();
    }

    /**
     * Determine if the given team is the current team.
     *
     * @param  mixed  $team
     * @return bool
     */
    public function isCurrentTeam($team)
    {
        if (! $this->allTeams()->count()) {
            return false;
        }

        return $team->id === $this->currentTeam->id;
    }

    /**
     * Get the current team of the user's context.
     */
    public function currentTeam()
    {
        if (is_null($this->current_team_id) && $this->id) {
            $this->switchTeam($this->allTeams()->first());
        }
        return $this->belongsTo(Jetstream::teamModel(), 'current_team_id');
    }

}
