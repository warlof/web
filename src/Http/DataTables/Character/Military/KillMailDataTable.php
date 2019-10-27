<?php

/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015, 2016, 2017, 2018, 2019  Leon Jacobs
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace Seat\Web\Http\DataTables\Character\Military;

use Seat\Eveapi\Models\Killmails\CharacterKillmail;
use Seat\Web\Http\DataTables\Common\Military\AbstractKillMailDataTable;

/**
 * Class KillMailDataTable.
 *
 * @package Seat\Web\Http\DataTables\Character\Military
 */
class KillMailDataTable extends AbstractKillMailDataTable
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return CharacterKillmail::with('detail', 'detail', 'detail.system',
            'victim', 'victim.character', 'victim.corporation', 'victim.alliance', 'victim.ship',
            'attackers', 'attackers.character', 'attackers.corporation', 'attackers.alliance');
    }

    /**
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return parent::html()
            ->ajax([
                'data' => 'function(d) { d.characters = $("#dt-character-selector").val(); }',
            ]);
    }
}
