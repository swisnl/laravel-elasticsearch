<?php

namespace Swis\Elastic\Interfaces;

use Illuminate\Support\Carbon;

interface DocumentInterface
{
    public function setId(string $id);

    public function setType(string $type);

    public function setDate(Carbon $date);

    public function toArray(): array;

}
