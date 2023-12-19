<?php

namespace App\Repository;

use App\Models\Knowledge;

class KnowledgeRepository extends BaseRepository
{
    public function __construct(Knowledge $knowledge)
    {
        parent::__construct($knowledge);
    }
}
