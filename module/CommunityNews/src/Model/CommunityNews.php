<?php

namespace Rox\CommunityNews\Model;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;
use Rox\CommunityNews\Repository\CommunityNewsRepositoryInterface;
use Rox\Core\Exception\NotFoundException;
use Rox\Core\Model\AbstractModel;
use Rox\Member\Model\Member;

/**
 * @property integer $id
 * @property-read Member $receiver
 */
class CommunityNews extends AbstractModel implements CommunityNewsRepositoryInterface
{
    /**
     * @var string
     */
    public $table = 'community_news';

    /**
     * @var array
     */
    protected $ormRelationships = [
        'creator',
        'updater',
        'deleter',
        'comments'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function creator()
    {
        return $this->hasOne(Member::class, 'id', 'created_by');
    }

    public function updater()
    {
        return $this->hasOne(Member::class, 'id', 'updated_by');
    }

    public function deleter()
    {
        return $this->hasOne(Member::class, 'id', 'deleted_by');
    }

    public function getById($id)
    {
        $q = $this->newQuery();

        $q->where([
            'Id' => $id,
        ]);

        $communityNews = $q->get()->first();

        if (!$communityNews) {
            throw new NotFoundException();
        }

        return $communityNews;
    }

    public function getAll() {
        return $this->newQuery()->get()->all();
    }

    public function getLatest() {
        $q = $this->newQuery();

        return $q->get()->sortBy('created_at', SORT_REGULAR, true)->first();
    }
}
